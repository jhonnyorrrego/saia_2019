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
$x_idcampos_formato = Null;
$x_formato_idformato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_tipo_dato = Null;
$x_longitud = Null;
$x_obligatoriedad = Null;
$x_acciones = Null;
$x_etiqueta_html = Null;
$x_valor = Null;
$x_predeterminado = Null;
$x_ayuda = Null;
?>
<?php include ("db.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("key_d","key","idformato");
include_once($ruta_db_superior."librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());


?>
<?php
include ("phpmkrfn.php");
include_once("librerias/funciones.php");
?>
<?php

// Load Key Parameters
$sKey = @$_GET["key"];
$idformato=@$_REQUEST["idformato"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_POST["key_d"];
}
$sDbWhere = "";
$arRecKey = explode(",",$sKey);

// Single delete record
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	header("Location: campos_formatolist.php");
	exit(); 
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idcampos_formato=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}

switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount($sDbWhere,$conn) <= 0) {
			redirecciona("campos_formatolist.php?idformato=".$idformato);
		}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
      alerta("Eliminacion exitosa");
      if(isset($_REQUEST["pantalla"])&&$_REQUEST["pantalla"]=="tiny")
        {redirecciona("../tinymce34/jscripts/tiny_mce/plugins/formatos/formatos.php?formato=".$idformato."&tipo=campos_formato");
        }
      else
        redirecciona("campos_formatolist.php?idformato=".$idformato);
    }
		break;
}
?>

<p><span class="phpmaker">Borrar Campos del Formato</span></p>
<form id="campos_formatodelete" name="campos_formatodelete" action="campos_formatodelete.php" method="post">
<p>
<?php include ("header.php"); 
if(isset($_REQUEST["pantalla"])&&$_REQUEST["pantalla"]=="tiny")
  echo "<script>document.getElementById('header').style.display='none';</script>".'<input type="hidden" name="pantalla" value="tiny">'; 
?>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<input type="hidden" name="idformato" value="<?php echo  htmlspecialchars($idformato); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">idcampos formato</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Formato</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Tipo de Dato</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Longitud</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Obligatoriedad</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Acciones o Formularios</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta html</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Valor Predeterminado</span></td>
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
<b><?php echo $x_idcampos_formato; ?></b>
</span></td>
		<td><span class="phpmaker">
