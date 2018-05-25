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
include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
include_once($ruta_db_superior.'librerias_saia.php');
//para exportar a word
if(isset($_REQUEST["export"])){
  $exportar=$_REQUEST["export"];
  if($exportar=="word"){

  }
} 
//Definir estilos para tipo de letra y color de encabezado
$_REQUEST["iddoc"]=str_replace("'","",stripslashes($_REQUEST["iddoc"]));
if(isset($_REQUEST["idpantalla"])){
  $formato=busca_filtro_tabla("","pantalla,documento","idpantalla=pantalla_idpantalla and iddocumento=".$_REQUEST["iddoc"]." and idpantalla=".$_REQUEST["idpantalla"],"",$conn);
	if(!$formato["numcampos"]){
		$formato=busca_filtro_tabla("","pantalla","idpantalla=".$_REQUEST["idpantalla"],"",$conn);
}
}
else{
  $formato=busca_filtro_tabla("","pantalla,documento","idpantalla=pantalla_idpantalla and iddocumento=".$_REQUEST["iddoc"],"",$conn);
}
if(!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"]==1){
  $codigo=usuario_actual("funcionario_codigo");
  //leido($codigo,$_REQUEST["iddoc"]);
}
?>
<html>
<head>
<?php
$formato_adicional=busca_filtro_tabla("","configuracion_pdf a","fk_idpantalla=".$formato[0]["idpantalla"],"",$conn);
if(!$formato_adicional["numcampos"]){
	$formato_adicional[0]["tamano"]=12;
	$formato_adicional[0]["derecha"]=20;
	$formato_adicional[0]["izquierda"]=15;
	$formato_adicional[0]["superior"]=30;
	$formato_adicional[0]["inferior"]=20;
	$formato_adicional[0]["tamano_papel"]="LETTER";
}
?>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$fuente = busca_filtro_tabla("valor","configuracion","nombre='tipo_letra'","",$conn);
 $doc=$_REQUEST["iddoc"];
 $nombre=$formato[0]["nombre"];
 $_SESSION["pagina_actual"]=$doc;
 $_SESSION["tipo_pagina"]=$formato[0]["ruta_pantalla"]."/$nombre/mostrar_$nombre.php?id".$nombre."=$doc";
 if(isset($_REQUEST["font_size"])&&$_REQUEST["font_size"])
    $formato_adicional[0]["tamano"]=$_REQUEST["font_size"];
 if($fuente["numcampos"])
  echo "<style> body {font-size:".$formato_adicional[0]["tamano"]."pt; font-family:".$fuente[0]["valor"]."; } </style>";
 $fondo="#CCCC";
?>
</head>
<body bgcolor="<?php echo $fondo; ?>">
<?php  echo(menu_principal_documento($_REQUEST["iddoc"],@$_REQUEST["vista"])); ?>
<?php
$tam_pagina=array();
$equivalencia=3.7882;

$tam_pagina["A4"]["ancho"]=797;
$tam_pagina["A4"]["alto"]=1123;
$tam_pagina["Letter"]["ancho"]=819;
$tam_pagina["Letter"]["alto"]=1400;
$tam_pagina["Legal"]["ancho"]=819;
$tam_pagina["Legal"]["alto"]=1345;
$tam_pagina["margen_derecha"]=$formato_adicional[0]["derecha"]*$equivalencia;
$tam_pagina["margen_izquierda"]=$formato_adicional[0]["izquierda"]*$equivalencia;
$tam_pagina["margen_superior"]=$formato_adicional[0]["superior"]*$equivalencia;
$tam_pagina["margen_inferior"]=$formato_adicional[0]["inferior"]*$equivalencia;  

$tamano_papel=ucfirst(strtolower($formato_adicional[0]["tamano_papel"]));

