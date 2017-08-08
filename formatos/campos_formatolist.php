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
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery());
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("idformato");
desencriptar_sqli('form_info');

?>
<?php include ("phpmkrfn.php") ?>
<?php
$nStartRec = 0;
$nStopRec = 0;
$nTotalRecs = 0;
$nRecCount = 0;
$nRecActual = 0;
$sKeyMaster = "";
$sDbWhereMaster = "";
$sSrchAdvanced = "";
$sSrchBasic = "";
$sSrchWhere = "";
$sDbWhere = "";
$sDefaultOrderBy = "";
$sDefaultFilter = "";
$sWhere = "";
$sGroupBy = "";
$sHaving = "";
$sOrderBy = "";
$sSqlMaster = "";
$nDisplayRecs = 0;
$nRecRange = 10;

// Open connection to the database


// Handle Reset Command
ResetCmd();

// Get Search Criteria for Advanced Search
SetUpAdvancedSearch();

// Get Search Criteria for Basic Search
SetUpBasicSearch();

// Build Search Criteria
if ($sSrchAdvanced != "") {
	$sSrchWhere = $sSrchAdvanced; // Advanced Search
}
elseif ($sSrchBasic != "") {
	$sSrchWhere = $sSrchBasic; // Basic Search
}

// Save Search Criteria
if ($sSrchWhere != "") {
	$_SESSION["campos_formato_searchwhere"] = $sSrchWhere;

	// Reset start record counter (new search)
	$nStartRec = 1;
	$_SESSION["campos_formato_REC"] = $nStartRec;
}
else
{
	$sSrchWhere = @$_SESSION["campos_formato_searchwhere"];
}

// Build WHERE condition
$sDbWhere = "";
if(@$_REQUEST["idformato"])
  $sDbWhere = "formato_idformato=".@$_REQUEST["idformato"];
  /*
if ($sDbWhereMaster != "") {
	$sDbWhere .= "(" . $sDbWhereMaster . ") AND ";
}
if ($sSrchWhere != "") {
	$sDbWhere .= "(" . $sSrchWhere . ") AND ";
}
if (strlen($sDbWhere) > 5) {
	$sDbWhere = substr($sDbWhere, 0, strlen($sDbWhere)-5); // Trim rightmost AND
}
*/
// Build SQL
$sSql = "SELECT * FROM campos_formato";

// Load Default Filter
$sDefaultFilter = "";
$sGroupBy = "";
$sHaving = "";

// Load Default Order
$sDefaultOrderBy = "orden";
$sWhere = "";
if ($sDefaultFilter != "") {
	$sWhere .= "(" . $sDefaultFilter . ") AND ";
}
if ($sDbWhere != "") {
	$sWhere .= "(" . $sDbWhere . ") AND ";
}
if (substr($sWhere, -5) == " AND ") {
	$sWhere = substr($sWhere, 0, strlen($sWhere)-5);
}
if ($sWhere != "") {
	$sSql .= " WHERE " . $sWhere;
}
if ($sGroupBy != "") {
	$sSql .= " GROUP BY " . $sGroupBy;
}
if ($sHaving != "") {
	$sSql .= " HAVING " . $sHaving;
}

// Set Up Sorting Order
$sOrderBy = "";
SetUpSortOrder();
if ($sOrderBy != "") {
	$sSql .= " ORDER BY " . $sOrderBy;
}

?>
<?php include ("header.php") ?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<?php

// Set up Record Set

$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);

$nTotalRecs = phpmkr_num_rows($rs);

if ($nDisplayRecs <= 0) { // Display All Records
	$nDisplayRecs = $nTotalRecs;
}
$nStartRec = 1;
SetUpStartRec(); // Set Up Start Record Position
?>
<p><span class="phpmaker"> Campos del Formato
</span></p>
<form name="campos_formatolist" id="campos_formatolist" action="campos_formatolist.php?idformato=<?php echo(@$_REQUEST["idformato"])?>">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="psearch" size="20">
			<input type="Submit" name="Submit" value="Buscar &nbsp;(*)">&nbsp;&nbsp;
		</span></td>
	</tr>
