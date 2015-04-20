<?php

namespace Lounaslippu\Service;


use Lounaslippu\Model\User;
use Lounaslippu\Repository\PaymentRepository;

class PaymentService {

    private $paymentRepository;

    /**
     * PaymentService constructor.
     * @param $paymentRepository
     */
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getUsersPayments(User $user){
        return $this->paymentRepository->getUsersPayments($user);
    }

    public function getUsersUnpaidInvoices(User $user){
        return $this->paymentRepository->getUsersUnpaidInvoices($user);
    }
}