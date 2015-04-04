<?php
namespace Lounaslippu\Service;

use Lounaslippu\Repository\AuthenticationRepository;

class AuthenticationService{

    private $authenticationRepository;

    function __construct(AuthenticationRepository $authenticationRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
    }

    public function authenticate(){

    }
    public function signIn($username, $password){
        $this->authenticationRepository->getUserWithPassword($username, $password);
    }
}