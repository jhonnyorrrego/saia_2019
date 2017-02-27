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
$x_idformato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_contador_idcontador = Null;
$x_ruta_mostrar = Null;
$x_ruta_editar = Null;
$x_ruta_adicionar = Null;
$x_librerias = Null;
$x_encabezado = Null;
$x_cuerpo = Null;
$x_pie_pagina = Null;
$x_margenes = Null;
$x_orientacion = Null;
$x_papel = Null;
$x_exportar = Null;
?>
<?php 
include ("db.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
include_once($ruta_db_superior."librerias_saia.php");
$validar_enteros=array("key");
desencriptar_sqli('form_info');
echo(librerias_jquery());

include ("phpmkrfn.php");
include_once("librerias/funciones.php"); 
?>
<?php

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
	header("Location: formatolist.php");
	exit(); 
}

	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idformato=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}

switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount($sDbWhere,$conn) <= 0) {
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: formatolist.php"); 
			exit();
		}
		break;
	case "D": // Delete
		if (DeleteData($sKey,$conn)) {
			$_SESSION["ewmsg"] = "Delete Successful For Key = " . stripslashes($sKey);
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: formatolist.php");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<p><span class="phpmaker"><img class="imagen_internos" src="../botones/configuracion/crear_documentos.png" border="0">Borrar Formatos<br><br><a href="formatolist.php">Ir al Listado</a></span></p>
<form id="formatodelete" name="formatodelete" action="formatodelete.php" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">idformato</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Contador</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Margenes(Izq, Der, Sup, Inf)</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Orientaci�n</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Tama&ntilde;o del Papel</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">M&eacute;todo Exportar</span></td>
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
<?php echo $x_idformato; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_etiqueta; ?>
</span></td>
		<td><span class="phpmaker">
<?php
if ((!is_null($x_contador_idcontador)) && ($x_contador_idcontador <> "")) {
	$sSqlWrk = "SELECT DISTINCT *  FROM contador";
	$sTmp = $x_contador_idcontador;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (idcontador = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_contador_idcontador = $x_contador_idcontador; // Backup Original Value
$x_contador_idcontador = $sTmp;
?>
<?php echo $x_contador_idcontador; ?>
<?php $x_contador_idcontador = $ox_contador_idcontador; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_margenes; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_orientacion; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_papel; ?>
</span></td>
		<td><span class="phpmaker">
<?php
$ar_x_exportar = explode(",", @$x_exportar);
$sTmp = "";
$rowcntwrk = 0;
foreach($ar_x_exportar as $cnt_x_exportar) {
	switch (trim($cnt_x_exportar)) {
		case "pdf":
			$sTmp .= "PDF";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "xls":
			$sTmp .= "Excel";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "word":
			$sTmp .= "Word (RTF)";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
	}
	$rowcntwrk++;
}
if (strlen($sTmp) > 0) { $sTmp = substr($sTmp, 0, strlen($sTmp)-strlen($sTmp1)); }
$ox_exportar = $x_exportar; // Backup Original Value
$x_exportar = $sTmp;
?>
<?php echo $x_exportar; ?>
<?php $x_exportar = $ox_exportar; // Restore Original Value ?>
</span></td>
	</tr>
<?php
	}
}
?>
</table>
<p>
<p>
Listado de campos Vinculados con el Formato<br /><br />
<?php listado_campos_formato(); ?>
</p>
<p>
Listado de Funciones de formatos y Fromatos vinculados con el Actual<br /><br />
<?php listado_funciones_formato(); ?>
</p>
<input type="submit" name="Action" value="CONFIRM DELETE">
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
encriptar_sqli("formatodelete",1,"form_info",$ruta_db_superior);
function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM formato";
	$sSql .= " WHERE idformato = " . $sKeyWrk;
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
		$GLOBALS["x_idformato"] = $row["idformato"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_etiqueta"] = $row["etiqueta"];
		$GLOBALS["x_contador_idcontador"] = $row["contador_idcontador"];
		$GLOBALS["x_ruta_mostrar"] = $row["ruta_mostrar"];
		$GLOBALS["x_ruta_editar"] = $row["ruta_editar"];
		$GLOBALS["x_ruta_adicionar"] = $row["ruta_adicionar"];
		$GLOBALS["x_librerias"] = $row["librerias"];
		$GLOBALS["x_encabezado"] = $row["encabezado"];
		$GLOBALS["x_cuerpo"] = $row["cuerpo"];
		$GLOBALS["x_pie_pagina"] = $row["pie_pagina"];
		$GLOBALS["x_margenes"] = $row["margenes"];
		$GLOBALS["x_orientacion"] = $row["orientacion"];
		$GLOBALS["x_papel"] = $row["papel"];
		$GLOBALS["x_exportar"] = $row["exportar"];
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
	$sSql = "SELECT * FROM formato";
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
	$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
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
	$sSql = "Delete FROM formato";
	$sSql .= " WHERE idformato=" . $sqlKey;
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
	$nombre=busca_filtro_tabla("","formato A","idformato=".$sqlKey,"",$conn);
	$modulo=busca_filtro_tabla("","modulo","lower(nombre) IN('".$nombre[0]["nombre"]."','crear_".$nombre[0]["nombre"]."')","",$conn);
	
	guardar_traza($sSql,$nombre[0]["nombre_tabla"]);
	phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	
	$eliminar_tabla="DROP TABLE ".$nombre[0]["nombre_tabla"];
	guardar_traza($eliminar_tabla,$nombre[0]["nombre_tabla"]);
	phpmkr_query($eliminar_tabla) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $eliminar_tabla);
	
	$eliminar_modulo="DELETE FROM modulo WHERE idmodulo=".$modulo[0]["idmodulo"];
	guardar_traza($eliminar_modulo,$nombre[0]["nombre_tabla"]);
	phpmkr_query($eliminar_modulo) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $eliminar_modulo);
	
	$eliminar_modulo="DELETE FROM modulo WHERE idmodulo=".$modulo[1]["idmodulo"];
	guardar_traza($eliminar_modulo,$nombre[0]["nombre_tabla"]);
	phpmkr_query($eliminar_modulo) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $eliminar_modulo);
	
	$eliminar_campos_formato="DELETE FROM campos_formato WHERE formato_idformato=".$sqlKey;
	guardar_traza($eliminar_campos_formato,$nombre[0]["nombre_tabla"]);
	phpmkr_query($eliminar_campos_formato) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $eliminar_campos_formato);
	
	return true;
}
function listado_funciones_formato(){
global $conn;
$idformato=@$_REQUEST["key"];
$funciones=busca_filtro_tabla("*","funciones_formato A","A.formato LIKE '".$idformato."' OR A.formato LIKE '%,".$idformato.",%' OR A.formato LIKE '%,".$idformato."' OR A.formato LIKE '".$idformato.",%' AND A.acciones LIKE '%m%'","",$conn);
$lfunciones=array();
if($funciones["numcampos"]){
  echo('<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
  	<tr class="encabezado_list">
  		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
  		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Parametros</span></td>
  		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Formatos Vinculados</span></td>
  		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Ruta</span></td>
  		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Descripcion</span></td>
  	</tr>');	
  for($i=0;$i<$funciones["numcampos"];$i++){
  	$colorfila = " bgcolor=\"#FFFFFF\"";
	// Display alternate color for rows
	 if ($i % 2 <> 0) {
		  $colorfila = " bgcolor=\"#F5F5F5\"";
	 }
    echo('<tr '.$colorfila.'>');
    if($funciones[$i]["formato"]!=""){
      $listado_funciones=busca_filtro_tabla("nombre","formato","idformato IN('".implode("','",explode(",",$funciones[$i]["formato"]))."')","",$conn);  
      if($listado_funciones["numcampos"])  
        $lfunciones=extrae_campo($listado_funciones,"nombre","U");  
    }
    echo('<td><span class="phpmaker">'.$funciones[$i]["nombre_funcion"].'</span></td><td>'.listado($funciones[$i]["parametros"]).'</td>');
    echo('<td>'.listado($lfunciones).'</td>');
    echo('<td><span class="phpmaker">'.$funciones[$i]["ruta"].'</span></td><td><span class="phpmaker">'.$funciones[$i]["descripcion"].'</span></td>');
    echo('</tr>');
  }
  echo('</table>');
}
else echo('<spanclass="phpmaker"> NO SE ENCONTRARON FUNCIONES</span>');
}
/*Saca un listado dependiendo del parametro de un arreglo o una cadena separada por separador tipo puedeser listado,numero*/
function listado($dato,$tipo="listado",$separador=","){
if($tipo=="numero"){
  $encabezado="ol";
}
else $encabezado="ul";
  if(!is_array($dato)){
    $datos=explode($separador,$dato);  
  }
  else $datos=$dato;
  $campos=count($datos);
  $texto.='<'.$encabezado.'>';
  
  for($i=0;$i<$campos;$i++){
    $texto.='
    <li><pre><span class="phpmaker">'.$datos[$i].'</span></pre></li>
    ';
  }  
  $texto.='</'.$encabezado.'>';
return($texto);  
}
function listado_campos_formato(){
global $conn;
$idformato=@$_REQUEST["key"];
$funciones=busca_filtro_tabla("*","campos_formato A","A.formato_idformato=".$idformato,"",$conn);
if($funciones["numcampos"]){
echo('<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Tipo de Dato</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta HTML</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Obligatoriedad</span></td>
	</tr>');
  for($i=0;$i<$funciones["numcampos"];$i++){
  	$colorfila = " bgcolor=\"#FFFFFF\"";
	// Display alternate color for rows
	 if ($i % 2 <> 0) {
		  $colorfila = " bgcolor=\"#F5F5F5\"";
	 }
    echo('<tr '.$colorfila.'>');
    echo('<td><span class="phpmaker">'.$funciones[$i]["nombre"].'</span></td><td>'.$funciones[$i]["Etiqueta"].'</td>');
    echo('<td>'.$funciones[$i]["tipo_dato"].'</td>');
    echo('<td><span class="phpmaker">'.$funciones[$i]["etiqueta_html"].'</span></td><td><span class="phpmaker">'.$funciones[$i]["obligatoriedad"].'</span></td>');
    echo('</tr>');
  }
  echo('</table>');
}
else echo('<spanclass="phpmaker"> NO SE ENCONTRARON FUNCIONES</span>');
}
?>
