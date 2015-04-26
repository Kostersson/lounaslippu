<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 20.4.2015
 * Time: 15:28
 */

namespace Lounaslippu\Repository;

use Lounaslippu\Model\Invoice;
use Lounaslippu\Model\PaymentToInvoiceModel;
use Lounaslippu\Model\User;
use Tsoha\DB;


class PaymentRepository {

    public function getUsersPayments(User $user){
        $query = DB::connection()->prepare('select count(t.id) as tickets, i.id as invoice_id, p.date_of_payment, i.reference_number, i.amount as invoice_amount, p.amount as paid, p.amount_left, p.archiving_code, p.recording_date from payment p left join invoice i on p.reference_number = i.reference_number right join ticket t on t.invoice_id = i.id where i.user_id = :user_id group by p.archiving_code order by p.recording_date DESC');
        $query->execute(array('user_id' => $user->getId()));
        $result = $query->fetchAll();
        $payments = array();
        foreach($result as $row){
            $payments[] = new PaymentToInvoiceModel($row);
        }
        return $payments;
    }

    public function getUsersUnpaidInvoices(User $user){
        $query = DB::connection()->prepare('select count(t.id) as tickets, i.id, i.user_id, i.reference_number, i.amount, i.created from ticket t left join invoice i on t.invoice_id = i.id left join payment p on p.reference_number = i.reference_number where i.user_id = :user_id AND p.archiving_code IS NULL group by p.archiving_code order by p.recording_date DESC');
        $query->execute(array('user_id' => $user->getId()));
        $result = $query->fetchAll();
        $invoices = array();
        foreach($result as $row){
            $invoices[] = new Invoice($row);
        }
        return $invoices;
    }

    public function nextInvoiceId(){
        $query = DB::connection()->prepare('SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=\'invoice\'');
        $query->execute(array());
        $result = $query->fetch();
        return $result[0];
    }
}
