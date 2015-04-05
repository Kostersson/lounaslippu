<?php
namespace Kostersson\Lounaslippu\Controller;

use Tsoha\View;
use Tsoha\BaseController;

class HelloWorldController extends BaseController{

    public static function index(){
        self::check_logged_in();
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox(){
        // Testaa koodiasi täällä
        echo 'Hello World!';
    }
}