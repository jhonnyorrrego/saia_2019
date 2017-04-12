<?php session_start(); ?>
<?php ob_start(); ?>
<?php
// Initialize common variables
$x_idfuncion_formato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_descripcion = Null;
$x_ruta = Null;
$x_formato =@$_REQUEST["idformato"];
$x_acciones = Null;
$x_campodb = Null;
?>
<?php include ("db.php") ?>
<?php
include ("phpmkrfn.php");
include_once("librerias/funciones.php");
include_once("../librerias_saia.php");
?>
<?php

// Get action
$sAction = @$_POST["a_add"];

if (($sAction == "") || ((is_null($sAction)))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey != "") {
		$sAction = "C"; // Copy record
	} else {
		$sAction = "I"; // Display blank record
	}
} else {
	// Get fields from form
	$x_idfuncion_formato = @$_POST["x_idfuncion_formato"];
	$x_nombre = @$_POST["x_nombre"];
	$x_etiqueta = @$_POST["x_etiqueta"];
	$x_descripcion = @$_POST["x_descripcion"];
	$x_ruta = @$_POST["x_ruta"];
	$x_formato = @$_POST["x_formato"];
	$x_acciones = @$_POST["x_acciones"];
	$x_campodb = @$_POST["x_campodb"];
}

$adicionar = @$_REQUEST["adicionar"];
$noadiciona = @$_REQUEST["noadiciona"];
$editar = @$_REQUEST["editar"];
if ($adicionar == "" && $sAction != "A") {
	if (@$_REQUEST["pantalla"] == "tiny") {
		include_once ("generar_formato.php");
		$generar = new GenerarFormato($x_formato, "", '');

		$generar->generar_tabla();
		$generar->crear_formato_ae("adicionar");
		$generar->crear_formato_ae("editar");
		$generar->crear_formato_mostrar();
		$generar->crear_formato_buscar("buscar");
	}
	redirecciona("formatoview.php?key=" . $x_formato);
}
switch ($sAction) {
	case "C" : // Get a record to display
		if (!LoadData($sKey, $conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;
			// //phpmkr_db_close($conn);
			ob_end_clean();
			redirecciona("Location: funciones_formatolist.php");
			exit();
		}
		break;
	case "A" : // Add
		if (AddData($conn)) { // Add New Record
			alerta("Funcion Adicionada");
			// //phpmkr_db_close($conn);
			if ($adicionar != "")
				redirecciona("funciones_formatoadd.php?adicionar=" . $adicionar . "&editar=" . $editar . "&idformato=" . $x_formato);
			else
				redirecciona("funciones_formatolist.php?idformato=" . $x_formato);
		}
		if ($noadiciona != "") {
			alerta("No se Adiciona la Funcion");
			redirecciona("funciones_formatoadd.php?adicionar=" . $noadiciona . "&editar=" . $editar . "&idformato=" . $x_formato);
		}
		break;
}
?>
<?php include ("header.php");
echo(librerias_jquery());
?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript" src="../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator

//-->
</script>
<script type="text/javascript">
$().ready(function() {
	$("#x_nombre").keyup(function(){
 		var texto=$(this).val();
 		texto=texto.replace(/[^a-zA-Z0-9_]/,'')
 		$(this).val(texto.toLowerCase());
 	});
});
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
<!--p><span class="phpmaker">Funciones del formato<br><br><a href="funciones_formatolist.php">Back to List</a></span></p-->
<table cellspacing="1" cellpadding="2" bgcolor="#CCCCCC">
<?php
$adicionar=str_replace("listado_detalles_","id",$adicionar);
$nuevas=explode(",",$adicionar);
$dato_formato=busca_filtro_tabla("nombre,nombre_tabla","formato A","A.idformato=".$x_formato,"",$conn);
$where="A.formato LIKE '".$x_formato."' OR A.formato LIKE '%,".$x_formato.",%' OR A.formato LIKE '%,".$x_formato."' OR A.formato LIKE '".$x_formato.",%'";
if($editar){
  $where.="OR idfunciones_formato IN(".$editar.")";
}
$funciones=busca_filtro_tabla("*","funciones_formato A",$where,"",$conn);
$campos=busca_filtro_tabla("","campos_formato","formato_idformato=".$x_formato,"",$conn);
if($dato_formato["numcampos"]){
$nombre_formato=$dato_formato[0]["nombre"];

echo("<span class='phpmaker'>FORMATO: <b>");?><a href="formatoview.php?key=<?php echo $x_formato; ?>" class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 500, height:400,preserveContent:false } )"><?php echo($nombre_formato."</a></b></span><br><br><br>");
}
if(!$funciones["numcampos"] && !$campos["numcampos"]){
echo("<tr class='encabezado_list' align='center'><!--td>&nbsp;</td--><td>Almacenada</td><td>Nombre</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp</td><td>&nbsp;</td></tr>");
}
if($funciones["numcampos"]){
  echo("<tr class='encabezado_list' align='center'><!--td>&nbsp;</td--><td>Almacenada</td><td>Nombre</td><td>Descripcion</td><td>ruta</td><td>Acciones<br>Mostrar(m)<br>Adicionar(a)<br>editar(e)</td><td>Pertenece al <br />Formato</td></tr>");
  }
