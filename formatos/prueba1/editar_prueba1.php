<html><title>.:EDITAR PRUEBA 1:.</title><head><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">PRUEBA 1</td></tr><input type="hidden" name="idft_prueba1" value="<?php echo(mostrar_valor_campo('idft_prueba1',273,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',273,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(273,3799,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',273,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',273,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">CAMPO1*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="campo" name="campo"  value="<?php echo(mostrar_valor_campo('campo',273,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><input type="hidden" name="campo_descripcion" value="<?php echo('3802'); ?>"><input type="hidden" name="formato" value="273"><tr><td colspan='2'><?php submit_formato(273,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>