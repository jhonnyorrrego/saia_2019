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
desencriptar_sqli('form_info');
echo(librerias_jquery());

$sAction = @$_POST["a_edit"];
$id = intval($_REQUEST["idbpmn"]);
if ($sAction == "U") {
	$x_idbpmn = @$_POST["id"];
	$x_nombre = @$_POST["x_nombre"];
	$x_descripcion = @$_POST["x_descripcion"];
	$x_ruta_archivo = @$_POST["x_ruta_archivo"];

	$retorno = EditData();
	if ($retorno["exito"]) {
		notificaciones("Datos Actualizados", "success", 5000);
		abrir_url($ruta_db_superior . "bpmn/procesar_bpmn.php?idbpmn=" . $x_idbpmn . "&vista_bpmn=1", "_self");
		die();
	} else {
		notificaciones($retorno["msn"], "error", 5000);
		die();
	}
} else {
	$retorno = LoadData($id);
	if (!$retorno["exito"]) {
		notificaciones($retorno["msn"], "error", 5000);
	}
}

function LoadData($sKey) {
	global $x_idbpmn, $x_nombre, $x_descripcion, $x_archivo_bpmn, $x_ruta_archivo, $conn;
	$retorno = array(
		"exito" => 0,
		"msn" => ""
	);
	$datos = busca_filtro_tabla("id,title,description,fileName", "diagram a, diagramdata b", "a.id=b.diagramId AND a.id=" . $sKey, "", $conn);
	if ($datos["numcampos"]) {
		$x_idbpmn = $datos[0]["id"];
		$x_nombre = $datos[0]["title"];
		$x_descripcion = $datos[0]["description"];
		$x_ruta_archivo = base64_encode($datos[0]["fileName"]);
		$x_archivo_bpmn = "filesystem/mostrar_binario.php?ruta=" . $x_ruta_archivo;
		$retorno["exito"] = 1;
	} else {
		$retorno["msn"] = "Error al consultar la informacion";
	}
	return $retorno;
}

function EditData() {
	global $x_idbpmn, $x_nombre, $x_descripcion, $x_ruta_archivo, $conn;
	$retorno = array(
		"exito" => 0,
		"msn" => ""
	);
	$hoy = date("Y-m-d H:i:s");
	$fieldList["title"] = "'" . htmlentities($x_nombre) . "'";

	$fieldList["description"] = "'" . htmlentities($x_descripcion) . "'";
	$fieldList["lastUpdate"] = fecha_db_almacenar($hoy, 'Y-m-d H:i:s');
	$fieldList2["lastUpdate"] = fecha_db_almacenar($hoy, 'Y-m-d H:i:s');

	$ruta_anexo = base64_decode($x_ruta_archivo);
	$array_ruta = json_decode($ruta_anexo, true);

	$adicional = "";
	if (is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
		$nombre_file = $_FILES["imagen"]["name"];
		$extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
		$archivo = uniqid() . "." . $extension;
		$almacenamiento = new SaiaStorage("bpmn");
		$resultado = $almacenamiento -> copiar_contenido_externo($_FILES['imagen']['tmp_name'], $archivo);
		if ($resultado) {
			if ($array_ruta["ruta"] != "") {
				$delete = $almacenamiento -> eliminar($array_ruta["ruta"]);
			}
			$dir_bpmn = array(
				"servidor" => $almacenamiento -> get_ruta_servidor(),
				"ruta" => $archivo
			);
			$ruta_anexo = json_encode($dir_bpmn);

			$fieldList["tamano"] = $_FILES["imagen"]["size"];
			$fieldList2["fileSize"] = $_FILES["imagen"]["size"];
			$fieldList2["type"] = "'" . $extension . "'";
			@unlink($_FILES["imagen"]["tmp_name"]);

			$adicional = ",tamano=" . $fieldList["tamano"];
		}
	}
	$fieldList2["fileName"] = "'" . $ruta_anexo . "'";

	$strsql = "UPDATE diagram SET title=" . htmlentities($fieldList["title"]) . ", description=" . htmlentities($fieldList["description"]) . ", lastUpdate=" . $fieldList["lastUpdate"] . $adicional . " WHERE id=" . $x_idbpmn;
	phpmkr_query($strsql) or die("Error al actualizar (Diagram)");

	if ($adicional != "") {
		$sql2 = "UPDATE diagramdata SET type=" . $fieldList2["type"] . ", fileName='" . $ruta_anexo . "', fileSize=" . $fieldList2["fileSize"] . ", lastUpdate=" . $fieldList2["lastUpdate"] . " WHERE diagramId=" . $x_idbpmn;
		phpmkr_query($sql2) or die("Error al actualizar");
	}
	$retorno["exito"] = 1;
	return $retorno;
}

include_once ($ruta_db_superior . "header.php");
include_once ($ruta_db_superior . FORMATOS_SAIA . "librerias/header_formato.php");
echo estilo_bootstrap();
echo librerias_jquery("1.8");
echo librerias_validar_formulario("11");
?>
<p>
	<span class="internos">EDITAR BPMN</span>
</p>
<form name="bpmnedit" id="bpmnedit" action="<?php echo($ruta_db_superior); ?>bpmn/bpmn/editar_bpmn.php" method="post"  enctype="multipart/form-data">
	<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
			<td class="encabezado" title="Nombre del nuevo bpmn"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo @$x_nombre; ?>">
			</span></td>
		</tr>
		<tr>
			<td class="encabezado" title="Descripcion del nuevo bpmn"><span class="phpmaker" style="color: #FFFFFF;">Descripcion</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"> 				<textarea name="x_descripcion" id="x_descripcion" style="width:200px;height:50px" ><?php echo $x_descripcion; ?></textarea> </span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Archivo bpmn</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
				<input type=file name='imagen' id='imagen' >
			</span>
			<?php
			if ($x_ruta_archivo) {
				echo '<br/><span><strong>Archivo Actual:</strong> <a href="' . $ruta_db_superior . $x_archivo_bpmn . '" target="_blank">ver archivo</a></span>';
			}
			?></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="hidden" name="x_ruta_archivo" id="x_ruta_archivo" value="<?php echo $x_ruta_archivo; ?>" />
				<input type="hidden" name="id" value="<?php echo($x_idbpmn); ?>">
				<input type="hidden" name="a_edit" value="U">
				<input type="submit" name="Action" value="Actualizar" class="btn btn-mini btn-primary">
			</td>
		</tr>
	</table>
</form>
<script src="<?php echo $ruta_db_superior; ?>js/additional-methods.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#bpmnedit").validate({
			rules : {
				x_nombre : {
					required : true
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

		var x_ruta_archivo = $("#x_ruta_archivo").val();
		if (x_ruta_archivo == "") {
			$("#imagen").rules("add", {
				required : true,
				extension : "bpmn"
			});
		}

	});
</script>
<?php encriptar_sqli("bpmnedit",1,"form_info",$ruta_db_superior);?>