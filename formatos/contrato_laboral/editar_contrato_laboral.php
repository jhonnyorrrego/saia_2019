<html><title>.:EDITAR CONTRATO LABORAL:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">CONTRATO LABORAL</td></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',229,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(229,2532,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">TIPO DE CONTRATO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(229,2529,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO CONTRATO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="num_contarto" name="num_contarto"  value="<?php echo(mostrar_valor_campo('num_contarto',229,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA INICIO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='2'  type="text" readonly="true"  class="required dateISO"  name="fecha_inicio" id="fecha_inicio" tipo="fecha" value="<?php mostrar_valor_campo('fecha_inicio',229,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_inicio","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE FINALIZACI&Oacute;N*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='3'  type="text" readonly="true"  class="required dateISO"  name="fecha_final" id="fecha_final" tipo="fecha" value="<?php mostrar_valor_campo('fecha_final',229,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_final","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">SULEDO INICIAL</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="sueldo_ini" name="sueldo_ini"  value="<?php echo(mostrar_valor_campo('sueldo_ini',229,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">SUELDO FINAL</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='5'  type="text" size="100" id="sueldo_final" name="sueldo_final"  value="<?php echo(mostrar_valor_campo('sueldo_final',229,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><input type="hidden" name="idft_contrato_laboral" value="<?php echo(mostrar_valor_campo('idft_contrato_laboral',229,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',229,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',229,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ADJUNTOS</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=229&idcampo=2535" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><?php formatear_numero(229,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('2526'); ?>"><input type="hidden" name="formato" value="229"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(229,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>