<?php

namespace Lounaslippu\Model;

use Tsoha\BaseModel;

class Ticket extends BaseModel {

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

    public function __construct($attributes){
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
        return $this->used;
    }

    /**
     * @return boolean
     */
    public function isVoid()
    {
        return $this->void;
    }

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public function getInsertSql()
    {
        $sql ="insert into ticket (id, user_id, invoice_id) values (:id, :user_id, :invoice_id)";
        return array( $sql => array(
            "id" => $this->id, "user_id" => $this->user_id, "invoice_id" => $this->invoice_id
        ));
    }
}