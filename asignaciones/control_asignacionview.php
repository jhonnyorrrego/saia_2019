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
$sKey = @$HTTP_GET_VARS["key"];
if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$HTTP_GET_VARS["key"]; 
}
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean(); 
	header("Locationcontrol_asignacionlist.php"); 
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$HTTP_POST_VARS["a_view"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}

// Open connection to the database

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$HTTP_SESSION_VARS["ewmsg"] = "Registro no encontrado" . $sKey;
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location control_asignacionlist.php");
			exit();
		}
}
?>
<?php include ("../header.php") ?>
<p><span class="phpmaker">Ver Tabla: control asignacion<br><br>
<a href="control_asignacionlist.php">Regresar al listado</a>&nbsp;
<a href="<?php echo "control_asignacionedit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;
<a href="<?php echo  "control_asignacionadd.php?key=" . urlencode($sKey); ?>">Copiar</a>&nbsp;
<a href="<?php echo "control_asignaciondelete.php?key=" . urlencode($sKey); ?>">Eliminar</a>&nbsp;
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">accion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo str_replace(chr(10), "<br>", @$x_accion); ?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">periocidad</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_periocidad; ?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">tipo periocidad</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_tipo_periocidad; ?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">asignacion idasignacion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_asignacion_idasignacion; ?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">tipo anticipacion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_tipo_anticipacion; ?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">anticipacion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_anticipacion; ?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">ejecutar hasta</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo FormatDateTime($x_ejecutar_hasta,5); ?>
</span></td>
	</tr>
</table>
</form>
<p>
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
