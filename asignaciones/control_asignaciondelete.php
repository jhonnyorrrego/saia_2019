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

// User levels
define("ewAllowAdd", 1, true);
define("ewAllowDelete", 2, true);
define("ewAllowEdit", 4, true);
define("ewAllowView", 8, true);
define("ewAllowList", 8, true);
define("ewAllowReport", 8, true);
define("ewAllowSearch", 8, true);																														
define("ewAllowAdmin", 16, true);						
?>
<?php

// Initialize common variables
$x_idcontrol_asignacion = Null;
$x_accion = Null;
$x_periocidad = Null;
$x_tipo_periocidad = Null;
$x_asignacion_idasignacion = Null;
$x_tipo_anticipacion = Null;
$x_anticipacion = Null;
$x_ejecutar_hasta = Null;
?>
<?php include ("../db.php") ?>
<?php include ("../phpmkrfn.php") ?>
<?php

// Load Key Parameters
$sKey = @$HTTP_GET_VARS["key"];
if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$HTTP_POST_VARS["key_d"];
}
$sDbWhere = "";
$arRecKey = split(",",$sKey);

// Single delete record
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean();
	header("Location: control_asignacionlist.php");
	exit(); 
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idcontrol_asignacion=" . trim($sKey) . "";

// Get action
$sAction = @$HTTP_POST_VARS["a_delete"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}

switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount($sDbWhere,$conn) <= 0) {
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: control_asignacionlist.php");
			exit();
		}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			$HTTP_SESSION_VARS["ewmsg"] = "Eliminación Exitosa" . stripslashes($sKey);
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: control_asignacionlist.php");
			exit();
		}
		break;
}
?>
<?php include ("../header.php") ?>
<p><span class="phpmaker">Borrar Tabla: control asignacion<br><br><a href="control_asignacionlist.php">Regresar al listado</a></span></p>
<form action="control_asignaciondelete.php" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr bgcolor="#666666">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">accion</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">periocidad</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">tipo periocidad</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">tipo anticipacion</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">anticipacion</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">ejecutar hasta</span></td>
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
<?php echo str_replace(chr(10), "<br>", @$x_accion); ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_periocidad; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_tipo_periocidad; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_tipo_anticipacion; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_anticipacion; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo FormatDateTime($x_ejecutar_hasta,5); ?>
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
//phpmkr_db_close($conn);
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{   global $conn;
	global $HTTP_SESSION_VARS;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM control_asignacion";
	$sSql .= " WHERE idcontrol_asignacion = " . $sKeyWrk;
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
		$GLOBALS["x_idcontrol_asignacion"] = $row["idcontrol_asignacion"];
		$GLOBALS["x_accion"] = $row["accion"];
		$GLOBALS["x_periocidad"] = $row["periocidad"];
		$GLOBALS["x_tipo_periocidad"] = $row["tipo_periocidad"];
		$GLOBALS["x_asignacion_idasignacion"] = $row["asignacion_idasignacion"];
		$GLOBALS["x_tipo_anticipacion"] = $row["tipo_anticipacion"];
		$GLOBALS["x_anticipacion"] = $row["anticipacion"];
		$GLOBALS["x_ejecutar_hasta"] = $row["ejecutar_hasta"];
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
{   global $conn;
	global $HTTP_SESSION_VARS;
	$sSql = "SELECT * FROM control_asignacion";
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
{   global $conn;
	global $HTTP_SESSION_VARS;
	$sSql = "Delete FROM control_asignacion";
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
