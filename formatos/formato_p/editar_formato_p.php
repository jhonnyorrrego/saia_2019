<html><title>.:EDITAR FORMATO_P:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">FORMATO_P</td></tr><input type="hidden" name="idft_formato_p" value="<?php echo(mostrar_valor_campo('idft_formato_p',208,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',208,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(208,2208,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',208,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',208,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(mostrar_valor_campo('nombre',208,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><input type="hidden" name="campo_descripcion" value="<?php echo('2214'); ?>"><input type="hidden" name="formato" value="208"><tr><td colspan='2'><?php submit_formato(208,$_REQUEST['iddoc']);?></td></tr></table></form></body>
              <script type="text/javascript">
              $("#formulario_formatos").validate({
              	submitHandler: function(form){
              		$("#continuar").attr("value","Enviando...");
              		$("#continuar").attr("disabled","true");
              		form.submit();
              	}
              });
              </script></html><?php include_once("../librerias/footer_plantilla.php");?>