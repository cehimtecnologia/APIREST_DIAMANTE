<?php

use DI\Container;
use DI\Bridge\Slim\Bridge as SlimAppFactory;
use Selective\BasePath\BasePathMiddleware;

$container = new Container();
$app = SlimAppFactory::create($container);

$app->add(new BasePathMiddleware($app));

$settings = require_once __DIR__.'/settings.php'; $settings($container);
$middleware = require_once __DIR__.'/middleware.php'; $middleware($app);

$router = require_once __DIR__.'/../app/Router/LoginRouter.php'; $router($app);
$router = require_once __DIR__.'/../app/Router/AdminRouter.php'; $router($app);