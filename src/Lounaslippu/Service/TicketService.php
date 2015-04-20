<?php

namespace Lounaslippu\Service;


use Lounaslippu\Model\User;
use Lounaslippu\Service\PaymentService;
use Lounaslippu\Repository\TicketRepository;

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

}