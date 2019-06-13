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


$idexpediente = $_REQUEST["idexpediente"];
if (!$idexpediente) {
    return false;
}

$Expediente = new Expediente($idexpediente);

$okAddAcciones = 0;
$okPermisoAdd = $Expediente->getAccessUser('a');
if ($Expediente->nucleo) {
    if ($Expediente->estado_cierre == 1) {
        if ($Expediente->fk_serie) {
            $Serie = $Expediente->getRelationFk('Serie');
            if ($Serie->tipo == 2) {
                $okAddAcciones = 1;
            } elseif ($Serie->tipo == 1) {
                $cant = $Serie->getChildren(false, 1, 2);
                if (!count($cant)) {
                    $okAddAcciones = 1;
                }
            }
        }
    }
} else {
    $okAddAcciones = 1;
}
if (!$okAddAcciones) {
    return false;
}
?>
<div class="row w-100 mx-0 bg-info text-white my-auto">
    <div class="col-auto mr-auto text-left pr-0 pl-2 my-auto">
        <!--span class="fa fa-arrow-left pr-3 cursor" style="font-size:20px" id="uncheck_list"></span>
        <span id="selected_rows" style="font-size:20px"></span-->
    </div>

    <div class="col-auto text-right px-0 my-auto">
        <?php if ($okPermisoAdd) : ?>
        <div class="btn-group dropleft" data-toggle="tooltip" title="Adicionar">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-plus" style="font-size:20px"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#" id="addExpediente" data-id="<?= $idexpediente ?>"><i class="fa fa-folder"></i> Expediente</a>
                <?php if (!$Expediente->agrupador) : ?>
                <a class="dropdown-item" href="#" id="addDocumentExp" data-id="<?= $idexpediente ?>"><i class="fa fa-file-text"></i> Documento</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!--div class="btn-group dropleft" data-toggle="tooltip" title="Acciones">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-ellipsis-v" style="font-size:20px"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#"><i class="fa fa-share"></i> Transferir a</a>
                <a class="dropdown-item" href="#"><i class="fa fa-share-alt"></i> Compartir</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"><i class="fa fa-recycle"></i> Mover a la papelera</a>
            </div>
        </div-->
    </div>

</div> 