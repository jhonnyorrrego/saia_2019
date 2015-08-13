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
?>
<?php

// Initialize common variables
$x_idestructura_calidad = Null;
$x_nombre = Null;
$x_cod_padre = Null;
$x_nivel = Null;
$x_mostrar = Null;
$x_codigo = Null;
$x_estado= Null;
?>
<?php include ("db.php") ?>
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
	header("Location: estructura_calidadlist.php");
	exit(); 
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idestructura_calidad=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}

switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount($sDbWhere,$conn) <= 0) {		
			ob_end_clean();
			header("Location: estructura_calidadlist.php");
			exit();
		}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			$_SESSION["ewmsg"] = "Eliminación Exitosa" . stripslashes($sKey);		
			ob_end_clean();
			header("Location: estructura_calidadlist.php");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<p><span class="phpmaker">Borrar Tabla: estructura calidad<br><br><a href="estructura_calidadlist.php">Regresar al listado</a></span></p>
<form action="estructura_calidaddelete.php" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado">		
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Padre</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Nivel</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Mostrar</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">C&oacute;odigo</span></td>
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
<?php echo $x_nombre; ?>
</span></td>
		<td><span class="phpmaker">
<?php
if (($x_cod_padre != NULL) && ($x_cod_padre <> "")) {
	$sSqlWrk = "SELECT *  FROM estructura_calidad";
	$sTmp = $x_cod_padre;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (idestructura_calidad = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_cod_padre = $x_cod_padre; // Backup Original Value
$x_cod_padre = $sTmp;
?>
<?php echo $x_cod_padre; ?>
<?php $x_cod_padre = $ox_cod_padre; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_nivel; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_mostrar; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_codigo; ?>
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

function LoadData($sKey,$conn)
{
	global $_SESSION,$x_idestructura_calidad,$x_nombre,$x_cod_padre,$x_nivel,$x_mostrar,$x_codigo,$x_estado;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM estructura_calidad";
	$sSql .= " WHERE idestructura_calidad = " . $sKeyWrk;
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
	  $x_idestructura_calidad = $row["idestructura_calidad"];
		$x_nombre = $row["nombre"];
		$x_cod_padre = $row["cod_padre"];
		$x_nivel = $row["nivel"];
		$x_mostra = $row["mostrar"];
		$x_codigo = $row["codigo"];
		$x_estado = $row["estado"];	
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
global $_SESSION,$x_idestructura_calidad,$x_nombre,$x_cod_padre,$x_nivel,$x_mostrar,$x_codigo;
	$sSql = "SELECT * FROM estructura_calidad";
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
	$sSql = "Update estructura_calidad SET estado=0";
	$sSql .= " WHERE ".$sqlKey;	
	phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
	return true;
}
?>
