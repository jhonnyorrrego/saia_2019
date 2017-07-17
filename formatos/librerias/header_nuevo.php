<?php
if(!isset($_SESSION))
  session_start();
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once("../db.php");
include_once("encabezado_pie_pagina.php");
//para exportar a word
if(isset($_REQUEST["export"])){
  $exportar=$_REQUEST["export"];
  if($exportar=="word"){

  }
}  
//Definir estilos para tipo de letra y color de encabezado
$_REQUEST["iddoc"]=str_replace("'","",stripslashes($_REQUEST["iddoc"]));
if(isset($_REQUEST["idformato"])){
  $formato=busca_filtro_tabla("","formato,documento","lower(plantilla)=nombre and iddocumento=".$_REQUEST["iddoc"]." and idformato=".$_REQUEST["idformato"],"",$conn);
	if(!$formato["numcampos"]){
		$formato=busca_filtro_tabla("","formato","idformato=".$_REQUEST["idformato"],"",$conn);
	}
}
else{  
  $formato=busca_filtro_tabla("","formato,documento","lower(plantilla)=nombre and iddocumento=".$_REQUEST["iddoc"],"",$conn);
}
//Redirecciona en caso de que el documento sea visible en PDF.
if($formato["numcampos"] && @$_REQUEST["tipo"]!=5){
    if($formato[0]["pdf"] && $formato[0]["mostrar_pdf"] == 1) {
		$ruta = $ruta_db_superior."pantallas/documento/visor_documento.php?iddoc=" . $formato[0]["iddocumento"];
		redirecciona($ruta . "&rnd=" . rand(0, 100));
	} else {
		if($formato[0]["mostrar_pdf"] == 1) {
			$ruta = $ruta_db_superior."pantallas/documento/visor_documento.php?iddoc=" . $formato[0]["iddocumento"] . "&actualizar_pdf=1";
			redirecciona($ruta . "&rnd=" . rand(0, 100));
		} else if($formato[0]["mostrar_pdf"] == 2 && !@$_REQUEST['error_pdf_word']) {
			$ruta = $ruta_db_superior."pantallas/documento/visor_documento.php?pdf_word=1&iddoc=" . $formato[0]["iddocumento"];
			redirecciona($ruta . "&rnd=" . rand(0, 100));
		}
	}
}

if(!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"]==1){
  $codigo=usuario_actual("funcionario_codigo");
  leido($codigo,$_REQUEST["iddoc"]);
	include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
	menu_principal_documento($_REQUEST["iddoc"],1);
}
?>
<html>
<head>
<?php
$config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn); 
 if($config["numcampos"])
 {  $style = "
     <style type=\"text/css\">
      .phpmaker 
       {
       font-family: Verdana,Tahoma,arial;       
       color:#000000;
       /*text-transform:Uppercase;*/
       } 
       .encabezado 
       {
       background-color:".$config[0]["valor"]."; 
       color:white ; 
       padding:10px; 
       text-align: left;	
       } 
       .encabezado_list 
       { 
       background-color:".$config[0]["valor"]."; 
       color:white ; 
       vertical-align:middle;
       text-align: center;
       font-weight: bold;	
       }
       </style>";
  echo $style;
  }
?>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$fuente = busca_filtro_tabla("valor","configuracion","nombre='tipo_letra'","",$conn);
 $doc=$_REQUEST["iddoc"];
 $nombre=$formato[0]["nombre"];
 $_SESSION["pagina_actual"]=$doc;
 $_SESSION["tipo_pagina"]="formatos/$nombre/mostrar_$nombre.php?iddoc=$doc";
 if(isset($_REQUEST["font_size"])&&$_REQUEST["font_size"])
    $formato[0]["font_size"]=$_REQUEST["font_size"];
 if($fuente["numcampos"])
  echo "<style> body,table,tr,td,div,p,span { font-size:".$formato[0]["font_size"]."pt; font-family:".$fuente[0]["valor"]."; }
  </style>";
  
