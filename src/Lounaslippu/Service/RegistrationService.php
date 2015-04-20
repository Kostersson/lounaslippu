<?php

namespace Lounaslippu\Service;


use Lounaslippu\Model\User;
use Lounaslippu\Repository\AuthenticationRepository;
use Lounaslippu\Repository\UserRepository;
use Tsoha\Redirect;

class RegistrationService
{

    private $authenticationRepository;

    private $userRepository;

    /**
     * RegistrationService constructor.
     * @param AuthenticationRepository $authenticationRepository
     * @param UserRepository $userRepository
     */
    public function __construct(AuthenticationRepository $authenticationRepository, UserRepository $userRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
        $this->userRepository = $userRepository;
    }

    public function registrateNewUser()
    {
        $user = new User($_POST);
        if ($user->errors()) {
            $errors = $user->errors();
            $errorMessage = "";
            foreach ($errors as $error) {
                if (is_array($error)) {
                    foreach ($error as $message) {
                        $errorMessage .= $message . "<br />";
                    }
                } else {
                    $errorMessage .= $error . "<br />";
                }
            }
            $error = array("error" => $errorMessage);
            $this->setErrors($error);
            return;
        }
        if(!$this->validateUsername($user->getEmail())){
            $error = array("error" => "Sähköpostiosoitteellasi on jo rekisteröitynyt käyttäjä.<br />");
            $this->setErrors($error);
            return;
        }
        $user->setPassword($this->createPassword($user->getPassword()));
        $insert = $this->userRepository->save(array($user));
        if($insert !== true){
            $message = "Käyttäjän lisäyksessä tapahtui virhe.<br />" . $insert;
                $error = array("error" => $message);
            $this->setErrors($error);
            return;
        }

        Redirect::to("/", array("success" => "Käyttäjä lisätty onnistuneesti"));
    }
    private function setErrors($error){
        if (isset($_SESSION["flash_message"])) {
            $_SESSION["flash_message"] = json_decode($_SESSION["flash_message"]);
        } else {
            $_SESSION["flash_message"] = array();
        }
        $_SESSION["flash_message"] = json_encode(array_merge($_SESSION["flash_message"], $error));
    }
    private function createPassword($input)
    {
        $salt = "";
        $salt_chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        for ($i = 0; $i < 22; $i++) {
            $salt .= $salt_chars[array_rand($salt_chars)];
        }
        return crypt($input, sprintf('$2a$%02d$', CRYPT_ROUNDS) . $salt);
    }

    public function validateUsername($username)
    {
        $users = $this->authenticationRepository->getUsernamesByEmail($username);
        if ($users === false) {
            return true;
        }
        return false;
    }


}