<?php include_once("db.php") ?>
<?php
//sesion();
// Initialize common variables
$x_idruta = Null;
$x_origen = Null;
$x_tipo = Null;
$x_destino = Null;
$x_tipo_documental_idtipo_documental = Null;
$x_doc = Null;
$x_condicion_transferencia = Null;
$x_tipo_origen = Null;
$x_tipo_destino = Null;
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
$nDisplayRecs = 20;
$nRecRange = 10;

// Handle Reset Command
ResetCmd();

// Get Search Criteria for Advanced Search
SetUpAdvancedSearch();
$id_dependencia =  @$_GET["dependencia"];
if(isset($_POST["accion"]))
{
  if($_POST["accion"]=="buzones")
  {
    buzones($_POST["documento"]);
    $sql="SELECT serie FROM documento WHERE iddocumento=".$_POST["documento"];
    $rs = phpmkr_query($sql,$conn) or error("Fall� al Ejecutar la B&Uacute;SQUEDA" . phpmkr_error() . ' SQL:' . $sql);
    $row = @phpmkr_fetch_array($rs);
    $opcionserie=$row["serie"];
    switch($opcionserie)
    {
      case 555:
          redirecciona("factura/mostrar_carta.php?iddoc=".$_POST["documento"]);
        break;
      case 666:
          redirecciona("factura/mostrar_memorando.php?iddoc=".$_POST["documento"]);
        break;
      case 777:
          redirecciona("factura/mostrar_certificado.php?iddoc=".$_POST["documento"]);
        break;
    }
  }
}
if(isset($_GET["doc"]))
{
  $id_documento =  $_GET["doc"];
}
else
  $id_documento = 0;
  
if(isset($_GET["serie"]))
  $idserie=$_GET["serie"];
else
  $idserie=0;

// Build Search Criteria
if ($sSrchAdvanced != "") {
	$sSrchWhere = $sSrchAdvanced; // Advanced Search
}
elseif ($sSrchBasic != "") {
	$sSrchWhere = $sSrchBasic; // Basic Search
}

