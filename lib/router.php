<?php
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

$route = new Route('/foo', array('controller' => 'MyController'));
$routes = new RouteCollection();
$routes->add('route_name', $route);

$context = new RequestContext();
$context->fromRequest(Request::createFromGlobals());

$matcher = new UrlMatcher($routes, $context);

$parameters = $matcher->match('/foo');
// array('controller' => 'MyController', '_route' => 'route_name')