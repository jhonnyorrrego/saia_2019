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
$sKey = @$_REQUEST["key"];
if (($sKey == "") || ($sKey == NULL)) { $sKey = @$_REQUEST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_REQUEST["a_edit"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_idtarea = @$_REQUEST["x_idtarea"];
	$x_nombre = @$_REQUEST["x_nombre"];
	$x_fecha = @$_REQUEST["x_fecha"];
	$x_tiempo_respuesta = @$_REQUEST["x_tiempo_respuesta"];
	$x_descripcion = @$_REQUEST["x_descripcion"];
	$x_reprograma = @$_REQUEST["x_reprograma"];
	$x_tipo_reprograma = @$_REQUEST["x_tipo_reprograma"];
}
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean();
	header("Location: tarealist.php");
	exit();
}

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;		
			ob_end_clean();
			header("Location: tarealist.php");
			exit();
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
			$_SESSION["ewmsg"] = "Actualización exitosa" . $sKey;
			ob_end_clean();
			header("Location: tarealist.php");
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
if (EW_this.x_nombre && !EW_hasValue(EW_this.x_nombre, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor ingrese los campos requeridos - nombre"))
		return false;
}
if (EW_this.x_fecha && !EW_checkdate(EW_this.x_fecha.value)) {
	if (!EW_onError(EW_this, EW_this.x_fecha, "TEXT", "Formato de fecha incorrecto yyyy/mm/dd - fecha"))
		return false; 
}
if (EW_this.x_tiempo_respuesta && !EW_checkinteger(EW_this.x_tiempo_respuesta.value)) {
	if (!EW_onError(EW_this, EW_this.x_tiempo_respuesta, "TEXT", "Entero Incorrecto - tiempo respuesta"))
		return false; 
}
if (EW_this.x_reprograma && !EW_checkinteger(EW_this.x_reprograma.value)) {
	if (!EW_onError(EW_this, EW_this.x_reprograma, "TEXT", "Entero Incorrecto - reprograma"))
		return false; 
}
return true;
}

//-->
</script>
<p><span class="phpmaker">Editar tarea<br><br><a href="tarealist.php">Regresar al listado</a></span></p>
<form name="tareaedit" id="tareaedit" action="tareaedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<input type="hidden" name="x_idtarea" value="<?php echo $x_idtarea; ?>">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCION</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" size="60" id="x_descripcion" name="x_descripcion" value="<?php echo @$x_descripcion; ?>" >

</span></td>
	</tr>
	<tr>
            <td class="encabezado">Periodicidad</td>
            <td bgcolor="#F5F5F5">
              <input type="text" name="x_reprograma" id="x_reprograma" size="5" value="<?php echo htmlspecialchars(@$x_reprograma) ?>">
              <select name="x_tipo_reprograma">
                <option value="hour"  <?php if($x_tipo_reprograma=="hour")  echo "selected"; ?> >Hora(s)       </option>
                <option value="day"   <?php if($x_tipo_reprograma=="day")   echo "selected"; ?> >D&iacute;a(s) </option>
                <option value="month" <?php if($x_tipo_reprograma=="month") echo "selected"; ?> >Mes(es)       </option>
                <option value="year"  <?php if($x_tipo_reprograma=="year")  echo "selected"; ?> >A&ntilde;o(s) </option>
              </select> 
            </td>
	        </tr>
	<tr> 
        <td width="188" title="Tiempo en horas (dias=numer*24 mes=numero*720) que transcurre entre la fecha y hora de asignacion de la tarea y la ejecucion del control o anuncio a Funcionario con nivel de jerarquia superior" class="encabezado"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span  style="color: #FFFFFF;">Tiempo Limite de Respuesta</span></font></td>
        <td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span >
        <input type="text" name="respuesta" value="<?php echo htmlspecialchars(@$x_tiempo_respuesta) ?>">
	        <select name="unidad">
	        <option value="1" selected>Horas</option>
	        <option value="24">Dias</option>
	        <option value="720">Mes(30dias)</option>
	        </select>
         </span></font>
         </td>
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
	global $_SESSION,$conn;
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
// Function EditData
// - Edit Data based on Key Value sKey
// - Variables used: field variables

function EditData($sKey,$conn)
{
	global $_SESSION;
	global $_REQUEST;	

	// Open record
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
		$EditData = false; // Update Failed
	}else{
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nombre"]) : $GLOBALS["x_nombre"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["nombre"] = $theValue;
		$theValue = ($GLOBALS["x_fecha"] != "") ? " '" . ConvertDateToMysqlFormat($GLOBALS["x_fecha"]) . "'" : "NULL";
		$fieldList["fecha"] = $theValue;
		$theValue = ($GLOBALS["x_tiempo_respuesta"] != "") ? intval($GLOBALS["x_tiempo_respuesta"]) : "NULL";
		$fieldList["tiempo_respuesta"] = $_REQUEST['respuesta']*$_REQUEST['unidad']; // Calcula el tiempo de respuesta en horas
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_descripcion"]) : $GLOBALS["x_descripcion"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["descripcion"] = $theValue;
		$theValue = ($GLOBALS["x_reprograma"] != "") ? intval($GLOBALS["x_reprograma"]) : "NULL";
		$fieldList["reprograma"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_tipo_reprograma"]) : $GLOBALS["x_tipo_reprograma"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["tipo_reprograma"] = $theValue;

		// update
		
		
		$sSql = "UPDATE tarea SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idtarea =". $sKeyWrk;
		
		phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
		$EditData = true; // Update Successful
	}
	return $EditData;
}
?>
