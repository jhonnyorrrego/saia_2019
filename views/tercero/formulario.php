<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$params = json_encode([
    'baseUrl' => $ruta_db_superior
] + $_REQUEST);
?>


Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis ut quas quasi debitis, delectus exercitationem commodi inventore ratione, similique ex quidem molestias ipsam nulla nemo natus amet enim praesentium harum.

<script id="external_script" src="<?= $ruta_db_superior ?>views/tercero/js/formulario.js" data-params='<?= $params ?>'></script>