<?php session_start(); ?>
<?php ob_start(); ?>
<?php

// Initialize common variables
$x_idfuncion_formato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_descripcion = Null;
$x_ruta = Null;
$x_formato = Null;
$x_acciones = Null;
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
$nDisplayRecs = 0;
$nRecRange = 10;
$idformato=0;

// Open connection to the database


// Handle Reset Command
//ResetCmd();

// Get Search Criteria for Advanced Search
//SetUpAdvancedSearch();

// Get Search Criteria for Basic Search
//SetUpBasicSearch();

// Build Search Criteria
if ($sSrchAdvanced != "") {
	$sSrchWhere = $sSrchAdvanced; // Advanced Search
}
elseif ($sSrchBasic != "") {
	$sSrchWhere = $sSrchBasic; // Basic Search
}

// Save Search Criteria
if ($sSrchWhere != "") {
	$_SESSION["funciones_formato_searchwhere"] = $sSrchWhere;

	// Reset start record counter (new search)
	$nStartRec = 1;
	$_SESSION["funciones_formato_REC"] = $nStartRec;
}
else
{
	$sSrchWhere = @$_SESSION["funciones_formato_searchwhere"];
}

// Build WHERE condition
$sDbWhere = "";
$xformato2=0;
if(@$_REQUEST["idformato"]){
  $x_formato2=$_REQUEST["idformato"];
  $idformato=$_REQUEST["idformato"];
  $formato=busca_filtro_tabla("*","formato A","A.idformato=".$x_formato2,"",$conn);
  $sDbWhere ="B.formato_idformato=".$idformato." AND " ;
}
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
$sSql = "SELECT distinct A.* FROM funciones_formato A, funciones_formato_enlace B";

// Load Default Filter
$sDefaultFilter = "A.idfunciones_formato=B.funciones_formato_fk";
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
//SetUpSortOrder();
if ($sOrderBy != "") {
	$sSql .= " ORDER BY " . $sOrderBy;
}
//echo $sSql;
?>
<?php include ("header.php") ?>
<script type="text/javascript" src="../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
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
//SetUpStartRec(); // Set Up Start Record Position
?>
<p><span class="phpmaker">FUNCIONES FORMATO <?php if($formato["numcampos"]) echo("<b>".$formato[0]["etiqueta"]."</b>");?> 
</span></p>
<!--form action="funciones_formatolist.php">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="psearch" size="20">
			<input type="Submit" name="Submit" value="Search &nbsp;(*)">&nbsp;&nbsp;
			<a href="funciones_formatolist.php?cmd=reset">Show all</a>&nbsp;&nbsp;
			<a href="funciones_formatosrch.php">Advanced Search</a>
		</span></td>
	</tr>
	<tr><td><span class="phpmaker"><input type="radio" name="psearchtype" value="" checked>Exact phrase&nbsp;&nbsp;<input type="radio" name="psearchtype" value="AND">All words&nbsp;&nbsp;<input type="radio" name="psearchtype" value="OR">Any word</span></td></tr>
</table>
</form-->
<!--table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><span class="phpmaker"><a href="funciones_formatoadd.php">Add</a></span></td>
	</tr>
</table-->
<p>
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
	<tr  class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	   Nombre
		</span></td>
  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	   Etiqueta
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	   Descripci&oacute;n
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	   Acciones
		</span></td>		
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
		$sKey = $row["idfunciones_formato"];
		$x_idfuncion_formato = $row["idfunciones_formato"];
		$x_nombre = $row["nombre"];
		$x_etiqueta = $row["etiqueta"];
		$x_descripcion = $row["descripcion"];
		$x_ruta = $row["ruta"];
		$x_formato = $row["formato"];
		$x_acciones = $row["acciones"];
