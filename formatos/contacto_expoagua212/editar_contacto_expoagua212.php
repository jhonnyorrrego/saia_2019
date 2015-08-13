<html><title>.:EDITAR CONTACTO EXPOAGUAS 2012:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">CONTACTO EXPOAGUAS 2012</td></tr><input type="hidden" name="idft_contato_expoagua2012" value="<?php echo(mostrar_valor_campo('idft_contato_expoagua2012',80,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',80,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(80,970,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',80,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',80,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="Nombre">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre_persona" name="nombre_persona"  value="<?php echo(mostrar_valor_campo('nombre_persona',80,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Correo electr&oacute;nico de contacto">E-MAIL*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="email" name="email"  value="<?php echo(mostrar_valor_campo('email',80,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Tel&eacute;fono fijo para establecer contacto">TEL&Eacute;FONO FIJO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="telefono" name="telefono"  value="<?php echo(mostrar_valor_campo('telefono',80,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Tel&eacute;fono celular">TEL&Eacute;FONO CELULAR</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="celular" name="celular"  value="<?php echo(mostrar_valor_campo('celular',80,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Mensaje de la solicitud">MENSAJE DE LA SOLICIUTUD*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="mensaje" id="mensaje" cols="53" rows="3" class="tiny_avanzado required"><?php echo(mostrar_valor_campo('mensaje',80,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="campo_descripcion" value="<?php echo('965,966'); ?>"><input type="hidden" name="formato" value="80"><tr><td colspan='2'><?php submit_formato(80,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>