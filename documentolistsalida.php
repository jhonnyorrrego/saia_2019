<?php include_once ("db.php") ?>
<?php
/*global $usuactual;
$usuactual=$_SESSION["LOGIN".LLAVE_SAIA];*/
// Initialize common variables
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
  header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
  header("Cache-Control: post-check=0, pre-check=0", false); 
  header("Pragma: no-cache"); // HTTP/1.0 
$x_iddocumento = Null;
$x_numero = Null;
$x_serie = Null;
$x_fecha = Null;
$x_ejecutor = Null;
$x_descripcion = Null;
$x_dependencia=Null;
$x_paginas = Null;
?>
<?php
$sExport = @$_GET["export"]; // Load Export Request
if ($sExport == "html") {

	// Printer Friendly
}
if ($sExport == "excel") {
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=documento.xls');
}
if ($sExport == "word") {
	header('Content-Type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename=documento.doc');
}
?>
<?php include ("phpmkrfn.php"); 
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

//error($sSrchAdvanced );
// Build Search Criteria
if ($sSrchAdvanced != "") {
	$sSrchWhere = $sSrchAdvanced; // Advanced Search
}
elseif ($sSrchBasic != "") {
	$sSrchWhere = $sSrchBasic; // Basic Search
}

// Save Search Criteria
if ($sSrchWhere != "") {
	$_SESSION["documento_searchwhere"] = $sSrchWhere;

	// Reset start record counter (new search)
	$nStartRec = 1;
	$_SESSION["documento_REC"] = $nStartRec;
}
else
{
	$sSrchWhere = @$_SESSION["documento_searchwhere"];
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
$sSql = "SELECT A.*,to_char(A.fecha,'DD/MM/YYYY') as fecha, A.fecha as fecha_doc FROM documento A";
$sDefaultFilter = "A.estado='ACTIVO' and A.tipo_radicado=2 ";
$sGroupBy = "A.iddocumento";
$sHaving = "";

// Load Default Order
$sDefaultOrderBy = "fecha_doc DESC";
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
/*if ($sGroupBy != "") {
	$sSql .= " GROUP BY " . $sGroupBy;
}*/
if ($sHaving != "") {
	$sSql .= " HAVING " . $sHaving;
}

/*// Set Up Sorting Order
$sOrderBy = "";
SetUpSortOrder();

echo $sOrderBy;*/
if ($sDefaultOrderBy != "") {
	$sSql .= " ORDER BY " . $sDefaultOrderBy;
}
?>
<?php include ("header.php") ?>
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
//echo $sSql;
$rs=phpmkr_query($sSql,$conn) or error("Error en Busqueda de Proceso SQL: $sql");
$temp=phpmkr_fetch_array($rs);
for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++);
$nTotalRecs=$i;
$rs = phpmkr_query($sSql,$conn) or error("PROBLEMAS AL EJECUTAR LA B&Uacute;SQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
//$nTotalRecs = phpmkr_num_rows($rs);
if ($nDisplayRecs <= 0) { // Display All Records
	$nDisplayRecs = $nTotalRecs;
}
$nStartRec = 1;
SetUpStartRec(); // Set Up Start Record Position
?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/salidaslist.gif" border="0">&nbsp;&nbsp;LISTADO DE DOCUMENTOS DE SALIDA
<?php if($sExport == "") {  ?>
<!--B>&nbsp;&nbsp;<a href="documentolistsalnt.php">LISTADO DE ARCHIVOS SIN TRANSFERIR</a-->
<table align="right"><tr><td>
&nbsp;&nbsp;<a href="documentolistsal.php?export=html"><img src="enlaces/imprimir.gif" border="0" ALT="Imprimir"></a>
</td><td>
&nbsp;&nbsp;<a href="documentolistsal.php?export=excel"><img src="enlaces/excel.gif" border="0" ALT="Exportar a Excel"></a>
</td><td>
&nbsp;&nbsp;<a href="documentolistsal.php?export=word"><img src="enlaces/word.gif" border="0" ALT="Exportar a Word"></a>
</td></tr></table>
<?php } ?>
</span></p>
<?php if ($sExport == "") { ?>
<form action="documentolistsal.php">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="psearch" size="20">
			<input type="Submit" name="Submit" value="BUSCAR &nbsp;(*)">&nbsp;&nbsp;
			
			<a href="documentosrchsal.php">B&Uacute;SQUEDA AVANZADA</a>
		</span></td>
	</tr>
	<!--tr><td><span class="phpmaker"><input type="radio" name="psearchtype" value="" checked>FRASE EXACTA&nbsp;&nbsp;<input type="radio" name="psearchtype" value="AND">TODAS LAS PALABRAS&nbsp;&nbsp;<input type="radio" name="psearchtype" value="OR">CUALQUIER PALABRA</span></td></tr-->
</table>
</form>
<?php } ?>
<?php if ($sExport == "") { ?>
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<!--td><span class="phpmaker"><a href="documentoaddsal.php">NUEVA RADICACI&Oacute;N</a>&nbsp;&nbsp;&nbsp<\td-->		
			   <?php if(isset($_GET["cmd"])== "buscar" ){ 
          if($_GET["cmd"]!="reset" && $_GET["cmd"]!="resetall")  {?>
       			 <td><span class="phpmaker"><a href="documentolistsal.php?cmd=reset">DOCUMENTOS RADICADOS</a>&nbsp;&nbsp;
			 <?php }} ?>
			  </span></td>
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
<form method="post" action="despachar.php" name=form1 id=form1><br>
        <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
          <?php if ($nTotalRecs > 0) { ?>
          <!-- Table header -->
          <tr class="encabezado_list">
            <td valign="top">&nbsp;</td>
            <td valign="top"><span class="phpmaker" style="color: #FFFFFF;"> 
              <?php if ($sExport <> "") { ?>
              N�MERO DE RADICACI�N 
              <?php }else{ ?>
              <a href="documentolistsal.php?order=<?php echo urlencode("numero"); ?>" style="color: #FFFFFF;">N&Uacute;MERO DE RADICACI&Oacute;N&nbsp;(*)
              <?php if (@$_SESSION["documento_x_numero_Sort"] == "ASC") { ?>
              <img src="images/sortup.gif" width="10" height="9" border="0">
              <?php } elseif (@$_SESSION["documento_x_numero_Sort"] == "DESC") { ?>
              <img src="images/sortdown.gif" width="10" height="9" border="0">
              <?php } ?>
              </a> 
              <?php } ?>
              </span></td>
            <td valign="top"><span class="phpmaker" style="color: #FFFFFF;"> 
              <?php if ($sExport <> "") { ?>
              TIPO DE DOCUMENTO 
              <?php }else{ ?>
              <a href="documentolistsal.php?order=<?php echo urlencode("serie"); ?>" style="color: #FFFFFF;">TIPO 
              DE DOCUMENTO
              <?php if (@$_SESSION["documento_x_serie_Sort"] == "ASC") { ?>
              <img src="images/sortup.gif" width="10" height="9" border="0">
              <?php } elseif (@$_SESSION["documento_x_serie_Sort"] == "DESC") { ?>
              <img src="images/sortdown.gif" width="10" height="9" border="0">
              <?php } ?>
              </a> 
              <?php } ?>
              </span></td>
            <td valign="top"><span class="phpmaker" style="color: #FFFFFF;"> 
              <?php if ($sExport <> "") { ?>
              FECHA 
              <?php }else{ ?>
              <a href="documentolistsal.php?order=<?php echo urlencode("fecha"); ?>" style="color: #FFFFFF;">FECHA
              <?php if (@$_SESSION["documento_x_fecha_Sort"] == "ASC") { ?>
              <img src="images/sortup.gif" width="10" height="9" border="0">
              <?php } elseif (@$_SESSION["documento_x_fecha_Sort"] == "DESC") { ?>
              <img src="images/sortdown.gif" width="10" height="9" border="0">
              <?php } ?>
              </a> 
              <?php } ?>
              </span></td>
            <td valign="top"><span class="phpmaker" style="color: #FFFFFF;"> 
              <?php if ($sExport <> "") { ?>
              DESCRIPCION 
              <?php }else{ ?>
              <a href="documentolistsal.php?order=<?php echo urlencode("descripcion"); ?>" style="color: #FFFFFF;">DESCRIPCI&Oacute;N 
              <?php if (@$_SESSION["descripcion_x_descripcion_Sort"] == "ASC") { ?>
              <img src="images/sortup.gif" width="10" height="9" border="0">
              <?php } elseif (@$_SESSION["documento_x_descripcion_Sort"] == "DESC") { ?>
              <img src="images/sortdown.gif" width="10" height="9" border="0">
              <?php } ?>
              </a> 
              <?php } ?>
              </span></td>
            
      <!--td><span class="phpmaker" style="color: #FFFFFF;">FUNCIONARIO ORIGEN</span></td-->
                  <td></td>
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
/*if (phpmkr_num_rows($rs) > 0) {
	phpmkr_data_seek($rs, $nStartRec -1);
}*/
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
		$sKey = $row["iddocumento"];
		$x_iddocumento = $row["iddocumento"];
		$x_numero = $row["numero"];
		$x_serie = $row["serie"];
		$x_fecha = $row["fecha"];
		//$x_ejecutor = $row["destino"];
		$x_descripcion = $row["descripcion"];
		$x_paginas = $row["paginas"];
		$x_municipio=$row["municipio_idmunicipio"];
?>
          <!-- Table body -->
          <tr<?php echo $sItemRowClass; ?>>
            <td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "documentoeditsal.php?key=" . urlencode($sKey); } else { echo "javascript:alert('REGISTRO NO V�LIDO! LA LLAVE NO PUEDE SER NULA');"; } ?>"> EDITAR</a></td>
            <!-- numero -->
            <td><span class="phpmaker"> <?php echo $x_numero; ?> </span></td>
            <!-- serie -->
            <td><span class="phpmaker"> 
              <?php
if (($x_serie != NULL) && ($x_serie <> "")) {
	$sSqlWrk = "SELECT DISTINCT A.nombre  FROM serie A";
	$sTmp = $x_serie;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (A.idserie = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or error("PROBLEMAS AL EJECUTAR LA B&Uacute;SQUEDA" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_serie = $x_serie; // Backup Original Value
$x_serie = $sTmp;
?>
              <?php echo $x_serie; ?> 
              <?php $x_serie = $ox_serie; // Restore Original Value ?>
              </span></td>
            <!-- fecha -->
            <td><span class="phpmaker"> <?php echo $x_fecha; ?> </span></td>
            <!-- descripcion-->
            <td><span class="phpmaker"> <?php echo $x_descripcion; ?> </span></td>
            <!--td><span class="phpmaker"> 
              <?php   
			  		$fun_origen = busca_filtro_tabla("destino","buzon_entrada","archivo_idarchivo=".$x_iddocumento,"idtransferencia ASC",$conn);
            $sSqlWrk = "SELECT DISTINCT A.nombres,A.apellidos FROM funcionario A";
          	$sTmp = $fun_origen[0]["destino"];
          	$sTmp = addslashes($sTmp);
          	if($sTmp=="")
          	   echo "FUNCIONARIO ORIGEN NO DEFINIDO";
          	else
          	{
          	 $sSqlWrk .= " WHERE A.funcionario_codigo = ".$fun_origen[0]["destino"];
             //echo $sSqlWrk;
             $rswrk = phpmkr_query($sSqlWrk,$conn) or error("PROBLEMAS AL EJECUTAR LA B&Uacute;SQUEDA" . phpmkr_error() . ' SQL:' . $sSqlWrk);
          	 
              if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) 
                 {//print_r($rowwrk); 
            		  $sTmp= $sTmp."-".$rowwrk["nombres"]." ".$rowwrk["apellidos"];
            		  echo $sTmp; 
            		 }
			  		  else
                 echo "FUNCIONARIO ORIGEN NO DEFINIDO";
            }     
					?>
              </span></td-->

            <?php if ($sExport == "") { ?>
            <!--td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "documentoedit.php?key=" . urlencode($sKey); } else { echo "javascript:alert('REGISTRO NO V�LIDO! LA LLEVE NO PUEDE SER NULA');"; } ?>">EDITAR</a></span></td-->
             <!--td><span class="phpmaker"><a href="documentoeditsal.php?key=<?php echo $x_iddocumento ?>">EDITAR</a></span></td-->
             <td><span class="phpmaker"><a href="colilla.php?enlace=documentoview.php?doc=<?php echo $x_iddocumento ?>">RADICADO</a></span></td>
           
            <!--td><span class="phpmaker"><a href="paginalist.php?key_m=<?php echo $x_numero ?>"></a></span></td-->
            <?php } ?> 
          </tr>
          <?php
	}
}
?>
        <!--tr>
        <td align=center colspan=10 bgcolor='#ffffff'><input type=button value="DESPACHAR" onclick="despachar();">
        <input type=hidden id="docs" name="docs" value="">
        </td>
        </tr-->
        </table>
</form>
<?php
// Close recordset and connection
phpmkr_free_result($rs);
?>
<?php if ($sExport == "") { ?>
<form action="documentolistsal.php" name="ewpagerform" id="ewpagerform">
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
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">P&Aacute;GINA&nbsp;</span></td>
<!--first page button-->
	<?php if ($nStartRec == 1) { ?>
	<td><img src="images/firstdisab.gif" alt="PRIMERO" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="documentolistsal.php?start=1"><img src="images/first.gif" alt="PRIMERO" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="images/prevdisab.gif" alt="ANTERIOR" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="documentolistsal.php?start=<?php echo $PrevStart; ?>"><img src="images/prev.gif" alt="ANTERIOR" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="images/nextdisab.gif" alt="SIGUIENTE" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="documentolistsal.php?start=<?php echo $NextStart; ?>"><img src="images/next.gif" alt="SIGUIENTE" width="16" height="16" border="0"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="images/lastdisab.gif" alt="�LTIMO" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="documentolistsal.php?start=<?php echo $LastStart; ?>"><img src="images/last.gif" alt="�LTIMO" width="16" height="16" border="0"></a></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;DE <?php echo intval(($nTotalRecs-1)/$nDisplayRecs+1);?></span></td>
	</tr></table>
	<?php if ($nStartRec > $nTotalRecs) { $nStartRec = $nTotalRecs; }
	$nStopRec = $nStartRec + $nDisplayRecs - 1;
	$nRecCount = $nTotalRecs - 1;
	if ($rsEof) { $nRecCount = $nTotalRecs; }
	if ($nStopRec > $nRecCount) { $nStopRec = $nRecCount; } ?>
	<span class="phpmaker">REGISTROS <?php echo $nStartRec; ?> A <?php echo $nStopRec; ?> DE <?php echo $nTotalRecs; ?></span>
<?php } else { ?>
	<span class="phpmaker">NO SE ENCUENTRAN REGISTROS</span>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php }
//imprime_error();
 ?>
<?php if ($sExport <> "word" && $sExport <> "excel") { ?>
<?php include ("footer.php") ?>
<?php } ?>
<?php

//-------------------------------------------------------------------------------
// Function SetUpAdvancedSearch
// - Set up Advanced Search parameter based on querystring parameters from Advanced Search Page
// - Variables setup: sSrchAdvanced

function SetUpAdvancedSearch()
{
	global $_GET;
	global $sSrchAdvanced;

	// Field iddocumento
	$x_iddocumento = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_iddocumento"]) : @$_GET["x_iddocumento"];
	$arrFldOpr = "";
	$z_iddocumento = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_iddocumento"]) : @$_GET["z_iddocumento"];
	$arrFldOpr = explode(",",$z_iddocumento);
	if ($x_iddocumento <> "") {
		$sSrchAdvanced .= "numero LIKE '%"; // Add field
		//$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_iddocumento) : $x_iddocumento; // Add input parameter
				$sSrchAdvanced .= "%'";
    if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}
/*
	// Field numero
	$x_numero = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_numero"]) : @$_GET["x_numero"];
	$arrFldOpr = "";
	$z_numero = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_numero"]) : @$_GET["z_numero"];
	$arrFldOpr = explode(",",$z_numero);
	if ($x_numero <> "") {
		$sSrchAdvanced .= "numero "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_numero) : $x_numero; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}*/

	// Field serie
	$x_serie = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_serie"]) : @$_GET["x_serie"];
	$arrFldOpr = "";
	$z_serie = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_serie"]) : @$_GET["z_serie"];
	$arrFldOpr = split(",",$z_serie);
	if ($x_serie <> "") {
		$sSrchAdvanced .= "serie "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_serie) : $x_serie; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

// Field dependencia
 $x_dependencia = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_dependencia"]) : @$_GET["x_dependencia"];
	$arrFldOpr = "";
//	echo($x_dependencia);
	$z_dependencia = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_dependencia"]) : @$_GET["z_dependencia"];
	$arrFldOpr = split(",",$z_dependencia);
	if ($x_dependencia <> "") {
		$sSrchAdvanced .= "entregado= "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= "'D(".$x_dependencia.")'"; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}
 
	// Field fecha
/*	$x_fecha = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_fecha"]) : @$_GET["x_fecha"];
	$arrFldOpr = "";
	$z_fecha = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_fecha"]) : @$_GET["z_fecha"];
	$arrFldOpr = split(",",$z_fecha);
	if ($x_fecha <> "") {
		$sSrchAdvanced .= "documento.fecha LIKE "; // Add field
		//$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_fecha) : $x_fecha; // Add input parameter
			$sSrchAdvanced .= "%";
  	if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	} */
	
		// Field fecha_ingreso
	$x_fecha_ingreso = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_fecha_ingreso"]) : @$_GET["x_fecha_ingreso"];
	$arrFldOpr = "";
	$z_fecha_ingreso = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_fecha_ingreso"]) : @$_GET["z_fecha_ingreso"];
	$arrFldOpr = split(",",$z_fecha_ingreso);
	if ($x_fecha_ingreso <> "") {
		$sSrchAdvanced .= "A.fecha "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_fecha_ingreso) : $x_fecha_ingreso; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}
	$y_fecha_ingreso = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["y_fecha_ingreso"]) : @$_GET["y_fecha_ingreso"];
	$w_fecha_ingreso = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["w_fecha_ingreso"]) : @$_GET["w_fecha_ingreso"];
	$arrFldOpr = split(",",$w_fecha_ingreso);
	if (($y_fecha_ingreso <> "")) {
		$sSrchAdvanced .= "A.fecha " . @$arrFldOpr[0] . " " . @$arrFldOpr[1] . $y_fecha_ingreso . @$arrFldOpr[2] . " AND ";
	}

	// Field ejecutor
	$x_ejecutor = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_ejecutor"]) : @$_GET["x_ejecutor"];
	$arrFldOpr = "";
	$z_ejecutor = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_ejecutor"]) : @$_GET["z_ejecutor"];
	$arrFldOpr = split(",",$z_ejecutor);
	if ($x_ejecutor <> "") {
		$sSrchAdvanced .= "ejecutor_destino "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_ejecutor) : $x_ejecutor; // Add input parameter
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

	// Field paginas
	/*$x_descripcion = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_descripcion"]) : @$_GET["x_descripcion"];
	$arrFldOpr = "";
	$z_descrpcion = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_descripcion"]) : @$_GET["z_descripcion"];
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
	}*/
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
	$BasicSearchSQL.= "numero LIKE '%" . $sKeyword . "%' OR ";
	if (substr($BasicSearchSQL, -4) == " OR ") { $BasicSearchSQL = substr($BasicSearchSQL, 0, strlen($BasicSearchSQL)-4); }
	return $BasicSearchSQL;
}

