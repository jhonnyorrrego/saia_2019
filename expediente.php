<?php
include_once("db.php");
include_once("header.php");
?>
<style type="text/css">	
#mainContainer{
	width:98%;
	margin:0 auto; 	/* Center alignment */
	text-align:left;
}
#leftColumn{	/* Left column of the page */
	width:60%;
	float:left;
	padding-right:5px;
}

#rightColumn{	/* right column, i.e. shopping cart column */
	width:40%;
	float:right;
	padding-right:10px;
}
#shopping_cart{	/* Shopping cart */
	margin:3px;
	padding:3px;
}
.clear{	
	clear:both;
}
.product_container{	/* Div for each product */
	width:80%;
	margin-right:15px;
	float:left;
	margin-top:0px;
	padding:0px;
	font-weight:bold;
}
.sliding_product img{	/* Float product images */
	float:left;
}
img{	/* No image borders */
	border:0px;
}
	/* If you wish to highlight current sortable column, add layout effects below */
	.highlightedColumn{
  background-color:#CCC;
} 
</style>
<?php    
if(@$_SESSION["LOGIN".LLAVE_SAIA]<>"")
{
//Estas variables se usan para la paginacion 
$nStartRec = 0;
$nStopRec = 0;
$nTotalRecs = 0;
$nRecCount = 0;
$nRecActual = 0;
$nDisplayRecs = 10;
?>
<?php }
else
 { alerta("Su session ha terminado, por favor vuelva a iniciar sesion en SAIA",'error',4000);
   redirecciona("logout.php");
 } 
if(isset($_GET["idexpediente"]))
{ $idexp = $_GET["idexpediente"];
  if(isset($_GET["sql"]))
   {$sql_buscador = @$_GET["sql"];  
    $_SESSION["sql_buscador"] = $sql_buscador;
   }
   else
     $sql_buscador = $_SESSION["sql_buscador"];
  $expediente = busca_filtro_tabla("*","expediente","idexpediente=$idexp","",$conn);  
 ?>
 <script type="text/javascript" src="carrito/ajax.js"></script>
<script type="text/javascript" src="carrito/fly-to-basket.js"></script>
 <span class="internos"><img class="imagen_internos" src="botones/configuracion/expediente.png" border="0">&nbsp;&nbsp; DOCUMENTOS EN EL EXPEDIENTE</span>
<br>
<span style="font-weight: bold; font-size:9px">EXPEDIENTE: <?php echo $expediente[0]["nombre"]; ?></span>
<br><br />
<a href="expediente_detalles.php?key=<?php echo $idexp?>">Regresar al expediente</a><br /><hr>
<?php  }
?>
<form method="post">
<div id="mainContainer" style="width=95%">
	<div id="leftColumn" style="width=50%">
		<div id="products" >
<?php
//$doc=busca_filtro_tabla("*","documento","numero<15 and estado='ACTIVO'","numero",$conn);   // Aque va el resultado de la consulta que se hace con el buscador

if($sql_buscador<>"")
{ 
 /*$inicio = strpos($sql_buscador,"WHERE");
// echo $sql_buscador."</br>";
 $where = stripcslashes(substr($sql_buscador,($inicio+6))); 
 $doc=busca_filtro_tabla("DISTINCT iddocumento,numero,descripcion","documento A,ejecutor B, buzon_entrada",$where." AND (archivo_idarchivo=iddocumento) AND (origen=".$_SESSION["usuario_actual"]." OR destino=".$_SESSION["usuario_actual"].")","",$conn);
 */
 //print_r($doc);
 //$doc=busca_filtro_tabla("*","documento","numero<20 and estado='ACTIVO'","numero",$conn);
 //echo stripslashes($sql_buscador); 
 $rs = $conn->Ejecutar_Sql(stripslashes($sql_buscador));
 $temp=phpmkr_fetch_array($rs);
  $doc["sql"]=$sql;
  for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++)
    array_push($doc,$temp);
  $doc["numcampos"]=$i;  
 //print_r($doc);
}
$nTotalRecs = $doc["numcampos"];
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
if($doc["numcampos"]>0)
{ echo "<table  border=\"0\" width=100%>";
for($i=$nStartRec-1; ($i<$doc["numcampos"] AND $nRecCount<$nStopRec); $i++)
{
  $nRecCount++;
  ?>
         <tr><!--div class="product_container"-->
        <td >
    		<div class="product_container" >
				<div id=<?php echo "slidingProduct".$doc[$i]["iddocumento"]?> class="sliding_product" width="100%">
						<?php echo $doc[$i]["numero"]."-".delimita(codifica_encabezado($doc[$i]["descripcion"]),50);?><br>         
				</div></td><td align="center">
				<a href="#" onclick="addToBasket(<?php echo $doc[$i]["iddocumento"]?>);return false;"><img src="botones/general/adicionar.png" ></a>
				<br>
				<div class="clear"></div>
			</div></td></tr>
  <?php
}
echo "</table>";
}
?>
		</div>
