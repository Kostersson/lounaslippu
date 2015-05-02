<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 27.4.2015
 * Time: 12:20
 */

namespace Lounaslippu\Controller;


use Lounaslippu\Service\AuthenticationService;
use Lounaslippu\Service\UserService;
use Tsoha\View;

/**
 * Class UserController
 * @package Lounaslippu\Controller
 */
class UserController
{
    /**
     * @var AuthenticationService
     */
    private $authenticationService;


    /**
     * @var UserService
     */
    private $userService;

    /**
     * FrontPageController constructor.
     * @param AuthenticationService $authenticationService
     * @param UserService $userService
     * @internal param PaymentImportService $paymentImportService
     */
    public function __construct(AuthenticationService $authenticationService, UserService $userService)
    {
        $this->authenticationService = $authenticationService;
        $this->userService = $userService;
    }

    /**
     * Show user personal data
     */
    public function showPageAction()
    {
        $this->authenticationService->authenticate();

        return View::make('user.html', array(
            "user" => $this->authenticationService->getUser()
        ));
    }

    /**
     * Updates users personal data
     */
    public function updateUserAction()
    {
        $this->authenticationService->authenticate();
        $this->userService->updateUser($this->authenticationService->getUser());
    }
}