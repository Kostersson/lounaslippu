<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 27.4.2015
 * Time: 12:21
 */

namespace Lounaslippu\Service;


use Lounaslippu\Model\User;
use Lounaslippu\Repository\UserRepository;
use Tsoha\Redirect;

class UserService {

    /**
     * @var RegistrationService
     */
    private $registrationService;

    private $userRepository;

    /**
     * UserService constructor.
     * @param RegistrationService $registrationService
     */
    public function __construct(RegistrationService $registrationService, UserRepository $userRepository)
    {
        $this->registrationService = $registrationService;
        $this->userRepository = $userRepository;
    }


    public function updateUser(User$user){

        $user->setPassword($this->registrationService->createPassword($_POST["password1"]));
        $user->setName($_POST["name"]);
        if($this->userRepository->getEmailsExceptUser($user, $_POST["email"]) !== false){
            $error = array("error" => "Sähköpostiosoitteellasi on jo rekisteröitynyt käyttäjä.<br />");
            ErrorService::setErrors($error);
            return;
        }
        $user->setEmail($_POST["email"]);
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
            ErrorService::setErrors($error);
            return;
        }
        $insert = $this->userRepository->update(array($user));
        if($insert !== true){
            $message = "Käyttäjän päivityksessä tapahtui virhe.<br />" . $insert;
            $error = array("error" => $message);
            ErrorService::setErrors($error);
            return;
        }

        Redirect::to("/", array("success" => "Tiedot päivitetty."));

    }
}