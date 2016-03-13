<html><title>.:ADICIONAR CORREO SAIA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">CORREO SAIA</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(348,4038);?></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4030)); ?>"><tr>
                     <td class="encabezado" width="20%" title="Asunto del correo">ASUNTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="asunto" name="asunto"  value="<?php echo(validar_valor_campo(4031)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Fecha de entrada del oficio">FECHA OFICIO ENTRADA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='2'  type="text" size="100" id="fecha_oficio_entrada" name="fecha_oficio_entrada"  value="<?php echo(validar_valor_campo(4041)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Remitente del correo">DE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="de" name="de"  value="<?php echo(validar_valor_campo(4033)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">PARA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='4'  type="text" size="100" id="para" name="para"  value="<?php echo(validar_valor_campo(4034)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Comentario del correo">COMENTARIO</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="comentario" id="comentario" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(4042)); ?></textarea></td>
                    </tr><input type="hidden" name="anexos" value="<?php echo(validar_valor_campo(4035)); ?>"><input type="hidden" name="idft_correo_saia" value="<?php echo(validar_valor_campo(4036)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4037)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4039)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4040)); ?>"><?php recibir_datos(348,NULL);?><input type="hidden" name="campo_descripcion" value="4031"><tr><td colspan='2'><?php submit_formato(348);?></td></tr></table></form></body></html>