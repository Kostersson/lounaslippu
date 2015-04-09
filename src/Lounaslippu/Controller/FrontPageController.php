<?php

namespace Lounaslippu\Controller;


use Lounaslippu\Service\AuthenticationService;
use Tsoha\View;

class FrontPageController {
    private $authenticationService;

    /**
     * FrontPageController constructor.
     * @param AuthenticationService $authenticationService
     */
    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function showPageAction(){
        $this->authenticationService->authenticate();
        return View::make('home.html');
    }
}