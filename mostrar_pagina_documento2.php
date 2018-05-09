<?php 
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php"); 
include_once($ruta_db_superior."formatos/librerias/funciones_acciones.php"); 
$pagina=$_REQUEST["idpagina"];
$imagen=$_REQUEST["idimagen"];
$ruta=$_REQUEST["ruta"];


if($_REQUEST["anexo"]==0){
$datosimagen=busca_filtro_tabla("consecutivo,imagen,ruta,pagina,id_documento","pagina","consecutivo=".$pagina,"",$conn); 

$imagen_siguiente=busca_filtro_tabla("","pagina","id_documento=".$datosimagen[0]["id_documento"]." and pagina>".$datosimagen[0]["pagina"]." limit 1","",$conn);
  if($imagen_siguiente["numcampos"]<>0){
  $siguiente=busca_filtro_tabla("","pagina","id_documento=".$datosimagen[0]["id_documento"]." and pagina>".$datosimagen[0]["pagina"]." limit 1","",$conn);
  
  }else{
  $siguiente=busca_filtro_tabla("","pagina","consecutivo=".$pagina." limit 1","",$conn);
  
  }
$imagen_atras=busca_filtro_tabla("","pagina","id_documento=".$datosimagen[0]["id_documento"]." and pagina<".$datosimagen[0]["pagina"]." limit 1","",$conn);

  if($imagen_atras["numcampos"]<>0){
  $atras=busca_filtro_tabla("","pagina","id_documento=".$datosimagen[0]["id_documento"]." and pagina<".$datosimagen[0]["pagina"]." limit 1","",$conn);
  
  }else{
  $atras=busca_filtro_tabla("","pagina","consecutivo=".$pagina." limit 1","",$conn);
  
  }

if(isset($_REQUEST["key"]))  //identificador del documento
  $llave=$_REQUEST["key"];

$frame="centro";
$plantilla=busca_filtro_tabla("plantilla","documento","iddocumento=$llave","",$conn);
if($plantilla[0][0]<>"")
 $frame="detalles";
 
 
}


if($_REQUEST["anexo"]==1){

$datosimagen=busca_filtro_tabla("","anexos","idanexos=".$pagina,"",$conn);
}
?>

<html>
<head>
<script type="text/javascript" src="js/jquery/1.4.2/jquery.js"></script>
<script type="text/javascript" src="js/jQueryRotate.2.1.js"></script>
<script type="text/javascript" src="js/jquery.gzoom.js"></script>
<script type="text/javascript" src="js/ui.core.js"></script>
<script type="text/javascript" src="js/ui.slider.js"></script>
<link rel="stylesheet" href="css/jquery.gzoom.css" type="text/css" media="screen" />
	<link type="text/css" href="css/ui-lightness/jquery-ui-1.8rc3.custom.css" rel="stylesheet" />	
<script>
var suma=0; 
function der(id){

 suma=suma+45;$('#img'+id).rotate({angle:suma});
}
  
function izq(id){
 suma=suma-45;$('#img'+id).rotate({angle:suma});
}
$(function() {
	$(".zoom").gzoom({
			sW: 600,
			sH: 800,
			lW: 1400,
			lH: 1050,
			lighbox : true 
	});
});
</script>
</head>
<body>
<a href="#" onclick="izq(<?php echo $pagina;?>);"><img src="botones/comentarios/rotar_izquierda.png" title="Rotar a la izquierda"></a>
<a href="#" onclick="der(<?php echo $pagina;?>);"><img src="botones/comentarios/rotar_derecha.png" title="Rotar a la derecha"></a>
<a href="#" onclick="displayImage('<?php echo $imagen;?>','P&aacute;gina <?php echo $pagina;?>.','');return false"></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo($ruta_db_superior);?>mostrar_pagina_documento2.php?idpagina=<?php echo $atras[0]["consecutivo"];?>&idimagen=<?php echo($atras[0]["imagen"]); ?>&ruta=<?php echo($atras[0]["ruta"]);?>&key=<?php echo($doc); ?>" class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 750, height:400,preserveContent:false })"><img src="imagenes/atras.gif" alt="Atras P&aacute;gina" title="P&aacute;gina Anterior" border="0"></a>
 <a href="<?php echo($ruta_db_superior);?>mostrar_pagina_documento2.php?idpagina=<?php echo $siguiente[0]["consecutivo"];?>&idimagen=<?php echo($siguiente[0]["imagen"]); ?>&ruta=<?php echo($siguiente[0]["ruta"]);?>&key=<?php echo($doc); ?>" class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 750, height:400,preserveContent:false })"><img src="imagenes/adelante.gif" alt="Siguiente P&aacute;gina" title="Siguiente P&aacute;gina" border="0"></a><div id="barrazoom"></div>
<br/>
<div id="div<?php echo $pagina;?>" class="zoom">
<img id="img<?php echo $pagina;?>"  src="<?php echo $datosimagen[0]["ruta"];?>">
</div> 
</body>

  