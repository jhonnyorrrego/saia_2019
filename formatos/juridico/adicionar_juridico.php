<html><title>.:ADICIONAR JUR&Iacute;DICO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">JUR&Iacute;DICO</td></tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_acta_evaluacion"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_acta_evaluacion"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_acta_evaluacion);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(1035)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ASPECTOS JUR&Iacute;DICOS*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="aspectos_juridicos" id="aspectos_juridicos" cols="53" rows="3" class="tiny_avanzado required"><?php echo(validar_valor_campo(1036)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CONCLUSI&Oacute;N JUR&Iacute;DICA*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="conclusion_juridica" id="conclusion_juridica" cols="53" rows="3" class="tiny_avanzado required"><?php echo(validar_valor_campo(1037)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">RECOMENDACI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="recomendacion" id="recomendacion" cols="53" rows="3" class="tiny_avanzado required"><?php echo(validar_valor_campo(1038)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">FORMA DE PAGO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="forma_pago" name="forma_pago"  value="<?php echo(validar_valor_campo(1039)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">PLAZO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='5'  type="text" size="100" id="plazo" name="plazo"  value="<?php echo(validar_valor_campo(1040)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">VALOR*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='6'  type="text" size="100" id="valor" name="valor"  value="<?php echo(validar_valor_campo(1041)); ?>"></td>
                    </tr><input type="hidden" name="idft_juridico" value="<?php echo(validar_valor_campo(1042)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(1043)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(87,1044);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(1045)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(1046)); ?>"><input type="hidden" name="campo_descripcion" value="1039"><tr><td colspan='2'><?php submit_formato(87);?></td></tr></table></form></body></html>