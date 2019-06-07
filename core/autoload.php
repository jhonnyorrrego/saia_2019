<?php
require_once __DIR__ . '/../define.php';
require_once RUTA_ABS_SAIA . 'vendor/autoload.php';

spl_autoload_register(function ($className) {
    $filename = $className . ".php";
    $sourceFolders = [
        'core',
        'models',
        'controllers'
    ];

    foreach ($sourceFolders as $folder) {
        $route = RUTA_ABS_SAIA . "{$folder}/{$filename}";
        if (is_file($route)) {
            require_once $route;
            return;
        }
    }

    //busca recursivamente en las subcarpetas
    foreach ($sourceFolders as $folder) {
        $directory = new RecursiveDirectoryIterator(RUTA_ABS_SAIA . $folder, RecursiveDirectoryIterator::SKIP_DOTS);
        $fileIterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);

        foreach ($fileIterator as $file) {
            if ($file->getFilename() === $filename) {
                require_once $file->getPathname();
                break 2;
                return;
            }
        }
    }
});

require_once RUTA_ABS_SAIA . 'db.php';
