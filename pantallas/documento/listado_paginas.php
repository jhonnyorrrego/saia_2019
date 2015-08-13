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
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/menu_principal_documento.php");
echo(menu_principal_documento($_REQUEST["iddoc"],@$_REQUEST["vista"]));
$paginas=paginas_documento($_REQUEST["iddoc"],1);
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_ventana_modal.js"></script>
<?php
if($paginas["numcampos"]){
    $ancho_imagen=  busca_filtro_tabla("", "configuracion", "nombre='ancho_imagen'", "", $conn);
    $alto_imagen=  busca_filtro_tabla("", "configuracion", "nombre='alto_imagen'", "", $conn);
    if(!$alto_imagen["numcampos"]){
        $alto_imagen[0]["valor"]=1125;
    }
    if(!$ancho_imagen["numcampos"]){
        $ancho_imagen[0]["valor"]=935;
    }
    for($i=0;$i<$paginas["numcampos"];$i++){
        echo('
            <div>                                                        
               <img  src="'.$ruta_db_superior.'imagenes/gris_imagenes.gif" data-original="'.$ruta_db_superior.$paginas[$i]["ruta"].'" width="'.$ancho_imagen[0]["valor"].'" height="'.$alto_imagen[0]["valor"].'" ancho_ventana_modal="550px" alt="" class="img-polaroid enlace_ventana_modal" enlace_ventana_modal="'.PROTOCOLO_CONEXION.RUTA_PDF.'/pantallas/documento/pagina_documento.php?idpagina='.$paginas[$i]["consecutivo"].'" encabezado_ventana_modal="P&aacute;gina '.$paginas[$i]["pagina"].' de '.$paginas["numcampos"].'">              
            </div>');
    }
}
else{
    
}
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.lazy.js"></script>
<!--script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_ventana_modal.js"></script-->
<!--script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.nicescroll.js"></script-->
<script type="text/javascript">
$(document).ready(function() {        
    $("img").lazyload({
        effect : "fadeIn"
    });
 });  
</script>    
<?php
function barra_paginas_documento($pagina){
    global $ruta_db_superior;
?>
<div>
<!--div class="div_nav" style="height: 10px; min-height: 25px;">                      
    <ul class="nav">                                                  
      <li id="accesos_rapidos_li">               
        <div class="btn-group pull-left btn-under">             
            <?php
            echo(permisos_modulo_menu_intermedio("rapidos_menu_intermedio",0));
            ?>
        </div>
      </li>
    </ul>   
</div-->  
</div>
<?php
}
?>