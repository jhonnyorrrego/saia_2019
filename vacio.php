<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_highslide());
echo(librerias_jquery('1.7'));

$button = "<button id='cambiar_responsable_seguimiento'>Cambiar responsables</button><br />";
echo($button);
$idformato=1;
$iddoc =2
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#cambiar_responsable_seguimiento").click(function(){
            var enlaces='<?php echo($ruta_db_superior);?>formatos/hallazgo_plan_mejoramiento/editar_funcionario_responsable.php?idformato=<?php echo($idformato); ?>&iddocumento=<?php echo($iddoc); ?>&campo=area_func_seguimiento';
            
            hs.graphicsDir = 'anexosdigitales/highslide-4.0.10/highslide/graphics/datos/';
            hs.outlineType = 'rounded-white';
            hs.htmlExpand( this, {
                src: enlaces,
                objectType: 'iframe',
                outlineType: 'rounded-white',
                wrapperClassName: 'highslide-wrapper drag-header',
                preserveContent: false,
                width: 600,
                height: 300
            });

            hs.Expander.prototype.onAfterClose = function() {
                window.location = "<?php echo($ruta_db_superior); ?>formatos/hallazgo_plan_mejoramiento/mostrar_hallazgo_plan_mejoramiento.php?iddoc=<?php echo($iddoc); ?>&idformato=<?php echo($idformato); ?>";
            }
        });
    });
</script>