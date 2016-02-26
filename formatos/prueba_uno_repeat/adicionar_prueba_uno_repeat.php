<html><title>.:ADICIONAR PRUEBA_UNO_REPEAT:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">PRUEBA_UNO_REPEAT</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4009)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">PRUEBA_UNO_REPEAT</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="campo_text" name="campo_text"  value="<?php echo(validar_valor_campo(4010)); ?>"></td>
                    </tr><input type="hidden" name="idft_prueba_uno_repeat" value="<?php echo(validar_valor_campo(4011)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4012)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(345,4013);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4014)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4015)); ?>"><tr><td colspan='2'><?php submit_formato(345);?></td></tr></table></form></body></html>