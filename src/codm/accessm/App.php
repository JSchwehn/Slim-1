<?php


    namespace codm\accessm;

    use Monolog\Logger;

    class App extends \Klein\App {

        public function __construct(){

            //register the config
            $this->register('config', function(){
                return Config::getInstance();
            });

            $this->register('log', function(){

                $myLog = new Logger('accessm');

                //register all handlers from config
                if(is_array($this->config->log) AND count($this->config->log)){

                    foreach($this->config->log AS $elem){

                        if(!empty($elem['stream']) AND !empty($elem['handler'])){
                            //TODO: Catch Monolog Exceptions
                            $myLog->pushHandler(new $elem['handler'](
                                    $elem['stream'],
                                    (!empty($elem['level'])) ? $elem['level'] : Logger::WARNING)
                            );
                        }
                    }
                }

                return $myLog;

            });

            //register database connection
            $this->register('db', function() {

                $db_cfg = $this->config->db;

                //TODO: check if config values for DB are present
                try {

                    $myDB = new \PDO($db_cfg['dsn'], $db_cfg['user'], $db_cfg['pass'], [
                        \PDO::ATTR_ERRMODE               => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE    => \PDO::FETCH_ASSOC
                    ]);

                    $this->log->addInfo('registered database connection: ', [$db_cfg['dsn']]);

                    return $myDB;

                } catch (\PDOException $e) {
                    $this->log->addError($e->getMessage(), $db_cfg);
                    return false;
                }

            });



            $this->log->addInfo('init app done');

        }

    }


