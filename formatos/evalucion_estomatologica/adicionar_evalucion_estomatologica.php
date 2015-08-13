<html><title>.:ADICIONAR EVALUACION ESTOMATOLOGICA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">EVALUACION ESTOMATOLOGICA</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3276)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(284,3275);?></tr><input type="hidden" name="idft_evalucion_estomatologica" value="<?php echo(validar_valor_campo(3273)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">&iquest;LE HAN REALIZADO ALG&Uacute;N PROCEDIMIENTO ODONTOL&Oacute;GICO ANTERIORMENTE?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3254,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">&iquest;CU&Aacute;L PROCEDIMIENTO?</td>
                     <td bgcolor="#F5F5F5"><input    tabindex='1'  type="text" size="100" id="cual_procedimiento" name="cual_procedimiento"  value="<?php echo(validar_valor_campo(3255)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ULTIMA VISITA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='2'  type="text" size="100" id="ultima_visita" name="ultima_visita"  value="<?php echo(validar_valor_campo(3257)); ?>"></td>
                    </tr><tr>
                  <td class="encabezado" width="20%" title="">TIPOS DE LIMPIEZA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3261,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">LABIOS*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3262,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">LENGUA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3263,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">PALADAR*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3264,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">CARRILLOS*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3265,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">PISO DE BOCA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3266,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">FRENILLOS*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3267,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">MAXILARES*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3268,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">FUNCION OCLUSION*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3269,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ATM*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3270,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">APERTURA MAXIMA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='3'  type="text" size="100" id="apertura_maxima" name="apertura_maxima"  value="<?php echo(validar_valor_campo(3271)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES TEJIDO BLANDO*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="observaciones_tejidob" id="observaciones_tejidob" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(3272)); ?></textarea></td>
                    </tr><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3274)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3277)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3252)); ?>"><input type="hidden" name="campo_descripcion" value="3257"><tr><td colspan='2'><?php submit_formato(284);?></td></tr></table></form></body></html>