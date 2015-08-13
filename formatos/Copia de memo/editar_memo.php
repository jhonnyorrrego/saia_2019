<html><title>.:EDITAR MEMORANDO:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">MEMORANDO</td></tr><input type="hidden" name="idft_memo" value="<?php echo(mostrar_valor_campo('idft_memo',3,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',3,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',3,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',3,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">TIPO DE DOCUMENTO*</td>
                     <?php arbol_serie_nuevo(3,54,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_formato(3,45,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">DESTINO*</td>
                     <?php arbol_funcionarios(3,46,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">ASUNTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   obligatorio="obligatorio" class="required"   type="text" size="100" id="asunto" name="asunto"  value="<?php echo(mostrar_valor_campo('asunto',3,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CONTENIDO*</td>
                     <td class="celda_transparente"><textarea name="contenido"  cols="53" rows="3" class="tiny_"><?php echo(mostrar_valor_campo('contenido',3,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DESPEDIDA*</td>
                     <?php despedida(3,50,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CON COPIA A</td>
                     <?php arbol_funcionarios(3,47,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">PREPARó*</td>
                     <?php iniciales(3,51,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS FISICOS</td>
                     <?php anexos_fisicos(3,52,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="Anexos digitales">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=3&idcampo=819" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Adminstrar Anexos</a>
			</div>'; ?><tr>
                     <td class="encabezado" width="20%" title="">MOSTRAR DEPENDENCIA AL FIRMAR*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,929,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="campo_descripcion" value="<?php echo('48'); ?>"><input type="hidden" name="formato" value="3"><tr><td colspan='2'><?php submit_formato(3,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>