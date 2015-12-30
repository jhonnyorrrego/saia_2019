<html><title>.:EDITAR AUTORIZACION SALIDA DE PLANTA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.clock.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">AUTORIZACION SALIDA DE PLANTA</td></tr><input type="hidden" name="control_interno" value="<?php echo(mostrar_valor_campo('control_interno',331,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_control" value="<?php echo(mostrar_valor_campo('fecha_control',331,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_salida_planta" value="<?php echo(mostrar_valor_campo('idft_salida_planta',331,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',331,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(331,3884,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',331,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',331,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">TURNO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(331,3874,$_REQUEST['iddoc']);?></td></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA SALIDA</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  name="fecha_salida" id="fecha_salida" tipo="fecha" value="<?php mostrar_valor_campo('fecha_salida',331,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_salida","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                    <td class="encabezado" width="20%" title="">HORA SALIDA*</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='2'  type="text"  name="hora_salida"  class="required"  id="hora_salida" value="<?php mostrar_valor_campo('hora_salida',331,$_REQUEST['iddoc']); ?>"></span></font><script type="text/javascript">
                      $(function(){
                        var now = $('#hora_salida').val();
                        vector=now.split(":");
                        var h=vector[0];
                        var m=vector[1];
                        var s=0;

                        $('#hora_salida').clock({displayFormat:'24',
                                         defaultHour:h,
                                         defaultMinute:m,
                                         defaultSecond:s
                                         });
                      });
                      </script></td><tr>
                       <td class="encabezado" width="20%" title="">FECHA ENTRADA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='3'  type="text" readonly="true"  class="required dateISO"  name="fecha_entrada" id="fecha_entrada" tipo="fecha" value="<?php mostrar_valor_campo('fecha_entrada',331,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_entrada","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                    <td class="encabezado" width="20%" title="">HORA ENTRADA*</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='4'  type="text"  name="hora_entrada"  class="required"  id="hora_entrada" value="<?php mostrar_valor_campo('hora_entrada',331,$_REQUEST['iddoc']); ?>"></span></font><script type="text/javascript">
                      $(function(){
                        var now = $('#hora_entrada').val();
                        vector=now.split(":");
                        var h=vector[0];
                        var m=vector[1];
                        var s=0;

                        $('#hora_entrada').clock({displayFormat:'24',
                                         defaultHour:h,
                                         defaultMinute:m,
                                         defaultSecond:s
                                         });
                      });
                      </script></td><tr id="tr_motivo_salida" >
                     <td class="encabezado" width="20%" title="">MOTIVO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(331,3879,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">MOTIVO PERMISO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='5'  type="text" size="100" id="motivo_permiso" name="motivo_permiso"  value="<?php echo(mostrar_valor_campo('motivo_permiso',331,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones',331,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><?php ocultar_mostrar_motivo(331,NULL,$_REQUEST['iddoc']);?><?php validar_fecha_menor_formato_autorizacion_salida(331,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('3879'); ?>"><input type="hidden" name="formato" value="331"><tr><td colspan='2'><?php submit_formato(331,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>