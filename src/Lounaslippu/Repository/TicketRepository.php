<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 20.4.2015
 * Time: 15:24
 */

namespace Lounaslippu\Repository;

use Lounaslippu\Model\Ticket;
use Lounaslippu\Model\User;
use Tsoha\DB;

/**
 * Class TicketRepository
 * @package Lounaslippu\Repository
 */
class TicketRepository extends EntityRepository
{

    /**
     * @param User $user
     * @param \DateTime $start
     * @param \DateTime $end
     * @return null
     */
    public function getAmountOfOrderedTickets(User $user, \DateTime $start, \DateTime $end)
    {
        $query = DB::connection()->prepare('select count(t.id) as amount from ticket t left join invoice i on t.invoice_id = i.id where t.user_id = :user_id and (i.created >= :start and i.created <= :end)');
        $query->execute(array('user_id' => $user->getId(), 'start' => $start->format('Y-m-d'), 'end' => $end->format('Y-m-d')));
        $result = $query->fetch();
        if ($result !== false) {
            return $result["amount"];
        }
        return null;
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getLastTicketId(User $user)
    {
        $query = DB::connection()->prepare('SELECT MAX(id) FROM ticket WHERE user_id = :user_id');
        $query->execute(array('user_id' => $user->getId()));
        $result = $query->fetch();
        return $result[0];
    }

    /**
     * @param $id
     * @return Ticket|null
     */
    public function getTicketById($id)
    {
        $query = DB::connection()->prepare('SELECT * FROM ticket WHERE id = :id');
        $query->execute(array('id' => $id));
        $result = $query->fetch();
        $ticket = null;
        if ($result !== false) {
            $ticket = new Ticket($result);
        }
        return $ticket;
    }
}