<?php 
/*
<Clase>
<Nombre>solicitudadd
<Parametros>
<Responsabilidades>Esta es una pagina tipo carrito de compras, lo que hace es listar todos los documentos que ya han sido
                   almacenados, y que se pueden solicitar, de manera que el usuario puede hacer la solicitud de dichos
                   documentos y pasar a la pagina de las reservas.
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
//session_start();
include("db.php");
//$conn = new Conexion("MySql","localhost","saia","*adminsaia%","saia","3306");
//$consultas = new SQL($conn->Obtener_Conexion(), $conn->Motor);
global $conn;

//Estas variables se usan para la paginacion
$nStartRec = 0;
$nStopRec = 0;
$nTotalRecs = 0;
$nRecCount = 0;
$nRecActual = 0;
$nDisplayRecs = 10;
if(!strpos($_SERVER["HTTP_REFERER"],'index.php'))
  $_SESSION["punto_retorno"]=$_SERVER["HTTP_REFERER"];

include_once("header.php");
?>
<html>
<head>
<title>Reservas</title>
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
}

.encabezado_list { 
background-color:#666666; 
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
<a href="reservas_anio.php">LISTADO DE RESERVAS</a>&nbsp;&nbsp;&nbsp;
<a href="busqueda_documentos.php?pagina_reserva=1&tipo_b=general">BUSCAR DOCUMENTOS</a>
<?php 
if(isset($_POST["segunda"]) && $_POST["segunda"]!="")
{  
  $documentos = explode(",", $_POST["reservados"]);
  $investigador = usuario_actual("funcionario_codigo"); 
  $solicitudes = "";
  for($i=0; $i<count($documentos); $i++)
  {
    $registro = busca_filtro_tabla("A.idalmacenamiento, B.descripcion, B.estado","almacenamiento A, documento B", "A.documento_iddocumento=B.iddocumento AND B.iddocumento=".$documentos[$i], "A.idalmacenamiento DESC", $conn);   
    $sqlInsert = "INSERT INTO solicitud(documento_iddocumento, investigador_idinvestigador, fecha, estado_documento, descripcion, estado, idalmacenamiento) VALUES (".$documentos[$i].",".$investigador.",".fecha_db_almacenar(date('Y-m-d H:i:s'),"Y-m-d H:i:s").",'".$registro[0]["estado"]."','".$registro[0]["descripcion"]."','INICIADO','".$registro[0]["idalmacenamiento"]."')";
  //  die($sqlInsert);    
    // Todo solo
    phpmkr_query($sqlInsert, $conn);
    if($solicitudes != "")
      $solicitudes .= "," . phpmkr_insert_id();
    else
      $solicitudes .= phpmkr_insert_id();
  }
  if($_POST["reservados"] != "")
    redirecciona("reservaadd.php?solicitudes=".$solicitudes."&posicion=0");
  else
    ?><script>alert("NO HA ELEGIDO NINGUN DOCUMENTO");</script><?php 
}
?>

<script type="text/javascript" src="carrito/ajax.js"></script>
<script type="text/javascript" src="carrito/fly-to-basket.js"></script>
<script type="text/javascript" src="popcalendar.js"></script>
</head>
<body>

<form action="solicitudadd.php" method="post">
<div id="mainContainer">

<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/reservar.png" border="0">&nbsp;&nbsp;DOCUMENTOS A RESERVAR
<div style="text-align:left">
</div>
<br><br><br>
	<div id="leftColumn">
		<div id="products">
<?php 
if(isset($_REQUEST["documentos"])&& $_REQUEST["documentos"])
  $filtro=" and iddocumento in(".$_REQUEST["documentos"].") ";
else $filtro="";
  
$documentos = busca_filtro_tabla("A.iddocumento, A.numero, A.descripcion","documento A", "A.almacenado=1 $filtro", "A.numero", $conn);

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

for($i=$nStartRec-1; $i<$documentos["numcampos"] AND $nRecCount<$nStopRec; $i++)
{
  $nRecCount++;
  ?>
  			<div class="product_container">
				<div id=<?php echo "slidingProduct".$documentos[$i]["iddocumento"]?> class="sliding_product">
					<img src="carrito/documento.gif">
					<a href="#" onclick="addToBasket(<?php echo $documentos[$i]["iddocumento"]?>);return false;"><img src="carrito/basket.gif"></a><?php echo delimita($documentos[$i]["descripcion"],40);?><br>
					<?php echo $documentos[$i]["numero"]?>
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
			<strong>Cesta de Reservas</strong>	
			<table id="shopping_cart_items" style="font-size:1.5em; font-family: Verdana, Arial, Helvetica, sans-serif;">
				<tr class="encabezado_list">
				  <th>NO. RADICADO</th>
					<th>DESCRIPCI&Oacute;N </th>
					<th>FECHA RADICACI&Oacute;N</th>
					<!--th>Fecha Inicial</th-->
					<!--th>Fecha Final</th-->
					<th></th>
				</tr>
				<?php
				// Esta parte se utiliza para los que estan elegidos entre pagina y pagina
        if(isset($_GET["elegidos"]) && $_GET["elegidos"]!="")
        {
          $arrayelegidos = explode(",", $_GET["elegidos"]);
          foreach($arrayelegidos as $eleg)
          {
           $datoseleg = busca_filtro_tabla("A.numero, A.descripcion, A.fecha","documento A", "A.iddocumento=".$eleg, "", $conn);
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
		</div>
	</div>
	
	<div class="clear"></div>
	
</div>
<br><br>
<div style="text-align:center; width:945px;">
  <input type="submit" value="Solicitar" onclick="llenarcarrito()">
</div>
  <input type="hidden" id="segunda" name="segunda" value="segunda">
  <!--input type="hidden" id="solicitudes" name="solicitudes" value="<?php echo $solicitudes?>"-->
<input type="hidden" id="reservados" name="reservados">

</form>

<script>
function llenarcarrito()
{
  	var itemBox = document.getElementById('shopping_cart_items');
  	var documentosreservados="", descripciones="";
		//for(var no=1;no<itemBox.rows.length;no++)
		//  if(documentosreservados=="")
		//    documentosreservados = itemBox.rows[no].cells[0].innerHTML + ","+itemBox.rows[no].cells[1].innerHTML + ","+itemBox.rows[no].cells[2].innerHTML+","+document.getElementById('fecha_inicial'+itemBox.rows[no].cells[0].innerHTML).value+","+document.getElementById('fecha_final'+itemBox.rows[no].cells[0].innerHTML).value;
    //  else
    //  	documentosreservados += "|" + itemBox.rows[no].cells[0].innerHTML+ ","+itemBox.rows[no].cells[1].innerHTML + ","+itemBox.rows[no].cells[2].innerHTML+","+document.getElementById('fecha_inicial'+itemBox.rows[no].cells[0].innerHTML).value+","+document.getElementById('fecha_final'+itemBox.rows[no].cells[0].innerHTML).value;;
		for(var no=1;no<itemBox.rows.length;no++)
		  if(documentosreservados=="")
		    documentosreservados = itemBox.rows[no].id.substring(27);
      else
      	documentosreservados += "," + itemBox.rows[no].id.substring(27);
		document.getElementById('reservados').value = documentosreservados;
}

function llenarsiguiente(empieza)
{
  	var itemBox = document.getElementById('shopping_cart_items');
  	var elegidos = "";
		for(var no=0;no<itemBox.rows.length;no++)
		  if(elegidos=="")
		    elegidos = itemBox.rows[no].id.substring(27);
      else
      	elegidos += "," + itemBox.rows[no].id.substring(27);
    window.location="solicitudadd.php?start="+empieza+"&elegidos="+elegidos;
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
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">P&Aacute;GINA&nbsp;</span></td>
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
	<td><span class="phpmaker">&nbsp;DE <?php echo intval(($nTotalRecs-1)/$nDisplayRecs+1);?></span></td>
	</tr></table>
	<?php if ($nStartRec > $nTotalRecs) { $nStartRec = $nTotalRecs; }
	$nStopRec = $nStartRec + $nDisplayRecs - 1;
	$nRecCount = $nTotalRecs - 1;
	if ($rsEof) { $nRecCount = $nTotalRecs; }
	if ($nStopRec > $nRecCount) { $nStopRec = $nRecCount; } ?>
	<span class="phpmaker">REGISTROS <?php echo $nStartRec; ?> AL <?php echo $nStopRec; ?> DE <?php echo $nTotalRecs; ?></span>
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
		$_SESSION["solicitudadd_REC"] = $nStartRec;
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
			$_SESSION["solicitudadd_REC"] = $nStartRec;
		}
		else
		{
			$nStartRec = @$_SESSION["solicitudadd_REC"];
			if  (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
				$nStartRec = 1; // Reset start record counter
				$_SESSION["solicitudadd_REC"] = $nStartRec;
			}
		}
	}
	else
	{
		$nStartRec = @$_SESSION["solicitudadd_REC"];
		if (!(is_numeric($nStartRec)) || ($nStartRec == "")) {
			$nStartRec = 1; //Reset start record counter
			$_SESSION["solicitudadd_REC"] = $nStartRec;
		}
	}
}
include_once('footer.php');
?>
</body>
</html>
