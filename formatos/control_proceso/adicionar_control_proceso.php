<html><title>.:ADICIONAR CONTROL PROCESO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">CONTROL PROCESO</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(372,4351);?></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4352)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4353)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4354)); ?>"><input type="hidden" name="idft_control_proceso" value="<?php echo(validar_valor_campo(4355)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4356)); ?>"><tr>
                     <td class="encabezado" width="20%" title="Nombre">INDICADOR*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="3000"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(4357)); ?>"></td>
                    </tr><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="Estado del control">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(372,4358,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="Hoja de Vida del Indicador">HOJA DE VIDA INDICADOR</td>
                     <td class="celda_transparente"><input  tabindex='2'  type="file" maxlength="255"  class='multi'  name="hoja_vida_indicador[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="campo_descripcion" value="4357"><tr><td colspan='2'><?php submit_formato(372);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>