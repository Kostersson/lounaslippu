<?php
namespace Lounaslippu\Service;

use Lounaslippu\Repository\AuthenticationRepository;
use Tsoha\Redirect;

class AuthenticationService{

    private $authenticationRepository;

    function __construct(AuthenticationRepository $authenticationRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
    }

    public function authenticate(){
        if($this->validateSession()){
            $_SESSION["timestamp"] = time();
        }
        Redirect::to("/sisaankirjautuminen");
    }
    public function signIn($username, $password){

        $user = $this->authenticationRepository->getUserWithPassword($username, $password);
    }

    private function validateSession(){
        if(!isset($_SESSION["email"]) || !isset($_SESSION["name"]) || !isset($_SESSION["timestamp"])){
            return false;
        }
        if(empty($_SESSION["email"]) || empty($_SESSION["name"]) || empty($_SESSION["timestamp"])){
            return false;
        }
        if($this->sessionExpired()){
            return false;
        }
        return true;
    }

    private function sessionExpired(){
        $diff = time() - $_SESSION["timestamp"]/60;
        if($diff > SESSION_TTL){
            return true;
        }
        return false;
    }
}