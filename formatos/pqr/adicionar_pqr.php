<html><title>.:ADICIONAR PQR:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">PQR</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(210,2234);?></tr><tr>
                    <td class="encabezado" width="20%" title="">FECHA*</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='1'  type="text" readonly="true" name="fecha_pqr" maxlength="255"  class="required dateISO"  id="fecha_pqr" value="<?php echo(date("Y-m-d H:i")); ?>"><?php selector_fecha("fecha_pqr","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">NOMBRES Y APELLIDOS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="nombres_apellidos" name="nombres_apellidos"  value="<?php echo(validar_valor_campo(2225)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CC*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='3'  type="text" size="100" id="identificacion" name="identificacion"  value="<?php echo(validar_valor_campo(2224)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DIRECCION*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="direccion" name="direccion"  value="<?php echo(validar_valor_campo(2223)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TELEFONO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='5'  type="text" size="100" id="telefono" name="telefono"  value="<?php echo(validar_valor_campo(2221)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">EMAIL*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='6'  type="text" size="100" id="email" name="email"  value="<?php echo(validar_valor_campo(2222)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">IDFLUJO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(210,2228,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">SOLICITUD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(210,2220,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OTRO TIPO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='7'  type="text" size="100" id="otro" name="otro"  value="<?php echo(validar_valor_campo(2219)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TIPO SOLICITUD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(210,2237,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2235)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">FORMA DE ENV&Iacute;O*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(210,2236,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="datos_persona" value="<?php echo(validar_valor_campo(2227)); ?>"><input type="hidden" name="idft_pqr" value="<?php echo(validar_valor_campo(2232)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2233)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2231)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2230)); ?>"><input type="hidden" name="responsable" value="<?php echo(validar_valor_campo(2226)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DESCRIBA SU SOLICITUD*</td>
                     <td class="celda_transparente"><textarea  tabindex='8'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(2229)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='9'  type="file" maxlength="255"  class='multi'  name="anexo_formato[]" accept="<?php echo $extensiones;?>"><?php mostrar_imagenes_escaneadas(210,NULL);?><?php insertar_otro_solicitud(210,NULL);?><?php mostrar_campo_otro(210,NULL);?><input type="hidden" name="campo_descripcion" value="2237"><tr><td colspan='2'><?php submit_formato(210);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>