<?php

namespace Lounaslippu\Service;


use Lounaslippu\Model\Invoice;
use Lounaslippu\Model\Payment;
use Lounaslippu\Model\Ticket;
use Lounaslippu\Model\User;
use Lounaslippu\Service\PaymentService;
use Lounaslippu\Repository\TicketRepository;
use Lounaslippu\Service\ErrorService;
use Tsoha\Redirect;

/**
 * Class TicketService
 * @package Lounaslippu\Service
 */
class TicketService
{

    /**
     * @var TicketRepository
     */
    private $ticketRepository;

    /**
     * @var PaymentService
     */
    private $paymentService;

    /**
     * TicketService constructor.
     * @param TicketRepository $ticketRepository
     * @param PaymentService $paymentService
     */
    public function __construct(TicketRepository $ticketRepository, PaymentService $paymentService)
    {
        $this->ticketRepository = $ticketRepository;
        $this->paymentService = $paymentService;
    }

    /**
     * @param User $user
     * @return int
     */
    public function getAmountOfAvailableTickets(User $user)
    {
        $start = new \DateTime("first day of January " . date("Y"));
        $end = new \DateTime("last day of May" . date("Y"));
        return MAX_AMOUNT_OF_TICKETS_PER_SEMESTER - $this->ticketRepository->getAmountOfOrderedTickets($user, $start, $end);
    }

    /**
     * @param User $user
     */
    public function orderTickets(User $user)
    {
        if (!isset($_POST["amount"])) {
            ErrorService::setErrors($error = array("error" => "Järjestelmä ei löydä lähettämääsi lomaketta. Yritä uudelleen"));
            return;
        }
        if (!is_numeric($_POST["amount"]) || $_POST["amount"] > $this->getAmountOfAvailableTickets($user) || $_POST["amount"] <= 0) {
            ErrorService::setErrors($error = array("error" => "Tilaamasi lippujen määrä ei ole mahdollinen."));
            return;
        }
        $invoice = $this->paymentService->makeInvoice($user, TICKET_PRICE * $_POST["amount"]);
        $errors = $invoice->errors();
        if (!empty($errors)) {
            ErrorService::setErrors($errors);
            return;
        }
        $this->createTickets($user, $invoice, $_POST["amount"]);
    }

    /**
     * @param User $user
     * @param Invoice $invoice
     * @param $amount
     */
    private function createTickets(User $user, Invoice $invoice, $amount)
    {
        $lastId = $this->ticketRepository->getLastTicketId($user);
        if ($lastId === null) {
            $lastId = (TICKET_BASE_NUMBER_1 + $user->getId()) . TICKET_BASE_NUMBER_2;
        }
        $tickets = array();
        for ($i = 0; $i < $amount; $i++) {
            $lastId++;
            $tickets[] = new Ticket(array("id" => $lastId, "user_id" => $user->getId(), "invoice_id" => $invoice->getId()));
        }
        $insert = $this->ticketRepository->insert($tickets);
        if ($insert !== true) {
            $message = "Lippujen kirjaamisessa tapahtui virhe.<br />" . $insert;
            $error = array("error" => $message);
            ErrorService::setErrors($error);
            return;
        }
        Redirect::to("/lounasliput", array("success" => "Liput tilattu onnistuneesti. Alla näet avoimet laskusi."));
    }

    /**
     * @param $ticketNUmber
     * @return array|void
     */
    public function addUsedTicket($ticketNUmber)
    {
        $ticket = $this->ticketRepository->getTicketById($ticketNUmber);
        if ($ticket === null) {
            ErrorService::setErrors($error = array("error" => "Syöttämääsi lippua ei löytynyt."));
            return;
        }
        if ($ticket->isUsed() || $ticket->isVoid()) {
            $reason = $ticket->isUsed() ? "käytetty" : "mitätöity";
            ErrorService::setErrors($error = array("error" => "Syöttämääsi lippu oli " . $reason . "."));
            return;
        }
        $ticket->setUsed(true);
        $this->ticketRepository->update(array($ticket));
        return array("success" => "Lippu syötetty onnistuneesti.");
    }

    /**
     * @param $reference_number
     * @param User $user
     */
    public function deleteOrder($reference_number, User $user){
        /** @var Invoice $invoice */
        $invoice = $this->paymentService->getUnpaidInvoice($reference_number);
        if($invoice->getId() === null){
            ErrorService::setErrors($error = array("error" => "Tilausta ei löytynyt tai sille on jo kirjattu maksusuorituksia."));
            return;
        }
        if($invoice->getUserId() !== $user->getId()){
            ErrorService::setErrors($error = array("error" => "Kyseistä tilausta ei löytynyt käyttäjätunnuksellesi."));
            return;
        }
        $this->ticketRepository->delete(array($invoice));
        ErrorService::setErrors($error = array("success" => "Tilaus peruttu onnistuneesti."));
        return;

    }

    public function getDownloadableTickets($paymentId){
        /** @var Payment $payment */
        $payment = $this->paymentService->getPayment($paymentId);
        if($payment->getAmountLeft() !== "0.00"){
            ErrorService::setErrors($error = array("error" => "Tilausta ei ole maksettu loppuun."));
            Redirect::to("/lounasliput");
        }
        /** @var Invoice $invoice */
        $invoice = $this->paymentService->getInvoiceByPayment($payment);
        $tickets = $this->ticketRepository->getTicketsByInvoice($invoice);
        return $tickets;
    }

}