<html><title>.:ADICIONAR BASES DE CALIDAD:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">BASES DE CALIDAD</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(387,4583);?></tr><tr id="tr_tipo_base_calidad" >
                     <td class="encabezado" width="20%" title="">TIPO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(387,4586,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">VERSI&Oacute;N</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="version_base_calidad" name="version_base_calidad"  value="<?php echo(validar_valor_campo(4587)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion_base" id="descripcion_base" cols="53" rows="3" class="tiny_sin_tiny"><?php echo(validar_valor_campo(4588)); ?></textarea></td>
                    </tr><tr id="tr_estado_base_calidad" >
                     <td class="encabezado" width="20%" title="">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(387,4589,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">SOPORTE</td>
                     <td class="celda_transparente"><input  tabindex='3'  type="file"  class='multi'  name="soporte_base_calidad[]" accept="jpg|JPG|PDF|pdf"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4580)); ?>"><input type="hidden" name="idft_bases_calidad" value="<?php echo(validar_valor_campo(4581)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4582)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4584)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4585)); ?>"><?php asignar_responsables(387,NULL);?><input type="hidden" name="campo_descripcion" value="4586"><tr><td colspan='2'><?php submit_formato(387);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>