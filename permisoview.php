<?php include_once ("db.php") ?>
<?php //session_start(); ?>
<?php //ob_start(); ?>
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
$x_idpermiso = Null;
$x_funcionario_idfuncionario = Null;
$x_modulo_idmodulo = Null;
$x_accion = Null;
$x_caracteristica_propio = Null;
$x_caracteristica_grupo = Null;
$x_caracteristica_total = Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_GET["key"]; 
}
if (($sKey == "") || ((is_null($sKey)))) {
	redirecciona("funcionariolist.php"); 
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
			alerta("Registro no encontrado" . $sKey);
			redirecciona("funcionariolist.php");
			exit();
		}
}
?>
<?php include ("header.php") ?>
<span class="internos"><img class="imagen_internos" src="botones/configuracion/permiso.gif" border="0">&nbsp;&nbsp;VER PERMISOS DE ACCESO<br><br>
<!--a href="permisolist.php">Regresar al listado</a>&nbsp;
<a href="<?php echo "permisoedit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;
<a href="<?php echo "permisodelete.php?key=" . urlencode($sKey); ?>">Eliminar</a-->&nbsp;
</span>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FUNCIONARIO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
if ((!is_null($x_funcionario_idfuncionario)) && ($x_funcionario_idfuncionario <> "")) {
	$sSqlWrk = "SELECT *  FROM funcionario A";
	$sTmp = $x_funcionario_idfuncionario;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (A.idfuncionario = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombres"]." ".$rowwrk["apellidos"]." (".$rowwrk["login"].")";
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_funcionario_idfuncionario = $x_funcionario_idfuncionario; // Backup Original Value
$x_funcionario_idfuncionario = $sTmp;
?>
<?php echo $x_funcionario_idfuncionario; ?>
<?php $x_funcionario_idfuncionario = $ox_funcionario_idfuncionario; // Restore Original Value ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">M&Oacute;DULO ASIGNADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
if ((!is_null($x_modulo_idmodulo)) && $x_modulo_idmodulo <> "") {
	$sTmp = $x_modulo_idmodulo;
	$sTmp = addslashes($sTmp);
	$sSqlWrk = "SELECT *  FROM modulo A" . " WHERE (A.idmodulo = " . $sTmp . ")";
 	$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk) {
		if ($rowwrk = phpmkr_fetch_array($rswrk)) {
			$sTmp = $rowwrk["nombre"];
		}
	}
	phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_modulo_idmodulo = $x_modulo_idmodulo; // Backup Original Value
$x_modulo_idmodulo = $sTmp;
?>
<?php echo $x_modulo_idmodulo; ?>
<?php $x_modulo_idmodulo = $ox_modulo_idmodulo; // Restore Original Value ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ACCI&Oacute;N SOBRE EL M&Oacute;DULO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
switch ($x_accion) {
	case "1":
		$sTmp = "Asignar";
		break;
	case "0":
		$sTmp = "Negar";
		break;
	default:
		$sTmp = "";
}
$ox_accion = $x_accion; // Backup Original Value
$x_accion = $sTmp;
?>
<?php echo $x_accion; ?>
<?php $x_accion = $ox_accion; // Restore Original Value ?>
</span></td>
	</tr>
	
</table>
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM permiso A";
	$sSql .= " WHERE A.idpermiso = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idpermiso"] = $row["idpermiso"];
		$GLOBALS["x_funcionario_idfuncionario"] = $row["funcionario_idfuncionario"];
		$GLOBALS["x_modulo_idmodulo"] = $row["modulo_idmodulo"];
		$GLOBALS["x_accion"] = $row["accion"];
		$GLOBALS["x_caracteristica_propio"] = $row["caracteristica_propio"];
		$GLOBALS["x_caracteristica_grupo"] = $row["caracteristica_grupo"];
		$GLOBALS["x_caracteristica_total"] = $row["caracteristica_total"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
