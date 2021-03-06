<?php

namespace Lounaslippu\Controller;


use Lounaslippu\Service\AuthenticationService;
use Lounaslippu\Service\PaymentImportService;
use Tsoha\View;

/**
 * Class PaymentImportController
 * @package Lounaslippu\Controller
 */
class PaymentImportController
{
    /**
     * @var AuthenticationService
     */
    private $authenticationService;

    /**
     * @var PaymentImportService
     */
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

    /**
     * Generates page
     */
    public function showPageAction()
    {
        $this->authenticationService->authenticate();

        return View::make('payment_upload.html', array());
    }

    /**
     * Imports CSV-file
     */
    public function importCsv()
    {
        $this->authenticationService->authenticate();
        $this->paymentImportService->importCsv();
    }

}