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
$funcion=str_replace(")","",$_REQUEST["funcion"]);
$funcion_actual=explode("(",$funcion);
$funcion_bd=busca_filtro_tabla("", "pantalla_libreria A, pantalla_funcion B, pantalla_funcion_exe C,pantalla_func_param D","A.idpantalla_libreria=B.fk_idpantalla_libreria AND B.idpantalla_funcion=C.fk_idpantalla_funcion AND C.idpantalla_funcion_exe=D.fk_idpantalla_funcion_exe AND A.ruta='".trim($_REQUEST["ruta"])."' AND B.nombre='".$funcion_actual[0]."'", "idpantalla_funcion_exe desc", $conn);

for($i=0;$i<$funcion_bd["numcampos"];$i++){
  echo('<input type="hidden" id="default_parametro_'.$funcion_bd[$i]["nombre"].'" value="'.$funcion_bd[$i]["valor"].'" tipo="'.$funcion_bd[$i]["tipo"].'">');
}
$lcampos=busca_filtro_tabla("","pantalla_campos","pantalla_idpantalla=".$_REQUEST["idpantalla"],"",$conn);
$listado_campos_formulario='<select name="lparametros" class="lparametros">';

if($lcampos["numcampos"]){
  for($i=0;$i<$lcampos["numcampos"];$i++){
    $listado_campos_formulario.='<option value="'.$lcampos[$i]["idpantalla_campos"].'">'.$lcampos[$i]["etiqueta"].'</option>';
  }
}
$listado_campos_formulario.='</select>';
$input_variable_formulario='<input type="text" name="_dato" value="" class="lparametros">';
?>

  <?php
    $form_ini='';
    $form_fin='';
    if(@$_REQUEST['funcion_mostrar']){
        $form_ini='<form id="form_funcion_mostrar">';
        $form_fin='</form>';
    }
  ?>

   <?php echo($form_ini); ?>
  <div class="control-group">
    <input type="hidden" name="funcion" value="<?php echo($funcion_actual[0])?>">
    <?php
    if(@$funcion_actual[1]&& $funcion_actual[1]!=''){ ?>


    <table class="table table-bordered">
      <thead><th>Variable</th><th>Selecci&oacute;n</th><th>Valor</th></thead>
      <?php
        $parametros_tmp=array();
        $parametros_actual=explode(",",$funcion_actual[1]);
        foreach($parametros_actual AS $kparametro=>$vparametro){
          if(strpos($vparametro,"=")){
            $temp_parametro=explode("=",$vparametro);
            if($temp_parametro[0]){
              $vparametro=$temp_parametro[0];
            }
          }
          if($vparametro!=''){
            array_push($parametros_tmp, $vparametro);
            echo('<tr><td>'.$vparametro.'</td><td>'.selector_variable_funcion_pantalla($vparametro).'</td><td>'.opciones_variable_funcion_pantalla($vparametro).'</td></tr>');
          }
        }
      ?>
    </table>

    <input type="hidden" name="parametros" value="<?php echo(implode(",", str_replace("$","",$parametros_tmp)));?>" id="parametros">
     <?php echo($form_fin); ?>
    <?php
      }
    ?>
  </div>

  <?php
    if(@$_REQUEST['funcion_mostrar']){
        include_once($ruta_db_superior."librerias_saia.php");
        echo(estilo_bootstrap());
        //echo(librerias_jquery('1.7'));
        echo(librerias_notificaciones());

  ?>
      <div class="form-actions">
        <input type="hidden" name="pantalla_idpantalla" value="<?php echo(@$_REQUEST['idpantalla']);?>" id="pantalla_idpantalla">
        <input type="hidden" name="ruta_libreria" value="<?php echo(@$_REQUEST['ruta_libreria']);?>" id="ruta_libreria">

        <input type="hidden" name="accion" value="mostrar" id="accion">
        <input type="hidden" name="momento" value="1" id="momento">
        <button type="button" class="btn btn-primary enviar_formulario_saia" >Aceptar</button>
        <button type="button" class="btn" onclick="window.parent.hs.close();" >Cancel</button>
      </div>


      <script>
        $(document).ready(function(){
            $(".seleccion_variable_funcion_pantalla").live("change",function(){
              var opcion=$(this).val();
              var nombre=$(this).attr("name");
              nombre=nombre.replace("div_","");
              if(opcion==1){
                $("#"+$(this).attr("name")).html('<?php echo($listado_campos_formulario);?>');
              }
              else if(opcion==2){
                $("#"+$(this).attr("name")).html('<?php echo($input_variable_formulario);?>');
              }
              else if(opcion==3){
                $("#"+$(this).attr("name")).html('<?php echo($input_variable_formulario);?>');
              }
              else if(opcion==4){
                $("#"+$(this).attr("name")).html('<?php echo($input_variable_formulario);?>');
              }
              $("#"+$(this).attr("name")).find(".lparametros").attr("name",nombre+"_dato");
              $("#"+$(this).attr("name")).find(".lparametros").attr("id",nombre+"_dato");
            });
            $(".enviar_formulario_saia").live("click",function(){
              var formulario = $("#form_funcion_mostrar");
              var nombre_form = $('[name="funcion"]').val();   //nombre funcion sin parametros
              var nombre_funcion=nombre_form;  //nombre funcion sin parametros
              var ruta=$("#ruta_libreria").val();     //formatos/ft_prueba_oct_12/funciones.php
                  $.ajax({
                    type:'POST',
                    url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
                    data: "ejecutar_pantalla_campo=guardar_configurar_pantalla_libreria&tipo_retorno=1&accion=mostrar&ruta="+ruta+"&pantalla_idpantalla=<?php echo($_REQUEST['idpantalla']);?>&rand="+Math.round(Math.random()*100000)+"&"+formulario.serialize(),
                    success: function(html){
                      if(html){
                        var objeto=jQuery.parseJSON(html);
                        if(objeto.exito){
                          $("#cantidad_"+nombre_funcion).html(objeto.cantidad);
                          $('#cargando_enviar_'+nombre_form).html("Terminado ...");
                          notificacion_saia(objeto.mensaje,"success","",2500);

                          window.parent.$('#idpantalla_funcion_exe').val(objeto.idpantalla_funcion_exe);
                          window.parent.$('#nombre_funcion_insertar').val(nombre_funcion);
                          window.parent.$('#idpantalla_funcion_exe').trigger('change');
                        }
                        else{
                          $('#cargando_enviar_'+nombre_form).html("Terminado ...");
                          notificacion_saia(objeto.mensaje,"error","",2500);
                        }
                      }

                      window.parent.hs.close();
                    }
                  });
            });

        });
      </script>

  <?php
    }
  ?>

  <!--div class="form-actions">
    <button type="button" class="btn btn-primary enviar_formulario_saia" formulario="formulario_<?php echo($funcion_actual[0]);?>" nombre="<?php echo($funcion_actual[0]);?>">Aceptar</button>
    <button type="button" class="btn cancelar_formulario_saia" formulario="formulario_<?php echo($funcion_actual[0]);?>" nombre="<?php echo($funcion_actual[0]);?>">Cancel</button>
    <div class="pull-right" id="cargando_enviar_<?php echo($funcion_actual[0]);?>"></div>
  </div-->
<?php
function selector_variable_funcion_pantalla($valor){
  $valor=str_replace("$","",$valor);
  $texto='';
  //value=1 define que se va a adicionar un campo del listado de campos y value=2 define un Dato Fijo
  $texto.='Campo <input type="radio" id="div1_'.$valor.'" name="div_'.$valor.'" class="seleccion_variable_funcion_pantalla" value="1"> | ';
  $texto.='Dato <input type="radio" id="div2_'.$valor.'" name="div_'.$valor.'" class="seleccion_variable_funcion_pantalla" value="2" checked="checked"> | ';
	$texto.='Request <input type="radio" id="div3_'.$valor.'" name="div_'.$valor.'" class="seleccion_variable_funcion_pantalla" value="3"> | ';
	$texto.='Clase <input type="radio" id="div4_'.$valor.'" name="div_'.$valor.'" class="seleccion_variable_funcion_pantalla" value="4">';
  return($texto);
}
function opciones_variable_funcion_pantalla($valor){
  $valor=str_replace("$","",$valor);
  return('<div id="div_'.$valor.'"><input type="text" name="'.$valor.'_dato" value="" class="lparametros" id="'.$valor.'_dato"></div>');
}
?>
