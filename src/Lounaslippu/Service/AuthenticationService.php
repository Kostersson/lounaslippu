<?php
namespace Lounaslippu\Service;

use Lounaslippu\Model\UserModel;
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

    public function signIn($username, $password)
    {
        if ($this->validateSession()) {
            Redirect::to("/");
        }
        $user = $this->authenticationRepository->getUserWithPassword($username, $password);
        if ($user instanceof UserModel) {
            $_SESSION["user"] = $user;
            $_SESSION["timestamp"] = time();
            Redirect::to("/");
        }
        $message = array("error" => "Kirjautuminen epäonnistui");
        Redirect::to("/sisaankirjautuminen", $message);
    }

    private function validateSession()
    {
        if (!isset($_SESSION["user"]) || !($_SESSION["user"] instanceof UserModel)) {
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

    public function logout()
    {
        unset($_SESSION["user"]);
        unset($_SESSION["timestamp"]);
        $message = array("success" => "Sinut on nyt kirjattu ulos järjestelmästä");
        Redirect::to("/", $message);
    }


}