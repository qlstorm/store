<?php

error_reporting(E_ALL);

mysqli_report(MYSQLI_REPORT_OFF);

function autoload($class) {
    include str_replace('\\', '/', $class) . '.php';
}

spl_autoload_register('autoload');

lib\Application::run();
