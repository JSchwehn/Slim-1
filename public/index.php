<?php

require '../vendor/autoload.php';

$config = require(__DIR__ . '/../config/config.php');

// Prepare app
try {

    $app = new \codm\Slim\Core($config);


    /*
    // Prepare view
    $app->view(new \Slim\Views\Twig());
    $app->view->parserOptions = array(
        'charset' => 'utf-8',
        'cache' => realpath('../templates/cache'),
        'auto_reload' => true,
        'strict_variables' => false,
        'autoescape' => true
    );
    $app->view->parserExtensions = array(new \Slim\Views\TwigExtension());
    */



    $routers = glob('../routers/*.router.php');
    foreach ($routers as $router) {
        require $router;
    }


    // Run app
    $app->run();



} catch (\Exception $e) {

    //debug only
    die($e->getMessage());

    die('show stopper, check log file!');

}


