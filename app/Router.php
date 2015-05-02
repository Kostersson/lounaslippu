<?php
namespace Lounaslippu;

use Slim\Slim;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Router
{
    /**
     * @var Slim
     */
    private $slim;


    /**
     * @param Slim $slim
     * @param ContainerBuilder $container
     */
    public function __construct(Slim $slim, ContainerBuilder $container)
    {
        $this->slim = $slim;
        $this->generate($container);
        $this->slim->run();
    }

    /**
     * Generates routes
     * @param $container
     */
    private function generate($container)
    {
        $this->slim->get('/', function () use ($container){
            $container->get('lounaslippu.controller.front_page')->showPageAction();
        });

        $this->slim->get('/lounasliput', function () use ($container){
            $container->get('lounaslippu.controller.ticket')->showPageAction();
        });
        $this->slim->get('/lounasliput/:id/lataa', function ($id) use ($container){
            $container->get('lounaslippu.controller.ticket')->downloadTicketsAction($id);
        });
        $this->slim->get('/lounasliput/peruuta/tilaus/:reference_number', function ($reference_number) use ($container){
            $container->get('lounaslippu.controller.ticket')->deleteOrderAction($reference_number);
        });
        $this->slim->get('/lounasliput/tilaus', function () use ($container){
            $container->get('lounaslippu.controller.ticket')->showOrderPageAction();
        });
        $this->slim->post('/lounasliput/tilaus/tilaa', function () use ($container){
            $container->get('lounaslippu.controller.ticket')->orderTickets();
        });
        $this->slim->get('/lounasliput/syotto', function () use ($container){
            $container->get('lounaslippu.controller.ticket')->showUsedTicketFormAction();
        });
        $this->slim->post('/lounasliput/syotto', function () use ($container){
            $container->get('lounaslippu.controller.ticket')->addUsedTicketAction();
        });

        $this->slim->get('/sisaankirjautuminen', function () use ($container){
            $container->get('lounaslippu.controller.login')->showPageAction();
        });
        $this->slim->post('/sisaankirjautuminen', function () use ($container){
            $container->get('lounaslippu.controller.login')->loginAction();
        });
        $this->slim->map('/uloskirjautuminen', function () use ($container){
            $container->get('lounaslippu.controller.login')->logoutAction();
        })->via('GET', 'POST');

        $this->slim->get('/rekisteroityminen', function () use ($container){
            $container->get('lounaslippu.controller.registration')->showPageAction();
        });
        $this->slim->post('/rekisteroityminen', function () use ($container){
            $container->get('lounaslippu.controller.registration')->registrateUserAction();
        });

        $this->slim->get('/maksut/syotto', function () use ($container){
            $container->get('lounaslippu.controller.payment.import')->showPageAction();
        });
        $this->slim->post('/maksut/syotto', function () use ($container){
            $container->get('lounaslippu.controller.payment.import')->importCsv();
        });

        $this->slim->get('/omat/tiedot', function () use ($container){
            $container->get('lounaslippu.controller.user')->showPageAction();
        });
        $this->slim->post('/omat/tiedot', function () use ($container){
            $container->get('lounaslippu.controller.user')->updateUserAction();
        });

        $this->slim->map('/api/validator/username', function () use ($container){
            $container->get('lounaslippu.api.controller.validator')->usernameValidation();
        })->via('GET', 'POST');

    }
}