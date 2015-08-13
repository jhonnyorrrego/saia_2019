<?php
/*
<Clase>
<Nombre>
<Parametros>
<Responsabilidades>Esta pagina muestra el listado de documentos que ya han sido aprobados, de manera que
                   ya pueden ser almacenados. Tiene la forma del carrito de compras, de manera que al
                   seleccionar los documentos ha almacenar, redirecciona a la pagina del almacenamiento
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
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
	width:450px;
	float:left;
	padding-right:5px;
}

#rightColumn{	/* right column, i.e. shopping cart column */
	width:495px;
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
	width:200px;
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

table thead td {
font-weight:bold;
cursor:pointer;
background-color:#000077;
text-align: center;
font-family: Verdana; 
font-size: 9px;
text-transform:Uppercase;
vertical-align:middle;    
}

table tbody td {	
font-family: Verdana; 
font-size: 9px;
border:1px solid #000000;
}

.encabezado_list { 
background-color:#000077; 
color:white ; 
vertical-align:middle;
text-align: center;
font-weight: bold;	
font-family: Verdana; 
font-size: 9px;
}

.imagen_internos {vertical-align:middle} 
.internos {font-family: Verdana; font-size: 9px; font-weight: bold;}
	/* If you wish to highlight current sortable column, add layout effects below */
	.highlightedColumn{
  background-color:#CCC;
} 
</style>
<script type="text/javascript" src="carrito/ajax.js"></script>
<script type="text/javascript" src="carrito/fly-to-basket.js"></script>
<script type="text/javascript" src="popcalendar.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
</head>
<body>
<?php 
include_once("db.php");
global $conn;

//Estas variables se usan para la paginacion
$nStartRec = 0;
$nStopRec = 0;
$nTotalRecs = 0;
$nRecCount = 0;
$nRecActual = 0;
$nDisplayRecs = 10;
$idfolder = $_REQUEST["folder"];
$idserie= $_REQUEST["serie"];
$papa_serie=buscar_serie_papa($idserie);
if(isset($_REQUEST["eliminar_item"])){
  alerta("En este momento el documento se esta desvinculando de la carpeta actual y estará disponible para su reubicación");
  $sql_borrar="delete from almacenamiento where idalmacenamiento=".$_REQUEST["eliminar_item"];
  phpmkr_query($sql_borrar);
  $sql_borrar="update documento set almacenado=0 where iddocumento=".$_REQUEST["iddoc"];
  phpmkr_query($sql_borrar);
  redirecciona("almacenamientograf.php?folder=".$idfolder."&serie=".$idserie);
}
$datosfol = busca_filtro_tabla("idfolder,caja_idcaja, serie_idserie, titulo, etiqueta, estado, descripcion, autor, seguridad ","folder", "idfolder=".$idfolder, "", $conn);
$datoscaja = busca_filtro_tabla("A.numero, A.ubicacion, A.estanteria, A.nivel, A.panel, A.material","caja A", "A.idcaja=".$datosfol[0]["caja_idcaja"], "", $conn);
$serie_folder=busca_filtro_tabla("","serie","idserie in(".$datosfol[0]["serie_idserie"].")","lower(nombre)",$conn);

$autor_folder=busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$datosfol[0]["autor"],"",$conn);
?>
<?php include_once("header.php"); ?>

<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/documentos_folder.png" border="0">&nbsp;&nbsp;DOCUMENTOS EN LA CARPETA</span>
<br><br /><br />
<span style="font-weight: bold; font-size:9px">CARPETA: <?php echo $idfolder." ".$datosfol[0]["etiqueta"]?>&nbsp;&nbsp;&nbsp;
<a href="foldergraf_subserie.php?caja=<?php echo $datosfol[0]["caja_idcaja"]?>&folder=<?php echo($idfolder)?>&serie=<?php echo($papa_serie);?>">IR A LA CARPETA PRINCIPAL</a>
<br /><br /><br />
<table style="border:1 solid #000000; border-collapse:collapse; text-align:center; width:100%;" >
<tr class="encabezado_list">  
  <td colspan="6">DATOS CAJA</td>
  <td bgcolor="#FFFFFF">
  &nbsp;
  </td>
  <td colspan="9">DATOS CARPETA</td>
