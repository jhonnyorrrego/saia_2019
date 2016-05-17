<html><title>.:EDITAR PQRSF:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("../radicacion_entrada/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">PQRSF</td></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',305,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(305,3578,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA</td>
                     <?php fecha_formato(305,3831,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE COMPLETOS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(mostrar_valor_campo('nombre',305,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DOCUMENTO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="documento" name="documento"  value="<?php echo(mostrar_valor_campo('documento',305,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">EMAIL*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="email" name="email"  value="<?php echo(mostrar_valor_campo('email',305,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TELEFONO O CELULAR</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="telefono" name="telefono"  value="<?php echo(mostrar_valor_campo('telefono',305,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ROL EN LA INSTITUCION*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(305,3573,$_REQUEST['iddoc']);?></td></tr><tr id="tr_tipo" >
                     <td class="encabezado" width="20%" title="">TIPO COMENTARIO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(305,3575,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">COMENTARIOS*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="comentarios" id="comentarios" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('comentarios',305,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="iniciativa_publica" value="<?php echo(mostrar_valor_campo('iniciativa_publica',305,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="sector_iniciativa" value="<?php echo(mostrar_valor_campo('sector_iniciativa',305,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="cluster" value="<?php echo(mostrar_valor_campo('cluster',305,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="region" value="<?php echo(mostrar_valor_campo('region',305,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DOCUMENTO SOPORTE COMENTARIO</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=305&idcampo=3563" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><input type="hidden" name="estado_reporte" value="<?php echo(mostrar_valor_campo('estado_reporte',305,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_verificacion" value="<?php echo(mostrar_valor_campo('estado_verificacion',305,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_reporte" value="<?php echo(mostrar_valor_campo('fecha_reporte',305,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="funcionario_reporte" value="<?php echo(mostrar_valor_campo('funcionario_reporte',305,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_pqrsf" value="<?php echo(mostrar_valor_campo('idft_pqrsf',305,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',305,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',305,$_REQUEST['iddoc'])); ?>"><?php digitalizar_formato_radicacion(305,NULL,$_REQUEST['iddoc']);?><?php validar_email(305,NULL,$_REQUEST['iddoc']);?><?php ver_mensajes(305,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('3572'); ?>"><input type="hidden" name="formato" value="305"><tr><td colspan='2'><?php submit_formato(305,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>