<?php session_start();?>
<?php ob_start();?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
<?php
$ewCurSec = 0; // Initialise


// Initialize common variables
$x_idtarea = Null;
$x_nombre = Null;

$sExport = @$_GET["export"]; // Load Export Request
if ($sExport == "html") {

	// Printer Friendly
}
if ($sExport == "excel") {
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=tarea.xls');
}
if ($sExport == "word") {
	header('Content-Type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename=tarea.doc');
}
if ($sExport == "xml") {
	header('Content-Type: text/xml');
	header('Content-Disposition: attachment; filename=tarea.xml');
}
if ($sExport == "csv") {
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename=tarea.csv');
}
?>
<?php include ("../db.php") ?>
<?php include ("../phpmkrfn.php") ?>
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
$nDisplayRecs = 20;
$nRecRange = 10;

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
	$_SESSION["tarea_searchwhere"] = $sSrchWhere;

	// Reset start record counter (new search)
	$nStartRec = 1;
	$_SESSION["tarea_REC"] = $nStartRec;
}
else
{
	$sSrchWhere = @$_SESSION["tarea_searchwhere"];
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
$sSql = "SELECT * FROM tarea";

// Load Default Filter
$sDefaultFilter = "";
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

// Export Data only
if (($sExport == "xml") || ($sExport == "csv")) {
	ExportData($sExport, $sSql);
	
	exit;
}

?>
<html>
<?php include ("../header.php") ?>
<?php if ($sExport == "") { ?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<?php } ?>
<?php

// Set up Record Set
$rs = phpmkr_query($sSql,$conn) or die("Error en la busqueda" . phpmkr_error() . ' SQL:' . $sSql);
$nTotalRecs = phpmkr_num_rows($rs);
if ($nDisplayRecs <= 0) { // Display All Records
	$nDisplayRecs = $nTotalRecs;
}
$nStartRec = 1;
SetUpStartRec(); // Set Up Start Record Position
?>
<body>
<p><span class="internos"><img class="imagen_internos" height="56"  src="../botones/general/asignar_tareas_generales.png" border="0">&nbsp;&nbsp;TAREAS
</span></p>
<?php if ($sExport == "") { ?>
<table border="0" cellspacing="10" cellpadding="0">
	<tr >
		<td><span class="phpmaker"><a href="tareaadd.php">Adicionar</a></span></td>
	</tr>
</table>
<p>
<?php } ?>
<?php
if (@$_SESSION["ewmsg"] <> "") {
?>
<p><span class="phpmaker" style="color: Red;"><?php echo $_SESSION["ewmsg"]; ?></span></p>
<?php
	$_SESSION["ewmsg"] = ""; // Clear message
}
?>
<form method="post">
<table id="myTable" border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">	<colgroup>
		<col id="col1_1"></col>
		<col id="col1_2"></col>	
    <col id="col1_3"></col>		
	</colgroup>
	<thead>	
<?php if ($nTotalRecs > 0) { ?>
	<!-- Table header -->
	<tr class="encabezado_list">	
		<!--td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
<?php if ($sExport <> "") { ?>
IDENTIFICACI&Oacute;N TAREA
<?php }else{ ?>
	<a href="tarealist.php?order=<?php echo urlencode("idtarea"); ?>" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N tarea<?php if (@$_SESSION["tarea_x_idtarea_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["tarea_x_idtarea_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</span></td--><td valign="top"><span class="phpmaker" style="color: #FFFFFF;">ID</td>
		<!--td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
<?php if ($sExport <> "") { ?>
NOMBRE
<?php }else{ ?>
	<a href="tarealist.php?order=<?php echo urlencode("nombre"); ?>" style="color: #FFFFFF;">NOMBRE&nbsp;(*)<?php if (@$_SESSION["tarea_x_nombre_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["tarea_x_nombre_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</span></td--><td valign="top"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE&nbsp;(*)</td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</td>
    <?php if ($sExport == "") { ?>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<?php } ?>
	</tr>	</thead>
	<tbody>
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
if (phpmkr_num_rows($rs) > 0) {
	//phpmkr_data_seek($rs, $nStartRec -1);
}
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
		$sKey = $row["idtarea"];
		$x_idtarea = $row["idtarea"];
		$x_nombre = $row["nombre"];
		$x_estado = $row["estado"];
?>
	<!-- Table body -->
	<tr<?php echo $sItemRowClass; ?>>		
		<!-- idtarea -->
		<td>
<?php echo $x_idtarea; ?>
</td>
		<!-- nombre -->
		<td><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
<td><span class="phpmaker">
<?php 
if($x_estado == 1)
  echo "ACTIVO";
else
  echo "INACTIVO";   ?>  
</span></td>
<?php if ($sExport == "") { ?>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "tareaview.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Registro no Valido ! LLave Nula');";  } ?>">Ver</a></span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "tareaedit.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Registro no Valido ! LLave Nula');"; } ?>">Editar</a></span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "tareadelete.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Registro no Valido ! LLave Nula');"; }  ?>">Eliminar</a></span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "control_tarealist.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Registro no Valido ! LLave Nula');"; }  ?>">Controles</a></span></td>
<?php } ?>
	</tr>
<?php
	}
}
?>
</tbody>
</table>
<script type="text/javascript">
initSortTable('myTable',Array('','S'));
</script>
</form>
<?php

// Close recordset and connection
phpmkr_free_result($rs);

?>
<?php if ($sExport == "") { ?>
<form action="tarealist.php" name="ewpagerform" id="ewpagerform">
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
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">P&aacute;gina&nbsp;</span></td>
<!--first page button-->
	<?php if ($nStartRec == 1) { ?>
	<td><img src="../images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="tarealist.php?start=1"><img src="../first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="../images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="tarealist.php?start=<?php echo $PrevStart; ?>"><img src="../prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="../images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="tarealist.php?start=<?php echo $NextStart; ?>"><img src="../images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="../images/lastdisab.gif" alt="�ltimo" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="tarealist.php?start=<?php echo $LastStart; ?>"><img src="../images/last.gif" alt="�ltimo" width="16" height="16" border="0"></a></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;de <?php echo intval(($nTotalRecs-1)/$nDisplayRecs+1);?></span></td>
	</tr></table>
	<?php if ($nStartRec > $nTotalRecs) { $nStartRec = $nTotalRecs; }
	$nStopRec = $nStartRec + $nDisplayRecs - 1;
	$nRecCount = $nTotalRecs - 1;
	if ($rsEof) { $nRecCount = $nTotalRecs; }
	if ($nStopRec > $nRecCount) { $nStopRec = $nRecCount; } ?>
	<span class="phpmaker">Registros <?php echo $nStartRec; ?> a <?php echo $nStopRec; ?> de <?php echo $nTotalRecs; ?></span>
<?php } else { ?>
	<span class="phpmaker">Registros no encontrados</span>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php if ($sExport <> "word" && $sExport <> "excel") { ?>
<?php include ("../footer.php") ?>
</body>
</html>
<?php } ?>
<?php

//-------------------------------------------------------------------------------
// Function SetUpAdvancedSearch
// - Set up Advanced Search parameter based on querystring parameters from Advanced Search Page
// - Variables setup: sSrchAdvanced

function SetUpAdvancedSearch()
{
	global $sSrchAdvanced;
	global $conn;

	// Field idtarea
	$x_idtarea = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_idtarea"]) : @$_GET["x_idtarea"];
	$arrFldOpr = "";
	$z_idtarea = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_idtarea"]) : @$_GET["z_idtarea"];
	$arrFldOpr = preg_split("/,/",$z_idtarea);
	if ($x_idtarea <> "") {
		$sSrchAdvanced .= "idtarea "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_idtarea) : $x_idtarea; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}
	
		// Field Estado
	$x_estado = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_estado"]) : @$_GET["x_estado"];
	$arrFldOpr = "";
	$z_estado = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_estado"]) : @$_GET["z_estado"];
	$arrFldOpr = preg_split("/,/",$z_estado);
	if ($x_estado <> "") {
		$sSrchAdvanced .= "estado "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_estado) : $x_estado; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field nombre
	$x_nombre = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_nombre"]) : @$_GET["x_nombre"];
	$arrFldOpr = "";
	$z_nombre = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_nombre"]) : @$_GET["z_nombre"];
	$arrFldOpr = preg_split("/,/",$z_nombre);
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
			$arKeyword = preg_split(" ", trim($sSearch));
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

		// Field idtarea
		if ($sOrder == "idtarea") {
			$sSortField = "idtarea";
			$sLastSort = @$_SESSION["tarea_x_idtarea_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["tarea_x_idtarea_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["tarea_x_idtarea_Sort"] <> "") { @$_SESSION["tarea_x_idtarea_Sort"] = ""; }
		}

		// Field nombre
		if ($sOrder == "nombre") {
			$sSortField = "nombre";
			$sLastSort = @$_SESSION["tarea_x_nombre_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["tarea_x_nombre_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["tarea_x_nombre_Sort"] <> "") { @$_SESSION["tarea_x_nombre_Sort"] = ""; }
		}
		$_SESSION["tarea_OrderBy"] = $sSortField . " " . $sThisSort;
		$_SESSION["tarea_REC"] = 1;
	}
	$sOrderBy = @$_SESSION["tarea_OrderBy"];
	if ($sOrderBy == "") {
		$sOrderBy = $sDefaultOrderBy;
		$_SESSION["tarea_OrderBy"] = $sOrderBy;
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
		$_SESSION["tarea_REC"] = $nStartRec;
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
			$_SESSION["tarea_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["tarea_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["tarea_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["tarea_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["tarea_REC"] = $nStartRec;
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
			$_SESSION["tarea_searchwhere"] = $sSrchWhere;

		// Reset Search Criteria & Session Keys
		}
		elseif (strtoupper($sCmd) == "RESETALL") {
			$sSrchWhere = "";
			$_SESSION["tarea_searchwhere"] = $sSrchWhere;

		// Reset Sort Criteria
		}
		elseif (strtoupper($sCmd) == "RESETSORT") {
			$sOrderBy = "";
			$_SESSION["tarea_OrderBy"] = $sOrderBy;
			if (@$_SESSION["tarea_x_idtarea_Sort"] <> "") { $_SESSION["tarea_x_idtarea_Sort"] = ""; }
			if (@$_SESSION["tarea_x_nombre_Sort"] <> "") { $_SESSION["tarea_x_nombre_Sort"] = ""; }
		}

		// Reset Start Position (Reset Command)
		$nStartRec = 1;
		$_SESSION["tarea_REC"] = $nStartRec;
	}
}

//-------------------------------------------------------------------------------
// Function ExportData
// - Export Data in Xml or Csv format

function ExportData($sExport, $sSql)
{
	global $conn;
	global $nDisplayRecs;
	global $nStartRec;
	global $nTotalRecs;
	$rs = phpmkr_query($sSql, $conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	$nTotalRecs = phpmkr_num_rows($rs);
	$nStartRec = 1;
	SetUpStartRec(); // Set Up Start Record Position
	$sCsvStr = NULL;
	$sXML = "";
	if ($sExport == "xml") {
		$sXML .= "<table>";
	}
	if ($sExport == "csv") {
		$sCsvStr .= "idtarea" . ",";
		$sCsvStr .= "nombre" . ",";
		$sCsvStr = substr($sCsvStr, 0, strlen($sCsvStr)-1); // Remove last comma
		$sCsvStr .= "\n";
	}

	// Avoid starting record > total records
	if ($nStartRec > $nTotalRecs) {
		$nStartRec = $nTotalRecs;
	}

	// Set the last record to display
	if ($nDisplayRecs < 0) {
		$nStopRec = $nTotalRecs;
	} else {
		$nStopRec = $nStartRec + $nDisplayRecs - 1;
	}

	// Move to first record directly for performance reason
	$nRecCount = $nStartRec - 1;
	if (phpmkr_num_rows($rs) > 0) {
		phpmkr_data_seek($rs,$nStartRec -1);
	}
	$nRecActual = 0;
	while (($row = @phpmkr_fetch_array($rs)) && ($nRecCount < $nStopRec)) {
		$nRecCount = $nRecCount + 1;
		if ($nRecCount >= $nStartRec) {
			$nRecActual = $nRecActual + 1;
			$x_idtarea = $row["idtarea"];
			$x_nombre = $row["nombre"];
			if ($sExport == "xml") {
				$sXML .= "<record>";
				$sXML .= "<" . str_replace("x_","","x_idtarea") . ">";
				$sTmp = $x_idtarea;
				if ((is_null($sTmp))) { $sTmp = "<Null>"; }
				$sXML .= htmlspecialchars($sTmp);
				$sXML .= "</" . str_replace("x_","","x_idtarea") . ">";
				$sXML .= "<" . str_replace("x_","","x_nombre") . ">";
				$sTmp = $x_nombre;
				if ((is_null($sTmp))) { $sTmp = "<Null>"; }
				$sXML .= htmlspecialchars($sTmp);
				$sXML .= "</" . str_replace("x_","","x_nombre") . ">";
				$sXML .= "</record>";
			}
			if ($sExport == "csv") {

				// Field idtarea
				$sCsvStr .= "\"" . str_replace("\"","\"\"",$x_idtarea) . "\"" . ",";

				// Field nombre
				$sCsvStr .= "\"" . str_replace("\"","\"\"",$x_nombre) . "\"" . ",";
				$sCsvStr = substr($sCsvStr,0, strlen($sCsvStr)-1); // Remove last comma
				$sCsvStr .= "\n";
			}
		}
	}

	// Close recordset and connection
	phpmkr_free_result($rs);
	ob_end_clean();
	if ($sExport == "xml") {
		echo "<?xml version=\"1.0\" standalone=\"yes\"?>" . "\n";
		echo $sXML;
		echo "</table>";
	}
	if ($sExport == "csv") {
		echo  $sCsvStr;
	}
}
?>
