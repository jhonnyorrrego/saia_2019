<?php session_start(); ?>
<?php ob_start(); ?>
<?php


// Initialize common variables
$x_idvista_formato = Null;
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
<?php include ("db.php") ?>
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
$nDisplayRecs = 40;
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
	$_SESSION["vista_searchwhere"] = $sSrchWhere;

	// Reset start record counter (new search)
	$nStartRec = 1;
	$_SESSION["vista_REC"] = $nStartRec;
}
else
{
	$sSrchWhere = @$_SESSION["vista_searchwhere"];
}

// Build WHERE condition
$sDbWhere = "";
if ($sDbWhereMaster != "") {
	$sDbWhere .= "(" . $sDbWhereMaster . ") AND ";
}
if ($sSrchWhere != "") {
	$sDbWhere .= "(" . $sSrchWhere . ") AND ";
}
if (strlen($sDbWhere) > 5) {
	$sDbWhere = substr($sDbWhere, 0, strlen($sDbWhere)-5); // Trim rightmost AND
}

// Build SQL
$sSql = "SELECT * FROM vista_formato";

// Load Default Filter
$sDefaultFilter = "";
if($_REQUEST["key"]){
  $sDefaultFilter = "formato_padre=".$_REQUEST["key"];
}
$sGroupBy = "";
$sHaving = "";

// Load Default Order
$sDefaultOrderBy = "";
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
<p><span class="phpmaker"><img class="imagen_internos" src="../botones/configuracion/crear_documentos.png" border="0">Listado de Vistas Formatos
</span></p>
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><span class="phpmaker"><a href="formatoadd.php">Adicionar</a>&nbsp;&nbsp;&nbsp;</span></td>
		<td><span class="phpmaker"><a href="vista_formatolist.php">Listar Formatos</a>&nbsp;&nbsp;&nbsp;</span></td>
		<td><span class="phpmaker"><a href="vista_formatoadd.php<?php if(@$_REQUEST["key"]) echo("?formato_padre=".$_REQUEST["key"]); ?>">Adicionar Vistas</a></span></td>
	</tr>
