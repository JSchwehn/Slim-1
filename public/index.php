<?php


if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    header('Content-type: text/html; charset=utf-8', true, 503);
    echo '<h2> Error </h2>';
    echo 'Did not find the autoloading file. Did you run the composer.phar install command?';
    return;
}
if (!file_exists(__DIR__ . '/../config/config.php')) {
    header('Content-type: text/html; charset=utf-8', true, 503);
    echo '<h2> Error </h2>';
    echo 'Did not find a valid config file. Did you forget to rename and change the config.dist.php file?';
    return;
}
if (version_compare(PHP_VERSION, '5.6.0', '<')) {
    header('Content-type: text/html; charset=utf-8', true, 503);
    echo '<h2> Error </h2>';
    echo 'Your PHP Version ' . PHP_VERSION . ' is to old and we are expect at least 5.6.0';
    return;
}

$environment = getenv('CODM_ENV') ?: 'production';
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


