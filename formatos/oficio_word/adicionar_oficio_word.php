<html><title>.:ADICIONAR OFICIO WORD:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">OFICIO WORD</td></tr><tr>
                     <td class="encabezado" width="20%" title="" colspan="2" id="enlace_plantilla"></td>
                    </tr><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(4795)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4796)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ANEXO WORD*</td>
                     <td class="celda_transparente"><input  tabindex='1'  type="file" maxlength="255"  class="required multi"  name="anexo_word[]" accept="docx|DOCX"><tr>
                     <td class="encabezado" width="20%" title="">ANEXO CSV</td>
                     <td class="celda_transparente"><input  tabindex='2'  type="file" maxlength="255"  class='multi'  name="anexo_csv[]" accept="csv|CSV"><input type="hidden" name="idft_oficio_word" value="<?php echo(validar_valor_campo(4800)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4801)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(400,4802);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4803)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4804)); ?>"><?php asignar_responsables(400,NULL);?><?php mostrar_enlace_plantilla(400,NULL);?><tr><td colspan='2'><?php submit_formato(400);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>