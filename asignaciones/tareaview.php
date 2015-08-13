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
$x_idtarea = Null;
$x_nombre = Null;
$x_tiempo_respuesta = Null;
$x_descripcion = Null;
$x_idpadre = Null;
$x_idcontrol = Null;
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
	header("Locationtarealist.php"); 
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
			header("Location tarealist.php");
			exit();
		}
}
?>
<?php include ("../header.php") ?>
<p><span class="phpmaker">Ver .:: tarea<br><br>
<a href="tarealist.php">Regresar al listado</a>&nbsp;
<a href="<?php echo "tareaedit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;
<a href="<?php echo  "tareaadd.php?key=" . urlencode($sKey); ?>">Copiar</a>&nbsp;
<a href="<?php echo "tareadelete.php?key=" . urlencode($sKey); ?>">Eliminar</a>&nbsp;
<a href="<?php echo "control_tarealist.php?key=" . urlencode($sKey);?>">Controles Asociados</a>
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ID TAREA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idtarea; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo str_replace(chr(10), "<br>", @$x_nombre); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIEMPO DE RESPUESTA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_tiempo_respuesta; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo str_replace(chr(10), "<br>", @$x_descripcion); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ID PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idpadre; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ID CONTROL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idcontrol; ?>
</span></td>
	</tr>
</table>
</form>
<p>

<?php include ("../footer.php") ?>

<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $HTTP_SESSION_VARS,$conn;
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
		$GLOBALS["x_tiempo_respuesta"] = $row["tiempo_respuesta"];
		$GLOBALS["x_descripcion"] = $row["descripcion"];
		$GLOBALS["x_idpadre"] = $row["idpadre"];
		$GLOBALS["x_idcontrol"] = $row["idcontrol"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
} ?>
