<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

$route = "{$ruta_db_superior}views/visor/{$_REQUEST['viewer']}?" . http_build_query($_REQUEST);
?>

<iframe src="<?= $route ?>" frameborder="no" width="100%"></iframe> 