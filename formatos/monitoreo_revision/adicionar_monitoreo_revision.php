<html><title>.:ADICIONAR 3. MONITOREO Y REVISION:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">3. MONITOREO Y REVISION</td></tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2">El monitoreo a los mapas de riesgos est&aacute; a cargo de los Responsables y Lideres  de los procesos, su prop&oacute;sito es asegurar que las acciones se est&aacute;n llevando a cabo y evaluar la eficacia y eficiencia en su implementaci&oacute;n, adelantando para ello revisiones (cuatrimestrales: Abril 30; Agosto 31 y Diciembre 31) para evidenciar todas aquellas situaciones o factores que pueden estar influyendo en la aplicaci&oacute;n de las acciones preventivas. <b>(Pol&iacute;tica de Operaci&oacute;n Administraci&oacute;n del Riesgo)</b></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(396,4741);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_bloqueada_monitoreo(396,4742);?></tr><tr>
                     <td class="encabezado" width="20%" title="">RIESGO NRO*</td>
                     <?php obtener_numero_riesgo(396,4743);?></tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE DEL RIESGO*</td>
                     <?php obtener_nombre_riesgo(396,4744);?></tr><tr id="tr_cambio_identificacion" >
                     <td class="encabezado" width="20%" title="">SE REALIZARON CAMBIOS EN LA IDENTIFICACION DEL RIESGO?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(396,4745,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCION DE LOS CAMBIOS</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="descripcion_cambio" id="descripcion_cambio" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(4746)); ?></textarea></td>
                    </tr><tr id="tr_cambios_analisis" >
                     <td class="encabezado" width="20%" title="">SE REALIZARON CAMBIOS EN EL AN&Aacute;LISIS DEL RIESGO?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(396,4747,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DE LOS CAMBIOS</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion_analisis" id="descripcion_analisis" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(4748)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">SE EVALUARON LOS CONTROLES EXISTENTES?*</td>
                     <?php obtener_controles_existentes_riesgo(396,4749);?></tr><tr>
                     <td class="encabezado" width="20%" title="">RESULTADOS DE LA EVALUACI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="resultado_evaluacion" id="resultado_evaluacion" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4750)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">SE CUMPLIERON LAS ACCIONES PROPUESTAS?*</td>
                     <?php obtener_acciones_propuestas_riesgo(396,4751);?></tr><tr>
                     <td class="encabezado" width="20%" title="">LOGROS ALCANZADOS Y/O OBSERVACIONES*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="logros_alcanzados" id="logros_alcanzados" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4752)); ?></textarea></td>
                    </tr><tr id="tr_controles_nuevos" >
                     <td class="encabezado" width="20%" title="">SE IMPLEMENTARON NUEVOS CONTROLES?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(396,4753,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DEL NUEVO(S) CONTROL(ES)*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="descripcion_ncontrol" id="descripcion_ncontrol" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4754)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ADJUNTAR EVIDENCIA(S) DOCUMENTAL</td>
                     <td class="celda_transparente"><input  tabindex='6'  type="file"  class='multi'  name="evidencias_adjuntas[]" accept="<?php echo $extensiones;?>"><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES GENERALES</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="observaciones_generales" id="observaciones_generales" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(4756)); ?></textarea></td>
                    </tr><input type="hidden" name="idft_monitoreo_revision" value="<?php echo(validar_valor_campo(4758)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4759)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4760)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4761)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4762)); ?>"><?php validar_tipo_seleccion_monitoreo(396,NULL);?><input type="hidden" name="campo_descripcion" value="4742"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(396);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>