</tr>
<tr class="encabezado_list">
<td >NUMERO<br>UNIDAD</td>
<td >UBICACION</td>
<td >ESTANTERIA</td>
<td >NIVEL</td>
<td >PANEL</td>
<td >MATERIAL</td>
<td bgcolor="#FFFFFF">
&nbsp;
</td>
<td >NUMERO<br>UNIDAD</td>
<td >SERIE</td>
<td >TITULO</td>
<td >ETIQUETA</td>
<td >ESTADO</td>
<td >DESCRIPCION</td>
<td >AUTOR</td>  
<td >SEGURIDAD</td>
</tr>
<tr class="phpmaker">
<td > <?php echo $datoscaja[0]["numero"]; ?></td>
<td > <?php echo $datoscaja[0]["ubicacion"]; ?></td>
<td > <?php echo $datoscaja[0]["estanteria"]; ?></td>
<td > <?php echo $datoscaja[0]["nivel"]; ?></td>
<td > <?php echo $datoscaja[0]["panel"]; ?></td>
<td > <?php echo $datoscaja[0]["material"]; ?></td>
<td bgcolor="#FFFFFF">
&nbsp;
</td>    
<td > <?php echo $datosfol[0]["idfolder"]; ?></td>
<td > 
<?php 
for($i=0;$i<$serie_folder["numcampos"];$i++)
  echo $serie_folder[$i]["codigo"]."-".$serie_folder[$i]["nombre"]."<br />"; 
?></td>
<td > <?php echo $datosfol[0]["titulo"]; ?></td>
<td > <?php echo $datosfol[0]["etiqueta"]; ?></td>
<td > <?php echo $datosfol[0]["estado"]; ?></td>
<td > <?php echo delimita($datosfol[0]["descripcion"],25); ?></td>
<td > <?php echo $autor_folder[0]["nombres"]." ".$autor_folder[0]["apellidos"]; ?></td>
<td > <?php echo $datosfol[0]["seguridad"]; ?></td>
</tr>
</table>
<form method="post">
<div id="mainContainer">

	<div id="leftColumn">
		<div id="products">
