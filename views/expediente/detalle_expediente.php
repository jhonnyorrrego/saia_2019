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
if (!$idexpediente) {
    return;
}

$Expediente=new Expediente($idexpediente);
$fecExtIni = '';
if ($Expediente->fecha_extrema_i) {
    $fecExtIni = DateController::convertDate($Expediente->fecha_extrema_i, 'Y-m-d');
}
$fecExtFin = '';
if ($Expediente->fecha_extrema_f) {
    $fecExtFin = DateController::convertDate($Expediente->fecha_extrema_f, 'Y-m-d');
}

$params=[
    'idexpediente'=>$idexpediente,
    'baseUrl'=>$ruta_db_superior
];
?>
<div class="row mx-0">
    <div class="col-12">
        <div class="cursor">
            <i data-table="tableInfoExp" class="fa fa-plus-square inf"></i> Información
            <?php if($Expediente->isResponsable() && !$Expediente->nucleo): ?>
                <div class="float-right">
                    <button class="btn btn-info" id="editExp"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-info" id="rotExp"><i class="fa fa-print"></i></button>
                </div>
            <?php endif; ?>
        </div>

        <?php if($Expediente->agrupador==1):?>
            <!-- DEPENDENCIA -->
            <table class="table" id="tableInfoExp">
                <tr>
                    <td>Nombre de la dependencia:</td>
                    <td><?= $Expediente->nombre ?></td>
                </tr>
                <tr>
                    <td>Codigo:</td>
                    <td><?= $Expediente->codigo_numero ?></td>
                </tr>
            </table>
        <?php elseif ($Expediente->agrupador == 2) : ?>
        <!-- SERIE -->
            <table class="table" id="tableInfoExp">
                <tr>
                    <td>Nombre de la serie:</td>
                    <td><?= $Expediente->nombre ?></td>
                </tr>
                <tr>
                    <td>Codigo:</td>
                    <td><?= $Expediente->codigo_numero ?></td>
                </tr>
            </table>
        <?php elseif ($Expediente->agrupador == 3) : ?>
            <!-- SEPARADOR -->
            <table class="table" id="tableInfoExp">
                <tr>
                    <td>Nombre del separador:</td>
                    <td><?= $Expediente->nombre ?></td>
                </tr>
                <tr>
                    <td>No de expedientes:</td>
                    <td><?= $Expediente->countExpediente(0) ?></td>
                </tr>
            </table>
        <?php else: ?>
            <!-- EXPEDIENTE -->
            <table class="table" id="tableInfoExp">
                <tr>
                    <td>Nombre del expediente:</td>
                    <td><?= $Expediente->nombre ?></td>
                </tr>
            <tr>
                    <td>Fecha creación: </td>
                    <td><?= $Expediente->fecha ?></td>
                </tr>

            <tr>
                    <td>Creador: </td>
                    <td><?= $Expediente->getPropietario() ?></td>
                </tr>

                <tr>
                    <td>Responsable: </td>
                    <td>
                        <?= $Expediente->getResponsable() ?>
                    </td>
                </tr>

                <tr>
                    <td>Descripción:</td>
                    <td><?= $Expediente->descripcion ?></td>
                </tr>

                <tr>
                    <td>Indice uno:</td>
                    <td><?= $Expediente->indice_uno ?></td>
                </tr>

                <tr>
                    <td>Indice dos:</td>
                    <td><?= $Expediente->indice_dos ?></td>
                </tr>

                <tr>
                    <td>Indice tres:</td>
                    <td><?= $Expediente->indice_tres ?></td>
                </tr>

                <tr>
                    <td>Vinculado a la Caja:</td>
                    <td><?= $Expediente->getCaja() ?></td>
                </tr>

                <tr>
                    <td>
                        Cierre y apertura:<br/>
                    </td>
                    <td>
                        Estado: <?= $Expediente->getEstadoCierre() ?><br/>
                        <?php if($Expediente->estado_cierre==2):?>
                        Funcionario: <?= $Expediente->getRelationFk('Funcionario','funcionario_cierre')->getName() ?><br/>
                        Fecha: <?= $Expediente->fecha_cierre ?><br/>
                        <?php endif; ?>                                    
                    </td>
                </tr>
                <?php if($Expediente->estado_cierre==2):?>
                    <tr>
                        <td>Alerta de retención:</td>
                        <td><?= $Expediente->infoRetencion() ?></td>
                    </tr>
                <?php endif; ?>
            </table>

            <div class="cursor">
                <i data-table="tableInfoAdicional" class="fa fa-minus-square inf"></i> Información adicional
            </div>

            <table class="table" id="tableInfoAdicional">
                <tr>
                    <td>Codigo número:</td>
                    <td><?= $Expediente->codigo_numero ?></td>
                </tr>

                <tr>
                    <td>Fondo:</td>
                    <td><?= $Expediente->fondo ?></td>
                </tr>

                <tr>
                    <td>Proceso:</td>
                    <td><?= $Expediente->proceso ?></td>
                </tr>

                <tr>
                    <td>Fecha extrema inicial:</td>
                    <td><?= $fecExtIni ?></td>
                </tr>

                <tr>
                    <td>Fecha Extrema final:</td>
                    <td><?= $fecExtFin ?></td>
                </tr>

                <tr>
                    <td>Unidad de conservación:</td>
                    <td><?= $Expediente->no_unidad_conservacion ?></td>
                </tr>

                <tr>
                    <td>No de folios:</td>
                    <td><?= $Expediente->no_folios ?></td>
                </tr>


                <tr>
                    <td>No de carpeta:</td>
                    <td><?= $Expediente->no_carpeta ?></td>
                </tr>

                <tr>
                    <td>Soporte:</td>
                    <td><?= $Expediente->getSoporte() ?></td>
                </tr>

                <tr>
                    <td>Frecuencia:</td>
                    <td><?= $Expediente->getFrecuenciaConsulta() ?></td>
                </tr>

                <tr>
                    <td>Notas de transferencia:</td>
                    <td><?= $Expediente->notas_transf ?></td>
                </tr>
            </table>

            <div class="cursor">
                <i data-table="tableInfoContenido" class="fa fa-minus-square inf"></i> Información de contenido
            </div>

            <table class="table" id="tableInfoContenido">
                <tr>
                    <td>No de documentos:</td>
                    <td><?= $Expediente->countDocuments() ?></td>
                </tr>

                <tr>
                    <td>No de expedientes:</td>
                    <td><?= $Expediente->countExpediente(0) ?></td>
                </tr>

                <tr>
                    <td>No de separadores:</td>
                    <td><?= $Expediente->countExpediente(3) ?></td>
                </tr>

                <tr>
                    <td>Consecutivo inicial:</td>
                    <td><?= $Expediente->consecutivo_inicial ?></td>
                </tr>

                <tr>
                    <td>Consecutivo final:</td>
                    <td><?= $Expediente->consecutivo_final ?></td>
                </tr>


                <tr>
                    <td>Tomo:</td>
                    <td><?= $Expediente->tomo_no ?> de <?= $Expediente->countTomos() ?></td>
                </tr>
            </table>
        <?php endif;?>
    </div>
</div>
<script data-params='<?=json_encode($params)?>'>
$(document).ready(function () {
    var params2 = JSON.parse($('script[data-params]').attr('data-params'));

    $(".inf").click(function (e) {
        let table = $(this).data("table");
        let icon = $(this).hasClass("fa-plus-square");
        if (icon) {
            $(this).removeClass("fa-plus-square").addClass("fa-minus-square");
            $("#" + table).show();
        } else {
            $(this).removeClass("fa-minus-square").addClass("fa-plus-square");
            $("#" + table).hide();
        }
    });
    $(".inf").trigger("click");

    $("#editExp").click(function (e) { 
      let options = {
        url: `${params2.baseUrl}views/expediente/editar_expediente.php`,
        params: {
            idexpediente:params2.idexpediente
        }, 
        size: "modal-lg",
        title: "EDITAR EXPEDIENTE/SEPARADOR",
        centerAlign: false,
        buttons: {}
      };
      top.topModal(options);
        
    });
});
</script>