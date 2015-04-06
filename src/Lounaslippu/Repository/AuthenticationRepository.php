<?php
namespace Lounaslippu\Repository;

use Tsoha\DB;
class AuthenticationRepository{

    public function getUserWithPassword($username, $password){

        $query = DB::connection()->prepare('SELECT FROM `users` WHERE email = ":email" AND password = ":password"');
        $query->execute(array('email' => $username, 'password' => $password));
        die(var_dump(DB::connection(), $query->fetchAll()));
        return $query->fetchAll();
    }
}