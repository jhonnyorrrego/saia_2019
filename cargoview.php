<?php include ("db.php") ?>
<?php //session_start(); ?>
<?php //ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0

$ewCurSec = 0; // Initialise

// Initialize common variables
$x_idcargo = Null;
$x_nombre = Null;
$x_cod_padre = Null;
$x_tipo_cargo = Null;
$sKey = @$_GET["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_GET["key"];
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	header("Location:cargolist.php");
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}

// Open connection to the database

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: cargolist.php");
			exit();
		}
}
?>
<?php include ("header.php") ?>
<p><span class="internos">
<a href="<?php echo "cargoedit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;
<a href="<?php echo "cargodelete.php?key=" . urlencode($sKey); ?>">Inactivar</a>&nbsp;
<!--a href="<?php echo "asignarserie_entidad.php?llave_entidad=".$sKey."&tipo_entidad=4&origen=cargo"; ?>">Asignar serie / categor&iacute;a</a-->&nbsp;
</span></p>

<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N DEL CARGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idcargo; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE DEL CARGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO DEL CARGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
if($x_tipo_cargo==1){
	$x_tipo_cargo="Administrativo";
}
else if($x_tipo_cargo==2){
	$x_tipo_cargo="Funciones";
}
echo $x_tipo_cargo;
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CARGO PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$cargo=busca_filtro_tabla("nombre","cargo","idcargo=".$x_cod_padre,"",$conn);
echo @$cargo[0][0];
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO DEL CARGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if($x_estado==1) echo "ACTIVO"; else echo "INACTIVO"; ?>
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
{global $x_idcargo;
global $x_nombre;
global $x_estado;
global $x_cod_padre ;
global $x_tipo_cargo;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM cargo A";
	$sSql .= " WHERE A.idcargo = " . $sKeyWrk;
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
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_idcargo = $row["idcargo"];
		$x_nombre = $row["nombre"];
		$x_estado = $row["estado"];
		$x_tipo_cargo = $row["tipo_cargo"];
    $x_cod_padre = $row["cod_padre"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
