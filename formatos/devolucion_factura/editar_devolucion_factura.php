<html><title>.:EDITAR DEVOLUCION DE FACTURA AL PROVEEDOR:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">DEVOLUCION DE FACTURA AL PROVEEDOR</td></tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES (RAZONES DE DEVOLUCION)*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('observaciones',243,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(243,2771,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">INICIALES*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='2'  type="text" size="100" id="iniciales" name="iniciales"  value="<?php echo(mostrar_valor_campo('iniciales',243,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><input type="hidden" name="idft_devolucion_factura" value="<?php echo(mostrar_valor_campo('idft_devolucion_factura',243,$_REQUEST['iddoc'])); ?>"><tr>
                   <td class="encabezado" width="20%" title="">PROVEEDOR</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  name="proveedor" id="proveedor" value="<?php echo(mostrar_valor_campo('proveedor',243,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("2759",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">FORMA DE ENVIO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(243,2757,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',243,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',243,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ADJUNTAR</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=243&idcampo=2756" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',243,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="datos_creador" value="<?php echo(mostrar_valor_campo('datos_creador',243,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="datos_proveedor" value="<?php echo(mostrar_valor_campo('datos_proveedor',243,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('2757'); ?>"><input type="hidden" name="formato" value="243"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(243,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>