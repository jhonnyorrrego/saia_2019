<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "assets/librerias.php";
include_once $ruta_db_superior . "librerias_saia.php";

global $conn;

$iddocumento = $_REQUEST["key"];
$documento = busca_filtro_tabla("*", "documento a,formato b", "lower(a.plantilla) = lower(b.nombre) and a.iddocumento=" . $iddocumento, "", $conn);

if (!$_REQUEST["mostrar_formato"] || !$documento[0]["plantilla"]) {
    $valores = array();
    foreach ($_REQUEST as $nombre => $valor) {
        $valores[] = $nombre . "=" . $valor;
    }
    redirecciona("ordenar_paginas.php?" . implode("&", $valores));
}

if ($documento['numcampos']) {
    $llave = "idformato=" . $documento[0]["idformato"] . "&iddoc=" . $iddocumento;
    $_SESSION["iddoc"] = $iddocumento;

    leido(usuario_actual("funcionario_codigo"), $iddocumento);
} else {
    alerta("No se ha podido encontrar el Documento");
}

echo jquery();
echo bootstrap();
echo librerias_arboles();
echo librerias_principal();
echo librerias_highslide();
?>
<style>
    #detalles{height:100%; }
    #panel_arbol_formato{border:0px solid;}
    body{ padding-right: 0px; padding-left: 0px;height:100%}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="d-none d-md-block col-md-3 px-0 mx-0">
            <div id="izquierdo_saia" ></div>
        </div>
        <div class="col-12 col-md-9 px-0 mx-0">
            <div id="contenedor_saia"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var alto = $(window).height()-8;

    function llamado_pantalla(ruta,datos,destino,nombre){
        if(datos){
            ruta += "?" + datos;
        }

        if(nombre === "<?php echo ($_REQUEST['destino_click']); ?>"){
            ruta = ruta+'&click_clase=<?php echo ($_REQUEST['click_clase']); ?>';
        }
    
        destino.html('<div id="panel_'+nombre+'"><iframe name="'+nombre+'" src="'+ruta+'" width="100%" id="'+nombre+'" frameborder="0"></iframe></div>');
    }

    $(document).ready(function(){
        $("#panel_arbol_formato").height(alto);
        $("#arbol_formato").height(alto-2);
        $("#panel_detalles").height(alto);
    });
</script>
<?php if ($documento["numcampos"]) : ?>
    <script type="text/javascript">
        llamado_pantalla("pantallas/documento/informacion_resumen_documento.php","<?php if ($_REQUEST['click_mostrar']) {echo ('click_mostrar=1&');}?>form_info=<?php echo ($llave); ?>&alto_pantalla="+(alto-1),$("#izquierdo_saia"),"arbol_formato");
        
        <?php if (!$_REQUEST['click_mostrar']): ?>
            llamado_pantalla("","",$("#contenedor_saia"),'detalles');
        <?php endif; ?>

        hs.graphicsDir = '<?php echo ($ruta_db_superior); ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
        hs.outlineType = 'rounded-white';
        hs.Expander.prototype.onAfterClose = function() {
            if (this.isClosing) {
                var data=this.a.id;
                window.frames.arbol_formato.click_funcion(data);
            }
        }
    </script>
<?php else :?>
    <script type="text/javascript">
        $("#izquierdo_saia").html(<?php echo ($documento[0]["descripcion"]); ?>);
        llamado_pantalla("pantallas/documento/listado_paginas.php","iddoc=<?php echo ($iddocumento); ?>",$("#contenedor_saia"));
    </script>
<?php endif; ?>