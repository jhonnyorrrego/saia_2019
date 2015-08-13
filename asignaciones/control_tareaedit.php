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
	$x_idcontrol_tarea = @$HTTP_POST_VARS["x_idcontrol_tarea"];
	$x_accion = @$HTTP_POST_VARS["x_accion"];
	$x_periocidad = @$HTTP_POST_VARS["x_periocidad"];
	$x_tipo_periocidad = @$HTTP_POST_VARS["x_tipo_periocidad"];
	$x_tarea_idtarea = @$HTTP_POST_VARS["x_tarea_idtarea"];
	$x_estado = @$HTTP_POST_VARS["x_estado"];
	$x_fecha_inicial = @$HTTP_POST_VARS["x_fecha_inicial"];
	$x_fecha_actualizacion = @$HTTP_POST_VARS["x_fecha_actualizacion"];
}
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean();
	header("Location: control_tarealist.php?key=".$_REQUEST["idasig"]);
	exit();
}

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$HTTP_SESSION_VARS["ewmsg"] = "Registro no encontrado" . $sKey;
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: control_tarealist.php?key=".$_REQUEST["idasig"]);
			exit();
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
			$HTTP_SESSION_VARS["ewmsg"] = "Actualizacion exitosa" ;
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: control_tarealist.php?key=".$_REQUEST["idasig"]);
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
if (EW_this.x_tarea_idtarea && !EW_hasValue(EW_this.x_tarea_idtarea, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_tarea_idtarea, "TEXT", "Por favor ingrese los campos requeridos - tarea idtarea"))
		return false;
}
if (EW_this.x_tarea_idtarea && !EW_checkinteger(EW_this.x_tarea_idtarea.value)) {
	if (!EW_onError(EW_this, EW_this.x_tarea_idtarea, "TEXT", "Entero Incorrecto - tarea idtarea"))
		return false; 
}
if (EW_this.x_estado && !EW_hasValue(EW_this.x_estado, "TEXTAREA" )) {
	if (!EW_onError(EW_this, EW_this.x_estado, "TEXTAREA", "Por favor ingrese los campos requeridos - estado"))
		return false;
}
if (EW_this.x_fecha_inicial && !EW_hasValue(EW_this.x_fecha_inicial, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_fecha_inicial, "TEXT", "Por favor ingrese los campos requeridos - fecha inicial"))
		return false;
}
if (EW_this.x_fecha_inicial && !EW_checkdate(EW_this.x_fecha_inicial.value)) {
	if (!EW_onError(EW_this, EW_this.x_fecha_inicial, "TEXT", "Formato de fecha incorrecto yyyy/mm/dd - fecha inicial"))
		return false; 
}
if (EW_this.x_fecha_actualizacion && !EW_checkdate(EW_this.x_fecha_actualizacion.value)) {
	if (!EW_onError(EW_this, EW_this.x_fecha_actualizacion, "TEXT", "Formato de fecha incorrecto yyyy/mm/dd - fecha actualizacion"))
		return false; 
}
return true;
}

//-->
</script>

<form name="control_tareaedit" id="control_tareaedit" action="control_tareaedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<input type="hidden" name="x_idcontrol_tarea" value="<?php echo $x_idcontrol_tarea; ?>">
<input type="hidden" name="x_tarea_idtarea" id="x_tarea_idtarea" size="30" value="<?php echo htmlspecialchars(@$x_tarea_idtarea) ?>">
<input type="hidden" name="x_fecha_actualizacion" id="x_fecha_actualizacion" value="<?php echo FormatDateTime(@$x_fecha_actualizacion,5); ?>">
<input type="hidden" name="idasig" id="idasig" value="<?php echo $_REQUEST["idasig"]; ?>">

<input type="hidden" name="x_fecha_actualizacion" id="x_fecha_actualizacion" value="<?php echo FormatDateTime(@$x_fecha_actualizacion,5); ?>">

<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">accion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<select  id="x_accion" name="x_accion">
	 <option name="correo" value="enviar_correo.php"<?php if(@$x_accion=="enviar_correo.php") echo " selected "; ?> >Correo</option>	
	 <option name="mensajeria" value="enviar_mensaje.php" <?php if(@$x_accion=="enviar_mensaje.php") echo " selected "; ?> >Mensajeria</option>	
</select> 
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">periocidad</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_periocidad" id="x_periocidad" size="30" value="<?php echo htmlspecialchars(@$x_periocidad) ?>">
&nbsp;
 <select name="x_tipo_periocidad">
	   <option name="hora" value="hour" <?php if(@$x_tipo_periocidad=="hour")  echo " selected "; ?> >Hora</option>
     <option name="dia" value="day"   <?php if(@$x_tipo_periocidad=="day")   echo " selected "; ?>>D&iacute;a</option>
     <option name="dia" value="month" <?php if(@$x_tipo_periocidad=="month") echo " selected "; ?>>Mes</option>
     <option name="anio" value="year" <?php if(@$x_tipo_periocidad=="year")  echo " selected "; ?> >A&ntilde;o</option>
    </select>
</span></td>
	</tr>
 	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">estado</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<input type="text" name="x_estado" id="x_estado" value="<?php echo @$x_estado; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">fecha inicial</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type="text" name="x_fecha_inicial" id="x_fecha_inicial" value="<?php echo FormatDateTime(@$x_fecha_inicial,5); ?>"> <?php selector_fecha("x_fecha_inicial","control_tareaedit","Y/m/d H:i:s",date("m"),date("Y"),"default.css","../","AD:VALOR","VENTANA"); ?></td><tr>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Editar">
</form>
<?php include ("../footer.php") ?>

<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
  global $conn;
	global $HTTP_SESSION_VARS;
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
<?php

//-------------------------------------------------------------------------------
// Function EditData
// - Edit Data based on Key Value sKey
// - Variables used: field variables

function EditData($sKey,$conn)
{ global $conn;
	global $HTTP_SESSION_VARS;
	global $HTTP_POST_VARS;
	global $HTTP_POST_FILES;
	global $HTTP_ENV_VARS;

	// Open record
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
		$theValue = ($GLOBALS["x_tarea_idtarea"] != "") ? intval($GLOBALS["x_tarea_idtarea"]) : "NULL";
		$fieldList["tarea_idtarea"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_estado"]) : $GLOBALS["x_estado"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["estado"] = $theValue;
		$theValue = ($GLOBALS["x_fecha_inicial"] != "") ? " '" . ConvertDateToMysqlFormat($GLOBALS["x_fecha_inicial"]) . "'" : "NULL";
		$fieldList["fecha_inicial"] = $theValue;
		$theValue = ($GLOBALS["x_fecha_actualizacion"] != "") ? " '" . ConvertDateToMysqlFormat($GLOBALS["x_fecha_actualizacion"]) . "'" : "NULL";
		$fieldList["fecha_actualizacion"] = $theValue;

		// update
		$sSql = "UPDATE control_tarea SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idcontrol_tarea =". $sKeyWrk;
		phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
		$EditData = true; // Update Successful
	}
	return $EditData;
}
?>
