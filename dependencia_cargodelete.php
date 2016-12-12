<?php 
include_once("db.php") ;
include ("phpmkrfn.php");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
$ewCurSec = 0; // Initialise
// Initialize common variables
$x_iddependencia_cargo = Null;
$x_funcionario_idfuncionario = Null;
$x_dependencia_iddependencia = Null;
$x_cargo_idcargo = Null;
 
// Load Key Parameters
$sKey = @$_GET["key"];
if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$_POST["key_d"];
}
$sDbWhere = "";
$arRecKey = split(",",$sKey);

// Single delete record
if (($sKey == "") || (($sKey == NULL))) {
	alerta("Rol no encontrado");
	abrir_url("funcionariolist.php","_parent");
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "iddependencia_cargo=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}
$x_funcionario_idfuncionario=@$_REQUEST["x_funcionario_idfuncionario"];
switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount("A.".$sDbWhere,$conn) <= 0) {			
			abrir_url("funcionario.php?key=".@$x_funcionario_idfuncionario,"centro");
			exit();
		}
		break;
	case "D": // Delete
		if (DeleteData(trim($sKey),$conn)) {
			abrir_url("funcionario.php?key=".@$x_funcionario_idfuncionario,"_parent");
			die();
		}
		break;
}
 include ("header.php") 
 
 ?>
<p><span class="internos">Eliminar Rol de Funcionario<br><!--a href="dependencia_cargolist.php">Volver al Listado</a--></span></p>
<form action="dependencia_cargodelete.php" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">dependencia cargo</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">funcionario</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">dependencia</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">cargo</span></td>
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
<?php echo $x_iddependencia_cargo; ?>
</span></td>
		<td><span class="phpmaker">
<?php
if (($x_funcionario_idfuncionario != NULL) && ($x_funcionario_idfuncionario <> "")) {
  $sTmp = $x_funcionario_idfuncionario;
	$sTmp = addslashes($sTmp);
  $funcionarios=busca_filtro_tabla("A.*","funcionario A","A.idfuncionario = " . $sTmp,"",$conn);
	if ($funcionarios["numcampos"]) {
		$sTmp = $funcionarios[0]["login"];
		$sTmp .= " " . $funcionarios[0]["nit"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
 echo $sTmp;  
 ?>
</span>
<input type="hidden" name="x_funcionario_idfuncionario" value="<?php echo  $x_funcionario_idfuncionario; ?>">
</td>
<td><span class="phpmaker">
<?php
if (($x_dependencia_iddependencia != NULL) && ($x_dependencia_iddependencia <> "")) {
	$sSqlWrk = "SELECT DISTINCT *  FROM dependencia A";
	$sTmp = $x_dependencia_iddependencia;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (A.iddependencia = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk) or error("Fall� al Ejecutar la B�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_dependencia_iddependencia = $x_dependencia_iddependencia; // Backup Original Value
$x_dependencia_iddependencia = $sTmp;
?>
<?php echo $x_dependencia_iddependencia; ?>
<?php $x_dependencia_iddependencia = $ox_dependencia_iddependencia; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php
if (($x_cargo_idcargo != NULL) && ($x_cargo_idcargo <> "")) {
	$sSqlWrk = "SELECT DISTINCT *  FROM cargo A";
	$sTmp = $x_cargo_idcargo;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (A.idcargo = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk) or error("Fall� al Ejecutar la B�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_cargo_idcargo = $x_cargo_idcargo; // Backup Original Value
$x_cargo_idcargo = $sTmp;
?>
<?php echo $x_cargo_idcargo; ?>
<?php $x_cargo_idcargo = $ox_cargo_idcargo; // Restore Original Value ?>
</span></td>
	</tr>
<?php
	}
}
?>
</table>
<p>
<input type="submit" name="Action" value="CONFIRMAR BORRADO">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey)
{
	global $x_iddependencia_cargo;
	global $x_funcionario_idfuncionario;
	global $x_dependencia_iddependencia;
	global $x_cargo_idcargo;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM dependencia_cargo A";
	$sSql .= " WHERE A.iddependencia_cargo = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql) or error("Fall� al Ejecutar la B�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_iddependencia_cargo = $row["iddependencia_cargo"];
		$x_funcionario_idfuncionario = $row["funcionario_idfuncionario"];
		$x_dependencia_iddependencia = $row["dependencia_iddependencia"];
		$x_cargo_idcargo = $row["cargo_idcargo"];
		
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadRecordCount
// - Load Record Count based on input sql criteria sqlKey

function LoadRecordCount($sqlKey)
{
	global $_SESSION;
	$sSql = "SELECT * FROM dependencia_cargo A";
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
	$rs = phpmkr_query($sSql) or die("Fall� al Ejecutar la B�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	return phpmkr_num_rows($rs);
	phpmkr_free_result($rs);
}
?>
<?php

//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey

function DeleteData($sqlKey)
{
	global $_SESSION;
	$sSql = "update dependencia_cargo set estado=0,fecha_final=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." where iddependencia_cargo=$sqlKey";
	phpmkr_query($sSql);
	validar_tipo_cargo($sqlKey);
	return true;
}
function validar_tipo_cargo($idrol){
	$funcionario=busca_filtro_tabla("funcionario_idfuncionario","dependencia_cargo a","a.iddependencia_cargo=".$idrol,"",$conn);
	$roles_activos=busca_filtro_tabla("","dependencia_cargo a, cargo b","a.funcionario_idfuncionario=".$funcionario[0]["funcionario_idfuncionario"]." and a.estado=1 and a.cargo_idcargo=b.idcargo and b.estado=1 and b.tipo_cargo='1'","",$conn);
	if(!$roles_activos["numcampos"]){
		alerta("<b>ATENCI&Oacute;N</b><br>El funcionario debe tener por lo menos un rol con cargo administrativo, se activara este rol automaticamente","warning");
		$sSql = "update dependencia_cargo set estado=1,fecha_final=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." where iddependencia_cargo=$idrol";
		phpmkr_query($sSql);
	}
}
?>
