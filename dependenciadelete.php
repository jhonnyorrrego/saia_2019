<?php

// Initialize common variables
$x_iddependencia = Null;
$x_codigo = Null;
$x_cod_padre = Null;
$x_nombre = Null;
$x_fecha_ingreso = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php
include ("librerias_saia.php");
include_once ("pantallas/lib/librerias_cripto.php");
$validar_enteros=array("x_iddependencia");
desencriptar_sqli('form_info');
echo(librerias_jquery());
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
	abrir_url("dependencia.php","centro");
	exit(); 
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "iddependencia=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}
switch ($sAction)
{
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			$_SESSION["ewmsg"] = "Eliminaci�n Exitosa" . stripslashes($sKey);
			ob_end_clean();
			abrir_url("dependencia.php","centro");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/dependencia.png" border="0">&nbsp;&nbsp;Inactivar Dependencia<br><br>
</span></p>
<form action="dependenciadelete.php" name="dependenciadelete" id="dependenciadelete" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">CODIGO DEPENDENCIA</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">CODIGO DEPENDENCIA PADRE</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE DEPENDENCIA</span></td>
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
<?php echo $x_codigo; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_cod_padre; ?>
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
<p>
<input type="submit" name="Action" value="Inactivar">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables
encriptar_sqli("dependenciadelete",1);
function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM dependencia A";
	$sSql .= " WHERE A.iddependencia = " . $sKeyWrk;
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

		// Get the field contents
		$GLOBALS["x_iddependencia"] = $row["iddependencia"];
		$GLOBALS["x_codigo"] = $row["codigo"];
		$GLOBALS["x_cod_padre"] = $row["cod_padre"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_fecha_ingreso"] = $row["fecha_ingreso"];
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
	$sSql = "SELECT * FROM dependencia";
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
	$sSql = "update dependencia";
	$sSql .= " set estado=0";
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
	$update_rol = "UPDATE dependencia_cargo SET estado=0 WHERE dependencia_iddependencia=".substr($sqlKey,14);	
	phpmkr_query($update_rol,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $update_rol);
	return true;
}
?>
