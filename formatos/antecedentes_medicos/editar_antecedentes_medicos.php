<html><title>.:EDITAR ANTECEDENTES M&Eacute;DICOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">ANTECEDENTES M&Eacute;DICOS</td></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',281,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(281,3213,$_REQUEST['iddoc']);?></tr><tr id="tr_padece_enfermedad" >
                     <td class="encabezado" width="20%" title="">PADECE DE ALGUNA ENFERMEDAD ACTUALMENTE*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3158,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">&iquest;CU&Aacute;L ENFERMEDAD?</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="cual_enfermedad" name="cual_enfermedad"  value="<?php echo(mostrar_valor_campo('cual_enfermedad',281,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_recibe_medicamento" >
                     <td class="encabezado" width="20%" title="">RECIBE ALG&Uacute;N MEDICAMENTO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3160,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">&iquest;CU&Aacute;L MEDICAMENTO?</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="cual_medicamento" name="cual_medicamento"  value="<?php echo(mostrar_valor_campo('cual_medicamento',281,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_enfermedades_cardiacas" >
                     <td class="encabezado" width="20%" title="">ENFERMEDADES CARD&Iacute;ACAS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3163,$_REQUEST['iddoc']);?></td></tr><tr id="tr_hipertension_arterial" >
                     <td class="encabezado" width="20%" title="">HIPERTENSI&Oacute;N ARTERIAL</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3164,$_REQUEST['iddoc']);?></td></tr><tr id="tr_enfer_respiratoria" >
                     <td class="encabezado" width="20%" title="">ENFERMEDAD RESPIRATORIA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3195,$_REQUEST['iddoc']);?></td></tr><tr id="tr_enfermedad_renal" >
                     <td class="encabezado" width="20%" title="">ENFERMEDAD RENAL</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3167,$_REQUEST['iddoc']);?></td></tr><tr id="tr_hepatitis" >
                     <td class="encabezado" width="20%" title="">HEPATITIS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3170,$_REQUEST['iddoc']);?></td></tr><tr id="tr_diabetes" >
                     <td class="encabezado" width="20%" title="">DIABETES</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3168,$_REQUEST['iddoc']);?></td></tr><tr id="tr_trastorno_sanguineo" >
                     <td class="encabezado" width="20%" title="">TRASTORNOS SANGU&Iacute;NEOS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3173,$_REQUEST['iddoc']);?></td></tr><tr id="tr_fiebre_reumatica" >
                     <td class="encabezado" width="20%" title="">FIEBRE REUMATICA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3279,$_REQUEST['iddoc']);?></td></tr><tr id="tr_alergias" >
                     <td class="encabezado" width="20%" title="">ALERGIAS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3177,$_REQUEST['iddoc']);?></td></tr><tr id="tr_obstruccion_nasal" >
                     <td class="encabezado" width="20%" title="">OBSTRUCCI&Oacute;N_NASAL</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3179,$_REQUEST['iddoc']);?></td></tr><tr id="tr_cirujias" >
                     <td class="encabezado" width="20%" title="">CIRUJ&Iacute;AS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3181,$_REQUEST['iddoc']);?></td></tr><tr id="tr_adenoides" >
                     <td class="encabezado" width="20%" title="">ADENOIDES</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3198,$_REQUEST['iddoc']);?></td></tr><tr id="tr_amigdalas" >
                     <td class="encabezado" width="20%" title="">AMIGDALAS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3199,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OTRO &iquest;CU&Aacute;L?</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="otro_antecedente" name="otro_antecedente"  value="<?php echo(mostrar_valor_campo('otro_antecedente',281,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">EDAD DE LA PRIMERA MENSTRUACI&Oacute;N</td>
                     <td bgcolor="#F5F5F5"><input    tabindex='4'  type="text" size="100" id="edad_menstruacion" name="edad_menstruacion"  value="<?php echo(mostrar_valor_campo('edad_menstruacion',281,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="observacion_ante" id="observacion_ante" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observacion_ante',281,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="idft_antecedentes_medicos" value="<?php echo(mostrar_valor_campo('idft_antecedentes_medicos',281,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',281,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',281,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('3161'); ?>"><input type="hidden" name="formato" value="281"><tr><td colspan='2'><?php submit_formato(281,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>