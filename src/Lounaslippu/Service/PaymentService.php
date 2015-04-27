<?php

namespace Lounaslippu\Service;


use Lounaslippu\Model\Invoice;
use Lounaslippu\Model\User;
use Lounaslippu\Repository\InvoiceRepository;
use Lounaslippu\Repository\PaymentRepository;

class PaymentService
{

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    /**
     * @var InvoiceRepository
     */
    private $invoiceRepository;

    /**
     * PaymentService constructor.
     * @param PaymentRepository $paymentRepository
     * @param InvoiceRepository $invoiceRepository
     */
    public function __construct(PaymentRepository $paymentRepository, InvoiceRepository $invoiceRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * @param User $user
     * @return array
     */
    public function getUsersPayments(User $user)
    {
        return $this->paymentRepository->getUsersPayments($user);
    }

    /**
     * @param User $user
     * @return array
     */
    public function getUsersUnpaidInvoices(User $user)
    {
        return $this->paymentRepository->getUsersUnpaidInvoices($user);
    }

    /**
     * @param User $user
     * @param $amount
     * @return Invoice
     */
    public function makeInvoice(User $user, $amount)
    {
        $nextId = $this->paymentRepository->nextInvoiceId();
        $referenceNumber = $this->calculateReferenceNumber(REFERENCE_NUMBER_BASE + $nextId);
        $invoice = new Invoice();
        $invoice->setAmount($amount);
        $invoice->setReferenceNumber($referenceNumber);
        $invoice->setUserId($user);
        $errors = $invoice->errors();
        if (empty($errors)) {
            $this->invoiceRepository->insert(array($invoice));
            return $invoice;
        }
        return $invoice;
    }

    /**
     * @param $base
     * @return string
     */
    private function calculateReferenceNumber($base)
    {
        $base = strval($base);
        $multiplier = array(7, 3, 1);
        $sum = 0;
        for ($i = strlen($base) - 1, $j = 0; $i >= 0; $i--, $j++) {
            $sum += (int)$base[$i] * (int)$multiplier[$j % 3];
        }
        $checksum = (10 - ($sum % 10)) % 10;
        return $base . $checksum;
    }
}