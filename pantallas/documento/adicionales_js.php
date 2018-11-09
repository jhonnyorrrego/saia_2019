<script>
$(function(){
    $(".documento_prioridad").live("click",function(){
        var idregistro=$(this).attr("idregistro");

        if($(this).attr("prioridad") != $("#prioridad_"+idregistro).attr("prioridad")){
            var clase=$(this).children("i").attr("class");
            var prioridad=$(this).attr("prioridad");
            $.post('<?php echo($ruta_db_superior."pantallas/documento/");?>actualizar_prioridad_documento.php',{iddocumento: idregistro,prioridad:prioridad}, function(resultado){
                if(resultado){
                    $("#prioridad_"+idregistro).removeClass();
                    $("#prioridad_"+idregistro).addClass(clase);
                    $("#prioridad_"+idregistro).attr("prioridad",prioridad);
                    $("#div_actualizar_info_index", window.top.document).click();
                }
            });
        }
    });

    $(".exportar_listado_saia").click(function(){
        $("#barra_exp_ppal").html('<img src="<?php echo($ruta_db_superior); ?>imagenes/cargando.gif">');
        
        var docus=$("#seleccionados").val();
        if(docus){
            $.ajax({
                async: false,
                url: "procesa_filtro_busqueda.php",
                data:"adicionar_consulta=1&json=1&bqsaia_a@iddocumento="+docus+"&bksaiacondicion_a@iddocumento=in&bqsaiaenlace_a@iddocumento=y&idbusqueda_componente=<?php echo $datos_busqueda[0]["idbusqueda_componente"]; ?>",
                type:"post",
                dataType:"json",
                success: function(data){
                        if(data.exito){
                        var dato_filtro=data.filtro.replace("&idbusqueda_filtro_temp=","");
                        exportar_funcion_excel(dato_filtro);
                    }
                    else{
                        alert(data.mensaje);
                    }
                }
            });
        }else{
            exportar_funcion_excel('<?php echo($_REQUEST["idbusqueda_filtro_temp"]); ?>');
        }
    });

    function exportar_funcion_excel(idfiltro){
        var busqueda_total=$("#busqueda_total_paginas").val();
        var ruta_file="temporal_<?php echo(usuario_actual('login'));?>/reporte_<?php echo($datos_busqueda[0]["nombre"].'_'.date('Ymd').'.xls'); ?>";
        var url="exportar_saia.php?idbusqueda_componente=<?php echo $datos_busqueda[0]["idbusqueda_componente"]; ?>&page=1&exportar_saia=excel&ruta_exportar_saia="+ruta_file+"&rows="+$("#busqueda_registros").val()+"&actual_row=0&variable_busqueda="+$("#variable_busqueda").val()+"&idbusqueda_filtro_temp="+idfiltro+"&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>";
        window.open(url,"iframe_exportar_saia");
    }
});
</script>
