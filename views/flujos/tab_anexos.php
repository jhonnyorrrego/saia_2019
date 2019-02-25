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

$idactividad = null;
//$tipo_destinatario = TipoDestinatario::TIPO_EXTERNO;
if (!empty($_REQUEST["idactividad"])) {
    $idactividad = $_REQUEST["idactividad"];
}

?>

<div class="row mx-0">
    <div class="col-12" id="anexos_actividad"></div>
</div>

<?= dropzone() ?>
<?= bootstrapTable() ?>
<?= bootstrapTableEditable() ?>
<script src="<?= $ruta_db_superior ?>views/flujos/js/anexos_actividad.js"></script>