</table>
<?php
if (@$_SESSION["ewmsg"] <> "") {
?>
<p><span class="phpmaker" style="color: Red;"><?php echo $_SESSION["ewmsg"]; ?></span></p>
<?php
	$_SESSION["ewmsg"] = ""; // Clear message
}
?>
<form method="post">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
<?php if ($nTotalRecs > 0) { ?>
	<!-- Table header -->
	<tr class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="vista_formatolist.php?order=<?php echo urlencode("idvista_formato"); ?>" style="color: #FFFFFF;">idvista_formato<?php if (@$_SESSION["vista_formato_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["vista_formato_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="vista_formatolist.php?order=<?php echo urlencode("nombre"); ?>" style="color: #FFFFFF;">Nombre&nbsp;(*)<?php if (@$_SESSION["vista_x_nombre_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["vista_x_nombre_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="vista_formatolist.php?order=<?php echo urlencode("etiqueta"); ?>" style="color: #FFFFFF;">Etiqueta&nbsp;(*)<?php if (@$_SESSION["vista_x_etiqueta_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["vista_x_etiqueta_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="vista_formatolist.php?order=<?php echo urlencode("margenes"); ?>" style="color: #FFFFFF;">M&aacute;rgenes(Izq, Der, Sup, Inf)&nbsp;(*)<?php if (@$_SESSION["vista_x_margenes_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["vista_x_margenes_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="vista_formatolist.php?order=<?php echo urlencode("orientacion"); ?>" style="color: #FFFFFF;">Orientaci&oacute;n&nbsp;(*)<?php if (@$_SESSION["vista_x_orientacion_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["vista_x_orientacion_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="vista_formatolist.php?order=<?php echo urlencode("papel"); ?>" style="color: #FFFFFF;">Tama&ntilde;o del Papel&nbsp;(*)<?php if (@$_SESSION["vista_x_papel_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["vista_x_papel_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="vista_formatolist.php?order=<?php echo urlencode("exportar"); ?>" style="color: #FFFFFF;">M&eacute;todo Exportar&nbsp;(*)<?php if (@$_SESSION["vista_x_exportar_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["vista_x_exportar_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
<td>&nbsp;</td>
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
		$sKey = $row["idvista_formato"];
		$x_idvista_formato = $row["idvista_formato"];
		$x_nombre = $row["nombre"];
		$x_etiqueta = $row["etiqueta"];
		$x_librerias = $row["librerias"];
		$x_encabezado = $row["encabezado"];
		$x_cuerpo = $row["cuerpo"];
		$x_pie_pagina = $row["pie_pagina"];
		$x_margenes = $row["margenes"];
		$x_orientacion = $row["orientacion"];
		$x_papel = $row["papel"];
		$x_exportar = $row["exportar"];
?>
	<!-- Table body -->
	<tr<?php echo $sItemRowClass; ?>>
		<!-- idvista_formato -->
		<td><span class="phpmaker">
<?php echo $x_idvista_formato; ?>
</span></td>
		<!-- nombre -->
		<td><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
		<!-- etiqueta -->
		<td><span class="phpmaker">
<?php echo $x_etiqueta; ?>
</span></td>
		<!-- margenes -->
		<td><span class="phpmaker">
<?php echo $x_margenes; ?>
</span></td>
		<!-- orientacion -->
		<td><span class="phpmaker">
<?php echo $x_orientacion; ?>
</span></td>
		<!-- papel -->
		<td><span class="phpmaker">
<?php echo $x_papel; ?>
</span></td>
		<!-- exportar -->
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
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "vista_formatoedit.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; } ?>">Editar</a></span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "vista_formatoadd.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; } ?>">Copiar</a></span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "vista_formatodelete.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; }  ?>">Borrar</a></span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "generar_formato.php?genera=vista&idformato=".urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; }  ?>">Generar</a></span></td>
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
////phpmkr_db_close($conn);
?>
<form action="vista_formatolist.php" name="ewpagerform" id="ewpagerform">
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
<!--first page button-->
	<?php if ($nStartRec == 1) { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="vista_formatolist.php?start=1"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="vista_formatolist.php?start=<?php echo $PrevStart; ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="vista_formatolist.php?start=<?php echo $NextStart; ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="vista_formatolist.php?start=<?php echo $LastStart; ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>
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
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function SetUpAdvancedSearch
// - Set up Advanced Search parameter based on querystring parameters from Advanced Search Page
// - Variables setup: sSrchAdvanced

function SetUpAdvancedSearch()
{
	global $sSrchAdvanced;

	// Field idvista_formato
	$x_idvista_formato = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_idvista_formato"]) : @$_GET["x_idvista_formato"];
	$arrFldOpr = "";
	$z_idvista_formato = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_idvista_formato"]) : @$_GET["z_idvista_formato"];
	$arrFldOpr = split(",",$z_idvista_formato);
	if ($x_idvista_formato <> "") {
		$sSrchAdvanced .= "idvista_formato "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_idvista_formato) : $x_idvista_formato; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field nombre
	$x_nombre = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_nombre"]) : @$_GET["x_nombre"];
	$arrFldOpr = "";
	$z_nombre = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_nombre"]) : @$_GET["z_nombre"];
	$arrFldOpr = split(",",$z_nombre);
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
	$arrFldOpr = "";
	$z_etiqueta = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_etiqueta"]) : @$_GET["z_etiqueta"];
	$arrFldOpr = split(",",$z_etiqueta);
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

	// Field contador_idcontador
	$x_contador_idcontador = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_contador_idcontador"]) : @$_GET["x_contador_idcontador"];
	$arrFldOpr = "";
	$z_contador_idcontador = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_contador_idcontador"]) : @$_GET["z_contador_idcontador"];
	$arrFldOpr = split(",",$z_contador_idcontador);
	if ($x_contador_idcontador <> "") {
		$sSrchAdvanced .= "contador_idcontador "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_contador_idcontador) : $x_contador_idcontador; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field ruta_mostrar
	$x_ruta_mostrar = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_ruta_mostrar"]) : @$_GET["x_ruta_mostrar"];
	$arrFldOpr = "";
	$z_ruta_mostrar = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_ruta_mostrar"]) : @$_GET["z_ruta_mostrar"];
	$arrFldOpr = split(",",$z_ruta_mostrar);
	if ($x_ruta_mostrar <> "") {
		$sSrchAdvanced .= "ruta_mostrar "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_ruta_mostrar) : $x_ruta_mostrar; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field ruta_editar
	$x_ruta_editar = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_ruta_editar"]) : @$_GET["x_ruta_editar"];
	$arrFldOpr = "";
	$z_ruta_editar = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_ruta_editar"]) : @$_GET["z_ruta_editar"];
	$arrFldOpr = split(",",$z_ruta_editar);
	if ($x_ruta_editar <> "") {
		$sSrchAdvanced .= "ruta_editar "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_ruta_editar) : $x_ruta_editar; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field ruta_adicionar
	$x_ruta_adicionar = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_ruta_adicionar"]) : @$_GET["x_ruta_adicionar"];
	$arrFldOpr = "";
	$z_ruta_adicionar = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_ruta_adicionar"]) : @$_GET["z_ruta_adicionar"];
	$arrFldOpr = split(",",$z_ruta_adicionar);
	if ($x_ruta_adicionar <> "") {
		$sSrchAdvanced .= "ruta_adicionar "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_ruta_adicionar) : $x_ruta_adicionar; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field librerias
	$x_librerias = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_librerias"]) : @$_GET["x_librerias"];
	$arrFldOpr = "";
	$z_librerias = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_librerias"]) : @$_GET["z_librerias"];
	$arrFldOpr = split(",",$z_librerias);
	if ($x_librerias <> "") {
		$sSrchAdvanced .= "librerias "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_librerias) : $x_librerias; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field encabezado
	$x_encabezado = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_encabezado"]) : @$_GET["x_encabezado"];
	$arrFldOpr = "";
	$z_encabezado = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_encabezado"]) : @$_GET["z_encabezado"];
	$arrFldOpr = split(",",$z_encabezado);
	if ($x_encabezado <> "") {
		$sSrchAdvanced .= "encabezado "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_encabezado) : $x_encabezado; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field cuerpo
	$x_cuerpo = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_cuerpo"]) : @$_GET["x_cuerpo"];
	$arrFldOpr = "";
	$z_cuerpo = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_cuerpo"]) : @$_GET["z_cuerpo"];
	$arrFldOpr = split(",",$z_cuerpo);
	if ($x_cuerpo <> "") {
		$sSrchAdvanced .= "cuerpo "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_cuerpo) : $x_cuerpo; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field pie_pagina
	$x_pie_pagina = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_pie_pagina"]) : @$_GET["x_pie_pagina"];
	$arrFldOpr = "";
	$z_pie_pagina = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_pie_pagina"]) : @$_GET["z_pie_pagina"];
	$arrFldOpr = split(",",$z_pie_pagina);
	if ($x_pie_pagina <> "") {
		$sSrchAdvanced .= "pie_pagina "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_pie_pagina) : $x_pie_pagina; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field margenes
	$x_margenes = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_margenes"]) : @$_GET["x_margenes"];
	$arrFldOpr = "";
	$z_margenes = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_margenes"]) : @$_GET["z_margenes"];
	$arrFldOpr = split(",",$z_margenes);
	if ($x_margenes <> "") {
		$sSrchAdvanced .= "margenes "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_margenes) : $x_margenes; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field orientacion
	$x_orientacion = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_orientacion"]) : @$_GET["x_orientacion"];
	$arrFldOpr = "";
	$z_orientacion = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_orientacion"]) : @$_GET["z_orientacion"];
	$arrFldOpr = split(",",$z_orientacion);
	if ($x_orientacion <> "") {
		$sSrchAdvanced .= "orientacion "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_orientacion) : $x_orientacion; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field papel
	$x_papel = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_papel"]) : @$_GET["x_papel"];
	$arrFldOpr = "";
	$z_papel = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_papel"]) : @$_GET["z_papel"];
	$arrFldOpr = split(",",$z_papel);
	if ($x_papel <> "") {
		$sSrchAdvanced .= "papel "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_papel) : $x_papel; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field exportar
	$x_exportar = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_exportar"]) : @$_GET["x_exportar"];
	$arrFldOpr = "";
	$z_exportar = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_exportar"]) : @$_GET["z_exportar"];
	$arrFldOpr = split(",",$z_exportar);
	if ($x_exportar <> "") {
		$sSrchAdvanced .= "exportar "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_exportar) : $x_exportar; // Add input parameter
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
	$BasicSearchSQL.= "nombre LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "etiqueta LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "ruta_mostrar LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "ruta_editar LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "ruta_adicionar LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "librerias LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "encabezado LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "cuerpo LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "pie_pagina LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "margenes LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "orientacion LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "papel LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "exportar LIKE '%" . $sKeyword . "%' OR ";
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
			$arKeyword = split(" ", trim($sSearch));
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
{
	global $sOrderBy;
	global $sDefaultOrderBy;

	// Check for an Order parameter
	if (strlen(@$_GET["order"]) > 0) {
		$sOrder = @$_GET["order"];

		// Field idvista_formato
		if ($sOrder == "idvista_formato") {
			$sSortField = "idvista_formato";
			$sLastSort = @$_SESSION["vista_formato_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["vista_formato_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["vista_formato_Sort"] <> "") { @$_SESSION["vista_formato_Sort"] = ""; }
		}

		// Field nombre
		if ($sOrder == "nombre") {
			$sSortField = "nombre";
			$sLastSort = @$_SESSION["vista_x_nombre_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["vista_x_nombre_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["vista_x_nombre_Sort"] <> "") { @$_SESSION["vista_x_nombre_Sort"] = ""; }
		}

		// Field etiqueta
		if ($sOrder == "etiqueta") {
			$sSortField = "etiqueta";
			$sLastSort = @$_SESSION["vista_x_etiqueta_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["vista_x_etiqueta_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["vista_x_etiqueta_Sort"] <> "") { @$_SESSION["vista_x_etiqueta_Sort"] = ""; }
		}

		// Field contador_idcontador
		if ($sOrder == "contador_idcontador") {
			$sSortField = "contador_idcontador";
			$sLastSort = @$_SESSION["vista_x_contador_idcontador_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["vista_x_contador_idcontador_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["vista_x_contador_idcontador_Sort"] <> "") { @$_SESSION["vista_x_contador_idcontador_Sort"] = ""; }
		}

		// Field margenes
		if ($sOrder == "margenes") {
			$sSortField = "margenes";
			$sLastSort = @$_SESSION["vista_x_margenes_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["vista_x_margenes_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["vista_x_margenes_Sort"] <> "") { @$_SESSION["vista_x_margenes_Sort"] = ""; }
		}

		// Field orientacion
		if ($sOrder == "orientacion") {
			$sSortField = "orientacion";
			$sLastSort = @$_SESSION["vista_x_orientacion_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["vista_x_orientacion_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["vista_x_orientacion_Sort"] <> "") { @$_SESSION["vista_x_orientacion_Sort"] = ""; }
		}

		// Field papel
		if ($sOrder == "papel") {
			$sSortField = "papel";
			$sLastSort = @$_SESSION["vista_x_papel_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["vista_x_papel_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["vista_x_papel_Sort"] <> "") { @$_SESSION["vista_x_papel_Sort"] = ""; }
		}

		// Field exportar
		if ($sOrder == "exportar") {
			$sSortField = "exportar";
			$sLastSort = @$_SESSION["vista_x_exportar_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["vista_x_exportar_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["vista_x_exportar_Sort"] <> "") { @$_SESSION["vista_x_exportar_Sort"] = ""; }
		}
		$_SESSION["vista_OrderBy"] = $sSortField . " " . $sThisSort;
		$_SESSION["vista_REC"] = 1;
	}
	$sOrderBy = @$_SESSION["vista_OrderBy"];
	if ($sOrderBy == "") {
		$sOrderBy = $sDefaultOrderBy;
		$_SESSION["vista_OrderBy"] = $sOrderBy;
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
		$_SESSION["vista_REC"] = $nStartRec;
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
			$_SESSION["vista_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["vista_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["vista_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["vista_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["vista_REC"] = $nStartRec;
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
			$_SESSION["vista_searchwhere"] = $sSrchWhere;

		// Reset Search Criteria & Session Keys
		}
		elseif (strtoupper($sCmd) == "RESETALL") {
			$sSrchWhere = "";
			$_SESSION["vista_searchwhere"] = $sSrchWhere;

		// Reset Sort Criteria
		}
		elseif (strtoupper($sCmd) == "RESETSORT") {
			$sOrderBy = "";
			$_SESSION["vista_OrderBy"] = $sOrderBy;
			if (@$_SESSION["vista_formato_Sort"] <> "") { $_SESSION["vista_formato_Sort"] = ""; }
			if (@$_SESSION["vista_x_nombre_Sort"] <> "") { $_SESSION["vista_x_nombre_Sort"] = ""; }
			if (@$_SESSION["vista_x_etiqueta_Sort"] <> "") { $_SESSION["vista_x_etiqueta_Sort"] = ""; }
			if (@$_SESSION["vista_x_contador_idcontador_Sort"] <> "") { $_SESSION["vista_x_contador_idcontador_Sort"] = ""; }
			if (@$_SESSION["vista_x_margenes_Sort"] <> "") { $_SESSION["vista_x_margenes_Sort"] = ""; }
			if (@$_SESSION["vista_x_orientacion_Sort"] <> "") { $_SESSION["vista_x_orientacion_Sort"] = ""; }
			if (@$_SESSION["vista_x_papel_Sort"] <> "") { $_SESSION["vista_x_papel_Sort"] = ""; }
			if (@$_SESSION["vista_x_exportar_Sort"] <> "") { $_SESSION["vista_x_exportar_Sort"] = ""; }
		}

		// Reset Start Position (Reset Command)
		$nStartRec = 1;
		$_SESSION["vista_REC"] = $nStartRec;
	}
}
?>
