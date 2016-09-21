<html><title>.:ADICIONAR MACROPROCESO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">MACROPROCESO</td></tr><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(5141)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(359,4132);?></tr><tr>
                     <td class="encabezado" width="20%" title="nombre">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(4133)); ?>"></td>
                    </tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4134)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4135)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4136)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4137)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCION</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="des_formato" id="des_formato" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(4138)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="caracterizacion">CARACTERIZACI&Oacute;N</td>
                     <td class="celda_transparente"><input  tabindex='3'  type="file" maxlength="255"  class='multi'  name="caracterizacion[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="idft_macroproceso_calidad" value="<?php echo(validar_valor_campo(4140)); ?>"><input type="hidden" name="campo_descripcion" value="4133,4138"><tr><td colspan='2'><?php submit_formato(359);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body>
              <script type="text/javascript">
              setInterval("auto_save('nombre','macroproceso_calidad')",300000);
              </script></html>