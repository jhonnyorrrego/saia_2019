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
?>
<div class="panel-body">
   <div class="block-nav">
     <div class="summary ui-widget-content" id="descripcion_carousel<?php echo($_REQUEST['idcarousel']);?>">
         <?php
            echo(estilo_lightness());
            echo(librerias_jquery());
            echo(librerias_UI());
            echo(librerias_principal());
            echo(estilo_principal());
         ?>
        <table>
            <tr>
                <td rowspan="4">
                    <div id="imagenes_contenidos" style="width: 50px;height: 80px;" clas="ui-widget ui-widget-content ui-corner-all">
                    </div>
                </td>
                <td>
                    Nombre:
                </td>
                <td>
                    <div id="campo_nombre"></div>
                </td>
            </tr>
            <tr>
                <td>
                    Fecha Inicio:
                </td>
                <td>
                    <div id="campo_fecha_inicio"></div>
                </td>
            </tr>
            <tr>    
                <td>
                    Fecha Fin:
                </td>
                <td>
                    <div id="campo_fecha_fin"></div>
                </td>
            </tr>
            <tr>     
                <td>
                    Previsualizar en ventana emergente:
                </td>
                <td>
                    <div id="previsualizar_carousel" class="boton_saia  sombra_f5 degradado_gris ui-corner-all">Previsualizar</div>
                </td>
            </tr>
        </table>       
     </div
  </div>  
  <div class="block-nav" id="contenidos_carousel<?php echo($_REQUEST['idcarousel']);?>">

  </div>

</div>
<script>
  $(document).ready(function() {
    $("#campo_nombre").html(top.cargando());
    $.post("<?php echo($ruta_db_superior);?>noticias/class_carousel.php",{tipo:'datos_generales',idcarousel:<?php echo($_REQUEST["idcarousel"]); ?>},function(data) {
        if (data != "") {
            
            var objeto=jQuery.parseJSON(data);
            $.each(objeto,function(i,item){
                $("#campo_nombre").html(item.nombre);
                $("#campo_fecha_inicio").html(item.fecha_inicio);
                $("#campo_fecha_fin").html(item.fecha_fin);
                $.each(item.listado_contenidos,function(j,item2){
                    $("#contenidos_carousel<?php echo($_REQUEST['idcarousel']);?>").append('<div title="Carousel" data-load=\'{"kConnector":"html.page", "url":"<?php echo($ruta_db_superior);?>noticias/carousel_contenido_detalles.php?idcontenidos_carousel='+item2.idcontenidos_carrusel+'", "kTitle":"Datos: '+item2.nombre+'" ,"kWidth":"250px"}\' class="items navigable"><div class="head"></div><div class="label">'+item2.nombre+':'+item2.fecha_inicio+'-'+item2.fecha_fin+'</div><div class="info"></div><div class="tail"></div></div>');                       
                });
            });
        }
      });
      
    }); 
</script>