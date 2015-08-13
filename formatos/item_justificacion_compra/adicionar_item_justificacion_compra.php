<html><title>.:ADICIONAR ITEM JUSTIFICACI&Oacute;N DE COMPRA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.spin.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr>
                     <td class="encabezado" width="20%" title="">CANTIDAD*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required" min="0" max="100"  tabindex='1'  type="input" id="cantidad" name="cantidad"  value="<?php echo(validar_valor_campo(3467)); ?>"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#cantidad").spin({imageBasePath:'../../images/',min:0,max:100,interval:1});
              });
              </script><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion_item" id="descripcion_item" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(3468)); ?></textarea></td>
                    </tr><input type="hidden" name="valor" value="<?php echo(validar_valor_campo(3469)); ?>"><input type="hidden" name="idft_item_justificacion_compra" value="<?php echo(validar_valor_campo(3470)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3471)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_justificacion_compra"  value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden"  name="idpadre"  value="<?php echo $_REQUEST["idpadre"]; ?>"><?php } ?><tr><td class="encabezado">ACCION A SEGUIR LUEGO DE GUARDAR</td><td ><input type="radio" name="opcion_item" value="adicionar">Adicionar otro&nbsp;&nbsp;<input type="radio" name="opcion_item" value="terminar">Terminar</td></tr><input type="hidden" name="campo_descripcion" value="3468"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="item_justificacion_compra"><input type="hidden" name="accion" value="guardar_item" ><tr><td colspan='2'><?php submit_formato(297);?></td></tr></table></form></body></html>