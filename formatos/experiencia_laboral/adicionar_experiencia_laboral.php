<html><title>.:ADICIONAR EXPERIENCIA LABORAL:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
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
                     <?php buscar_dependencia(223,2434);?></tr><input type="hidden" name="nombre" value="<?php echo(validar_valor_campo(2423)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_hoja_vida"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_hoja_vida"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_hoja_vida);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2410)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DIRECCION</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="direccion" name="direccion"  value="<?php echo(validar_valor_campo(2415)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TEL&Eacute;FONOS</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="telefonos" name="telefonos"  value="<?php echo(validar_valor_campo(2438)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">JEFE IMEDIATO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="jefe_inmediato" name="jefe_inmediato"  value="<?php echo(validar_valor_campo(2421)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE DE LA EMPRESA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="nombre_empresa" name="nombre_empresa"  value="<?php echo(validar_valor_campo(2521)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CARGO(S) DESEMPE&Ntilde;ADO(S)*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='5'  type="text" size="100" id="cargo_realizado" name="cargo_realizado"  value="<?php echo(validar_valor_campo(2413)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">FUNCIONES REALIZADAS</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="funciones_realizadas" id="funciones_realizadas" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(2420)); ?></textarea></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE INGRESO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='7'  type="text" readonly="true"  class="required dateISO"  name="fecha_ingreso" id="fecha_ingreso" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha_ingreso","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                       <td class="encabezado" width="20%" title="">FECHA RETIRO</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='8'  type="text" readonly="true"  name="fecha_retiro" id="fecha_retiro" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_retiro","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                  <td class="encabezado" width="20%" title="">VERIFICADO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(223,2538,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="salario_inicial" value="<?php echo(validar_valor_campo(2426)); ?>"><input type="hidden" name="salario_final" value="<?php echo(validar_valor_campo(2425)); ?>"><input type="hidden" name="motivo_retiro" value="<?php echo(validar_valor_campo(2422)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ADJUNTAR DOCUMENTO</td>
                     <td class="celda_transparente"><input  tabindex='9'  type="file" maxlength="255"  class='multi'  name="adjuntar_documento[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="idft_experiencia_laboral" value="<?php echo(validar_valor_campo(2409)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2433)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2435)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2436)); ?>"><input type="hidden" name="campo_descripcion" value="2521"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(223);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>