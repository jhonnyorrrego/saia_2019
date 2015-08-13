<html><title>.:ADICIONAR SOLICITUD WEB:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLICITUD WEB</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(940)); ?>"><input type="hidden" name="idft_solicitud_web" value="<?php echo(validar_valor_campo(949)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(950)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(78,951);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(952)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(953)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">TIPO DE SOLICITUD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(78,954,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="Por Favor Ingrese su nombre completo">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre_persona" name="nombre_persona"  value="<?php echo(validar_valor_campo(946)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Ingrese su n&uacute;mero de identificaci&oacute;n">NO DE C&Eacute;DULA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="identificacion" name="identificacion"  value="<?php echo(validar_valor_campo(943)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Por favorr Ingrese el n&uacute;mero de su matricula de servicios p&uacute;blicos solo en caso de ser necesario , esto facilitara su atenci&oacute;n">N&Uacute;MERO DE MATR&Iacute;CULA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="no_matricula" name="no_matricula"  value="<?php echo(validar_valor_campo(945)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Por favor Ingrese a que corresponde su solicitud, Acueducto, alcantarillado, Medidores">TIPO DE REPORTE*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(78,948,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="Especifique el correo electr&oacute;nico para dar respuesta a su solicitud">CORREO ELECTR&Oacute;NICO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="email" name="email"  value="<?php echo(validar_valor_campo(942)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Ingrese la Direcci&oacute;n donde se debe enviar la notificaci&oacute;n fisica en caso de ser necesario">DIRECCI&Oacute;N DE RESIDENCIA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='5'  type="text" size="100" id="direccion_residencia" name="direccion_residencia"  value="<?php echo(validar_valor_campo(941)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Por favor Ingrese un n&uacute;mero telef&oacute;nico donde podamos contactarlo">TEL&Eacute;FONO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='6'  type="text" size="100" id="telefono" name="telefono"  value="<?php echo(validar_valor_campo(947)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Ingrese el mensaje ">MENSAJE*</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="mensaje" id="mensaje" cols="53" rows="3" class="tiny_avanzado required"><?php echo(validar_valor_campo(944)); ?></textarea></td>
                    </tr><input type="hidden" name="campo_descripcion" value="943,946,954"><tr><td colspan='2'><?php submit_formato(78);?></td></tr></table></form></body></html>