<?php 
/*
<Clase>
<Nombre>foldergraf
<Parametros>
<Responsabilidades>Lista todos los folders que se encuentran en la caja que llega como parametro. 
                   Al dar click al folder como tal conduce a los documentos que están contenidos dentro
                   del mismo folder. Y al dar click en ver conduce a la opciones del folder como tal.
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
?>
<html>
<head>
<title>..::ADMINISTRADOR DE ARCHIVO::.. </title>
<style type="text/css">
td{
  border:1px solid #000000;
}
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
	width:220px;
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
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/fly-to-basket.js"></script>
<?php
include_once("db.php");
global $conn;
$permiso = false;
$perm=new PERMISO();
$permiso=$perm->permiso_usuario("admin_almacenamiento","");
?>
</head>
<body>
<?php include_once("header.php"); ?>

<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/folder.gif" border="0">&nbsp;&nbsp;LISTADO DE CARPETAS
<?php
$idcaja = $_GET["caja"];
$datoscaja = busca_filtro_tabla("A.numero, A.ubicacion, A.estanteria, A.nivel, A.panel, A.material,A.seguridad","caja A", "A.idcaja=".$idcaja, "", $conn);
?>
<br>
<?php
if($datoscaja["numcampos"] > 0)
{
$info = busca_filtro_tabla("MAX(A.fecha) as fecha_rec, MIN(A.fecha) as fecha_ant, COUNT(*) as numdoc","documento A, almacenamiento B, folder C", "B.documento_iddocumento=A.iddocumento AND C.idfolder=B.folder_idfolder AND C.caja_idcaja=".$idcaja, "", $conn);  
  $numfol = busca_filtro_tabla("DISTINCT count(B.idfolder) AS numfol","caja A, folder B", "A.idcaja=B.caja_idcaja AND B.caja_idcaja=".$idcaja, "", $conn); 
?>
<table style="border:1 solid #000000; border-collapse:collapse;   text-align:center; width:100%;" >
<tr>
<td class="encabezado_list" colspan="10">
  DATOS DE LA CAJA
</td>
</tr>
<tr class="encabezado_list">
<td >
  NUMERO UNIDAD
</td>
<td >
  UBICACION
</td>
<td >
  ESTANTERIA
</td>
<td >
  NIVEL
</td>
<td >
  PANEL
</td>
<td >
  MATERIAL
</td>
<td >
  SEGURIDAD
</td>
<td >
  FECHA MINIMA
</td>
<td >
  FECHA MAXIMA
</td>
<td >
  NUMERO CARPETAS
</td>
</tr>
<tr class="phpmaker">
<td >
  <?php echo $datoscaja[0]["numero"]; ?>
</td>
<td >
  <?php echo $datoscaja[0]["ubicacion"]; ?>
</td>
<td >
  <?php echo $datoscaja[0]["estanteria"]; ?>
</td>
<td >
  <?php echo $datoscaja[0]["nivel"]; ?>
</td>
<td >
  <?php echo $datoscaja[0]["panel"]; ?>
</td>
<td >
  <?php echo $datoscaja[0]["material"]; ?>
</td>
<td >
  <?php echo $datoscaja[0]["seguridad"]; ?>
</td>
<td >
  <?php echo $info[0]["fecha_ant"]; ?>
</td>
<td >
  <?php echo $info[0]["fecha_rec"]; ?>
</td>
<td >
  <?php echo $numfol[0]["numfol"]; ?>
</td>
</tr>
</table>
<br>
<?php
}
if($permiso)
 echo '<span class="phpmaker"><a href="folderadd.php?caja='.$idcaja.'">ADICIONAR CARPETAS</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
?>                                             

<a href="cajagraf.php">REGRESAR A CAJAS</a>
<form method="post">
<div id="mainContainer">

	<div id="leftColumn">
		
		<div id="products">
<?php 
$folders = busca_filtro_tabla("A.idfolder, A.etiqueta, A.serie_idserie","folder A", "A.caja_idcaja=".$idcaja, " A.etiqueta ASC", $conn);
//$folders = busca_filtro_tabla("A.idfolder, A.etiqueta, A.serie_idserie","folder A", "A.caja_idcaja=".$idcaja, "", $conn);
for($i=0; $i<$folders["numcampos"]; $i++)
{ 
  $info = busca_filtro_tabla("MAX(A.fecha) as fecha_rec, MIN(A.fecha) as fecha_ant, COUNT(*) as numdoc, SUM(num_folios) as total_folios","documento A, almacenamiento B, folder C", "B.documento_iddocumento=A.iddocumento AND C.idfolder=B.folder_idfolder AND C.idfolder=".$folders[$i]["idfolder"], "", $conn);  
  ?>
  			<div class="product_container">
				<div id="<?php $folders[$i]["idfolder"]?>" class="sliding_product"><br />
					<a href="<?php echo "foldergraf_subserie.php?serie=".$folders[$i]["serie_idserie"]."&caja=".$idcaja."&folder=".$folders[$i]["idfolder"]; ?>"><?php if($info[0]["numdoc"]==0){?><img src="botones/configuracion/carpeta_vacia.gif"><?php } else {?><img src="botones/configuracion/carpeta_llena.gif"><?php }?></a>					
					<?php echo $folders[$i]["etiqueta"]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="phpmaker"><a href="folderview.php?key=<?php echo $folders[$i]["idfolder"]?>">VER</a></span><br>
          <?php if($permiso)
 echo '<a href="#" onclick="if(confirm(\'En realidad desea eliminar la carpeta y sacar de ella todos sus documentos?\') ) window.location=\'folderdelete.php?key='.$folders[$i]["idfolder"].' \'">Eliminar Carpeta</a></span>'; ?>
          <br>
					<?php 
          $series=busca_filtro_tabla("A.nombre,A.codigo","serie A", "A.idserie =".$folders[$i]["serie_idserie"], "lower(nombre)", $conn);
          //print_r($series);
          echo "Series: ".$series[0]["nombre"]." - ".$series[0]["codigo"];
          ?><br>
					<?php echo "Min: ".substr($info[0]["fecha_ant"],0,10)."<br> Max: ".substr($info[0]["fecha_rec"],0,10)."<br> Documentos: ".$info[0]["numdoc"];
					echo "<br />Total folios: ".$info[0]["total_folios"];          
          ?>
				</div>
				<div class="clear"></div>
			</div>
  <?php
}
?>
<?php include_once("footer.php"); ?>
		</div>
  </div>

</div>	
</form>
</body>
</html>
