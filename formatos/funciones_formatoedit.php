<?php session_start(); ?>
<?php ob_start(); ?>
<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

// Initialize common variables
$x_idfuncion_formato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_descripcion = Null;
$x_ruta = Null;
$x_formato = Null;
$x_acciones = Null;
?>
<?php include ($ruta_db_superior."db.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("idformato");
include_once($ruta_db_superior."librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());
?>
<?php
include ("phpmkrfn.php");
include_once("librerias/funciones.php");
?>
<?php
$sKey = @$_GET["key"];
$idformato=@$_REQUEST["idformato"];
if (($sKey == "") || (is_null($sKey))) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_idfuncion_formato = @$_POST["x_idfunciones_formato"];
	$x_nombre = @$_POST["x_nombre"];
	$x_etiqueta = @$_POST["x_etiqueta"];
	$x_descripcion = @$_POST["x_descripcion"];
	$x_ruta = @$_POST["x_ruta"];
	$x_formato = @$_POST["x_formato"];
	$x_acciones = @$_POST["x_acciones"];
}
if (($sKey == "") || ((is_null($sKey)))) {
  if($idformato)
    redirecciona("funciones_formatolist.php?idformato=".$idformato);
  redirecciona("funciones_formatolist.php");  
}
//
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			//phpmkr_db_close($conn);
    if($idformato)
      redirecciona("funciones_formatolist.php?idformato=".$idformato);
    redirecciona("funciones_formatolist.php");  
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
			alerta("Actualizacion exitosa");
			////phpmkr_db_close($conn);
    if(isset($_REQUEST["pantalla"])&&$_REQUEST["pantalla"]=="tiny")
      redirecciona("../tinymce34/jscripts/tiny_mce/plugins/formatos/formatos.php?formato=".$idformato."&tipo=funciones_formato");
    else if($idformato)
      redirecciona("funciones_formatolist.php?idformato=".$idformato);
    else  
    redirecciona("funciones_formatolist.php");  
  	}
		break;
}
?>
<?php include ("header.php");
if(isset($_REQUEST["pantalla"])&&$_REQUEST["pantalla"]=="tiny")
{echo '<script type="text/javascript">
document.getElementById("header").style.display="none";
</script>';
}
 ?>
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
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Please enter required field - Nombre de la funci&oacute;"))
		return false;
}
if (EW_this.x_etiqueta && !EW_hasValue(EW_this.x_etiqueta, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_etiqueta, "TEXT", "Please enter required field - Nombre a mostrar"))
		return false;
}
if (EW_this.x_descripcion && !EW_hasValue(EW_this.x_descripcion, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_descripcion, "TEXT", "Please enter required field - Descripci&oacute;n"))
		return false;
}
if (EW_this.x_ruta && !EW_hasValue(EW_this.x_ruta, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_ruta, "TEXT", "Please enter required field - Ubicada en Archivo"))
		return false;
}
if (EW_this.x_formato && !EW_hasValue(EW_this.x_formato, "SELECT" )) {
	if (!EW_onError(EW_this, EW_this.x_formato, "SELECT", "Please enter required field - Listado de Formatos a los que pertenece la Funcion"))
		return false;
}
if (EW_this.x_acciones && !EW_hasValue(EW_this.x_acciones, "CHECKBOX" )) {
	if (!EW_onError(EW_this, EW_this.x_acciones, "CHECKBOX", "Please enter required field - acciones"))
		return false;
}
return true;
}

//-->
</script>

<p><span class="phpmaker">funciones formato<br><br>
<?php if(!isset($_REQUEST["pantalla"])){ ?>
<a href="funciones_formatolist.php<?php if($idformato)echo("?idformato=".$idformato);?>">Ir al Listado</a>
<?php } ?>
</span></p>
<form name="funciones_formatoedit" id="funciones_formatoedit" action="funciones_formatoedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<?php
if(isset($_REQUEST["pantalla"])&&$_REQUEST["pantalla"]=="tiny")
   echo '<input type="hidden" name="pantalla" value="tiny">';
