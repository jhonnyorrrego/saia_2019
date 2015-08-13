<?php
$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
        //Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo(estilo_lightness());
echo(librerias_jquery());
echo(librerias_UI());
echo(librerias_principal());
echo(estilo_principal());
?>
<div class="panel-body">
   <div class="block-nav">
     <div class="summary" id="descripcion_carousel<?php echo($_REQUEST['idcontenidos_carousel']);?>" style="height: 120px">     
         <div id="menu_carousel" class="ui-widget-content">        
            <div id="editar_contenido<?php echo($_REQUEST['idcontenidos_carousel']);?>" class="boton_saia sombra_f5 degradado_gris ui-corner-all"   style="float: left;">Editar Contenido</div>
            <div id="eliminar_contenido<?php echo($_REQUEST['idcontenidos_carousel']);?>" class="boton_saia  sombra_f5 degradado_gris ui-corner-all"  style="float: left;">Eliminar Contenido</div>
         </div>
     </div>
  </div>
</div>
<script>
$(document).ready(function() {
    $("#editar_contenido<?php echo($_REQUEST['idcontenidos_carousel']);?>").click(function(){       
        $('#container').kaiten('reload',$("#"+$(".k-focus").attr("id")),{"url":"carousel_contenido_editar.php?idcontenidos_carousel=<?php echo($_REQUEST["idcontenidos_carousel"]);?>"});
    });           
});    
</script>  

    