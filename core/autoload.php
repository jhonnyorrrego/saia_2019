<?php

spl_autoload_register(function ($className) {
    $coreRoute = __DIR__ . '/' . $className . '.php';
    if (is_file($coreRoute)) {
        require_once $coreRoute;
        return;
    }
});