</table>
</form>
<span class="phpmaker">
<a href="<?php echo $ruta_db_superior; ?>formatos/funciones_formatolist.php?idformato=<?php echo(@$_REQUEST["idformato"])?>">Funciones formato</a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/campos_formatoadd.php?idformato=<?php echo(@$_REQUEST["idformato"])?>">Adicionar Campos al Formato</a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/campos_formato_ordenar.php?idformato=<?php echo(@$_REQUEST["idformato"])?>">Ordenar Campos</a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/llamado_formatos.php?acciones_formato=formato,adicionar,buscar,editar,mostrar,tabla&accion=generar&condicion=idformato@<?php echo $_REQUEST["idformato"];?>">Generar el Formato</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/generar_formato.php?genera=tabla&idformato=<?php echo(@$_REQUEST["idformato"])?>">Crear Tabla</a></span>
<p>
<form method="post">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
<?php if ($nTotalRecs > 0) { ?>
	<!-- Table header -->
	<tr class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="campos_formatolist.php?idformato=<?php echo @$_REQUEST["idformato"]; ?>&order=<?php echo urlencode("idcampos_formato"); ?>" style="color: #FFFFFF;" onMouseDown="ewsort(event, this.href);">idcampos formato<?php if (@$_SESSION["campos_formato_x_idcampos_formato_Sort"] == "ASC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["campos_formato_x_idcampos_formato_Sort"] == "DESC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="campos_formatolist.php?idformato=<?php echo @$_REQUEST["idformato"]; ?>&order=<?php echo urlencode("formato_idformato"); ?>" style="color: #FFFFFF;" onMouseDown="ewsort(event, this.href);">Formato<?php if (@$_SESSION["campos_formato_x_formato_idformato_Sort"] == "ASC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["campos_formato_x_formato_idformato_Sort"] == "DESC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="campos_formatolist.php?idformato=<?php echo @$_REQUEST["idformato"]; ?>&order=<?php echo urlencode("nombre"); ?>" style="color: #FFFFFF;" onMouseDown="ewsort(event, this.href);">Nombre&nbsp;(*)<?php if (@$_SESSION["campos_formato_x_nombre_Sort"] == "ASC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["campos_formato_x_nombre_Sort"] == "DESC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="campos_formatolist.php?idformato=<?php echo @$_REQUEST["idformato"]; ?>&order=<?php echo urlencode("etiqueta"); ?>" style="color: #FFFFFF;" onMouseDown="ewsort(event, this.href);">Etiqueta&nbsp;(*)<?php if (@$_SESSION["campos_formato_x_etiqueta_Sort"] == "ASC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["campos_formato_x_etiqueta_Sort"] == "DESC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="campos_formatolist.php?idformato=<?php echo @$_REQUEST["idformato"]; ?>&order=<?php echo urlencode("tipo_dato"); ?>" style="color: #FFFFFF;" onMouseDown="ewsort(event, this.href);">Tipo de Dato<?php if (@$_SESSION["campos_formato_x_tipo_dato_Sort"] == "ASC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["campos_formato_x_tipo_dato_Sort"] == "DESC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="campos_formatolist.php?idformato=<?php echo @$_REQUEST["idformato"]; ?>&order=<?php echo urlencode("longitud"); ?>" style="color: #FFFFFF;" onMouseDown="ewsort(event, this.href);">Longitud&nbsp;(*)<?php if (@$_SESSION["campos_formato_x_longitud_Sort"] == "ASC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["campos_formato_x_longitud_Sort"] == "DESC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="campos_formatolist.php?idformato=<?php echo @$_REQUEST["idformato"]; ?>&order=<?php echo urlencode("obligatoriedad"); ?>" style="color: #FFFFFF;" onMouseDown="ewsort(event, this.href);">Obligatoriedad<?php if (@$_SESSION["campos_formato_x_obligatoriedad_Sort"] == "ASC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["campos_formato_x_obligatoriedad_Sort"] == "DESC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="campos_formatolist.php?idformato=<?php echo @$_REQUEST["idformato"]; ?>&order=<?php echo urlencode("acciones"); ?>" style="color: #FFFFFF;" onMouseDown="ewsort(event, this.href);">Acciones o Formularios&nbsp;(*)<?php if (@$_SESSION["campos_formato_x_acciones_Sort"] == "ASC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["campos_formato_x_acciones_Sort"] == "DESC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="campos_formatolist.php?idformato=<?php echo @$_REQUEST["idformato"]; ?>&order=<?php echo urlencode("etiqueta_html"); ?>" style="color: #FFFFFF;" onMouseDown="ewsort(event, this.href);">Etiqueta html<?php if (@$_SESSION["campos_formato_x_etiqueta_html_Sort"] == "ASC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["campos_formato_x_etiqueta_html_Sort"] == "DESC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="campos_formatolist.php?idformato=<?php echo @$_REQUEST["idformato"]; ?>&order=<?php echo urlencode("predeterminado"); ?>" style="color: #FFFFFF;" onMouseDown="ewsort(event, this.href);">Valor Predeterminado&nbsp;(*)<?php if (@$_SESSION["campos_formato_x_predeterminado_Sort"] == "ASC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["campos_formato_x_predeterminado_Sort"] == "DESC") { ?><img src="<?php echo $ruta_db_superior; ?>images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>		
	</tr>
<?php } ?>
<?php

// Avoid starting record > total records
if ($nStartRec > $nTotalRecs) {
	$nStartRec = $nTotalRecs;
}

// Set the last record to display
$nStopRec = $nStartRec + $nDisplayRecs - 1;

// Move to first record directly for performance reason
$nRecCount = $nStartRec - 1;
//if (phpmkr_num_rows($rs) > 0) {
//	phpmkr_data_seek($rs, $nStartRec -1);
//}
$nRecActual = 0;
while (($row = @phpmkr_fetch_array($rs)) && ($nRecCount < $nStopRec)) {
	
  $nRecCount = $nRecCount + 1;
	if ($nRecCount >= $nStartRec) {
		$nRecActual = $nRecActual + 1;

	// Set row color
	$sItemRowClass = " bgcolor=\"#FFFFFF\"";

	// Display alternate color for rows
	if ($nRecCount % 2 <> 0) {
		$sItemRowClass = " bgcolor=\"#F5F5F5\"";
	}

		// Load Key for record
		$sKey = $row["idcampos_formato"];
		$x_idcampos_formato = $row["idcampos_formato"];
		$x_formato_idformato = $row["formato_idformato"];
		$x_nombre = $row["nombre"];
		$x_etiqueta = $row["etiqueta"];
		$x_tipo_dato = $row["tipo_dato"];
		$x_longitud = $row["longitud"];
		$x_obligatoriedad = $row["obligatoriedad"];
		$x_acciones = $row["acciones"];
		$x_etiqueta_html = $row["etiqueta_html"];
		$x_valor = $row["valor"];
		$x_predeterminado = $row["predeterminado"];
		$x_ayuda = $row["ayuda"];
?>
	<!-- Table body -->
	<tr<?php echo $sItemRowClass; ?>>
		<!-- idcampos_formato -->
		<td><span class="phpmaker">
<b><?php echo $x_idcampos_formato; ?></b>
</span></td>
		<!-- formato_idformato -->
		<td><span class="phpmaker">
<?php
if ((!is_null($x_formato_idformato)) && ($x_formato_idformato <> "")) {
	$datos=busca_filtro_tabla("idformato,nombre,etiqueta","formato","idformato=$x_formato_idformato","",$conn);
	$sTmp=$datos[0]["nombre"].", ".$datos[0]["etiqueta"];
} else {
	$sTmp = "";
}
$ox_formato_idformato = $x_formato_idformato; // Backup Original Value
$x_formato_idformato = $sTmp;
?>
<?php echo $x_formato_idformato; ?>
<?php $x_formato_idformato = $ox_formato_idformato; // Restore Original Value ?>
</span></td>
		<!-- nombre -->
		<td><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
		<!-- etiqueta -->
		<td><span class="phpmaker">
<?php echo $x_etiqueta; ?>
</span></td>
		<!-- tipo_dato -->
		<td><span class="phpmaker">
<?php echo $x_tipo_dato; ?>
<?php $x_tipo_dato = $ox_tipo_dato; // Restore Original Value ?>
</span></td>
		<!-- longitud -->
		<td><span class="phpmaker">
<?php echo $x_longitud; ?>
</span></td>
		<!-- obligatoriedad -->
		<td><span class="phpmaker">
<?php
switch ($x_obligatoriedad) {
	case 0:
		$sTmp = "Nulo";
		break;
	case 1:
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
		<!-- acciones -->
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
		case "o":
			$sTmp .= "Ocultar";
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
		<!-- etiqueta_html -->
		<td><span class="phpmaker">
<?php echo $x_etiqueta_html; ?>
<?php $x_etiqueta_html = $ox_etiqueta_html; // Restore Original Value ?>
</span></td>
		<!-- predeterminado -->
		<td><span class="phpmaker">
<?php echo $x_predeterminado; ?>
</span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "campos_formatoview.php?idformato=".@$_REQUEST["idformato"]."&key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');";  } ?>">Ver</a></span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "campos_formatoedit.php?idformato=".@$_REQUEST["idformato"]."&key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; } ?>">Editar</a></span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "campos_formatoadd.php?idformato=".@$_REQUEST["idformato"]."&key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; } ?>">Copiar</a></span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "campos_formatodelete.php?idformato=".@$_REQUEST["idformato"]."&key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; }  ?>">Borrar</a></span></td>
	</tr>
<?php
	}
}
?>
</table>
</form>
<?php

// Close recordset and connection
phpmkr_free_result($rs);
//phpmkr_db_close($conn);
?>
<!--form action="campos_formatolist.php" name="ewpagerform" id="ewpagerform">
<table bgcolor="" border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td nowrap>
<?php
if ($nTotalRecs > 0) {
	$rsEof = ($nTotalRecs < ($nStartRec + $nDisplayRecs));
	$PrevStart = $nStartRec - $nDisplayRecs;
	if ($PrevStart < 1) { $PrevStart = 1; }
	$NextStart = $nStartRec + $nDisplayRecs;
	if ($NextStart > $nTotalRecs) { $NextStart = $nStartRec ; }
	$LastStart = intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1;
	?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
	<?php if ($nStartRec == 1) { ?>
	<td><img src="<?php echo $ruta_db_superior; ?>images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="campos_formatolist.php?start=1"><img src="<?php echo $ruta_db_superior; ?>images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } ?>
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="<?php echo $ruta_db_superior; ?>images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="campos_formatolist.php?start=<?php echo $PrevStart; ?>"><img src="<?php echo $ruta_db_superior; ?>images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } ?>
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="<?php echo $ruta_db_superior; ?>images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="campos_formatolist.php?start=<?php echo $NextStart; ?>"><img src="<?php echo $ruta_db_superior; ?>images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>
	<?php  } ?>
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="<?php echo $ruta_db_superior; ?>images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="campos_formatolist.php?start=<?php echo $LastStart; ?>"><img src="<?php echo $ruta_db_superior; ?>images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo intval(($nTotalRecs-1)/$nDisplayRecs+1);?></span></td>
	</tr></table>
	<?php if ($nStartRec > $nTotalRecs) { $nStartRec = $nTotalRecs; }
	$nStopRec = $nStartRec + $nDisplayRecs - 1;
	$nRecCount = $nTotalRecs - 1;
	if ($rsEof) { $nRecCount = $nTotalRecs; }
	if ($nStopRec > $nRecCount) { $nStopRec = $nRecCount; } ?>
	<span class="phpmaker">Records <?php echo $nStartRec; ?> to <?php echo $nStopRec; ?> of <?php echo $nTotalRecs; ?></span>
<?php } else { ?>
	<span class="phpmaker">No records found</span>
<?php } ?>
		</td>
	</tr>
</table>
</form-->
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function SetUpAdvancedSearch
// - Set up Advanced Search parameter based on querystring parameters from Advanced Search Page
// - Variables setup: sSrchAdvanced
encriptar_sqli("campos_formatolist",1,"form_info",$ruta_db_superior);
function SetUpAdvancedSearch()
{
	global $sSrchAdvanced;

	// Field idcampos_formato
	$x_idcampos_formato = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_idcampos_formato"]) : @$_GET["x_idcampos_formato"];
	$arrFldOpr = array();
	$z_idcampos_formato = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_idcampos_formato"]) : @$_GET["z_idcampos_formato"];
	$arrFldOpr = explode(",",$z_idcampos_formato);
	if ($x_idcampos_formato <> "") {
		$sSrchAdvanced .= "idcampos_formato "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_idcampos_formato) : $x_idcampos_formato; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field formato_idformato
	$x_formato_idformato = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_formato_idformato"]) : @$_GET["x_formato_idformato"];
	$arrFldOpr = array();
	$z_formato_idformato = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_formato_idformato"]) : @$_GET["z_formato_idformato"];
	$arrFldOpr = explode(",",$z_formato_idformato);
	if ($x_formato_idformato <> "") {
		$sSrchAdvanced .= "formato_idformato "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_formato_idformato) : $x_formato_idformato; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field nombre
	$x_nombre = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_nombre"]) : @$_GET["x_nombre"];
	$arrFldOpr = array();
	$z_nombre = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_nombre"]) : @$_GET["z_nombre"];
	$arrFldOpr = explode(",",$z_nombre);
	if ($x_nombre <> "") {
		$sSrchAdvanced .= "nombre "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field etiqueta
	$x_etiqueta = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_etiqueta"]) : @$_GET["x_etiqueta"];
	$arrFldOpr = array();
	$z_etiqueta = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_etiqueta"]) : @$_GET["z_etiqueta"];
	$arrFldOpr = explode(",",$z_etiqueta);
	if ($x_etiqueta <> "") {
		$sSrchAdvanced .= "etiqueta "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_etiqueta) : $x_etiqueta; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field tipo_dato
	$x_tipo_dato = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_tipo_dato"]) : @$_GET["x_tipo_dato"];
	$arrFldOpr = array();
	$z_tipo_dato = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_tipo_dato"]) : @$_GET["z_tipo_dato"];
	$arrFldOpr = explode(",",$z_tipo_dato);
	if ($x_tipo_dato <> "") {
		$sSrchAdvanced .= "tipo_dato "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_tipo_dato) : $x_tipo_dato; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field longitud
	$x_longitud = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_longitud"]) : @$_GET["x_longitud"];
	$arrFldOpr = array();
	$z_longitud = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_longitud"]) : @$_GET["z_longitud"];
	$arrFldOpr = explode(",",$z_longitud);
	if ($x_longitud <> "") {
		$sSrchAdvanced .= "longitud "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_longitud) : $x_longitud; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field obligatoriedad
	$x_obligatoriedad = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_obligatoriedad"]) : @$_GET["x_obligatoriedad"];
	$arrFldOpr = array();
	$z_obligatoriedad = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_obligatoriedad"]) : @$_GET["z_obligatoriedad"];
	$arrFldOpr = explode(",",$z_obligatoriedad);
	if ($x_obligatoriedad <> "") {
		$sSrchAdvanced .= "obligatoriedad "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_obligatoriedad) : $x_obligatoriedad; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field acciones
	$x_acciones = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_acciones"]) : @$_GET["x_acciones"];
	$arrFldOpr = array();
	$z_acciones = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_acciones"]) : @$_GET["z_acciones"];
	$arrFldOpr = explode(",",$z_acciones);
	if ($x_acciones <> "") {
		$sSrchAdvanced .= "acciones "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_acciones) : $x_acciones; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field etiqueta_html
	$x_etiqueta_html = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_etiqueta_html"]) : @$_GET["x_etiqueta_html"];
	$arrFldOpr = array();
	$z_etiqueta_html = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_etiqueta_html"]) : @$_GET["z_etiqueta_html"];
	$arrFldOpr = explode(",",$z_etiqueta_html);
	if ($x_etiqueta_html <> "") {
		$sSrchAdvanced .= "etiqueta_html "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_etiqueta_html) : $x_etiqueta_html; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field valor
	$x_valor = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_valor"]) : @$_GET["x_valor"];
	$arrFldOpr = array();
	$z_valor = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_valor"]) : @$_GET["z_valor"];
	$arrFldOpr = explode(",",$z_valor);
	if ($x_valor <> "") {
		$sSrchAdvanced .= "valor "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_valor) : $x_valor; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field predeterminado
	$x_predeterminado = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_predeterminado"]) : @$_GET["x_predeterminado"];
	$arrFldOpr = array();
	$z_predeterminado = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_predeterminado"]) : @$_GET["z_predeterminado"];
	$arrFldOpr = explode(",",$z_predeterminado);
	if ($x_predeterminado <> "") {
		$sSrchAdvanced .= "predeterminado "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_predeterminado) : $x_predeterminado; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field ayuda
	$x_ayuda = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_ayuda"]) : @$_GET["x_ayuda"];
	$arrFldOpr = array();
	$z_ayuda = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_ayuda"]) : @$_GET["z_ayuda"];
	$arrFldOpr = explode(",",$z_ayuda);
	if ($x_ayuda <> "") {
		$sSrchAdvanced .= "ayuda "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_ayuda) : $x_ayuda; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}
	if (strlen($sSrchAdvanced) > 4) {
		$sSrchAdvanced = substr($sSrchAdvanced, 0, strlen($sSrchAdvanced)-4);
	}
}

//-------------------------------------------------------------------------------
// Function BasicSearchSQL
// - Build WHERE clause for a keyword

function BasicSearchSQL($Keyword)
{
	$sKeyword = (!get_magic_quotes_gpc()) ? addslashes($Keyword) : $Keyword;
	$BasicSearchSQL = "";
	if (is_numeric($sKeyword)) { $BasicSearchSQL .= "formato_idformato = " . $sKeyword . " OR " ; }
	$BasicSearchSQL.= "nombre LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "etiqueta LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "tipo_dato LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "longitud LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "acciones LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "etiqueta_html LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "valor LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "predeterminado LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "ayuda LIKE '%" . $sKeyword . "%' OR ";
	if (substr($BasicSearchSQL, -4) == " OR ") { $BasicSearchSQL = substr($BasicSearchSQL, 0, strlen($BasicSearchSQL)-4); }
	return $BasicSearchSQL;
}

//-------------------------------------------------------------------------------
// Function SetUpBasicSearch
// - Set up Basic Search parameter based on form elements pSearch & pSearchType
// - Variables setup: sSrchBasic

function SetUpBasicSearch()
{
	global $sSrchBasic;
	$sSearch = (!get_magic_quotes_gpc()) ? addslashes(@$_GET["psearch"]) : @$_GET["psearch"];
	$sSearchType = @$_GET["psearchtype"];
	if ($sSearch <> "") {
		if ($sSearchType <> "") {
			while (strpos($sSearch, "  ") != false) {
				$sSearch = str_replace("  ", " ",$sSearch);
			}
			$arKeyword = explode(" ", trim($sSearch));
			foreach ($arKeyword as $sKeyword)
			{
				$sSrchBasic .= "(" . BasicSearchSQL($sKeyword) . ") " . $sSearchType . " ";
			}
		}
		else
		{
			$sSrchBasic = BasicSearchSQL($sSearch);
		}
	}
	if (substr($sSrchBasic, -4) == " OR ") { $sSrchBasic = substr($sSrchBasic, 0, strlen($sSrchBasic)-4); }
	if (substr($sSrchBasic, -5) == " AND ") { $sSrchBasic = substr($sSrchBasic, 0, strlen($sSrchBasic)-5); }
}

//-------------------------------------------------------------------------------
// Function SetUpSortOrder
// - Set up Sort parameters based on Sort Links clicked
// - Variables setup: sOrderBy, Session("Table_OrderBy"), Session("Table_Field_Sort")

function SetUpSortOrder()
{ global $x_formato_idformato;
	global $sOrderBy;
	global $sDefaultOrderBy;
 
	// Check for Ctrl pressed
	if (strlen(@$_GET["ctrl"]) > 0) {
		$bCtrl = true;
	}
	else
	{
		$bCtrl = false;
	}

	// Check for an Order parameter
	if (strlen(@$_GET["order"]) > 0) {
		$sOrder = @$_GET["order"];

		// Field idcampos_formato
		if ($sOrder == "idcampos_formato") {
			$sSortField = "idcampos_formato";
			$sLastSort = @$_SESSION["campos_formato_x_idcampos_formato_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else { $sThisSort = "ASC"; }
			$_SESSION["campos_formato_x_idcampos_formato_Sort"] = $sThisSort;
		}
		else
		{
			if (!($bCtrl) && @$_SESSION["campos_formato_x_idcampos_formato_Sort"] <> "") { $_SESSION["campos_formato_x_idcampos_formato_Sort"] = "" ; }
		}

		// Field formato_idformato
		if ($sOrder == "formato_idformato") {
			$sSortField = "formato_idformato";
			$sLastSort = @$_SESSION["campos_formato_x_formato_idformato_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else { $sThisSort = "ASC"; }
			$_SESSION["campos_formato_x_formato_idformato_Sort"] = $sThisSort;
		}
		else
		{
			if (!($bCtrl) && @$_SESSION["campos_formato_x_formato_idformato_Sort"] <> "") { $_SESSION["campos_formato_x_formato_idformato_Sort"] = "" ; }
		}

		// Field nombre
		if ($sOrder == "nombre") {
			$sSortField = "nombre";
			$sLastSort = @$_SESSION["campos_formato_x_nombre_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else { $sThisSort = "ASC"; }
			$_SESSION["campos_formato_x_nombre_Sort"] = $sThisSort;
		}
		else
		{
			if (!($bCtrl) && @$_SESSION["campos_formato_x_nombre_Sort"] <> "") { $_SESSION["campos_formato_x_nombre_Sort"] = "" ; }
		}

		// Field etiqueta
		if ($sOrder == "etiqueta") {
			$sSortField = "etiqueta";
			$sLastSort = @$_SESSION["campos_formato_x_etiqueta_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else { $sThisSort = "ASC"; }
			$_SESSION["campos_formato_x_etiqueta_Sort"] = $sThisSort;
		}
		else
		{
			if (!($bCtrl) && @$_SESSION["campos_formato_x_etiqueta_Sort"] <> "") { $_SESSION["campos_formato_x_etiqueta_Sort"] = "" ; }
		}

		// Field tipo_dato
		if ($sOrder == "tipo_dato") {
			$sSortField = "tipo_dato";
			$sLastSort = @$_SESSION["campos_formato_x_tipo_dato_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else { $sThisSort = "ASC"; }
			$_SESSION["campos_formato_x_tipo_dato_Sort"] = $sThisSort;
		}
		else
		{
			if (!($bCtrl) && @$_SESSION["campos_formato_x_tipo_dato_Sort"] <> "") { $_SESSION["campos_formato_x_tipo_dato_Sort"] = "" ; }
		}

		// Field longitud
		if ($sOrder == "longitud") {
			$sSortField = "longitud";
			$sLastSort = @$_SESSION["campos_formato_x_longitud_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else { $sThisSort = "ASC"; }
			$_SESSION["campos_formato_x_longitud_Sort"] = $sThisSort;
		}
		else
		{
			if (!($bCtrl) && @$_SESSION["campos_formato_x_longitud_Sort"] <> "") { $_SESSION["campos_formato_x_longitud_Sort"] = "" ; }
		}

		// Field obligatoriedad
		if ($sOrder == "obligatoriedad") {
			$sSortField = "obligatoriedad";
			$sLastSort = @$_SESSION["campos_formato_x_obligatoriedad_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else { $sThisSort = "ASC"; }
			$_SESSION["campos_formato_x_obligatoriedad_Sort"] = $sThisSort;
		}
		else
		{
			if (!($bCtrl) && @$_SESSION["campos_formato_x_obligatoriedad_Sort"] <> "") { $_SESSION["campos_formato_x_obligatoriedad_Sort"] = "" ; }
		}

		// Field acciones
		if ($sOrder == "acciones") {
			$sSortField = "acciones";
			$sLastSort = @$_SESSION["campos_formato_x_acciones_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else { $sThisSort = "ASC"; }
			$_SESSION["campos_formato_x_acciones_Sort"] = $sThisSort;
		}
		else
		{
			if (!($bCtrl) && @$_SESSION["campos_formato_x_acciones_Sort"] <> "") { $_SESSION["campos_formato_x_acciones_Sort"] = "" ; }
		}

		// Field etiqueta_html
		if ($sOrder == "etiqueta_html") {
			$sSortField = "etiqueta_html";
			$sLastSort = @$_SESSION["campos_formato_x_etiqueta_html_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else { $sThisSort = "ASC"; }
			$_SESSION["campos_formato_x_etiqueta_html_Sort"] = $sThisSort;
		}
		else
		{
			if (!($bCtrl) && @$_SESSION["campos_formato_x_etiqueta_html_Sort"] <> "") { $_SESSION["campos_formato_x_etiqueta_html_Sort"] = "" ; }
		}

		// Field predeterminado
		if ($sOrder == "predeterminado") {
			$sSortField = "predeterminado";
			$sLastSort = @$_SESSION["campos_formato_x_predeterminado_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else { $sThisSort = "ASC"; }
			$_SESSION["campos_formato_x_predeterminado_Sort"] = $sThisSort;
		}
		else
		{
			if (!($bCtrl) && @$_SESSION["campos_formato_x_predeterminado_Sort"] <> "") { $_SESSION["campos_formato_x_predeterminado_Sort"] = "" ; }
		}
		if ($bCtrl) {
			$sOrderBy = @$_SESSION["campos_formato_OrderBy"];
			$pos = strpos($sOrderBy, $sSortField . " " . $sLastSort);
			if ($pos === false) {
				if ($sOrderBy <> "") { $sOrderBy .= ", "; }
				$sOrderBy .= $sSortField . " " . $sThisSort;
			}else{
				$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
			}
			$_SESSION["campos_formato_OrderBy"] = $sOrderBy;
		}
		else
		{
			$_SESSION["campos_formato_OrderBy"] = $sSortField . " " . $sThisSort;
		}
		$_SESSION["campos_formato_REC"] = 1;
	}
	$sOrderBy = @$_SESSION["campos_formato_OrderBy"];
	if ($sOrderBy == "") {
		$sOrderBy = $sDefaultOrderBy;
		$_SESSION["campos_formato_OrderBy"] = $sOrderBy;
	}
}

//-------------------------------------------------------------------------------
// Function SetUpStartRec
//- Set up Starting Record parameters based on Pager Navigation
// - Variables setup: nStartRec

function SetUpStartRec()
{

	// Check for a START parameter
	global $nStartRec;
	global $nDisplayRecs;
	global $nTotalRecs;
	if (strlen(@$_GET["start"]) > 0) {
		$nStartRec = @$_GET["start"];
		$_SESSION["campos_formato_REC"] = $nStartRec;
	}
	elseif (strlen(@$_GET["pageno"]) > 0) {
		$nPageNo = @$_GET["pageno"];
		if (is_numeric($nPageNo)) {
			$nStartRec = ($nPageNo-1)*$nDisplayRecs+1;
			if ($nStartRec <= 0) {
				$nStartRec = 1;
			}
			elseif ($nStartRec >= (($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1) {
				$nStartRec = (($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1;
			}
			$_SESSION["campos_formato_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["campos_formato_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["campos_formato_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["campos_formato_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["campos_formato_REC"] = $nStartRec;
		}
	}
}

//-------------------------------------------------------------------------------
// Function ResetCmd
// - Clear list page parameters
// - RESET: reset search parameters
// - RESETALL: reset search & master/detail parameters
// - RESETSORT: reset sort parameters

function ResetCmd()
{

	// Get Reset Cmd
	if (strlen(@$_GET["cmd"]) > 0) {
		$sCmd = @$_GET["cmd"];

		// Reset Search Criteria
		if (strtoupper($sCmd) == "RESET") {
			$sSrchWhere = "";
			$_SESSION["campos_formato_searchwhere"] = $sSrchWhere;

		// Reset Search Criteria & Session Keys
		}
		elseif (strtoupper($sCmd) == "RESETALL") {
			$sSrchWhere = "";
			$_SESSION["campos_formato_searchwhere"] = $sSrchWhere;

		// Reset Sort Criteria
		}
		elseif (strtoupper($sCmd) == "RESETSORT") {
			$sOrderBy = "";
			$_SESSION["campos_formato_OrderBy"] = $sOrderBy;
			if (@$_SESSION["campos_formato_x_idcampos_formato_Sort"] <> "") { $_SESSION["campos_formato_x_idcampos_formato_Sort"] = ""; }
			if (@$_SESSION["campos_formato_x_formato_idformato_Sort"] <> "") { $_SESSION["campos_formato_x_formato_idformato_Sort"] = ""; }
			if (@$_SESSION["campos_formato_x_nombre_Sort"] <> "") { $_SESSION["campos_formato_x_nombre_Sort"] = ""; }
			if (@$_SESSION["campos_formato_x_etiqueta_Sort"] <> "") { $_SESSION["campos_formato_x_etiqueta_Sort"] = ""; }
			if (@$_SESSION["campos_formato_x_tipo_dato_Sort"] <> "") { $_SESSION["campos_formato_x_tipo_dato_Sort"] = ""; }
			if (@$_SESSION["campos_formato_x_longitud_Sort"] <> "") { $_SESSION["campos_formato_x_longitud_Sort"] = ""; }
			if (@$_SESSION["campos_formato_x_obligatoriedad_Sort"] <> "") { $_SESSION["campos_formato_x_obligatoriedad_Sort"] = ""; }
			if (@$_SESSION["campos_formato_x_acciones_Sort"] <> "") { $_SESSION["campos_formato_x_acciones_Sort"] = ""; }
			if (@$_SESSION["campos_formato_x_etiqueta_html_Sort"] <> "") { $_SESSION["campos_formato_x_etiqueta_html_Sort"] = ""; }
			if (@$_SESSION["campos_formato_x_predeterminado_Sort"] <> "") { $_SESSION["campos_formato_x_predeterminado_Sort"] = ""; }
		}

		// Reset Start Position (Reset Command)
		$nStartRec = 1;
		$_SESSION["campos_formato_REC"] = $nStartRec;
	}
}
?>