?>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<input type="hidden" name="idformato" value="<?php echo ($idformato); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre de la funci&oacute;n</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre a mostrar</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_etiqueta" id="x_etiqueta" value="<?php echo htmlspecialchars(@$x_etiqueta) ?>">
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Descripci&oacute;n</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_descripcion" id="x_descripcion" value="<?php echo htmlspecialchars(@$x_descripcion) ?>">
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Ubicada en Archivo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_ruta" id="x_ruta" value="<?php echo htmlspecialchars(@$x_ruta) ?>">
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Listado de Formatos</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$x_formatoList = "<select name=\"x_formato[]\" multiple>";
$sSqlWrk = "SELECT DISTINCT idformato, etiqueta FROM formato";
$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$ar_x_formato= explode(",", @$x_formato);
		array_push($ar_x_formato,$idformato);
		$x_formatoList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		foreach ($ar_x_formato as $cnt_x_formato) {
			if ($datawrk["idformato"] == trim($cnt_x_formato)) {
				$x_formatoList .= "' selected";
				break;
			}
		}
		$x_formatoList .= ">" . $datawrk["etiqueta"] . "</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_formatoList .= "</select>";
echo $x_formatoList;
?>
</span></td>
	</tr>
	<tr>
		<td  class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">acciones</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php 
$ar_x_acciones = explode(",",@$x_acciones);
$x_accionesChk = "";
$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("a"). "\"";
foreach ($ar_x_acciones as $cnt_x_acciones) {
	if (trim($cnt_x_acciones) == "a") {
		$x_accionesChk .= " checked";
		break;
	}
}
	$x_accionesChk .= ">" . "Adicionar" . EditOptionSeparator(0);
$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("m"). "\"";
foreach ($ar_x_acciones as $cnt_x_acciones) {
	if (trim($cnt_x_acciones) == "m") {
		$x_accionesChk .= " checked";
		break;
	}
}
	$x_accionesChk .= ">" . "Mostrar" . EditOptionSeparator(1);
$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("e"). "\"";
foreach ($ar_x_acciones as $cnt_x_acciones) {
	if (trim($cnt_x_acciones) == "e") {
		$x_accionesChk .= " checked";
		break;
	}
}
	$x_accionesChk .= ">" . "Editar" . EditOptionSeparator(2);
echo $x_accionesChk;
?>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="EDITAR">
</form>
<?php include ("footer.php") ?>
<?php
//phpmkr_db_close($conn);
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables
encriptar_sqli("funciones_formatoedit",1,"form_info",$ruta_db_superior);
function LoadData($sKey,$conn)
{
  global $x_idfuncion_formato, $x_nombre,	$x_etiqueta, $x_descripcion, $x_ruta, $x_formato, $x_acciones;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM funciones_formato";
	$sSql .= " WHERE idfunciones_formato = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_idfuncion_formato = $row["idfunciones_formato"];
		$x_nombre = $row["nombre"];
		$x_etiqueta = $row["etiqueta"];
		$x_descripcion = $row["descripcion"];
		$x_ruta = $row["ruta"];
		$x_formato = $row["formato"];
		$x_acciones = $row["acciones"];
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
  global $x_idfuncion_formato, $x_nombre,	$x_etiqueta, $x_descripcion, $x_ruta, $x_formato, $x_acciones;
	// Open record
	$formato=busca_filtro_tabla("","formato","idformato=".$_REQUEST["idformato"],"",$conn);
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM funciones_formato";
	$sSql .= " WHERE idfunciones_formato = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$EditData = false; // Update Failed
	}else{
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["nombre"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_etiqueta) : $x_etiqueta; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["etiqueta"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_descripcion) : $x_descripcion; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["descripcion"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_ruta) : $x_ruta; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["ruta"] = $theValue;
		$theValue = implode(",", $x_formato);
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["formato"] = $theValue;
		$theValue = implode(",", $x_acciones);
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["acciones"] = $theValue;
        
		// update
		$sSql = "UPDATE funciones_formato SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idfunciones_formato =". $sKeyWrk;
		guardar_traza($sSql,$formato[0]["nombre_tabla"]);
		phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
		$EditData = true; // Update Successful
	}
	return $EditData;
}
?>
