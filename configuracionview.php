<?php include_once ("db.php") ?>
<?php //session_start(); ?>
<?php //ob_start(); ?>
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
?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_GET["key"]; 
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean(); 
	header("Location configuracionlist.php"); 
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;		
			ob_end_clean();
			header("Location configuracionlist.php");
			exit();
		}
}
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/configuracion.gif" border="0">&nbsp;&nbsp;CONFIGURACI&Oacute;N DEL SISTEMA<br><br>
<a href="configuracionlist.php">Regresar al listado</a>&nbsp;
<a href="<?php echo "configuracionedit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;
<a href="<?php echo "configuraciondelete.php?key=" . urlencode($sKey); ?>">Eliminar</a>&nbsp;
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Valor</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_valor; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tipo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_tipo; ?>
</span></td>
	</tr>
</table>
</form>
<p>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{ global $x_idconfiguracion,$x_nombre,$x_valor,$x_tipo;
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
	$rs = phpmkr_query($sSql,$conn) or error("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);

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
