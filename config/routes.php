<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/rekisteroityminen', function() {
    RegistrationController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});