//-------------------------------------------------------------------------------
// Function SetUpBasicSearch
// - Set up Basic Search parameter based on form elements pSearch & pSearchType
// - Variables setup: sSrchBasic

function SetUpBasicSearch()
{
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
{
	global $_SESSION;
	global $_GET;
	global $sOrderBy;
	global $sDefaultOrderBy;
	
	// Check for an Order parameter
	if (strlen(@$_GET["order"]) > 0) {
		$sOrder = @$_GET["order"];

		// Field numero
		if ($sOrder == "numero") {
			$sSortField = "numero";
			$sLastSort = @$_SESSION["documento_x_numero_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["documento_x_numero_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["documento_x_numero_Sort"] <> "") { @$_SESSION["documento_x_numero_Sort"] = ""; }
		}

		// Field serie
		if ($sOrder == "serie") {
			$sSortField = "serie";
			$sLastSort = @$_SESSION["documento_x_serie_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["documento_x_serie_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["documento_x_serie_Sort"] <> "") { @$_SESSION["documento_x_serie_Sort"] = ""; }
		}

		// Field fecha
		if ($sOrder == "fecha") {
			$sSortField = "A.fecha";
			$sLastSort = @$_SESSION["documento_x_fecha_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["documento_x_fecha_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["documento_x_fecha_Sort"] <> "") { @$_SESSION["documento_x_fecha_Sort"] = ""; }
		}

		// Field ejecutor
		if ($sOrder == "ejecutor") {
			$sSortField = "ejecutor";
			$sLastSort = @$_SESSION["documento_x_ejecutor_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["documento_x_ejecutor_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["documento_x_ejecutor_Sort"] <> "") { @$_SESSION["documento_x_ejecutor_Sort"] = ""; }
		}

		// Field descripcion
		if ($sOrder == "descripcion") {
			$sSortField = "descripcion";
			$sLastSort = @$_SESSION["documento_x_descripcion_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["documento_x_descripcion_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["documento_x_descripcion_Sort"] <> "") { @$_SESSION["documento_x_dexcripcion_Sort"] = ""; }
		}
		$_SESSION["documento_OrderBy"] = $sSortField . " " . $sThisSort;
		$_SESSION["documento_REC"] = 1;
	}
	$sOrderBy = @$_SESSION["documento_OrderBy"];
	if ($sOrderBy == "") {
		$sOrderBy = $sDefaultOrderBy;
		$_SESSION["documento_OrderBy"] = $sOrderBy;
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
		$_SESSION["documento_REC"] = $nStartRec;
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
			$_SESSION["documento_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["documento_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["documento_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["documento_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["documento_REC"] = $nStartRec;
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
			$_SESSION["documento_searchwhere"] = $sSrchWhere;

		// Reset Search Criteria & Session Keys
		}
		elseif (strtoupper($sCmd) == "RESETALL") {
			$sSrchWhere = "";
			$_SESSION["documento_searchwhere"] = $sSrchWhere;

		// Reset Sort Criteria
		}
		elseif (strtoupper($sCmd) == "RESETSORT") {
			$sOrderBy = "";
			$_SESSION["documento_OrderBy"] = $sOrderBy;
			if (@$_SESSION["documento_x_numero_Sort"] <> "") { $_SESSION["documento_x_numero_Sort"] = ""; }
			if (@$_SESSION["documento_x_serie_Sort"] <> "") { $_SESSION["documento_x_serie_Sort"] = ""; }
			if (@$_SESSION["documento_x_fecha_Sort"] <> "") { $_SESSION["documento_x_fecha_Sort"] = ""; }
			if (@$_SESSION["documento_x_ejecutor_Sort"] <> "") { $_SESSION["documento_x_ejecutor_Sort"] = ""; }
			if (@$_SESSION["documento_x_descripcion_Sort"] <> "") { $_SESSION["documento_x_descripcion_Sort"] = ""; }
		}

		// Reset Start Position (Reset Command)
		$nStartRec = 1;
		$_SESSION["documento_REC"] = $nStartRec;
	}
}
?>
<script>
function despachar()
  {var elementos=0;
   var docs="";
   for(i=0;i<document.getElementById("form1").elements.length;i=i+1)
    {var objeto=document.getElementById("form1").elements[i];
     if(objeto.checked==true && objeto.name.indexOf("despachar_")==0)
        {docs+=objeto.name.substring(objeto.name.indexOf("_")+1,objeto.name.length)+",";
         elementos+=1;
        }
    }
   if(elementos==0)
    {alert("Seleccione por lo menos un documento.")}
   else 
    {document.getElementById("docs").value=docs;
     document.getElementById("form1").submit();
    }
  }
</script>
