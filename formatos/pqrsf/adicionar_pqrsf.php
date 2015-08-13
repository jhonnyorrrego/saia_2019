<html><title>.:ADICIONAR PQRSF:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">PQRSF</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3579)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(305,3578);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA</td>
                     <?php fecha_formato(305,3569);?></tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE COMPLETOS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(3572)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DOCUMENTO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="documento" name="documento"  value="<?php echo(validar_valor_campo(3565)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">EMAIL*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="email" name="email"  value="<?php echo(validar_valor_campo(3566)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TELEFONO O CELULAR</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="telefono" name="telefono"  value="<?php echo(validar_valor_campo(3574)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ROL EN LA INSTITUCION*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(305,3573,$_REQUEST['iddoc']);?></td></tr><tr id="tr_tipo" >
                     <td class="encabezado" width="20%" title="">TIPO COMENTARIO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(305,3575,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">COMENTARIOS*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="comentarios" id="comentarios" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(3564)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DOCUMENTO SOPORTE COMENTARIO</td>
                     <td class="celda_transparente"><input  tabindex='6'  type="file" maxlength="255"  class='multi'  name="anexos[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="estado_reporte" value="<?php echo(validar_valor_campo(3567)); ?>"><input type="hidden" name="estado_verificacion" value="<?php echo(validar_valor_campo(3568)); ?>"><input type="hidden" name="fecha_reporte" value="<?php echo(validar_valor_campo(3570)); ?>"><input type="hidden" name="funcionario_reporte" value="<?php echo(validar_valor_campo(3571)); ?>"><input type="hidden" name="idft_pqrsf" value="<?php echo(validar_valor_campo(3576)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3577)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3580)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3562)); ?>"><?php validar_email(305,NULL);?><?php ver_mensajes(305,NULL);?><input type="hidden" name="campo_descripcion" value="3572"><tr><td colspan='2'><?php submit_formato(305);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>