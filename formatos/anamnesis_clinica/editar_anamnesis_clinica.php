<html><title>.:EDITAR 1. ANAMNESIS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">1. ANAMNESIS</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(285,3286,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',285,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">MOTIVO DE CONSULTA*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="motivo_consulta" id="motivo_consulta" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('motivo_consulta',285,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ENFERMEDAD ACTUAL*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="enfermedad_actual" id="enfermedad_actual" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('enfermedad_actual',285,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ANTECEDENTES M&Eacute;DICOS*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="antecedentes_medicos" id="antecedentes_medicos" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('antecedentes_medicos',285,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ANTECEDENTES FAMILIARES*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="antecedentes_familiares_a" id="antecedentes_familiares_a" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('antecedentes_familiares_a',285,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="idft_anamnesis_clinica" value="<?php echo(mostrar_valor_campo('idft_anamnesis_clinica',285,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',285,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',285,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('3280'); ?>"><input type="hidden" name="formato" value="285"><tr><td colspan='2'><?php submit_formato(285,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>