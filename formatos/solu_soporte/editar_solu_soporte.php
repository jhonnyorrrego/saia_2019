<html><title>.:EDITAR SOLUCION DE SOPORTE:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLUCION DE SOPORTE</td></tr><input type="hidden" name="idft_solu_soporte" value="<?php echo(mostrar_valor_campo('idft_solu_soporte',340,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',340,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(340,3967,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',340,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',340,$_REQUEST['iddoc'])); ?>"><tr>
                       <td class="encabezado" width="20%" title="">FECHA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_soluc" id="fecha_soluc" tipo="fecha" value="<?php mostrar_valor_campo('fecha_soluc',340,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_soluc","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">SOLUCION*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="solucion" id="solucion" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('solucion',340,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_tipo_causa" >
                     <td class="encabezado" width="20%" title="">CAUSA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(340,3964,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=340&idcampo=3959" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><input type="hidden" name="campo_descripcion" value="<?php echo('3963'); ?>"><input type="hidden" name="formato" value="340"><tr><td colspan='2'><?php submit_formato(340,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>