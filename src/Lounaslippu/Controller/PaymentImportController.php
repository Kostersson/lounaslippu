<?php

namespace Lounaslippu\Controller;


use Lounaslippu\Service\AuthenticationService;
use Lounaslippu\Service\PaymentImportService;
use Tsoha\View;

class PaymentImportController {
    private $authenticationService;

    private $paymentImportService;

    /**
     * FrontPageController constructor.
     * @param AuthenticationService $authenticationService
     * @param PaymentImportService $paymentImportService
     */
    public function __construct(AuthenticationService $authenticationService, PaymentImportService $paymentImportService)
    {
        $this->authenticationService = $authenticationService;
        $this->paymentImportService = $paymentImportService;
    }

    public function showPageAction(){
        $this->authenticationService->authenticate();

        return View::make('payment_upload.html', array(

        ));
    }

    public function importCsv(){
        $this->authenticationService->authenticate();
        $this->paymentImportService->importCsv();
    }

}