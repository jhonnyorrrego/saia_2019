<html>
			<title>.:ADICIONAR ADICIONAR SOLICITUD:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("funciones.php"); ?>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr id="tr_tipo_solicitud">
                     <td class="encabezado" width="20%" title="">TIPO SOLICITUD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(469,5912,$_REQUEST['iddoc']);?></td></tr><tr id="tr_tipo">
                     <td class="encabezado" width="20%" title="">TIPO*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="tipo" id="tipo" cols="53" rows="3" class="tiny_sin_tiny required"><?php echo(validar_valor_campo(5913)); ?></textarea></td>
                    </tr><tr id="tr_valor">
                     <td class="encabezado" width="20%" title="">VALOR*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="valor" name="valor"  value="<?php echo(validar_valor_campo(5914)); ?>"></td>
                    </tr><tr id="tr_amortizacion">
                     <td class="encabezado" width="20%" title="">AMORTIZACI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="amortizacion" id="amortizacion" cols="53" rows="3" class="tiny_sin_tiny required"><?php echo(validar_valor_campo(5915)); ?></textarea></td>
                    </tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_validacion_tramite"  value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden"  name="idpadre"  value="<?php echo $_REQUEST["idpadre"]; ?>"><?php } ?><input type="hidden" name="idft_item_add_solicit" value="<?php echo(validar_valor_campo(5917)); ?>"><tr><td class="encabezado">ACCION A SEGUIR LUEGO DE GUARDAR</td><td ><input type="radio" name="opcion_item" id="opcion_item1" value="adicionar">Adicionar otro&nbsp;&nbsp;<input type="radio" id="opcion_item2" name="opcion_item" value="terminar" checked>Terminar</td></tr><?php valida_valor_solicitud(469,NULL);?><?php habilita_tipo_solicitud(469,NULL);?><?php validar_items_tipo_solicitud(469,NULL);?><?php validacion_crear_solicitud(469,NULL);?><input type="hidden" name="campo_descripcion" value="5912"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="item_add_solicit"><input type="hidden" name="accion" value="guardar_item" ><tr>
			<td colspan='2'><?php submit_formato(469);?></td>
		</tr>
		</table></form>
</body>
		</html>