<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 9.4.2015
 * Time: 23:56
 */

namespace Lounaslippu\Controller;


use Lounaslippu\Service\RegistrationService;
use Slim\Slim;

class ValidatorController {

    /**
     * @var Slim
     */
    private $slim;

    /**
     * @var RegistrationService
     */
    private $registrationService;

    /**
     * ValidatorController constructor.
     * @param Slim $slim
     * @param RegistrationService $registrationService
     */
    public function __construct(Slim $slim, RegistrationService $registrationService)
    {
        $this->slim = $slim;
        $this->registrationService = $registrationService;
    }

    public function usernameValidation()
    {
        if (isset($_GET["email"])) {
            if(!$this->registrationService->validateUsername($_GET["email"])){
                $this->slim->response()->status(400);
                return;
            }
        }
        $this->slim->response()->status(200);

    }
}