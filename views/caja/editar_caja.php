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

$idcaja = $_REQUEST['idcaja'];
$Caja = new Caja($idcaja);
if (!$idcaja || !$Caja->isResponsable()) {
    return;
}

$params = [
    'baseUrl' => $ruta_db_superior,
    'countExpediente' => $Caja->countAllExpediente()
];
?>


<div class="card card-default">

    <div class="card-body">

        <form role="form" method="post" name="formularioCaja" id="formularioCaja">
            <div class="form-group">
                <label>Codigo *</label>
                <input type="text" class="form-control" name="codigo" id="codigo" value="<?=$Caja->codigo?>">
            </div>

            <div class="form-group" id="divTipoDisabled" style="display:none">
                <label>Tipo *</label>
                <span class="help">No se permite editar el tipo, tiene expedientes vinculados</span>
                <input type="text" disabled="true" class="form-control" value="<?= $Caja->getEstadoArchivo() ?>">
            </div>

            <div class="form-group" id="divTipo">
                <label>Tipo *</label>
                <select class="form-control" name="estado_archivo" id="estado_archivo">
                    <option value="">por favor seleccione</option>
                    <?= $Caja->getHtmlField('estado_archivo', 'select',$Caja->estado_archivo) ?>
                </select>
            </div>

            <div class="form-group">
                <label>Fondo</label>
                <input type="text" class="form-control" name="fondo" id="fondo" value="<?= $Caja->fondo ?>">
            </div>
            
            <div class="form-group">
                <label>Sección</label>
                <input type="text" class="form-control" name="seccion" id="seccion" value="<?= $Caja->seccion ?>">
            </div>

            <div class="form-group">
                <label>Subsección </label>
                <input type="text" class="form-control" name="subseccion" id="subseccion" value="<?= $Caja->subseccion ?>">
            </div>

            <div class="form-group">
                <label>División </label>
                <input type="text" class="form-control" name="division" id="division" value="<?= $Caja->division ?>">
            </div>

            <div class="form-group">
                <label>Módulo</label>
                <input type="text" class="form-control" name="modulo" id="modulo" value="<?= $Caja->modulo ?>">
            </div>

            <div class="form-group">
                <label>Panel</label>
                <input type="text" class="form-control" name="panel" id="panel" value="<?= $Caja->panel ?>">
            </div>

            <div class="form-group">
                <label>Nivel</label>
                <input type="text" class="form-control" name="nivel" id="nivel" value="<?= $Caja->nivel ?>">
            </div>


            <div class="form-group ocultar">
                <label>Material</label>
                <select class="form-control" name="material" id="material">
                    <option value="">por favor seleccione</option>
                    <?= $Caja->getHtmlField('material', 'select', $Caja->material) ?>
                </select>
            </div>

            <div class="form-group ocultar">
                <label>Seguridad</label>
                <select class="form-control" name="seguridad" id="seguridad">
                    <option value="">por favor seleccione</option>
                    <?= $Caja->getHtmlField('seguridad', 'select',$Caja->seguridad) ?>
                </select>
            </div>

            <div class="form-group">
                <input type="hidden" name="methodInstance" value="updateCajaCont">
                <input type="hidden" name="nameInstance" value="CajaController">
                <input type="hidden" name="setNull" value="1">
                <input type="hidden" name="idcaja" id="idcaja" value="<?=$idcaja?>">
                
                <button id="cancelarCaja" type="button" class="btn btn-danger">
                    Cancelar
                </button>
                <button id="acualizarCaja" type="submit" class="btn btn-complete">
                    Editar
                </button>
            </div>

        </form>
    </div>
</div>
<script id="scriptEditCaja" src="<?= $ruta_db_superior ?>views/caja/js/editar_caja.js" data-params='<?=json_encode($params)?>'></script>