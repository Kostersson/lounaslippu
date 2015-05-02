<?php
namespace Lounaslippu\Controller;

use Lounaslippu\Service\RegistrationService;
use Tsoha\View;


/**
 * Class RegistrationController
 * @package Lounaslippu\Controller
 */
class RegistrationController
{

    /**
     * @var RegistrationService
     */
    private $registrationService;

    /**
     * RegistrationController constructor.
     * @param RegistrationService $registrationService
     */
    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }


    /**
     * Generates registration form
     */
    public static function showPageAction()
    {
        View::make('registration.html');
    }

    /**
     * Register new user
     */
    public function registrateUserAction()
    {
        $errors = $this->registrationService->registrateNewUser();
        return View::make('registration.html', $errors);
    }


}
