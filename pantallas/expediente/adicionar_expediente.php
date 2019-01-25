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

$idexpediente=$_REQUEST['idexpediente'];
if(!$idexpediente){
    return ;
}

//TODO: PENDIENTE DE VALIDAR
$cajas = busca_filtro_tabla("distinct a.idcaja,a.no_consecutivo", "caja a,entidad_caja e", "a.idcaja=e.caja_idcaja and e.estado=1 and ((e.entidad_identidad=1 and e.llave_entidad=" . $_SESSION["idfuncionario"] . ") or a.funcionario_idfuncionario=" . $_SESSION["idfuncionario"] . ")", "", $conn);
$option_cajas = '<option value="">Por favor seleccione...</option>';
for ($i = 0; $i < $cajas["numcampos"]; $i++) {
    $selected = "";
    if ($_REQUEST["fk_idcaja"] == $cajas[$i]["idcaja"]) {
        $selected = "selected";
    }
    $option_cajas .= "<option value='" . $cajas[$i]["idcaja"] . "' " . $selected . ">" . $cajas[$i]["no_consecutivo"] . "</option>";
}

include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . "librerias_saia.php";
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
		<?= librerias_validar_formulario() ?>
	</head>

	<body>
		<div class="container m-0 p-0 mw-100 mx-100">
			<div class="row mx-0">
				<div class="col-12">

                    <div class="card card-default">
                        <div class="card-header ">
                            <div class="card-title">
                                CREAR EXPEDIENTE/SEPARADOR
                            </div>
                        </div>

                        <div class="card-body">
    
                            <form role="form" method="post" action="ejecutar_acciones.php" name="formularioExp" id="formularioExp">
                                <div class="form-group required">
                                    <label>Tipo *</label>
                                    <div class="radio radio-info">
                                        <input type="radio" checked="checked" value="0" name="agrupador" id="AgExp">
                                        <label for="AgExp">Expediente</label>
                                        <input type="radio"  value="no" name="agrupador" id="AgAgr">
                                        <label for="AgAgr">Separador</label>
                                    </div>
                                </div>

                                <div class="form-group required">
                                    <label>Nombre *</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre">
                                </div>

                                <div class="form-group">
                                    <label>Fecha Creación *</label>
                                    <span class="help">e.j. "<?= date("d/m/Y"); ?>"</span>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?=date("d/m/Y");?>">
                                </div>

                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label>Indice uno </label>
                                    <input type="text" class="form-control" name="indice_uno" id="indice_uno">
                                </div>

                                <div class="form-group">
                                    <label>Indice dos </label>
                                    <input type="text" class="form-control" name="indice_dos" id="indice_dos">
                                </div>

                                <div class="form-group">
                                    <label>Indice tres </label>
                                    <input type="text" class="form-control" name="indice_tres" id="indice_tres">
                                </div>


                                <div class="form-group">
                                    <label>Caja</label>
                                    <select class="form-control" name="fk_caja" id="fk_caja">
                                         <?= $option_cajas; ?>
                                    </select>
                                </div>

                                <hr/>

                                <div class="form-group">
                                    <label>Codigo numero</label>
                                    <span class="help">e.j. "Código Dependencia - Código Serie - Numero"</span>
                                    <input type="text" class="form-control" name="codDependencia" id="codDependencia" disabled="">
                                    <input type="text" class="form-control" name="CodSerie" id="CodSerie" disabled="">
                                    <input type="text" class="form-control" name="codigo_numero" id="codigo_numero">
                                </div>

                                <div class="form-group">
                                    <label>Fondo</label>
                                    <input type="text" class="form-control" name="fondo" id="fondo">
                                </div>

                                <div class="form-group">
                                    <label>Proceso</label>
                                    <input type="text" class="form-control" name="proceso" id="proceso">
                                </div>

                                <div class="form-group">
                                    <label>Fecha extrema inicial</label>
                                    <input type="date" class="form-control" id="fecha_extrema_i" name="fecha_extrema_i">
                                </div>

                                <div class="form-group">
                                    <label>Fecha extrema final</label>
                                    <input type="date" class="form-control" id="fecha_extrema_f" name="fecha_extrema_f">
                                </div>

                                <div class="form-group">
                                    <label>Consecutivo inicial</label>
                                    <input type="text" class="form-control" name="consecutivo_inicial" id="consecutivo_inicial">
                                </div>

                                <div class="form-group">
                                    <label>Consecutivo final</label>
                                    <input type="text" class="form-control" name="consecutivo_final" id="consecutivo_final">
                                </div>

                               <div class="form-group">
                                    <label>Unidad de conservación</label>
                                    <input type="text" class="form-control" name="no_unidad_conservacion" id="no_unidad_conservacion">
                                </div>


                               <div class="form-group">
                                    <label>No de folios</label>
                                    <input type="text" class="form-control" name="no_folios" id="no_folios">
                                </div>

                               <div class="form-group">
                                    <label>No de carpeta</label>
                                    <input type="text" class="form-control" name="no_carpeta" id="no_carpeta">
                                </div>

                               <div class="form-group">
                                    <label>Soporte</label>
                                    <select class="form-control" name="soporte" id="soporte">
                                        <option value="">por favor seleccione</option>
                                        <option value="1">CD-ROM</option>
                                        <option value="2">DISKETE</option>
                                        <option value="3">DVD</option>
                                        <option value="4">DOCUMENTO</option>
                                        <option value="5">FAX</option>
                                        <option value="6">REVISTA O LIBRO</option>
                                        <option value="7">VIDEO</option>
                                        <option value="8">OTROS ANEXOS</option>
                                    </select>
                                </div>

                               <div class="form-group">
                                    <label>Frecuencia</label>
                                    <select class="form-control" name="frecuencia_consulta" id="frecuencia_consulta">
                                        <option value="">por favor seleccione</option>
                                        <option value="1">Alta</option>
                                        <option value="2">Media</option>
                                        <option value="3">Baja</option>
                                    </select>
                                </div>

                               <div class="form-group">
                                    <label>Notas de transferencia</label>
                                    <textarea class="form-control" name="notas_transf" id="notas_transf"></textarea>                                    
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="methodExp" value="createExpedienteCont">
                                    <input type="hidden" name="generarfiltro" value="1">
                                    <input type="hidden" name="cod_padre" value="<?= $idexpediente ?>">
                                    <input type="hidden" name="idbusqueda_componente" value="<?=$_REQUEST['idbusqueda_componente']?>">
                                    <button id="guardarExp" type="submit" class="btn btn-primary">
                                        Adicionar
                                    </button></td>
                                </div>

                            </form>
                        </div>
                    </div>

				</div>
			</div>
        </div>
    
        <script type="text/javascript">
            $(document).ready(function (){

            });
        </script>

    </body>           
</html>