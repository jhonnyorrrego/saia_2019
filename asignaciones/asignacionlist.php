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

// Initialize common variables
$x_idasignacion = Null;
$x_tarea_idtarea = Null;
$x_fecha_inicial = Null;
$x_fecha_final = Null;
$x_documento_iddocumento = Null;
$x_serie_idserie = Null;
$x_estado = Null;
$x_entidad_identidad = Null;
$x_llave_entidad = Null;
$x_reprograma = Null;
$x_tipo_reprograma = Null;
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
$nDisplayRecs = 8;
$nRecRange = 4;

// Open connection to the database


// Handle Reset Command
ResetCmd();

//print_r($_REQUEST);

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

if(isset($_REQUEST['modo'])&&$_REQUEST['modo']=="administrador")
  {
      $modo="administrador";
    }
else 
{
      $modo="usuario";
      $cod_usuario=usuario_actual("funcionario_codigo");
      
  }

// Build SQL
$sSql = "SELECT * FROM asignacion";

// Load Default Filter
if($modo=="usuario") // ASIGNACIONES SOLO VISIBLES AL USUARIO
  $sDefaultFilter =" tarea_idtarea <> '2' AND tarea_idtarea <>1 AND llave_entidad=".$cod_usuario." AND entidad_identidad=1";
else 
 $sDefaultFilter = " tarea_idtarea <> '2' AND tarea_idtarea <>1 ";
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

$row=busca_filtro_tabla("","asignacion",$sWhere,"idasignacion DESC",$conn);

if ($nDisplayRecs <= 0) { // Display All Records
	$nDisplayRecs = $nTotalRecs;
}
$nStartRec = 0;
$nTotalRecs=$row["numcampos"];

SetUpStartRec(); // Set Up Start Record Position
//echo $nStartRec;
//print_r($row);die();
//die($sSql);
// Set Up Sorting Order
$sOrderBy = "";
SetUpSortOrder();

?>
<?php include ("../header.php") ?>
<br /><b>TAREAS</B><br /><br />
<?php 
if($modo=="administrador")
 echo  '<a href="asignaciontermina_list.php" target="centro">Asignaciones Terminadas</a> ';

?>

<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<?php

// Set up Record Set

//$rs = phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
//$nTotalRecs = phpmkr_num_rows($rs);

