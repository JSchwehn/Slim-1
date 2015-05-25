<?php
/**
 * Created by PhpStorm.
 * User: pm
 * Date: 17.05.15
 * Time: 19:15
 */


    require __DIR__ . '/../vendor/autoload.php';

    try {

        $app = new \codm\accessm\App();
        $app['debug'] = true;


        $app['controller.home'] = $app->share(function() {
            return new \codm\accessm\controller\Home();
        });


        //$app->get('/', '\\codm\\accessm\\controller\\Home::indexAction');
        $app->get('/{name}', 'controller.home:indexAction');
        //$app->get('/{name}', $app['controller.home']->indexAction());

        $app->run();


    } catch(\Exception $e) {
        die($e->getMessage());
    }





