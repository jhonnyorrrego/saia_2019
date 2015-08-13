<html><title>.:ADICIONAR FORMATO DE CALIDAD DE AGUA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">FORMATO DE CALIDAD DE AGUA</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(895)); ?>"><input type="hidden" name="idft_calidad_agua" value="<?php echo(validar_valor_campo(904)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(905)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(75,906);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(907)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(908)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_formato(75,910);?></tr><input type="hidden" name="asunto" value="<?php echo(validar_valor_campo(923)); ?>"><tr>
                   <td class="encabezado" width="20%" title="">DESTINO*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="3000"  class="required"  name="destinos" id="destinos" value=""><?php componente_ejecutor("903",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="mes del informe">MES*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="mes" name="mes"  value="<?php echo(validar_valor_campo(897)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Indice de riesgo por calidad del agua">INDICE DE RIESGO POR CALIDAD DEL AGUA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='2'  type="text" size="100" id="irca" name="irca"  value="<?php echo(validar_valor_campo(896)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Nivel de riesgo">NIVEL DE RIESGO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="nivel_riesgo" name="nivel_riesgo"  value="<?php echo(validar_valor_campo(898)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="notificaci&oacute;n">NOTIFICACI&Oacute;N*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="3000"  class="required"   tabindex='4'  type="text" size="100" id="notificacion" name="notificacion"  value="<?php echo(validar_valor_campo(899)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Reclamos por Calidad de Agua">RECLAMOS POR CALIDAD DE AGUA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='5'  type="text" size="100" id="reclamos_total" name="reclamos_total"  value="<?php echo(validar_valor_campo(901)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Reclamos Procedentes por Calidad de Agua">RECLAMOS PROCEDENTES POR CALIDAD DE AGUA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='6'  type="text" size="100" id="reclamos_procedentes" name="reclamos_procedentes"  value="<?php echo(validar_valor_campo(900)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">PREPAR&OGRAVE;*</td>
                     <?php iniciales(75,909);?></tr><?php asignar_responsables(75,NULL);?><input type="hidden" name="campo_descripcion" value="897,898,923"><tr><td colspan='2'><?php submit_formato(75);?></td></tr></table></form></body></html>