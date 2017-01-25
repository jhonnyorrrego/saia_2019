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
$keyact=0; 
global $conn;
function obtener_contenido($key)
{  global $conn;
  $datos=busca_filtro_tabla("","pretexto","pretexto.idpretexto=".$sKeyWrk,$sOrderBy,$conn);
  }

// Initialize common variables
$x_idpretexto = Null;
$x_asunto = Null;
$x_cuerpo = Null;
$x_ayuda = Null;
$x_imagen = Null;
?>
<?php include_once("../../../../../db.php") ?>
<?php include_once("../../../../../librerias_saia.php"); echo(estilo_bootstrap()); ?>
<?php include_once("../../../../../phpmkrfn.php") ?>

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
$nDisplayRecs = 4;
$nRecRange = 8;

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
	$HTTP_SESSION_VARS["pretexto_searchwhere"] = $sSrchWhere;

	// Reset start record counter (new search)
	$nStartRec = 1;
	$HTTP_SESSION_VARS["pretexto_REC"] = $nStartRec;
}
else
{
	$sSrchWhere = @$HTTP_SESSION_VARS["pretexto_searchwhere"];
}


// Build WHERE condition
$sDbWhere = " ";
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
$sSql = "SELECT idpretexto,asunto,imagen FROM pretexto,entidad_pretexto ";
//$sSql = "SELECT distinct idpretexto,asunto,imagen FROM pretexto,entidad_pretexto ";
$idfuncionario =usuario_actual("idfuncionario");  // filtro los pre-textos para cada usuario
// Load Default Filter
$sDefaultFilter ="";
$sGroupBy ="";
$sHaving ="";

