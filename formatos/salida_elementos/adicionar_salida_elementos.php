<html><title>.:ADICIONAR SALIDA DE ELEMENTOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SALIDA DE ELEMENTOS</td></tr><input type="hidden" name="idft_salida_elementos" value="<?php echo(validar_valor_campo(3808)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3809)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(325,3810);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3811)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3812)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3803)); ?>"><tr>
                       <td class="encabezado" width="20%" title="Fecha de solicitud de la salida de elementos.">FECHA DE SOLICITUD*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_solicitud" id="fecha_solicitud" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha_solicitud","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="Nombre del solicitante del servicio">NOMBRE DE SOLICITANTE*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='2'  type="text" size="100" id="solicitante" name="solicitante"  value="<?php echo(validar_valor_campo(3806)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Describa brevemente la solicitud.">DESCRIPCI&Oacute;N DE LA SALIDA*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="descripcion_salida" id="descripcion_salida" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(3805)); ?></textarea></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="Seleccione la fecha de la solicitud.">FECHA DE SALIDA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='4'  type="text" readonly="true"  class="required dateISO"  name="fecha_salida" id="fecha_salida" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha_salida","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><input type="hidden" name="campo_descripcion" value="3804"><tr><td colspan='2'><?php submit_formato(325);?></td></tr></table></form></body></html>