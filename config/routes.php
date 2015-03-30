<?php
use Lounaslippu\Controller\HelloWorldController;
use Lounaslippu\Controller\RegistrationController;
use Lounaslippu\Controller\LoginController;

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/rekisteroityminen', function() {
    RegistrationController::index();
});
$routes->get('/sisaankirjautuminen', function() {
    LoginController::index();
});
$routes->post('/sisaankirjautuminen', function() {
    LoginController::login();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});
