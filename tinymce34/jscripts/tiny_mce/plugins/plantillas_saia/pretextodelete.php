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
$x_idpretexto = Null;
$x_asunto = Null;
$x_cuerpo = Null;
$x_ayuda = Null;
$x_imagen = Null;
?>
<?php include ("../../../../../db.php") ?>
<?php include_once("../../../../../librerias_saia.php"); echo(estilo_bootstrap()); ?>
<?php include ("../../../../../phpmkrfn.php") ?>
<?php

// Load Key Parameters
$sKey = @$_REQUEST["key"];
if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$_REQUEST["key_d"];
}
$sDbWhere = "";
$arRecKey = explode(",",$sKey);

// Single delete record
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean();
	header("Location: pretextolist.php");
	exit(); 
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idpretexto=" . trim($sKey) . "";

// Get action
$sAction = @$_REQUEST["a_delete"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}
//$conn = phpmkr_db_connect(HOST, USER, PASS,DB);

switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount($sDbWhere,$conn) <= 0) {
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: pretextolist.php");
			exit();
		}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			$HTTP_SESSION_VARS["ewmsg"] = "Eliminaci�n Exitosa" . stripslashes($sKey);
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: pretextolist.php");
			exit();
		}
		break;
}
?>
<div class="container">
<a href="pretextolist.php"><i class="icon-share-alt"></i>Regresar</a><h5>Eliminar plantilla pre-dise&ntilde;ada</h5><br><br>
<form action="pretextodelete.php" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table class="table">
	<tr bgcolor="#666666">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Asunto</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Icono</span></td>
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
<?php echo $x_asunto; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_imagen; ?>
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
</div>
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
	global $HTTP_SESSION_VARS;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM pretexto";
	$sSql .= " WHERE idpretexto = " . $sKeyWrk;
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
	$datos=busca_filtro_tabla("","pretexto","pretexto.idpretexto=".$sKeyWrk,$sOrderBy,$conn);
		if ($datos["numcampos"] == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
	

	// Get the field contents
		$GLOBALS["x_idpretexto"] = $datos[0]["idpretexto"];
		$GLOBALS["x_asunto"] = $datos[0]["asunto"];
		$GLOBALS["x_cuerpo"] = $datos[0]["contenido"];
		$GLOBALS["x_ayuda"] =  $datos[0]["ayuda"];
		$GLOBALS["x_imagen"] = $datos[0]["imagen"];
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
	global $HTTP_SESSION_VARS;
	$sSql = "SELECT * FROM pretexto";
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
	
  $datos=busca_filtro_tabla("","pretexto","pretexto.".$sKeyWrk,$sOrderBy,$conn);
	return ($datos["numcampos"]);

}
?>
<?php

//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey

function DeleteData($sqlKey,$conn)
{ 
	global $HTTP_SESSION_VARS;
	
  $sSql = "Delete FROM pretexto";
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

 phpmkr_query($sSql,$conn) or die("Fall� la eliminacion del registro (1)" . phpmkr_error() . ' SQL:' . $sSql);

   $sSql = "Delete FROM entidad_pretexto WHERE pretexto_". $sqlKey; 
   
 phpmkr_query($sSql,$conn) or die("Fall� la eliminacion del registro (2)" . phpmkr_error() . ' SQL:' . $sSql);

	return true;
}
?>