?>
</head>
<body bgcolor="<?php echo $fondo; ?>">
<?php
$tam_pagina=array();
$equivalencia=3.7882;
$margenes=explode(",",$formato[0]["margenes"]);
$tam_pagina["A4"]["ancho"]=797;
$tam_pagina["A4"]["alto"]=1123;
$tam_pagina["A5"]["ancho"]=797;
$tam_pagina["A5"]["alto"]=562;
$tam_pagina["Letter"]["ancho"]=819;
$tam_pagina["Letter"]["alto"]=1400;
$tam_pagina["Legal"]["ancho"]=819;
$tam_pagina["Legal"]["alto"]=1345;
$tam_pagina["margen_derecha"]=$margenes[1]*$equivalencia;
$tam_pagina["margen_izquierda"]=$margenes[0]*$equivalencia;
$tam_pagina["margen_superior"]=$margenes[2]*$equivalencia;
$tam_pagina["margen_inferior"]=$margenes[3]*$equivalencia;  
if( !isset($_REQUEST["tipo"]) || $_REQUEST["tipo"]==1){ 
  $fondo="#f5f5f5";
  if(!isset($_REQUEST["export"])){
    echo"<div id='div1' >";
    if(!$formato[0]["item"]){
    	//echo "<a target='_blank' href='../../class_impresion.php?iddoc=".$_REQUEST["iddoc"];
      //echo "<a target='_blank' href='../../html2ps/public_html/demo/html2ps.php?iddoc=".$_REQUEST["iddoc"]."&plantilla=".$formato[0]["nombre"];
      if(isset($_REQUEST["vista"]))
        //echo "&vista=".$_REQUEST["vista"];
      //echo "'><img src='../../enlaces/imprimir.gif' height=30 width=30 border='0'></a>";
	  
	      
      $margenes=explode(",",$formato[0]["margenes"]);
      if(isset($_REQUEST["vista"])&&$_REQUEST["vista"]){
        $vista=busca_filtro_tabla("encabezado","vista_formato","idvista_formato='".$_REQUEST["vista"]."'","",$conn);
        $encabezado=busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato='".$vista[0]["encabezado"]."'","",$conn);
        $pie=busca_filtro_tabla("encabezado",$formato[0]["nombre_tabla"],"documento_iddocumento='".$_REQUEST["iddoc"]."'","",$conn);
      }
      else{
        $encabezado=busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato='".$formato[0]["encabezado"]."'","",$conn);
        $pie=busca_filtro_tabla("encabezado",$formato[0]["nombre_tabla"],"documento_iddocumento='".$_REQUEST["iddoc"]."'","",$conn);  
      }      
      echo "</div>";
    }
  } 
  if($formato[0]["orientacion"]){
    $alto_paginador=$tam_pagina[$formato[0]["papel"]]["ancho"];
    $ancho_paginador=$tam_pagina[$formato[0]["papel"]]["alto"];
  
  }else{
    $alto_paginador=$tam_pagina[$formato[0]["papel"]]["alto"];
    $ancho_paginador=$tam_pagina[$formato[0]["papel"]]["ancho"];
  }
  if($formato[0]["paginar"] == '1') {
  echo('<style type="text/css">
.page_border { border: 1px solid #CACACA; margin-bottom: 8px; box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); }
.paginador_docs { width: '.$ancho_paginador.'px; height:'.($alto_paginador+50).'px; margin: auto; padding-left: 0px; margin-bottom:10px; background-color:#FFF; overflow:hidden; box-shadow: 5px 5px 5px #888888;}
.page_content { height: '.($alto_paginador-($tam_pagina["margen_superior"]+$tam_pagina["margen_inferior"])).'px;  overflow:hidden; font-family:Verdana, Geneva, sans-serif; font-size:12px; margin-right: '.$tam_pagina["margen_derecha"].'px; margin-left: '.$tam_pagina["margen_izquierda"].'px; }
.page_margin_top { height:'.($tam_pagina["margen_superior"]+20).'px; overflow: hidden; }
.page_margin_bottom { height:'.$tam_pagina["margen_inferior"].'px; padding-top:30px; page-break-after:always; }
</style>
<script>
	$(document).ready(function(){
		var alto_papel='.$alto_paginador.';
    var alto_encabezado='.$tam_pagina["margen_superior"].';
    var alto_pie_pagina='.$tam_pagina["margen_inferior"].';
		var altopagina = alto_papel-(alto_encabezado+alto_pie_pagina); 
    var paginas=1;
    var alto=0; 
    var inicial=$("#documento").offset().top;
    $(".page_break").each(function(){
      pos=$(this).offset().top;
	    paginas =Math.ceil(pos/altopagina);    
      var nuevo_alto=(inicial+((altopagina)*paginas))-(pos)+(alto_encabezado);
      $(this).height(nuevo_alto);   
      
    });  
    alto = $("#page_overflow").height();
	  paginas =Math.ceil(alto/altopagina);   
		var contenido = $("#page_overflow").html();
		var encabezado = $("#doc_header").html();
		var piedepagina = $("#doc_footer").html();
		
		for(i=1;i<paginas;i++){             
			var altoPaginActual = altopagina*i;
			var pagina = \'<div class="paginador_docs page_border"><div class="page_margin_top">\'+encabezado+\'</div><div class="page_content" ><div style="margin-top:-\'+altoPaginActual+\'px">\'+contenido+\'</div></div><div class="page_margin_bottom">\'+piedepagina+\'</div></div>\';
           
			$("#documento").append(pagina);
		}
	});
</script>');
  }else{
	echo('
<style type="text/css">
.page_border { border: 1px solid #CACACA; margin-bottom: 8px; box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); }
.paginador_docs { width: '.$ancho_paginador.'px;  margin: auto; padding-left: 0px; margin-bottom:10px; background-color:#FFF; overflow:hidden; box-shadow: 5px 5px 5px #888888;}
.page_content {   overflow:hidden; font-family:Verdana, Geneva, sans-serif; font-size:12px; margin-right: '.$tam_pagina["margen_derecha"].'px; margin-left: '.$tam_pagina["margen_izquierda"].'px; }
.page_margin_top {  overflow: hidden; }
.page_margin_bottom {  padding-top:30px; page-break-after:always; }
</style>	
	');  	
  }
echo ('
<body bgcolor="#f5f5f5">  
<div id="documento">
  <div class="paginador_docs page_border">
    <div class="page_margin_top" id="doc_header">');

	
  if($pie[0][0]&&$encabezado["numcampos"]){
    if(!isset($_REQUEST["tipo"])||$_REQUEST["tipo"]==1)
      $pagina=0;
    else
      $pagina=1;  
    echo crear_encabezado_pie_pagina(stripslashes($encabezado[0][0]),$_REQUEST["iddoc"],$formato[0]["idformato"],$pagina);
  } 
  echo('</div>
    <div class="page_content">
      <div id="page_overflow">
<table style="width:100%">');  
}  
else
  echo '<table border="0" width="100%" cellpadding="0" cellspacing="0">';  
?>
