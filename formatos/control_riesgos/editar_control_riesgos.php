<html><title>.:EDITAR 1. VALORACION CONTROLES RIESGOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../riesgos_proceso/../riesgos_proceso/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">1. VALORACION CONTROLES RIESGOS</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(394,4707,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CONSECUTIVO</td>
                     <?php consecutivo_funcion_control(394,4708,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA VALORACION*</td>
                     <?php fecha_bloqueada_valoracion(394,4709,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DEL CONTROL EXISTENTE*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="descripcion_control" id="descripcion_control" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('descripcion_control',394,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_tipo_control" >
                     <td class="encabezado" width="20%" title="">EL CONTROL AFECTA?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(394,4711,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="desplazamiento" value="<?php echo(mostrar_valor_campo('desplazamiento',394,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="" colspan="2"><center>HERRAMIENTAS PARA EJERCER EL CONTROL</center></td>
                    </tr><tr id="tr_herramienta_ejercer" >
                     <td class="encabezado" width="20%" title="">1. POSEE UNA HERRAMIENTA PARA EJERCER EL CONTROL?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(394,4716,$_REQUEST['iddoc']);?></td></tr><tr id="tr_procedimiento_herramienta" >
                     <td class="encabezado" width="20%" title="">2. EXISTEN MANUALES, INSTRUCTIVOS O PROCEDIMIENTOS PARA EL MANEJO DE LA HERRAMIENTA?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(394,4717,$_REQUEST['iddoc']);?></td></tr><tr id="tr_herramienta_efectiva" >
                     <td class="encabezado" width="20%" title="">3. EN EL TIEMPO QUE LLEVA LA HERRAMIENTA, HA DEMOSTRADO SER EFECTIVA?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(394,4718,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2"><center>SEGUIMIENTO AL CONTROL</center></td>
                    </tr><tr id="tr_responsables_ejecucion" >
                     <td class="encabezado" width="20%" title="">4. ESTAN DEFINIDOS LOS RESPONSABLES DE LA EJECUCI&Oacute;N DEL CONTROL Y DEL SEGUIMIENTO?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(394,4720,$_REQUEST['iddoc']);?></td></tr><tr id="tr_frecuencia_ejecucion" >
                     <td class="encabezado" width="20%" title="">5. LA FRECUENCIA DE LA EJECUCI&Oacute;N DEL CONTROL Y SEGUIMIENTO ES ADECUADO?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(394,4721,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="idft_control_riesgos" value="<?php echo(mostrar_valor_campo('idft_control_riesgos',394,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',394,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',394,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',394,$_REQUEST['iddoc'])); ?>"><?php validar_edicion_adicion_formatos_riesgo_aprobados(394,NULL,$_REQUEST['iddoc']);?><?php llenar_orientacion(394,NULL,$_REQUEST['iddoc']);?><?php validar_tipo_riesgo(394,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('4710'); ?>"><input type="hidden" name="formato" value="394"><tr><td colspan='2'><?php submit_formato(394,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>