<?php
$documentos = busca_filtro_tabla("iddocumento, numero, descripcion", "documento", "almacenado=0 AND numero>0 AND estado not in('INICIADO','ELIMINADO') AND serie in(".$idserie.")", "", $conn);
//print_r($documentos);
$nTotalRecs = $documentos["numcampos"];
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
if($documentos["numcampos"]>0)
{
for($i=$nStartRec-1; ($i<$documentos["numcampos"] AND $nRecCount<$nStopRec); $i++)
{
  $nRecCount++;
  ?>  
  			<div class="product_container">
				<div id=<?php echo "slidingProduct".$documentos[$i]["iddocumento"]?> class="sliding_product">
					<a target="_blank" href="visor_imagenes.php?key=<?php echo $documentos[$i]["iddocumento"]; ?>&tipo_destino=1&mostrar_formato=1"><img src="carrito/documento.gif"></a>
					<a href="#" onclick="addToBasket(<?php echo $documentos[$i]["iddocumento"]?>);return false;"><img src="carrito/basket.gif"></a><?php echo $documentos[$i]["numero"]?>&nbsp;&nbsp;<br>
					<?php echo $documentos[$i]["descripcion"]?>
				</div>
				
				<div class="clear"></div>
			</div>
  <?php
}
}
?>
		</div>
		
	</div>
	<div id="rightColumn">
		<!-- Shopping cart It's important that the id of this div is "shopping_cart" -->
		<div id="shopping_cart">
			<strong>Documentos de la Carpeta</strong>
			<table id="shopping_cart_items" >
				<tr class="encabezado_list">
				  <th>NO. RADICADO</th>
					<th>DESCRIPCI&Oacute;N </th>
					<th>FECHA RADICACI&Oacute;N</th>
					<th colspan=3></th>
				</tr>
				<?php
				$num = 0;
				// Esta parte se utiliza para los que ya estan guardados en el folder
        $guardados = busca_filtro_tabla("A.iddocumento, A.numero, A.descripcion, ".fecha_db_obtener("A.fecha","Y-m-d")." as fecha,idalmacenamiento,B.folder_idfolder","documento A, almacenamiento B", "B.folder_idfolder = ".$idfolder." AND A.iddocumento=B.documento_iddocumento AND A.serie=".$idserie, "", $conn);
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
          <td><a href="almacenamientoview.php?key=<?php echo($guardados[$i]["idalmacenamiento"]);?>&folder=<?php echo($guardados[$i]["folder_idfolder"]);?>"><?php echo $guardados[$i]["numero"]; ?></a></td><td style="text-align:left"><?php echo $guardados[$i]["descripcion"]; ?></td><td><?php echo substr($guardados[$i]["fecha"],0,10); ?></td>
          <td><a href="ordenar.php?accion=mostrar&key=<?php echo $guardados[$i]["iddocumento"]; ?>&tipo_destino=1&mostrar_formato=1" target="centro">Ver</a></td><td><a href="almacenamientoedit.php?key=<?php echo $guardados[$i]["idalmacenamiento"]; ?>&tipo_destino=1&serie=<?php echo($idserie);?>">Editar</a></td><td><?php echo substr($datoseleg[0]["fecha"],0,10); ?>
              <a href="?eliminar_item=<?php echo $guardados[$i]["idalmacenamiento"]."&folder=".$_REQUEST["folder"]."&iddoc=".$guardados[$i]["iddocumento"]; ?>"><img src='carrito/remove.gif'></a></td>
          </tr>
          <?php
          $num++;
        }
        ?>
        <?php
        // Esta parte se utiliza para los que estan elegidos entre pagina y pagina
        if(isset($_GET["elegidos"]) && $_GET["elegidos"]!="")
        {
          $arrayelegidos = explode(",", $_GET["elegidos"]);
          foreach($arrayelegidos as $eleg)
          {
           $datoseleg = busca_filtro_tabla("numero, descripcion, fecha","documento", "iddocumento=".$eleg, "", $conn);
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

	<div class="clear"></div>
	<br><br>
</div>
  <div style="text-align:center; width:945px;">
  <input type="button" value="Almacenar" onclick="llenarcarrito()">
  </div>
  <!--input type="hidden" id="elegidos" name="elegidos" value=""-->
  <input type="hidden" id="folder" name="folder" value="<?php echo $idfolder; ?>">
</form>

<script>
/*
<Clase>
<Nombre>llenarcarrito
<Parametros>
<Responsabilidades>Revisa los documentos que han sido seleccionados e invoca a la pagina
                   que se encarga de diligenciar el almacenamiento
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function llenarcarrito()
{
  	var itemBox = document.getElementById('shopping_cart_items');
  	var inicio = document.getElementById('guardados').value;
  	var documentos="";
  	var folder = document.getElementById('folder').value;
		for(var no=inicio;no<itemBox.rows.length;no++)
		  if(documentos=="")
		    documentos = itemBox.rows[no].id.substring(27);
      else
      	documentos += "," + itemBox.rows[no].id.substring(27);
    if(documentos=="")
      alert("NO HA SELECCIONADO NINGUN DOCUMENTO PARA ADICIONAR EN LA CARPETA");
    else
      window.location="almacenamientoadd.php?documentos="+documentos+"&posicion=0&folder="+folder;
}

/*
<Clase>
<Nombre>llenarsiguiente
<Parametros>empieza: documento donde empieza el listado, se usa para la paginacion
<Responsabilidades>llama a la sgte pagina de documentos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function llenarsiguiente(empieza)
{
  	var itemBox = document.getElementById('shopping_cart_items');
  	var inicio = document.getElementById('guardados').value;
  	var folder = document.getElementById('folder').value;
  	var elegidos = "";
		for(var no=inicio;no<itemBox.rows.length;no++)
		  if(elegidos=="")
		    elegidos = itemBox.rows[no].id.substring(27);
      else
      	elegidos += "," + itemBox.rows[no].id.substring(27);
    window.location="almacenamientograf.php?start="+empieza+"&folder="+folder+"&elegidos="+elegidos;
}
</script>
<form action="almacenamientograf.php" name="ewpagerform" id="ewpagerform">
  <div style="text-align:center; width:945px;">
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
</div>
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
		$_SESSION["almacenamientograf_REC"] = $nStartRec;
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
			$_SESSION["almacenamientograf_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["almacenamientograf_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["almacenamientograf_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["almacenamientograf_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["almacenamientograf_REC"] = $nStartRec;
		}
	}
}
function buscar_serie_papa($idserie){
	global $conn;
  $serie=busca_filtro_tabla("","serie","idserie=".$idserie,"",$conn);
  if($serie["numcampos"] && $serie[0]["cod_padre"]){
    return(buscar_serie_papa($serie[0]["cod_padre"]));
  }
  return($idserie);
}

?>
<?php include_once("footer.php"); ?>
</body>
</html>
