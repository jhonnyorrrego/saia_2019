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
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ("phpmkrfn.php");
include_once ("librerias/funciones.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("key_d","key","idformato");
desencriptar_sqli('form_info');

$x_idfuncion_formato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_descripcion = Null;
$x_ruta = Null;
$x_formato = Null;

$sKey = @$_GET["key"];
$idformato = @$_REQUEST["idformato"];
if (($sKey == "") || (is_null($sKey))) {
	$sKey = @$_POST["key_d"];
}

if (($sKey == "") || (is_null($sKey))) {
	if ($idformato) {
		redirecciona("funciones_formatolist.php?idformato=" . $idformato);
	}
	redirecciona("funciones_formatolist.php");
}
$sDbWhere = "funciones_formato_fk=" . trim($sKey) . " AND formato_idformato=" . $_REQUEST["idformato"];

$sAction = @$_POST["a_delete"];
switch ($sAction) {
	case "D" :
		if (DeleteData($sDbWhere)) {
			if ($idformato) {
				redirecciona("funciones_formatolist.php?idformato=" . $idformato);
			}
			redirecciona("funciones_formatolist.php");
		}
	break;
	default:
		LoadData($sKey);
		break;
}

function LoadData($sKey, $conn) {
	global $x_idfuncion_formato, $x_nombre, $x_etiqueta, $x_descripcion, $x_ruta, $x_formato, $x_acciones;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM funciones_formato";
	$sSql .= " WHERE idfunciones_formato = " . $sKeyWrk;

	$rs = phpmkr_query($sSql, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	} else {
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_idfuncion_formato = $row["idfunciones_formato"];
		$x_nombre = $row["nombre"];
		$x_etiqueta = $row["etiqueta"];
		$x_descripcion = $row["descripcion"];
		$x_ruta = $row["ruta"];
		$x_formato = $row["formato"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}

function DeleteData($sqlKey, $conn) {
	$sSql = "DELETE FROM funciones_formato_enlace";
	$sSql .= " WHERE " . $sqlKey;
	$formato = busca_filtro_tabla("nombre_tabla", "formato A", "A.idformato=" . $_REQUEST["idformato"], "", $conn);
	guardar_traza($sSql, $formato[0]["nombre_tabla"]);
	phpmkr_query($sSql, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if ($_REQUEST["eliminar_funcion"]) {
		$sql1 = "DELETE FROM funciones_formato WHERE idfunciones_formato=" . $_REQUEST["key_d"];
		guardar_traza($sql1, $formato[0]["nombre_tabla"]);
		phpmkr_query($sql1, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL: ' . $sql1);
	}
	return true;
}

$formatos=busca_filtro_tabla("A.etiqueta,A.idformato,A.nombre,C.ruta,C.etiqueta AS etiqueta_funcion,B.funciones_formato_fk","formato A, funciones_formato_enlace B,funciones_formato C","A.idformato=B.formato_idformato AND B.funciones_formato_fk=C.idfunciones_formato AND funciones_formato_fk=".$sKey."","GROUP BY A.idformato HAVING min(B.funciones_formato_fk)=B.funciones_formato_fk ORDER BY B.idfunciones_formato_enlace ASC",$conn);
// si el archivo existe dentro de la carpeta formatos
$ruta_final=$formatos[0]["nombre"] . "/" . $formatos[0]["ruta"];
if (is_file($ruta_db_superior . FORMATOS_CLIENTE . $formatos[0]["nombre"] . "/" . $formatos[0]["ruta"])) {
	$ruta_formato = realpath($_SERVER["DOCUMENT_ROOT"] . "/" . RUTA_SAIA ."/". FORMATOS_CLIENTE . $formatos[0]["nombre"]. "/" . $formatos[0]["ruta"]);
} elseif (is_file($ruta_db_superior . $formatos[0]["ruta"])) {
	// si el archivo existe en la ruta especificada partiendo de la raiz
	$ruta_formato = realpath($_SERVER["DOCUMENT_ROOT"] . "/" . RUTA_SAIA . "/" . $formatos[0]["ruta"]);
} else {
	$ruta_formato = 'Error: ' . $formatos[0]["ruta"] . "|id=" . $formatos[0]["idfunciones_formato"];
}

echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());
echo(librerias_acciones_kaiten());
?>
<p><br/>
	<a class="btn btn-mini btn-default" href="funciones_formatolist.php?idformato=<?php echo $idformato; ?>">Regresar</a>
</p>
<form id="funciones_formatodelete" name="funciones_formatodelete" action="funciones_formatodelete.php" method="post">
<input type="hidden" name="a_delete" value="D">
<input type="hidden" name="idformato" value="<?php echo($idformato);?>">
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" class="table table-bordered">
	<tr  class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Ubicada en Archivo</span></td>
	</tr>
	
	<tr>
		<td><span class="phpmaker"><?php echo $x_nombre; ?></span></td>
		<td><span class="phpmaker"><?php echo $x_etiqueta; ?></span></td>
		<td><span class="phpmaker"><?php echo $ruta_formato; ?></span></td>
	</tr>
</table>
<?php 
$formato_enlace=busca_filtro_tabla("C.etiqueta,C.idformato,B.idfunciones_formato,C.nombre","formato C,funciones_formato_enlace A,funciones_formato B","A.formato_idformato=C.idformato AND A.funciones_formato_fk=B.idfunciones_formato AND B.idfunciones_formato=".$_REQUEST["key"],"idfunciones_formato_enlace ASC",$conn);
if($formato_enlace["numcampos"]==1){
	?>
	<input type="hidden" name="eliminar_funcion" value="1" id="eliminar_funcion">
	<input type="button" name="btn_elimina_funcion" id="btn_elimina_funcion" value="CONFIRMAR BORRADO" class="btn btn-mini btn-danger">
	<?php 
}
else if($formato_enlace["numcampos"]){	
	if($formato_enlace[0]["idformato"]==$_REQUEST["idformato"]){
		echo '<span style="color:red">Por favor elimine la funcion de los otros formatos para poder continuar</span>';
	}else{
		echo '<input type="button" name="btn_elimina_enlace" id="btn_elimina_enlace" value="ELIMINAR ASIGNACION" class="btn btn-mini btn-info">';
	}
	echo('<br><br><table class="table table-bordered"><tr><th class="encabezado_list" style="text-align:center" colspan="2">Formatos Vinculados</th></tr><tr><th>Etiqueta</th><th>Nombre</th></tr>');
	for($i=0;$i<$formato_enlace["numcampos"];$i++){
		if($formato_enlace[$i]["idformato"]==$_REQUEST["idformato"]){
			continue;
		}
		echo('<tr><td><div class="link kenlace_saia" conector="iframe" enlace="formatos/detalle_formato.php?idformato='.$formato_enlace[$i]["idformato"].'" titulo="'.$formato_enlace[$i]["etiqueta"].'" title="'.$formato_enlace[$i]["etiqueta"].'">'.$formato_enlace[$i]["etiqueta"].'</div></td><td>'.$formato_enlace[$i]["nombre"].'</td></tr>');
	}
	echo('</table>');
}
?>
</form>
<?php encriptar_sqli("funciones_formatodelete",1,"form_info",$ruta_db_superior);?>
<script type="text/javascript">
$("#btn_elimina_funcion,#btn_elimina_enlace").click(function(){
	$("#funciones_formatodelete").submit();
});
</script>