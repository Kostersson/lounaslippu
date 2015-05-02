<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 10.4.2015
 * Time: 0:51
 */

namespace Lounaslippu\Repository;

use Lounaslippu\Model\User;
use Tsoha\BaseModel;
use Tsoha\DB;

/**
 * Class UserRepository
 * @package Lounaslippu\Repository
 */
class UserRepository extends EntityRepository
{

    /**
     * @param User $user
     * @param $email
     * @return mixed
     */
    public function getEmailsExceptUser(User $user, $email)
    {
        $query = DB::connection()->prepare('SELECT email FROM users WHERE email = :email AND id <> :user_id');
        $query->execute(array('email' => $email, 'user_id' => $user->getId()));
        return $query->fetch();
    }

}