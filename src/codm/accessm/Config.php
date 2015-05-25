<?php
/**
 * Created by PhpStorm.
 * User: pm
 * Date: 17.05.15
 * Time: 19:20
 */

namespace codm\accessm;

use Monolog\Logger;

class Config {

    protected $values = [
        'db'    => [
            'dsn'       => 'mysql:localhost;dbname=accessm',
            'user'      => 'webdev',
            'pass'      => ''
        ],
        'log'   => [
            [
                'level'     => Logger::INFO,
                'handler'   => 'Monolog\Handler\StreamHandler',
                'stream'    => '/var/www/accessm/accessm.log'
            ],
            [
                'level'     => Logger::WARNING,
                'handler'   => 'Monolog\Handler\StreamHandler',
                'stream'    => 'php://output'
            ]
        ]
    ];

    private static $instance = null;

    private function __construct( array $dataOverride = [] ) {

        $this->values['app_root'] = realpath(__DIR__.'/../../../').'/';
        $this->values['web_root'] = $this->values['app_root'].'public/';

        $this->values = array_merge($this->values, $dataOverride);
    }

    public static function getInstance( array $dataOverride = [] ){

        if( !is_null(self::$instance) ){
            return self::$instance;
        }

        self::$instance = new Config($dataOverride);
        return self::$instance;

    }

    public function __get($key){

        if(isset($this->values[$key])){
            return $this->values[$key];
        }

        //TODO: log access to undefined config variable
        return false;
    }

    public function __set($key, $value){
        $this->values[$key] = $value;
        return $this;
    }


}