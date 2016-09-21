<html><title>.:ADICIONAR 2. RECEPCI&Oacute;N DE COTIZACI&Oacute;N:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">2. RECEPCI&Oacute;N DE COTIZACI&Oacute;N</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3485)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(298,3484);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA DE RECEPCI&Oacute;N*</td>
                     <?php fecha_formato(298,3476);?></tr><tr>
                   <td class="encabezado" width="20%" title="">PROVEEDOR*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="proveedor" id="proveedor" value=""><?php componente_ejecutor("3477",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr id="tr_regimen" >
                     <td class="encabezado" width="20%" title="">REGIMEN*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(298,3478,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="subtotal" value="<?php echo(validar_valor_campo(3479)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">VALOR IVA (%)*</td>
                     <td bgcolor="#F5F5F5"><input   class="required digits"   tabindex='1'  type="text" size="100" id="valor_iva" name="valor_iva"  value="<?php echo(validar_valor_campo(3480)); ?>"></td>
                    </tr><input type="hidden" name="valor_total" value="<?php echo(validar_valor_campo(3481)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ADJUNTAR PROPUESTA</td>
                     <td class="celda_transparente"><input  tabindex='2'  type="file" maxlength="255"  class='multi'  name="adjuntos[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="idft_recepcion_cotizacion" value="<?php echo(validar_valor_campo(3482)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3483)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3486)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_justificacion_compra"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_justificacion_compra"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_justificacion_compra);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3474)); ?>"><input type="hidden" name="campo_descripcion" value="3477"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(298);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>