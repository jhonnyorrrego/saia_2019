<?php session_start(); ?>
<?php ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 

// Initialize common variables
$x_idestructura_calidad = Null;
$x_nombre = Null;
$x_cod_padre = Null;
$x_nivel = Null;
$x_mostrar = Null;
$x_codigo = Null;
?>
<?php include_once ("db.php") ?>
<?php include_once ("phpmkrfn.php") ?>
<?php

// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || (($sAction == NULL))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey <> "") {
		$sAction = "C"; // Copy record
	}
	else
	{
		$sAction = "I"; // Display blank record
	}
}
else
{

	// Get fields from form
	$x_idestructura_calidad = @$_POST["x_idestructura_calidad"];
	$x_nombre = @$_POST["x_nombre"];
	$x_cod_padre = @$_POST["x_cod_padre"];
	$x_nivel = @$_POST["x_nivel"];
	$x_mostrar = @$_POST["x_mostrar"];
	$x_codigo = @$_POST["x_codigo"];
	$x_etiqueta = @$_POST["x_etiqueta"];
}
switch ($sAction)
{	
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			$_SESSION["ewmsg"] = "Adición exitosa del registro.";		
			ob_end_clean();
			header("Location: estructura_calidadlist.php");
			exit();
		}
		break;
}
?>
<?php include_once ("header.php") ?>
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
<p><span class="phpmaker">Adicionar a: Tabla: estructura calidad<br><br><a href="estructura_calidadlist.php">Regresar al listado</a></span></p>
<form name="estructura_calidadadd" id="estructura_calidadadd" action="estructura_calidadadd.php" method="post" onSubmit="return EW_checkMyForm(this);">

<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="Nombre de la Estructura"><span class="phpmaker" style="color: #FFFFFF;">nombre</span></td>
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
		<td class="encabezado" title="Padre de la Estructura"><span class="phpmaker" style="color: #FFFFFF;">Estructura Padre</span></td>
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
	<!--tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">nivel</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!($x_nivel != NULL) || ($x_nivel == "")) { $x_nivel = 0;} // Set default value ?>
<input type="hidden" id="x_nivel" name="x_nivel" value="<?php echo htmlspecialchars(@$x_nivel); ?>">
</span></td>
	</tr>
	<tr>
		<td bgcolor="#666666"><span class="phpmaker" style="color: #FFFFFF;">mostrar</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!($x_mostrar != NULL) || ($x_mostrar == "")) { $x_mostrar = 1;} // Set default value ?>
<input type="hidden" id="x_mostrar" name="x_mostrar" value="<?php echo htmlspecialchars(@$x_mostrar); ?>">
</span></td>
	</tr-->
	<tr>
		<td class="encabezado" title="C&oacute;digo de la Estructura"><span class="phpmaker" style="color: #FFFFFF;">C&oacute;digo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!($x_codigo != NULL) || ($x_codigo == "")) { $x_codigo = "0";} // Set default value ?>
<input type="text" name="x_codigo" id="x_codigo" value="<?php echo htmlspecialchars(@$x_codigo) ?>">
<input type="hidden" id="x_nivel" name="x_nivel" value="<?php echo htmlspecialchars(@$x_nivel); ?>">
<input type="hidden" id="x_mostrar" name="x_mostrar" value="<?php echo htmlspecialchars(@$x_mostrar); ?>">
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Adicionar">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function AddData
// - Add Data
// - Variables used: field variables

function AddData($conn)
{ 
	global $x_idestructura_calidad, $x_nombre, $x_etiqueta, $x_cod_padre, $x_nivel, $x_mostrar, $x_codigo;
	// Add New Record
	$sSql = "SELECT * FROM estructura_calidad";
	$sSql .= " WHERE 0 = 1";
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

	// Field nombre
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

	// insert into database
	$strsql = "INSERT INTO estructura_calidad (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	phpmkr_query($strsql, $conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
	return true;
} 
?>
