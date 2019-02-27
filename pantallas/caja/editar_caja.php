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

                    <div class="card card-default">
                        <div class="card-header ">
                            <div class="card-title">
                                EDITAR CAJA
                            </div>
                        </div>

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
                                    <input type="hidden" name="idcaja" value="<?=$idcaja?>">
                                    <input type="hidden" name="generarFiltro" value="1">
                                    <input type="hidden" id="idbusqueda_componente" name="idbusqueda_componente" value="<?= $_REQUEST['idbusqueda_componente'] ?>">
                                    <button id="acualizarCaja" type="submit" class="btn btn-primary">
                                        Actualizar
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

				</div>
			</div>
        </div>
    
        <script type="text/javascript">
            $(document).ready(function (){
                var params=<?= json_encode($params) ?>;
                if(params.countExpediente){
                    $("#divTipo").remove();
                    $("#divTipoDisabled").show();
                }
                $("#formularioCaja").validate({
					rules : {
						codigo : {
							required : true
						}
					},
					submitHandler : function(form) {
                        $("#acualizarCaja").attr('disabled',true);
                        var idcomponente=$("#idbusqueda_componente").val(); 
                        
                        $.ajax({
                            type : 'POST',
                            async : false,
                            url: `${params.baseUrl}pantallas/ejecutar_acciones.php`,
                            data : $("#formularioCaja").serialize(),
                            dataType : 'json',
                            success : function(objeto) {
                                if (objeto.exito) {
                                    $.ajax({
                                        type : 'POST',
                                        async : false,
                                        url: `${params.baseUrl}pantallas/busquedas/servidor_busqueda_exp.php`,
                                        data : {
                                            idbusqueda_componente : idcomponente,
                                            page : 1,
                                            rows : 1,
                                            actual_row : 0,
                                            cantidad_total : 1,
                                            idbusqueda_filtro_temp : objeto.data.idbusqueda_filtro_temp
                                        },
                                        dataType : 'json',
                                        success : function(objeto2) {
                                            if (objeto2.exito) {
                                                $("#resultado_pantalla_"+objeto2.rows[0].idcaja,parent.document).addClass("removeDiv");
                                                $(".removeDiv", parent.document).after(objeto2.rows[0].info);
                                                $(".removeDiv", parent.document).remove();
                                                $('#resultado_pantalla_'+objeto2.rows[0].idcaja, parent.document).addClass("alert-warning");
                                            }else{
                                                top.notification({
                                                    message : "Error al actualizar el listado, por favor actualice el listado",
                                                    type : "error",
                                                    duration : 3000
                                                });
                                            }
                                        },
                                        error : function() {
                                            top.notification({
                                                message : "Error al actualizar el listado, por favor actualice el listado.",
                                                type : "error",
                                                duration : 3000
                                            });
                                        }
                                    });
                                    top.notification({
                                        message : objeto.message,
                                        type : "success",
                                        duration : 3000
                                    });
                                    window.open("detalles_caja.php?idcaja=" + objeto.data.id + "&idbusqueda_componente=" + idcomponente + "&rand=" + Math.round(Math.random() * 100000), "_self");
                                } else {
                                    top.notification({
                                        message : objeto.message,
                                        type : "error",
                                        duration : 3000
                                    });
                                }
                            },
                            error : function() {
                                top.notification({
                                    message : "Error al procesar la solicitud (actualizar caja)",
                                    type : "error",
                                    duration : 3000
                                });
                            }
                        });
						return false;
					}
				});
            });
        </script>

    </body>           
</html>