<html><title>.:ADICIONAR 1. ANAMNESIS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">1. ANAMNESIS</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(285,3286);?></tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_clinica_ortodoncia"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_clinica_ortodoncia"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_clinica_ortodoncia);} ?><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3287)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3278)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">MOTIVO DE CONSULTA*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="motivo_consulta" id="motivo_consulta" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(3280)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ENFERMEDAD ACTUAL*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="enfermedad_actual" id="enfermedad_actual" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(3340)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ANTECEDENTES M&Eacute;DICOS*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="antecedentes_medicos" id="antecedentes_medicos" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(3341)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ANTECEDENTES FAMILIARES*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="antecedentes_familiares_a" id="antecedentes_familiares_a" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(3342)); ?></textarea></td>
                    </tr><input type="hidden" name="idft_anamnesis_clinica" value="<?php echo(validar_valor_campo(3284)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3285)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3288)); ?>"><input type="hidden" name="campo_descripcion" value="3280"><tr><td colspan='2'><?php submit_formato(285);?></td></tr></table></form></body></html>