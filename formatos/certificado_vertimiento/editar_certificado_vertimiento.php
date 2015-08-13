<html><title>.:EDITAR CERTIFICADO DE VERTIMIENTOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">CERTIFICADO DE VERTIMIENTOS</td></tr><input type="hidden" name="idft_certificado_vertimiento" value="<?php echo(mostrar_valor_campo('idft_certificado_vertimiento',68,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',68,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(68,841,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',68,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',68,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">FECHA DE EXPEDICION*</td>
                     <?php fecha_formato(68,837,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="nombre">NOMBRE DE LA EMPRESA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(mostrar_valor_campo('nombre',68,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="actividad de la empresa">ACTIVIDAD DE LA EMPRESA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="actividad" name="actividad"  value="<?php echo(mostrar_valor_campo('actividad',68,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DIRECCION*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="100"  class="required"   tabindex='3'  type="text" size="100" id="direccion" name="direccion"  value="<?php echo(mostrar_valor_campo('direccion',68,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CODIGO CIIU*</td>
                     <?php codigo_autocom(68,1007,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCION</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_avanzado"><?php echo(mostrar_valor_campo('descripcion',68,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">INICIALES*</td>
                     <?php iniciales(68,844,$_REQUEST['iddoc']);?></tr><input type="hidden" name="campo_descripcion" value="<?php echo('835,1007'); ?>"><input type="hidden" name="formato" value="68"><tr><td colspan='2'><?php submit_formato(68,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>