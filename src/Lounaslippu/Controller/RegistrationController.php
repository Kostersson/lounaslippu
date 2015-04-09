<?php
namespace Lounaslippu\Controller;

use Lounaslippu\Service\RegistrationService;
use Tsoha\View;


  class RegistrationController{

    private $registrationService;

    /**
     * RegistrationController constructor.
     * @param RegistrationService $registrationService
     */
    public function __construct(RegistrationService $registrationService)
    {
      $this->registrationService = $registrationService;
    }


    public static function showPageAction(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('registration.html');
    }

    public function registrateUserAction(){
      $errors = $this->registrationService->registrateNewUser();
      return View::make('registration.html', $errors);
    }


  }
