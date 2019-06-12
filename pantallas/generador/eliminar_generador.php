<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } ?><meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap_reescribir.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap_iconos_segundarios.css"/>
<?php include_once $ruta_db_superior . 'core/autoload.php'; ?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery-1.7.min.js"></script>
<?php include_once($ruta_db_superior."librerias_saia.php"); ?>
<?php include_once($ruta_db_superior."pantallas/lib/mobile_detect.php"); ?><?php $detect = new Mobile_Detect;
  if ( $detect->isMobile() ) {
    $tipo_form="form";
  }
  else{
    $tipo_form="form-horizontal";
  }?>
<?php include_once($ruta_db_superior."pantallas/generador/class_generador.php"); ?>
<?php include_once($ruta_db_superior."pantallas/generador/text/procesar_componente.php"); ?>
<?php include_once($ruta_db_superior."pantallas/generador/select/procesar_componente.php"); ?>
<?php include_once($ruta_db_superior."pantallas/generador/hidden/procesar_componente.php"); ?><?php 
  $generador= new generador();
  $generador->get_generador($_REQUEST["idgenerador"]);
  if(!$generador->existe_generador()){
          alerta("Error al tratar de obtener el registro seleccionado","error",ERROR_NOTIFICACIONES_SAIA);
  }
  ?><form class="<?php echo($tipo_form); ?>" name="formulario_generador" id="formulario_generador" method="post" enctype="multipart/form-data"><input type="hidden" name="idgenerador" value="<?php echo($_REQUEST["idgenerador"]);?>"><div class="control-group element" idpantalla_componente="7" idpantalla_campo="2292" id="pc_2292" nombre="select"><label class="control-label" for="tipo"><b>Tipo *</b></label><div class="controls"><?php  echo(procesar_select(2292,$generador->get_valor_generador("generador","tipo"),"editar",$generador->get_campo_generador("tipo"))); ?>
</div></div><div class="control-group element" idpantalla_componente="1" idpantalla_campo="2293" id="pc_2293" nombre="text"><label class="control-label" for="primer_nombre"><b>Primer Nombre *</b></label><div class="controls"><input type="text" name="primer_nombre" maxlength="255" class="elemento_formulario" placeholder="" idpantalla_campos="2293" value="<?php  echo(procesar_texto(2293,$generador->get_valor_generador("generador","primer_nombre"),"editar",$generador->get_campo_generador("primer_nombre"))); ?>
" id="primer_nombre" /><?php  echo(procesar_opcion_buscar(2293,$generador->get_valor_generador("generador","primer_nombre"),"editar",$generador->get_campo_generador("primer_nombre"))); ?>
</div></div><div class="control-group element" idpantalla_componente="1" idpantalla_campo="2294" id="pc_2294" nombre="text"><label class="control-label" for="campo_texto_856139374"><b>Campo de texto </b></label><div class="controls"><input type="text" name="campo_texto_856139374" maxlength="255" class="elemento_formulario" placeholder="Campo texto" idpantalla_campos="2294" value="<?php  echo(procesar_texto(2294,$generador->get_valor_generador("generador","campo_texto_856139374"),"editar",$generador->get_campo_generador("campo_texto_856139374"))); ?>
" id="campo_texto_856139374" /><?php  echo(procesar_opcion_buscar(2294,$generador->get_valor_generador("generador","campo_texto_856139374"),"editar",$generador->get_campo_generador("campo_texto_856139374"))); ?>
</div></div><div class="control-group element" idpantalla_componente="1" idpantalla_campo="2295" id="pc_2295" nombre="text"><label class="control-label" for="campo_texto_1744857069"><b>Campo de texto *</b></label><div class="controls"><input type="text" name="campo_texto_1744857069" maxlength="255" class="elemento_formulario" placeholder="Campo texto" idpantalla_campos="2295" value="<?php  echo(procesar_texto(2295,$generador->get_valor_generador("generador","campo_texto_1744857069"),"editar",$generador->get_campo_generador("campo_texto_1744857069"))); ?>
" id="campo_texto_1744857069" /><?php  echo(procesar_opcion_buscar(2295,$generador->get_valor_generador("generador","campo_texto_1744857069"),"editar",$generador->get_campo_generador("campo_texto_1744857069"))); ?>
</div></div><div class="control-group element" idpantalla_componente="1" idpantalla_campo="2296" id="pc_2296" nombre="text"><label class="control-label" for="campo_texto_1634717074"><b>Campo de texto *</b></label><div class="controls"><input type="text" name="campo_texto_1634717074" maxlength="255" class="elemento_formulario" placeholder="Campo texto" idpantalla_campos="2296" value="<?php  echo(procesar_texto(2296,$generador->get_valor_generador("generador","campo_texto_1634717074"),"editar",$generador->get_campo_generador("campo_texto_1634717074"))); ?>
" id="campo_texto_1634717074" /><?php  echo(procesar_opcion_buscar(2296,$generador->get_valor_generador("generador","campo_texto_1634717074"),"editar",$generador->get_campo_generador("campo_texto_1634717074"))); ?>
</div></div><input type="hidden" name="key_formulario_saia" value="<?php echo(generar_llave_md5_saia());?>"><input type="hidden" name="fk_idbpmni" value="<?php echo($_REQUEST["bpmni"]);?>"><input type="hidden" name="fk_idbpmn_tarea" value="<?php echo($_REQUEST["idbpmn_tarea"]);?>"><input type="hidden" id="fk_documento_anterior" name="fk_documento_anterior" value="<?php echo($_REQUEST["fk_documento_anterior"]);?>"><div class="form-actions">
            <div class="btn btn-primary btn-mini" id="submit_formulario_generador">Aceptar</div>
            <!--div class="btn btn-mini" id="cancel_formulario_generador">Cancelar</div-->
            <div id="cargando_enviar" class="pull-right"></div>
          </div></form>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/idiomas/jquery.validates.es.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.validate_adicionales.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/themes/default.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_notificaciones.js"></script><script type="text/javascript">
  $(document).ready(function(){
    var formulario_generador=$("#formulario_generador");$("#submit_formulario_generador").click(function(){if (typeof(tinyMCE)!="undefined") 
           							tinyMCE.triggerSave();
  if(formulario_generador.valid()){ 
$('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
$(this).attr('disabled', 'disabled');
$.ajax({
  type:'POST',
  url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias_generador.php",
  data: "ejecutar_generador=delete_generador&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+formulario_generador.serialize(),
  success: function(html){                
    if(html){          
      var objeto=jQuery.parseJSON(html);                  
      if(objeto.exito){
        $('#cargando_enviar').html("Terminado ...");notificacion_saia(objeto.mensaje,"success","",2500);     	
      }
      else{
        $('#cargando_enviar').html("Terminado ...");notificacion_saia(objeto.mensaje,"error","",8500);
      }                  
    }          
  }
  	});
    }
    else{
      notificacion_saia("Formulario con errores","error","",8500);
    }
    });

});  
</script>