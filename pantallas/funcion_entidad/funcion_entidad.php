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

if ($_REQUEST["guardar"]) {
	$parametros = "";
	$param = array();
	$i = 0;
	foreach ($_POST as $key => $value) {
		if (strpos($key, "parnom") !== false) {
			$exp = explode("_", $key);
			$param[$i]["nombre"] = $value;
			$param[$i]["tipo"] = $_POST["partip_" . $exp[1]];
			$i++;
		}
	}
	if (count($param)) {
		$parametros = json_encode($param);
	}

	switch ($_REQUEST["guardar"]) {
		case '1' :
			$valid = busca_filtro_tabla("idfuncion_entidad", "funcion_entidad", "nombre_funcion='" . $_REQUEST["nombre_funcion"] . "'", "", $conn);
			if (!$valid["numcampos"]) {
				$insert = "INSERT INTO funcion_entidad (nombre_funcion,parametros,etiqueta,ruta) VALUES ('" . $_REQUEST["nombre_funcion"] . "','" . $parametros . "','" . $_REQUEST["etiqueta"] . "','" . $_REQUEST["ruta"] . "')";
				phpmkr_query($insert) or die("Error al guardar la informacion");
				$id = phpmkr_insert_id();
				notificaciones("Datos Guardados!", "success", 5000);
			} else {
				$id = $valid[0]["idfuncion_entidad"];
				notificaciones("El nombre de la funcion ya existe", "warning", 5000);
			}
			redirecciona("index.php?idfuncion_entidad=" . $id);
			break;
		case '2' :
			$update = "UPDATE funcion_entidad SET nombre_funcion='" . $_REQUEST["nombre_funcion"] . "',parametros='" . $parametros . "',etiqueta='" . $_REQUEST["etiqueta"] . "',ruta='" . $_REQUEST["ruta"] . "' WHERE idfuncion_entidad=" . $_REQUEST["idfuncion"];
			phpmkr_query($update) or die("Error al actualizar los datos de la funcion");
			notificaciones("Datos actualizados", "success", 5000);
			redirecciona("funcion_entidad.php");
			break;
	}

}

$idfuncion = 0;
$array_edit = array(
	"nombre_funcion" => "",
	"etiqueta" => "",
	"ruta" => "",
	"guardar" => "1",
	"button" => "Guardar"
);
$param = "";
if ($_REQUEST["idedit"] != "") {
	$idfuncion = $_REQUEST["idedit"];
	$camp_edit = busca_filtro_tabla("", "funcion_entidad", "idfuncion_entidad=" . $_REQUEST["idedit"], "", $conn);
	if ($camp_edit["numcampos"]) {
		$array_edit = $camp_edit[0];
		$array_edit["guardar"] = 2;
		$array_edit["button"] = "Editar";
		$parametros = json_decode($camp_edit[0]["parametros"], true);
		$cant = count($parametros);
		if ($cant) {
			$array = array(
				"constante" => "Constante",
				"variable" => "Variable",
				"request" => "Request"
			);
			for ($i = 0; $i < $cant; $i++) {
				$option = "";
				foreach ($array as $key => $value) {
					if ($key == $parametros[$i]["tipo"]) {
						$option .= '<option value="' . $key . '" selected>' . $value . '</option>';
					} else {
						$option .= '<option value="' . $key . '">' . $value . '</option>';
					}
				}
				$param .= '<tr id="tr_par_' . $i . '"><td style="text-align:center"><input class="required" type="text" name="parnom_' . $i . '" value="' . $parametros[$i]["nombre"] . '"/></td> <td style="text-align:center"><select class="required" name="partip_' . $i . '">' . $option . '</select></td> <td style="text-align:center"><div class="btn btn-mini eli" id="' . $i . '"><i class="icon-remove"></i></div></td></tr>';
			}
		}
	}
}

$funciones = busca_filtro_tabla("", "funcion_entidad", "", "etiqueta asc", $conn);
$table = '';
if ($funciones["numcampos"]) {
	$table = '<table id="list_func" class="table table-bordered table-hover" style="display:none">
		<thead>
		<tr>
		<th style="text-align:center">Nombre Funci&oacute;n</th>
		<th style="text-align:center">Etiqueta</th>
		<th style="text-align:center">Ubicaci&oacute;n Archivo</th>
		<th style="text-align:center">Parametros</th>
		<th></th>
		</tr>
	</thead>';
	for ($i = 0; $i < $funciones["numcampos"]; $i++) {
		$table .= '<tr id="tr_func_' . $funciones[$i]["idfuncion_entidad"] . '">
			<td>' . $funciones[$i]["nombre_funcion"] . '</td>
			<td>' . $funciones[$i]["etiqueta"] . '</td>
			<td>' . $funciones[$i]["ruta"] . '</td>
			<td>' . $funciones[$i]["parametros"] . '</td>
			<td style="text-align:center">
				<div class="btn btn-mini eli_func" id="' . $funciones[$i]["idfuncion_entidad"] . '"><i class="icon-remove"></i></div> 
				<a class="btn btn-mini" href="funcion_entidad.php?idedit=' . $funciones[$i]["idfuncion_entidad"] . '"><i class="icon-edit"></i></div>
			</td>
		</tr>';
	}
	$table .= '</table>';
}

