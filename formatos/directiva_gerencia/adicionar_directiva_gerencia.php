<html><title>.:ADICIONAR DIRECTIVA DE GERENCIA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../memo/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">DIRECTIVA DE GERENCIA</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(824)); ?>"><input type="hidden" name="idft_directiva_gerencia" value="<?php echo(validar_valor_campo(825)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(827)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(70,828);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(829)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(830)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_formato(70,832);?></tr><tr>
                     <td class="encabezado" width="20%" title="contenido de la directiva">CONTENIDO*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="contenido" id="contenido" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(826)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">INICIALES*</td>
                     <?php iniciales(70,831);?></tr><?php guardar_plantilla(70,NULL);?><input type="hidden" name="campo_descripcion" value="832"><tr><td colspan='2'><?php submit_formato(70);?></td></tr></table></form></body></html>