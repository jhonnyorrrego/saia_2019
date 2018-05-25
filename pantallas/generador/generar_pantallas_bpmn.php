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
include_once($ruta_db_superior . "pantallas/generador/librerias.php");
include_once($ruta_db_superior . "bpmn/bpmn/class_bpmn.php");
echo(estilo_bootstrap());
?>
<style type="text/css">
  .progress{margin-bottom:2px;}
</style>
<table class="table table-bordered">
  <thead>
    <tr class="info">
    <th>
      Nombre Pantalla
    </th>
    <th>
      Avance
    </th>
    </tr>
  </thead>
  <tbody>
    <?php
      $pantallas=busca_filtro_tabla("","pantalla A, bpmn_tarea B, bpmn_tarea_usuario C","A.idpantalla=C.fk_idpantalla AND C.fk_idbpmn_tarea=B.idbpmn_tarea AND B.fk_idbpmn=".$_REQUEST["idbpmn"],"",$conn);
      for($i=0;$i<$pantallas["numcampos"];$i++){
        echo('<tr><td>'.$pantallas[$i]["etiqueta"].'</td><td><div class="progress progress-striped progress-success"><div class="bar barra_progreso_pantalla" id="pantalla'.$pantallas[$i]["idpantalla"].'" idpantalla="'.$pantallas[$i]["idpantalla"].'"></div></div><div id="error_'.$pantallas[$i]["idpantalla"].'"></div></td></tr>');
      }
    ?>
  </tbody>
</table>
<?php
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
?>
<script type="text/javascript">
$(document).ready(function(){
  $(".barra_progreso_pantalla").each(function(){
    //TODO:generar_listar y generar_mostrar saca error en todos los casos para la generaci�n de los archivos. se evalua un $_REQUEST de los tiny se debe evaluar que se va a hacer con eso.
    var listado_generar_pantallas= new Array("generar_clase", "generar_tablas", "generar_adicionar", "generar_editar",  "generar_eliminar", "generar_version_pantalla", "generar_pantalla_libreria", "generar_buscar","generar_modulo");
    idpantalla=$(this).attr("idpantalla");
    var incremento=(100/listado_generar_pantallas.length);
    llamado_ejecutar_genera(listado_generar_pantallas,idpantalla,incremento);  
  });
});
function llamado_ejecutar_genera(generar_pantallas,idpantalla,incremento){
var porcentaje=100-(generar_pantallas.length*incremento);
$("#pantalla"+idpantalla).width(porcentaje+"%");
$("#pantalla"+idpantalla).html(Math.round(porcentaje)+"%");
//$("#pantalla"+idpantalla).parent().attr("width",porcentaje+"%");
if(generar_pantallas.length>0){                              
  //$("#error_"+idpantalla).append(idpantalla+":"+generar_pantallas.length+"-->"+generar_pantallas[0]+"<br>");
  $.ajax({
    type:'POST',
    url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias_pantalla.php",    
    data: "ejecutar_libreria_pantalla="+generar_pantallas[0]+"&parametros=1&idpantalla="+idpantalla+"&rand="+Math.round(Math.random()*100000),	            	           
    success: function(html){                
      if(html){          
        var objeto=jQuery.parseJSON(html);                  
        if(!objeto.exito){
          //alert(generar_pantallas[0]+"<br>"+"#error_"+idpantalla);                    
          $("#error_"+idpantalla).append(generar_pantallas[0]+"<br>");
          if(objeto.descripcion_error!==undefined){
            $("#error_"+idpantalla).append(objeto.descripcion_error+"<br>");
          }
          $("#pantalla"+idpantalla).parent().removeClass("progress-success");
          $("#pantalla"+idpantalla).parent().addClass("progress-danger");
        }
        generar_pantallas.shift();
        setTimeout(function(){},500);
        return(llamado_ejecutar_genera(generar_pantallas,idpantalla,incremento)); 
      }
    }
  });
}
return;
}
</script>
