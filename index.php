<?php

require_once 'config/config.php';

// Laitetaan virheilmoitukset näkymään
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Selvitetään, missä kansiossa index.php on
$script_name = $_SERVER['SCRIPT_NAME'];
$explode =  explode('/', $script_name);

if($explode[1] == 'index.php'){
    $base_folder = '';
}else{
    $base_folder = "/" . $explode[1];
}

// Määritetään sovelluksen juuripolulle vakio BASE_PATH
define('BASE_PATH', '' . $base_folder);



// Asetetaan vastauksen Content-Type-otsake, jotta ääkköset näkyvät normaalisti
header('Content-Type: text/html; charset=utf-8');

// Otetaan Composer käyttöön
require_once 'vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__));
$loader->load('config/services.yml');

// Luodaan uusi tai palautetaan olemassaoleva sessio
if(session_id() == '') {
    session_start();
}

$routes = new \Slim\Slim();
$router = new Lounaslippu\Router($routes, $container);