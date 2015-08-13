<html><title>.:EDITAR RESPUESTA A QUEJA POR CALIDAD DEL AGUA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">RESPUESTA A QUEJA POR CALIDAD DEL AGUA</td></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',76,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(76,920,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',76,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',76,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="asunto" value="<?php echo(mostrar_valor_campo('asunto',76,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_respuesta_calidad_aguas" value="<?php echo(mostrar_valor_campo('idft_respuesta_calidad_aguas',76,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="consecutivo">CONSECUTIVO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="consecutivo" name="consecutivo"  value="<?php echo(mostrar_valor_campo('consecutivo',76,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="fecha de creaci&oacute;n">FECHA*</td>
                     <?php fecha_formato(76,915,$_REQUEST['iddoc']);?></tr><tr>
                   <td class="encabezado" width="20%" title="">DESTINO*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="3000"  class="required"  name="destinos" id="destinos" value="<?php echo(mostrar_valor_campo('destinos',76,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("917",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="lugar de toma de la muestra">LUGAR DE TOMA DE LA MUESTRA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="lugar_muestra" name="lugar_muestra"  value="<?php echo(mostrar_valor_campo('lugar_muestra',76,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="queja">QUEJA*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="queja" id="queja" cols="53" rows="3" class="tiny_avanzado required"><?php echo(mostrar_valor_campo('queja',76,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="iniciales de quien prepar&ograve; el documento">PREPAR&Oacute;*</td>
                     <?php iniciales(76,916,$_REQUEST['iddoc']);?></tr><input type="hidden" name="campo_descripcion" value="<?php echo('914,924'); ?>"><input type="hidden" name="formato" value="76"><tr><td colspan='2'><?php submit_formato(76,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>