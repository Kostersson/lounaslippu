<?php
namespace Lounaslippu;

use Slim\Slim;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Router
{
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

        private function generate($container)
        {
                $this->slim->get('/', function () use ($container){
                        $container->get('lounaslippu.controller.front_page')->showPageAction();
                });

                $this->slim->get('/sisaankirjautuminen', function () use ($container){
                        $container->get('lounaslippu.controller.login')->showPageAction();
                });

                $this->slim->get('/rekisteroityminen', function () use ($container){
                        $container->get('lounaslippu.controller.registration')->showPageAction();
                });
        }
}