?>
	<!-- Table body -->
	<tr<?php echo $sItemRowClass; ?>>
		<!-- idfuncion_formato -->
		<td><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_etiqueta; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo delimita($x_descripcion,100); ?>
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
		case "m":
			$sTmp .= "Mostrar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "e":
			$sTmp .= "Editar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "b":
			$sTmp .= "Busqueda";
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
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "funciones_formatoview.php?idformato=".$x_formato2."&key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');";  } ?>">Ver</a></span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "funciones_formatoedit.php?idformato=".$x_formato2."&key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; } ?>">Editar</a></span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "funciones_formatodelete.php?idformato=".$x_formato2."&key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; }  ?>">Borrar</a></span></td>
	</tr>
<?php
	}
}
?>
</table>
</form>
<?php
echo '<a href="formatoedit.php?key='.$x_formato2.'">Editar formato</a>&nbsp;&nbsp;&nbsp';
echo('<a href="formatoadd_paso2.php?key='.$x_formato2.'">Editar Cuerpo </a>&nbsp;&nbsp;&nbsp;');
echo('<a href="campos_formatolist.php?idformato='.$x_formato2.'">Tabla Formato</a>&nbsp;&nbsp;&nbsp;');
echo('<a href="'.$ruta_db_superior.'formatos/llamado_formatos.php?acciones_formato=formato,adicionar,buscar,editar,mostrar,tabla&accion=generar&condicion=idformato@'.$x_formato2.'">Generar el Formato</a>&nbsp;&nbsp;&nbsp;&nbsp;<br>');
?>
<a href="asignar_funciones.php?idformato=<?php echo($x_formato2);?>" class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 550, height:400,preserveContent:false } )" style="text-decoration: underline; cursor:pointer;">Asignar Funciones al formato</a>&nbsp;&nbsp;
<a href="funciones_formato_ordenar.php?idformato=<?php echo($x_formato2);?>" class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 550, height:400,preserveContent:false } )" style="text-decoration: underline; cursor:pointer;">Ordenar Funciones del formato</a>
<br>
<?php
//echo('<a href="'.$formato[0]["nombre"]."/".$formato[0]["ruta_mostrar"].'">Mostrar '.$formato[0]["etiqueta"].'</a>&nbsp;&nbsp;&nbsp;');
echo('<a href="'.$formato[0]["nombre"]."/".$formato[0]["ruta_adicionar"].'">Adicionar '.$formato[0]["etiqueta"].'</a>&nbsp;&nbsp;&nbsp;');
echo('<a href="'.$formato[0]["nombre"]."/".$formato[0]["ruta_editar"].'">Editar '.$formato[0]["etiqueta"].'</a>');

// Close recordset and connection
phpmkr_free_result($rs);
//phpmkr_db_close($conn);
?>
<!--form action="funciones_formatolist.php" name="ewpagerform" id="ewpagerform">
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
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="funciones_formatolist.php?start=1"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } ?>
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="funciones_formatolist.php?start=<?php echo $PrevStart; ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } ?>
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="funciones_formatolist.php?start=<?php echo $NextStart; ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>
	<?php  } ?>
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="funciones_formatolist.php?start=<?php echo $LastStart; ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>
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

