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

$idtarea=$_REQUEST['$idtarea']; // NO SE DEBE USAR key .. por que se usa para el copy
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

// Get action
$sAction = @$HTTP_POST_VARS["a_add"];
if (($sAction == "") || (($sAction == NULL))) {
	$sKey = @$HTTP_GET_VARS["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey <> "") {
		$sAction = "C"; // Copy record
	}
	else
	{
		$sAction = "I"; // Display blank record
	}
}
else
{

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
global $conn;

switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$HTTP_SESSION_VARS["ewmsg"] = "Registro no encontrado" . $sKey;
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: control_tarealist.php?cmd=resetall");
			exit();
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			$HTTP_SESSION_VARS["ewmsg"] = "Adici&oacute;n exitosa del registro.";
		//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: control_tarealist.php?cmd=resetall&key=".@$HTTP_POST_VARS["x_tarea_idtarea"]);
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

<form name="control_tareaadd" id="control_tareaadd" action="control_tareaadd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Accion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">

<select  id="x_accion" name="x_accion">
	 <option name="correo" value="enviar_correo.php">Correo</option>	
	 <option name="mensajeria" value="enviar_mensaje.php">Mensajeria</option>	
    </select> 
</span></td>
	</tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Periodicidad</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<input type="text" name="x_periocidad" id="x_periocidad" size="5" value="<?php echo htmlspecialchars(@$x_periocidad) ?>">
</span>
	  <select name="x_tipo_periocidad">
	   <option name="hora" value="hour">Minutos</option>
     <option name="dia" value="day">D&iacute;a</option>
     <option name="dia" value="month">Mes</option>
     <option name="anio" value="year">A&ntilde;o</option>
    </select></td>
<input type="hidden" name="x_tarea_idtarea" id="x_tarea_idtarea" size="30" value="<?php echo $_REQUEST['idtarea'];?>">
</span></td>
	</tr>
	<tr><td class="encabezado">Fecha Inicial:</td>
  <td> 
  <input type="text" name="x_fecha_inicial" id="x_fecha_inicial" value="<?php echo date("Y/m/d H:i:s"); ?>"> <?php selector_fecha("x_fecha_actualizacion","control_tareaadd","Y/m/d H:i:s",date("m"),date("Y"),"default.css","../","AD:VALOR","VENTANA"); ?></td><tr>
  
  </td></tr>
  <tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">estado</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!($x_estado != NULL) || ($x_estado == "")) { $x_estado = "PENDIENTE";} // Set default value ?>
<input type="text" readonly="true" id="x_estado" name="x_estado" value="<?php echo @$x_estado; ?>" >

</span></td>
	</tr>

</table>
<p>
<input type="submit" name="Action" value="Adicionar">
</form>
<?php include ("../footer.php") ?>
<?php
phpmkr_db_close($conn);
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{ global $conn;
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
	$rs = phpmkr_query($sSql,$conn) or die("Fallo la busqueda" . phpmkr_error() . ' SQL:' . $sSql);
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
// Function AddData
// - Add Data
// - Variables used: field variables

function AddData($conn)
{ global $conn;
	global $HTTP_SESSION_VARS;
	global $HTTP_POST_VARS;
	global $HTTP_POST_FILES;
	global $HTTP_ENV_VARS;

	
	// Field accion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_accion"]) : $GLOBALS["x_accion"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["accion"] = $theValue;

	// Field periocidad
	$theValue = ($GLOBALS["x_periocidad"] != "") ? intval($GLOBALS["x_periocidad"]) : "NULL";
	$fieldList["periocidad"] = $theValue;

	// Field tipo_periocidad
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_tipo_periocidad"]) : $GLOBALS["x_tipo_periocidad"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["tipo_periocidad"] = $theValue;

	// Field tarea_idtarea
	$theValue = ($GLOBALS["x_tarea_idtarea"] != "") ? intval($GLOBALS["x_tarea_idtarea"]) : "NULL";
	$fieldList["tarea_idtarea"] = $theValue;
    

	// Field estado
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_estado"]) : $GLOBALS["x_estado"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["estado"] = $theValue;

  // Field fecha_actualizacion
	$theValue=fecha_db_almacenar($GLOBALS["x_fecha_actualizacion"],"Y-m-d H:i:s");
	$fieldList["fecha_actualizacion"] = $theValue;
	$fieldList["fecha_inicial"] = $theValue;   // Se igualan las fechas .. luego fecha inicial permanece..
	// Field fecha_inicial
  //$fieldList["fecha_inicial"] = $theValue;

	
  // insert into database
	$strsql = "INSERT INTO control_tarea (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	
	phpmkr_query($strsql, $conn) or die("Fallo la busqueda" . phpmkr_error() . ' SQL:' . $strsql);
	return true;
}
?>
