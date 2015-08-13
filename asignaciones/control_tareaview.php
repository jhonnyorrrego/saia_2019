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
$x_idcontrol_tarea = Null;
$x_accion = Null;
$x_periocidad = Null;
$x_tipo_periocidad = Null;
$x_tarea_idtarea = Null;
$x_estado = Null;
$x_fecha_inicial = Null;
$x_fecha_actualizacion = Null;
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
	header("Locationcontrol_tarealist.php"); 
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
		    //	phpmkr_db_close($conn);
			ob_end_clean();
			header("Location control_tarealist.php");
			exit();
		}
}
?>
<?php include ("../header.php") ?>
<p><span class="phpmaker">Ver .:: control tarea<br><br>
<a href="<?php echo "control_tarealist.php?key=" . urlencode($_REQUEST["idasig"]); ?>">Regresar al listado</a>&nbsp;
<a href="<?php echo "control_tareaedit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;
<a href="<?php echo  "control_tareaadd.php?key=" . urlencode($sKey); ?>">Copiar</a>&nbsp;
<a href="<?php echo "control_tareadelete.php?key=" . urlencode($sKey); ?>">Eliminar</a>&nbsp;
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">idcontrol tarea</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idcontrol_tarea; ?>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">accion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo str_replace(chr(10), "<br>", @$x_accion); ?>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">periocidad</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_periocidad; ?>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">tipo periocidad</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_tipo_periocidad; ?>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">tarea idtarea</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_tarea_idtarea; ?>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">estado</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo str_replace(chr(10), "<br>", @$x_estado); ?>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">fecha inicial</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo FormatDateTime($x_fecha_inicial,5); ?>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">fecha actualizacion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo FormatDateTime($x_fecha_actualizacion,5); ?>
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
{
	global $HTTP_SESSION_VARS,$conn;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM control_tarea";
	$sSql .= " WHERE idcontrol_tarea = " . $sKeyWrk;
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
		$GLOBALS["x_idcontrol_tarea"] = $row["idcontrol_tarea"];
		$GLOBALS["x_accion"] = $row["accion"];
		$GLOBALS["x_periocidad"] = $row["periocidad"];
		$GLOBALS["x_tipo_periocidad"] = $row["tipo_periocidad"];
		$GLOBALS["x_tarea_idtarea"] = $row["tarea_idtarea"];
		$GLOBALS["x_estado"] = $row["estado"];
		$GLOBALS["x_fecha_inicial"] = $row["fecha_inicial"];
		$GLOBALS["x_fecha_actualizacion"] = $row["fecha_actualizacion"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
