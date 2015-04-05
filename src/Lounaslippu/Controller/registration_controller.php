<?php
namespace Kostersson\Lounaslippu\Controller;

use Tsoha\View;
use Tsoha\BaseController;

  class RegistrationController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('registration.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      echo 'Hello World!';
    }
  }
