<html><title>.:ADICIONAR SOLICITUD COTIZACION :.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLICITUD COTIZACION </td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3859)); ?>"><tr>
                       <td class="encabezado" width="20%" title="Esta es la fecha en que inicia la solicitud de cotizaci&Atilde;�&Acirc;&sup3;n">FECHA DE INICIO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_inicio" id="fecha_inicio" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha_inicio","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><input type="hidden" name="idft_solicitud_cotiza_pav" value="<?php echo(validar_valor_campo(3861)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3862)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(330,3863);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3864)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3865)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ANEXO*</td>
                     <td class="celda_transparente"><input  tabindex='2'  type="file" maxlength="255"  class="required multi"  name="anexo[]" accept="pdf|doc"><tr><td colspan='2'><?php submit_formato(330);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>