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
$x_identidad_serie = Null;
$x_entidad_identidad = Null;
$x_serie_idserie = Null;
$x_llave_entidad = Null;
$x_estado = Null;
$x_tipo = Null;
$x_fecha = Null;
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

// Open connection to the database

// Handle Reset Command
ResetCmd();

// Get Search Criteria for Advanced Search
SetUpAdvancedSearch();

// Build Search Criteria
if ($sSrchAdvanced != "") {
	$sSrchWhere = $sSrchAdvanced; // Advanced Search
}
elseif ($sSrchBasic != "") {
	$sSrchWhere = $sSrchBasic; // Basic Search
}

// Save Search Criteria
if ($sSrchWhere != "") {
	$_SESSION["entidad_serie_searchwhere"] = $sSrchWhere;

	// Reset start record counter (new search)
	$nStartRec = 1;
	$_SESSION["entidad_serie_REC"] = $nStartRec;
}
else
{
	$sSrchWhere = @$_SESSION["entidad_serie_searchwhere"];
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
$sSql = "SELECT * FROM entidad_serie";

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
$rs = phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
$nTotalRecs = phpmkr_num_rows($rs);
if ($nDisplayRecs <= 0) { // Display All Records
	$nDisplayRecs = $nTotalRecs;
}
$nStartRec = 1;
SetUpStartRec(); // Set Up Start Record Position
?>
<p><span class="phpmaker">Tabla: entidad serie
</span></p>
<form action="entidad_serielist.php">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><span class="phpmaker">
			<a href="entidad_serielist.php?cmd=reset">Mostrar todo</a>&nbsp;&nbsp;
			<a href="entidad_seriesrch.php">Búsqueda Avanzada</a>
		</span></td>
	</tr>
</table>
</form>
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
	<tr bgcolor="#666666">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="entidad_serielist.php?order=<?php echo urlencode("identidad_serie"); ?>" style="color: #FFFFFF;">identidad serie<?php if (@$_SESSION["entidad_serie_x_identidad_serie_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["entidad_serie_x_identidad_serie_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="entidad_serielist.php?order=<?php echo urlencode("entidad_identidad"); ?>" style="color: #FFFFFF;">Entidad Asociada<?php if (@$_SESSION["entidad_serie_x_entidad_identidad_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["entidad_serie_x_entidad_identidad_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="entidad_serielist.php?order=<?php echo urlencode("serie_idserie"); ?>" style="color: #FFFFFF;">Serie<?php if (@$_SESSION["entidad_serie_x_serie_idserie_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["entidad_serie_x_serie_idserie_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="entidad_serielist.php?order=<?php echo urlencode("llave_entidad"); ?>" style="color: #FFFFFF;">FDC<?php if (@$_SESSION["entidad_serie_x_llave_entidad_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["entidad_serie_x_llave_entidad_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="entidad_serielist.php?order=<?php echo urlencode("estado"); ?>" style="color: #FFFFFF;">Estado<?php if (@$_SESSION["entidad_serie_x_estado_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["entidad_serie_x_estado_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
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
		$sKey = $row["identidad_serie"];
		$x_identidad_serie = $row["identidad_serie"];
		$x_entidad_identidad = $row["entidad_identidad"];
		$x_serie_idserie = $row["serie_idserie"];
		$x_llave_entidad = $row["llave_entidad"];
		$x_estado = $row["estado"];
		$x_tipo = $row["tipo"];
		$x_fecha = $row["fecha"];
?>
	<!-- Table body -->
	<tr<?php echo $sItemRowClass; ?>>
		<!-- identidad_serie -->
		<td><span class="phpmaker">
<?php echo $x_identidad_serie; ?>
</span></td>
		<!-- entidad_identidad -->
		<td><span class="phpmaker">
<?php
if ((!is_null($x_entidad_identidad)) && ($x_entidad_identidad <> "")) {
	$sSqlWrk = "SELECT DISTINCT *  FROM entidad";
	$sTmp = $x_entidad_identidad;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (identidad = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_entidad_identidad = $x_entidad_identidad; // Backup Original Value
$x_entidad_identidad = $sTmp;
?>
<?php echo $x_entidad_identidad; ?>
<?php $x_entidad_identidad = $ox_entidad_identidad; // Restore Original Value ?>
</span></td>
		<!-- serie_idserie -->
		<td><span class="phpmaker">
<?php
if ((!is_null($x_serie_idserie)) && ($x_serie_idserie <> "")) {
	$sSqlWrk = "SELECT DISTINCT *  FROM serie";
	$sTmp = $x_serie_idserie;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (idserie = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
		$sTmp .= ValueSeparator(0) . $rowwrk["codigo"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_serie_idserie = $x_serie_idserie; // Backup Original Value
$x_serie_idserie = $sTmp;
?>
<?php echo $x_serie_idserie; ?>
<?php $x_serie_idserie = $ox_serie_idserie; // Restore Original Value ?>
</span></td>
		<!-- llave_entidad -->
		<td><span class="phpmaker">
<?php echo $x_llave_entidad; ?>
</span></td>
		<!-- estado -->
		<td><span class="phpmaker">
<?php echo $x_estado; ?>
</span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "entidad_serieview.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');";  } ?>">Ver</a></span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "entidad_serieedit.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; } ?>">Editar</a></span></td>
<td><span class="phpmaker"><a href="<?php if ((!is_null($sKey))) { echo "entidad_seriedelete.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; }  ?>">Eliminar</a></span></td>
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
<form action="entidad_serielist.php" name="ewpagerform" id="ewpagerform">
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
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="entidad_serielist.php?start=1"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="entidad_serielist.php?start=<?php echo $PrevStart; ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="entidad_serielist.php?start=<?php echo $NextStart; ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="images/lastdisab.gif" alt="Último" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="entidad_serielist.php?start=<?php echo $LastStart; ?>"><img src="images/last.gif" alt="Último" width="16" height="16" border="0"></a></td>
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
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function SetUpAdvancedSearch
// - Set up Advanced Search parameter based on querystring parameters from Advanced Search Page
// - Variables setup: sSrchAdvanced

function SetUpAdvancedSearch()
{
	global $sSrchAdvanced;

	// Field identidad_serie
	$x_identidad_serie = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_identidad_serie"]) : @$_GET["x_identidad_serie"];
	$arrFldOpr = "";
	$z_identidad_serie = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_identidad_serie"]) : @$_GET["z_identidad_serie"];
	$arrFldOpr = split(",",$z_identidad_serie);
	if ($x_identidad_serie <> "") {
		$sSrchAdvanced .= "identidad_serie "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_identidad_serie) : $x_identidad_serie; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field entidad_identidad
	$x_entidad_identidad = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_entidad_identidad"]) : @$_GET["x_entidad_identidad"];
	$arrFldOpr = "";
	$z_entidad_identidad = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_entidad_identidad"]) : @$_GET["z_entidad_identidad"];
	$arrFldOpr = split(",",$z_entidad_identidad);
	if ($x_entidad_identidad <> "") {
		$sSrchAdvanced .= "entidad_identidad "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_entidad_identidad) : $x_entidad_identidad; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field serie_idserie
	$x_serie_idserie = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_serie_idserie"]) : @$_GET["x_serie_idserie"];
	$arrFldOpr = "";
	$z_serie_idserie = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_serie_idserie"]) : @$_GET["z_serie_idserie"];
	$arrFldOpr = split(",",$z_serie_idserie);
	if ($x_serie_idserie <> "") {
		$sSrchAdvanced .= "serie_idserie "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_serie_idserie) : $x_serie_idserie; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field llave_entidad
	$x_llave_entidad = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_llave_entidad"]) : @$_GET["x_llave_entidad"];
	$arrFldOpr = "";
	$z_llave_entidad = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_llave_entidad"]) : @$_GET["z_llave_entidad"];
	$arrFldOpr = split(",",$z_llave_entidad);
	if ($x_llave_entidad <> "") {
		$sSrchAdvanced .= "llave_entidad "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_llave_entidad) : $x_llave_entidad; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field estado
	$x_estado = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_estado"]) : @$_GET["x_estado"];
	$arrFldOpr = "";
	$z_estado = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_estado"]) : @$_GET["z_estado"];
	$arrFldOpr = split(",",$z_estado);
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

	// Field tipo
	$x_tipo = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_tipo"]) : @$_GET["x_tipo"];
	$arrFldOpr = "";
	$z_tipo = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_tipo"]) : @$_GET["z_tipo"];
	$arrFldOpr = split(",",$z_tipo);
	if ($x_tipo <> "") {
		$sSrchAdvanced .= "tipo "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_tipo) : $x_tipo; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field fecha
	$x_fecha = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_fecha"]) : @$_GET["x_fecha"];
	$arrFldOpr = "";
	$z_fecha = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_fecha"]) : @$_GET["z_fecha"];
	$arrFldOpr = split(",",$z_fecha);
	if ($x_fecha <> "") {
		$sSrchAdvanced .= "fecha "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_fecha) : $x_fecha; // Add input parameter
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

		// Field identidad_serie
		if ($sOrder == "identidad_serie") {
			$sSortField = "identidad_serie";
			$sLastSort = @$_SESSION["entidad_serie_x_identidad_serie_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["entidad_serie_x_identidad_serie_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["entidad_serie_x_identidad_serie_Sort"] <> "") { @$_SESSION["entidad_serie_x_identidad_serie_Sort"] = ""; }
		}

		// Field entidad_identidad
		if ($sOrder == "entidad_identidad") {
			$sSortField = "entidad_identidad";
			$sLastSort = @$_SESSION["entidad_serie_x_entidad_identidad_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["entidad_serie_x_entidad_identidad_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["entidad_serie_x_entidad_identidad_Sort"] <> "") { @$_SESSION["entidad_serie_x_entidad_identidad_Sort"] = ""; }
		}

		// Field serie_idserie
		if ($sOrder == "serie_idserie") {
			$sSortField = "serie_idserie";
			$sLastSort = @$_SESSION["entidad_serie_x_serie_idserie_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["entidad_serie_x_serie_idserie_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["entidad_serie_x_serie_idserie_Sort"] <> "") { @$_SESSION["entidad_serie_x_serie_idserie_Sort"] = ""; }
		}

		// Field llave_entidad
		if ($sOrder == "llave_entidad") {
			$sSortField = "llave_entidad";
			$sLastSort = @$_SESSION["entidad_serie_x_llave_entidad_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["entidad_serie_x_llave_entidad_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["entidad_serie_x_llave_entidad_Sort"] <> "") { @$_SESSION["entidad_serie_x_llave_entidad_Sort"] = ""; }
		}

		// Field estado
		if ($sOrder == "estado") {
			$sSortField = "estado";
			$sLastSort = @$_SESSION["entidad_serie_x_estado_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["entidad_serie_x_estado_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["entidad_serie_x_estado_Sort"] <> "") { @$_SESSION["entidad_serie_x_estado_Sort"] = ""; }
		}
		$_SESSION["entidad_serie_OrderBy"] = $sSortField . " " . $sThisSort;
		$_SESSION["entidad_serie_REC"] = 1;
	}
	$sOrderBy = @$_SESSION["entidad_serie_OrderBy"];
	if ($sOrderBy == "") {
		$sOrderBy = $sDefaultOrderBy;
		$_SESSION["entidad_serie_OrderBy"] = $sOrderBy;
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
		$_SESSION["entidad_serie_REC"] = $nStartRec;
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
			$_SESSION["entidad_serie_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["entidad_serie_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["entidad_serie_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["entidad_serie_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["entidad_serie_REC"] = $nStartRec;
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
			$_SESSION["entidad_serie_searchwhere"] = $sSrchWhere;

		// Reset Search Criteria & Session Keys
		}
		elseif (strtoupper($sCmd) == "RESETALL") {
			$sSrchWhere = "";
			$_SESSION["entidad_serie_searchwhere"] = $sSrchWhere;

		// Reset Sort Criteria
		}
		elseif (strtoupper($sCmd) == "RESETSORT") {
			$sOrderBy = "";
			$_SESSION["entidad_serie_OrderBy"] = $sOrderBy;
			if (@$_SESSION["entidad_serie_x_identidad_serie_Sort"] <> "") { $_SESSION["entidad_serie_x_identidad_serie_Sort"] = ""; }
			if (@$_SESSION["entidad_serie_x_entidad_identidad_Sort"] <> "") { $_SESSION["entidad_serie_x_entidad_identidad_Sort"] = ""; }
			if (@$_SESSION["entidad_serie_x_serie_idserie_Sort"] <> "") { $_SESSION["entidad_serie_x_serie_idserie_Sort"] = ""; }
			if (@$_SESSION["entidad_serie_x_llave_entidad_Sort"] <> "") { $_SESSION["entidad_serie_x_llave_entidad_Sort"] = ""; }
			if (@$_SESSION["entidad_serie_x_estado_Sort"] <> "") { $_SESSION["entidad_serie_x_estado_Sort"] = ""; }
		}

		// Reset Start Position (Reset Command)
		$nStartRec = 1;
		$_SESSION["entidad_serie_REC"] = $nStartRec;
	}
}
?>
