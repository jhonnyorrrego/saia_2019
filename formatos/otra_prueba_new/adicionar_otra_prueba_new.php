<html><title>.:ADICIONAR OTRA_PRUEBA_NEW:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">OTRA_PRUEBA_NEW</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3922)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">PRUEBA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="prueba" name="prueba"  value="<?php echo(validar_valor_campo(3923)); ?>"></td>
                    </tr><input type="hidden" name="idft_otra_prueba_new" value="<?php echo(validar_valor_campo(3924)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3925)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(336,3926);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3927)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3928)); ?>"><input type="hidden" name="campo_descripcion" value="3923"><tr><td colspan='2'><?php submit_formato(336);?></td></tr></table></form></body></html>