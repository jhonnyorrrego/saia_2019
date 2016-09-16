<html><title>.:ADICIONAR DEVOLUCION DE FACTURA AL PROVEEDOR:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
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
                     <td class="celda_transparente"><textarea  tabindex='1'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(2774)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(243,2771);?></tr><tr>
                     <td class="encabezado" width="20%" title="">INICIALES*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='2'  type="text" size="100" id="iniciales" name="iniciales"  value="<?php echo(validar_valor_campo(2758)); ?>"></td>
                    </tr><input type="hidden" name="idft_devolucion_factura" value="<?php echo(validar_valor_campo(2769)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2755)); ?>"><tr>
                   <td class="encabezado" width="20%" title="">PROVEEDOR</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  name="proveedor" id="proveedor" value=""><?php componente_ejecutor("2759",@$_REQUEST["iddoc"]); ?></td>
                  </tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_factura_proveedor"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_factura_proveedor"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_factura_proveedor);} ?><tr>
                     <td class="encabezado" width="20%" title="">FORMA DE ENVIO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(243,2757,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2770)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2772)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ADJUNTAR</td>
                     <td class="celda_transparente"><input  tabindex='3'  type="file" maxlength="255"  class='multi'  name="adjuntar[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2773)); ?>"><input type="hidden" name="datos_creador" value="<?php echo(validar_valor_campo(2762)); ?>"><input type="hidden" name="datos_proveedor" value="<?php echo(validar_valor_campo(2763)); ?>"><?php campos_adicionar_devolucion(243,NULL);?><input type="hidden" name="campo_descripcion" value="2757"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(243);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>