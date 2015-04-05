<?php

namespace Lounaslippu\Controller;

use Symfony\Component\HttpFoundation\Response;

class TestController {

    public function FooBarAction(){
        return new Response(\Tsoha\View::make('registration.html'));
    }
}