<html><title>.:ADICIONAR ESQUEMA DE LA HOJA DE VID:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">ESQUEMA DE LA HOJA DE VID</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(225,2464);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2465)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2457)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(2459)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">PADRE DEL ESQUEMA ACTUAL</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(225,2460,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">CARACTER&Iacute;STICAS*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="caracteristicas" id="caracteristicas" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(2458)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBLIGATORIEDAD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(225,2461,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="idft_estructura_hoja_vida" value="<?php echo(validar_valor_campo(2462)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2463)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2466)); ?>"><tr><td colspan='2'><?php submit_formato(225);?></td></tr></table></form></body></html>