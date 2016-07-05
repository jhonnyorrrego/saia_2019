<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
echo(librerias_jquery('1.7'));

function bases_calidad_ocultar_tipo($idformato,$iddoc){
    global $conn;
    
    $datos=busca_filtro_tabla("","ft_bases_calidad a, documento b","b.iddocumento=a.documento_iddocumento AND lower(b.estado)='aprobado'","",$conn);
    $cantidad=$datos['numcampos'];
    $tipos_existentes=implode(',',(extrae_campo($datos,'tipo_base_calidad')));
    ?>
        <script>
            $(document).ready(function(){
                var registros='<?php echo($tipos_existentes); ?>';
                var vector_registros=registros.split(',');
                var cantidad=parseInt('<?php echo($cantidad); ?>');
                for(i=0;i<cantidad;i++){
                     $('[name="tipo_base_calidad"][value="'+vector_registros[i]+'"]').parent().parent().css('pointer-events','none').css('color','gray');
                     $('[name="tipo_base_calidad"][value="'+vector_registros[i]+'"]').attr('disabled','disabled');
                }
            });
        </script>
    <?php
}

function mostrar_anexos_soporte($idformato,$iddoc){
    global $conn,$ruta_db_superior;    
    
    
    
    
}
function mostrar_ocultar_anexo_bases_calidad(){
    
}

?>