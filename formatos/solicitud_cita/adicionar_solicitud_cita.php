<html><title>.:ADICIONAR 2. SOLICITUD DE CITA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">2. SOLICITUD DE CITA</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(291,3359);?></tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_clinica_ortodoncia"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_clinica_ortodoncia"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_clinica_ortodoncia);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3352)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE DEL PACIENTE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre_paciente" name="nombre_paciente"  value="<?php echo(validar_valor_campo(3353)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">MOTIVO DE CONSULTA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(291,3354,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion_cita" id="descripcion_cita" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(3355)); ?></textarea></td>
                    </tr><tr>
                    <td class="encabezado" width="20%" title="">FECHA Y HORA DE CITA*</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='3'  type="text" readonly="true" name="fecha_hora_cita"  class="required dateISO"  id="fecha_hora_cita" value="<?php echo(date("0000-00-00 00:00")); ?>"><?php selector_fecha("fecha_hora_cita","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td><input type="hidden" name="idft_solicitud_cita" value="<?php echo(validar_valor_campo(3357)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3358)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3360)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3361)); ?>"><?php cargar_nombre_paciente(291,NULL);?><input type="hidden" name="campo_descripcion" value="3353,3354"><tr><td colspan='2'><?php submit_formato(291);?></td></tr></table></form></body></html>