?>
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
	<tr class="encabezado">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	         DESCRIPCI&Oacute;N
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="asignacionlist.php?order=<?php echo urlencode("fecha_inicial"); ?>" style="color: #FFFFFF;">FECHA INICIAL<?php if (@$_SESSION["asignacion_x_fecha_inicial_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["asignacion_x_fecha_inicial_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="asignacionlist.php?order=<?php echo urlencode("fecha_final"); ?>" style="color: #FFFFFF;">FECHA FINAL<?php if (@$_SESSION["asignacion_x_fecha_final_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["asignacion_x_fecha_final_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="asignacionlist.php?order=<?php echo urlencode("documento_iddocumento"); ?>" style="color: #FFFFFF;">PROCESO ASOCIADO<?php if (@$_SESSION["asignacion_x_documento_iddocumento_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["asignacion_x_documento_iddocumento_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="asignacionlist.php?order=<?php echo urlencode("estado"); ?>" style="color: #FFFFFF;">ESTADO<?php if (@$_SESSION["asignacion_x_estado_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["asignacion_x_estado_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
	<a href="asignacionlist.php?order=<?php echo urlencode("llave_entidad"); ?>" style="color: #FFFFFF;">RESPONSABLE<?php if (@$_SESSION["asignacion_x_llave_entidad_Sort"] == "ASC") { ?><img src="../images/sortup.gif" width="10" height="9" border="0"><?php } elseif (@$_SESSION["asignacion_x_llave_entidad_Sort"] == "DESC") { ?><img src="../images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
		</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
		REPROGRACI&Oacute;N
		</span></td>
		<td>&nbsp;</td>
<?php if($modo=="administrador") echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>"; ?>

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
//$nRecActual = 0;

//while (($row = @phpmkr_fetch_array($rs)) && ($nRecCount < $nStopRec))
if($nTotalRecs>0) // Previene mostrar datos si no hay registros
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

		// Load Key for record
		//print_r($row);
		$sKey = $row[$i]["idasignacion"];
		$x_descripcion = $row[$i]["descripcion"];
		$x_idasignacion = $row[$i]["idasignacion"];
		$x_tarea_idtarea = $row[$i]["tarea_idtarea"];
		$x_fecha_inicial = $row[$i]["fecha_inicial"];
		$x_fecha_final = $row[$i]["fecha_final"];
		$x_documento_iddocumento = $row[$i]["documento_iddocumento"];
		$x_serie_idserie = $row[$i]["serie_idserie"];
		$x_estado = $row[$i]["estado"];
		$x_entidad_identidad = $row[$i]["entidad_identidad"];
		$x_llave_entidad = $row[$i]["llave_entidad"];
		$x_reprograma = $row[$i]["reprograma"];
		$x_tipo_reprograma = $row[$i]["tipo_reprograma"];

		$fecha_act=date("Y-m-d H:i:s");
		//echo $x_fecha_inicial;
		$color="f3f3f3";
		if($fecha_act>$x_fecha_final)
		  {
			  $estado_general="VENCIDA";
			  $color="FF3333";
		  }
		else 
		 {
		       if($fecha_act>$x_fecha_inicial)
			{
			   $color="FFFF66";
			   $estado_general="EN EJECUCION";
			}
		       else 
		        {
		           $color="99FF66";
			   $estado_general="PENDIENTE";
		       
		        }
		 }
                 		
		if($x_documento_iddocumento!="")
		 {
		   $doc=busca_filtro_tabla("","documento","documento.iddocumento=".$x_documento_iddocumento,"",$conn);
		
		   if($doc["numcampos"])
			   {
				   
          $formato=busca_filtro_tabla("etiqueta","formato","formato.nombre='".$doc[0]["plantilla"]."'","",$conn);
			    if($formato["numcampos"]>0)
			       {
				 $datosplantilla=$formato[0]["etiqueta"]; // Encontro el formato asociado
			       }
			      else
			       {
				 $datosplantilla=$documento[0]["plantilla"];
			       }
			      $doc_datos='<a href="../ordenar.php?key='.$doc[0]["iddocumento"].'" target="centro">'.$doc[0]["descripcion"]." (".$datosplantilla.")</a>";
			   }
	           else 
                    $doc_datos="--";  		   
		 }
	      	
		if($x_entidad_identidad==1)
		 {
		   $func=busca_filtro_tabla("funcionario.nombres,funcionario.login","funcionario","funcionario_codigo=".$x_llave_entidad,"",$conn);
		   
		   if($func["numcampos"])
			   {
			      $resp=$func[0]["nombres"]." (".$func[0]["login"].")";
			   }
	           else 
                    $resp="--";  		   
		 }
		 
$patrones=array("day","month","year","hour","minute","second");
$reemplazar=array("dia","mes","a&ntilde;o","hora","minuto","segundo");
$x_tipo_reprograma=str_replace($patrones,$reemplazar,$x_tipo_reprograma);
if($x_reprograma!=NULL&&$x_reprograma!=0) 
 $reprogramacion = $x_reprograma ." ". $x_tipo_reprograma."(s)";
else 
 $reprogramacion = "No se reprograma";

?>
	


<!-- Table body -->
	<tr<?php echo $sItemRowClass; ?>>
<!-- descripcion -->
<td><span class="phpmaker">
<?php echo $x_descripcion; ?>
</span></td>		
		<!-- fecha_inicial -->
		<td><span class="phpmaker">
<?php echo $x_fecha_inicial; ?>
</span></td>
		<!-- fecha_final -->
		<td><span class="phpmaker">
<?php echo $x_fecha_final; ?>
</span></td>
		<!-- documento_iddocumento -->
		<td><span class="phpmaker">
<?php echo $doc_datos; ?>
</span></td>
		<!-- estado -->
		<td bgcolor="#<?php echo $color; ?>"><span >
<?php echo $estado_general; ?>
</span></td>
		<!-- llave_entidad -->
		<td><span class="phpmaker">
<?php echo $resp; ?>
</span></td>
		
		<!-- tipo_reprograma -->
		<td><span class="phpmaker">
<?php echo $reprogramacion; ?>
</span></td>
<?php if($modo=="administrador") // Restringe acciones sobre las asignaciones
{
  ///// Eliminacion	
        echo "<td><span class=\"phpmaker\"><a href=\"";
	if (($sKey != NULL)) 
	    { echo "parsea_accion_asignacion.php?modo=".$modo."&accion=eliminar&key=" . urlencode($sKey)."\""; } 
	else { echo "javascript:alert('Invalid Record! Key is null');"."\"";  } 
	echo "  target=\"frcontrol\">Eliminar</a></span></td>";

 ///// Editar	
        echo "<td><span class=\"phpmaker\"><a href=\"";
	if (($sKey != NULL)) 
	    { echo "parsea_accion_asignacion.php?modo=".$modo."&accion=editar&key=" . urlencode($sKey)."\""; } 
	else { echo "javascript:alert('Invalid Record! Key is null');"."\"";  } 
	echo "  target=\"frcontrol\">Editar</a></span></td>";
	
 ///// Control	
	echo "<td><span class=\"phpmaker\"><a href=\"";
	if (($sKey != NULL)) 
	    { echo "control_list.php?modo=".$modo."&idasignacion=" . urlencode($sKey)."\""; } 
	else { echo "javascript:alert('Invalid Record! Key is null');"."\"";  } 
	echo "  target=\"frcontrol\">Control Asociado</a></span></td>";
	
}
 //// Ejecutar
        echo "<td><span class=\"phpmaker\"><a href=\"";
	if (($sKey != NULL)) 
	    { echo "parsea_accion_asignacion.php?modo=".$modo."&accion=completar&key=" . urlencode($sKey)."\""; } 
	else { echo "javascript:alert('Invalid Record! Key is null');"."\"";  } 
	echo "  target=\"frcontrol\">Declarar Terminada</a></span></td>";

?>
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
<form action="asignacionlist.php" name="ewpagerform" id="ewpagerform">
<input type="hidden" name="modo" value"<?php echo $_REQUEST["modo"]?>">
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
	<td>
	<a href="asignacionlist.php?start=1&modo=<?php echo $_REQUEST["modo"]?>"><img src="../images/first.gif" alt="Primero" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="../images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="asignacionlist.php?modo=<?php echo $_REQUEST["modo"]?>&start=<?php echo $PrevStart; ?>"><img src="../images/prev.gif" alt="Anterior" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="../images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="asignacionlist.php?modo=<?php echo $_REQUEST["modo"]?>&start=<?php echo $NextStart; ?>"><img src="../images/next.gif" alt="Siguiente" width="16" height="16" border="0"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="../images/lastdisab.gif" alt="Último" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="asignacionlist.php?modo=<?php echo $_REQUEST["modo"]?>&start=<?php echo $LastStart; ?>"><img src="../images/last.gif" alt="Último" width="16" height="16" border="0"></a></td>
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
<?php include ("../footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function SetUpSortOrder
// - Set up Sort parameters based on Sort Links clicked
// - Variables setup: sOrderBy, Session("Table_OrderBy"), Session("Table_Field_Sort")

function SetUpSortOrder()
{       global $conn; 
	global $_SESSION;
	global $_REQUEST;
	global $sOrderBy;
	global $sDefaultOrderBy;

	// Check for an Order parameter
	if (strlen(@$_REQUEST["order"]) > 0) {
		$sOrder = @$_REQUEST["order"];

		// Field tarea_idtarea
		if ($sOrder == "tarea_idtarea") {
			$sSortField = "tarea_idtarea";
			$sLastSort = @$_SESSION["asignacion_x_tarea_idtarea_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["asignacion_x_tarea_idtarea_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["asignacion_x_tarea_idtarea_Sort"] <> "") { @$_SESSION["asignacion_x_tarea_idtarea_Sort"] = ""; }
		}

		// Field fecha_inicial
		if ($sOrder == "fecha_inicial") {
			$sSortField = "fecha_inicial";
			$sLastSort = @$_SESSION["asignacion_x_fecha_inicial_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["asignacion_x_fecha_inicial_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["asignacion_x_fecha_inicial_Sort"] <> "") { @$_SESSION["asignacion_x_fecha_inicial_Sort"] = ""; }
		}

		// Field fecha_final
		if ($sOrder == "fecha_final") {
			$sSortField = "fecha_final";
			$sLastSort = @$_SESSION["asignacion_x_fecha_final_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["asignacion_x_fecha_final_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["asignacion_x_fecha_final_Sort"] <> "") { @$_SESSION["asignacion_x_fecha_final_Sort"] = ""; }
		}

		// Field documento_iddocumento
		if ($sOrder == "documento_iddocumento") {
			$sSortField = "documento_iddocumento";
			$sLastSort = @$_SESSION["asignacion_x_documento_iddocumento_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["asignacion_x_documento_iddocumento_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["asignacion_x_documento_iddocumento_Sort"] <> "") { @$_SESSION["asignacion_x_documento_iddocumento_Sort"] = ""; }
		}

		// Field serie_idserie
		if ($sOrder == "serie_idserie") {
			$sSortField = "serie_idserie";
			$sLastSort = @$_SESSION["asignacion_x_serie_idserie_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["asignacion_x_serie_idserie_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["asignacion_x_serie_idserie_Sort"] <> "") { @$_SESSION["asignacion_x_serie_idserie_Sort"] = ""; }
		}

		// Field estado
		if ($sOrder == "estado") {
			$sSortField = "estado";
			$sLastSort = @$_SESSION["asignacion_x_estado_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["asignacion_x_estado_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["asignacion_x_estado_Sort"] <> "") { @$_SESSION["asignacion_x_estado_Sort"] = ""; }
		}

		// Field entidad_identidad
		if ($sOrder == "entidad_identidad") {
			$sSortField = "entidad_identidad";
			$sLastSort = @$_SESSION["asignacion_x_entidad_identidad_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["asignacion_x_entidad_identidad_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["asignacion_x_entidad_identidad_Sort"] <> "") { @$_SESSION["asignacion_x_entidad_identidad_Sort"] = ""; }
		}

		// Field llave_entidad
		if ($sOrder == "llave_entidad") {
			$sSortField = "llave_entidad";
			$sLastSort = @$_SESSION["asignacion_x_llave_entidad_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["asignacion_x_llave_entidad_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["asignacion_x_llave_entidad_Sort"] <> "") { @$_SESSION["asignacion_x_llave_entidad_Sort"] = ""; }
		}

		// Field reprograma
		if ($sOrder == "reprograma") {
			$sSortField = "reprograma";
			$sLastSort = @$_SESSION["asignacion_x_reprograma_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["asignacion_x_reprograma_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["asignacion_x_reprograma_Sort"] <> "") { @$_SESSION["asignacion_x_reprograma_Sort"] = ""; }
		}

		// Field tipo_reprograma
		if ($sOrder == "tipo_reprograma") {
			$sSortField = "tipo_reprograma";
			$sLastSort = @$_SESSION["asignacion_x_tipo_reprograma_Sort"];
			if ($sLastSort == "ASC") { $sThisSort = "DESC"; } else{  $sThisSort = "ASC"; }
			$_SESSION["asignacion_x_tipo_reprograma_Sort"] = $sThisSort;
		}
		else
		{
			if (@$_SESSION["asignacion_x_tipo_reprograma_Sort"] <> "") { @$_SESSION["asignacion_x_tipo_reprograma_Sort"] = ""; }
		}
		$_SESSION["asignacion_OrderBy"] = $sSortField . " " . $sThisSort;
		$_SESSION["asignacion_REC"] = 1;
	}
	$sOrderBy = @$_SESSION["asignacion_OrderBy"];
	if ($sOrderBy == "") {
		$sOrderBy = $sDefaultOrderBy;
		$_SESSION["asignacion_OrderBy"] = $sOrderBy;
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
	global $_SESSION;
	global $_REQUEST;
	global $nStartRec;
	global $nDisplayRecs;
	global $nTotalRecs;	
	if (strlen(@$_REQUEST["start"]) > 0) {
		$nStartRec = @$_REQUEST["start"];
		$_SESSION["asignacion_REC"] = $nStartRec;
	}
	elseif (strlen(@$_REQUEST["pageno"]) > 0) {
		$nPageNo = @$_REQUEST["pageno"];
		if (is_numeric($nPageNo)) {
			$nStartRec = ($nPageNo-1)*$nDisplayRecs+1;
			if ($nStartRec <= 0) {
				$nStartRec = 1;
			}
			elseif ($nStartRec >= (($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1) {
				$nStartRec = (($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1;
			}
			$_SESSION["asignacion_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["asignacion_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["asignacion_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["asignacion_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["asignacion_REC"] = $nStartRec;
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
{		global $conn;
		global $_SESSION;
		global $_REQUEST;

	// Get Reset Cmd
	if (strlen(@$_REQUEST["cmd"]) > 0) {
		$sCmd = @$_REQUEST["cmd"];

		// Reset Search Criteria
		if (strtoupper($sCmd) == "RESET") {
			$sSrchWhere = "";
			$_SESSION["asignacion_searchwhere"] = $sSrchWhere;

		// Reset Search Criteria & Session Keys
		}
		elseif (strtoupper($sCmd) == "RESETALL") {
			$sSrchWhere = "";
			$_SESSION["asignacion_searchwhere"] = $sSrchWhere;

		// Reset Sort Criteria
		}
		elseif (strtoupper($sCmd) == "RESETSORT") {
			$sOrderBy = "";
			$_SESSION["asignacion_OrderBy"] = $sOrderBy;
			if (@$_SESSION["asignacion_x_tarea_idtarea_Sort"] <> "") { $_SESSION["asignacion_x_tarea_idtarea_Sort"] = ""; }
			if (@$_SESSION["asignacion_x_fecha_inicial_Sort"] <> "") { $_SESSION["asignacion_x_fecha_inicial_Sort"] = ""; }
			if (@$_SESSION["asignacion_x_fecha_final_Sort"] <> "") { $_SESSION["asignacion_x_fecha_final_Sort"] = ""; }
			if (@$_SESSION["asignacion_x_documento_iddocumento_Sort"] <> "") { $_SESSION["asignacion_x_documento_iddocumento_Sort"] = ""; }
			if (@$_SESSION["asignacion_x_serie_idserie_Sort"] <> "") { $_SESSION["asignacion_x_serie_idserie_Sort"] = ""; }
			if (@$_SESSION["asignacion_x_estado_Sort"] <> "") { $_SESSION["asignacion_x_estado_Sort"] = ""; }
			if (@$_SESSION["asignacion_x_entidad_identidad_Sort"] <> "") { $_SESSION["asignacion_x_entidad_identidad_Sort"] = ""; }
			if (@$_SESSION["asignacion_x_llave_entidad_Sort"] <> "") { $_SESSION["asignacion_x_llave_entidad_Sort"] = ""; }
			if (@$_SESSION["asignacion_x_reprograma_Sort"] <> "") { $_SESSION["asignacion_x_reprograma_Sort"] = ""; }
			if (@$_SESSION["asignacion_x_tipo_reprograma_Sort"] <> "") { $_SESSION["asignacion_x_tipo_reprograma_Sort"] = ""; }
		}

		// Reset Start Position (Reset Command)
		$nStartRec = 1;
		$_SESSION["asignacion_REC"] = $nStartRec;
	}
}
?>
