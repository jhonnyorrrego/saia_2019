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
<?php require_once("../calendario/calendario.php");?>
<?php
$sKey = @$HTTP_GET_VARS["key"];
if (($sKey == "") || ($sKey == NULL)) { $sKey = @$HTTP_POST_VARS["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$HTTP_POST_VARS["a_edit"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_idcontrol_asignacion = @$HTTP_POST_VARS["x_idcontrol_asignacion"];
	$x_accion = @$HTTP_POST_VARS["x_accion"];
	$x_periocidad = @$HTTP_POST_VARS["x_periocidad"];
	$x_tipo_periocidad = @$HTTP_POST_VARS["x_tipo_periocidad"];
	$x_asignacion_idasignacion = @$HTTP_POST_VARS["x_asignacion_idasignacion"];
	$x_tipo_anticipacion = @$HTTP_POST_VARS["x_tipo_anticipacion"];
	$x_anticipacion = @$HTTP_POST_VARS["x_anticipacion"];
	$x_ejecutar_hasta = @$HTTP_POST_VARS["x_ejecutar_hasta"];
}
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean();
	header("Location: control_asignacionlist.php");
	exit();
}

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$HTTP_SESSION_VARS["ewmsg"] = "Registro no encontrado" . $sKey;
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: control_asignacionlist.php");
			exit();
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
			$HTTP_SESSION_VARS["ewmsg"] = "Actualización exitosa" . $sKey;
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: control_asignacionlist.php");
			exit();
		}
		break;
}
?>
<?php include ("../header.php") ?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_accion && !EW_hasValue(EW_this.x_accion, "TEXTAREA" )) {
	if (!EW_onError(EW_this, EW_this.x_accion, "TEXTAREA", "Por favor ingrese los campos requeridos - accion"))
		return false;
}
if (EW_this.x_periocidad && !EW_checkinteger(EW_this.x_periocidad.value)) {
	if (!EW_onError(EW_this, EW_this.x_periocidad, "TEXT", "Entero Incorrecto - periocidad"))
		return false; 
}
if (EW_this.x_asignacion_idasignacion && !EW_checkinteger(EW_this.x_asignacion_idasignacion.value)) {
	if (!EW_onError(EW_this, EW_this.x_asignacion_idasignacion, "TEXT", "Entero Incorrecto - asignacion idasignacion"))
		return false; 
}
if (EW_this.x_anticipacion && !EW_checkinteger(EW_this.x_anticipacion.value)) {
	if (!EW_onError(EW_this, EW_this.x_anticipacion, "TEXT", "Entero Incorrecto - anticipacion"))
		return false; 
}
if (EW_this.x_ejecutar_hasta && !EW_checkdate(EW_this.x_ejecutar_hasta.value)) {
	if (!EW_onError(EW_this, EW_this.x_ejecutar_hasta, "TEXT", "Formato de fecha incorrecto yyyy/mm/dd - ejecutar hasta"))
		return false; 
}
return true;
}

//-->
</script>
<p><span class="phpmaker">Editar Tabla: control asignacion<br><br><a href="control_asignacionlist.php">Regresar al listado</a></span></p>
<form name="control_asignacionedit" id="control_asignacionedit" action="control_asignacionedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">idcontrol asignacion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idcontrol_asignacion; ?><input type="hidden" name="x_idcontrol_asignacion" value="<?php echo $x_idcontrol_asignacion; ?>">
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">accion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<select  id="x_accion" name="x_accion">
	 <option name="morreo" value="enviar_correo.php" <?php if($x_accion=="enviar_correo") 
	echo selected;?> >Correo</option>	
	 <option name="mensajeria" value="enviar_mensaje.php" <?php if($x_accion=="enviar_mensaje") 
	echo selected;?> >Mensajeria</option>	
    </select> 

