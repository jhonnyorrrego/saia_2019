<html><title>.:EDITAR DESPACHO FISICO:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_acciones.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_validar_formulario()); ?><script type="text/javascript" src="../../js/title2note.js"></script><style>label.error{color:red}</style>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">DESPACHO FISICO</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',352,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_despacho" value="<?php echo(mostrar_valor_campo('fecha_despacho',352,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia"><td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td><?php buscar_dependencia(352,4069,$_REQUEST['iddoc']);?></tr><input type="hidden" name="docs_seleccionados" value="<?php echo(mostrar_valor_campo('docs_seleccionados',352,$_REQUEST['iddoc'])); ?>"><tr id="tr_mensajero">
                     <td class="encabezado" width="20%" title="">SELECCIONE MENSAJERO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(352,4066,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="idft_despacho_fisico" value="<?php echo(mostrar_valor_campo('idft_despacho_fisico',352,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',352,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',352,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',352,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('4081'); ?>"><input type="hidden" name="formato" value="352"><tr><td colspan='2'><?php submit_formato(352,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../../" . FORMATOS_SAIA . "librerias/footer_plantilla.php");?>