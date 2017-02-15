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
$x_idconfiguracion = Null;
$x_nombre = Null;
$x_valor = Null;
$x_tipo = Null;
?>
<?php include ("db.php");
include_once("pantallas/lib/librerias_cripto.php");
include_once("librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

?>
<?php include ("phpmkrfn.php") ?>
<?php

// Load Key Parameters
$sKey = @$_GET["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_POST["key_d"];
}
$sDbWhere = "";
$arRecKey = split(",",$sKey);

// Single delete record
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	header("Location: configuracionlist.php");
	exit(); 
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idconfiguracion=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}

switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount("A.".$sDbWhere,$conn) <= 0) {		
			ob_end_clean();
			header("Location: configuracionlist.php");
			exit();
		}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			$_SESSION["ewmsg"] = "Eliminaci�n Exitosa" . stripslashes($sKey);
			ob_end_clean();
			header("Location: configuracionlist.php");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<form id="configuraciondelete" name="configuraciondelete" action="configuraciondelete.php" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Valor</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Tipo</span></td>
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
<?php echo $x_valor; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_tipo; ?>
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
encriptar_sqli("configuraciondelete",1);
function LoadData($sKey,$conn)
{ global $x_idconfiguracion,$x_nombre,$x_valor,$x_tipo;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM configuracion A";
	$sSql .= " WHERE A.idconfiguracion = " . $sKeyWrk;
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

  $temp=phpmkr_fetch_array($rs);
  for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++);

  if ($i== 0) 
    {
		 $LoadData = false;
	  }
  else{
    $rs = phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_idconfiguracion = $row["idconfiguracion"];
		$x_nombre = $row["nombre"];
		$x_valor = $row["valor"];
		$x_tipo = $row["tipo"];	
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
	$sSql = "SELECT A.* FROM configuracion A";
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
	
	$rs = phpmkr_query($sSql,$conn) or error("Fall� al Ejecutar la B�squeda" . phpmkr_error() . ' SQL:' . $sSql);

$temp=phpmkr_fetch_array($rs);
for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++);
phpmkr_free_result($rs);

return($i);
}
?>
<?php

//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey

function DeleteData($sqlKey,$conn)
{
	$sSql = "Delete FROM configuracion";
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
