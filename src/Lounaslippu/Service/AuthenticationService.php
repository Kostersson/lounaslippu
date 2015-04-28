<?php
namespace Lounaslippu\Service;

use Lounaslippu\Model\User;
use Lounaslippu\Repository\AuthenticationRepository;
use Tsoha\Redirect;

class AuthenticationService
{

    private $authenticationRepository;

    function __construct(AuthenticationRepository $authenticationRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
    }

    public function authenticate()
    {
        if ($this->validateSession()) {
            $_SESSION["timestamp"] = time();
            return;
        }
        Redirect::to("/sisaankirjautuminen");
    }

    public function signIn($username, $password, $redirect = true)
    {
        if ($this->validateSession()) {
            Redirect::to("/");
        }
        $user = $this->authenticationRepository->getUserWithPassword($username, $password);
        if ($user instanceof User) {
            $_SESSION["user"] = $user;
            $_SESSION["timestamp"] = time();
            if($redirect){
                Redirect::to("/");
            }
            return;
        }
        $message = array("error" => "Kirjautuminen epäonnistui");
        Redirect::to("/sisaankirjautuminen", $message);
    }

    private function validateSession()
    {
        if (!isset($_SESSION["user"]) || !($_SESSION["user"] instanceof User)) {
            return false;
        }
        if ($this->sessionExpired()) {
            return false;
        }
        return true;
    }

    private function sessionExpired()
    {
        $diff = (time() - $_SESSION["timestamp"]) / 60;
        if ($diff > SESSION_TTL) {
            $this->logout();
            return true;
        }
        return false;
    }

    public function logout($redirect = true)
    {
        unset($_SESSION["user"]);
        unset($_SESSION["timestamp"]);
        $message = array("success" => "Sinut on nyt kirjattu ulos järjestelmästä");
        if($redirect){
            Redirect::to("/", $message);
        }
        return;
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        if ($this->validateSession()) {
            return $_SESSION["user"];
        }
    }


}