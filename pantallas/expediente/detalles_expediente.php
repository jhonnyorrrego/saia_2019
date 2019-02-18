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
if (!$idexpediente) {
    return;
}

$Expediente=new Expediente($idexpediente);
$fecExtIni = '';
if ($Expediente->fecha_extrema_i) {
    $fecExtIni = DateController::convertDate($Expediente->fecha_extrema_i, 'Y-m-d H:i:s', 'Y-m-d');
}
$fecExtFin = '';
if ($Expediente->fecha_extrema_f) {
    $fecExtFin = DateController::convertDate($Expediente->fecha_extrema_f, 'Y-m-d H:i:s', 'Y-m-d');
}

$params=[
    'idexpediente'=>$idexpediente,
    'baseUrl'=>$ruta_db_superior
];


include_once $ruta_db_superior . 'assets/librerias.php';
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>SAIA - SGDEA</title>
		<?= jquery() ?>
		<?= bootstrap() ?>
		<?= theme() ?>
        <?= icons() ?>
        <?= validate() ?>
	</head>

	<body>
		<div class="container m-0 p-0 mw-100 mx-100">
			<div class="row mx-0">
				<div class="col-12">
                    <div>
                        <i data-table="tableInfoExp" class="fa fa-plus-square inf"></i> Información
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
                                    <?= $Expediente->getResponsable() ?><br/>
                                    <?php if($Expediente->isResponsable()):?>
                                        <button class="btn btn-info" id="openModal"><i class="fa fa-user"></i></button>
                                    <?php endif;?>
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
                                    Estado: <?= $Expediente->getEstadoCierre() ?><br/>
                                    <?php if($Expediente->estado_cierre==2):?>
                                    Funcionario: <?= $Expediente->getRelationFk('Funcionario','funcionario_cierre')->getName() ?><br/>
                                    Fecha: <?= $Expediente->fecha_cierre ?><br/>
                                    <?php endif; ?>                                    
                                </td>
                                <td>
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
                                    <a href="#" id="openModalCierre">Historial de apertura/cierre <i class="fa fa-link"></i> </a>
                                </td>
                            </tr>
                            <?php if($Expediente->estado_cierre==2):?>
                                <tr>
                                    <td>Alerta de retención:</td>
                                    <td><?= $Expediente->infoRetencion() ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>

                        <div>
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

                        <div>
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
        </div>
    
        <script type="text/javascript">
            $(document).ready(function (){
                var params=<?=json_encode($params)?>;

                $("#openModal").click(function (){
                    let options = {
                        url: `${params.baseUrl}pantallas/expediente/cambiar_responsable.php`,
                        params: {
                            idexpediente:params.idexpediente
                        }, 
                        size: "modal-lg",
                        title: "Actualizar responsable",
                        centerAlign: false,
                        buttons: {}
                    };
                    top.topModal(options);
                });

                $("#openModalCierre").click(function (){
                    let options = {
                        url: `${params.baseUrl}pantallas/expediente/historial_cierre.php`,
                        params: {
                            idexpediente:params.idexpediente
                        }, 
                        size: "modal-lg",
                        title: "Historial de apertura y cierre del expediente",
                        centerAlign: false,
                        buttons: {}
                    };
                    top.topModal(options);
                });

                $("#guardarHistorial").click(function(){
                    if($(this).attr("disable")!="disabled"){
                        $("#formCierre").submit();
                    }
                })
                $("#formCierre").validate({
					rules : {
						observacion : {
							required : true
						}
					},
					submitHandler : function(form) {
                        $("#guardarHistorial").attr('disabled',true);
                        $.ajax({
                            type : 'POST',
                            async : false,
                            url: `${params.baseUrl}pantallas/ejecutar_acciones.php`,
                            data: {nameInstance:'ExpedienteController',methodInstance:'aperturaCierreExpedienteCont',idexpediente:params.idexpediente,observacion:$("#observacion").val()},
                            dataType : 'json',
                            success : function(response) {
                                if (response.exito) {
                                 top.notification({
                                        message : "Expediente actualizado!",
                                        type : "success",
                                        duration : 3000
                                    });
                                }else{
                                    top.notification({
                                        message : response.message,
                                        type : "warning",
                                        duration : 3000
                                    });
                                }
                            },
                            error : function() {
                                top.notification({
                                    message : "Error al procesar la solicitud",
                                    type : "error",
                                    duration : 3000
                                });
                            }
                        });
                        window.location.reload();
                    }
                });


                $(".inf").click(function (e) {
                    let table=$(this).data("table"); 
                    let icon=$(this).hasClass("fa-plus-square");
                    if(icon){
                        $(this).removeClass("fa-plus-square").addClass("fa-minus-square");
                        $("#"+table).show();
                    }else{
                        $(this).removeClass("fa-minus-square").addClass("fa-plus-square");
                        $("#"+table).hide();
                    }                  
                });
                $(".inf").trigger("click");
            });
        </script>

    </body>           
</html>