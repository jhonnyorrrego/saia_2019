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
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || ($sKey == NULL)) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_idestructura_calidad = @$_POST["x_idestructura_calidad"];
	$x_nombre = @$_POST["x_nombre"];
	$x_cod_padre = @$_POST["x_cod_padre"];
	$x_nivel = @$_POST["x_nivel"];
	$x_mostrar = @$_POST["x_mostrar"];
	$x_codigo = @$_POST["x_codigo"];
	$x_estado = @$_POST["x_estado"];
	$x_etiqueta = @$_POST["x_etiqueta"];
}
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean();
	header("Location: estructura_calidadlist.php");
	exit();
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;		
			ob_end_clean();
			header("Location: estructura_calidadlist.php");
			exit();
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
			$_SESSION["ewmsg"] = "Actualización exitosa" . $sKey;			
			ob_end_clean();
			header("Location: estructura_calidadlist.php");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_nombre && !EW_hasValue(EW_this.x_nombre, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor ingrese los campos requeridos - nombre"))
		return false;
}
return true;
}

//-->
</script>
<p><span class="phpmaker">Editar Tabla: estructura calidad<br><br><a href="estructura_calidadlist.php">Regresar al listado</a></span></p>
<form name="estructura_calidadedit" id="estructura_calidadedit" action="estructura_calidadedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td  class='encabezado'><span class="phpmaker" style="color: #FFFFFF;">idestructura calidad</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idestructura_calidad; ?><input type="hidden" name="x_idestructura_calidad" value="<?php echo $x_idestructura_calidad; ?>">
</span></td>
	</tr>
	<tr>
		<td  class='encabezado'><span class="phpmaker" style="color: #FFFFFF;">nombre</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
		<tr>
		<td class="encabezado" title="Nombre de la Estructura para mostrar"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_etiqueta" id="x_etiqueta" value="<?php echo htmlspecialchars(@$x_etiqueta) ?>">
</span></td>
	</tr>
	<tr>
		<td  class='encabezado'><span class="phpmaker" style="color: #FFFFFF;">cod padre</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$x_cod_padreList = "<select name=\"x_cod_padre\">";
$x_cod_padreList .= "<option value=''>Por favor seleccionar</option>";
$sSqlWrk = "SELECT idestructura_calidad, nombre FROM estructura_calidad" . " ORDER BY nombre";
$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_cod_padreList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		if ($datawrk["idestructura_calidad"] == @$x_cod_padre) {
			$x_cod_padreList .= "' selected";
		}
		$x_cod_padreList .= ">" . $datawrk["nombre"] . "</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_cod_padreList .= "</select>";
echo $x_cod_padreList;
?>
</span></td>
	</tr>
<input type="hidden" id="x_nivel" name="x_nivel" value="<?php echo htmlspecialchars(@$x_nivel); ?>">
<input type="hidden" id="x_mostrar" name="x_mostrar" value="<?php echo htmlspecialchars(@$x_mostrar); ?>">
	<tr>
		<td  class='encabezado'><span class="phpmaker" style="color: #FFFFFF;">codigo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_codigo" id="x_codigo" value="<?php echo htmlspecialchars(@$x_codigo) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_estado"<?php if (@$x_estado == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Activo"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_estado"<?php if (@$x_estado == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "Inactivo"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Editar">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
		global $_SESSION,$x_idestructura_calidad,$x_nombre, $x_etiqueta,$x_cod_padre,$x_nivel,$x_mostrar,$x_codigo,$x_estado;
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
<?php

//-------------------------------------------------------------------------------
// Function EditData
// - Edit Data based on Key Value sKey
// - Variables used: field variables

function EditData($sKey,$conn)
{
	global $x_idestructura_calidad,$x_nombre,$x_etiqueta,$x_cod_padre,$x_nivel,$x_mostrar,$x_codigo,$x_estado;
	// Open record
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
		$EditData = false; // Update Failed
	}else{
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre"] = $theValue;
  	// Field etiqueta
$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_etiqueta) : $x_etiqueta; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["etiqueta"] = $theValue;
	// Field cod_padre
	$theValue = ($x_cod_padre != "") ? intval($x_cod_padre) : 0;
	$fieldList["cod_padre"] = $theValue;
  if($fieldList["cod_padre"]){
    $nivelp=busca_filtro_tabla("nivel","estructura_calidad","idestructura=".$fieldList["cod_padre"],"",$conn);
    if($nivelp["numcampos"]){
      $nivel_padre=$nivelp[0]["nivel"];
    }
  }
  else $nivel_padre=1;
	// Field nivel
	$theValue = ($x_nivel != "") ? intval($x_nivel_padre+1) : 1;
	$fieldList["nivel"] = $theValue;

	// Field mostrar
	$theValue = ($x_mostrar != "") ? intval($x_mostrar) : "NULL";
	$fieldList["mostrar"] = $theValue;

	// Field codigo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_codigo) : $x_codigo; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["codigo"] = $theValue;
	 $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_estado) : $x_estado; 
  $theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	 $fieldList["estado"] = $theValue;

		// update
		$sSql = "UPDATE estructura_calidad SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idestructura_calidad =". $sKeyWrk;
		phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
		$EditData = true; // Update Successful
	}
	return $EditData;
}
?>
