<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

require_once $ruta_db_superior . "controllers/autoload.php";

$idexpediente = $_REQUEST['idexpediente'];
$Expediente = new Expediente($idexpediente);
if (!$idexpediente) {
    return;
}
$records = $Expediente->getExpedienteCierreFk();
$table = '';
if ($records) {
    foreach ($records as $instance) {
        $table .= <<<FINHTML
        <tr>
            <td>{$instance->fecha_accion}</td>
            <td>{$instance->getAccion()}</td>
            <td>{$instance->getFuncionario()}</td>
            <td>{$instance->observacion}</td>
        </tr>
FINHTML;
    }
} else {
    $table = '<tr><td colspan="4">SIN DATOS</td></tr>';
}

?>
<div class="row">
    <div class="col-12">
        <table class="table" id="tableInfoExp">
            <tr>
                <td>FECHA</td>
                <td>ACCIÓN</td>
                <td>FUNCIONARIO</td>
                <td>OBSERVACIÓN</td>
            </tr>
            <?= $table ?>
        </table>
    </div>
</div>