<?php

namespace Lounaslippu\Controller;


use Lounaslippu\Service\AuthenticationService;
use Tsoha\View;

/**
 * Class FrontPageController
 * @package Lounaslippu\Controller
 */
class FrontPageController
{
    /**
     * @var AuthenticationService
     */
    private $authenticationService;

    /**
     * FrontPageController constructor.
     * @param AuthenticationService $authenticationService
     */
    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    /**
     * Generates dummy homepage
     */
    public function showPageAction()
    {
        $this->authenticationService->authenticate();
        return View::make('home.html');
    }
}