function SetUpAdvancedSearch()
{
	global $sSrchAdvanced;

	// Field idfuncion_formato
	$x_idfuncion_formato = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_idfuncion_formato"]) : @$_GET["x_idfuncion_formato"];
	$arrFldOpr = "";
	$z_idfuncion_formato = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_idfuncion_formato"]) : @$_GET["z_idfuncion_formato"];
	$arrFldOpr = split(",",$z_idfuncion_formato);
	if ($x_idfuncion_formato <> "") {
		$sSrchAdvanced .= "idfunciones_formato "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_idfuncion_formato) : $x_idfuncion_formato; // Add input parameter
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

	// Field descripcion
	$x_descripcion = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_descripcion"]) : @$_GET["x_descripcion"];
	$arrFldOpr = "";
	$z_descripcion = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_descripcion"]) : @$_GET["z_descripcion"];
	$arrFldOpr = split(",",$z_descripcion);
	if ($x_descripcion <> "") {
		$sSrchAdvanced .= "descripcion "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_descripcion) : $x_descripcion; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field ruta
	$x_ruta = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_ruta"]) : @$_GET["x_ruta"];
	$arrFldOpr = "";
	$z_ruta = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_ruta"]) : @$_GET["z_ruta"];
	$arrFldOpr = split(",",$z_ruta);
	if ($x_ruta <> "") {
		$sSrchAdvanced .= "ruta "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_ruta) : $x_ruta; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field formato
	$x_formato = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_formato"]) : @$_GET["x_formato"];
	$arrFldOpr = "";
	$z_formato = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_formato"]) : @$_GET["z_formato"];
	$arrFldOpr = split(",",$z_formato);
	if ($x_formato <> "") {
		$sSrchAdvanced .= "formato "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_formato) : $x_formato; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field acciones
	$x_acciones = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_acciones"]) : @$_GET["x_acciones"];
	$arrFldOpr = "";
	$z_acciones = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_acciones"]) : @$_GET["z_acciones"];
	$arrFldOpr = split(",",$z_acciones);
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
	$BasicSearchSQL.= "descripcion LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "ruta LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "formato LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "acciones LIKE '%" . $sKeyword . "%' OR ";
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

		// Field idfuncion_formato
		if ($sOrder == "idfunciones_formato") {
			$sSortField = "idfunciones_formato";
			$sLastSort = @$_SESSION["funciones_formato_x_idfuncion_formato_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["funciones_formato_x_idfuncion_formato_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["funciones_formato_x_idfuncion_formato_Sort"] <> "") { @$_SESSION["funciones_formato_x_idfuncion_formato_Sort"] = ""; }
		}

		// Field acciones
		if ($sOrder == "acciones") {
			$sSortField = "acciones";
			$sLastSort = @$_SESSION["funciones_formato_x_acciones_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["funciones_formato_x_acciones_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["funciones_formato_x_acciones_Sort"] <> "") { @$_SESSION["funciones_formato_x_acciones_Sort"] = ""; }
		}
		$_SESSION["funciones_formato_OrderBy"] = $sSortField . " " . $sThisSort;
		$_SESSION["funciones_formato_REC"] = 1;
	}
	$sOrderBy = @$_SESSION["funciones_formato_OrderBy"];
	if ($sOrderBy == "") {
		$sOrderBy = $sDefaultOrderBy;
		$_SESSION["funciones_formato_OrderBy"] = $sOrderBy;
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
		$_SESSION["funciones_formato_REC"] = $nStartRec;
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
			$_SESSION["funciones_formato_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["funciones_formato_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["funciones_formato_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["funciones_formato_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["funciones_formato_REC"] = $nStartRec;
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
			$_SESSION["funciones_formato_searchwhere"] = $sSrchWhere;

		// Reset Search Criteria & Session Keys
		}
		elseif (strtoupper($sCmd) == "RESETALL") {
			$sSrchWhere = "";
			$_SESSION["funciones_formato_searchwhere"] = $sSrchWhere;

		// Reset Sort Criteria
		}
		elseif (strtoupper($sCmd) == "RESETSORT") {
			$sOrderBy = "";
			$_SESSION["funciones_formato_OrderBy"] = $sOrderBy;
			if (@$_SESSION["funciones_formato_x_idfuncion_formato_Sort"] <> "") { $_SESSION["funciones_formato_x_idfuncion_formato_Sort"] = ""; }
			if (@$_SESSION["funciones_formato_x_acciones_Sort"] <> "") { $_SESSION["funciones_formato_x_acciones_Sort"] = ""; }
		}

		// Reset Start Position (Reset Command)
		$nStartRec = 1;
		$_SESSION["funciones_formato_REC"] = $nStartRec;
	}
}
?>
