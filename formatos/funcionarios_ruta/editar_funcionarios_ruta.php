<html><title>.:EDITAR FUNCIONARIOS DE LA RUTA:.</title>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../formatos/librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr id="tr_fecha_mensajero"><td class="encabezado" width="20%" title="">FECHA*</td><?php fecha_formato(406,5008,$_REQUEST['iddoc']);?></tr><tr id="tr_mensajero_ruta">
                     <td class="encabezado" width="20%" title="">MENSAJERO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(406,5005,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="estado_mensajero" value="<?php echo(mostrar_valor_campo('estado_mensajero',406,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_funcionarios_ruta" value="<?php echo(mostrar_valor_campo('idft_funcionarios_ruta',406,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="formato" value="406"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="funcionarios_ruta"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(406,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../../" . FORMATOS_SAIA . "librerias/footer_plantilla.php");?>