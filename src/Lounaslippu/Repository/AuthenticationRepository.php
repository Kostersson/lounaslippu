<?php
namespace Lounaslippu\Repository;

use Lounaslippu\Model\User;
use Tsoha\DB;

/**
 * Class AuthenticationRepository
 * @package Lounaslippu\Repository
 */
class AuthenticationRepository
{

    /**
     * @param $username
     * @param $password
     * @return User|null
     */
    public function getUserWithPassword($username, $password)
    {
        $query = DB::connection()->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute(array('email' => $username));
        $result = $query->fetch();
        $user = null;
        if ($result !== false) {
            if ($this->validatePassword($password, $result["password"])) {
                $user = new User($result);
            }
        }
        return $user;
    }

    /**
     * @param $password
     * @param $hash
     * @return bool
     */
    private function validatePassword($password, $hash)
    {
        return crypt($password, $hash) == $hash;
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getUsernamesByEmail($email)
    {
        $query = DB::connection()->prepare('SELECT email FROM users WHERE email = :email');
        $query->execute(array('email' => $email));
        return $query->fetch();
    }
}