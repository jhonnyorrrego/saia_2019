<html><title>.:EDITAR 3. MONITOREO Y REVISION:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">3. MONITOREO Y REVISION</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',435,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="" colspan="2" id="ayuda">El monitoreo a los mapas de riesgos est&aacute; a cargo de los Responsables y Lideres  de los procesos, su prop&oacute;sito es asegurar que las acciones se est&aacute;n llevando a cabo y evaluar la eficacia y eficiencia en su implementaci&oacute;n, adelantando para ello revisiones (cuatrimestrales: Abril 30; Agosto 31 y Diciembre 31) para evidenciar todas aquellas situaciones o factores que pueden estar influyendo en la aplicaci&oacute;n de las acciones preventivas. <b>(Pol&iacute;tica de Operaci&oacute;n Administraci&oacute;n del Riesgo)</b></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(435,5421,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_bloqueada_monitoreo(435,5422,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">RIESGO NRO*</td>
                     <?php obtener_numero_riesgo(435,5423,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE DEL RIESGO*</td>
                     <?php obtener_nombre_riesgo(435,5424,$_REQUEST['iddoc']);?></tr><tr id="tr_cambio_identificacion" >
                     <td class="encabezado" width="20%" title="">SE REALIZARON CAMBIOS EN LA IDENTIFICACION DEL RIESGO?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(435,5425,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCION DE LOS CAMBIOS</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="descripcion_cambio" id="descripcion_cambio" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('descripcion_cambio',435,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_cambios_analisis" >
                     <td class="encabezado" width="20%" title="">SE REALIZARON CAMBIOS EN EL AN&Aacute;LISIS DEL RIESGO?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(435,5427,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DE LOS CAMBIOS</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion_analisis" id="descripcion_analisis" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('descripcion_analisis',435,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">SE EVALUARON LOS CONTROLES EXISTENTES?*</td>
                     <?php obtener_controles_existentes_riesgo(435,5429,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">RESULTADOS DE LA EVALUACI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="resultado_evaluacion" id="resultado_evaluacion" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('resultado_evaluacion',435,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">SE CUMPLIERON LAS ACCIONES PROPUESTAS?*</td>
                     <?php obtener_acciones_propuestas_riesgo(435,5431,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">LOGROS ALCANZADOS Y/O OBSERVACIONES*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="logros_alcanzados" id="logros_alcanzados" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('logros_alcanzados',435,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_controles_nuevos" >
                     <td class="encabezado" width="20%" title="">SE IMPLEMENTARON NUEVOS CONTROLES?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(435,5433,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DEL NUEVO(S) CONTROL(ES)*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="descripcion_ncontrol" id="descripcion_ncontrol" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('descripcion_ncontrol',435,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ADJUNTAR EVIDENCIA(S) DOCUMENTAL</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=435&idcampo=5435" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES GENERALES</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="observaciones_generales" id="observaciones_generales" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones_generales',435,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="idft_monitoreo_revision" value="<?php echo(mostrar_valor_campo('idft_monitoreo_revision',435,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',435,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',435,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',435,$_REQUEST['iddoc'])); ?>"><?php validar_tipo_seleccion_monitoreo(435,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('5422'); ?>"><input type="hidden" name="formato" value="435"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(435,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>