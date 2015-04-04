<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('test', new Routing\Route(
        '/test',
        array('_controller' => 'Lounaslippu\\Controller\\TestController::FooBarAction'))
);
return $routes;