</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">periocidad</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_periocidad" id="x_periocidad" size="5" value="<?php 
echo $x_periocidad; ?>">
</span>	
	<select name="x_tipo_periocidad">

	<option name="minuto" value="minute" <?php if($x_tipo_periocidad=="minute") 
	echo selected;?>  >Minutos</option>	
	<option name="hora" value="hour" <?php if($x_tipo_periocidad=="hour") 
	echo selected;?>  >Horas</option>
     <option name="dia" value="day" <?php if($x_tipo_periocidad=="day") 
	echo selected;?>  >D&iacute;a</option>
     <option name="mes" value="month" <?php if($x_tipo_periocidad=="month") 
	echo selected;?>  >Mes</option>
     <option name="anio" value="year" <?php if($x_tipo_periocidad=="year") 
	echo selected;?>  >A&ntilde;o</option>
    </select> 
</span></td>
<input type="text" name="x_asignacion_idasignacion" 
id="x_asignacion_idasignacion" size="30" value="<?php echo 
htmlspecialchars(@$x_asignacion_idasignacion) ?>">
		</tr>

		
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Anticipacion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!($x_anticipacion != NULL) || ($x_anticipacion == "")) { $x_anticipacion = 0;} // Set default value ?>
<input type="text" name="x_anticipacion" id="x_anticipacion" size="5" 
value="<?php echo htmlspecialchars(@$x_anticipacion) ?>">
</span>	
			<select name="x_tipo_anticipacion">
	<option name="minuto" value="minute" <?php if($x_tipo_anticipacion=="minute") 
	echo selected;?>  >Minutos</option>	
	<option name="hora" value="hour" <?php if($x_tipo_anticipacion=="hour") 
	echo selected;?>  >Horas</option>
     <option name="dia" value="day" <?php if($x_tipo_anticipacion=="day") 
	echo selected;?>  >D&iacute;a</option>
     <option name="mes" value="month" <?php if($x_tipo_anticipacion=="month") 
	echo selected;?>  >Mes</option>
     <option name="anio" value="year" <?php if($x_tipo_anticipacion=="year") 
	echo selected;?>  >A&ntilde;o</option>
</span></td>

		</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ejecutar hasta</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_ejecutar_hasta" id="x_ejecutar_hasta" value="<?php echo FormatDateTime(@$x_ejecutar_hasta,5); ?>">
<?php selector_fecha("x_ejecutar_hasta","control_asignacionedit","Y/m/d H:i:s",date("m"),date("Y"),"ceramique.css","../","AD:VALOR","VENTANA"); ?>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Editar">
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
// Function EditData
// - Edit Data based on Key Value sKey
// - Variables used: field variables

function EditData($sKey,$conn)
{   global $conn;
	global $HTTP_SESSION_VARS;
	global $HTTP_POST_VARS;
	global $HTTP_POST_FILES;
	global $HTTP_ENV_VARS;

	// Open record
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
		$EditData = false; // Update Failed
	}else{
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_accion"]) : $GLOBALS["x_accion"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["accion"] = $theValue;
		$theValue = ($GLOBALS["x_periocidad"] != "") ? intval($GLOBALS["x_periocidad"]) : "NULL";
		$fieldList["periocidad"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_tipo_periocidad"]) : $GLOBALS["x_tipo_periocidad"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["tipo_periocidad"] = $theValue;
		$theValue = ($GLOBALS["x_asignacion_idasignacion"] != "") ? intval($GLOBALS["x_asignacion_idasignacion"]) : "NULL";
		$fieldList["asignacion_idasignacion"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_tipo_anticipacion"]) : $GLOBALS["x_tipo_anticipacion"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["tipo_anticipacion"] = $theValue;
		$theValue = ($GLOBALS["x_anticipacion"] != "") ? intval($GLOBALS["x_anticipacion"]) : "NULL";
		$fieldList["anticipacion"] = $theValue;
		$theValue = ($GLOBALS["x_ejecutar_hasta"] != "") ? " '" . ConvertDateToMysqlFormat($GLOBALS["x_ejecutar_hasta"]) . "'" : "NULL";
		$fieldList["ejecutar_hasta"] = $theValue;

		// update
		$sSql = "UPDATE control_asignacion SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idcontrol_asignacion =". $sKeyWrk;
		phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
		$EditData = true; // Update Successful
	}
	return $EditData;
}
?>
