<html><title>.:EDITAR VARIABLES INDICADOR:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/funciones_acciones.php"); ?>
			<?php include_once("../librerias/estilo_formulario.php"); ?>
			<?php include_once("../librerias/header_formato.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_validar_formulario()); ?><script type="text/javascript" src="../../js/title2note.js"></script>
			<style>label.error{color:red}</style>
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate();
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">VARIABLES INDICADOR</td></tr><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(490,6224,$_REQUEST['iddoc']);?></tr><tr id="tr_nombre">
                     <td class="encabezado" width="20%" title="Nombre que se va a utilizar en al formula no se deben utilizar caracteres especiales para el espacio utilizar underline">NOMBRE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(mostrar_valor_campo('nombre',490,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_descripcion">
                     <td class="encabezado" width="20%" title="Descripcion que pueda aclarar el valor que se debe asignar a la variable">DESCRIPCION*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('descripcion',490,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="idft_variable_indicador" value="<?php echo(mostrar_valor_campo('idft_variable_indicador',490,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',490,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',490,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',490,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',490,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('6225,6226'); ?>"><input type="hidden" name="formato" value="490"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(490,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../librerias/footer_plantilla.php");?>