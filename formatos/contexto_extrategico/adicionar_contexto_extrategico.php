<html><title>.:ADICIONAR CONTEXTO ESTRATEGICO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">CONTEXTO ESTRATEGICO</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(375,4383);?></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4385)); ?>"><input type="hidden" name="idft_contexto_extrategico" value="<?php echo(validar_valor_campo(4386)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4387)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4388)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">PROCESO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="proceso" name="proceso"  value="<?php echo(validar_valor_campo(4389)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBJETIVO*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="objetivo" id="objetivo" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4390)); ?></textarea></td>
                    </tr><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4391)); ?>"><?php obtener_valor_campos(375,NULL);?><input type="hidden" name="campo_descripcion" value="4389"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(375);?></td></tr></table></form></body></html>