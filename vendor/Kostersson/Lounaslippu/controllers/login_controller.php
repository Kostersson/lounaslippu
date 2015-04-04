<?php
namespace Kostersson\Lounaslippu\Controller;

use Kostersson\Lounaslippu\Service\AuthenticationService;
use Tsoha\View;
use Tsoha\BaseController;

class LoginController extends BaseController{

    private $authenticationService;

    function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }


    public static function index(){
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('login.html');
    }

    public static function login(){
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('login.html');
    }

    public static function sandbox(){
        // Testaa koodiasi täällä
        echo 'Hello World!';
    }
}
