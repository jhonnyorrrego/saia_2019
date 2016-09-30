<html><title>.:ADICIONAR REPORTE DE AVANCE ACCIONES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">REPORTE DE AVANCE ACCIONES</td></tr><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(4885)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4651)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(391,4652);?></tr><input type="hidden" name="idft_seguimiento" value="<?php echo(validar_valor_campo(4653)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_hallazgo"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_hallazgo"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_hallazgo);} ?><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4655)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4656)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4657)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">PORCENTAJE*</td>
                     <?php listado_avance(391,4658);?></tr><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="Estado Actual del Proceso :
ELABORACION,REVISION,APROBACION,DISTRIBUCION,INACTIVO ">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(391,4659,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">LOGROS ALCANZADOS*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="logros_alcanzados" id="logros_alcanzados" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4660)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(4661)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Adjuntar evidencia documental">ADJUNTAR EVIDENCIA DOCUMENTAL</td>
                     <td class="celda_transparente"><input  tabindex='3'  type="file" maxlength="255"  class='multi'  name="evidencia_documental[]" accept="<?php echo $extensiones;?>"><?php validar_responsable(391,NULL);?><input type="hidden" name="campo_descripcion" value="4658,4660"><tr><td colspan='2'><?php submit_formato(391);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>