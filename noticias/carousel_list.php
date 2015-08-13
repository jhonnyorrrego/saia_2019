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
?>
<script type="text/javascript"> 
var contador=1;
$(document).ready(function(){
        $.post("<?php echo($ruta_db_superior);?>noticias/carousel_resultados.php?page="+contador+"&numero=<?php echo($_REQUEST['numero']);?>", function(data){
            if (data != "") {
             var objeto=jQuery.parseJSON(data); 
             $("#block-nav-resultado<?php echo($_REQUEST['numero']);?>").html('');
             $.each(objeto.datos,function(i,item){      
                $("#block-nav-resultado<?php echo($_REQUEST['numero']);?>").append('<div title="Carousel" data-load=\'{"kConnector":"html.page", "url":"<?php echo($ruta_db_superior);?>noticias/carousel_detalles.php?idcarousel='+item.idcarousel+'", "kTitle":"Datos: '+item.nombre+'" ,"kWidth":"250px"}\' class="items navigable"><div class="head"></div><div class="label">'+item.nombre+':'+item.fecha_inicio+'-'+item.fecha_fin+'  ('+item.contenidos+')</div><div class="info"></div><div class="tail"></div></div>');        
             });
            }
            //$('div#lastPostsLoader').empty();
        }) 
});
</script>
<div class="panel-body">
   <div class="block-nav" id="block-header-resultado<?php echo($_REQUEST['numero']);?>">

  </div>  
  <div class="block-nav" id="block-nav-resultado<?php echo($_REQUEST['numero']);?>">

  </div>
   <div class="block-nav" id="block-footer-resultado<?php echo($_REQUEST['numero']);?>">
    
  </div>
</div>