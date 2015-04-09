<?php
namespace Lounaslippu\Repository;

use Lounaslippu\Model\UserModel;
use Tsoha\DB;
class AuthenticationRepository{

    public function getUserWithPassword($username, $password){
        $query = DB::connection()->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute(array('email' => $username));
        $result = $query->fetch();
        $user = null;
        if($result !== false){
            if($this->validatePassword($password, $result["password"])) {
                $user = new UserModel($result);
            }
        }
        return $user;
    }

    private function validatePassword($password, $hash)
    {
        return crypt($password, $hash) == $hash;
    }

    public function getUsernamesByEmail($email){
        $query = DB::connection()->prepare('SELECT email FROM users WHERE email = :email');
        $query->execute(array('email' => $email));
        return $query->fetch();
    }
}