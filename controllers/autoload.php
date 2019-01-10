<?php
require_once $ruta_db_superior . 'db.php';

spl_autoload_register(function ($className) {
    global $ruta_db_superior;

    $modelRoute = $ruta_db_superior . 'models/' . $className .'.php';
    
    if(is_file($modelRoute)){
        require_once $modelRoute;
    }else{
        $controllerRoute = $ruta_db_superior . 'controllers/' . $className . '.php';
        
        if(is_file($controllerRoute)){
            require_once $controllerRoute;
        }
    }
});