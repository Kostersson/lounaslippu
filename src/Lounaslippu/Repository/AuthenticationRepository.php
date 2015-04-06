<?php
namespace Lounaslippu\Repository;

use Tsoha\DB;
class AuthenticationRepository{

    public function getUserWithPassword($username, $password){
        $query = DB::connection()->prepare('SELECT FROM users WHERE email = :email AND password = :password');
        $query->execute(array('email' => "Pekka@testi.com", 'password' => "Pekka"));
        die(var_dump($query->fetchAll()));
        return $query->fetchAll();
    }
}