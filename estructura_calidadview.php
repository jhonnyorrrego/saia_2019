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
$x_estado = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$_GET["key"]; 
}
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean(); 
	header("Location estructura_calidadlist.php"); 
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
		  ob_end_clean();
			header("Location estructura_calidadlist.php");
			exit();
		}
}
?>
<?php include ("header.php") ?>
<p><span class="phpmaker">Ver Tabla: estructura calidad<br><br>
<a href="estructura_calidadlist.php">Regresar al listado</a>&nbsp;
<a href="<?php echo "estructura_calidadedit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;
<a href="<?php echo "estructura_calidaddelete.php?key=" . urlencode($sKey); ?>">Eliminar</a>&nbsp;
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class='encabezado'><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
	</tr>
	<tr>
		<td class='encabezado'><span class="phpmaker" style="color: #FFFFFF;">Etiqueta</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_etiqueta; ?>
</span></td>
	</tr>
	<tr>
		<td  class='encabezado'><span class="phpmaker" style="color: #FFFFFF;">C&oacute;digo Padre</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
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
	</tr>
	<tr>
		<td  class='encabezado'><span class="phpmaker" style="color: #FFFFFF;">Nivel</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_nivel; ?>
</span></td>
	</tr>
	<tr>
		<td  class='encabezado'><span class="phpmaker" style="color: #FFFFFF;">Mostrar</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_mostrar; ?>
</span></td>
	</tr>
	<tr>
		<td  class='encabezado'><span class="phpmaker" style="color: #FFFFFF;">C&oacute;digo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_codigo; ?>
</span></td>
	</tr>
	<tr>
		<td  class='encabezado'><span class="phpmaker" style="color: #FFFFFF;">Estado</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if($x_estado==1)echo "Activo"; 
      else echo "Inactivo";
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
	global $_SESSION,$x_idestructura_calidad,$x_nombre,$x_cod_padre,$x_nivel, $x_etiqueta,$x_mostrar,$x_codigo,$x_estado;
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
		$x_etiqueta = $row["etiqueta"];	
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
