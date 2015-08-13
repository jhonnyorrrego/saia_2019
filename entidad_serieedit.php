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
$x_identidad_serie = Null;
$x_entidad_identidad = Null;
$x_serie_idserie = Null;
$x_llave_entidad = Null;
$x_estado = Null;
$x_tipo = Null;
$x_fecha = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || (is_null($sKey))) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_identidad_serie = @$_POST["x_identidad_serie"];
	$x_entidad_identidad = @$_POST["x_entidad_identidad"];
	$x_serie_idserie = @$_POST["x_serie_idserie"];
	$x_llave_entidad = @$_POST["x_llave_entidad"];
	$x_estado = @$_POST["x_estado"];
	$x_tipo = @$_POST["x_tipo"];
	$x_fecha = @$_POST["x_fecha"];
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	header("Location: entidad_serielist.php");
	exit();
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: entidad_serielist.php");
			exit();
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
			$_SESSION["ewmsg"] = "Actualizaci�n exitosa" . $sKey;
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: entidad_serielist.php");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_entidad_identidad && !EW_hasValue(EW_this.x_entidad_identidad, "SELECT" )) {
	if (!EW_onError(EW_this, EW_this.x_entidad_identidad, "SELECT", "Por favor ingrese los campos requeridos - Entidad Asociada"))
		return false;
}
if (EW_this.x_serie_idserie && !EW_hasValue(EW_this.x_serie_idserie, "SELECT" )) {
	if (!EW_onError(EW_this, EW_this.x_serie_idserie, "SELECT", "Por favor ingrese los campos requeridos - Serie"))
		return false;
}
if (EW_this.x_llave_entidad && !EW_hasValue(EW_this.x_llave_entidad, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_llave_entidad, "TEXT", "Por favor ingrese los campos requeridos - FDC"))
		return false;
}
if (EW_this.x_llave_entidad && !EW_checkinteger(EW_this.x_llave_entidad.value)) {
	if (!EW_onError(EW_this, EW_this.x_llave_entidad, "TEXT", "Entero Incorrecto - FDC"))
		return false; 
}
if (EW_this.x_estado && !EW_hasValue(EW_this.x_estado, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_estado, "TEXT", "Por favor ingrese los campos requeridos - Estado"))
		return false;
}
if (EW_this.x_estado && !EW_checkinteger(EW_this.x_estado.value)) {
	if (!EW_onError(EW_this, EW_this.x_estado, "TEXT", "Entero Incorrecto - Estado"))
		return false; 
}
if (EW_this.x_tipo && !EW_hasValue(EW_this.x_tipo, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_tipo, "TEXT", "Por favor ingrese los campos requeridos - Tipo"))
		return false;
}
if (EW_this.x_tipo && !EW_checkinteger(EW_this.x_tipo.value)) {
	if (!EW_onError(EW_this, EW_this.x_tipo, "TEXT", "Entero Incorrecto - Tipo"))
		return false; 
}
return true;
}

//-->
</script>
<p><span class="phpmaker">Editar Tabla: entidad serie<br><br><a href="entidad_serielist.php">Regresar al listado</a></span></p>
<form name="entidad_serieedit" id="entidad_serieedit" action="entidad_serieedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">identidad serie</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_identidad_serie; ?><input type="hidden" name="x_identidad_serie" value="<?php echo $x_identidad_serie; ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">Entidad Asociada</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$x_entidad_identidadList = "<select name=\"x_entidad_identidad\">";
$x_entidad_identidadList .= "<option value=''>Por favor seleccionar</option>";
$sSqlWrk = "SELECT DISTINCT identidad, nombre FROM entidad" . " ORDER BY nombre Asc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_entidad_identidadList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		if ($datawrk["identidad"] == @$x_entidad_identidad) {
			$x_entidad_identidadList .= "' selected";
		}
		$x_entidad_identidadList .= ">" . $datawrk["nombre"] . "</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_entidad_identidadList .= "</select>";
echo $x_entidad_identidadList;
?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">Serie</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$x_serie_idserieList = "<select name=\"x_serie_idserie\">";
$x_serie_idserieList .= "<option value=''>Por favor seleccionar</option>";
$sSqlWrk = "SELECT DISTINCT idserie, nombre, codigo FROM serie" . " ORDER BY nombre Asc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_serie_idserieList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		if ($datawrk["idserie"] == @$x_serie_idserie) {
			$x_serie_idserieList .= "' selected";
		}
		$x_serie_idserieList .= ">" . $datawrk["nombre"] . ValueSeparator($rowcntwrk) . $datawrk["codigo"] . "</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_serie_idserieList .= "</select>";
echo $x_serie_idserieList;
?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">FDC</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_llave_entidad" id="x_llave_entidad" size="30" value="<?php echo htmlspecialchars(@$x_llave_entidad) ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">Estado</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_estado" id="x_estado" size="30" value="<?php echo htmlspecialchars(@$x_estado) ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">Tipo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_tipo" id="x_tipo" size="30" value="<?php echo htmlspecialchars(@$x_tipo) ?>">
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Editar">
</form>
<?php include ("footer.php") ?>
<?php
phpmkr_db_close($conn);
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM entidad_serie";
	$sSql .= " WHERE identidad_serie = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_identidad_serie"] = $row["identidad_serie"];
		$GLOBALS["x_entidad_identidad"] = $row["entidad_identidad"];
		$GLOBALS["x_serie_idserie"] = $row["serie_idserie"];
		$GLOBALS["x_llave_entidad"] = $row["llave_entidad"];
		$GLOBALS["x_estado"] = $row["estado"];
		$GLOBALS["x_tipo"] = $row["tipo"];
		$GLOBALS["x_fecha"] = $row["fecha"];
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

	// Open record
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM entidad_serie";
	$sSql .= " WHERE identidad_serie = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$EditData = false; // Update Failed
	}else{
		$theValue = ($GLOBALS["x_entidad_identidad"] != "") ? intval($GLOBALS["x_entidad_identidad"]) : "NULL";
		$fieldList["entidad_identidad"] = $theValue;
		$theValue = ($GLOBALS["x_serie_idserie"] != "") ? intval($GLOBALS["x_serie_idserie"]) : "NULL";
		$fieldList["serie_idserie"] = $theValue;
		$theValue = ($GLOBALS["x_llave_entidad"] != "") ? intval($GLOBALS["x_llave_entidad"]) : "NULL";
		$fieldList["llave_entidad"] = $theValue;
		$theValue = ($GLOBALS["x_estado"] != "") ? intval($GLOBALS["x_estado"]) : "NULL";
		$fieldList["estado"] = $theValue;
		$theValue = ($GLOBALS["x_tipo"] != "") ? intval($GLOBALS["x_tipo"]) : "NULL";
		$fieldList["tipo"] = $theValue;

		// update
		$sSql = "UPDATE entidad_serie SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE identidad_serie =". $sKeyWrk;
		phpmkr_query($sSql,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
		$EditData = true; // Update Successful
	}
	return $EditData;
}
?>
