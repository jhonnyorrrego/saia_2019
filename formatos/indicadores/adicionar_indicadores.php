<html><title>.:ADICIONAR 4. INDICADORES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">4. INDICADORES</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(202,2129);?></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha" id="fecha" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(2125)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">C&Oacute;DIGO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="codigo" name="codigo"  value="<?php echo(validar_valor_campo(2121)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">VERSI&Oacute;N*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='4'  type="text" size="100" id="version" name="version"  value="<?php echo(validar_valor_campo(2126)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(2122)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(202,2123,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS*</td>
                     <td class="celda_transparente"><input  tabindex='6'  type="file" maxlength="255"  class="required multi"  name="anexos[]" accept="<?php echo $extensiones;?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_proceso"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_proceso"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_proceso);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2119)); ?>"><input type="hidden" name="idft_indicadores" value="<?php echo(validar_valor_campo(2127)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2128)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2130)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2131)); ?>"><input type="hidden" name="campo_descripcion" value="2125"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(202);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>