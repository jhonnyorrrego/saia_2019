<html><title>.:ADICIONAR RESPUESTA A SOLICITUDES WEB:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">RESPUESTA A SOLICITUDES WEB</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(955)); ?>"><input type="hidden" name="idft_respuesta_solicitud_web" value="<?php echo(validar_valor_campo(957)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(958)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(79,959);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(960)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(961)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ASUNTO*</td>
                     <?php asunto_predeterminado(79,973);?></tr><tr>
                     <td class="encabezado" width="20%" title="Descripci&oacute;n de la respuesta que se esta generando">CUERPO DE LA RESPUESTA*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="cuerpo_respuesta" id="cuerpo_respuesta" cols="53" rows="3" class="tiny_avanzado required"><?php echo(validar_valor_campo(956)); ?></textarea></td>
                    </tr><input type="hidden" name="campo_descripcion" value="973"><tr><td colspan='2'><?php submit_formato(79);?></td></tr></table></form></body></html>