// Load Default Order
$sDefaultOrderBy ="";
$sWhere ="";
if ($sDefaultFilter != "") {
	$sWhere .= "(" . $sDefaultFilter . ") AND ";
}
if ($sDbWhere != "") {
	$sWhere .= "(" . $sDbWhere . ") AND ";
}
if (substr($sWhere, -5) == " AND ") {
	$sWhere = "entidad_pretexto.llave_entidad=$idfuncionario AND entidad_pretexto.pretexto_idpretexto=pretexto.idpretexto ";
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

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <script type="text/javascript" src="../../tiny_mce_popup.js"></script>
	<script type="text/javascript" src="jscripts/template.js"></script>
	<script>
	 var contenido=""
  </script>
	<title>PLANTILLA DE TEXTO - PERSONALES</title>
	
</head>
<body>
<div class="container">

<?php

// Set up Record Set
global $conn;
$datos=busca_filtro_tabla("count(*) as cuantos from ($sSql) b","","","",$conn);

if(isset($_REQUEST["start"]))
 $nStartRec = $_REQUEST["start"];  
else
 $nStartRec = 1;
 
$fin=$nStartRec+$nDisplayRecs; 
$rs=$conn->Ejecutar_Limit($sSql,$nStartRec-1,$fin,$conn);	
$nTotalRecs = $datos[0]["cuantos"]; 

if ($nDisplayRecs <= 0) { // Display All Records
	$nDisplayRecs = $nTotalRecs;
}
 
//SetUpStartRec(); // Set Up Start Record Position
?>
<H5>PLANTILLAS DE TEXTO</H5>


<table border="0" cellspacing="0" cellpadding="0">

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
<table border="0" cellspacing="1" cellpadding="4" class="table">
<?php if ($nTotalRecs > 0) { ?>
	<!-- Table header -->
	<tr bgcolor="#666666">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="pretextolist.php?order=<?php echo urlencode("asunto"); ?>" style="color: #FFFFFF;">Asunto&nbsp;(*)<?php if (@$HTTP_SESSION_VARS["pretexto_x_asunto_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$HTTP_SESSION_VARS["pretexto_x_asunto_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<!--td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="pretextolist.php?order=<?php echo urlencode("imagen"); ?>" style="color: #FFFFFF;">Icono&nbsp;(*)<?php if (@$HTTP_SESSION_VARS["pretexto_x_imagen_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$HTTP_SESSION_VARS["pretexto_x_imagen_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td-->
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
	//phpmkr_data_seek($rs, $nStartRec -1);
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
		$sKey = $row["idpretexto"];
		$x_idpretexto = $row["idpretexto"];
		$x_asunto = $row["asunto"];
		$x_contenido = $row["contenido"];
		$x_ayuda = $row["ayuda"];
		$x_imagen = $row["imagen"];
?>
<script>
function activa_iframe(id)
{
plantillas_saiasrc.location.href='pretextoview.php?key='+id;
}

</script>
	<!-- Table body -->
	<tr<?php echo $sItemRowClass; ?>>
		<!-- asunto -->
		<td><span class="phpmaker">
<?php echo $x_asunto; ?>
</span></td>
		<!-- imagen -->
		<!--td><span class="phpmaker">
<?php echo $x_imagen; ?>
</span></td-->
<?php
//AQUI va la validacion si tengo la plantilla asignada en llave_entidad=1 para mi como funcionario y no a dependecias o cargos 
if(1){ 
?>
<td><span class="phpmaker"><a href="#" Onclick="activa_iframe('<?php echo(urlencode($sKey)); ?>');">Ver</a></span></td>
<?php
	}
?>
<td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "pretextodelete.php?a_delete='D'&key=" . urlencode($sKey); } else { echo "javascript:alert('Invalid Record! Key is null');"; }  ?>">Eliminar</a></span></td>
	</tr>
<?php
	}
}
?>
</table>
</form>
<?php

// Close recordset and connection
//phpmkr_free_result($rs);
//phpmkr_db_close($conn);
?>
<form action="pretextolist.php" name="ewpagerform" id="ewpagerform" onSubmit="return activa_iframe(4)"
>
<table class="table" border="0" cellspacing="1" cellpadding="4" >
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
	<td><img src="../../../../../images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="pretextolist.php?start=1"><img src="../../../../../images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="../../../../../images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="pretextolist.php?start=<?php echo $PrevStart; ?>"><img src="../../../../../images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="../../../../../images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="pretextolist.php?start=<?php echo $NextStart; ?>"><img src="../../../../../images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="../../../../../images/lastdisab.gif" alt="�ltimo" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="pretextolist.php?start=<?php echo $LastStart; ?>"><img src="../../../../../images/last.gif" alt="&Uacute;ltimo" width="16" height="16" border="0"></a></td>
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
<div class="frmRow"><label for="tdesc">{#template_dlg.desc_label}:</label>
			<span id="tmpldesc"></span></div>
			<fieldset>
				<legend>{#template_dlg.preview}</legend>
				<iframe id="plantillas_saiasrc" name="plantillas_saiasrc" src="pretextoview.php" width="600" height="280" frameborder="0"></iframe>
			</fieldset>

<div class="mceActionPanel">
			<div style="float: left">
				<input type="button" id="insert" name="insert" value="{#insert}" onclick="TemplateDialog.insert(contenido);" />
			</div>

			<div style="float: right">
				<input type="button" id="cancel" name="cancel" value="{#cancel}" onclick="tinyMCEPopup.close();" />
			</div>

			<br style="clear:both" />
</div>
</div>
</body>
<?php

//-------------------------------------------------------------------------------
// Function SetUpAdvancedSearch
// - Set up Advanced Search parameter based on querystring parameters from Advanced Search Page
// - Variables setup: sSrchAdvanced

function SetUpAdvancedSearch()
{
	global $HTTP_GET_VARS;
	global $sSrchAdvanced;

	// Field asunto
	$x_asunto = (get_magic_quotes_gpc()) ? stripslashes(@$HTTP_GET_VARS["x_asunto"]) : @$HTTP_GET_VARS["x_asunto"];
	$arrFldOpr = "";
	$z_asunto = (get_magic_quotes_gpc()) ? stripslashes(@$HTTP_GET_VARS["z_asunto"]) : @$HTTP_GET_VARS["z_asunto"];
	$arrFldOpr = split(",",$z_asunto);
	if ($x_asunto <> "") {
		$sSrchAdvanced .= "asunto "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_asunto) : $x_asunto; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field contenido
	$x_contenido = (get_magic_quotes_gpc()) ? stripslashes(@$HTTP_GET_VARS["x_contenido"]) : @$HTTP_GET_VARS["x_contenido"];
	$arrFldOpr = "";
	$z_contenido = (get_magic_quotes_gpc()) ? stripslashes(@$HTTP_GET_VARS["z_contenido"]) : @$HTTP_GET_VARS["z_contenido"];
	$arrFldOpr = split(",",$z_contenido);
	if ($x_contenido <> "") {
		$sSrchAdvanced .= "contenido "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_contenido) : $x_contenido; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field ayuda
	$x_ayuda = (get_magic_quotes_gpc()) ? stripslashes(@$HTTP_GET_VARS["x_ayuda"]) : @$HTTP_GET_VARS["x_ayuda"];
	$arrFldOpr = "";
	$z_ayuda = (get_magic_quotes_gpc()) ? stripslashes(@$HTTP_GET_VARS["z_ayuda"]) : @$HTTP_GET_VARS["z_ayuda"];
	$arrFldOpr = split(",",$z_ayuda);
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

	// Field imagen
	$x_imagen = (get_magic_quotes_gpc()) ? stripslashes(@$HTTP_GET_VARS["x_imagen"]) : @$HTTP_GET_VARS["x_imagen"];
	$arrFldOpr = "";
	$z_imagen = (get_magic_quotes_gpc()) ? stripslashes(@$HTTP_GET_VARS["z_imagen"]) : @$HTTP_GET_VARS["z_imagen"];
	$arrFldOpr = split(",",$z_imagen);
	if ($x_imagen <> "") {
		$sSrchAdvanced .= "imagen "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_imagen) : $x_imagen; // Add input parameter
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
	$BasicSearchSQL.= "asunto LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "contenido LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "ayuda LIKE '%" . $sKeyword . "%' OR ";
	$BasicSearchSQL.= "imagen LIKE '%" . $sKeyword . "%' OR ";
	if (substr($BasicSearchSQL, -4) == " OR ") { $BasicSearchSQL = substr($BasicSearchSQL, 0, strlen($BasicSearchSQL)-4); }
	return $BasicSearchSQL;
}

//-------------------------------------------------------------------------------
// Function SetUpBasicSearch
// - Set up Basic Search parameter based on form elements pSearch & pSearchType
// - Variables setup: sSrchBasic

function SetUpBasicSearch()
{
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
{
	global $HTTP_SESSION_VARS;
	global $HTTP_GET_VARS;
	global $sOrderBy;
	global $sDefaultOrderBy;

	// Check for an Order parameter
	if (strlen(@$HTTP_GET_VARS["order"]) > 0) {
		$sOrder = @$HTTP_GET_VARS["order"];

		// Field asunto
		if ($sOrder == "asunto") {
			$sSortField = "asunto";
			$sLastSort = @$HTTP_SESSION_VARS["pretexto_x_asunto_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$HTTP_SESSION_VARS["pretexto_x_asunto_Sort"] = $sThisSort;
		}
		else
		{
			if (@$HTTP_SESSION_VARS["pretexto_x_asunto_Sort"] <> "") { @$HTTP_SESSION_VARS["pretexto_x_asunto_Sort"] = ""; }
		}

		// Field imagen
		if ($sOrder == "imagen") {
			$sSortField = "imagen";
			$sLastSort = @$HTTP_SESSION_VARS["pretexto_x_imagen_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$HTTP_SESSION_VARS["pretexto_x_imagen_Sort"] = $sThisSort;
		}
		else
		{
			if (@$HTTP_SESSION_VARS["pretexto_x_imagen_Sort"] <> "") { @$HTTP_SESSION_VARS["pretexto_x_imagen_Sort"] = ""; }
		}
		$HTTP_SESSION_VARS["pretexto_OrderBy"] = $sSortField . " " . $sThisSort;
		$HTTP_SESSION_VARS["pretexto_REC"] = 1;
	}
	$sOrderBy = @$HTTP_SESSION_VARS["pretexto_OrderBy"];
	if ($sOrderBy == "") {
		$sOrderBy = $sDefaultOrderBy;
		$HTTP_SESSION_VARS["pretexto_OrderBy"] = $sOrderBy;
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
	if (isset($_REQUEST["start"])) {
		$nStartRec = @$_REQUEST["start"];
		$HTTP_SESSION_VARS["pretexto_REC"] = $nStartRec;
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
			$HTTP_SESSION_VARS["pretexto_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$HTTP_SESSION_VARS["pretexto_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$HTTP_SESSION_VARS["pretexto_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$HTTP_SESSION_VARS["pretexto_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$HTTP_SESSION_VARS["pretexto_REC"] = $nStartRec;
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
		global $HTTP_SESSION_VARS;
		global $HTTP_GET_VARS;

	// Get Reset Cmd
	if (strlen(@$HTTP_GET_VARS["cmd"]) > 0) {
		$sCmd = @$HTTP_GET_VARS["cmd"];

		// Reset Search Criteria
		if (strtoupper($sCmd) == "RESET") {
			$sSrchWhere = "";
			$HTTP_SESSION_VARS["pretexto_searchwhere"] = $sSrchWhere;

		// Reset Search Criteria & Session Keys
		}
		elseif (strtoupper($sCmd) == "RESETALL") {
			$sSrchWhere = "";
			$HTTP_SESSION_VARS["pretexto_searchwhere"] = $sSrchWhere;

		// Reset Sort Criteria
		}
		elseif (strtoupper($sCmd) == "RESETSORT") {
			$sOrderBy = "";
			$HTTP_SESSION_VARS["pretexto_OrderBy"] = $sOrderBy;
			if (@$HTTP_SESSION_VARS["pretexto_x_asunto_Sort"] <> "") { $HTTP_SESSION_VARS["pretexto_x_asunto_Sort"] = ""; }
			if (@$HTTP_SESSION_VARS["pretexto_x_imagen_Sort"] <> "") { $HTTP_SESSION_VARS["pretexto_x_imagen_Sort"] = ""; }
		}

		// Reset Start Position (Reset Command)
		$nStartRec = 1;
		$HTTP_SESSION_VARS["pretexto_REC"] = $nStartRec;
	}
}
?>
