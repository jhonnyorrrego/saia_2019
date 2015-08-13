<?php include ("db.php") ?>
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
$x_idejecutor = Null;
$x_identificacion = Null;
$x_tipo = Null;
$x_telefono = Null;
$x_nombre = Null;
$x_prioridad = Null;
$x_fecha_ingreso = Null;
$x_cargo = Null;
$x_direccion = Null;
$x_ciudad = Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php

// Load Key Parameters
$sKey = @$_GET["key"];
if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$_POST["key_d"];
}
$sDbWhere = "";
$arRecKey = split(",",$sKey);

// Single delete record
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean();
	header("Location: ejecutorlist.php");
	exit(); 
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idejecutor=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}
switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount("A.".$sDbWhere,$conn) <= 0) {		
			ob_end_clean();
			header("Location: ejecutorlist.php");
			exit();
		}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			$_SESSION["ewmsg"] = "Se elimino el registro = " . stripslashes($sKey);	
			ob_end_clean();
			header("Location: ejecutorlist.php");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/ejecutor.png" border="0">&nbsp;&nbsp;EJECUTOR REMITENTE<br></span></p>
<form action="ejecutordelete.php" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">identificacion</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">tipo</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">telefono</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">nombre</span></td>
		<!--td valign="top"><span class="phpmaker" style="color: #FFFFFF;">prioridad</span></td-->
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">fecha ingreso</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">cargo</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">direccion</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">ciudad</span></td>
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
<?php echo $x_identificacion; ?>
</span></td>
		<td><span class="phpmaker">
<?php
$ox_tipo = $x_tipo; // Backup Original Value
$sTmp="";
$x_tipo = $sTmp;
?>
<?php echo $x_tipo; ?>
<?php $x_tipo = $ox_tipo; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_telefono; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>	
		<td><span class="phpmaker">
<?php echo FormatDateTime($x_fecha_ingreso,5); ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_cargo; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_direccion; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_ciudad; ?>
</span></td>
	</tr>
<?php
	}
}
?>
</table>
<p>
<input type="submit" name="Action" value="CONFIRMAR ELIMINAR">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $_SESSION,$x_idejecutor,$x_identificacion,$x_tipo,$x_telefono,$x_nombre,$x_prioridad,$x_fecha_ingreso,$x_cargo,$x_direccion,$x_ciudad;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM ejecutor A";
	$sSql .= " WHERE A.idejecutor = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);

		// Get the field contents		
		$x_idejecutor = $row["idejecutor"];
		$x_identificacion = $row["identificacion"];
		$x_tipo = $row["tipo"];
		$x_telefono = $row["telefono"];
		$x_nombre = $row["nombre"];
		$x_prioridad = $row["prioridad"];
		$x_fecha_ingreso = $row["fecha_ingreso"];
		$x_cargo = $row["cargo"];
		$x_direccion = $row["direccion"];
		$x_ciudad = $row["ciudad"];
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
	global $_SESSION;
	$sSql = "SELECT * FROM ejecutor A";
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
	$rs = phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	$temp=array();
  $temp=phpmkr_fetch_array($rs);
  $i=0;
  for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++);
	phpmkr_free_result($rs);
  return $i;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey

function DeleteData($sqlKey,$conn)
{
	global $_SESSION;
	$sSql = "Delete FROM ejecutor";
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
	phpmkr_query($sSql,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	return true;
}
?>
