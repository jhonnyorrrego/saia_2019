<html>
			<title>.:ADICIONAR VARIABLES INDICADOR:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/funciones_acciones.php"); ?>
			<?php include_once("../librerias/estilo_formulario.php"); ?>
			<?php include_once("../librerias/header_formato.php"); ?>
			<script type="text/javascript" src="../../js/jquery.js"></script>
			<script type="text/javascript" src="../../js/jquery.validate.js"></script>
			<script type="text/javascript" src="../../js/title2note.js"></script>
			<style>label.error{color:red}</style>
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate();
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">VARIABLES INDICADOR</td></tr><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(490,6224);?></tr><tr id="tr_nombre">
                     <td class="encabezado" width="20%" title="Nombre que se va a utilizar en al formula no se deben utilizar caracteres especiales para el espacio utilizar underline">NOMBRE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(6225)); ?>"></td>
                    </tr><tr id="tr_descripcion">
                     <td class="encabezado" width="20%" title="Descripcion que pueda aclarar el valor que se debe asignar a la variable">DESCRIPCION*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(6226)); ?></textarea></td>
                    </tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(6227)); ?>"><input type="hidden" name="idft_variable_indicador" value="<?php echo(validar_valor_campo(6228)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(6229)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(6230)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(6231)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_indicadores_calidad"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_indicadores_calidad"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_indicadores_calidad);} ?><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(6233)); ?>"><input type="hidden" name="campo_descripcion" value="6225,6226"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr>
			<td colspan='2'><?php submit_formato(490);?></td>
		</tr>
		</table></form>
</body>
      <script type="text/javascript">
      setInterval("auto_save('descripcion','variable_indicador')",300000);
      </script>
		</html>