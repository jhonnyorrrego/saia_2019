<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<link type="text/css" media="screen" rel="stylesheet" href="../css/colorbox.css" /> 
<script type="text/javascript" src="../js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="../js/jquery.colorbox.js"></script>	
<?php
include_once("../db.php");
$fecha_actual=date("Y-m-d");
$color=busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn);
/*************** para el link de ver mas ***************
 muestra un solo contenido, completo
 **/
if(isset($_REQUEST["idcontenido"])&&$_REQUEST["idcontenido"])
  {$contenidos=busca_filtro_tabla("","contenidos_carrusel","idcontenidos_carrusel=".$_REQUEST["idcontenido"],"",$conn);
   if($contenidos[0]["imagen"]<>"")
     echo '<img src="'.RUTA_DISCO."/".$ruta_db_superior.$contenidos[0]["imagen"].'" align="'.$contenidos[0]["align"].'" />';
   echo stripslashes(codifica_encabezado(html_entity_decode($contenidos[0]["contenido"])));
   exit();
  } /********* para ver un solo carrusel ***************/
elseif(isset($_REQUEST["idcarrusel"])&&$_REQUEST["idcarrusel"])
  $carrusel=busca_filtro_tabla("","carrusel","idcarrusel=".$_REQUEST["idcarrusel"],"",$conn);
else /********* para ver todos los sliders vigentes **********/
  {$carrusel=busca_filtro_tabla("","carrusel","'".$fecha_actual."'<=".fecha_db_obtener("fecha_fin","Y-m-d")." and '".$fecha_actual."'>=".fecha_db_obtener("fecha_inicio","Y-m-d"),"",$conn);
  
   if($carrusel["numcampos"]){
    echo "<table align=center width=100%>";
    for($h=0;$h<$carrusel["numcampos"];$h++)
      echo "<tr><td width=100% align='center'><iframe frameborder='0' scrolling='no' align=center style='width:".($carrusel[$h]["ancho"]+50)."px;height:".($carrusel[$h]["alto"]+50)."px' src='".RUTA_DISCO."/".$ruta_db_superior.$func[$h]["imagen"]."'></iframe></td></tr>";      
    echo "</table>";
   }
   else {
     redirecciona("../login.php");
   }   
   exit();
  }

?>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <?php 
    $estilos=explode(",",$carrusel[0]["css"]);
    foreach($estilos as $fila)
       echo '<link rel="stylesheet" href="'.$fila.'" type="text/css" media="screen" />';
     echo '<style>
           .anythingSlider{width: '.$carrusel[0]["ancho"].'px; height: '.$carrusel[0]["alto"].'px;}
           .anythingSlider {
             padding:10px;
           }
           .anythingSlider .wrapper {width: '.($carrusel[0]["ancho"]-80).'px; height:'.($carrusel[0]["alto"]-19).'px;}
           .anythingSlider ul li { width: '.($carrusel[0]["ancho"]-80).'px; height:'.($carrusel[0]["alto"]-43).'px;}
          #start-stop {top: '.($carrusel[0]["alto"]-27).'px;right: 80px;} 
          .anythingSlider .arrow  {top: '.(($carrusel[0]["alto"]/2)-100).'px;}
          #thumbNav {top: '.($carrusel[0]["alto"]-30).'px;}
          .anythingSlider .wrapper ul {border-bottom: 3px solid '.$color[0][0].'; border-top: 3px solid '.$color[0][0].';}
          </style>';  
    ?>     
    <script type="text/javascript" src="js/jquery.easing.1.2.js"></script> 
    
	<script type="text/javascript" src="js/jquery.anythingslider.js" charset="utf-8"></script>
</head>
<body >
<?php

$contenidos=busca_filtro_tabla("","contenidos_carrusel","carrusel_idcarrusel=".$carrusel[0]["idcarrusel"]." and '".$fecha_actual."'<=".fecha_db_obtener("fecha_fin","Y-m-d")." and '".$fecha_actual."'>=".fecha_db_obtener("fecha_inicio","Y-m-d"),"orden",$conn);

if($contenidos["numcampos"])
  {
//print_r($contenidos);
?>    
    <script type="text/javascript">
    
        function formatText(index, panel) {
		  return index + "";
	    }
        
        $(function () {
        
            $('#anythingSlider').anythingSlider({
            easing: "<?php echo $carrusel[0]['easing']; ?>",        // Anything other than "linear" or "swing" requires the easing plugin
            autoPlay: <?php echo $carrusel[0]['autoplay']; ?>,                 // This turns off the entire FUNCTIONALY, not just if it starts running or not.
           delay: "<?php echo $carrusel[0]['delay']; ?>",                    // How long between slide transitions in AutoPlay mode
           startStopped: <?php echo $carrusel[0]['startstopped']; ?>,            // If autoPlay is on, this can force it to start stopped
           animationTime: <?php echo $carrusel[0]['animationtime']; ?>,             // How long the slide transition takes
           hashTags: true,                 // Should links change the hashtag in the URL?
           buildNavigation: <?php echo $carrusel[0]['buildnavigation']; ?>,          // If true, builds and list of anchor links to link to each slide
        	 pauseOnHover: <?php echo $carrusel[0]['pauseonhover']; ?>,             // If true, and autoPlay is enabled, the show will pause on hover
        		startText: "<?php echo $carrusel[0]['starttext']; ?>",             // Start text
		        stopText: "<?php echo $carrusel[0]['stoptext']; ?>",
		        navigationFormatter: formatText       // Details at the top of the file on this use (advanced use)
            });
            
            $("#slide-jump").click(function(){
                $('#anythingSlider').anythingSlider(6);
            });
        });
    </script>
    <div id="page-wrap">    
        <div class="anythingSlider" id="anythingSlider">
          <div class="wrapper" >
            <ul>
            <?php
            for($i=0;$i<$contenidos["numcampos"];$i++)
              {echo "<li><div align='center'><div style='width:85%;height:100%;valign:middle'>";
              //width:'.($carrusel[0]["ancho"]-10).', height:'.($carrusel[0]["alto"]-10).'
              if($contenidos[$i]["imagen"]<>"")
                 echo '<img src="'.RUTA_DISCO."/".$ruta_db_superior.$contenidos[$i]["imagen"].'" align="'.$contenidos[$i]["align"].'" />';
              if($contenidos[$i]["preview"]<>"")
                 echo stripslashes(codifica_encabezado(html_entity_decode($contenidos[$i]["preview"]))).'<div id="textSlide" style="width:80%" align="right"><a id="uno" href="#" style="font-size:x-small" onclick="parent.$.fn.colorbox({href:\'mostrar_todos.php?idcontenido='.$contenidos[$i]["idcontenidos_carrusel"].'\',width:\'700px\', height:\'400px\', iframe:true}); return false;" >Ver mas...</a></div>';
              else
                 echo stripslashes(codifica_encabezado(html_entity_decode($contenidos[$i]["contenido"])));
              echo "</div></div></li>";
              }
            ?>   
            </ul>        
          </div> 
        </div> <!-- END AnythingSlider -->              
    </div>        
<?php
  
}

?>
</body>
</html>
