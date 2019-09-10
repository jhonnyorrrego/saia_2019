<?php
require_once __DIR__ . '/define.php';
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
        if (findFile(RUTA_ABS_SAIA . $folder, $filename)) {
            return;
        }
    }
});

function findFile($dir, $className)
{
    $scan = scandir($dir, SCANDIR_SORT_NONE);
    foreach ($scan as $file) {
        $directory = $dir . '/' . $file;
        if (!is_dir($directory) || substr($file, 0, 1) == '.') {
            continue;
        }

        if (is_file($directory . '/' . $className)) {
            include_once $directory . '/' . $className;
            return true;
        }
        findFile($directory, $className);
    }
}

require_once RUTA_ABS_SAIA . 'db.php';
