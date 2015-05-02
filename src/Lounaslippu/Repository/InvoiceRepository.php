<?php

namespace Lounaslippu\Repository;


use Lounaslippu\Model\Invoice;
use Tsoha\DB;

/**
 * Class InvoiceRepository
 * @package Lounaslippu\Repository
 */
class InvoiceRepository extends EntityRepository
{

    /**
     * @param $referenceNumber
     * @return Invoice
     */
    public function getInvoiceByReferenceNumber($referenceNumber)
    {

        $query = DB::connection()->prepare('select * from invoice where reference_number = :reference_number');
        $query->execute(array('reference_number' => $referenceNumber));
        $result = $query->fetch();
        $invoice = new Invoice($result);
        return $invoice;

    }
}