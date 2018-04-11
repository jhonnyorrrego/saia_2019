<?php                                       
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
$pagina=busca_filtro_tabla("","pagina","consecutivo=".$_REQUEST["idpagina"],"",$conn);
$ancho_imagen=busca_filtro_tabla("","configuracion","nombre='ancho_imagen'","",$conn);
$alto_imagen=busca_filtro_tabla("","configuracion","nombre='alto_imagen'","",$conn);

echo(librerias_jquery("1.7"));
echo(librerias_tooltips());
echo(librerias_acciones_kaiten());

echo(estilo_lightness());
echo(librerias_UI(""));
echo(estilo_bootstrap());
echo(librerias_bootstrap());
?>
<!--script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.gzoom.js"></script>
<link href="<?php echo($ruta_db_superior);?>css/jquery.gzoom.css" type="text/css" rel="stylesheet" /-->
<?php
menu_paginas_documento($pagina[0]["consecutivo"]);
$datos_img = StorageUtils::get_binary_file($pagina[0]["ruta"]);
?>
<div href="<?php echo($ruta_db_superior.$pagina[0]["ruta"]);?>" class="pagina_zoom" rel="position:'inside'">
    <img src="<?php echo($datos_img);?>" class="img-polaroid imagen_saia">
</div>
<script>
$(document).ready(function(){
  ancho=parent.$(".modal-body").width()-50;
  alto=parent.$(".modal-body").height()-50;
  ancho_imagen=$('.imagen_saia').width();
  alto_imagen=$('.imagen_saia').height();
  ResizeImage($('.imagen_saia'),ancho,alto);
  /*$(".pagina_zoom").gzoom({sW: $('.imagen_saia').width(), sH:$('.imagen_saia').height() ,lW:<?php echo($ancho_imagen[0]["valor"]);?> ,lH:<?php echo($alto_imagen[0]["valor"]);?>, lighbox : false });
});*/
  function ResizeImage(imagen, maxWidth, maxHeight){
    var srcWidth = imagen.width();
    var srcHeight = imagen.height();
    var resizeWidth = srcWidth;
    var resizeHeight = srcHeight;
    var aspect = resizeWidth / resizeHeight;
    if (resizeWidth > maxWidth){
        resizeWidth = maxWidth;
        resizeHeight = resizeWidth / aspect;
    }
    if (resizeHeight > maxHeight){
        aspect = resizeWidth / resizeHeight;
        resizeHeight = maxHeight;
        resizeWidth = resizeHeight * aspect;
    }
    imagen.width(resizeWidth);
    imagen.height(resizeHeight);
  }
</script>
<?php
function menu_paginas_documento($idpagina){
global $pagina;
$pagina_siguiente=busca_filtro_tabla("","pagina","id_documento=".$pagina[0]["id_documento"]." AND pagina>".$pagina[0]["pagina"],"",$conn);
$pagina_anterior=busca_filtro_tabla("","pagina","id_documento=".$pagina[0]["id_documento"]." AND pagina<".$pagina[0]["pagina"],"pagina DESC",$conn);
$paginas=busca_filtro_tabla("","pagina","id_documento=".$pagina[0]["id_documento"],"",$conn);
?>
  <div class="navbar-inner">                      
    <ul class="nav">                                                  
      <li>               
        <div class="btn-group pull-left btn-under">             
            <ul class="nav">                                                  
                <li>               
                  <div class="btn-group pull-left btn-under">
                  	<?php if($pagina_anterior["numcampos"]){ ?>
                      <button enlace="<?php echo(PROTOCOLO_CONEXION.RUTA_PDF."/pantallas/documento/pagina_documento.php?idpagina=".$pagina_anterior[0]["consecutivo"]);?>" titulo="P&aacute;gina<br />Anterior" class="btn btn-mini tooltip_saia kenlace_saia_propio" type="button"><i class="icon-arrow-left">&nbsp;</i>                                         
                      </button>
                    <?php } ?>  
                    
                      <button class="btn btn-mini" type="button" disabled><span>P&aacute;gina <?php echo($pagina[0]["pagina"]);?>  de <?php echo($paginas["numcampos"]);?></span>                                         
                      </button>
                      
                    <?php if($pagina_siguiente["numcampos"]){ ?>
                      <button enlace="<?php echo(PROTOCOLO_CONEXION.RUTA_PDF."/pantallas/documento/pagina_documento.php?idpagina=".$pagina_siguiente[0]["consecutivo"]);?>" titulo="P&aacute;gina<br />Siguiente" class="btn btn-mini tooltip_saia kenlace_saia_propio" type="button"><i class="icon-arrow-right">&nbsp;</i>
                      </button>
                    <?php } ?>
                  </div>
                </li>
              </ul>             
        </div>
      </li>
    </ul>
  </div>
<?php
}
?>
