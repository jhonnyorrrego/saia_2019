<html><title>.:EDITAR EXPERIENCIA LABORAL:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">EXPERIENCIA LABORAL</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(223,2434,$_REQUEST['iddoc']);?></tr><input type="hidden" name="nombre" value="<?php echo(mostrar_valor_campo('nombre',223,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DIRECCION</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="direccion" name="direccion"  value="<?php echo(mostrar_valor_campo('direccion',223,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TEL&Eacute;FONOS</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="telefonos" name="telefonos"  value="<?php echo(mostrar_valor_campo('telefonos',223,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">JEFE IMEDIATO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="jefe_inmediato" name="jefe_inmediato"  value="<?php echo(mostrar_valor_campo('jefe_inmediato',223,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE DE LA EMPRESA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="nombre_empresa" name="nombre_empresa"  value="<?php echo(mostrar_valor_campo('nombre_empresa',223,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CARGO(S) DESEMPE&Ntilde;ADO(S)*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='5'  type="text" size="100" id="cargo_realizado" name="cargo_realizado"  value="<?php echo(mostrar_valor_campo('cargo_realizado',223,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">FUNCIONES REALIZADAS</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="funciones_realizadas" id="funciones_realizadas" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('funciones_realizadas',223,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE INGRESO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='7'  type="text" readonly="true"  class="required dateISO"  name="fecha_ingreso" id="fecha_ingreso" tipo="fecha" value="<?php mostrar_valor_campo('fecha_ingreso',223,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_ingreso","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                       <td class="encabezado" width="20%" title="">FECHA RETIRO</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='8'  type="text" readonly="true"  name="fecha_retiro" id="fecha_retiro" tipo="fecha" value="<?php mostrar_valor_campo('fecha_retiro',223,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_retiro","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                  <td class="encabezado" width="20%" title="">VERIFICADO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(223,2538,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="salario_inicial" value="<?php echo(mostrar_valor_campo('salario_inicial',223,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="salario_final" value="<?php echo(mostrar_valor_campo('salario_final',223,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="motivo_retiro" value="<?php echo(mostrar_valor_campo('motivo_retiro',223,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ADJUNTAR DOCUMENTO</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=223&idcampo=2411" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',223,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',223,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',223,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('2521'); ?>"><input type="hidden" name="formato" value="223"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(223,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>