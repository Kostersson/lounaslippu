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
     * @var bigint
     */
    protected $reference_number;

    /**
     * @var decimal
     */
    protected $amount;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public function getInsertSql()
    {
        $sql ="insert into invoice (reference_number, amount) values (:reference_number, :amount)";
        return array( $sql => array(
            "reference_number" => $this->reference_number, "amount" => $this->amount
        ));
    }
}