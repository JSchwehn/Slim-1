<?php
/**
 * Created by PhpStorm.
 * User: pm
 * Date: 17.05.15
 * Time: 19:19
 */

    require __DIR__.'/../../../vendor/autoload.php';


    $cfgDB = config()->db;
    $cfgLogFile = config()->log['file'];


    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    $log = new Logger('accessm');
    $log->pushHandler(new StreamHandler($cfgLogFile, Logger::WARNING));


    try {

        $dbh = new PDO($cfgDB['dsn'], $cfgDB['user'], $cfgDB['pass']);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        $log->addError($e->getMessage(), $cfgDB);
        die();

    }


    function config(){
        return codm\accessm\Config::getInstance();
    }

