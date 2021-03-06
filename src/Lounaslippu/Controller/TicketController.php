<?php

namespace Lounaslippu\Controller;

use Lounaslippu\Service\AuthenticationService;
use Lounaslippu\Service\PaymentService;
use Lounaslippu\Service\TicketService;
use Tsoha\View;

/**
 * Class TicketController
 * @package Lounaslippu\Controller
 */
class TicketController
{

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

    /**
     * Tickets page
     */
    public function showPageAction()
    {
        $this->authenticationService->authenticate();
        $payments = $this->paymentService->getUsersPayments($this->authenticationService->getUser());
        $unpaidInvoices = $this->paymentService->getUsersUnpaidInvoices($this->authenticationService->getUser());

        return View::make('tickets.html', array(
            "payments" => $payments,
            "unpaid_invoices" => $unpaidInvoices,
            "max_tickets" => $this->ticketService->getAmountOfAvailableTickets($this->authenticationService->getUser())
        ));
    }

    /**
     * Tickets order page
     */
    public function showOrderPageAction()
    {
        $this->authenticationService->authenticate();
        return View::make('order.html', array(
            "max_tickets" => $this->ticketService->getAmountOfAvailableTickets($this->authenticationService->getUser())
        ));
    }

    /**
     * Order tickets
     */
    public function orderTickets()
    {
        $this->authenticationService->authenticate();
        $errors = $this->ticketService->orderTickets($this->authenticationService->getUser());
        return $this->showOrderPageAction($errors);
    }

    /**
     * Used tickets
     * @param array $message
     */
    public function showUsedTicketFormAction($message = array())
    {
        $this->authenticationService->authenticate();
        return View::make('used_tickets.html', $message);
    }

    /**
     * Marks ticket as used
     */
    public function addUsedTicketAction()
    {
        $this->authenticationService->authenticate();
        $message = array();
        if (isset($_POST["ticketNumber"]) && is_numeric($_POST["ticketNumber"])) {
            $message = $this->ticketService->addUsedTicket($_POST["ticketNumber"]);
        } else {
            $message = "Lipun numeroa ei syötetty, tai se ei ollut oikeassa muodossa. <br />";
            $error = array("error" => $message);
            ErrorService::setErrors($error);
        }
        return $this->showUsedTicketFormAction($message);
    }

    /**
     * @param $reference_number
     */
    public function deleteOrderAction($reference_number){
        $this->authenticationService->authenticate();
        $message = $this->ticketService->deleteOrder($reference_number, $this->authenticationService->getUser());
        return $this->showPageAction($message);
    }

    public function downloadTicketsAction($paymentId){
        $this->authenticationService->authenticate();
        return View::make('download_tickets.html', array('tickets' => $this->ticketService->getDownloadableTickets($paymentId)));


    }
}