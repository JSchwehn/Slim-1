<?php
/**
 * Created by PhpStorm.
 * User: pm
 * Date: 22.06.15
 * Time: 21:17
 */

namespace codm\Slim;


use Slim\Slim;

abstract class Model {

    protected $app = null;

    public function __construct(Slim $app=null){
        $this->app = $app;
    }


}