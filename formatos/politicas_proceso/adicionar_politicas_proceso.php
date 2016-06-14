<html><title>.:ADICIONAR POLITICAS DE OPERACION DE PROCESO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">POLITICAS DE OPERACION DE PROCESO</td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4318)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4319)); ?>"><input type="hidden" name="idft_politicas_proceso" value="<?php echo(validar_valor_campo(4320)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4321)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4322)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(369,4323);?></tr><tr>
                     <td class="encabezado" width="20%" title="Nombre">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(4324)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Permite adicionar la descripcion de las politicas del Proceso ">DESCRIPCION</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(4325)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Soporte">SOPORTE</td>
                     <td class="celda_transparente"><input  tabindex='3'  type="file" maxlength="255"  class='multi'  name="soporte[]" accept="<?php echo $extensiones;?>"><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(369,4328,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="campo_descripcion" value="4324"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(369);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>