<?php


    namespace codm\accessm;


    class App extends \Silex\Application {

        public function __construct(array $values = []){

            parent::__construct($values);

            //register Sliec Controller Service Provider
            $this->register(new \Silex\Provider\ServiceControllerServiceProvider());

            $this->register(new \Igorw\Silex\ConfigServiceProvider(__DIR__ . "/config.json"));


            //TODO: make it flexible for more than one log
            $this->register(new \Silex\Provider\MonologServiceProvider(), [
                    'monolog.logfile' => $this['config']['logfile']
                ]
            );

            if (
                empty($this['config']['db']['dsn']) OR
                empty($this['config']['db']['user']) OR
                !isset($this['config']['db']['pass'])
            ) {
                $this['monolog']->addCritical('database configuration incomplete');
                throw new \Exception('database configuration incomplete');
            }

            $this->register(
                new \Herrera\Pdo\PdoServiceProvider(),
                array(
                    'pdo.dsn' => $this['config']['db']['dsn'],
                    'pdo.username' => $this['config']['db']['user'],
                    'pdo.password' => $this['config']['db']['pass'],
                    'pdo.options' => [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                    ]
                )
            );

            $this['monolog']->addInfo('init app done');

        }

    }


