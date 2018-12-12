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
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_GET["key"];
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	header("Location entidad_serielist.php");
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}

// Open connection to the database
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location entidad_serielist.php");
			exit();
		}
}
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/serie.gif" border="0">&nbsp; Serie Asignada
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">identidad serie</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_identidad_serie; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Entidad Asociada</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
if ((!is_null($x_entidad_identidad)) && ($x_entidad_identidad <> "")) {
	$sSqlWrk = "SELECT DISTINCT *  FROM entidad";
	$sTmp = $x_entidad_identidad;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (identidad = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_entidad_identidad = $x_entidad_identidad; // Backup Original Value
$x_entidad_identidad = $sTmp;
?>
<?php echo $x_entidad_identidad; ?>
<?php $x_entidad_identidad = $ox_entidad_identidad; // Restore Original Value ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Serie</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
if ((!is_null($x_serie_idserie)) && ($x_serie_idserie <> "")) {
	$sSqlWrk = "SELECT DISTINCT *  FROM serie";
	$sTmp = $x_serie_idserie;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (idserie = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
		$sTmp .= ValueSeparator(0) . $rowwrk["codigo"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_serie_idserie = $x_serie_idserie; // Backup Original Value
$x_serie_idserie = $sTmp;
?>
<?php echo $x_serie_idserie; ?>
<?php $x_serie_idserie = $ox_serie_idserie; // Restore Original Value ?>
</span></td>
	</tr>
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FDC</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_llave_entidad; ?>
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Estado</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
switch($x_estado){
  case 1:
    echo "ACTIVO";
  break;
  case 0:
    echo "INACTIVO";
  break;
}
?>
</span></td>
	</tr>
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tipo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_tipo; ?>
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Fecha de creacion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo FormatDateTime($x_fecha,5); ?>
</span></td>
	</tr>
</table>
</form>
<p>
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
