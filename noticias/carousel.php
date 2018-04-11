<?php 
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
?>
	<head>
		<style>
		.full-size .highslide-html-content {
		  width: auto;
		}
		</style>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />		
		<script type="text/javascript" src="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />		
<?php
echo(librerias_jquery('1.7'));
echo(librerias_UI());
echo(librerias_easing());
echo(estilo_principal());
echo(librerias_supersize());
$fecha_actual=date("Y-m-d");
if(@$_REQUEST["idcarousel"]){
  $carousel=busca_filtro_tabla("","carrusel","idcarrusel=".$_REQUEST["idcarrusel"],"",$conn);
}  
else{
	 /*********ver todos los corousels  vigentes **********/
  	$carousel=busca_filtro_tabla("","carrusel","'".$fecha_actual."'<=".fecha_db_obtener("fecha_fin","Y-m-d")." and '".$fecha_actual."'>=".fecha_db_obtener("fecha_inicio","Y-m-d"),"",$conn);
}
//Tipo=1 Carousel;
$banco_imagenes=busca_filtro_tabla("","banco_imagenes","tipo=1 AND estado=1","",$conn); 
if($banco_imagenes["numcampos"]){
	$aleatorio=rand(0,$banco_imagenes["numcampos"]);
	$imagen=$banco_imagenes[$aleatorio]["ruta"];	
}
else{
	$imagen="../".RUTA_BANCO_IMAGENES.'/undefined.jpg';	
}	
if($carousel["numcampos"]){
	//$listado_carousel=extrae_campo($carousel,"idcarousel","U")
	$carouseles=extrae_campo($carousel,"idcarrusel");
	$contenidos=busca_filtro_tabla("","contenidos_carrusel","carrusel_idcarrusel in (".implode(",",$carouseles).") and '".$fecha_actual."'<=".fecha_db_obtener("fecha_fin","Y-m-d")." and '".$fecha_actual."'>=".fecha_db_obtener("fecha_inicio","Y-m-d"),"orden asc",$conn);
}
else{
	$contenidos["numcampos"]=1;
	$contenidos[0]["nombre"]='';
	$contenidos[0]["contenido"]='Sin noticias disponibles por el momento!';
	$contenidos[0]["orden"]=0;
	$contenidos[0]["preview"]='Sin noticias disponibles por el momento!';
	$contenidos[0]["imagen"]=$imagen;
	$ruta="#";		
}		
$sliders='[';
for($i=0;$i<$contenidos["numcampos"];$i++){
	if(!$contenidos[$i]["imagen"]!=''){
		if($banco_imagenes["numcampos"]){
			$aleatorio=rand(0,$banco_imagenes["numcampos"]);
			$imagen=$banco_imagenes[$aleatorio]["ruta"];	
		}
		else{
			$imagen="../".RUTA_BANCO_IMAGENES.'/undefined.jpg';	
		}				
	}
    else{
		
		$objeto=json_decode($contenidos[$i]["imagen"]);
		if(is_object($objeto)){
			$archivo_binario=StorageUtils::get_binary_file($contenidos[$i]["imagen"]);	
			$imagen=$archivo_binario;			
		}else{
			$imagen="../".RUTA_BANCO_IMAGENES.'/undefined.jpg';	
		}

    }	
	$ruta="javascript:ventana_info(".$contenidos[$i]["idcontenidos_carrusel"].");";
	$sliders.="{image : '".$imagen."', title : '".$contenidos[$i]["preview"]."', thumb : '".$imagen."', url : '".$ruta."',caption: '".$contenidos[$i]["nombre"]."'}";
    if(($i+1)<$contenidos["numcampos"]){
      $sliders.=',';  
    }	
}	
$sliders.=']';
?>				
		<script type="text/javascript">			
		function ventana_info(valor){
			hs.htmlExpand(null,{ contentId: 'cuerpo',objectType: 'iframe',width: 500, height: 350, src: 'carousel_vermas.php?id='+valor});
		}
			jQuery(function($){
				$.supersized({
					slide_interval       : <?php echo($carousel[0]["delay"]); ?>,
					transition           : <?php echo($carousel[0]["easing"]); ?>,
					autoplay 						 : <?php echo($carousel[0]["autoplay"]); ?>,
					transition_speed		 : <?php echo($carousel[0]["animationtime"]); ?>,
					slide_links					 : 'blank',
					slides 							 : <?php echo($sliders);?>				
				});
				$("#bloque-info").draggable();
				top.$("#iFrameContainer").height($(window).height());		    
		    });
	    
		</script>		
		<script type='text/javascript'>
		    hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
		    hs.outlineType = 'rounded-white';
		    //hs.marginLeft = 610;
		    hs.targetX = 'descriptor -265px';
		    hs.targetY = 'descriptor 0px';
		</script>
	</head>	
<body>
	<!--Thumbnail Navigation-->
	<div id="prevthumb"></div>
	<div id="nextthumb"></div>	
	<!--Arrow Navigation-->
	<a id="prevslide" class="load-item"></a>
	<a id="nextslide" class="load-item"></a>
	
	<div id="thumb-tray" class="load-item">
		<div id="thumb-back"></div>
		<div id="thumb-forward"></div>
	</div>
	
	<!--Time Bar-->
	<div id="progress-back" class="load-item">
		<div id="progress-bar"></div>
	</div>
	
	<!--Control Bar-->
	<div id="controls-wrapper" class="load-item">
		<div id="controls">			
			<a id="play-button"><img id="pauseplay" src="../imgs/pause.png"/></a>
		
			<!--Slide counter-->
			<div id="slidecounter">
				<span class="slidenumber"></span> / <span class="totalslides"></span>
			</div>
			
			<!--Slide captions displayed here-->
			<div id="slidecaption"></div>
			
			<!--Thumb Tray button-->
			<a id="tray-button"><img id="tray-arrow" src="../imgs/button-tray-up.png"/></a>
			
			<!--Navigation-->
			<ul id="slide-list"></ul>
			
		</div>
	</div>
		<div id="bloque-info" style="position: absolute; width: 280px; height: auto; right: 60px; top: 50px; padding: 10px; font-size:14px;" class="ui-widget ui-widget-content ui-corner-all">
		<div>
</body>
</html>
