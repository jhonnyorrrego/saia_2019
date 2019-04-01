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
echo fancyTree(true);
echo bootstrapTable ();
echo validate();
?>

<div class="container-fluid">
    <form id="formulario" name="formulario">
        <div class="row">
            <div class="col-12 py-2">
                <table id="table" data-selections=""></table>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-12">
                <label>Clasificar en:</label>
                <div id="treebox"></div>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-12">
                <button class="btn btn-complete float-right" id="save">Guardar</button>
            </div>
        </div>
    </form>
</div>
<script id="scriptClasificar" src="<?= $ruta_db_superior ?>views/expediente/js/clasificar_expediente.js" data-params='<?=json_encode(explode(',',$_REQUEST['selections']))?>'></script>