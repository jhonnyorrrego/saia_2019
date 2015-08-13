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
$x_idtarea = Null;
$x_nombre = Null;
$x_fecha = Null;
$x_tiempo_respuesta = Null;
$x_descripcion = Null;
$x_reprograma = Null;
$x_tipo_reprograma = Null;
?>
<?php include ("../db.php") ?>
<?php include ("../phpmkrfn.php") ?>
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
	header("Location: tarealist.php");
	exit(); 
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idtarea=" . trim($sKey) . "";

// Get action
$sAction = @$_REQUEST["a_delete"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}
switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount($sDbWhere,$conn) <= 0) {			
			ob_end_clean();
			header("Location: tarealist.php");
			exit();
		}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			$_SESSION["ewmsg"] = "Eliminación Exitosa" . stripslashes($sKey);		
			ob_end_clean();
			header("Location: tarealist.php");
			exit();
		}
		break;
}
?>
<?php include ("../header.php") ?>
<p><span class="phpmaker">Borrar tarea<br><br><a href="tarealist.php">Regresar al listado</a></span></p>
<form action="tareadelete.php" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">FECHA</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">TIEMPO RESPUESTA</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCION</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">REPROGRAMA</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">TIPO REPROGRAMA</span></td>
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
<?php echo FormatDateTime($x_fecha,5); ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_tiempo_respuesta; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo str_replace(chr(10), "<br>", @$x_descripcion); ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_reprograma; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_tipo_reprograma; ?>
</span></td>
	</tr>
<?php
	}
}
?>
</table>
<p>
<input type="submit" name="Action" value="Confirmar Borrado">
</form>
<?php include ("../footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $_SESSION;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM tarea";
	$sSql .= " WHERE idtarea = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idtarea"] = $row["idtarea"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_fecha"] = $row["fecha"];
		$GLOBALS["x_tiempo_respuesta"] = $row["tiempo_respuesta"];
		$GLOBALS["x_descripcion"] = $row["descripcion"];
		$GLOBALS["x_reprograma"] = $row["reprograma"];
		$GLOBALS["x_tipo_reprograma"] = $row["tipo_reprograma"];
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
	global $_SESSION;
	$sSql = "SELECT * FROM tarea";
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
	$rs = phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
	return phpmkr_num_rows($rs);
	phpmkr_free_result($rs);
}
?>
<?php

//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey

function DeleteData($sqlKey,$conn)
{
	global $_SESSION;
	$sSql = "Delete FROM tarea";
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
	phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
	return true;
}
?>