// Save Search Criteria
if ($sSrchWhere != "") {
	$_SESSION["ruta_searchwhere"] = $sSrchWhere;

	// Reset start record counter (new search)
	$nStartRec = 1;
	$_SESSION["ruta_REC"] = $nStartRec;
}
else
{
	$sSrchWhere = @$_SESSION["ruta_searchwhere"];
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
$sSql = "SELECT * FROM ruta";

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
if($id_documento <> 0)
  if($sWhere <> "")
    $sWhere .= " AND documento_iddocumento =".$id_documento;
  else
    $sWhere = "documento_iddocumento =".$id_documento;
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
if($id_documento <> 0)
  if($sOrderBy != "")
    $sOrderBy .= ",orden";
  else
    $sOrderBy = "orden";
if ($sOrderBy != "") {
	$sSql .= " ORDER BY " . $sOrderBy;
}
//echo $sSql;
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
$rs = phpmkr_query($sSql,$conn) or error("Fall� al Ejecutar la B&Uacute;SQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
$nTotalRecs = phpmkr_num_rows($rs);
if ($nDisplayRecs <= 0) { // Display All Records
	$nDisplayRecs = $nTotalRecs;
}
$nStartRec = 1;
SetUpStartRec(); // Set Up Start Record Position
?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/ruta.gif" border="0">&nbsp;&nbsp;RUTA DE LOS DOCUMENTOS
</span></p>
<form action="rutalist.php" method="post">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><span class="phpmaker">
			<a href="rutalist.php?cmd=reset">Mostrar Todo</a>&nbsp;&nbsp;
			<a href="rutasrch.php">B&uacute;squeda  Avanzada</a>
		</span></td>
	</tr>
</table>
<?php
	if($id_documento<>0)
	{
	?>
	<input type="hidden" name="accion" value="buzones">
	<input type="hidden" name="serie" value="<?php echo $idserie;?>">
  <input type="hidden" name="documento" value="<?php echo $id_documento;?>">
  <br><input type="submit" value="CONTINUAR">
	<?php 
  }
  ?>
</form>
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><span class="phpmaker">
		<?php 
    if($id_documento==0)
    {
    ?>
    <a href="rutaadd.php">
    <?php 
    }
    else{
    ?>
    <a href="rutaadd.php?doc=<?php echo $id_documento;?>">
    <?php 
    }
    ?>
    Adicionar</a></span></td>
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
		<!--td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="rutalist.php?order=<?php echo urlencode("idruta"); ?>" style="color: #FFFFFF;">idruta<?php if (@$_SESSION["ruta_x_idruta_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["ruta_x_idruta_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td-->
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="rutalist.php?order=<?php echo urlencode("origen"); ?>" style="color: #FFFFFF;">origen<?php if (@$_SESSION["ruta_x_origen_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["ruta_x_origen_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="rutalist.php?order=<?php echo urlencode("tipo"); ?>" style="color: #FFFFFF;">tipo<?php if (@$_SESSION["ruta_x_tipo_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["ruta_x_tipo_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="rutalist.php?order=<?php echo urlencode("destino"); ?>" style="color: #FFFFFF;">destino<?php if (@$_SESSION["ruta_x_destino_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["ruta_x_destino_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="rutalist.php?order=<?php echo urlencode("tipo_documental_idtipo_documental"); ?>" style="color: #FFFFFF;">tipo documental idtipo documental<?php if (@$_SESSION["ruta_x_tipo_documental_idtipo_documental_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["ruta_x_tipo_documental_idtipo_documental_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="rutalist.php?order=<?php echo urlencode("condicion_transferencia"); ?>" style="color: #FFFFFF;">condicion transferencia<?php if (@$_SESSION["ruta_x_condicion_transferencia_Sort"] == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["ruta_x_condicion_transferencia_Sort"] == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	Documento Asociado</span></td>		
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
		$sKey = $row["idruta"];
		$x_idruta = $row["idruta"];
		$x_origen = $row["origen"];
		$x_tipo = $row["tipo"];
		$x_destino = $row["destino"];
		$x_tipo_documental_idtipo_documental = $row["tipo_documental_idtipo_documental"];
		$x_condicion_transferencia = $row["condicion_transferencia"];
		$x_doc=$row["documento_iddocumento"];
		$x_tipo_origen=$row["tipo_origen"];
		$x_tipo_destino=$row["tipo_destino"];
?>
	<!-- Table body -->
	<tr<?php echo $sItemRowClass; ?>>
		<!-- idruta -->
		<!--td><span class="phpmaker">
<?php echo $x_idruta; ?>
</span></td-->
		<!-- origen -->
		<td><span class="phpmaker">
<?php
if (($x_origen != NULL) && ($x_origen <> "")) 
{
 echo nodo_ruta($x_tipo_origen,$x_origen);
}
/*if (($x_origen != NULL) && ($x_origen <> "")) {
$sTmp = $x_origen;
$temp="cargo no definido";
$funcionario=busca_tabla("dependencia_cargo",$x_origen);
//imprime_error();
if ($funcionario["numcampos"]) {  
//print_r($funcionario);
$dependencia=busca_tabla("dependencia",$funcionario[0]['dependencia_iddependencia']);
$cargo=busca_tabla("cargo2",$funcionario[0]['cargo_idcargo']);
    $temp = $cargo[0]["nombre"]."-".$dependencia[0]['nombre'];  
	}
}*/
?>
<?php //echo $temp; ?>
</span></td>
		<!-- tipo -->
		<td><span class="phpmaker">
<?php
switch ($x_tipo) {
	case "ACTIVO":
		$sTmp = "ACTIVO";
		break;
	case "INACTIVO":
		$sTmp = "INACTIVO";
		break;
	default:
		$sTmp = "";
}
$ox_tipo = $x_tipo; // Backup Original Value
$x_tipo = $sTmp;
?>
<?php echo $x_tipo; ?>
<?php $x_tipo = $ox_tipo; // Restore Original Value ?>
</span></td>
		<!-- destino -->
		<td><span class="phpmaker">
<?php
if (($x_destino != NULL) && ($x_destino <> "")) 
{
 echo nodo_ruta($x_tipo_destino,$x_destino);
} 
/*if (($x_destino != NULL) && ($x_destino <> "")) {
$sTmp = $x_destino;
$temp="cargo no definido";
$funcionario=busca_tabla("dependencia_cargo",$x_destino);
//imprime_error();
if ($funcionario["numcampos"]) {
$dependencia=busca_tabla("dependencia",$funcionario[0]['dependencia_iddependencia']);
$cargo=busca_tabla("cargo2",$funcionario[0]['cargo_idcargo']);
  if($cargo["numcampos"])
    $temp = $cargo[0]["nombre"];
  if($dependencia["numcampos"])  
    $temp.="-".$dependencia[0]['nombre'];  
	}
}*/
?>
<?php //echo $temp; ?>
</span></td>
		<!-- tipo_documental_idtipo_documental -->
		<td><span class="phpmaker">
<?php
if (($x_tipo_documental_idtipo_documental != NULL) && ($x_tipo_documental_idtipo_documental <> "")) {
	$sSqlWrk = "SELECT DISTINCT *  FROM serie";
	$sTmp = $x_tipo_documental_idtipo_documental;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (idserie = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Fall� al Ejecutar la B&Uacute;SQUEDA" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		//$sTmp = $rowwrk["idserie"];
		$sTmp = $rowwrk["nombre"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_tipo_documental_idtipo_documental = $x_tipo_documental_idtipo_documental; // Backup Original Value
$x_tipo_documental_idtipo_documental = $sTmp;
?>
<?php echo $x_tipo_documental_idtipo_documental; ?>
<?php $x_tipo_documental_idtipo_documental = $ox_tipo_documental_idtipo_documental; // Restore Original Value ?>
</span></td>
		<!-- condicion_transferencia -->
		<td><span class="phpmaker">
<?php
switch ($x_condicion_transferencia) {
	case "RECEPCION":
		$sTmp = "RECEPCION";
		break;
	case "PRODUCCION":
		$sTmp = "PRODUCCION";
		break;
	case "DISTRIBUCION":
		$sTmp = "DISTRIBUCION";
		break;
	case "CONSULTA":
		$sTmp = "CONSULTA";
		break;
	case "RETENCION":
		$sTmp = "RETENCION";
		break;
	case "ALMACENAMIENTO":
		$sTmp = "ALMACENAMIENTO";
		break;
	case "RECUPERACION":
		$sTmp = "RECUPERACION";
		break;
	case "PRESERVACION":
		$sTmp = "PRESERVACION";
		break;
	case "DISPOSICION FINAL":
		$sTmp = "DISPOSICION FINAL";
		break;
	case "REVISADO":
		$sTmp = "REVISADO";
		break;
	case "APROBADO":
		$sTmp = "APROBADO";
		break;
	default:
		$sTmp = "";
}
$ox_condicion_transferencia = $x_condicion_transferencia; // Backup Original Value
$x_condicion_transferencia = $sTmp;
?>
<?php echo $x_condicion_transferencia; ?>
<?php $x_condicion_transferencia = $ox_condicion_transferencia; // Restore Original Value ?>
</span></td>
		<!-- Documento asociado -->
		<td><span class="phpmaker">
		<?php if($x_doc!=NULL) 
      $ldoc=busca_tabla('documento',$x_doc);
    if(isset($ldoc) && $ldoc['numcampos'])
    echo(delimita($ldoc[0]['iddocumento']."-".$ldoc[0]['descripcion'],100));?>
</span></td>
<td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "rutaview.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Registro Incorrecto! Llave no Existe');";  } ?>">Ver</a></span></td>
<td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "rutaedit.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Registro Incorrecto! Llave no Existe');"; } ?>">Editar</a></span></td>
<!--td><span class="phpmaker"><a href="<?php if (($sKey != NULL)) { echo "rutadelete.php?key=" . urlencode($sKey); } else { echo "javascript:alert('Registro Incorrecto! Llave no Existe');"; }  ?>">Borrar</a></span></td-->
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
<form action="rutalist.php" name="ewpagerform" id="ewpagerform">
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
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="rutalist.php?start=1"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="rutalist.php?start=<?php echo $PrevStart; ?>"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="rutalist.php?start=<?php echo $NextStart; ?>"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="images/lastdisab.gif" alt="�ltimo" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="rutalist.php?start=<?php echo $LastStart; ?>"><img src="images/last.gif" alt="�ltimo" width="16" height="16" border="0"></a></td>
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
	<span class="phpmaker">Registros no Encontrados</span>
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
	global $_GET;
	global $sSrchAdvanced;

	// Field idruta
	$x_idruta = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_idruta"]) : @$_GET["x_idruta"];
	$arrFldOpr = "";
	$z_idruta = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_idruta"]) : @$_GET["z_idruta"];
	$arrFldOpr = preg_split("/,/",$z_idruta);
	if ($x_idruta <> "") {
		$sSrchAdvanced .= "idruta "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_idruta) : $x_idruta; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field origen
	$x_origen = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_origen"]) : @$_GET["x_origen"];
	$arrFldOpr = "";
	$z_origen = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_origen"]) : @$_GET["z_origen"];
	$arrFldOpr = preg_split("/,/",$z_origen);
	if ($x_origen <> "") {
		$sSrchAdvanced .= "origen "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_origen) : $x_origen; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field tipo
	$x_tipo = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_tipo"]) : @$_GET["x_tipo"];
	$arrFldOpr = "";
	$z_tipo = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_tipo"]) : @$_GET["z_tipo"];
	$arrFldOpr = preg_split("/,/",$z_tipo);
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

	// Field destino
	$x_destino = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_destino"]) : @$_GET["x_destino"];
	$arrFldOpr = "";
	$z_destino = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_destino"]) : @$_GET["z_destino"];
	$arrFldOpr = preg_split("/,/",$z_destino);
	if ($x_destino <> "") {
		$sSrchAdvanced .= "destino "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_destino) : $x_destino; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field tipo_documental_idtipo_documental
	$x_tipo_documental_idtipo_documental = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_tipo_documental_idtipo_documental"]) : @$_GET["x_tipo_documental_idtipo_documental"];
	$arrFldOpr = "";
	$z_tipo_documental_idtipo_documental = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_tipo_documental_idtipo_documental"]) : @$_GET["z_tipo_documental_idtipo_documental"];
	$arrFldOpr = preg_split("/,/",$z_tipo_documental_idtipo_documental);
	if ($x_tipo_documental_idtipo_documental <> "") {
		$sSrchAdvanced .= "tipo_documental_idtipo_documental "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_tipo_documental_idtipo_documental) : $x_tipo_documental_idtipo_documental; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field Documento
	$x_doc = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_doc"]) : @$_GET["x_doc"];
	$arrFldOpr = "";
	$z_doc = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_doc"]) : @$_GET["z_doc"];
	$arrFldOpr = preg_split("/,/",$z_doc);
	if ($x_doc <> "") {
		$sSrchAdvanced .= "documento_iddocumento "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_doc) : $x_doc; // Add input parameter
		if (count($arrFldOpr) >=2) {
			$sSrchAdvanced .= @$arrFldOpr[2]; // Add search suffix
		}
		$sSrchAdvanced .= " AND ";
	}

	// Field condicion_transferencia
	$x_condicion_transferencia = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["x_condicion_transferencia"]) : @$_GET["x_condicion_transferencia"];
	$arrFldOpr = "";
	$z_condicion_transferencia = (get_magic_quotes_gpc()) ? stripslashes(@$_GET["z_condicion_transferencia"]) : @$_GET["z_condicion_transferencia"];
	$arrFldOpr = preg_split("/,/",$z_condicion_transferencia);
	if ($x_condicion_transferencia <> "") {
		$sSrchAdvanced .= "condicion_transferencia "; // Add field
		$sSrchAdvanced .= @$arrFldOpr[0] . " "; // Add operator
		if (count($arrFldOpr) >= 1) {
			$sSrchAdvanced .= @$arrFldOpr[1]; // Add search prefix
		}
		$sSrchAdvanced .= (!get_magic_quotes_gpc()) ? addslashes($x_condicion_transferencia) : $x_condicion_transferencia; // Add input parameter
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
	global $_SESSION;
	global $_GET;
	global $sOrderBy;
	global $sDefaultOrderBy;

	// Check for an Order parameter
	if (strlen(@$_GET["order"]) > 0) {
		$sOrder = @$_GET["order"];

		// Field idruta
		if ($sOrder == "idruta") {
			$sSortField = "idruta";
			$sLastSort = @$_SESSION["ruta_x_idruta_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["ruta_x_idruta_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["ruta_x_idruta_Sort"] <> "") { @$_SESSION["ruta_x_idruta_Sort"] = ""; }
		}

		// Field origen
		if ($sOrder == "origen") {
			$sSortField = "origen";
			$sLastSort = @$_SESSION["ruta_x_origen_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["ruta_x_origen_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["ruta_x_origen_Sort"] <> "") { @$_SESSION["ruta_x_origen_Sort"] = ""; }
		}

		// Field tipo
		if ($sOrder == "tipo") {
			$sSortField = "tipo";
			$sLastSort = @$_SESSION["ruta_x_tipo_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["ruta_x_tipo_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["ruta_x_tipo_Sort"] <> "") { @$_SESSION["ruta_x_tipo_Sort"] = ""; }
		}

		// Field destino
		if ($sOrder == "destino") {
			$sSortField = "destino";
			$sLastSort = @$_SESSION["ruta_x_destino_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["ruta_x_destino_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["ruta_x_destino_Sort"] <> "") { @$_SESSION["ruta_x_destino_Sort"] = ""; }
		}

		// Field tipo_documental_idtipo_documental
		if ($sOrder == "tipo_documental_idtipo_documental") {
			$sSortField = "tipo_documental_idtipo_documental";
			$sLastSort = @$_SESSION["ruta_x_tipo_documental_idtipo_documental_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["ruta_x_tipo_documental_idtipo_documental_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["ruta_x_tipo_documental_idtipo_documental_Sort"] <> "") { @$_SESSION["ruta_x_tipo_documental_idtipo_documental_Sort"] = ""; }
		}

		// Field condicion_transferencia
		if ($sOrder == "condicion_transferencia") {
			$sSortField = "condicion_transferencia";
			$sLastSort = @$_SESSION["ruta_x_condicion_transferencia_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["ruta_x_condicion_transferencia_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["ruta_x_condicion_transferencia_Sort"] <> "") { @$_SESSION["ruta_x_condicion_transferencia_Sort"] = ""; }
		}
		$_SESSION["ruta_OrderBy"] = $sSortField . " " . $sThisSort;
		$_SESSION["ruta_REC"] = 1;
	}
	$sOrderBy = @$_SESSION["ruta_OrderBy"];
	if ($sOrderBy == "") {
		$sOrderBy = $sDefaultOrderBy;
		$_SESSION["ruta_OrderBy"] = $sOrderBy;
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
		$_SESSION["ruta_REC"] = $nStartRec;
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
			$_SESSION["ruta_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["ruta_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["ruta_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["ruta_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["ruta_REC"] = $nStartRec;
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
			$_SESSION["ruta_searchwhere"] = $sSrchWhere;

		// Reset Search Criteria & Session Keys
		}
		elseif (strtoupper($sCmd) == "RESETALL") {
			$sSrchWhere = "";
			$_SESSION["ruta_searchwhere"] = $sSrchWhere;

		// Reset Sort Criteria
		}
		elseif (strtoupper($sCmd) == "RESETSORT") {
			$sOrderBy = "";
			$_SESSION["ruta_OrderBy"] = $sOrderBy;
			if (@$_SESSION["ruta_x_idruta_Sort"] <> "") { $_SESSION["ruta_x_idruta_Sort"] = ""; }
			if (@$_SESSION["ruta_x_origen_Sort"] <> "") { $_SESSION["ruta_x_origen_Sort"] = ""; }
			if (@$_SESSION["ruta_x_tipo_Sort"] <> "") { $_SESSION["ruta_x_tipo_Sort"] = ""; }
			if (@$_SESSION["ruta_x_destino_Sort"] <> "") { $_SESSION["ruta_x_destino_Sort"] = ""; }
			if (@$_SESSION["ruta_x_tipo_documental_idtipo_documental_Sort"] <> "") { $_SESSION["ruta_x_tipo_documental_idtipo_documental_Sort"] = ""; }
			if (@$_SESSION["ruta_x_condicion_transferencia_Sort"] <> "") { $_SESSION["ruta_x_condicion_transferencia_Sort"] = ""; }
		}

		// Reset Start Position (Reset Command)
		$nStartRec = 1;
		$_SESSION["ruta_REC"] = $nStartRec;
	}
}

function buzones($iddoc)
{
  global $conn;
  $sSql="SELECT * FROM ruta WHERE documento_iddocumento = ".$iddoc." ORDER BY orden";
  $rutas = phpmkr_query($sSql,$conn) or error("Fall� al Ejecutar la B&Uacute;SQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
  while ($row = @phpmkr_fetch_array($rutas)) 
  {
    $insert="INSERT INTO buzon_entrada(archivo_idarchivo, nombre, destino, tipo_destino, origen, tipo) VALUES(".$iddoc.",'PENDIENTE',".$row["origen"].",1,".$row["destino"].", 'DOCUMENTO')";
    phpmkr_query($insert,$conn) or error("Fall� al Ejecutar la B&Uacute;SQUEDA" . phpmkr_error() . ' SQL:' . $insert);
  }
  phpmkr_free_result($rutas);
}
?>
