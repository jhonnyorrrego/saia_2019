<html>
			<title>.:EDITAR FACTORES DE COMPETENCIA:.</title>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr id="tr_factor_competencia" >
                     <td class="encabezado" width="20%" title="">FACTOR DE COMPETENCIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(442,5489,$_REQUEST['iddoc']);?></td></tr><tr id="tr_requerido">
                     <td class="encabezado" width="20%" title="">REQUERIDO</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="requerido" id="requerido" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('requerido',442,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_real_factor">
                     <td class="encabezado" width="20%" title="">REAL</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="real_factor" id="real_factor" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('real_factor',442,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_observaciones_acciones">
                     <td class="encabezado" width="20%" title="">OBSERVACIONES/ACCIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="observaciones_acciones" id="observaciones_acciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones_acciones',442,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="idft_factores_competencia" value="<?php echo(mostrar_valor_campo('idft_factores_competencia',442,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('5489'); ?>"><input type="hidden" name="formato" value="442"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="factores_competencia"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr>
			<td colspan='2'><?php submit_formato(442,$_REQUEST['iddoc']);?></td>
		</tr>
		</table></form>
</body>
		</html><?php include_once("../librerias/footer_plantilla.php");?>