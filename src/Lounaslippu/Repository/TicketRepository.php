<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 20.4.2015
 * Time: 15:24
 */

namespace Lounaslippu\Repository;

use Lounaslippu\Model\User;
use Tsoha\DB;

class TicketRepository {

    public function getAmountOfOrderedTickets(User $user, \DateTime $start, \DateTime $end){
        $query = DB::connection()->prepare('select count(t.id) as amount from ticket t left join invoice i on t.invoice_id = i.id where t.user_id = :user_id and (i.created >= :start and i.created <= :end)');
        $query->execute(array('user_id' => $user->getId(), 'start' => $start->format('Y-m-d'), 'end' => $end->format('Y-m-d')));
        $result = $query->fetch();
        if($result !== false){
            return $result["amount"];
        }
        return null;

    }
}