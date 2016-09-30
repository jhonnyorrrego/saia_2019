<html><title>.:EDITAR REPORTE DE AVANCE ACCIONES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">REPORTE DE AVANCE ACCIONES</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',391,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(391,4652,$_REQUEST['iddoc']);?></tr><input type="hidden" name="idft_seguimiento" value="<?php echo(mostrar_valor_campo('idft_seguimiento',391,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',391,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',391,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',391,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">PORCENTAJE*</td>
                     <?php listado_avance(391,4658,$_REQUEST['iddoc']);?></tr><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="Estado Actual del Proceso :
ELABORACION,REVISION,APROBACION,DISTRIBUCION,INACTIVO ">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(391,4659,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">LOGROS ALCANZADOS*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="logros_alcanzados" id="logros_alcanzados" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('logros_alcanzados',391,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones',391,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Adjuntar evidencia documental">ADJUNTAR EVIDENCIA DOCUMENTAL</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=391&idcampo=4662" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><input type="hidden" name="campo_descripcion" value="<?php echo('4658,4660'); ?>"><input type="hidden" name="formato" value="391"><tr><td colspan='2'><?php submit_formato(391,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>