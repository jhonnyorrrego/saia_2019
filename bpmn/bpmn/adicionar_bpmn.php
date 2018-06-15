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
include_once ($ruta_db_superior . "bpmn/bpmn/librerias.php");

include($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("x_idbpmn");
desencriptar_sqli('form_info');
echo(librerias_jquery());

$x_idbpmn = Null;
$x_nombre = Null;
$x_descripcion = Null;
$x_archivo_bpmn = Null;

$sAction = @$_POST["a_add"];
if ($sAction == "A") {
	$retorno = AddData();
	if ($retorno["exito"]) {// Add New Record
		notificaciones("Datos Guardados", "success", 5000);
		abrir_url($ruta_db_superior . "pantallas/buscador_principal.php?idbusqueda=23", "centro");
		die();
	} else {
		notificaciones($retorno["msn"], "error", 5000);
	}
}

function AddData($conn) {
	$retorno = array(
		"exito" => 0,
		"msn" => ""
	);
	$ok = 0;
	if (is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
		$nombre_file = $_FILES["imagen"]["name"];
		$extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
		$archivo = uniqid() . "." . $extension;
		$almacenamiento = new SaiaStorage("bpmn");
		$resultado = $almacenamiento -> copiar_contenido_externo($_FILES['imagen']['tmp_name'], $archivo);
		if ($resultado) {
			$dir_bpmn = array(
				"servidor" => $almacenamiento -> get_ruta_servidor(),
				"ruta" => $archivo
			);
			
			$fieldList["tamano"] = $_FILES["imagen"]["size"];
			$fieldList2["fileName"] = "'" . json_encode($dir_bpmn) . "'";
			$fieldList2["fileSize"] = $_FILES["imagen"]["size"];
			$fieldList2["type"] = "'" . $extension . "'";
			@unlink($_FILES["imagen"]["tmp_name"]);
			$ok = 1;
		}
	}

	if ($ok) {
		$hoy=date("Y-m-d H:i:s");
		$fieldList["title"] = "'" . htmlentities($_POST["x_nombre"]) . "'";
		$fieldList["description"] = "'" . htmlentities($_POST["x_descripcion"]) . "'";
		$fieldList["createdDate"] = fecha_db_almacenar($hoy, 'Y-m-d H:i:s');
		$fieldList["lastUpdate"] = fecha_db_almacenar($hoy, 'Y-m-d H:i:s');
		$fieldList2["lastUpdate"] = fecha_db_almacenar($hoy, 'Y-m-d H:i:s');
		$fieldList["hash"] = "'" . generateRandom(6) . "'";
		$fieldList["publico"] = '1';

		$strsql = "INSERT INTO diagram(";
		$strsql .= implode(",", array_keys($fieldList));
		$strsql .= ")VALUES(";
		$strsql .= implode(",", array_values($fieldList));
		$strsql .= ")";
		phpmkr_query($strsql);
		$id = phpmkr_insert_id();
		if ($id) {
			$retorno["msn"] = "Error al guardar la informacion (Diagramdata)";
			$sql2 = "INSERT INTO diagramdata(" . implode(",", array_keys($fieldList2)) . ", diagramId) VALUES (" . implode(",", array_values($fieldList2)) . ", " . $id . ")";
			phpmkr_query($sql2) or die($retorno);
			$retorno["exito"] = 1;
			$retorno["msn"] = "";
		} else {
			$retorno["msn"] = "Error al guardar la informacion (Diagram)";
			$delete = $almacenamiento -> eliminar($dir_bpmn["ruta"]);
		}

	} else {
		$retorno["msn"] = "No se pudo guardar el archivo " . $nombre_file;
	}

	return $retorno;
}

include_once ($ruta_db_superior . "header.php");
include_once ($ruta_db_superior . FORMATOS_SAIA."librerias/header_formato.php");

echo estilo_bootstrap();
echo librerias_jquery("1.8");
echo librerias_validar_formulario("11");
?>

<p>
	<span class="internos">ADICIONAR BPMN</span>
</p>
<form name="bpmnadd" id="bpmnadd" action="<?php echo($ruta_db_superior); ?>bpmn/bpmn/adicionar_bpmn.php" method="post"  enctype="multipart/form-data">
	<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
			<td class="encabezado" title="Nombre del nuevo bpmn"><span class="phpmaker" style="color: #FFFFFF;">Nombre*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="">
			</span></td>
		</tr>
		<tr>
			<td class="encabezado" title="Descripcion del nuevo bpmn"><span class="phpmaker" style="color: #FFFFFF;">Descripcion</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> 				<textarea name="x_descripcion" id="x_descripcion" style="width:200px;height:50px" ></textarea> </span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Archivo bpmn*</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type=file name='imagen' id='imagen' >
			</span></td>
		</tr>
		<tr>
			<td colspan="2">
			<input type="hidden" name="a_add" value="A">
			<input type="submit" name="Action" value="Adicionar" class="btn btn-mini btn-primary">
			</td>
		</tr>
	</table>
</form>

<script src="<?php echo $ruta_db_superior; ?>js/additional-methods.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#bpmnadd").validate({
			rules : {
				x_nombre : {
					required : true
				},
				imagen : {
					required : true,
					extension : "bpmn"
				}
			},
			messages : {
				x_nombre : "Por favor ingrese un nombre valido",
				imagen : {
					required : "Por favor ingrese el archivo bpmn",
					extension : "Extensi&oacute;n no valida (bpmn)"
				}
			}
		});
	}); 
</script>
<?php encriptar_sqli("bpmnadd",1,"form_info",$ruta_db_superior);?>