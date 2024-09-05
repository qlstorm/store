<?php

namespace lib;

class Application {
    
    public static $params = [];
    public static $conf = [];

    private static $controller = 'application';
    private static $configController = 'config';
    
    private static $container = '\\controllers\\';

    public static function run() {
        self::setParams();
        self::setConf();
        self::callController();
    }

    private static function callController() {
        $params = self::$params;

        if (isset(self::$params[0]) && self::$params[0] == self::$configController) {
            return Config::update();
        }

        if (isset(self::$params[0]) && isset(self::$params[1])) {
            if (method_exists(self::$container . self::$params[0], self::$params[1])) {
                array_shift($params);
                array_shift($params);

                return call_user_func_array(self::$container . self::$params[0] . '::' . self::$params[1], $params);
            }
        }
        
        if (isset(self::$params[0])) {
            if (method_exists(self::$container . self::$params[0], self::$params[0])) {
                array_shift($params);

                return call_user_func_array(self::$container . self::$params[0] . '::' . self::$params[0], $params);
            }

            if (method_exists(self::$container . self::$controller, self::$params[0])) {
                array_shift($params);

                return call_user_func_array(self::$container . self::$controller . '::' . self::$params[0], $params);
            }
        }

        call_user_func_array(self::$container . self::$controller . '::' . self::$controller, $params);
    }

    private static function setParams() {
        if (isset($_SERVER['PATH_INFO'])) {
            self::$params = explode('/', $_SERVER['PATH_INFO']);

            array_shift(self::$params);

            self::$params = array_filter(self::$params);
        }
    }

    private static function setConf() {
        self::$conf = Config::getConf();
    }
}