if( !isset($_REQUEST["tipo"]) || $_REQUEST["tipo"]==1){ 
  echo('<style type="text/css">
.page_border { border: 1px solid #CACACA; margin-bottom: 8px; box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.1); }
.paginador_docs { width: '.$tam_pagina[$tamano_papel]["ancho"].'px; height:'.$tam_pagina[$tamano_papel]["alto"].'px; margin: auto; padding-left: 0px; margin-bottom:10px; background-color:#FFF; overflow:hidden; box-shadow: 5px 5px 5px #888888;}
.page_content { height: '.($tam_pagina[$tamano_papel]["alto"]-($tam_pagina["margen_superior"]+$tam_pagina["margen_inferior"])).'px;  overflow:hidden; font-family:Verdana, Geneva, sans-serif; font-size:12px; margin-right: '.$tam_pagina["margen_derecha"].'px; margin-left: '.$tam_pagina["margen_izquierda"].'px; }
.page_margin_top { height:'.($tam_pagina["margen_superior"]).'px; overflow: hidden; }
.page_margin_bottom { height:'.$tam_pagina["margen_inferior"].'px; padding-top:30px; page-break-after:always; }
</style>
<script>
	$(document).ready(function(){
		var alto_papel='.$tam_pagina[$tamano_papel]["alto"].';
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
echo('<div id="documento"><div class="paginador_docs page_border">');
 if(!isset($_REQUEST["export"])){
    echo"<div id='div1'>";			
      $encabezado=busca_filtro_tabla("encabezado,pie","pantalla_encabezado","fk_idpantalla='".$formato[0]["idpantalla"]."'","",$conn);
    echo "</div>";
  } 
echo('
    <div class="page_margin_top" id="doc_header">');
  if($encabezado["numcampos"]){
    if(!isset($_REQUEST["tipo"])||$_REQUEST["tipo"]==1)
      $pagina=0;
    else
      $pagina=1;  
    echo crear_encabezado_pie(stripslashes($encabezado[0][0]),$_REQUEST["iddoc"],$formato,$pagina);
  } 
  echo('</div>
    <div class="page_content">
      <div id="page_overflow">
<table style="width:100%">');  
}  
else
  echo '<table border="0" width="100%" cellpadding="0" cellspacing="0">';

function crear_encabezado_pie($texto,$iddoc,$pantalla,$pagina=1){
	global $conn,$ruta_db_superior;
 
 	$resultado1=preg_match_all( '({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*)+\*})' ,$texto, $regs1 );
  $campos1=array_unique($regs1[0]);
   
  if($campos1){
		//$texto=parsear_cadena_encabezado_pie($texto,$pantalla);
		//print_r($texto);
		//die();
  }
  if($pagina==0){
  	$texto=str_replace("Pagina ##PAGE## de ##PAGES##","",$texto);
  }
  return(utf8_encode(html_entity_decode(htmlspecialchars_decode($texto))));
}
function parsear_cadena_encabezado_pie($texto,$pantalla){
	global $ruta_db_superior;
  include_once($ruta_db_superior.$pantalla[0]["ruta_pantalla"]."/".$pantalla[0]["nombre"]."/class_".$pantalla[0]["nombre"].".php");
	
  $campos_pantalla=array();
  $pantalla_campos=busca_filtro_tabla("A.*,B.procesar","pantalla_campos A, pantalla_componente B","A.etiqueta_html=B.nombre AND A.pantalla_idpantalla=".$pantalla[0]["idpantalla"]." AND tabla<>''","orden",$conn);
  if($pantalla_campos["numcampos"]){
    $texto=$texto;
    for($i=0;$i<$pantalla_campos["numcampos"];$i++){
      if($pantalla_campos[$i]["procesar"]!=''){
        $reemplaza='<'.'?php echo('.$pantalla_campos[$i]["procesar"].'('.$pantalla_campos[$i]["idpantalla_campos"].',$'.$pantalla[0]["nombre"].'->get_valor_'.$pantalla[0]["nombre"].'("'.$pantalla_campos[$i]["tabla"].'","'.$pantalla_campos[$i]["nombre"].'"),"mostrar",$'.$pantalla[0]["nombre"].'->get_campo_'.$pantalla[0]["nombre"].'("'.$pantalla_campos[$i]["nombre"].'"))); ?'.'>';
      }
      else{
        $reemplaza='<'.'?php  echo($'.$pantalla[0]["nombre"].'->get_valor_'.$pantalla[0]["nombre"].'("'.$pantalla_campos[$i]["tabla"].'","'.$pantalla_campos[$i]["nombre"].'")); ?'.'>';        
      }
      $texto=str_replace('{*'.$pantalla_campos[$i]["nombre"].'*}',$reemplaza, $texto);        
    }    
  } 	  
$funciones=busca_filtro_tabla("", "pantalla_funcion A, pantalla_funcion_exe B", "A.idpantalla_funcion=B.fk_idpantalla_funcion AND B.pantalla_idpantalla=".$pantalla[0]["idpantalla"], "", $conn);
  if($funciones["numcampos"]){    
    for($i=0;$i<$funciones["numcampos"];$i++){
      //Se utilizan 2 parametros porque uno se utiliza para el reemplazo en la cadena y el otro para la ejecucion en la pantalla             
      $parametros=array();
      $parametros_exe=array();
      $parametros_temp=  busca_filtro_tabla("", "pantalla_func_param A", "A.fk_idpantalla_funcion_exe=".$funciones[$i]["idpantalla_funcion_exe"], "", $conn);     $texto_params="";       
      for($j=0;$j<$parametros_temp["numcampos"];$j++){       
        //parametros tipo campo                
        if($parametros_temp[$j]["tipo"]==1){
          $campo_temp=  busca_filtro_tabla("", "pantalla_campos", "idpantalla_campos=".$parametros_temp[$j]["valor"],"", $conn);          
          if($campo_temp["numcampos"] && $campos_pantalla[$campo_temp[0]["nombre"]]!==''){           
            array_push($parametros_exe,'$'.$campo_temp[0]["tabla"].'->get_valor_'.$campo_temp[0]["tabla"].'("'.$campo_temp[0]["tabla"].'","'.$campo_temp[0]["nombre"].'")');
            array_push($parametros,$campo_temp[0]["nombre"]);
          }
          else{
            array_push($parametros,"''");
            array_push($parametros_exe,"''");
          } 
        }
        else if($parametros_temp[$j]["tipo"]==2){
          array_push($parametros,"'".$parametros_temp[$j]["valor"]."'");
          array_push($parametros_exe,"'".$parametros_temp[$j]["valor"]."'");
        }          
        else if($parametros_temp[$j]["tipo"]==3){
          array_push($parametros,"REQUEST[".$parametros_temp[$j]["valor"]."]");
          array_push($parametros_exe,'$_REQUEST["'.$parametros_temp[$j]["valor"].'"]');
        }        
      }  
      if(count($parametros)){
        $texto_params="@".implode(",",$parametros);
      }             
      $texto=  str_replace("{*".$funciones[$i]["nombre"].$texto_params."*}", '<'.'?php echo('.$funciones[$i]["nombre"].'('.implode(",", $parametros_exe).')); ?'.'>', $texto);         
    }
  }
  return($texto);
}
?>