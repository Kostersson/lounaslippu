<?php

// Laitetaan virheilmoitukset näkymään
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Selvitetään, missä kansiossa index.php on
$script_name = $_SERVER['SCRIPT_NAME'];
$explode =  explode('/', $script_name);

if($explode[1] == 'index.php'){
    $base_folder = '';
}else{
    $base_folder = $explode[1];
}

// Määritetään sovelluksen juuripolulle vakio BASE_PATH
define('BASE_PATH', '/' . $base_folder);

// Luodaan uusi tai palautetaan olemassaoleva sessio
if(session_id() == '') {
    session_start();
}

// Asetetaan vastauksen Content-Type-otsake, jotta ääkköset näkyvät normaalisti
header('Content-Type: text/html; charset=utf-8');

// Otetaan Composer käyttöön
require_once 'vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Lounaslippu\AppKernel;
use Symfony\Component\HttpFoundation\Request;

// Ladataan reitit
$locator = new FileLocator(array(__DIR__));
$loader = new YamlFileLoader($locator);
$routes = $loader->load('config/routes.yml');

$app = new AppKernel($routes);

$request = Request::createFromGlobals();
$app->handle($request)->send();