<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

include ("db.php");
include ("phpmkrfn.php") ;

include_once("pantallas/lib/librerias_cripto.php");
$validar_enteros=array("x_funcionario_idfuncionario","x_idpermiso","x_modulo_idmodulo");
include_once("librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

$ewCurSec = 0; // Initialise

// Initialize common variables
$x_idpermiso = Null;
$x_funcionario_idfuncionario = Null;
$x_modulo_idmodulo = Null;
$x_accion = Null;
$x_caracteristica_propio = Null;
$x_caracteristica_grupo = Null;
$x_caracteristica_total = Null;

// Load Key Parameters
$sKey = @$_GET["key"];
if(@$_REQUEST["x_funcionario_idfuncionario"])
  $x_funcionario_idfuncionario=@$_REQUEST["x_funcionario_idfuncionario"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_POST["key_d"];
}
$sDbWhere = "";
$arRecKey = split(",",$sKey);

// Single delete record
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	redirecciona("funcionariolist.php");
	exit();
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idpermiso=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}
switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount("A.".$sDbWhere,$conn) <= 0) {
		  alerta("Problemas al encontrar el Permiso");
			redirecciona("funcionariolist.php");
		}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			alerta("Eliminacion Exitosa");
			abrir_url("funcionario.php?key=".$x_funcionario_idfuncionario,"_parent");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/permiso.gif" border="0">&nbsp;&nbsp;ELIMINAR PERMISO DE ACCESO<br><br>
<!--a href="permisolist.php">Regresar al listado</a--></span></p>
<form id="permisodelete" name="permisodelete" action="permisodelete.php" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">

<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Funcionario</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Modulo Asignado</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Accion</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">caracteristica propio</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">caracteristica grupo</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">caracteristica total</span></td>
	</tr>
<?php
$nRecCount = 0;
foreach ($arRecKey as $sRecKey) {
	$sRecKey = trim($sRecKey);
	$sRecKey = (get_magic_quotes_gpc()) ? stripslashes($sRecKey) : $sRecKey;
	$nRecCount = $nRecCount + 1;

	// Set row color
	$sItemRowClass = " bgcolor=\"#FFFFFF\"";

	// Display alternate color for rows
	if ($nRecCount % 2 <> 0) {
		$sItemRowClass = " bgcolor=\"#F5F5F5\"";
	}
	if (LoadData($sRecKey,$conn)) {
?>
	<tr<?php echo $sItemRowClass;?>>
		<td><span class="phpmaker">
<?php
if ((!is_null($x_funcionario_idfuncionario)) && ($x_funcionario_idfuncionario <> "")) {
	$sSqlWrk = "SELECT *  FROM funcionario A";
	$sTmp = $x_funcionario_idfuncionario;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (A.idfuncionario = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["login"];
		$x_funcionario_idfuncionario= $rowwrk["idfuncionario"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}


?>
<?php echo $sTmp; ?>
<input type="hidden" name="x_funcionario_idfuncionario" value="<?php echo($x_funcionario_idfuncionario);?>">
</span></td>
		<td><span class="phpmaker">
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
		<td><span class="phpmaker">
<?php if($x_accion==1)
        echo ("Adicionar");
      else echo("Quitar");
?>
</span></td>
		<td><span class="phpmaker">
<?php
$ar_x_caracteristica_propio = explode(",", @$x_caracteristica_propio);
$sTmp = "";
$rowcntwrk = 0;
foreach($ar_x_caracteristica_propio as $cnt_x_caracteristica_propio) {
	switch (trim($cnt_x_caracteristica_propio)) {
		case "l":
			$sTmp .= "leer";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "a":
			$sTmp .= "escribir";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "m":
			$sTmp .= "modificar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "e":
			$sTmp .= "eliminar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
	}
	$rowcntwrk++;
}
if (strlen($sTmp) > 0) { $sTmp = substr($sTmp, 0, strlen($sTmp)-strlen($sTmp1)); }
$ox_caracteristica_propio = $x_caracteristica_propio; // Backup Original Value
$x_caracteristica_propio = $sTmp;
?>
<?php echo $x_caracteristica_propio; ?>
<?php $x_caracteristica_propio = $ox_caracteristica_propio; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php
$ar_x_caracteristica_grupo = explode(",", @$x_caracteristica_grupo);
$sTmp = "";
$rowcntwrk = 0;
foreach($ar_x_caracteristica_grupo as $cnt_x_caracteristica_grupo) {
	switch (trim($cnt_x_caracteristica_grupo)) {
		case "l":
			$sTmp .= "leer";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "a":
			$sTmp .= "adicionar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "m":
			$sTmp .= "modificar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "e":
			$sTmp .= "editar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
	}
	$rowcntwrk++;
}
if (strlen($sTmp) > 0) { $sTmp = substr($sTmp, 0, strlen($sTmp)-strlen($sTmp1)); }
$ox_caracteristica_grupo = $x_caracteristica_grupo; // Backup Original Value
$x_caracteristica_grupo = $sTmp;
?>
<?php echo $x_caracteristica_grupo; ?>
<?php $x_caracteristica_grupo = $ox_caracteristica_grupo; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php
$ar_x_caracteristica_total = explode(",", @$x_caracteristica_total);
$sTmp = "";
$rowcntwrk = 0;
foreach($ar_x_caracteristica_total as $cnt_x_caracteristica_total) {
	switch (trim($cnt_x_caracteristica_total)) {
		case "l":
			$sTmp .= "leer";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "a":
			$sTmp .= "adicionar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "m":
			$sTmp .= "modificar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "e":
			$sTmp .= "eliminar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
	}
	$rowcntwrk++;
}
if (strlen($sTmp) > 0) { $sTmp = substr($sTmp, 0, strlen($sTmp)-strlen($sTmp1)); }
$ox_caracteristica_total = $x_caracteristica_total; // Backup Original Value
$x_caracteristica_total = $sTmp;
?>
<?php echo $x_caracteristica_total; ?>
<?php $x_caracteristica_total = $ox_caracteristica_total; // Restore Original Value ?>
</span></td>
	</tr>

<?php
	}
}
?>
</table>
<p>
<input type="submit" name="Action" value="Confirmar Borrado">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables
encriptar_sqli("permisodelete",1); 
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
		if (phpmkr_num_rows($rs) == 0) {

		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);
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
<?php

//-------------------------------------------------------------------------------
// Function LoadRecordCount
// - Load Record Count based on input sql criteria sqlKey

function LoadRecordCount($sqlKey,$conn)
{
	$sSql = "SELECT * FROM permiso A";
	$sSql .= " WHERE " . $sqlKey;
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
	return phpmkr_num_rows($rs);
	phpmkr_free_result($rs);
}
?>
<?php

//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey

function DeleteData($sqlKey,$conn)
{
	$sSql = "Delete FROM permiso";
	$sSql .= " WHERE " . $sqlKey;
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
	phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	return true;
}
?>

