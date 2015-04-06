<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('test', new Routing\Route(
        '/test',
        array('_controller' => 'Lounaslippu\\Controller\\TestController::FooBarAction'))
);
$routes->add('index', new Routing\Route(
        '/',
        array('_controller' => 'lounaslippu.controller.front_page:showPageAction'))
);

$routes->add('login', new Routing\Route(
        '/sisaankirjautuminen',
        array('_controller' => 'Lounaslippu\\Controller\\LoginController::showPageAction'))
);

$routes->add('registration', new Routing\Route(
        '/rekisteroityminen',
        array('_controller' => 'Lounaslippu\\Controller\\RegistrationController::showPageAction'))
);

return $routes;