<html><title>.:EDITAR SOLICITUD DE AFILIACI&Oacute;N:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLICITUD DE AFILIACI&Oacute;N</td></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',271,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(271,3113,$_REQUEST['iddoc']);?></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE SOLICITUD*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_solicitud" id="fecha_solicitud" tipo="fecha" value="<?php mostrar_valor_campo('fecha_solicitud',271,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_solicitud","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                   <td class="encabezado" width="20%" title="">DATOS DEL SOLICITANTE DE AFILIACI&Oacute;N*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="datos_solicitante" id="datos_solicitante" value="<?php echo(mostrar_valor_campo('datos_solicitante',271,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("3108",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FOLIOS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required digits"   tabindex='2'  type="text" size="100" id="numero_folios_afilia" name="numero_folios_afilia"  value="<?php echo(mostrar_valor_campo('numero_folios_afilia',271,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ADJUNTAR</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=271&idcampo=3110" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><input type="hidden" name="idft_solicitud_afiliacion" value="<?php echo(mostrar_valor_campo('idft_solicitud_afiliacion',271,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',271,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',271,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('3107'); ?>"><input type="hidden" name="formato" value="271"><tr><td colspan='2'><?php submit_formato(271,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>