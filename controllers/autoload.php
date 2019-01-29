<?php
require_once __DIR__ . '/../define.php';
require_once RUTA_ABS_SAIA . 'db.php';

spl_autoload_register(function ($className) {
    $modelRoute = RUTA_ABS_SAIA . "models/{$className}.php";
    if (is_file($modelRoute)) {
        require_once $modelRoute;
        return;
    }

    $controllerRoute = RUTA_ABS_SAIA . "controllers/{$className}.php";
    if (is_file($controllerRoute)) {
        require_once $controllerRoute;
        return;
    }

    //Si no encuentra la clase busca recursivamente en las carpetas models y controllers
    $directory = new RecursiveDirectoryIterator(RUTA_ABS_SAIA . 'models', RecursiveDirectoryIterator::SKIP_DOTS);
    $fileIterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);

    $filename = $className . ".php";
    foreach ($fileIterator as $file) {
        if (strtolower($file->getFilename()) === strtolower($filename)) {
            if ($file->isReadable()) {
                require_once $file->getPathname();
            }
            break;
            return;
        }
    }

    $directory = new RecursiveDirectoryIterator(RUTA_ABS_SAIA . 'controllers', RecursiveDirectoryIterator::SKIP_DOTS);
    $fileIterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);
    foreach ($fileIterator as $file) {
        if (strtolower($file->getFilename()) === strtolower($filename)) {
            if ($file->isReadable()) {
                require_once $file->getPathname();
            }
            break;
            return;
        }
    }
});