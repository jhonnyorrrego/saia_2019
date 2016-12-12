<?php session_start(); ?>
<?php ob_start(); ?>
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

// Initialize common variables
$x_idconfiguracion = Null;
$x_nombre = Null;
$x_valor = Null;
$x_tipo = Null;
//$x_fecha = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php include_once ("librerias_saia.php"); echo(librerias_notificaciones()); ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || (is_null($sKey))) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_idconfiguracion = @$_POST["x_idconfiguracion"];
	$x_nombre = @$_POST["x_nombre"];
	$x_valor = @$_POST["x_valor"];
	$x_tipo = @$_POST["x_tipo"];
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	header("Location: configuracionlist.php");
	exit();
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;			
			ob_end_clean();
			header("Location: configuracionlist.php");
			exit();
		}
		break;
	case "U":
		$llave=EditData($sKey,$conn);
		if($llave){ // Update Record based on key
		abrir_url("configuracionedit.php?key=".$llave."&accion=editar","_self");
		}
		break;
}
?>
<?php include ("header.php") ?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_nombre && !EW_hasValue(EW_this.x_nombre, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor ingrese los campos requeridos - Nombre"))
		return false;
}
if (EW_this.x_tipo && !EW_hasValue(EW_this.x_tipo, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_tipo, "TEXT", "Por favor ingrese los campos requeridos - Tipo"))
		return false;
}
return true;
}
//-->
</script>
<form name="configuracionedit" id="configuracionedit" action="configuracionedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N DE LA CONFIGURACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idconfiguracion; ?><input type="hidden" name="x_idconfiguracion" value="<?php echo $x_idconfiguracion; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">VALOR</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_valor" id="x_valor" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_valor) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_tipo" id="x_tipo" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_tipo) ?>">
</span></td>
	</tr>	
</table>
<p>
<input type="submit" name="Action" value="Editar">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{ global $x_idconfiguracion,$x_nombre,$x_valor,$x_tipo;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT A.* FROM configuracion A";
	$sSql .= " WHERE A.idconfiguracion = " . $sKeyWrk;
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
		$x_idconfiguracion = $row["idconfiguracion"];
		$x_nombre = $row["nombre"];
		$x_valor = $row["valor"];
		$x_tipo = $row["tipo"];	
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function EditData
// - Edit Data based on Key Value sKey
// - Variables used: field variables

function EditData($sKey,$conn)
{
global $x_nombre;
global $x_valor;
global $x_tipo;

	// Open record
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM configuracion A";
	$sSql .= " WHERE A.idconfiguracion = " . $sKeyWrk;
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
		$EditData = false; // Update Failed
	}else{
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["nombre"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_valor) : $x_valor; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["valor"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_tipo) : $x_tipo; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["tipo"] = $theValue;

		// update
		$sSql = "UPDATE configuracion SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idconfiguracion =". $sKeyWrk;		
		phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
		$EditData = true; // Update Successful
	}
	return $sKeyWrk;
}
?>
