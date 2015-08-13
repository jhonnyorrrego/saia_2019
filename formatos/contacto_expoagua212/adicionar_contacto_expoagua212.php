<html><title>.:ADICIONAR CONTACTO EXPOAGUAS 2012:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">CONTACTO EXPOAGUAS 2012</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(962)); ?>"><input type="hidden" name="idft_contato_expoagua2012" value="<?php echo(validar_valor_campo(968)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(969)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(80,970);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(971)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(972)); ?>"><tr>
                     <td class="encabezado" width="20%" title="Nombre">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre_persona" name="nombre_persona"  value="<?php echo(validar_valor_campo(966)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Correo electr&oacute;nico de contacto">E-MAIL*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="email" name="email"  value="<?php echo(validar_valor_campo(964)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Tel&eacute;fono fijo para establecer contacto">TEL&Eacute;FONO FIJO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="telefono" name="telefono"  value="<?php echo(validar_valor_campo(967)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Tel&eacute;fono celular">TEL&Eacute;FONO CELULAR</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="celular" name="celular"  value="<?php echo(validar_valor_campo(963)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Mensaje de la solicitud">MENSAJE DE LA SOLICIUTUD*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="mensaje" id="mensaje" cols="53" rows="3" class="tiny_avanzado required"><?php echo(validar_valor_campo(965)); ?></textarea></td>
                    </tr><input type="hidden" name="campo_descripcion" value="965,966"><tr><td colspan='2'><?php submit_formato(80);?></td></tr></table></form></body></html>