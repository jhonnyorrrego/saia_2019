<html><title>.:EDITAR EMPRESAS INVITADAS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><input type="hidden" name="idft_empresas" value="<?php echo(mostrar_valor_campo('idft_empresas',85,$_REQUEST['iddoc'])); ?>"><tr>
                   <td class="encabezado" width="20%" title="">EMPRESA Y/O PROVEEDOR*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="empresa" id="empresa" value="<?php echo(mostrar_valor_campo('empresa',85,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("1048",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">ENTREGA COTIZACI&Oacute;N*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(85,1049,$_REQUEST['iddoc']);?></td></tr><?php cargar_empresa(85,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('1049'); ?>"><input type="hidden" name="formato" value="85"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="empresas"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(85,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>