<?php include_once("db.php") ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
<?php
$ewCurSec = 0; // Initialise
		
?>
<?php
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("x_idserie");
desencriptar_sqli('form_info');
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery()); 
echo(librerias_notificaciones());
// Initialize common variables
$x_idserie = Null;
$x_nombre = Null;
$x_cod_padre = Null;
$x_dias_entrega = Null;
$x_codigo = Null;
$x_retencion_gestion = Null;
$x_retencion_central = Null;
$x_conservacion_total = Null;
$x_eliminacion = Null;
$x_seleccion = Null;
$x_otro = Null;
$x_procedimiento = Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php

// Load Key Parameters
$sKey = @$_REQUEST["key"];

if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$_REQUEST["key_d"];
}
$sDbWhere = "";
$arRecKey = split(",",$sKey);

// Single delete record
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean();
	header("Location: vacio.php");
	exit(); 
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idserie=" . trim($sKey) . "";

// Get action
$sAction = @$_REQUEST["a_delete"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}

switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount("A.".$sDbWhere,$conn) <= 0) {			
			ob_end_clean();
			echo "<script>parent.location='serielist.php';</script>";
			exit();
		}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			$HTTP_SESSION_VARS["ewmsg"] = "Edici�n Exitosa" . stripslashes($sKey);			
			ob_end_clean();
			echo "<script>parent.location='serielist.php';</script>";
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<p><span class="internos">
<img class="imagen_internos" src="botones/configuracion/serie.png" border="0">&nbsp;&nbsp;Desactivar Series Documentales<br><br></span></p>
<form action="seriedelete.php" method="post" name="seriedelete" id="seriedelete">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE PADRE</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">TIEMPO DE RESPUESTA (D&Iacute;AS)</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO GESTI&Oacute;N</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO CENTRAL</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">CONSERVACI&Oacute;N TOTAL</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">ELIMINACI&Oacute;N</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">SELECCI&Oacute;N</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">OTRO</span></td>
	</tr>
<?php
$nRecCount = 0;
foreach ($arRecKey as $sRecKey) {
	$sRecKey = trim($sRecKey);
	$sRecKey = (get_magic_quotes_gpc()) ? stripslashes($sRecKey) : $sRecKey;
	$nRecCount = $nRecCount + 1;

	// Set row color
	$sItemRowClass = " bgcolor=\"#FFFFFF\"";

	// Display alternate color for rows
	if ($nRecCount % 2 <> 0) {
		$sItemRowClass = " bgcolor=\"#F5F5F5\"";
	}
	if (LoadData($sRecKey,$conn)) {
?>
	<tr<?php echo $sItemRowClass;?>>
		<td><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
		<td><span class="phpmaker">
<?php
if (($x_cod_padre != NULL) && ($x_cod_padre <> "")) {
	$sSqlWrk = "SELECT DISTINCT *  FROM serie A";
	$sTmp = $x_cod_padre;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (A.idserie = " . $sTmp . ")";

	$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["codigo"];
		$sTmp .= ValueSeparator(0) . $rowwrk["nombre"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_cod_padre = $x_cod_padre; // Backup Original Value
$x_cod_padre = $sTmp;
?>
<?php echo $x_cod_padre; ?>
<?php $x_cod_padre = $ox_cod_padre; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_dias_entrega; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_codigo; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_retencion_gestion; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_retencion_central; ?>
</span></td>
		<td><span class="phpmaker">
<?php
switch ($x_conservacion_total) {
	case "1":
		$sTmp = "SI";
		break;
	case "0":
		$sTmp = "NO";
		break;
	default:
		$sTmp = "";
}
$ox_conservacion_total = $x_conservacion_total; // Backup Original Value
$x_conservacion_total = $sTmp;
?>
<?php echo $x_conservacion_total; ?>
<?php $x_conservacion_total = $ox_conservacion_total; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php
switch ($x_eliminacion) {
	case "1":
		$sTmp = "SI";
		break;
	case "0":
		$sTmp = "NO";
		break;
	default:
		$sTmp = "";
}
$ox_eliminacion = $x_eliminacion; // Backup Original Value
$x_eliminacion = $sTmp;
?>
<?php echo $x_eliminacion; ?>
<?php $x_eliminacion = $ox_eliminacion; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php
switch ($x_seleccion) {
	case "1":
		$sTmp = "SI";
		break;
	case "0":
		$sTmp = "NO";
		break;
	default:
		$sTmp = "";
}
$ox_seleccion = $x_seleccion; // Backup Original Value
$x_seleccion = $sTmp;
?>
<?php echo $x_seleccion; ?>
<?php $x_seleccion = $ox_seleccion; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_otro; ?>
</span></td>
	</tr>
<?php
	}
}
?>
</table>
<p>
<input type="submit" name="Action" value="Desactivar">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables
encriptar_sqli("seriedelete",1);
function LoadData($sKey,$conn)
{
	global $HTTP_SESSION_VARS;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM serie A";
	$sSql .= " WHERE A.idserie = " . $sKeyWrk;
	$sGroupBy = "";
	$sHaving = "";
	$sOrderBy = "";
	if ($sGroupBy <> "") {
		$sSql .= " GROUP BY " . $sGroupBy;
	}
	if ($sHaving <> "") {
		$sSql .= " HAVING " . $sHaving;
	}
	if ($sOrderBy <> "") {
		$sSql .= " ORDER BY " . $sOrderBy;
	}
	$rs = phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;

		// Get the field contents
		$GLOBALS["x_idserie"] = $row["idserie"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_cod_padre"] = @$row["cod_padre"];
		$GLOBALS["x_dias_entrega"] = @$row["dias_entrega"];
		$GLOBALS["x_codigo"] = @$row["codigo"];
		$GLOBALS["x_retencion_gestion"] = @$row["retencion_gestion"];
		$GLOBALS["x_retencion_central"] = @$row["retencion_central"];
		$GLOBALS["x_conservacion_total"] = @$row["conservacion_total"];
		$GLOBALS["x_eliminacion"] = @$row["eliminacion"];
		$GLOBALS["x_seleccion"] = @$row["seleccion"];
		$GLOBALS["x_otro"] = @$row["otro"];
		$GLOBALS["x_procedimiento"] = @$row["procedimiento"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadRecordCount
// - Load Record Count based on input sql criteria sqlKey

function LoadRecordCount($sqlKey,$conn)
{
	global $HTTP_SESSION_VARS;
	$sSql = "SELECT * FROM serie A";
	$sSql .= " WHERE " . $sqlKey;
	$sGroupBy = "";
	$sHaving = "";
	$sOrderBy = "";
	if ($sGroupBy <> "") {
		$sSql .= " GROUP BY " . $sGroupBy;
	}
	if ($sHaving <> "") {
		$sSql .= " HAVING " . $sHaving;
	}
	if ($sOrderBy <> "") {
		$sSql .= " ORDER BY " . $sOrderBy;
	}

	$rs = phpmkr_query($sSql,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
    }
 return($LoadData); 
 }  
?>
<?php

//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey

function DeleteData($sqlKey,$conn)
{
	global $HTTP_SESSION_VARS;
	$sSql = "update serie set estado=0 where $sqlKey";
	phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	phpmkr_query("update serie set estado=0 where cod_padre=".$_REQUEST["key_d"]);
	return true;
}
?>
