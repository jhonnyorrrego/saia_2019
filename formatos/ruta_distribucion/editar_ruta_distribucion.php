<html><title>.:EDITAR RUTAS DE DISTRIBUCI&Oacute;N:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_acciones.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_validar_formulario()); ?><script type="text/javascript" src="../../js/title2note.js"></script><style>label.error{color:red}</style>
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate({	
						submitHandler: function(form) {
							<?php encriptar_sqli('formulario_formatos',0,'form_info','../../');?>
							form.submit();
						}
					});
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">RUTAS DE DISTRIBUCIÓN</td></tr><tr id="tr_dependencia"><td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td><?php buscar_dependencia(404,4991,$_REQUEST['iddoc']);?></tr><tr id="tr_fecha_ruta_distribuc"><td class="encabezado" width="20%" title="">FECHA*</td><?php fecha_formato(404,4986,$_REQUEST['iddoc']);?></tr><tr id="tr_nombre_ruta">
                     <td class="encabezado" width="20%" title="">NOMBRE DE LA RUTA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre_ruta" name="nombre_ruta"  value="<?php echo(mostrar_valor_campo('nombre_ruta',404,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_descripcion_ruta">
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N RUTA</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion_ruta" id="descripcion_ruta" cols="53" rows="3" class="tiny_sin_tiny"><?php echo(mostrar_valor_campo('descripcion_ruta',404,$_REQUEST['iddoc'])); ?></textarea></td></tr><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',404,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',404,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',404,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_ruta_distribucion" value="<?php echo(mostrar_valor_campo('idft_ruta_distribucion',404,$_REQUEST['iddoc'])); ?>"><?php add_edit_ruta_dist(404,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('4987'); ?>"><input type="hidden" name="formato" value="404"><tr><td colspan='2'><?php submit_formato(404,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../../" . FORMATOS_SAIA . "librerias/footer_plantilla.php");?>