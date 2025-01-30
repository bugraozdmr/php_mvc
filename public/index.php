<?php
/* User: Grant ... */

// call this one once in the whole app
require_once __DIR__."/../vendor/autoload.php";

// which classes I need
use app\core\Application;
use app\controllers\SiteController;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/contact', [SiteController::class, 'contact']);

$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->run();