<?php

namespace Lounaslippu\Service;


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


}