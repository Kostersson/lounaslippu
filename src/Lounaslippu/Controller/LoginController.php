<?php
namespace Lounaslippu\Controller;

use Lounaslippu\Service\AuthenticationService;
use Symfony\Component\HttpFoundation\Response;
use Tsoha\View;


class LoginController {

    private $authenticationService;

    /**
     * @param AuthenticationService $authenticationService
     */
    function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }


    public  function showPageAction(){
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        return new Response(View::make('login.html'));
    }

}
