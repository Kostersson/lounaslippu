<?php
namespace Lounaslippu\Controller;

use Lounaslippu\Service\AuthenticationService;
use Tsoha\View;


/**
 * Class LoginController
 * @package Lounaslippu\Controller
 */
class LoginController
{

    /**
     * @var AuthenticationService
     */
    private $authenticationService;

    /**
     * @param AuthenticationService $authenticationService
     */
    function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    /**
     * Generates login page
     */
    public function showPageAction()
    {
        return View::make('login.html');
    }

    /**
     * User login
     */
    public function loginAction()
    {
        $this->authenticationService->signIn($_POST["email"], $_POST["password"]);
    }

    /**
     * Logout
     */
    public function logoutAction()
    {
        $this->authenticationService->logout();
    }
}
