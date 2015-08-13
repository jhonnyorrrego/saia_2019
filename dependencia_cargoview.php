<?php include ("db.php") ?>
<?php //ession_start(); ?>
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
			
?>
<?php

// Initialize common variables
$x_iddependencia_cargo = Null;
$x_funcionario_idfuncionario = Null;
$x_dependencia_iddependencia = Null;
$x_cargo_idcargo = Null;
$x_estado = Null;
$x_fecha_inicial = Null;
$x_fecha_final = Null;
$x_fecha_ingreso = Null;
?>

<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_GET["key"]; 
}
if (($sKey == "") || ((is_null($sKey)))) {
	alerta("Rol no encontrado");
	abrir_url("dependencia_cargolist.php","_parent"); 
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}

// Open connection to the database
$x_funcionario_idfuncionario=@$_REQUEST["x_funcionario_idfuncionario"];
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			alerta("Registro no encontrado" . $sKey);
			abrir_url("dependencia_cargolist.php","centro");
		}
}
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/dependencia_cargo.png" border="0">&nbsp;&nbsp;VER ROL DEL FUNCIONARIO<br><br>
<!--a href="dependencia_cargolist.php">Regresar al listado</a-->&nbsp;
<!--a href="<?php echo "dependencia_cargoedit.php?key=" . urlencode($sKey); ?>">Editar</a-->
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FUNCIONARIO DE INTRANET</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
if ((!is_null($x_funcionario_idfuncionario)) && ($x_funcionario_idfuncionario <> "")) {
	$sSqlWrk = "SELECT A.*  FROM funcionario A";
	$sTmp = $x_funcionario_idfuncionario;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (A.idfuncionario = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["login"];
		$sTmp .= ValueSeparator(0) . $rowwrk["funcionario_codigo"];
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
<input type="hidden" name="x_funcionario_idfuncionario" value="<?php echo  $x_funcionario_idfuncionario; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PROCESO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
if ((!is_null($x_dependencia_iddependencia)) && ($x_dependencia_iddependencia <> "")) {
	$sSqlWrk = "SELECT DISTINCT A.*  FROM dependencia A";
	$sTmp = $x_dependencia_iddependencia;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (A.iddependencia = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
		$sTmp .= ValueSeparator(0) . $rowwrk["codigo"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
if(!$rowwrk["estado"]){
  $estado_c='<img src="botones/general/menos.png">';
}
else{
  $estado_c='<img src="botones/general/mas.png">';
}
$ox_dependencia_iddependencia = $x_dependencia_iddependencia; // Backup Original Value
$x_dependencia_iddependencia = $sTmp;
?>
<?php echo $estado_c." ".$x_dependencia_iddependencia; ?>
<?php $x_dependencia_iddependencia = $ox_dependencia_iddependencia; // Restore Original Value ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CARGO ASIGNADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
if ((!is_null($x_cargo_idcargo)) && ($x_cargo_idcargo <> "")) {
	$sSqlWrk = "SELECT DISTINCT A.*  FROM cargo A";
	$sTmp = $x_cargo_idcargo;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (A.idcargo = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
if(!$rowwrk["estado"]){
  $estado_c='<img src="botones/general/menos.png">';
}
else{
  $estado_c='<img src="botones/general/mas.png">';
}
$ox_cargo_idcargo = $x_cargo_idcargo; // Backup Original Value
$x_cargo_idcargo = $sTmp;
?>
<?php echo $estado_c." ".$x_cargo_idcargo; ?>
<?php $x_cargo_idcargo = $ox_cargo_idcargo; // Restore Original Value ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO ACTUAL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
switch ($x_estado) {
	case "1":
		$sTmp = "Activo";
		break;
	case "0":
		$sTmp = "Inactivo";
		break;
	default:
		$sTmp = "";
}
$ox_estado = $x_estado; // Backup Original Value
$x_estado = $sTmp;
?>
<?php echo $x_estado; ?>
<?php $x_estado = $ox_estado; // Restore Original Value ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA INICIO DE ACTIVIDADES</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_fecha_inicial; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA FINAL DE ACTIVIDADES</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_fecha_final; ?>
</span></td>
	</tr>
</table>
</form>
<p>
<?php include ("footer.php") ?>
<?php
//phpmkr_db_close($conn);
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
  global $x_iddependencia_cargo, $x_funcionario_idfuncionario, $x_dependencia_iddependencia, $x_cargo_idcargo, $x_estado, $x_fecha_inicial, $x_fecha_final, $x_fecha_ingreso;
	$sKeyWrk = "" . addslashes($sKey) . "";
  $sSql = "SELECT A.*,".fecha_db_obtener("A.fecha_inicial",'Y-m-d')." AS fecha_i,".fecha_db_obtener("A.fecha_final",'Y-m-d')." AS fecha_f FROM dependencia_cargo A";
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
	$rs = phpmkr_query($sSql,$conn) or error("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
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
		$x_estado = $row["estado"];
		$x_fecha_inicial = $row["fecha_i"];
		$x_fecha_final = $row["fecha_f"];
		$x_fecha_ingreso = $row["fecha_ingreso"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
