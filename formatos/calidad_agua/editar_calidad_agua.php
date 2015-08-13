<html><title>.:EDITAR FORMATO DE CALIDAD DE AGUA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">FORMATO DE CALIDAD DE AGUA</td></tr><input type="hidden" name="idft_calidad_agua" value="<?php echo(mostrar_valor_campo('idft_calidad_agua',75,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',75,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(75,906,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',75,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',75,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_formato(75,910,$_REQUEST['iddoc']);?></tr><input type="hidden" name="asunto" value="<?php echo(mostrar_valor_campo('asunto',75,$_REQUEST['iddoc'])); ?>"><tr>
                   <td class="encabezado" width="20%" title="">DESTINO*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="3000"  class="required"  name="destinos" id="destinos" value="<?php echo(mostrar_valor_campo('destinos',75,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("903",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="mes del informe">MES*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="mes" name="mes"  value="<?php echo(mostrar_valor_campo('mes',75,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Indice de riesgo por calidad del agua">INDICE DE RIESGO POR CALIDAD DEL AGUA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='2'  type="text" size="100" id="irca" name="irca"  value="<?php echo(mostrar_valor_campo('irca',75,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Nivel de riesgo">NIVEL DE RIESGO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="nivel_riesgo" name="nivel_riesgo"  value="<?php echo(mostrar_valor_campo('nivel_riesgo',75,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="notificaci&oacute;n">NOTIFICACI&Oacute;N*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="3000"  class="required"   tabindex='4'  type="text" size="100" id="notificacion" name="notificacion"  value="<?php echo(mostrar_valor_campo('notificacion',75,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Reclamos por Calidad de Agua">RECLAMOS POR CALIDAD DE AGUA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='5'  type="text" size="100" id="reclamos_total" name="reclamos_total"  value="<?php echo(mostrar_valor_campo('reclamos_total',75,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Reclamos Procedentes por Calidad de Agua">RECLAMOS PROCEDENTES POR CALIDAD DE AGUA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='6'  type="text" size="100" id="reclamos_procedentes" name="reclamos_procedentes"  value="<?php echo(mostrar_valor_campo('reclamos_procedentes',75,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">PREPAR&OGRAVE;*</td>
                     <?php iniciales(75,909,$_REQUEST['iddoc']);?></tr><input type="hidden" name="campo_descripcion" value="<?php echo('897,898,923'); ?>"><input type="hidden" name="formato" value="75"><tr><td colspan='2'><?php submit_formato(75,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>