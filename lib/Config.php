<?php

namespace lib;

class Config {

    private static $confPath = 'conf.php';

    private static function setConf($data) {
        $content = file_get_contents(self::$confPath);

        $lines = explode("\n", $content);

        $linesList = [];

        foreach ($lines as $line) {
            $lineData = explode(' ', $line);

            $key = trim($lineData[0]);

            if ($key && isset($data[$key])) {
                $line = $key . ' ' . $data[$key];
            }

            $linesList[] = $line;
        }

        $newContent = implode("\n", $linesList);
        
        file_put_contents(self::$confPath, $newContent);

        Application::$conf = array_merge(Application::$conf, $data);
    }

    public static function getConf() {
        $confContent = file_get_contents(self::$confPath);

        $confLines = explode("\n", $confContent);

        $conf = [];

        foreach ($confLines as $line) {
            if (trim($line) == '<?php') {
                continue;
            }

            if (trim($line) == '') {
                continue;
            }

            if (substr($line, 0, 1) == '#') {
                continue;
            }

            $lineParams = explode(' ', $line);

            if (!isset($lineParams[1])) {
                $lineParams[1] = '';
            }

            $conf[$lineParams[0]] = $lineParams[1];
        }
        
        return $conf;
    }

    public static function update() {
        $_GET['host'] = 'localhost';
        
        Application::$conf = array_merge(Application::$conf, $_GET);

        if (isset($_GET['password']) && Connection::connect()) {
            self::setConf($_GET);

            header('location: /');

            exit;
        }
    }
}
