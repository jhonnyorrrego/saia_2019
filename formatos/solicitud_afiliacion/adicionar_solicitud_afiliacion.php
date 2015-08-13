<html><title>.:ADICIONAR SOLICITUD DE AFILIACI&Oacute;N:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLICITUD DE AFILIACI&Oacute;N</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3114)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(271,3113);?></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE SOLICITUD*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_solicitud" id="fecha_solicitud" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha_solicitud","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                   <td class="encabezado" width="20%" title="">DATOS DEL SOLICITANTE DE AFILIACI&Oacute;N*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="datos_solicitante" id="datos_solicitante" value=""><?php componente_ejecutor("3108",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FOLIOS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required digits"   tabindex='2'  type="text" size="100" id="numero_folios_afilia" name="numero_folios_afilia"  value="<?php echo(validar_valor_campo(3109)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ADJUNTAR</td>
                     <td class="celda_transparente"><input  tabindex='3'  type="file" maxlength="255"  class='multi'  name="adjuntar_documento[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="idft_solicitud_afiliacion" value="<?php echo(validar_valor_campo(3111)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3112)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3115)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3106)); ?>"><input type="hidden" name="campo_descripcion" value="3107"><tr><td colspan='2'><?php submit_formato(271);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>