<html><title>.:ADICIONAR FORMATO_P:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">FORMATO_P</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2204)); ?>"><input type="hidden" name="idft_formato_p" value="<?php echo(validar_valor_campo(2206)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2207)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(208,2208);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2209)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2210)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(2214)); ?>"></td>
                    </tr><input type="hidden" name="campo_descripcion" value="2214"><tr><td colspan='2'><?php submit_formato(208);?></td></tr></table></form></body>
              <script type="text/javascript">
              $("#formulario_formatos").validate({
              	submitHandler: function(form){
              		$("#continuar").attr("value","Enviando...");
              		$("#continuar").attr("disabled","true");
              		form.submit();
              	}
              });
              </script></html>