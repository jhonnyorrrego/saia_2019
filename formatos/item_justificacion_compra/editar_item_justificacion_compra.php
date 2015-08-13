<html><title>.:EDITAR ITEM JUSTIFICACI&Oacute;N DE COMPRA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.spin.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr>
                     <td class="encabezado" width="20%" title="">CANTIDAD*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required" min="0" max="100"  tabindex='1'  type="input" id="cantidad" name="cantidad"  value="<?php echo(mostrar_valor_campo('cantidad',297,$_REQUEST['iddoc'])); ?>"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#cantidad").spin({imageBasePath:'../../images/',min:0,max:100,interval:1});
              });
              </script><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion_item" id="descripcion_item" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('descripcion_item',297,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="valor" value="<?php echo(mostrar_valor_campo('valor',297,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_item_justificacion_compra" value="<?php echo(mostrar_valor_campo('idft_item_justificacion_compra',297,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('3468'); ?>"><input type="hidden" name="formato" value="297"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="item_justificacion_compra"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(297,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>