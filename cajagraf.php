<?php
if(@$_REQUEST["iddoc"] || @$_REQUEST["key"] || @$_REQUEST["doc"]){
	$_REQUEST["iddoc"]=@$_REQUEST["doc"];
	include_once("formatos/librerias/menu_principal_documento.php");
	echo(menu_principal_documento(@$_REQUEST["iddoc"],@$_REQUEST["vista"]));
}
?>
<html>
<head>
<title>..::ADMINISTRADOR DE ARCHIVO::.. .-' camara'-.</title>
<style type="text/css">
body{
	margin:0px;
	padding:0px;
	font-family: Verdana;
	font-size:9px;
}

#mainContainer{
	width:945px;
	margin:0 auto; 	/* Center alignment */
	text-align:left;
	background-color:#FFF;
}
#leftColumn{	/* Left column of the page */
	width:945px;
	float:left;
	padding-right:5px;
}

#shopping_cart{	/* Shopping cart */
	margin:3px;
	padding:3px;
}
.clear{	
	clear:both;
}

.product_container{	/* Div for each product */
	width:450px;
	margin-right:15px;
	float:left;
	margin-top:3px;
	padding:2px;
	font-weight:bold;
}

.sliding_product img{	/* Float product images */
	float:left;
	margin:2px;
}
img{	/* No image borders */
	border:0px;
}	
.imagen_internos {vertical-align:middle} 
.internos {font-family: Verdana; font-size: 9px; font-weight: bold;}
	/* If you wish to highlight current sortable column, add layout effects below */
	.highlightedColumn{
  background-color:#CCC;
} 

</style>
<?php 
 
include_once("db.php");
include_once("header.php");
global $conn;
$permiso = false;
$perm=new PERMISO();
$permiso=$perm->permiso_usuario("admin_almacenamiento","");
?>
<body>
<div id="header">
<p><span class="internos">LISTADO DE CAJAS
<br>
<?php if($permiso)
 echo '<span class="phpmaker"><br><br><a href="cajaadd.php">ADICIONAR CAJAS</a></span>';
?>
<form method="post">
<div id="mainContainer">
	<div id="leftColumn">
		<div id="products">
		
<?php 
//Estas variables se usan para la paginacion
$nStartRec = 0;
$nStopRec = 0;
$nTotalRecs = 0;
$nRecCount = 0;
$nRecActual = 0;
$nDisplayRecs = 16;

//$documentos=$consultas->Buscar("iddocumento, numero, descripcion", "documento", "estado='ACTIVO'", "numero");
$cajas = busca_filtro_tabla("A.idcaja, A.numero, A.ubicacion, A.estanteria","caja A", "", "A.numero", $conn);

//////////////////////Para el manejo de la paginacion
$nTotalRecs = $cajas["numcampos"];
if ($nDisplayRecs <= 0) { // Display All Records
	$nDisplayRecs = $nTotalRecs;
}
$nStartRec = 1;
SetUpStartRec(); // Set Up Start Record Position
// Avoid starting record > total records
if ($nStartRec > $nTotalRecs) {
	$nStartRec = $nTotalRecs;
}

// Set the last record to display
$nStopRec = $nStartRec + $nDisplayRecs - 1;

// Move to first record directly for performance reason
$nRecCount = $nStartRec - 1;
$nRecActual = 0;
//////////////////////////////////////////////////////
if($cajas["numcampos"]>0)
{
for($i=$nStartRec-1; $i<$cajas["numcampos"] AND $nRecCount<$nStopRec; $i++)
{
  $nRecCount++;
  $info = busca_filtro_tabla("MAX(A.fecha) as fecha_rec, MIN(A.fecha) as fecha_ant, COUNT(*) as numdoc","documento A, almacenamiento B, folder C", "B.documento_iddocumento=A.iddocumento AND C.idfolder=B.folder_idfolder AND C.caja_idcaja=".$cajas[$i]["idcaja"], "", $conn);  
  $numfol = busca_filtro_tabla("DISTINCT B.idfolder","caja A, folder B", "A.idcaja=B.caja_idcaja AND B.caja_idcaja=".$cajas[$i]["idcaja"], "", $conn); 
  ?>
  			<div class="product_container">
				<div id="<?php $cajas[$i]["idcaja"]?>" class="sliding_product">
					<a href="<?php echo "foldergraf.php?caja=".$cajas[$i]["idcaja"] ?>"><img src="carrito/product.gif"></a>
					<?php echo $cajas[$i]["numero"]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="phpmaker"><a href="cajaview.php?key=<?php echo $cajas[$i]["idcaja"]?>">VER</a></span><br>
					<?php $series=busca_filtro_tabla("distinct B.nombre","folder A,serie B","A.serie_idserie=B.idserie AND A.caja_idcaja=".$cajas[$i]["idcaja"],"",$conn);
					
          $texto_series=array();
					for($j=0;$j<$series["numcampos"];$j++){
					//print_r($series);
					 array_push($texto_series,$series[$j]["nombre"]);
          }
           echo ("Series:".implode(", ",$texto_series)."<br />");
           echo "Ubicacion: ".$cajas[$i]["ubicacion"]."<br>";
					 echo "Estanteria: ".$cajas[$i]["estanteria"]."<br>";
					 echo "Min: ".substr($info[0]["fecha_ant"],0,10)."<br>Max: ".substr($info[0]["fecha_rec"],0,10)."<br>Carpetas: ".$numfol["numcampos"];
					if($permiso && $numfol["numcampos"]==0)
 echo '<br><a href="cajadelete.php?key='.$cajas[$i]["idcaja"].'">Eliminar Caja</a></span>';
?>
				</div>
				<div class="clear"></div>
			</div>
  <?php
}}
?>
		</div>
  </div>
  
  <!--div id="rightColumn">
  <iframe src="cajalist.php" height="600" width="490"></iframe>
  </div-->
</div>	
</form>

<form action="cajagraf.php" name="ewpagerform" id="ewpagerform" style="text-align:center;">
<table bgcolor="" border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" style="font-family:Verdana; font-size:9px;">
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
	<table border="0" cellspacing="0" cellpadding="0" style="text-align:center; font-family:Verdana; font-size:9px;"><tr><td>P&aacute;gina&nbsp;</td>
<!--first page button-->
	<?php if ($nStartRec == 1) { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="cajagraf.php?start=1"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="cajagraf.php?start=<?php echo $PrevStart; ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4" style="font-family:Verdana; font-size:9px;"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="cajagraf.php?start=<?php echo $NextStart; ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><a href="cajagraf.php?start=<?php echo $LastStart; ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>
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
<?php
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
		$_SESSION["cajagraf_REC"] = $nStartRec;
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
			$_SESSION["cajagraf_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["cajagraf_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["cajagraf_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["cajagraf_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["cajagraf_REC"] = $nStartRec;
		}
	}
}
?>
<?php include_once("footer.php"); ?>
</body>
</html>
