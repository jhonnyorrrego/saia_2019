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

require_once $ruta_db_superior . "core/autoload.php";

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

$params = [
	'idexpediente' => $idexpediente,
	'baseUrl' => $ruta_db_superior
];
?>
<div class="row">
    <div class="col-12">               
        <?php if ($Expediente->isResponsable()) : ?>
            <form role="form" name="formCierre" id="formCierre">
                <div class="form-group form-group-default input-group">
                    <div class="form-input-group">
                        <label>Observaciones</label>
                        <input type="text" class="form-control" name="observacion" id="observacion" required="true">
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text btn btn-complete" id="guardarHistorial">
                                <?php if($Expediente->estado_cierre==2):?>
                                <i class="fa fa-folder-open"></i>
                            <?php else: ?>
                                <i class="fa fa-folder"></i>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            </form>
        <?php endif; ?>                   
    </div>
</div>
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
<script id="scriptHistorial" src="<?= $ruta_db_superior ?>views/expediente/js/historial_cierre.js" data-params='<?=json_encode($params)?>'></script>