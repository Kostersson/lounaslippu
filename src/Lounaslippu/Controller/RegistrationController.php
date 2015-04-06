<?php
namespace Lounaslippu\Controller;

use Tsoha\View;


  class RegistrationController{

    public static function showPageAction(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('registration.html');
    }


  }
