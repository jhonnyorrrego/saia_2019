<html><title>.:ADICIONAR RESPUESTA A QUEJA POR CALIDAD DEL AGUA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../calidad_agua/../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">RESPUESTA A QUEJA POR CALIDAD DEL AGUA</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(911)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(919)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(76,920);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(921)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(922)); ?>"><input type="hidden" name="asunto" value="<?php echo(validar_valor_campo(924)); ?>"><input type="hidden" name="idft_respuesta_calidad_aguas" value="<?php echo(validar_valor_campo(925)); ?>"><tr>
                     <td class="encabezado" width="20%" title="consecutivo">CONSECUTIVO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="consecutivo" name="consecutivo"  value="<?php echo(validar_valor_campo(912)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="fecha de creaci&oacute;n">FECHA*</td>
                     <?php fecha_formato(76,915);?></tr><tr>
                   <td class="encabezado" width="20%" title="">DESTINO*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="3000"  class="required"  name="destinos" id="destinos" value=""><?php componente_ejecutor("917",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="lugar de toma de la muestra">LUGAR DE TOMA DE LA MUESTRA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="lugar_muestra" name="lugar_muestra"  value="<?php echo(validar_valor_campo(913)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="queja">QUEJA*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="queja" id="queja" cols="53" rows="3" class="tiny_avanzado required"><?php echo(validar_valor_campo(914)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="iniciales de quien prepar&ograve; el documento">PREPAR&Oacute;*</td>
                     <?php iniciales(76,916);?></tr><?php asignar_responsables(76,NULL);?><input type="hidden" name="campo_descripcion" value="914,924"><tr><td colspan='2'><?php submit_formato(76);?></td></tr></table></form></body></html>