<div style="text-align:center; ">		
  <form action="expediente.php" name="ewpagerform" id="ewpagerform">
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
	<td><img src="images/first.gif" alt="First" width="16" height="16" border="0" style="cursor:hand" onclick="llenarsiguiente(1)"></a></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0" style="cursor:hand" onclick="llenarsiguiente(<?php echo $PrevStart; ?>)"></a></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><img src="images/next.gif" alt="Next" width="16" height="16" border="0" style="cursor:hand" onclick="llenarsiguiente(<?php echo $NextStart; ?>)"></a></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><img src="images/last.gif" alt="Last" width="16" height="16" border="0" style="cursor:hand" onclick="llenarsiguiente(<?php echo $LastStart; ?>)"></a></td>
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
  <input type="button" value="Almacenar" onclick="llenarcarrito()">
	</div>
  </div>	
	<?php
  // Esta parte se utiliza para los que ya estan guardados en el folder				
  $guardados = busca_filtro_tabla("iddocumento, numero, descripcion, ".fecha_db_obtener("expediente_doc.fecha","Y-m-d H:i:s")." as fechad", "documento,expediente_doc", "expediente_idexpediente = ".$idexp." AND iddocumento=documento_iddocumento", "", $conn);
  //if($guardados["numcampos"]>0)
  //{     
  ?>
	<div id="rightColumn" style="width:48%">
		<!-- Shopping cart It's important that the id of this div is "shopping_cart" -->
		<div id="shopping_cart">
			<strong>Documentos del expediente</strong>	
			<table id="shopping_cart_items">
				<tr class="encabezado_list">
				  <th class="phpmaker">NO. RADICADO</th>
					<th class="phpmaker">DESCRIPCI&Oacute;N </th>
					<th class="phpmaker">FECHA RADICACI&Oacute;N</th>
					<th></th>
				</tr>
				<?php
				$num = 0;				 
        for($i=0; $i<$guardados["numcampos"]; $i++)
        { 
           // Set row color
	         $sItemRowClass = " bgcolor=\"#FFFFFF\"";
	         // Display alternate color for rows
	         if ($num % 2 <> 0) {
		        $sItemRowClass = " bgcolor=\"#F5F5F5\"";
		       }
          ?>
          <tr <?php echo $sItemRowClass;?> style="text-align:center">
          <td><?php echo $guardados[$i]["numero"]; ?></td><td style="text-align:left"><?php echo $guardados[$i]["descripcion"]; ?></td><td><?php echo substr($guardados[$i]["fechad"],0,10); ?></td>
          </tr>
          <?php
          $num++;
        }
        // Esta parte se utiliza para los que estan elegidos entre pagina y pagina
        if(isset($_GET["elegidos"]) && $_GET["elegidos"]!="")
        {
          $arrayelegidos = explode(",", $_GET["elegidos"]);
          foreach($arrayelegidos as $eleg)
          {
           $datoseleg = busca_filtro_tabla("numero, descripcion,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha", "documento", "iddocumento=".$eleg, "", $conn);
           // Set row color
	         $sItemRowClass = " bgcolor=\"#FFFFFF\"";
	         // Display alternate color for rows
	         if ($num % 2 <> 0) {
		        $sItemRowClass = " bgcolor=\"#F5F5F5\"";
           }            
             ?>
              <tr id='shopping_cart_items_product<?php echo $eleg?>' <?php echo $sItemRowClass;?> style="text-align:center">
              <td><?php echo $datoseleg[0]["numero"]; ?></td><td style="text-align:left"><?php echo $datoseleg[0]["descripcion"]; ?></td><td><?php echo substr($datoseleg[0]["fecha"],0,10); ?></td>
              <td><a href="#" onclick="removeProductFromBasket(<?php echo $eleg?>);"><img src='carrito/remove.gif'></a></td>
              </tr>
            <?php
            $num++;            
          }
        }
        ?>
				<!-- Here, you can output existing basket items from your database 
				One row for each item. The id of the TR tag should be shopping_cart_items_product + productId,
				example: shopping_cart_items_product1 for the id 1 -->			
      </table>
			<input type="hidden" name="guardados" id="guardados" value="<?php echo ($guardados["numcampos"] + 1);?>">
			 
		</div>
	</div>
  <?php
  //}
  ?>
	<div class="clear"></div>
	<br><br>
</div>
 
  <!--input type="hidden" id="elegidos" name="elegidos" value=""-->
  <input type="hidden" id="expediente" name="expediente" value="<?php echo $idexp; ?>">
</form>

<script>
function llenarcarrito()
{
  	var itemBox = document.getElementById('shopping_cart_items');
  	var inicio = document.getElementById('guardados').value;
  	var documentos="";
  	var folder = document.getElementById('expediente').value;
		for(var no=inicio;no<itemBox.rows.length;no++)
		  if(documentos=="")
		    documentos = itemBox.rows[no].id.substring(27);
      else
      	documentos += "," + itemBox.rows[no].id.substring(27);
    if(documentos=="")
      alerta("NO HA SELECCIONADO NINGUN DOCUMENTO PARA ADICIONAR EN LA CARPETA",'error',5000);
    else
      window.location="expedienteadd.php?documentos="+documentos+"&posicion=0&expediente="+folder;
}

function llenarsiguiente(empieza)
{
  	var itemBox = document.getElementById('shopping_cart_items');
  	var inicio = document.getElementById('guardados').value;
  	var folder = document.getElementById('expediente').value;
  	var elegidos = "";
		for(var no=inicio;no<itemBox.rows.length;no++)
		  if(elegidos=="")
		    elegidos = itemBox.rows[no].id.substring(27);
      else
      	elegidos += "," + itemBox.rows[no].id.substring(27);
    window.location="expediente.php?start="+empieza+"&idexpediente="+folder+"&elegidos="+elegidos;
}
</script>

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
		$_SESSION["expediente_REC"] = $nStartRec;
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
			$_SESSION["expediente_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["expediente_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["expediente_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["expediente"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["expediente"] = $nStartRec;
		}
	}
}
?>

</body>
</html>
<?php
include_once("fin_cargando.php");
?>
