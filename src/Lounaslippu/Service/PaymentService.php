<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 20.4.2015
 * Time: 15:30
 */

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

    public function getUserPayments(User $user){
        die(var_dump($user->getId()));
    }

}