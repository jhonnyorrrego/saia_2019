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
		
?>
<?php

// Initialize common variables
$x_iddependencia = Null;
$x_codigo = Null;
$x_cod_padre = Null;
$x_nombre = Null;
$x_fecha_ingreso = Null;
$x_grupo= Null;
$x_estado= Null;
$x_extension = Null;
$x_ubicacion_dependencia=Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_GET["key"]; 
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean(); 
	redirecciona("vacio.php"); 
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
			ob_end_clean();				
			redirecciona("dependencialist.php");
			exit();
		}	
}

if(isset($_REQUEST["verlogo"])&&$_REQUEST["verlogo"])
 {echo '<img  src="formatos/librerias/mostrar_logo.php?codigo='.$_REQUEST["key"].'" />';
  die();
 }
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/dependencia.png" border="0">&nbsp;&nbsp;VER DEPENDENCIAS<br><br>
<a href="<?php echo "dependenciaedit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;
<!--a href="<?php echo "asignarserie_entidad.php?llave_entidad=".$sKey."&tipo_entidad=2&origen=dependencia"; ?>">Asignar serie / categor&iacute;a</a-->&nbsp;
<a href="<?php echo "dependenciadelete.php?key=".$sKey; ?>">Inactivar</a>&nbsp;
<!--a href="<?php echo "permiso_dependenciaadd.php?key=".$sKey; ?>">Asignar Permiso</a-->
&nbsp;
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N DE LA DEPENDENCIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_iddependencia; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO DE LA DEPENDENCIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_codigo; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO DE LA DEPENDENCIA PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
if ((!is_null($x_cod_padre)) && ($x_cod_padre <> "")) {
	$sSqlWrk = "SELECT DISTINCT A.*  FROM dependencia A";
	$sTmp = $x_cod_padre;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (A.iddependencia = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
		$sTmp .= ValueSeparator(0) . $rowwrk["codigo"];
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
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE DE LA DEPENDENCIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA DE CREACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_fecha_ingreso; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if($x_grupo==1) echo("DEPENDENCIA"); else echo ("GRUPO"); ?>
</span></td>
	</tr>
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if($x_estado==1) echo("Activo"); else echo ("Inactivo"); ?>
</span></td>
</tr>
<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">LOGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <?php
    if($GLOBALS["x_logo"]<>"")
       {echo "<a href='?verlogo=1&key=".$sKey."' target='_blank' >Ver</a>&nbsp;&nbsp;";
       }
    else
       echo "No tiene";
    ?>
    </span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">EXTENSI&Oacute;N DE LA DEPENDENCIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_extension; ?>
</span></td>
	</tr>
  <tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">UBICACI&Oacute;N DE LA DEPENDENCIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo  $x_ubicacion_dependencia; ?>
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
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT A.*, ".fecha_db_obtener("A.fecha_ingreso","Y-m-d")." as fecha_ingreso FROM dependencia A";
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
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);
		// Get the field contents
		$GLOBALS["x_iddependencia"] = $row["iddependencia"];
		$GLOBALS["x_codigo"] = $row["codigo"];
		$GLOBALS["x_cod_padre"] = $row["cod_padre"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_fecha_ingreso"] = $row["fecha_ingreso"];
		$GLOBALS["x_grupo"] = $row["tipo"];
		$GLOBALS["x_estado"] = $row["estado"];
		$GLOBALS["x_logo"] = $row["logo"];
		$GLOBALS["x_extension"] = $row["extension"];
    $GLOBALS["x_ubicacion_dependencia"] = $row["ubicacion_dependencia"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
