<?php

namespace Lounaslippu\Controller;

use Lounaslippu\Service\AuthenticationService;
use Lounaslippu\Service\PaymentService;
use Lounaslippu\Service\TicketService;
use Tsoha\View;

class TicketController {

    /**
     * @var AuthenticationService
     */
    private $authenticationService;

    /**
     * @var TicketService
     */
    private $ticketService;

    /**
     * @var PaymentService
     */
    private $paymentService;

    /**
     * @param AuthenticationService $authenticationService
     * @param TicketService $ticketService
     * @param PaymentService $paymentService
     */
    function __construct(AuthenticationService $authenticationService, TicketService $ticketService, PaymentService $paymentService)
    {
        $this->authenticationService = $authenticationService;
        $this->ticketService = $ticketService;
        $this->paymentService = $paymentService;
    }

    public function showPageAction(){
        $this->authenticationService->authenticate();
        $this->paymentService->getUserPayments($this->authenticationService->getUser());
        return View::make('tickets.html');
    }
}