<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 20.4.2015
 * Time: 14:25
 */

namespace Lounaslippu\Model;


use Tsoha\BaseModel;

/**
 * Class Payment
 * @package Lounaslippu\Model
 */
class Payment extends BaseModel
{
    /**
     * @var bigint
     */
    protected $id;

    /**
     * @var bigint
     */
    protected $reference_number;

    /**
     * @var decimal
     */
    protected $amount;

    /**
     * @var decimal
     */
    protected $amount_left;

    /**
     * @var /DateTime
     */
    protected $recording_date;

    /**
     * @var /DateTime
     */
    protected $date_of_payment;

    /**
     * @param array $attributes
     */
    public function __construct($attributes)
    {
        parent::__construct($attributes);
    }

    /**
     * @return bigint
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param bigint $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return decimal
     */
    public function getAmountLeft()
    {
        return $this->amount_left;
    }

    /**
     * @param decimal $amount_left
     */
    public function setAmountLeft($amount_left)
    {
        $this->amount_left = $amount_left;
    }

    /**
     * @return bigint
     */
    public function getReferenceNumber()
    {
        return $this->reference_number;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return floatval($this->amount);
    }

    /**
     * @return mixed
     */
    public function getRecordingDate()
    {
        return $this->recording_date;
    }

    /**
     * @return mixed
     */
    public function getDateOfPayment()
    {
        return $this->date_of_payment;
    }

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public function getInsertSql()
    {
        $sql = "insert into payment (reference_number, amount, amount_left, date_of_payment) values (:reference_number, :amount, :amount_left, :date_of_payment)";
        return array($sql => array(
            "reference_number" => $this->reference_number, "amount" => $this->amount, "amount_left" => $this->amount_left, "date_of_payment" => $this->date_of_payment
        ));
    }

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public function getUpdateSql()
    {
        $sql = "update payment set reference_number = :reference_number, amount = :amount, amount_left = :amount_left, date_of_payment = :date_of_payment where id = :id";
        return array($sql => array(
            "reference_number" => $this->reference_number, "amount" => $this->amount, "amount_left" => $this->amount_left, "date_of_payment" => $this->date_of_payment, "id" => $this->id
        ));
    }
}