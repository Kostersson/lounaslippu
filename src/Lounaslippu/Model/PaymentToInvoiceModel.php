<?php

namespace Lounaslippu\Model;


/**
 * Class PaymentToInvoiceModel
 * @package Lounaslippu\Model
 */
/**
 * Class PaymentToInvoiceModel
 * @package Lounaslippu\Model
 */
class PaymentToInvoiceModel
{
    /**
     * @var int
     */
    private $invoice_id;

    /**
     * @var bigint
     */
    private $payment_id;

    /**
     * @var \Date
     */
    private $date_of_payment;

    /**
     * Amount of tickets
     * @var int
     */
    private $tickets;
    /**
     * @var bigint
     */
    private $reference_number;
    /**
     * @var decimal
     */
    private $invoice_amount;
    /**
     * @var decimal
     */
    private $paid;
    /**
     * @var decimal
     */
    private $amount_left;
    /**
     * @var string
     */
    private $archiving_code;
    /**
     * @var \DateTime
     */
    private $recording_date;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = null)
    {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    /**
     * @return bigint
     */
    public function getPaymentId()
    {
        return $this->payment_id;
    }

    /**
     * @return int
     */
    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    /**
     * @return \Date
     */
    public function getDateOfPayment()
    {
        return $this->date_of_payment;
    }

    /**
     * @return bigint
     */
    public function getReferenceNumber()
    {
        return $this->reference_number;
    }

    /**
     * @return decimal
     */
    public function getInvoiceAmount()
    {
        return $this->invoice_amount;
    }

    /**
     * @return decimal
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * @return decimal
     */
    public function getAmountLeft()
    {
        return $this->amount_left;
    }

    /**
     * @return string
     */
    public function getArchivingCode()
    {
        return $this->archiving_code;
    }

    /**
     * @return \DateTime
     */
    public function getRecordingDate()
    {
        return $this->recording_date;
    }

    /**
     * @return int
     */
    public function getTickets()
    {
        return $this->tickets;
    }

}