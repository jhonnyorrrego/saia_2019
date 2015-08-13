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
$x_idcontrol_tarea = Null;
$x_accion = Null;
$x_periocidad = Null;
$x_tipo_periocidad = Null;
$x_tarea_idtarea = Null;
$x_estado = Null;
$x_fecha_inicial = Null;
$x_fecha_actualizacion = Null;
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
	$HTTP_SESSION_VARS["control_tarea_searchwhere"] = $sSrchWhere;

	// Reset start record counter (new search)
	$nStartRec = 1;
	$HTTP_SESSION_VARS["control_tarea_REC"] = $nStartRec;
}
else
{
	$sSrchWhere = @$HTTP_SESSION_VARS["control_tarea_searchwhere"];
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
$sSql = "SELECT * FROM control_tarea ";
if(isset($_REQUEST['key'])&&$_REQUEST['key']!=null)
 $sDefaultFilter = "tarea_idtarea=".$_REQUEST['key'];
else 
 $sDefaultFilter = "0=1"; // No llego el id  no se muestra informacion
 
// Load Default Filter
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
<?php include_once('../header.php')?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<?php

// Set up Record Set
$rs = phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
$nTotalRecs = phpmkr_num_rows($rs);
if ($nDisplayRecs <= 0) { // Display All Records
	$nDisplayRecs = $nTotalRecs;
}
$nStartRec = 1;
SetUpStartRec(); // Set Up Start Record Position
?>


<table border="0" cellspacing="10px" cellpadding="0">
	<tr>
		<td><span class="phpmaker"><a href="control_tareaadd.php?idtarea=<?php echo	$_REQUEST['key'];?>">Adicionar</a></span></td>
		<td><span class="phpmaker"><a href="tarealist.php">Ir al listado de tareas</a></span></td>
	</tr>
</table>
<p>
<?php
if (@$HTTP_SESSION_VARS["ewmsg"] <> "") {
?>
<p><span class="phpmaker" style="color: Red;"><?php echo $HTTP_SESSION_VARS["ewmsg"]; ?></span></p>
<?php
	$HTTP_SESSION_VARS["ewmsg"] = ""; // Clear message
}
?>
<form method="post">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
<?php if ($nTotalRecs > 0) { ?>
	<!-- Table header -->
	<tr class="encabezado">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	Tareas</a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="control_tarealist.php?order=<?php echo urlencode("periocidad"); ?>" style="color: #FFFFFF;">Periocidad<?php if (@$HTTP_SESSION_VARS["control_tarea_x_periocidad_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$HTTP_SESSION_VARS["control_tarea_x_periocidad_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="control_tarealist.php?order=<?php echo urlencode("tipo_periocidad"); ?>" style="color: #FFFFFF;">Tipo periocidad&nbsp;<?php if (@$HTTP_SESSION_VARS["control_tarea_x_tipo_periocidad_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$HTTP_SESSION_VARS["control_tarea_x_tipo_periocidad_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="control_tarealist.php?order=<?php echo urlencode("fecha_inicial"); ?>" style="color: #FFFFFF;">fecha inicial<?php if (@$HTTP_SESSION_VARS["control_tarea_x_fecha_inicial_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$HTTP_SESSION_VARS["control_tarea_x_fecha_inicial_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="control_tarealist.php?order=<?php echo urlencode("fecha_actualizacion"); ?>" style="color: #FFFFFF;">fecha actualizacion<?php if (@$HTTP_SESSION_VARS["control_tarea_x_fecha_actualizacion_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$HTTP_SESSION_VARS["control_tarea_x_fecha_actualizacion_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
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
if (phpmkr_num_rows($rs) > 0) {
//	phpmkr_data_seek($rs, $nStartRec -1);
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
		$sKey = $row["idcontrol_tarea"];
		$x_idcontrol_tarea = $row["idcontrol_tarea"];
		$x_accion = $row["accion"];
		$x_periocidad = $row["periocidad"];
		$x_tipo_periocidad = $row["tipo_periocidad"];
		$x_tarea_idtarea = $row["tarea_idtarea"];
		$x_estado = $row["estado"];
		$x_fecha_inicial = $row["fecha_inicial"];
		$x_fecha_actualizacion = $row["fecha_actualizacion"];
?>
	<!-- Table body -->
	<tr<?php echo $sItemRowClass; ?>>
		<!-- tarea_idtarea -->
		<td><span class="phpmaker">
<?php
  if($x_tarea_idtarea){
    $tarea=busca_filtro_tabla("","tarea","idtarea=".$x_tarea_idtarea,"",$conn);
    if($tarea["numcampos"]){
      echo($tarea[0]["nombre"]);
    }
    else echo ("Tarea No Encontrada");
  }
  else echo ("Tarea No Asignada");
   ?>
</span></td>
		<!-- periocidad -->
		<td><span class="phpmaker">
<?php echo $x_periocidad; ?>
</span></td>
		<!-- tipo_periocidad -->
		<td><span class="phpmaker">
<?php switch($x_tipo_periocidad){
        case "hour":
          echo "Hora(s)";
        break;
        case "month":
          echo "Mes(es)";
        break;
        case "day":
          echo "D&iacute;a(s)";
        break;
        case "year":
          echo "A&ntilde;o(s)";
        break;
      }

?>
</span></td>
		<!-- fecha_inicial -->
		<td><span class="phpmaker">
<?php echo FormatDateTime($x_fecha_inicial,5); ?>
</span></td>
		<!-- fecha_actualizacion -->
		<td><span class="phpmaker">
<?php echo FormatDateTime($x_fecha_actualizacion,5); ?>
</span></td>
<td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "control_tareaview.php?idasig=".$_REQUEST['key']."&key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');";  } ?>">Ver</a></span></td>
<td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "control_tareaedit.php?idasig=".$_REQUEST['key']."&key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; } ?>">Editar</a></span></td>
<td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "control_tareaadd.php?idasig=".$_REQUEST['key']."&key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; } ?>">Copiar</a></span></td>
<td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "control_tareadelete.php?idasig=".$_REQUEST['key']."&key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; }  ?>">Eliminar</a></span></td>
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
phpmkr_db_close($conn);
?>
<form action="control_tarealist.php" name="ewpagerform" id="ewpagerform">
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
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Página&nbsp;</span></td>
<!--first page button-->
	<?php if ($nStartRec == 1) { ?>
	<td><img src="../images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="control_tarealist.php?start=1"><img src="../images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="../images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="control_tarealist.php?start=<?php echo $PrevStart; ?>"><img src="../images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="../images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="control_tarealist.php?start=<?php echo $NextStart; ?>"><img src="../images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="../images/lastdisab.gif" alt="Último" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="control_tarealist.php?start=<?php echo $LastStart; ?>"><img src="../images/last.gif" alt="Último" width="16" height="16" border="0"></a></td>
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
<?php  include_once("../footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function BasicSearchSQL
// - Build WHERE clause for a keyword

function BasicSearchSQL($Keyword)
{ global $conn;
	$sKeyword = (!get_magic_quotes_gpc()) ? addslashes($Keyword) : $Keyword;
	$BasicSearchSQL = "";
	$BasicSearchSQL.= "accion LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "tipo_periocidad LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "estado LIKE '%" . $sKeyword . "%' OR ";
	if (substr($BasicSearchSQL, -4) == " OR ") { $BasicSearchSQL = substr($BasicSearchSQL, 0, strlen($BasicSearchSQL)-4); }
	return $BasicSearchSQL;
}

//-------------------------------------------------------------------------------
// Function SetUpBasicSearch
// - Set up Basic Search parameter based on form elements pSearch & pSearchType
// - Variables setup: sSrchBasic

function SetUpBasicSearch()
{ global $conn;
	global $HTTP_GET_VARS;
	global $sSrchBasic;
	$sSearch = (!get_magic_quotes_gpc()) ? addslashes(@$HTTP_GET_VARS["psearch"]) : @$HTTP_GET_VARS["psearch"];
	$sSearchType = @$HTTP_GET_VARS["psearchtype"];
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
{ global $conn;
	global $HTTP_SESSION_VARS;
	global $HTTP_GET_VARS;
	global $sOrderBy;
	global $sDefaultOrderBy;

	// Check for an Order parameter
	if (strlen(@$HTTP_GET_VARS["order"]) > 0) {
		$sOrder = @$HTTP_GET_VARS["order"];

		// Field idcontrol_tarea
		if ($sOrder == "idcontrol_tarea") {
			$sSortField = "idcontrol_tarea";
			$sLastSort = @$HTTP_SESSION_VARS["control_tarea_x_idcontrol_tarea_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$HTTP_SESSION_VARS["control_tarea_x_idcontrol_tarea_Sort"] = $sThisSort;
		}
		else
		{
			if (@$HTTP_SESSION_VARS["control_tarea_x_idcontrol_tarea_Sort"] <> "") { @$HTTP_SESSION_VARS["control_tarea_x_idcontrol_tarea_Sort"] = ""; }
		}

		// Field periocidad
		if ($sOrder == "periocidad") {
			$sSortField = "periocidad";
			$sLastSort = @$HTTP_SESSION_VARS["control_tarea_x_periocidad_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$HTTP_SESSION_VARS["control_tarea_x_periocidad_Sort"] = $sThisSort;
		}
		else
		{
			if (@$HTTP_SESSION_VARS["control_tarea_x_periocidad_Sort"] <> "") { @$HTTP_SESSION_VARS["control_tarea_x_periocidad_Sort"] = ""; }
		}

		// Field tipo_periocidad
		if ($sOrder == "tipo_periocidad") {
			$sSortField = "tipo_periocidad";
			$sLastSort = @$HTTP_SESSION_VARS["control_tarea_x_tipo_periocidad_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$HTTP_SESSION_VARS["control_tarea_x_tipo_periocidad_Sort"] = $sThisSort;
		}
		else
		{
			if (@$HTTP_SESSION_VARS["control_tarea_x_tipo_periocidad_Sort"] <> "") { @$HTTP_SESSION_VARS["control_tarea_x_tipo_periocidad_Sort"] = ""; }
		}

		// Field tarea_idtarea
		if ($sOrder == "tarea_idtarea") {
			$sSortField = "tarea_idtarea";
			$sLastSort = @$HTTP_SESSION_VARS["control_tarea_x_tarea_idtarea_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$HTTP_SESSION_VARS["control_tarea_x_tarea_idtarea_Sort"] = $sThisSort;
		}
		else
		{
			if (@$HTTP_SESSION_VARS["control_tarea_x_tarea_idtarea_Sort"] <> "") { @$HTTP_SESSION_VARS["control_tarea_x_tarea_idtarea_Sort"] = ""; }
		}

		// Field fecha_inicial
		if ($sOrder == "fecha_inicial") {
			$sSortField = "fecha_inicial";
			$sLastSort = @$HTTP_SESSION_VARS["control_tarea_x_fecha_inicial_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$HTTP_SESSION_VARS["control_tarea_x_fecha_inicial_Sort"] = $sThisSort;
		}
		else
		{
			if (@$HTTP_SESSION_VARS["control_tarea_x_fecha_inicial_Sort"] <> "") { @$HTTP_SESSION_VARS["control_tarea_x_fecha_inicial_Sort"] = ""; }
		}

		// Field fecha_actualizacion
		if ($sOrder == "fecha_actualizacion") {
			$sSortField = "fecha_actualizacion";
			$sLastSort = @$HTTP_SESSION_VARS["control_tarea_x_fecha_actualizacion_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$HTTP_SESSION_VARS["control_tarea_x_fecha_actualizacion_Sort"] = $sThisSort;
		}
		else
		{
			if (@$HTTP_SESSION_VARS["control_tarea_x_fecha_actualizacion_Sort"] <> "") { @$HTTP_SESSION_VARS["control_tarea_x_fecha_actualizacion_Sort"] = ""; }
		}
		$HTTP_SESSION_VARS["control_tarea_OrderBy"] = $sSortField . " " . $sThisSort;
		$HTTP_SESSION_VARS["control_tarea_REC"] = 1;
	}
	$sOrderBy = @$HTTP_SESSION_VARS["control_tarea_OrderBy"];
	if ($sOrderBy == "") {
		$sOrderBy = $sDefaultOrderBy;
		$HTTP_SESSION_VARS["control_tarea_OrderBy"] = $sOrderBy;
	}
}

//-------------------------------------------------------------------------------
// Function SetUpStartRec
//- Set up Starting Record parameters based on Pager Navigation
// - Variables setup: nStartRec

function SetUpStartRec()
{
  global $conn;
	// Check for a START parameter
	global $HTTP_SESSION_VARS;
	global $HTTP_GET_VARS;
	global $nStartRec;
	global $nDisplayRecs;
	global $nTotalRecs;
	if (strlen(@$HTTP_GET_VARS["start"]) > 0) {
		$nStartRec = @$HTTP_GET_VARS["start"];
		$HTTP_SESSION_VARS["control_tarea_REC"] = $nStartRec;
	}
	elseif (strlen(@$HTTP_GET_VARS["pageno"]) > 0) {
		$nPageNo = @$HTTP_GET_VARS["pageno"];
		if (is_numeric($nPageNo)) {
			$nStartRec = ($nPageNo-1)*$nDisplayRecs+1;
			if ($nStartRec <= 0) {
				$nStartRec = 1;
			}
			elseif ($nStartRec >= (($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1) {
				$nStartRec = (($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1;
			}
			$HTTP_SESSION_VARS["control_tarea_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$HTTP_SESSION_VARS["control_tarea_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$HTTP_SESSION_VARS["control_tarea_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$HTTP_SESSION_VARS["control_tarea_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$HTTP_SESSION_VARS["control_tarea_REC"] = $nStartRec;
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
{   global $conn;
		global $HTTP_SESSION_VARS;
		global $HTTP_GET_VARS;

	// Get Reset Cmd
	if (strlen(@$HTTP_GET_VARS["cmd"]) > 0) {
		$sCmd = @$HTTP_GET_VARS["cmd"];

		// Reset Search Criteria
		if (strtoupper($sCmd) == "RESET") {
			$sSrchWhere = "";
			$HTTP_SESSION_VARS["control_tarea_searchwhere"] = $sSrchWhere;

		// Reset Search Criteria & Session Keys
		}
		elseif (strtoupper($sCmd) == "RESETALL") {
			$sSrchWhere = "";
			$HTTP_SESSION_VARS["control_tarea_searchwhere"] = $sSrchWhere;

		// Reset Sort Criteria
		}
		elseif (strtoupper($sCmd) == "RESETSORT") {
			$sOrderBy = "";
			$HTTP_SESSION_VARS["control_tarea_OrderBy"] = $sOrderBy;
			if (@$HTTP_SESSION_VARS["control_tarea_x_idcontrol_tarea_Sort"] <> "") { $HTTP_SESSION_VARS["control_tarea_x_idcontrol_tarea_Sort"] = ""; }
			if (@$HTTP_SESSION_VARS["control_tarea_x_periocidad_Sort"] <> "") { $HTTP_SESSION_VARS["control_tarea_x_periocidad_Sort"] = ""; }
			if (@$HTTP_SESSION_VARS["control_tarea_x_tipo_periocidad_Sort"] <> "") { $HTTP_SESSION_VARS["control_tarea_x_tipo_periocidad_Sort"] = ""; }
			if (@$HTTP_SESSION_VARS["control_tarea_x_tarea_idtarea_Sort"] <> "") { $HTTP_SESSION_VARS["control_tarea_x_tarea_idtarea_Sort"] = ""; }
			if (@$HTTP_SESSION_VARS["control_tarea_x_fecha_inicial_Sort"] <> "") { $HTTP_SESSION_VARS["control_tarea_x_fecha_inicial_Sort"] = ""; }
			if (@$HTTP_SESSION_VARS["control_tarea_x_fecha_actualizacion_Sort"] <> "") { $HTTP_SESSION_VARS["control_tarea_x_fecha_actualizacion_Sort"] = ""; }
		}

		// Reset Start Position (Reset Command)
		$nStartRec = 1;
		$HTTP_SESSION_VARS["control_tarea_REC"] = $nStartRec;
	}
}
?>