include_once ($ruta_db_superior . "librerias_saia.php");
echo estilo_bootstrap();
echo librerias_jquery("1.8");
echo librerias_validar_formulario("11");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="container">
			<a class="a_show">Listar Funciones</a>
			<a class="a_hide" style="display: none">Ocultar Tabla</a>
			<?php echo $table;?>
			<div>
			<form id="form_funcion" name="form_funcion" method="post">
				<table class="table table-bordered" style="margin-top: 10px;">
					<tbody>
						<tr>
							<td><strong>NOMBRE FUNCI&Oacute;N</strong></td>
							<td>
								<input type="text" name="nombre_funcion" id="nombre_funcion" value="<?php echo $array_edit["nombre_funcion"];?>" />
							</td>
						</tr>
						<tr>
							<td><strong>ETIQUETA</strong></td>
							<td>
								<input type="text" name="etiqueta" id="etiqueta" value="<?php echo $array_edit["etiqueta"];?>"/>
							</td>
						</tr>
						<tr>
							<td><strong>UBICACI&Oacute;N ARCHIVO</strong></td>
							<td>
								<input type="text" name="ruta" id="ruta" value="<?php echo $array_edit["ruta"];?>"/>
							</td>
						</tr>
						<tr>
							<td><strong>PARAMETROS</strong></td>
							<td>
								<table class="table table-bordered">
									<tr><th style="text-align:center">Nombre</td> <th style="text-align:center">Tipo</td><td></td></tr>
										<tbody id="tbody">
											<?php echo $param;?>
										</tbody>
									<tr><td colspan="3" style="text-align:center"><div class="btn btn-mini btn-info">Nuevo</div></td></tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center">
								<input type="hidden" name="idfuncion" value="<?php echo $idfuncion;?>">
							<input type="hidden" name="guardar" value="<?php echo $array_edit["guardar"];?>">
							<input type="submit" value="<?php echo $array_edit["button"];?>" class="btn btn-mini btn-primary">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				
				$(".a_show,.a_hide").click(function (){
					if($(this).is(".a_hide")){
						$(this).hide();
						$("#list_func").hide();
						$(".a_show").show();
					}else{
						$(this).hide();
						$("#list_func,.a_hide").show();
					}
				});
				
				$(".eli_func").live("click",function (){
					if(confirm("Esta seguro de Eliminar?")===true){
						var idfunc=$(this).attr("id");
				    $.ajax({
				    	url : 'cargar_informacion.php',
				    	data:{idfuncion:idfunc,opt:4},
				    	type : 'post',
				    	dataType:'json',
				    	async:false,
				    	success : function(data) {
				    		if(data.exito==1){
									top.noty({text:"Se ha eliminado la funcion", type:"success", layout:"topCenter", timeout:5000});
									$("#tr_func_"+idfunc).remove();
				    		}else{
				    			top.noty({text:data.msn, type:"error", layout:"topCenter", timeout:3500});
				    		}
				    	},error:function (){
				    		top.noty({text:'Error al procesar la solicitud', type:"error", layout:"topCenter", timeout:3500});
				    	}
				    });
					}
				});
				
				$(".btn-info").live("click",function (){
					cant=$('#tbody > tr').length;
					html='<tr id="tr_par_'+cant+'"><td style="text-align:center"><input class="required" type="text" name="parnom_'+cant+'"/></td> <td style="text-align:center"><select class="required" name="partip_'+cant+'"><option value="constante">Constante</option> <option value="variable">Variable</option> <option value="request">Request</option></select></td> <td style="text-align:center"><div class="btn btn-mini eli" id="'+cant+'"><i class="icon-remove"></i></div></td></tr>';
					$("#tbody").append(html);
				});
							
				$(".eli").live("click",function (){
					idfunc=$(this).attr("id");
					$("#tr_par_"+idfunc).remove();
				});
				
				$("#form_funcion").validate({
					rules : {
						nombre_funcion : {
							required : true
						},
						etiqueta : {
							required : true
						},
						ruta : {
							required : true
						}
					}
				});
			});
		</script>
	</body>
</html>