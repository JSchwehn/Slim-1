<?php
/**
 * Created by PhpStorm.
 * User: pm
 * Date: 17.05.15
 * Time: 19:19
 */

    require __DIR__.'/../../../vendor/autoload.php';

    $cfgDB = config()->db;

    try {
        $dbh = new PDO($cfgDB['dsn'], $cfgDB['user'], $cfgDB['pass']);
    } catch (PDOException $e) {
        //TODO: monolog cant connect DB
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }


    function config(){
        return codm\accessm\Config::getInstance();
    }

