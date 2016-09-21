<html><title>.:ADICIONAR ANTECEDENTES FAMILIARES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">ANTECEDENTES FAMILIARES</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3250)); ?>"><input type="hidden" name="idft_antecedentes_familiares" value="<?php echo(validar_valor_campo(3247)); ?>"><tr id="tr_cardiaca_familia" >
                     <td class="encabezado" width="20%" title="">ENFERMEDAD CARD&Iacute;ACA EN LA FAMILIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(283,3281,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ENFERMEDAD CARDIACA &iquest;QUI&Eacute;N?</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="cardiaca_quien" name="cardiaca_quien"  value="<?php echo(validar_valor_campo(3292)); ?>"></td>
                    </tr><tr id="tr_hipertension_familia" >
                     <td class="encabezado" width="20%" title="">HIPERTENSION EN LA FAMILIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(283,3283,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">HIPERTENSION &iquest;QUI&Eacute;N?</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="hipertension_quien" name="hipertension_quien"  value="<?php echo(validar_valor_campo(3293)); ?>"></td>
                    </tr><tr id="tr_cancer_familia" >
                     <td class="encabezado" width="20%" title="">CANCER EN LA FAMILIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(283,3222,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">CANCER &iquest;QUI&Eacute;N?</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="cancer_quien" name="cancer_quien"  value="<?php echo(validar_valor_campo(3223)); ?>"></td>
                    </tr><tr id="tr_respiratoria_familia" >
                     <td class="encabezado" width="20%" title="">ENFERMEDAD RESPIRATORIA EN LA FAMILIA *</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(283,3282,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ENFERMEDAD RESPIRATORIA &iquest;QUI&Eacute;N?</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="respiratorio_quien" name="respiratorio_quien"  value="<?php echo(validar_valor_campo(3246)); ?>"></td>
                    </tr><tr id="tr_diabetes_mellitus" >
                     <td class="encabezado" width="20%" title="">DIABETES_MELLITUS EN LA FAMILIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(283,3228,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DIABETES &iquest;QUI&Eacute;N?</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='5'  type="text" size="100" id="diabetes_quien" name="diabetes_quien"  value="<?php echo(validar_valor_campo(3231)); ?>"></td>
                    </tr><tr id="tr_asma_familia" >
                     <td class="encabezado" width="20%" title="">ASMA EN LA FAMILIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(283,3232,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ASMA &iquest;QUI&Eacute;N?</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='6'  type="text" size="100" id="asma_quien" name="asma_quien"  value="<?php echo(validar_valor_campo(3233)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACION FAMILIA</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="observacion_familia" id="observacion_familia" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(3235)); ?></textarea></td>
                    </tr><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3248)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(283,3249);?></tr><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3251)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3216)); ?>"><input type="hidden" name="campo_descripcion" value="3228"><tr><td colspan='2'><?php submit_formato(283);?></td></tr></table></form></body></html>