<html><title>.:ADICIONAR ORDEN DE TRABAJO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">ORDEN DE TRABAJO</td></tr><input type="hidden" name="firma_externa_cliente" value="<?php echo(validar_valor_campo(3009)); ?>"><input type="hidden" name="firma_externa_satisfaccion" value="<?php echo(validar_valor_campo(3010)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2984)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(262,2983);?></tr><tr>
                     <td class="encabezado" width="20%" title="">TIPO DE SERVICIO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(262,2988,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA ORDEN (F. OT)*</td>
                     <?php fecha_formato(262,2977);?></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE SOLICITUD (F. SOL)*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_solicitud_orden" id="fecha_solicitud_orden" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha_solicitud_orden","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                       <td class="encabezado" width="20%" title="">FECHA COMPROMISO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='2'  type="text" readonly="true"  class="required dateISO"  name="fecha_compromiso" id="fecha_compromiso" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha_compromiso","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">KILOMETROS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='3'  type="text" size="100" id="kilometros_vehiculo" name="kilometros_vehiculo"  value="<?php echo(validar_valor_campo(2995)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">PRIORIDAD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(262,2979,$_REQUEST['iddoc']);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">SOLICITANTE*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="nombre_solicitante" id="nombre_solicitante" value=""><?php componente_ejecutor("2980",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">ASEGURADOR*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="nombre_asegurador" name="nombre_asegurador"  value="<?php echo(validar_valor_campo(2986)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">SERVICIO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='5'  type="text" size="100" id="campo_servicio" name="campo_servicio"  value="<?php echo(validar_valor_campo(2996)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CTTO NUMERO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='6'  type="text" size="100" id="ctto_numero" name="ctto_numero"  value="<?php echo(validar_valor_campo(2997)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">MOTIVO DEL SERVICIO*</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="motivo_servicio" id="motivo_servicio" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(2987)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">LLAMADAS REQUERIDAS</td>
                     <td class="celda_transparente"><textarea  tabindex='8'  name="llamadas_requeridas" id="llamadas_requeridas" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(2990)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">RECIBO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='9'  type="text" size="100" id="funcionario_recibo" name="funcionario_recibo"  value="<?php echo(validar_valor_campo(3008)); ?>"></td>
                    </tr><input type="hidden" name="idft_orden_trabajo_vehiculo" value="<?php echo(validar_valor_campo(2981)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2982)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2985)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_confir_negoci_vehiculo"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_confir_negoci_vehiculo"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_confir_negoci_vehiculo);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2976)); ?>"><?php separar_miles_kilometros(262,NULL);?><?php cargar_funcionario_recibo(262,NULL);?><input type="hidden" name="campo_descripcion" value="2977"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(262);?></td></tr></table></form></body></html>