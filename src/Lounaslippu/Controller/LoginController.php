<?php
namespace Lounaslippu\Controller;

use Lounaslippu\Service\AuthenticationService;
use Tsoha\View;


class LoginController {

    private $authenticationService;

    /**
     * @param AuthenticationService $authenticationService
     */
    function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function showPageAction(){
        return View::make('login.html');
    }

    public function loginAction(){
        $this->authenticationService->signIn($_POST["email"], $_POST["password"]);
    }

    public function logoutAction(){
        $this->authenticationService->logout();
    }
}
