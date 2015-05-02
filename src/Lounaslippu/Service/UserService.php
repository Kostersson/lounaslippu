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

/**
 * Class UserService
 * @package Lounaslippu\Service
 */
class UserService
{

    /**
     * @var RegistrationService
     */
    private $registrationService;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var AuthenticationService
     */
    private $authenticationService;

    /**
     * UserService constructor.
     * @param RegistrationService $registrationService
     */
    public function __construct(RegistrationService $registrationService, UserRepository $userRepository, AuthenticationService $authenticationService)
    {
        $this->registrationService = $registrationService;
        $this->userRepository = $userRepository;
        $this->authenticationService = $authenticationService;
    }


    /**
     * @param User $user
     */
    public function updateUser(User $user)
    {

        $user->setPassword($this->registrationService->createPassword($_POST["password"]));
        $user->setName($_POST["name"]);
        if ($this->userRepository->getEmailsExceptUser($user, $_POST["email"]) !== false) {
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
        if ($insert !== true) {
            $message = "Käyttäjän päivityksessä tapahtui virhe.<br />" . $insert;
            $error = array("error" => $message);
            ErrorService::setErrors($error);
            return;
        }
        // logout and sign in to update user in session
        $this->authenticationService->logout(false);
        $this->authenticationService->signIn($user->getEmail(), $_POST["password"], false);

        Redirect::to("/", array("success" => "Tiedot päivitetty."));

    }
}