<?php
require_once $ruta_db_superior . 'db.php';

spl_autoload_register(function ($className) {
    global $ruta_db_superior;

    $modelRoute = $ruta_db_superior . 'models/' . $className . '.php';

    if (is_file($modelRoute)) {
        require_once $modelRoute;
        return;
    } else {
        $controllerRoute = $ruta_db_superior . 'controllers/' . $className . '.php';
        if (is_file($controllerRoute)) {
            require_once $controllerRoute;
            return;
        }
    }

    //Si no encuentra la clase busca recursivamente en las carpetas models y controllers
    $directory = new RecursiveDirectoryIterator($ruta_db_superior . 'models', RecursiveDirectoryIterator::SKIP_DOTS);
    $fileIterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);

    $filename = $className . ".php";
    $loaded = false;
    foreach ($fileIterator as $file) {
        if (strtolower($file->getFilename()) === strtolower($filename)) {
            if ($file->isReadable()) {
                require_once $file->getPathname();
                $loaded = true;
            }
            break;
        }
    }

    if (!$loaded) {
        $directory = new RecursiveDirectoryIterator($ruta_db_superior . 'controllers', RecursiveDirectoryIterator::SKIP_DOTS);
        $fileIterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);
        foreach ($fileIterator as $file) {
            if (strtolower($file->getFilename()) === strtolower($filename)) {
                if ($file->isReadable()) {
                    require_once $file->getPathname();
                    $loaded = true;
                }
                break;
            }
        }
    }
});
