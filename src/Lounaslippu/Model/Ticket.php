<?php

namespace Lounaslippu\Model;

use Tsoha\BaseModel;

/**
 * Class Ticket
 * @package Lounaslippu\Model
 */
class Ticket extends BaseModel
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $user_id;

    /**
     * @var int
     */
    protected $invoice_id;

    /**
     * @var boolean
     */
    protected $used;

    /**
     * @var boolean
     */
    protected $void;

    /**
     * @param array $attributes
     */
    public function __construct($attributes)
    {
        parent::__construct($attributes);
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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return int
     */
    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    /**
     * @return boolean
     */
    public function isUsed()
    {
        return $this->used == "TRUE" ? true : false;
    }

    /**
     * @return boolean
     */
    public function isVoid()
    {
        return $this->void == "TRUE" ? true : false;
    }

    /**
     * @param boolean $used
     */
    public function setUsed($used)
    {
        $this->used = $used ? "TRUE" : "FALSE";
    }

    /**
     * @param boolean $void
     */
    public function setVoid($void)
    {
        $this->void = $void ? "TRUE" : "FALSE";
    }

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public function getInsertSql()
    {
        $sql = "insert into ticket (id, user_id, invoice_id) values (:id, :user_id, :invoice_id)";
        return array($sql => array(
            "id" => $this->id, "user_id" => $this->user_id, "invoice_id" => $this->invoice_id
        ));
    }

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public function getUpdateSql()
    {
        $sql = "update ticket set user_id = :user_id, invoice_id = :invoice_id, used = :used, void = :void where id = :id";
        return array($sql => array(
            "user_id" => $this->user_id, "invoice_id" => $this->invoice_id, "used" => $this->used, "void" => $this->void, "id" => $this->id
        ));
    }
}