for($i=0;$i<$funciones["numcampos"];$i++){
  echo("<tr bgcolor='#F5F5F5' align='center'><!--td><a href='funciones_formatoedit.php?key=".$funciones[$i]["idfunciones_formato"]."'>Editar</a></td--><td>Si</td><td>".delimita($funciones[$i]["nombre"],100)."</td><td>".delimita($funciones[$i]["descripcion"],100)."</td><td>".$funciones[$i]["ruta"]."</td><td>".$funciones[$i]["acciones"]."</td>");
  if(strpos($x_formato,$funciones[$i]["formato"])!==false){
    echo("<td> si</td>");
  }
  else echo("<td>No</td>");
  echo("</tr>");
}

/*print_r($funciones);
echo($sql." ---<br />");
print_r($campos);*/
if($campos["numcampos"]){
  echo("<tr class='encabezado_list' align='center'><!--td>&nbsp;</td--><td>Almacenada</td><td>Nombre</td><td>Descripcion</td><td>ruta</td><td>Acciones<br>Mostrar(m)<br>Adicionar(a)<br>editar(e)</td><td>Tipo de Dato</td></tr>");
}
for($i=0;$i<$campos["numcampos"];$i++){
  echo("<tr bgcolor='#F5F5F5' align='center'><!--td><a href='funciones_formatoedit.php?key=".$campos[$i]["idfunciones_formato"]."'>Editar</a></td--><td>Si</td><td>".delimita($campos[$i]["nombre"],100)."</td><td>".delimita($campos[$i]["ayuda"],100)."</td><td>".$campos[$i]["etiqueta_html"]."</td><td>".$campos[$i]["acciones"]."</td>");
echo("<td>".$campos[$i]["tipo_dato"]."</td>");
  echo("</tr>");
}

$nuevo_campo=array_shift($nuevas);
$cont=count($nuevas);
for($i=0;$i<$cont;$i++){
  echo("<tr bgcolor='#F5F5F5' align='center'><!--td>&nbsp;</td--><td>No</td><td>".$nuevas[$i]."</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td</tr>");
}
?>
</table><br><br>
<form name="funciones_formatoadd" id="funciones_formatoadd" action="funciones_formatoadd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<input type="hidden" name="editar" value="<?php echo($editar);?>">
<input type="hidden" name="idformato" value="<?php echo($x_formato);?>">
<input type="hidden" name="x_formato" value="<?php echo($x_formato);?>">
<input type="hidden" name="adicionar" value="<?php echo(implode(",",$nuevas));?>">
<input type="hidden" name="noadiciona" value="<?php echo($adicionar);?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre de la funci&oacute;n</span></td>
		<td bgcolor="#F5F5F5">
