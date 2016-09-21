<html><title>.:EDITAR DATOS DEL CLIENTE:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">DATOS DEL CLIENTE</td></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',257,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(257,2927,$_REQUEST['iddoc']);?></tr><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',257,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">FECHA INGRESO CLIENTE*</td>
                     <?php fecha_formato(257,2923,$_REQUEST['iddoc']);?></tr><tr>
                   <td class="encabezado" width="20%" title="">DATOS DEL CLIENTE*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="datos_cliente" id="datos_cliente" value="<?php echo(mostrar_valor_campo('datos_cliente',257,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("2922",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="observaciones_cliente" id="observaciones_cliente" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones_cliente',257,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',257,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_datos_cliente" value="<?php echo(mostrar_valor_campo('idft_datos_cliente',257,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('2923'); ?>"><input type="hidden" name="formato" value="257"><tr><td colspan='2'><?php submit_formato(257,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>