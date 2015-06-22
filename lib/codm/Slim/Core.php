<?php
/**
 * Created by PhpStorm.
 * User: pm
 * Date: 22.06.15
 * Time: 19:38
 */


namespace codm\Slim;

use Slim\Slim;

class Core extends Slim {

    public function __construct($config){

        parent::__construct($config);

        $this->initApp();


        return $this;
    }

    /**
     * initialise slimcore's app environment
     */
    private function initApp(){

        //db
        $this->container->singleton('dbh', function ($c) {
            return $this->initDB($c);
        });

        //monolog
        $this->container->singleton('log', function ($c) {
            $log = new \Monolog\Logger($c->settings['app.name']);
            $log->pushHandler(new \Monolog\Handler\StreamHandler('../logs/app.log', \Monolog\Logger::DEBUG));
            return $log;
        });

    }

    /**
     * initiate the PDO database connection
     *
     * @param $slimContainer
     * @return \PDO
     */
    private function initDB($slimContainer) {

        $s = $slimContainer['settings'];

        try {
            return new \PDO('mysql:host='.$s['db.host'].';dbname='.$s['db.name'].';charset='.$s['db.charset'], $s['db.user'], $s['db.pass'], [
                \PDO::ATTR_ERRMODE               => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE    => \PDO::FETCH_ASSOC
            ]);

        } catch (\PDOException $e) {
            $slimContainer['log']->critical($e->getMessage());
            throw $e;
        }

    }

    public function getController($ControllerName) {
        // returns controller with app and stuff
        return new $ControllerName($this);
    }


}
