<?php

    function autoload($className) {
        include str_replace('\\', '/', $className) . '.php';
    }

    spl_autoload_register('autoload');

    lib\Application::run();
