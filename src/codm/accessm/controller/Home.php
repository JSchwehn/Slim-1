<?php
/**
 * Created by PhpStorm.
 * User: pm
 * Date: 25.05.15
 * Time: 18:24
 */

    namespace codm\accessm\controller;

    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;

    class Home  {


        public function indexAction(Application $app, Request $req, $name = ''){

            return 'home controller';
        }

    }