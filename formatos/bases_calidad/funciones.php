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
                }
            });
        </script>
    <?php
}

function mostrar_anexos_soporte($idformato,$iddoc){
    global $conn,$ruta_db_superior;    
    $serie_mapa_proceso=busca_filtro_tabla("idserie","serie","lower(nombre)='mapa de proceso'","",$conn);
    $datos=busca_filtro_tabla("tipo_base_calidad,documento_iddocumento","ft_bases_calidad","documento_iddocumento=".$iddoc,"",$conn); 
    $mapa_proceso=busca_filtro_tabla("","anexos","documento_iddocumento=".$datos[0]['documento_iddocumento'],"",$conn);
    
    if($serie_mapa_proceso[0]['idserie']==$datos[0]['tipo_base_calidad']){
        if($mapa_proceso['numcampos']){
            $cadena='</td></tr><tr><td style="text-align:left;" class="encabezado_list">Mapa de Proceso</td><td>';
            $cadena.="<li><a href='".$ruta_db_superior.$mapa_proceso[0]['ruta']."' target='_blank'>Ver</a></li>";
            echo($cadena);
        }
    }    
}
function mostrar_ocultar_anexo_bases_calidad($idformato,$iddoc){
     global $conn,$ruta_db_superior;  
     
     $serie_mapa_proceso=busca_filtro_tabla("idserie","serie","lower(nombre) LIKE'mapa de proceso%'","",$conn);
     $idserie_mapa_proceso="";
     if($serie_mapa_proceso['numcampos']){
         $idserie_mapa_proceso=$serie_mapa_proceso[0]['idserie'];
     }
     
     if(@$_REQUEST['iddoc']){
         $datos_editar=busca_filtro_tabla("tipo_base_calidad","ft_bases_calidad","documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
         ?>
     <script>
         $(document).ready(function(){
             
             if(parseInt('<?php echo($idserie_mapa_proceso); ?>')!=parseInt('<?php echo($datos_editar[0]['tipo_base_calidad']); ?>')){
                  $('#anexo_admin').parent().parent().parent().hide();
             }
             
             $('[name="tipo_base_calidad"]').click(function(){
                 var valor=$(this).val();
                
                 if( parseInt('<?php echo($idserie_mapa_proceso); ?>')==parseInt(valor) ){
                      $('#anexo_admin').parent().parent().parent().show();
                 }else{
                      $('#anexo_admin').parent().parent().parent().hide();
                 }
                 
             });
         });
     </script>         
         <?php
     }else{
     ?>
     <script>
         $(document).ready(function(){
             $('[name="anexo_soporte[]"]').parent().parent().parent().hide();
             
             $('[name="tipo_base_calidad"]').click(function(){
                 var valor=$(this).val();
                
                 if( parseInt('<?php echo($idserie_mapa_proceso); ?>')==parseInt(valor) ){
                      $('[name="anexo_soporte[]"]').parent().parent().parent().show();
                 }else{
                      $('[name="anexo_soporte[]"]').parent().parent().parent().hide();
                 }
                 
             });
             
         });
     </script>
     
     <?php
     }
}

?>