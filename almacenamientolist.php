<?php session_start(); ?>
<?php ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
<?php
$ewCurSec = 0; // Initialise

// User levels
define("ewAllowAdd", 1, true);
define("ewAllowDelete", 2, true);
define("ewAllowEdit", 4, true);
define("ewAllowView", 8, true);
define("ewAllowList", 8, true);
define("ewAllowReport", 8, true);
define("ewAllowSearch", 8, true);																														
define("ewAllowAdmin", 16, true);						
?>
<?php

// Initialize common variables
$x_idalmacenamiento = Null;
$x_documento_iddocumento = Null;
$x_folder_idfolder = Null;
$x_soporte = Null;
$x_num_folios = Null;
$x_anexos = Null;
$x_deterioro = Null;
$x_responsable = Null;
$x_registro_entrada = Null;
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
$nDisplayRecs = 20;
$nRecRange = 10;

// Handle Reset Command
ResetCmd();

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
$sSql = "SELECT * FROM almacenamiento";

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
$rs = phpmkr_query($sSql,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
$nTotalRecs = phpmkr_num_rows($rs);
if ($nDisplayRecs <= 0) { // Display All Records
	$nDisplayRecs = $nTotalRecs;
}
$nStartRec = 1;
SetUpStartRec(); // Set Up Start Record Position
?>
<p><span class="phpmaker">almacenamiento
</span></p>
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><span class="phpmaker"><a href="almacenamientoadd.php">Adicionar</a></span></td>
	</tr>
</table>
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
	<tr class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="almacenamientolist.php?order=<?php echo urlencode("idalmacenamiento"); ?>" style="color: #FFFFFF;">id<?php if (@$_SESSION["almacenamiento_x_idalmacenamiento_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["almacenamiento_x_idalmacenamiento_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="almacenamientolist.php?order=<?php echo urlencode("documento_iddocumento"); ?>" style="color: #FFFFFF;">documento<?php if (@$_SESSION["almacenamiento_x_documento_iddocumento_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["almacenamiento_x_documento_iddocumento_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="almacenamientolist.php?order=<?php echo urlencode("folder_idfolder"); ?>" style="color: #FFFFFF;">folder<?php if (@$_SESSION["almacenamiento_x_folder_idfolder_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["almacenamiento_x_folder_idfolder_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="almacenamientolist.php?order=<?php echo urlencode("soporte"); ?>" style="color: #FFFFFF;">soporte<?php if (@$_SESSION["almacenamiento_x_soporte_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["almacenamiento_x_soporte_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>		
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="almacenamientolist.php?order=<?php echo urlencode("num_folios"); ?>" style="color: #FFFFFF;">no. folios<?php if (@$_SESSION["almacenamiento_x_num_folios_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["almacenamiento_x_num_folios_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="almacenamientolist.php?order=<?php echo urlencode("anexos"); ?>" style="color: #FFFFFF;">anexos<?php if (@$_SESSION["almacenamiento_x_anexos_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["almacenamiento_x_anexos_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="almacenamientolist.php?order=<?php echo urlencode("deterioro"); ?>" style="color: #FFFFFF;">deterioro<?php if (@$_SESSION["almacenamiento_x_deterioro_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["almacenamiento_x_deterioro_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>    		
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="almacenamientolist.php?order=<?php echo urlencode("responsable"); ?>" style="color: #FFFFFF;">responsable<?php if (@$_SESSION["almacenamiento_x_responsable_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["almacenamiento_x_responsable_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="almacenamientolist.php?order=<?php echo urlencode("registro_entrada"); ?>" style="color: #FFFFFF;">registro entrada<?php if (@$_SESSION["almacenamiento_x_registro_entrada_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["almacenamiento_x_registro_entrada_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
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
if (phpmkr_num_rows($rs) > 0) {
	phpmkr_data_seek($rs, $nStartRec -1);
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
		$sKey = $row["idalmacenamiento"];
		$x_idalmacenamiento = $row["idalmacenamiento"];
		$x_documento_iddocumento = $row["documento_iddocumento"];
		$x_folder_idfolder = $row["folder_idfolder"];
		$x_soporte = $row["soporte"];
		$x_num_folios = $row["num_folios"];
		$x_anexos = $row["anexos"];
		$x_deterioro = $row["deterioro"];
		$x_responsable = $row["responsable"];
		$x_registro_entrada = $row["registro_entrada"];
?>
	<!-- Table body -->
	<tr<?php echo $sItemRowClass; ?>>
		<!-- idalmacenamiento -->
		<td><span class="phpmaker">
<?php echo $x_idalmacenamiento; ?>
</span></td>
		<!-- documento_iddocumento -->
		<td><span class="phpmaker">
<?php echo $x_documento_iddocumento; ?>
</span></td>
		<!-- folder_idfolder -->
		<td><span class="phpmaker">
<?php echo $x_folder_idfolder; ?>
</span></td>
		<!-- soporte -->
		<td><span class="phpmaker">
<?php echo $x_soporte; ?>
</span></td>
		<!-- num_folios -->
		<td><span class="phpmaker">
<?php echo $x_num_folios; ?>
</span></td>
		<!-- anexos -->
		<td><span class="phpmaker">
<?php echo $x_anexos; ?>
</span></td>
		<!-- deterioro -->
		<td><span class="phpmaker">
<?php echo $x_deterioro; ?>
</span></td>
		<!-- responsable -->
		<td><span class="phpmaker">
<?php echo $x_responsable; ?>
</span></td>
		<!-- registro_entrada -->
		<td><span class="phpmaker">
<?php echo FormatDateTime($x_registro_entrada,5); ?>
</span></td>
<td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "almacenamientoview.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');";  } ?>">Ver</a></span></td>
<td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "almacenamientoedit.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; } ?>">Editar</a></span></td>
<!--td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "almacenamientoadd.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; } ?>">Copy</a></span></td-->
<!--td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "almacenamientodelete.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; }  ?>">Delete</a></span></td-->
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
?>
<form action="almacenamientolist.php" name="ewpagerform" id="ewpagerform">
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
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Pagina&nbsp;</span></td>
<!--first page button-->
	<?php if ($nStartRec == 1) { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="almacenamientolist.php?start=1"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="almacenamientolist.php?start=<?php echo $PrevStart; ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="almacenamientolist.php?start=<?php echo $NextStart; ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="almacenamientolist.php?start=<?php echo $LastStart; ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;de <?php echo intval(($nTotalRecs-1)/$nDisplayRecs+1);?></span></td>
	</tr></table>
	<?php if ($nStartRec > $nTotalRecs) { $nStartRec = $nTotalRecs; }
	$nStopRec = $nStartRec + $nDisplayRecs - 1;
	$nRecCount = $nTotalRecs - 1;
	if ($rsEof) { $nRecCount = $nTotalRecs; }
	if ($nStopRec > $nRecCount) { $nStopRec = $nRecCount; } ?>
	<span class="phpmaker">Registros <?php echo $nStartRec; ?> al <?php echo $nStopRec; ?> de <?php echo $nTotalRecs; ?></span>
<?php } else { ?>
	<span class="phpmaker">No se encontraron registros</span>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function SetUpSortOrder
// - Set up Sort parameters based on Sort Links clicked
// - Variables setup: sOrderBy, Session("Table_OrderBy"), Session("Table_Field_Sort")

function SetUpSortOrder()
{
	global $_SESSION;
	global $_GET;
	global $sOrderBy;
	global $sDefaultOrderBy;

	// Check for an Order parameter
	if (strlen(@$_GET["order"]) > 0) {
		$sOrder = @$_GET["order"];

		// Field idalmacenamiento
		if ($sOrder == "idalmacenamiento") {
			$sSortField = "idalmacenamiento";
			$sLastSort = @$_SESSION["almacenamiento_x_idalmacenamiento_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["almacenamiento_x_idalmacenamiento_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["almacenamiento_x_idalmacenamiento_Sort"] <> "") { @$_SESSION["almacenamiento_x_idalmacenamiento_Sort"] = ""; }
		}

		// Field documento_iddocumento
		if ($sOrder == "documento_iddocumento") {
			$sSortField = "documento_iddocumento";
			$sLastSort = @$_SESSION["almacenamiento_x_documento_iddocumento_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["almacenamiento_x_documento_iddocumento_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["almacenamiento_x_documento_iddocumento_Sort"] <> "") { @$_SESSION["almacenamiento_x_documento_iddocumento_Sort"] = ""; }
		}

		// Field folder_idfolder
		if ($sOrder == "folder_idfolder") {
			$sSortField = "folder_idfolder";
			$sLastSort = @$_SESSION["almacenamiento_x_folder_idfolder_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["almacenamiento_x_folder_idfolder_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["almacenamiento_x_folder_idfolder_Sort"] <> "") { @$_SESSION["almacenamiento_x_folder_idfolder_Sort"] = ""; }
		}

		// Field num_folios
		if ($sOrder == "num_folios") {
			$sSortField = "num_folios";
			$sLastSort = @$_SESSION["almacenamiento_x_num_folios_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["almacenamiento_x_num_folios_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["almacenamiento_x_num_folios_Sort"] <> "") { @$_SESSION["almacenamiento_x_num_folios_Sort"] = ""; }
		}

		// Field responsable
		if ($sOrder == "responsable") {
			$sSortField = "responsable";
			$sLastSort = @$_SESSION["almacenamiento_x_responsable_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["almacenamiento_x_responsable_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["almacenamiento_x_responsable_Sort"] <> "") { @$_SESSION["almacenamiento_x_responsable_Sort"] = ""; }
		}

		// Field registro_entrada
		if ($sOrder == "registro_entrada") {
			$sSortField = "registro_entrada";
			$sLastSort = @$_SESSION["almacenamiento_x_registro_entrada_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["almacenamiento_x_registro_entrada_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["almacenamiento_x_registro_entrada_Sort"] <> "") { @$_SESSION["almacenamiento_x_registro_entrada_Sort"] = ""; }
		}
		$_SESSION["almacenamiento_OrderBy"] = $sSortField . " " . $sThisSort;
		$_SESSION["almacenamiento_REC"] = 1;
	}
	$sOrderBy = @$_SESSION["almacenamiento_OrderBy"];
	if ($sOrderBy == "") {
		$sOrderBy = $sDefaultOrderBy;
		$_SESSION["almacenamiento_OrderBy"] = $sOrderBy;
	}
}

//-------------------------------------------------------------------------------
// Function SetUpStartRec
//- Set up Starting Record parameters based on Pager Navigation
// - Variables setup: nStartRec

function SetUpStartRec()
{

	// Check for a START parameter
	global $_SESSION;
	global $_GET;
	global $nStartRec;
	global $nDisplayRecs;
	global $nTotalRecs;
	if (strlen(@$_GET["start"]) > 0) {
		$nStartRec = @$_GET["start"];
		$_SESSION["almacenamiento_REC"] = $nStartRec;
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
			$_SESSION["almacenamiento_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["almacenamiento_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["almacenamiento_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["almacenamiento_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["almacenamiento_REC"] = $nStartRec;
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
		global $_SESSION;
		global $_GET;

	// Get Reset Cmd
	if (strlen(@$_GET["cmd"]) > 0) {
		$sCmd = @$_GET["cmd"];

		// Reset Search Criteria
		if (strtoupper($sCmd) == "RESET") {
			$sSrchWhere = "";
			$_SESSION["almacenamiento_searchwhere"] = $sSrchWhere;

		// Reset Search Criteria & Session Keys
		}
		elseif (strtoupper($sCmd) == "RESETALL") {
			$sSrchWhere = "";
			$_SESSION["almacenamiento_searchwhere"] = $sSrchWhere;

		// Reset Sort Criteria
		}
		elseif (strtoupper($sCmd) == "RESETSORT") {
			$sOrderBy = "";
			$_SESSION["almacenamiento_OrderBy"] = $sOrderBy;
			if (@$_SESSION["almacenamiento_x_idalmacenamiento_Sort"] <> "") { $_SESSION["almacenamiento_x_idalmacenamiento_Sort"] = ""; }
			if (@$_SESSION["almacenamiento_x_documento_iddocumento_Sort"] <> "") { $_SESSION["almacenamiento_x_documento_iddocumento_Sort"] = ""; }
			if (@$_SESSION["almacenamiento_x_folder_idfolder_Sort"] <> "") { $_SESSION["almacenamiento_x_folder_idfolder_Sort"] = ""; }
			if (@$_SESSION["almacenamiento_x_num_folios_Sort"] <> "") { $_SESSION["almacenamiento_x_num_folios_Sort"] = ""; }
			if (@$_SESSION["almacenamiento_x_responsable_Sort"] <> "") { $_SESSION["almacenamiento_x_responsable_Sort"] = ""; }
			if (@$_SESSION["almacenamiento_x_registro_entrada_Sort"] <> "") { $_SESSION["almacenamiento_x_registro_entrada_Sort"] = ""; }
		}

		// Reset Start Position (Reset Command)
		$nStartRec = 1;
		$_SESSION["almacenamiento_REC"] = $nStartRec;
	}
}
?>
