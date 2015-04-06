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
        Redirect::to("/sisaankirjautuminen");
    }
    public function signIn($username, $password){
        $this->authenticationRepository->getUserWithPassword($username, $password);
    }
}