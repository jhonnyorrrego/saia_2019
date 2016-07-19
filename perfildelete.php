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

// User levels
define("ewAllowAdd", 1, true);
define("ewAllowDelete", 2, true);
define("ewAllowEdit", 4, true);
define("ewAllowView", 8, true);
define("ewAllowList", 8, true);
define("ewAllowReport", 8, true);
define("ewAllowSearch", 8, true);																														
define("ewAllowAdmin", 16, true);						
// Initialize common variables
$x_idperfil = Null;
$x_nombre = Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php

// Load Key Parameters
$sKey = @$_GET["key"];

if (array_key_exists("form_info", $_POST)) {
    include_once ($ruta_db_superior . "pantallas/lib/librerias_cripto.php");
    $data = json_decode($_POST["form_info"], true);
    unset($_REQUEST);
    unset($_POST);
    for($i = 0; $i < count($data); $i ++) {
        $_REQUEST[decrypt_blowfish($data[$i]["name"], LLAVE_SAIA_CRYPTO)] = decrypt_blowfish($data[$i]["value"], LLAVE_SAIA_CRYPTO);
        $_POST[decrypt_blowfish($data[$i]["name"], LLAVE_SAIA_CRYPTO)] = decrypt_blowfish($data[$i]["value"], LLAVE_SAIA_CRYPTO);
    }
    // print_r($_REQUEST);die();
}

if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_POST["key_d"];
}
$sDbWhere = "";
$arRecKey = split(",",$sKey);

// Single delete record
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	header("Location: perfillist.php");
	exit(); 
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idperfil=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}
switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount($sDbWhere,$conn) <= 0) {
			ob_end_clean();
			header("Location: perfillist.php");
			exit();
		}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			$_SESSION["ewmsg"] = "Delete Successful For Key = " . stripslashes($sKey);
			ob_end_clean();
			header("Location: perfillist.php");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<p><span class="phpmaker">ELIMINAR PERFIL<br><br><a href="perfillist.php">REGRESAR AL LISTADO</a></span></p>
<form action="perfildelete.php" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr bgcolor="#073A78">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICADOR</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">nombre</span></td>
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
<?php echo $x_idperfil; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
	</tr>
<?php
	}
}
?>
</table>
	<input type="hidden" name="form_info" id="form_info" value="">

<p>
<input type="submit" name="Action" value="CONFIRMAR ELIMINAR" id="continuar">
</form>

<?php

include_once ($ruta_db_superior . "librerias_saia.php");
echo (librerias_jquery("1.7"));

?>

<script type="text/javascript">
$("#continuar").click(function(){
	var salida = false;
  		$.ajax({
            type:'POST',
            async: false,
            url: "<?php echo $ruta_db_superior;?>formatos/librerias/encript_data.php",
            data: {datos:JSON.stringify($('#perfildelete').serializeArray(), null)},
            success: function(data) {
            	$("#form_info").empty().val(data);
            	//console.log($("#form_info").val());
            	salida = true;
         	}
  		});  
    return salida;
  });

</script>

<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM perfil";
	$sSql .= " WHERE idperfil = " . $sKeyWrk;
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
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idperfil"] = $row["idperfil"];
		$GLOBALS["x_nombre"] = $row["nombre"];
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
	$sSql = "SELECT * FROM perfil";
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
	$rs = phpmkr_query($sSql,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
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
	$sSql = "Delete FROM perfil";
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
