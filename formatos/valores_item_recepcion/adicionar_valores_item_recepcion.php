<html><title>.:ADICIONAR VALORES ITEM RECEPCION:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_recepcion_cotizacion"  value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden"  name="idpadre"  value="<?php echo $_REQUEST["idpadre"]; ?>"><?php } ?><input type="hidden" name="estado" value="<?php echo(validar_valor_campo(3501)); ?>"><input type="hidden" name="fk_idft_item" value="<?php echo(validar_valor_campo(3502)); ?>"><input type="hidden" name="valor" value="<?php echo(validar_valor_campo(3503)); ?>"><input type="hidden" name="idft_valores_item_recepcion" value="<?php echo(validar_valor_campo(3504)); ?>"><tr><td class="encabezado">ACCION A SEGUIR LUEGO DE GUARDAR</td><td ><input type="radio" name="opcion_item" value="adicionar">Adicionar otro&nbsp;&nbsp;<input type="radio" name="opcion_item" value="terminar">Terminar</td></tr><input type="hidden" name="campo_descripcion" value="3503"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="valores_item_recepcion"><input type="hidden" name="accion" value="guardar_item" ><tr><td colspan='2'><?php submit_formato(300);?></td></tr></table></form></body></html>