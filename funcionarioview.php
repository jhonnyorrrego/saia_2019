<?php include_once("db.php"); ?>
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
$x_idfuncionario = Null;
$x_funcionario_codigo = Null;
$x_login = Null;
$x_clave = Null;
$x_nombres = Null;
$x_apellidos = Null;
$x_firma = Null;
$fs_x_firma = 0;
$fn_x_firma = "";
$ct_x_firma = "";
$w_x_firma = 0;
$h_x_firma = 0;
$a_x_firma = "";
$x_estado = Null;
$x_fecha_ingreso = Null;
$x_nit = Null;
$x_perfil = Null;
?>
<?php //include ("db.php") ?>
<?php //include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_GET["key"]; 
}
if (($sKey == "") || ((is_null($sKey)))) { 
	redirecciona("funcionariolist.php"); 
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;			
			redirecciona("funcionariolist.php");
			exit();
		}
}
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/funcionario.png" border="0">&nbsp;&nbsp;VER FUNCIONARIOS<br><br>
<a href="funcionariolist.php">Regresar al listado</a>&nbsp;
<a href="<?php echo "funcionarioedit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;
<a href="<?php echo "asignarserie.php?entidad=".$sKey."&tipo_entidad=1&origen=funcionario"; ?>">Asignar serie</a>&nbsp;
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO DEL FUNCIONARIO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_funcionario_codigo; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">LOGIN (intranet)</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_login; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CLAVE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
********
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRES</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_nombres; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">APELLIDOS</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_apellidos; ?>
</span></td>
	</tr> 
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FIRMA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if ((!is_null($x_firma)) &&  $x_firma <> "") { ?>
<a href="factura/mostrar_foto.php?codigo=<?php echo $x_funcionario_codigo; ?>" target="blank">Firma</a>
<?php } ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
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
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA DE INGRESO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_fecha_ingreso; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PERFIL DE ACCESO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
switch ($x_perfil) {
	case "1":
		$sTmp = "Administrador";
		break;
	case "2":
		$sTmp = "Director";
		break;
	case "3":
		$sTmp = "Coordinador";
		break;
	case "4":
		$sTmp = "Jefe";
		break;
	case "5":
		$sTmp = "Auxiliar";
		break;
	case "6":
		$sTmp = "General";
		break;
	default:
		$sTmp = "";
}
$ox_perfil = $x_perfil; // Backup Original Value
$x_perfil = $sTmp;
?>
<?php echo $x_perfil; ?>
<?php $x_perfil = $ox_perfil; // Restore Original Value ?>
</span></td>
	</tr>
		<tr>
		<td colspan="2" bgcolor="#F5F5F5" align="center"><span class="phpmaker" style="color: #FFFFFF;">
    <a href="mostrar_permisos.php?idfuncionario=<?php echo $x_idfuncionario?>">Adiminstrar Permisos</a>
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
	$sSql = "SELECT A.* FROM funcionario A";
	$sSql .= " WHERE A.idfuncionario = " . $sKeyWrk;
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
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idfuncionario"] = $row["idfuncionario"];
		$GLOBALS["x_funcionario_codigo"] = $row["funcionario_codigo"];
		$GLOBALS["x_login"] = $row["login"];
		$GLOBALS["x_clave"] = $row["clave"];
		$GLOBALS["x_nombres"] = $row["nombres"];
		$GLOBALS["x_apellidos"] = $row["apellidos"];
		$GLOBALS["x_firma"] = $row["firma"];
		$GLOBALS["x_estado"] = $row["estado"];
		$GLOBALS["x_fecha_ingreso"] = $row["fecha_ingreso"];
		$GLOBALS["x_nit"] = $row["nit"];
		$GLOBALS["x_perfil"] = $row["perfil"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
