<?php

namespace Lounaslippu\Service;


use Lounaslippu\Model\Invoice;
use Lounaslippu\Model\Ticket;
use Lounaslippu\Model\User;
use Lounaslippu\Service\PaymentService;
use Lounaslippu\Repository\TicketRepository;
use Lounaslippu\Service\ErrorService;
use Tsoha\Redirect;

class TicketService {

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

    public function getAmountOfAvailableTickets(User $user){
        $start = new \DateTime("first day of January " . date("Y"));
        $end = new \DateTime("last day of May" . date("Y"));
        return MAX_AMOUNT_OF_TICKETS_PER_SEMESTER - $this->ticketRepository->getAmountOfOrderedTickets($user, $start, $end);
    }

    public function orderTickets(User $user){
        if(!isset($_POST["amount"])){
            ErrorService::setErrors($error = array("error" => "Järjestelmä ei löydä lähettämääsi lomaketta. Yritä uudelleen"));
            return;
        }
        if(!is_numeric($_POST["amount"]) || $_POST["amount"] > $this->getAmountOfAvailableTickets($user) || $_POST["amount"] <= 0){
            ErrorService::setErrors($error = array("error" => "Tilaamasi lippujen määrä ei ole mahdollinen."));
            return;
        }
        $invoice = $this->paymentService->makeInvoice($user, TICKET_PRICE * $_POST["amount"]);
        $errors = $invoice->errors();
        if(!empty($errors)){
            ErrorService::setErrors($errors);
            return;
        }
        $this->createTickets($user, $invoice, $_POST["amount"]);
    }

    private function createTickets(User $user, Invoice $invoice, $amount){
        $lastId = $this->ticketRepository->getLastTicketId($user);
        if($lastId === null){
            $lastId = (TICKET_BASE_NUMBER_1 + $user->getId()) . TICKET_BASE_NUMBER_2;
        }
        $tickets = array();
        for($i=0; $i<$amount; $i++){
            $lastId++;
            $tickets[] = new Ticket(array("id" => $lastId, "user_id" => $user->getId(), "invoice_id" => $invoice->getId()));
        }
        $insert = $this->ticketRepository->save($tickets);
        if($insert !== true){
            $message = "Lippujen kirjaamisessa tapahtui virhe.<br />" . $insert;
            $error = array("error" => $message);
            ErrorService::setErrors($error);
            return;
        }

        Redirect::to("/lounasliput", array("success" => "Liput tilattu onnistuneesti. Alla näet avoimet laskusi."));
    }

}