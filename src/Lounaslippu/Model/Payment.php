<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 20.4.2015
 * Time: 14:25
 */

namespace Lounaslippu\Model;


use Tsoha\BaseModel;

class Payment extends BaseModel{
    /**
     * @var string
     */
    protected $archiving_code;

    /**
     * @var bigint
     */
    protected $reference_number;

    /**
     * @var decimal
     */
    protected $amount;

    /**
     * @var /DateTime
     */
    protected $recording_date;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    /**
     * Should return array("prepared sql :key" => array("key" => "value"))
     * @return array|null
     */
    public function getInsertSql()
    {
        $sql ="insert into payment (archiving_code, reference_number, amount, recording_date) values (:archiving_code, :reference_number, :amount, :recording_date)";
        return array( $sql => array(
            "archiving_code" => $this->archiving_code, "reference_number" => $this->reference_number, "amount" => $this->amount, "recording_date" => $this->recording_date
        ));
    }
}