<input type="hidden" name="x_nombre" id="x_nombre" value="<?php echo (@$nuevo_campo); ?>">
<?php echo($nuevo_campo)?>
</td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre a mostrar</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_etiqueta" id="x_etiqueta" value="<?php echo htmlspecialchars(@$x_etiqueta) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Descripci&oacute;n</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_descripcion" id="x_descripcion" value="<?php echo htmlspecialchars(@$x_descripcion) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Ubicada en Archivo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_ruta" id="x_ruta" value="<?php echo ("funciones.php") ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">acciones</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_acciones)) || ($x_acciones == "")) { $x_acciones = "m";} // Set default value ?>
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
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Es un Campo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_campodb" id="x_campodb" value="1" checked="1">Si
<input type="radio" name="x_campodb" id="x_campodb" value="0" >No
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="ADICIONAR">
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

function LoadData($sKey,$conn)
{
  global $x_idfunciones_formato, $x_nombre, $x_etiqueta, $x_descripcion, $x_ruta, $x_formato,	$x_acciones;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM funciones_formato";
	$sSql .= " WHERE idfuncion_formato = " . $sKeyWrk;
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
		$GLOBALS["x_idfunciones_formato"] = $row["idfunciones_formato"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_etiqueta"] = $row["etiqueta"];
		$GLOBALS["x_descripcion"] = $row["descripcion"];
		$GLOBALS["x_ruta"] = $row["ruta"];
		$GLOBALS["x_formato"] = $row["formato"];
		$GLOBALS["x_acciones"] = $row["acciones"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function AddData
// - Add Data
// - Variables used: field variables

function AddData($conn)
{
  global $x_idfunciones_formato, $x_nombre, $x_etiqueta, $x_descripcion, $x_ruta, $x_formato,	$x_acciones,$x_campodb;
	// Add New Record
	$formato=busca_filtro_tabla("","formato","idformato=".$_REQUEST["idformato"],"",$conn);
	$sSql = "SELECT * FROM funciones_formato";
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

  // Field nombre_funcion
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre;
	$theValue = ($theValue != "") ? " '" . str_replace("*}","",str_replace("{*","",$theValue)) . "'" : "NULL";
	$fieldList["nombre_funcion"] = $theValue;


  // Field etiqueta
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_etiqueta) : $x_etiqueta;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["etiqueta"] = $theValue;

	// Field descripcion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_descripcion) : $x_descripcion;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "'"."'";
	$fieldList["descripcion"] = $theValue;

	// Field ruta
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_ruta) : $x_ruta;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["ruta"] = $theValue;

	// Field formato
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_formato) : $x_formato;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["formato"] = $theValue;

	// Field acciones
	$theValue = implode(",", $x_acciones);
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["acciones"] = $theValue;

  //Si lo que se requeire en el formato es un campo entonces no es necesario almacenar los datos que se encuentran en funcion
  if($x_campodb==1){
    $nombre=str_replace("{*","",$fieldList["nombre"]);
    $nombre=str_replace("*}","",$nombre);
    $strsql="INSERT INTO campos_formato(formato_idformato,nombre,etiqueta,tipo_dato,longitud,ayuda) VALUES(".$fieldList["formato"].",".$nombre.",".$fieldList["etiqueta"].",'VARCHAR',255,".$fieldList["descripcion"].")";
	guardar_traza($strsql,$formato[0]["nombre_tabla"]);
	phpmkr_query($strsql, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:<br />' . $strsql." <br />");
	return true;
  }
	// insert into database
	$strsql = "INSERT INTO funciones_formato (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	guardar_traza($strsql,$formato[0]["nombre_tabla"]);
	phpmkr_query($strsql, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:<br />' . $strsql." <br />");

	return true;
}
?>