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

include_once $ruta_db_superior . 'assets/librerias.php';
echo arboles_ft("2.24", 'filtro');
echo validate();

$params = [
    'baseUrl' => $ruta_db_superior
];

?>

<div class="container-fluid">
    <form id="formulario" name="formulario">

        <div class="row py-2">
            <div class="col-12">
                <label>Crear en:</label>
                <div id="treebox"></div>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-12">
                <button class="btn btn-complete float-right" type="submit" id="save">Continuar</button>
            </div>
        </div>
    </form>
</div>
<script id="scriptSeleccionar" src="<?= $ruta_db_superior ?>views/expediente/js/seleccionar.js" data-params='<?= json_encode($params) ?>'></script> 