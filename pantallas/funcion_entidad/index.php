<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

if ($_REQUEST["guardar"] == 1) {
	$valid = busca_filtro_tabla("idfuncion_entidad_accion", "funcion_entidad_accion", "idfuncion_entidad=" . $_REQUEST["idfuncion_entidad"] . " and nombre_accion='" . $_REQUEST["nombre_accion"] . "' and nombre_tabla='" . $_REQUEST["nombre_tabla"] . "' and momento='" . $_REQUEST["momento"] . "'", "", $conn);
	if ($valid["numcampos"]) {
		notificaciones("La funcion ya fue vinculada", "warning", 5000);
	} else {
		$insert = "INSERT INTO funcion_entidad_accion (idfuncion_entidad,nombre_accion,nombre_tabla,momento,orden) VALUES (" . $_REQUEST["idfuncion_entidad"] . ",'" . $_REQUEST["nombre_accion"] . "','" . $_REQUEST["nombre_tabla"] . "','" . $_REQUEST["momento"] . "',1)";
		phpmkr_query($insert) or die("Error al guardar la informacion");
		notificaciones("Datos Guardados!", "success", 5000);
	}
}

$pantallas = array(
	"cargo" => "Cargos",
	"dependencia" => "Dependencias",
	"documento" => "Documento",
	"expediente" => "Expedientes",
	"funcionario" => "Funcionarios",
	"permiso" => "Permisos Funcionario",
	"permiso_perfil" => "Permisos Perfil",
	"dependencia_cargo" => "Roles",
	"serie" => "TRD"
);
$option = '<option value="">Seleccione</option>';
foreach ($pantallas as $key => $value) {
	if ($_REQUEST["nombre_tabla"] == $key) {
		$option .= '<option value="' . $key . '" selected>' . $value . '</option>';
	} else {
		$option .= '<option value="' . $key . '">' . $value . '</option>';
	}
}

$acciones = array(
	"ADICIONAR" => "Adicionar",
	"EDITAR" => "Editar",
	"ELIMINAR" => "Eliminar/Inactivar"
);
$option_accion = '<option value="">Seleccione</option>';
foreach ($acciones as $key => $value) {
	$option_accion .= '<option value="' . $key . '">' . $value . '</option>';
}

$funciones = busca_filtro_tabla("idfuncion_entidad,etiqueta,nombre_funcion", "funcion_entidad", "", "etiqueta asc", $conn);
$option_fun = '<option value="">Seleccione</option>';
if ($funciones["numcampos"]) {
	for ($i = 0; $i < $funciones["numcampos"]; $i++) {
		if($_REQUEST["idfuncion_entidad"]==$funciones[$i]["idfuncion_entidad"]){
			$option_fun .= '<option value="' . $funciones[$i]["idfuncion_entidad"] . '" selected>' . $funciones[$i]["etiqueta"] . ' - (' . $funciones[$i]["nombre_funcion"] . ')</option>';
		}else{
			$option_fun .= '<option value="' . $funciones[$i]["idfuncion_entidad"] . '">' . $funciones[$i]["etiqueta"] . ' - (' . $funciones[$i]["nombre_funcion"] . ')</option>';
		}
	}
}

