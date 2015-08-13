<html><title>.:ADICIONAR CITAS EJECUTADAS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">CITAS EJECUTADAS</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3013)); ?>"><input type="hidden" name="idft_citas_ejecutadas" value="<?php echo(validar_valor_campo(3014)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3015)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3017)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3018)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(265,3016);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_formato(265,3019);?></tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_avanzado"><?php echo(validar_valor_campo(3021)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ADJUNTAR INFORMACION*</td>
                     <td class="celda_transparente"><input  tabindex='2'  type="file"  class="required multi"  name="anexo_csv[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="campo_descripcion" value="3019"><tr><td colspan='2'><?php submit_formato(265);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>