<?php
if ((!is_null($x_formato_idformato)) && ($x_formato_idformato <> "")) {
	$sSqlWrk = "SELECT DISTINCT *  FROM formato";
	$sTmp = $x_formato_idformato;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (idformato = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
		$sTmp .= ValueSeparator(0) . $rowwrk["etiqueta"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_formato_idformato = $x_formato_idformato; // Backup Original Value
$x_formato_idformato = $sTmp;
?>
<?php echo $x_formato_idformato; ?>
<?php $x_formato_idformato = $ox_formato_idformato; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_etiqueta; ?>
</span></td>
		<td><span class="phpmaker">
<?php
switch ($x_tipo_dato) {
	case "INT":
		$sTmp = "Entero";
		break;
	case "NUMBER":
		$sTmp = "N&uacute;mero";
		break;
	case "DOUBLE":
		$sTmp = "Doble";
		break;
	case "CHAR":
		$sTmp = "Caracter";
		break;
	case "VARCHAR":
		$sTmp = "Caracter Variable";
		break;
	case "TEXT":
		$sTmp = "Texto";
		break;
	case "DATE":
		$sTmp = "Fecha";
		break;
	case "TIME":
		$sTmp = "Hora";
		break;
	case "DATETIME":
		$sTmp = "Fecha y Hora";
		break;
	case "BLOB":
		$sTmp = "Binario";
		break;
	default:
		$sTmp = "";
}
$ox_tipo_dato = $x_tipo_dato; // Backup Original Value
$x_tipo_dato = $sTmp;
?>
<?php echo $x_tipo_dato; ?>
<?php $x_tipo_dato = $ox_tipo_dato; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_longitud; ?>
</span></td>
		<td><span class="phpmaker">
<?php
switch ($x_obligatoriedad) {
	case "NULL":
		$sTmp = "Nulo";
		break;
	case "NOT NULL":
		$sTmp = "Obligatorio";
		break;
	default:
		$sTmp = "";
}
$ox_obligatoriedad = $x_obligatoriedad; // Backup Original Value
$x_obligatoriedad = $sTmp;
?>
<?php echo $x_obligatoriedad; ?>
<?php $x_obligatoriedad = $ox_obligatoriedad; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php
$ar_x_acciones = explode(",", @$x_acciones);
$sTmp = "";
$rowcntwrk = 0;
foreach($ar_x_acciones as $cnt_x_acciones) {
	switch (trim($cnt_x_acciones)) {
		case "a":
			$sTmp .= "Adicionar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "e":
			$sTmp .= "Editar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
	}
	$rowcntwrk++;
}
if (strlen($sTmp) > 0) { $sTmp = substr($sTmp, 0, strlen($sTmp)-strlen($sTmp1)); }
$ox_acciones = $x_acciones; // Backup Original Value
$x_acciones = $sTmp;
?>
<?php echo $x_acciones; ?>
<?php $x_acciones = $ox_acciones; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php
switch ($x_etiqueta_html) {
	case "text":
		$sTmp = "Cuadro de Texto";
		break;
	case "password":
		$sTmp = "Contrase&ntilde;a";
		break;
	case "textarea":
		$sTmp = "Area de Texto";
		break;
	case "radio":
		$sTmp = "Boton de Selecci&oacute;n";
		break;
	case "checkbox":
		$sTmp = "Cuadro de Chequeo";
		break;
	case "select":
		$sTmp = "Lista Deplegable";
		break;
	case "dependientes":
		$sTmp = "Listado Dependiente";
		break;
	case "file":
		$sTmp = "Archivo";
		break;
	case "hidden":
		$sTmp = "Oculto";
		break;
	case "autocompletar":
		$sTmp = "Autocompletar";
		break;
	default:
		$sTmp = "";
}
$ox_etiqueta_html = $x_etiqueta_html; // Backup Original Value
$x_etiqueta_html = $sTmp;
?>
<?php echo $x_etiqueta_html; ?>
<?php $x_etiqueta_html = $ox_etiqueta_html; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_predeterminado; ?>
</span></td>
	</tr>
<?php
	}
}
?>
</table>
<p>
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

encriptar_sqli("campos_formatodelete",1,"form_info",$ruta_db_superior);
function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM campos_formato";
	$sSql .= " WHERE idcampos_formato = " . $sKeyWrk;
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
		$GLOBALS["x_idcampos_formato"] = $row["idcampos_formato"];
		$GLOBALS["x_formato_idformato"] = $row["formato_idformato"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_etiqueta"] = $row["etiqueta"];
		$GLOBALS["x_tipo_dato"] = $row["tipo_dato"];
		$GLOBALS["x_longitud"] = $row["longitud"];
		$GLOBALS["x_obligatoriedad"] = $row["obligatoriedad"];
		$GLOBALS["x_acciones"] = $row["acciones"];
		$GLOBALS["x_etiqueta_html"] = $row["etiqueta_html"];
		$GLOBALS["x_valor"] = $row["valor"];
		$GLOBALS["x_predeterminado"] = $row["predeterminado"];
		$GLOBALS["x_ayuda"] = $row["ayuda"];
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
	$sSql = "SELECT * FROM campos_formato";
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
	$sSql = "Delete FROM campos_formato";
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
	$formato=busca_filtro_tabla("A.*,B.nombre_tabla","campos_formato A,formato B","A.formato_idformato=B.idformato AND A.".$sqlKey,"",$conn);
	
	guardar_traza($sSql,$formato[0]["nombre_tabla"]);
	phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if($formato[0]["nombre_tabla"]){
		$sSql="ALTER TABLE ".$formato[0]["nombre_tabla"]." DROP ".$formato[0]["nombre"];
		guardar_traza($sSql,$formato[0]["nombre_tabla"]);
		phpmkr_query($sSql,$conn);// or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	}
	return true;
}
?>
