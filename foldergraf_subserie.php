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
$datosfol = busca_filtro_tabla("idfolder,caja_idcaja, serie_idserie, titulo, etiqueta, estado, descripcion, autor, seguridad ","folder", "idfolder=".$idfolder, "", $conn);
$idcaja=$datosfol[0]["caja_idcaja"];
$datoscaja = busca_filtro_tabla("A.numero, A.ubicacion, A.estanteria, A.nivel, A.panel, A.material","caja A", "A.idcaja=".$datosfol[0]["caja_idcaja"], "", $conn);
$serie_folder=busca_filtro_tabla("","serie","idserie in(".$datosfol[0]["serie_idserie"].")","lower(nombre)",$conn);
$autor_folder=busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$datosfol[0]["autor"],"",$conn);
?>
<?php include_once("header.php"); ?>

<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/documentos_folder.png" border="0">&nbsp;&nbsp;DOCUMENTOS EN LA CARPETA</span>
<br><br /><br />
<span style="font-weight: bold; font-size:9px">CARPETA: <?php echo $idfolder." ".$datosfol[0]["etiqueta"]?>&nbsp;&nbsp;&nbsp;
<a href="foldergraf_subserie.php?caja=<?php echo $datosfol[0]["caja_idcaja"]."&serie=".$serie_folder[0]["idserie"]."&folder=".$idfolder;?>">IR A CARPETA PRINCIPAL</a>
<a href="foldergraf.php?caja=<?php echo $datosfol[0]["caja_idcaja"]?>">IR A LA CAJA</a>
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
<td ><?php echo $datosfol[0]["idfolder"]; ?></td>
<td > 
<?php 
for($i=0;$i<$serie_folder["numcampos"];$i++){
  echo $serie_folder[$i]["codigo"]."-".$serie_folder[$i]["nombre"]."<br />";
}   
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
$subseries=busca_filtro_tabla("","serie","cod_padre=".$_REQUEST["serie"],"nombre ASC",$conn);
if($subseries["numcampos"]){
  for($i=0;$i<$subseries["numcampos"];$i++) {
    $tipos=buscar_tipos_documentales($subseries[$i]["idserie"]);
    $info = busca_filtro_tabla("MAX(A.fecha) as fecha_rec, MIN(A.fecha) as fecha_ant, COUNT(*) as numdoc,SUM(B.num_folios) AS total_folios","documento A, almacenamiento B, folder C", "B.documento_iddocumento=A.iddocumento AND C.idfolder=B.folder_idfolder AND A.serie IN(".implode(",",$tipos).") AND C.idfolder=".$idfolder, "", $conn);
    $tipos_documentales=busca_filtro_tabla("","serie","cod_padre=".$subseries[$i]["idserie"],"",$conn);
    //print_r($tipos_documentales);
    if(!$tipos_documentales["numcampos"]){
      $ruta="almacenamientograf.php?serie=".$subseries[$i]["idserie"]."&caja=".$idcaja."&folder=".$idfolder;
    }
    else{
      $ruta="foldergraf_subserie.php?serie=".$subseries[$i]["idserie"]."&caja=".$idcaja."&folder=".$idfolder;
    }
  ?>
  <div class="product_container">
		<div id="<?php $subseries[$i]["idserie"]?>" class="sliding_product"><br />
     <a href="<?php echo $ruta ?>"><?php if($info[0]["numdoc"]==0){?><img src="botones/configuracion/carpeta_vacia.gif"><?php } else {?><img src="botones/configuracion/carpeta_llena.gif"><?php }?></a>					
    		<?php echo $subseries[$i]["nombre"]?>&nbsp;<span class="phpmaker"><br>
    		<?php 
        //$series=busca_filtro_tabla("A.nombre,A.codigo","serie A", "A.cod_padre=".$subseries[$i]["idserie"], "lower(nombre)", $conn);
        //echo "Series: ";
        //$lista=array();
        /*for($j=0;$j<$series["numcampos"];$j++)
         $lista[]=$series[$j]["nombre"]." - ".$series[$j]["codigo"];
        echo implode(", ",$lista);*/
        ?>
    		<?php echo "Min: ".substr($info[0]["fecha_ant"],0,10)."<br> Max: ".substr($info[0]["fecha_rec"],0,10)."<br> Documentos: ".$info[0]["numdoc"];
    	echo "<br />Total folios: ".$info[0]["total_folios"];          
?>
        </div>
			<div class="clear"></div>
		</div>
<?php	  
  }
}
		
function buscar_tipos_documentales($padre){
global $conn;
$listado1=array();
$listado2=array();
$listado3=array();
$ldependencias=busca_filtro_tabla("idserie","serie A","A.cod_padre IN(".$padre.")","",$conn);
$listado1=extrae_campo($ldependencias,"idserie","U");
$padres=explode(",",$padre);

if(count($listado1)>0)
$listado2=array_diff($listado1,$padres);

$cont=count($listado1);
if($cont){
  $listado3=buscar_tipos_documentales(implode(",",$listado2));
  $listado4=array_merge((array)$listado1,(array)$listado3);
}
else
$listado4=$padres;

return($listado4);
}
?>
		</div>
  </div>
</div>	
</form>  
</body>
</html>
<?php include_once("footer.php"); ?>