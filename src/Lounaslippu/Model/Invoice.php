<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 20.4.2015
 * Time: 14:18
 */

namespace Lounaslippu\Model;


use Tsoha\BaseModel;

/**
 * Class Invoice
 * @package Lounaslippu\Model
 */
class Invoice extends BaseModel
{

    /**
     * @var int
     */
    protected $id;

    /**
     * Amount of tickets
     * @var int
     */
    protected $tickets;

    /**
     * @var int
     */
    protected $user_id;

    /**
     * @var bigint
     */
    protected $reference_number;

    /**
     * @var decimal
     */
    protected $amount;
    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @param array $attributes
     */
    public function __construct($attributes = null)
    {
        parent::__construct($attributes);
        $this->addValidators();
    }

    /**
     * Set call_user_function
     */
    private function addValidators()
    {
        $this->validators[] = "validator";
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
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
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param int $tickets
     */
    public function setTickets($tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * @param User $user
     */
    public function setUserId(User $user)
    {
        $this->user_id = $user->getId();
    }

    /**
     * @param bigint $reference_number
     */
    public function setReferenceNumber($reference_number)
    {
        $this->reference_number = $reference_number;
    }

    /**
     * @param decimal $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return array
     */
    protected function validator()
    {
        $error = array();
        if (!is_numeric($this->user_id)) {
            $error = array_merge($error, array("user_error" => "Laskulle osoitettu käyttäjä on väärin"));
        }
        if (!is_numeric($this->amount) || $this->amount <= 0) {
            $error = array_merge($error, array("amount_error" => "Laskun summa on väärin"));
        }
        return $error;
    }


    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public function getInsertSql()
    {
        $sql = "insert into invoice (reference_number, amount, user_id) values (:reference_number, :amount, :user_id)";
        return array($sql => array(
            "reference_number" => $this->reference_number, "amount" => $this->amount, "user_id" => $this->user_id
        ));
    }

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public function getUpdateSql()
    {
        $sql = "update invoice set reference_number = :reference_number, amount = :amount, user_id = :user_id WHERE id = :id";
        return array($sql => array(
            "reference_number" => $this->reference_number, "amount" => $this->amount, "user_id" => $this->user_id, "id" => $this->id
        ));
    }

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public function getDeleteSql()
    {
        $sql = "DELETE FROM invoice WHERE  id = :id";
        return array($sql => array(
            "id" => $this->id
        ));
    }
}