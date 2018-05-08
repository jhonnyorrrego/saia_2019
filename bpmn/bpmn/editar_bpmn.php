<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "class_transferencia.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
$x_idbpmn = Null;
$x_nombre = Null;
$x_descripcion = Null;
$x_archivo_bpmn = Null;

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "phpmkrfn.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include ($ruta_db_superior . "formatos/librerias/estilo_formulario.php");

$sAction = @$_POST["a_edit"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";
} else {

	$x_idbpmn = @$_POST["id"];
	$x_nombre = @$_POST["x_nombre"];
	$x_descripcion = @$_POST["x_descripcion"];
	$x_archivo_bpmn = @$_POST["x_archivo_bpmn"];
}
switch ($sAction) {
	case "I" :
		if (!LoadData(@$_REQUEST["idbpmn"], $conn)) {
		}
		break;
	case "U" :
		if ($id = EditData($conn)) {// Add New Record
			abrir_url($ruta_db_superior . "bpmn/procesar_bpmn.php?idbpmn=" . $id . "&vista_bpmn=1", "_self");
			exit();
		}
		break;
}

function LoadData($sKey, $conn) {
	global $x_idbpmn;
	global $x_nombre;
	global $x_descripcion;
	global $x_archivo_bpm;
	global $x_archivo_bpmn;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM diagram a, diagramdata b";
	$sSql .= " WHERE a.id=b.diagramId AND a.id=" . $sKeyWrk;
	$rs = phpmkr_query($sSql, $conn) or error("Falla la busqueda" . phpmkr_error() . ' SQL:' . $sSql);
	$i = 0;
	while (phpmkr_fetch_array($rs))
		$i++;
	$rs = phpmkr_query($sSql, $conn) or error("Falla la busqueda" . phpmkr_error() . ' SQL:' . $sSql);

	if ($i == 0) {
		$LoadData = false;
	} else {
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		$x_idbpmn = $row["id"];
		$x_nombre = $row["title"];
		$x_descripcion = $row["description"];

		$ruta_imagen = json_decode($row["fileName"]);
		if (is_object($ruta_imagen)) {
			$tipo_almacenamiento = new SaiaStorage("bpmn");
			if ($tipo_almacenamiento -> get_filesystem() -> has($ruta_imagen -> ruta)) {
				$ruta64 = base64_encode($row["fileName"]);
				$x_archivo_bpmn = "filesystem/mostrar_binario.php?ruta=" . $ruta64;
			}
		}

	}
	phpmkr_free_result($rs);
	return $LoadData;
}

function EditData($conn) {
	global $x_idbpmn;
	global $x_nombre;
	global $x_descripcion;
	global $x_cod_padre;
	global $x_tipo_bpmn;
	global $x_archivo_bpmn;
	global $ruta_db_superior;

	$datos = busca_filtro_tabla("B.fileName", "diagram A, diagramdata B", "A.id=B.diagramId AND A.id=" . $x_idbpmn, "", $conn);
	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre;
	$theValue = ($theValue != "") ? " '" . trim($theValue) . "'" : "NULL";
	$fieldList["title"] = $theValue;
	$fieldList["description"] = "'" . $x_descripcion . "'";
	$fieldList["lastUpdate"] = fecha_db_almacenar(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');
	$fieldList2["lastUpdate"] = fecha_db_almacenar(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');
	$update2 = false;

	if (is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
		$update2 = true;
		$extension = explode(".", ($_FILES["imagen"]["name"]));
		$ultimo = count($extension);
		$formato = $extension[$ultimo - 1];
		$aleatorio = uniqid();
		$archivo = $aleatorio . "." . $formato;

		$almacenamiento = new SaiaStorage("bpmn");
		$resultado = $almacenamiento -> copiar_contenido_externo($_FILES['imagen']['tmp_name'], $archivo);
		if ($resultado) {
			$dir_bpmn = array(
				"servidor" => $almacenamiento -> get_ruta_servidor(),
				"ruta" => $archivo
			);
			$fieldList2["fileName"] = "'" . json_encode($dir_bpmn) . "'";
			$fieldList["tamano"] = $_FILES["imagen"]["size"];
			$fieldList2["fileSize"] = $_FILES["imagen"]["size"];
			$fieldList2["type"] = "'" . $formato . "'";
			@unlink($_FILES["imagen"]["tmp_name"]);

		} else {
			die("No es posible procesar el archivo " . $_FILES["imagen"]["tmp_name"] . " Posible error al tratar de copiar a " . $archivo);
		}
	}
	$adicional = "";
	if ($update2) {
		$adicional = ", tamano=" . $fieldList["tamano"];
	}

	$strsql = "UPDATE diagram SET title=" . $fieldList["title"] . ", description=" . $fieldList["description"] . ", lastUpdate=" . $fieldList["lastUpdate"] . $adicional . " WHERE id=" . $x_idbpmn;
	phpmkr_query($strsql, $conn);

	if ($update2) {
		$sql2 = "UPDATE diagramdata SET type=" . $fieldList2["type"] . ", fileName=" . $fieldList2["fileName"] . ", fileSize=" . $fieldList2["fileSize"] . ", lastUpdate=" . $fieldList2["lastUpdate"] . " WHERE diagramId=" . $x_idbpmn;
		phpmkr_query($sql2, $conn) or die("Error al actualizar");
		if ($datos[0]["fileName"] != "") {
			$almacenamiento = new SaiaStorage("bpmn");
			$archivo = json_decode($datos[0]["fileName"], true);
			$delete = $almacenamiento -> eliminar($archivo["ruta"]);
		}
	}
	return $x_idbpmn;
}

function generateRandom($length = 10, $vals = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabchefghjkmnpqrstuvwxyz0123456789-') {
	$s = "";
	while (strlen($s) < $length) {
		mt_getrandmax();
		$num = rand() % strlen($vals);
		$s .= substr($vals, $num + 4, 1);
	}
	return $s;
}

echo(librerias_jquery());
echo(librerias_notificaciones());
?>
<script type="text/javascript">
EW_dateSep = "/"; // set date separator	
function validar_formulario() {
	if($('#x_nombre').val()==''){
		notificacion_saia("Debe de Ingresar un Nombre Valido","alert","",3500);
		return false;	
	}else{
		return true;
	}
}
</script>
<p><span class="internos">ADICIONAR BPMN</span></p>
<form name="bpmnadd" id="bpmnadd" action="<?php echo($ruta_db_superior);?>bpmn/bpmn/editar_bpmn.php" method="post"  enctype="multipart/form-data">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="id" value="<?php echo($x_idbpmn); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="Nombre del nuevo bpmn"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Descripcion del nuevo bpmn"><span class="phpmaker" style="color: #FFFFFF;">Descripcion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<textarea name="x_descripcion" id="x_descripcion" style="width:200px;height:50px" ><?php echo (@$x_descripcion) ?></textarea>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Archivo bpmn</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php 
		if($x_archivo_bpmn){
			echo "<a href='".$ruta_db_superior.$x_archivo_bpmn."' target='_blank'>Ver Imagen Actual</a><br /><br /><input type='file' name='imagen' id='imagen' >";
		}
		else
			echo "<input type=file name='imagen' id='imagen' >";
		?>
		</span></td>
	</tr>	
	
</table>
<p>
<input type="submit" name="Action" value="Actualizar" onClick="return validar_formulario();">
</form>
