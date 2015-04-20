<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 20.4.2015
 * Time: 14:18
 */

namespace Lounaslippu\Model;


use Tsoha\BaseModel;

class Invoice extends BaseModel{

    /**
     * @var int
     */
    protected $id;

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
     * @return bigint
     */
    public function getReferenceNumber()
    {
        return $this->reference_number;
    }

    /**
     * @return decimal
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }


    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public function getInsertSql()
    {
        $sql ="insert into invoice (reference_number, amount, user_id, created) values (:reference_number, :amount, :user_id, :created)";
        return array( $sql => array(
            "reference_number" => $this->reference_number, "amount" => $this->amount, "user_id" => $this->user_id, "created" => $this->created
        ));
    }
}