include_once ($ruta_db_superior . "librerias_saia.php");
echo estilo_bootstrap();
echo librerias_jquery("1.8");
echo librerias_validar_formulario("11");
echo librerias_UI("1.12");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="container">
			<a href="funcion_entidad.php">Adicionar Funciones</a>
			<form id="form_entidad_accion" name="form_entidad_accion" method="post">
				<table class="table table-bordered" style="margin-top: 10px;">
					<tbody>
						<tr>
							<td><strong>PANTALLA</strong></td>
							<td>
							<select id="nombre_tabla" name="nombre_tabla">
								<?php echo $option; ?>
							</select></td>
						</tr>
						<tr>
							<td><strong>FUNCI&Oacute;N</strong></td>
							<td>
							<select id="idfuncion_entidad" name="idfuncion_entidad">
								<?php echo $option_fun; ?>
							</select></td>
						</tr>
						<tr>
							<td><strong>MOMENTO</strong></td>
							<td>
								<input type="radio" name="momento" value="ANTERIOR">ANTERIOR
								<input type="radio" name="momento" value="POSTERIOR" checked="true">POSTERIOR
								</td>
						</tr>
						<tr>
							<td><strong>ACCI&Oacute;N</strong></td>
							<td>
							<select id="nombre_accion" name="nombre_accion">
								<?php echo $option_accion; ?>
							</select></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<input type="hidden" name="guardar" value="1">
							<input type="submit" value="Adicionar" class="btn btn-mini btn-primary">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			<hr />
			<table class="table table-bordered table-hover" style="margin-top: 10px; display: none;" id="info_tabla">
				<thead>
					<tr>
					<th style="text-align:center">Nombre Funci&oacute;n</th>
					<th style="text-align:center">Acci&oacute;n</th>
					<th style="text-align:center">Momento</th>
					<th></th>
					</tr>
				</thead>
				<tfoot>
					<tr><td colspan="4" style="text-align: center"><div id="guardar_orden" class="btn btn-mini btn-primary">Guardar Orden</div></td></tr>
				</tfoot>
				
				<tbody id="datos_tabla">
				</tbody>
			</table>
		</div>
	
		<script type="text/javascript">
			$(document).ready(function() {
				
				$("#info_tabla tbody").sortable();
				$("#guardar_orden").click(function (){
					var sortedIDs = $( "#info_tabla tbody" ).sortable( "toArray" );
			    $.ajax({
			    	url : 'cargar_informacion.php',
			    	data:{ids:sortedIDs,opt:3},
			    	type : 'post',
			    	dataType:'json',
			    	async:false,
			    	success : function(data) {
			    		if(data.exito==1){
								top.noty({text:"Se ha guardado el orden", type:"success", layout:"topCenter", timeout:5000});
			    		}else{
			    			top.noty({text:"No se pudo actualizar el orden, intente de nuevo", type:"error", layout:"topCenter", timeout:3500});
			    		}
			    	},error:function (){
			    		top.noty({text:'Error al procesar la solicitud', type:"error", layout:"topCenter", timeout:3500});
			    	}
			    });
				});
				
				$("#nombre_tabla").change(function (){
					tabla=$(this).val();
					if(tabla!=""){
				    $.ajax({
				    	url : 'cargar_informacion.php',
				    	data:{nombre_tabla:tabla,opt:1},
				    	type : 'post',
				    	dataType:'json',
				    	async:false,
				    	success : function(data) {
				    		if(data.exito==1){
				    			$("#info_tabla").show();
				    			$("#datos_tabla").empty().append(data.html);
				    		}else{
				    			$("#info_tabla").hide();
				    		}
				    	},error:function (){
				    		top.noty({text:'Error al consultar la informacion de la pantalla', type:"error", layout:"topCenter", timeout:3500});
				    	}
				    });
					}else{
						$("#datos_tabla").empty();
						$("#info_tabla").hide();
					}
				});
				$("#nombre_tabla").trigger("change");
				
				
				$(".eli").live("click",function (){
					idfunc_accion=$(this).attr("id");
					if(idfunc_accion){
				    $.ajax({
				    	url : 'cargar_informacion.php',
				    	data:{id:idfunc_accion,opt:2},
				    	type : 'post',
				    	dataType:'json',
				    	async:false,
				    	success : function(data) {
				    		if(data.exito==1){
				    			$("#tr_"+idfunc_accion).remove();
				    			top.noty({text:"Accion eliminada!", type:"success", layout:"topCenter", timeout:5000});
				    		}else{
				    			top.noty({text:"Error, no se pudo eliminar!", type:"error", layout:"topCenter", timeout:5000});
				    		}
				    	},error:function (){
				    		top.noty({text:'Error al procesar la solicitud', type:"error", layout:"topCenter", timeout:5000});
				    	}
				    });
					}else{
						top.noty({text:"Error, no se encuentra el identificado!", type:"error", layout:"topCenter", timeout:5000});
					}
				});
								
				$("#form_entidad_accion").validate({
					rules : {
						nombre_tabla : {
							required : true
						},
						idfuncion_entidad : {
							required : true
						},
						momento : {
							required : true
						},
						nombre_accion : {
							required : true
						}
					}
				});
			});
		</script>
	</body>
</html>