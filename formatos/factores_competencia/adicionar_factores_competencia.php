<html>
			<title>.:ADICIONAR FACTORES DE COMPETENCIA:.</title>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_ingreso_personal"  value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden"  name="idpadre"  value="<?php echo $_REQUEST["idpadre"]; ?>"><?php } ?><tr id="tr_factor_competencia" >
                     <td class="encabezado" width="20%" title="">FACTOR DE COMPETENCIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(442,5489,$_REQUEST['iddoc']);?></td></tr><tr id="tr_requerido">
                     <td class="encabezado" width="20%" title="">REQUERIDO</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="requerido" id="requerido" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(5490)); ?></textarea></td>
                    </tr><tr id="tr_real_factor">
                     <td class="encabezado" width="20%" title="">REAL</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="real_factor" id="real_factor" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(5491)); ?></textarea></td>
                    </tr><tr id="tr_observaciones_acciones">
                     <td class="encabezado" width="20%" title="">OBSERVACIONES/ACCIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="observaciones_acciones" id="observaciones_acciones" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(5492)); ?></textarea></td>
                    </tr><input type="hidden" name="idft_factores_competencia" value="<?php echo(validar_valor_campo(5493)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(5494)); ?>"><tr><td class="encabezado">ACCION A SEGUIR LUEGO DE GUARDAR</td><td ><input type="radio" name="opcion_item" id="opcion_item1" value="adicionar">Adicionar otro&nbsp;&nbsp;<input type="radio" id="opcion_item2" name="opcion_item" value="terminar" checked>Terminar</td></tr><input type="hidden" name="campo_descripcion" value="5489"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="factores_competencia"><input type="hidden" name="accion" value="guardar_item" ><tr>
			<td colspan='2'><?php submit_formato(442);?></td>
		</tr>
		</table></form>
</body>
		</html>