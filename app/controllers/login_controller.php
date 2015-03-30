<?php
namespace Lounaslippu\Controller;

use Lounaslippu\Service\AuthenticationService;
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
        self::authenticationService->signIn("jaakko", "pekka");
        View::make('login.html');
    }

    public static function sandbox(){
        // Testaa koodiasi täällä
        echo 'Hello World!';
    }
}
