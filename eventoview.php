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

?><?php
// Initialize common variables
$x_idevento = Null;
$x_funcionario_codigo = Null;
$x_fecha = Null;
$x_evento = Null;
$x_tabla = Null;
$x_estado = Null;
$x_codigo = Null;
$x_detalle = Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_GET["key"]; 
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean(); 
	header("Location eventolist.php"); 
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
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;
			ob_end_clean();
			header("Location eventolist.php");
			exit();
		}
} 
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/cargo.gif" border="0">&nbsp;&nbsp;VER LOG<br><br>
<a href="eventolist.php">Volver al listado</a>&nbsp;
&nbsp;
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td bgcolor="#073A78"  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ID</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idevento; ?>
</span></td>
	</tr>
		<tr>
		<td bgcolor="#073A78"  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FUNCIONARIO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php $funcionario= busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$x_funcionario_codigo,"",$conn);
  if($funcionario["numcampos"])
    echo $funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"]; ?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#073A78"  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo FormatDateTime($x_fecha,5); ?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#073A78"  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">EVENTO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
switch ($x_evento) {
	case "ADICIONAR":
		$sTmp = "ADICIONAR";
		break;
	case "MODIFICAR":
		$sTmp = "MODIFICAR";
		break;
	case "ELIMINAR":
		$sTmp = "ELIMINAR";
		break;
	default:
		$sTmp = "";
} 
$ox_evento = $x_evento; // Backup Original Value
$x_evento = $sTmp;
?>
<?php echo $x_evento; ?>
<?php $x_evento = $ox_evento; // Restore Original Value ?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#073A78"  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TABLA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_tabla; ?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#073A78"  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_estado; ?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#073A78" class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_codigo; ?>
</span></td>
	</tr>
	<tr>
		<td bgcolor="#073A78" class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DETALLE DEL REGISTRO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php  
    echo($x_detalle);
  ?>
</span></td>
	</tr>
</table>
</form>
<p>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT A.*, ".fecha_db_obtener("A.fecha")." as fecha FROM evento A";
	$sSql .= " WHERE A.idevento = " . $sKeyWrk;
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
		// $row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idevento"] = $row["idevento"];
		$GLOBALS["x_funcionario_codigo"] = $row["funcionario_codigo"];
		$GLOBALS["x_fecha"] = $row["fecha"];
		$GLOBALS["x_evento"] = $row["evento"];
		$GLOBALS["x_tabla"] = $row["tabla_e"];
		$GLOBALS["x_estado"] = $row["estado"];
		$GLOBALS["x_codigo"] = $row["codigo_sql"];
		$GLOBALS["x_detalle"]= $row["detalle"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
