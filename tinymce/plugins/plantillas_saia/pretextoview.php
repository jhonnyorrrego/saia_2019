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
$x_idpretexto = Null;
$x_asunto = Null;
$x_cuerpo = Null;
$x_ayuda = Null;
$x_imagen = Null;
?>
<?php include ("../../../../../db.php") ?>
<?php include ("../../../../../phpmkrfn.php") ?>
<?php
$sKey = $_REQUEST["key"];
if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$HTTP_GET_VARS["key"]; 
}
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean(); 
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$HTTP_POST_VARS["a_view"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}


global $conn;
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$HTTP_SESSION_VARS["ewmsg"] = "Registro no encontrado" . $sKey;
			phpmkr_db_close($conn);
			ob_end_clean();
			header("Location pretextolist.php");
			exit();
		}
}
?>
<html>
<?php 
function jsspecialchars( $string = '') {
$string = preg_replace("/\r*\n/","\\n",$string);
$string = preg_replace("/\//","\\\/",$string);
$string = preg_replace("/\"/","\\\"",$string);
$string = preg_replace("/'/"," ",$string);
return $string;
}
$array = array("\n", "\rn",chr(10),chr(13));
$var = str_replace($array, '', @$x_cuerpo);
//$var = jsspecialchars( $x_cuerpo);
$var= addslashes($var);

$var = html_entity_decode($var,ENT_NOQUOTES);
echo $var;
?>
</html>
<script>
	 parent.contenido="<?php echo $var?>";
	 //alert(parent.contenido);
  </script>

<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $HTTP_SESSION_VARS;

	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT SAIA.pretexto.idpretexto FROM SAIA.pretexto ";
	$sSql .= " WHERE SAIA.pretexto.idpretexto = " . $sKeyWrk;
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
  
  $datos=busca_filtro_tabla("",DB.".pretexto","pretexto.idpretexto=".$sKeyWrk,$sOrderBy,$conn);
  //$rs = phpmkr_query($sSql,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);

 // echo $sSql,$datos["numcampos"]; die();
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
	

	return $LoadData;
}
?>
