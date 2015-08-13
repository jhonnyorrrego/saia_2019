<?php session_start(); ?>
<?php ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
$ewCurSec = 0; // Initialise
// Initialize common variables
$x_idcontrol_asignacion = Null;
$x_accion = Null;
$x_periocidad = Null;
$x_tipo_periocidad = Null;
$x_asignacion_idasignacion = Null;
$x_tipo_anticipacion = Null;
$x_anticipacion = Null;
$x_ejecutar_hasta = Null;
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
// Open connection to the database


// Handle Reset Command
ResetCmd();

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
	$_SESSION["control_asignacion_searchwhere"] = $sSrchWhere;

	// Reset start record counter (new search)
	$nStartRec = 1;
	$_SESSION["control_asignacion_REC"] = $nStartRec;
}
else
{
	$sSrchWhere = @$_SESSION["control_asignacion_searchwhere"];
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
$sSql = "SELECT * FROM control_asignacion";

// Load Default Filter
$sDefaultFilter = "asignacion_idasignacion=".$_REQUEST['idasignacion'];
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


// Set up Record Set

$row=busca_filtro_tabla("","control_asignacion",$sWhere,$sOrderBy,$conn);

if ($nDisplayRecs <= 0) { // Display All Records
	$nDisplayRecs = $nTotalRecs;
}

$nStartRec = 0;
$nTotalRecs=$row["numcampos"];
SetUpStartRec(); // Set Up Start Record Position

?>
<?php include ("../header.php")
?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
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
	<tr  class="encabezado">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="control_asignacionlist.php?order=<?php echo urlencode("accion"); ?>" style="color: #FFFFFF;">accion&nbsp;(*)<?php if (@$_SESSION["control_asignacion_x_accion_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["control_asignacion_x_accion_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="control_asignacionlist.php?order=<?php echo urlencode("periocidad"); ?>" style="color: #FFFFFF;">Periocidad<?php if (@$_SESSION["control_asignacion_x_periocidad_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["control_asignacion_x_periocidad_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="control_asignacionlist.php?order=<?php echo urlencode("anticipacion"); ?>" style="color: #FFFFFF;">Anticipacion<?php if (@$_SESSION["control_asignacion_x_anticipacion_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["control_asignacion_x_anticipacion_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="control_asignacionlist.php?order=<?php echo urlencode("ejecutar_hasta"); ?>" style="color: #FFFFFF;">Fecha Ejecucion<?php if (@$_SESSION["control_asignacion_x_ejecutar_hasta_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["control_asignacion_x_ejecutar_hasta_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
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
if($nStopRec >$nTotalRecs) // Permite mantener el rango en la ultima pagina del listado
	$nStopRec=$nTotalRecs;

// Move to first record directly for performance reason
$nRecCount = $nStartRec - 1;

for($i=$nStartRec-1;$i<$nStopRec;$i++)
   {
	$nRecCount = $nRecCount + 1;
	if ($nRecCount >= $nStartRec) {
		$nRecActual = $nRecActual + 1;

	// Set row color
	$sItemRowClass = " bgcolor=\"#FFFFFF\"";

	// Display alternate color for rows
	if ($nRecCount % 2 <> 0) {
		$sItemRowClass = " bgcolor=\"#F5F5F5\"";
	}
$patrones=array('day','month','year','hour','minute','second');
$reemplazar=array('dia','mes','a&ntilde;o','hora','minuto','segundo');

$row[$i]["tipo_periocidad"]=str_replace($patrones, $reemplazar, $row[$i]["tipo_periocidad"]);
$row[$i]["tipo_anticipacion"]=str_replace($patrones, $reemplazar, $row[$i]["tipo_anticipacion"]);
// Load Key for record
		$sKey = $row[$i]["idcontrol_asignacion"];
		$x_idcontrol_asignacion = $row[$i]["idcontrol_asignacion"];
		$x_accion = $row[$i]["accion"];
		$x_periocidad = $row[$i]["periocidad"];
		$x_tipo_periocidad = $row[$i]["tipo_periocidad"];
		$x_asignacion_idasignacion = $row[$i]["asignacion_idasignacion"];
		$x_tipo_anticipacion = $row[$i]["tipo_anticipacion"];
		$x_anticipacion = $row[$i]["anticipacion"];
		$x_ejecutar_hasta = $row[$i]["ejecutar_hasta"];
		
		$anticipacion=$x_anticipacion." ".$x_tipo_anticipacion."(s)";
		
		if($x_periocidad==NULL)
	    	   $periocidad="Sin Periodicidad";
		else 
		   $periocidad=$x_periocidad." ".$x_tipo_periocidad."(s)";
		
		$proxima_ejecucion= $row[$i]["fecha_actualizacion"];
		
		
		if(strpos($x_accion,"correo")>0)
			{
			   $x_accion="Correo Electronico";
			}
                elseif(strpos($x_accion,"mensaje")>0)
			{
			   $x_accion="Mensajeria Instantanea";
		}			

?>


	<!-- Table body -->
	<tr<?php echo $sItemRowClass; ?>>
		<!-- accion -->
		<td><span class="phpmaker">
<?php echo str_replace(chr(10), "<br>", @$x_accion); ?>
</span></td>
		<!-- periocidad -->
		<td><span class="phpmaker">
<?php echo $periocidad; ?>
</span></td>
		<!-- anticipacion -->
		<td><span class="phpmaker">
<?php echo $anticipacion; ?>
</span></td>
		<!-- ejecutar_hasta -->
		<td><span class="phpmaker">
<?php echo $proxima_ejecucion; ?>
</span></td>
<?php if(isset($_REQUEST["modo"])) $modo=$_REQUEST["modo"]; else $modo="usuario";?>
<td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "parsea_accion_asignacion.php?modo=".$modo."&accion=ejecutar&key=" . urlencode($_REQUEST['idasignacion']); } else { echo "javascript:alert('Invalid Record! Key is null');";  } ?>">Ejecutar Alerta</a></span></td>
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
<form action="control_asignacionlist.php" name="ewpagerform" id="ewpagerform">
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
	<td><a href="control_asignacionlist.php?start=1"><img src="../images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="../images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="control_asignacionlist.php?start=<?php echo $PrevStart; ?>"><img src="../images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="../images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="control_asignacionlist.php?start=<?php echo $NextStart; ?>"><img src="../images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="../images/lastdisab.gif" alt="�ltimo" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="control_asignacionlist.php?start=<?php echo $LastStart; ?>"><img src="../images/last.gif" alt="�ltimo" width="16" height="16" border="0"></a></td>
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
<?php include ("../footer.php")?>
<script>
document.getElementById("header").style.display="none";
</script>
<?php

//-------------------------------------------------------------------------------
// Function BasicSearchSQL
// - Build WHERE clause for a keyword

function BasicSearchSQL($Keyword)
{
	$sKeyword = (!get_magic_quotes_gpc()) ? addslashes($Keyword) : $Keyword;
	$BasicSearchSQL = "";
	$BasicSearchSQL.= "accion LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "tipo_periocidad LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "tipo_anticipacion LIKE '%" . $sKeyword . "%' OR ";
	if (substr($BasicSearchSQL, -4) == " OR ") { $BasicSearchSQL = substr($BasicSearchSQL, 0, strlen($BasicSearchSQL)-4); }
	return $BasicSearchSQL;
}

//-------------------------------------------------------------------------------
// Function SetUpBasicSearch
// - Set up Basic Search parameter based on form elements pSearch & pSearchType
// - Variables setup: sSrchBasic

function SetUpBasicSearch()
{   global $conn;
	global $_GET;
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
{   global $conn;
	global $_SESSION;
	global $_GET;
	global $sOrderBy;
	global $sDefaultOrderBy;

	// Check for an Order parameter
	if (strlen(@$_GET["order"]) > 0) {
		$sOrder = @$_GET["order"];

		// Field accion
		if ($sOrder == "accion") {
			$sSortField = "accion";
			$sLastSort = @$_SESSION["control_asignacion_x_accion_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["control_asignacion_x_accion_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["control_asignacion_x_accion_Sort"] <> "") { @$_SESSION["control_asignacion_x_accion_Sort"] = ""; }
		}

		// Field periocidad
		if ($sOrder == "periocidad") {
			$sSortField = "periocidad";
			$sLastSort = @$_SESSION["control_asignacion_x_periocidad_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["control_asignacion_x_periocidad_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["control_asignacion_x_periocidad_Sort"] <> "") { @$_SESSION["control_asignacion_x_periocidad_Sort"] = ""; }
		}

		// Field tipo_periocidad
		if ($sOrder == "tipo_periocidad") {
			$sSortField = "tipo_periocidad";
			$sLastSort = @$_SESSION["control_asignacion_x_tipo_periocidad_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["control_asignacion_x_tipo_periocidad_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["control_asignacion_x_tipo_periocidad_Sort"] <> "") { @$_SESSION["control_asignacion_x_tipo_periocidad_Sort"] = ""; }
		}

		// Field tipo_anticipacion
		if ($sOrder == "tipo_anticipacion") {
			$sSortField = "tipo_anticipacion";
			$sLastSort = @$_SESSION["control_asignacion_x_tipo_anticipacion_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["control_asignacion_x_tipo_anticipacion_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["control_asignacion_x_tipo_anticipacion_Sort"] <> "") { @$_SESSION["control_asignacion_x_tipo_anticipacion_Sort"] = ""; }
		}

		// Field anticipacion
		if ($sOrder == "anticipacion") {
			$sSortField = "anticipacion";
			$sLastSort = @$_SESSION["control_asignacion_x_anticipacion_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["control_asignacion_x_anticipacion_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["control_asignacion_x_anticipacion_Sort"] <> "") { @$_SESSION["control_asignacion_x_anticipacion_Sort"] = ""; }
		}

		// Field ejecutar_hasta
		if ($sOrder == "ejecutar_hasta") {
			$sSortField = "ejecutar_hasta";
			$sLastSort = @$_SESSION["control_asignacion_x_ejecutar_hasta_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["control_asignacion_x_ejecutar_hasta_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["control_asignacion_x_ejecutar_hasta_Sort"] <> "") { @$_SESSION["control_asignacion_x_ejecutar_hasta_Sort"] = ""; }
		}
		$_SESSION["control_asignacion_OrderBy"] = $sSortField . " " . $sThisSort;
		$_SESSION["control_asignacion_REC"] = 1;
	}
	$sOrderBy = @$_SESSION["control_asignacion_OrderBy"];
	if ($sOrderBy == "") {
		$sOrderBy = $sDefaultOrderBy;
		$_SESSION["control_asignacion_OrderBy"] = $sOrderBy;
	}
}

//-------------------------------------------------------------------------------
// Function SetUpStartRec
//- Set up Starting Record parameters based on Pager Navigation
// - Variables setup: nStartRec

function SetUpStartRec()
{   global $conn;

	// Check for a START parameter
	global $_SESSION;
	global $_GET;
	global $nStartRec;
	global $nDisplayRecs;
	global $nTotalRecs;
	if (strlen(@$_GET["start"]) > 0) {
		$nStartRec = @$_GET["start"];
		$_SESSION["control_asignacion_REC"] = $nStartRec;
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
			$_SESSION["control_asignacion_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["control_asignacion_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["control_asignacion_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["control_asignacion_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["control_asignacion_REC"] = $nStartRec;
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
{       global $conn;
		global $_SESSION;
		global $_GET;

	// Get Reset Cmd
	if (strlen(@$_GET["cmd"]) > 0) {
		$sCmd = @$_GET["cmd"];

		// Reset Search Criteria
		if (strtoupper($sCmd) == "RESET") {
			$sSrchWhere = "";
			$_SESSION["control_asignacion_searchwhere"] = $sSrchWhere;

		// Reset Search Criteria & Session Keys
		}
		elseif (strtoupper($sCmd) == "RESETALL") {
			$sSrchWhere = "";
			$_SESSION["control_asignacion_searchwhere"] = $sSrchWhere;

		// Reset Sort Criteria
		}
		elseif (strtoupper($sCmd) == "RESETSORT") {
			$sOrderBy = "";
			$_SESSION["control_asignacion_OrderBy"] = $sOrderBy;
			if (@$_SESSION["control_asignacion_x_accion_Sort"] <> "") { $_SESSION["control_asignacion_x_accion_Sort"] = ""; }
			if (@$_SESSION["control_asignacion_x_periocidad_Sort"] <> "") { $_SESSION["control_asignacion_x_periocidad_Sort"] = ""; }
			if (@$_SESSION["control_asignacion_x_tipo_periocidad_Sort"] <> "") { $_SESSION["control_asignacion_x_tipo_periocidad_Sort"] = ""; }
			if (@$_SESSION["control_asignacion_x_tipo_anticipacion_Sort"] <> "") { $_SESSION["control_asignacion_x_tipo_anticipacion_Sort"] = ""; }
			if (@$_SESSION["control_asignacion_x_anticipacion_Sort"] <> "") { $_SESSION["control_asignacion_x_anticipacion_Sort"] = ""; }
			if (@$_SESSION["control_asignacion_x_ejecutar_hasta_Sort"] <> "") { $_SESSION["control_asignacion_x_ejecutar_hasta_Sort"] = ""; }
		}

		// Reset Start Position (Reset Command)
		$nStartRec = 1;
		$_SESSION["control_asignacion_REC"] = $nStartRec;
	}
}
?>
