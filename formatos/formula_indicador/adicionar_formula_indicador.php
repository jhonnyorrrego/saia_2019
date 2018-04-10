<html>
			<title>.:ADICIONAR FORMULA DEL INDICADOR:.</title>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">FORMULA DEL INDICADOR</td></tr><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(488,6196);?></tr><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(6197)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_indicadores_calidad"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_indicadores_calidad"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_indicadores_calidad);} ?><tr id="tr_naturaleza" >
                     <td class="encabezado" width="20%" title="Por favor seleccione la naturaleza del Indicador, si desea especificar otra naturaleza por favor especifiquela en las observaciones">NATURALEZA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(488,6199,$_REQUEST['iddoc']);?></td></tr><tr id="tr_nombre">
                     <td class="encabezado" width="20%" title="Muestra la formula que se va a utilizar en el calculo del indicador">FORMULA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(6200)); ?>"></td>
                    </tr><tr id="tr_observacion">
                     <td class="encabezado" width="20%" title="Descripci&oacute;n de Variables de la Formula">DESCRIPCI&Oacute;N DE VARIABLES DE LA FORMULA</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="observacion" id="observacion" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(6201)); ?></textarea></td>
                    </tr><tr id="tr_periocidad" >
                     <td class="encabezado" width="20%" title="Tiempo en el cual se debe evaluar el indicador">PERIODICIDAD</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(488,6202,$_REQUEST['iddoc']);?></td></tr><tr id="tr_unidad">
                     <td class="encabezado" width="20%" title="Unidad en que se debe medir el indicador porcentaje, documentos, personas, atenciones, etc.">UNIDAD*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="50"  class="required"   tabindex='3'  type="text" size="100" id="unidad" name="unidad"  value="<?php echo(validar_valor_campo(6203)); ?>"></td>
                    </tr><tr id="tr_rango_colores">
                     <td class="encabezado" width="20%" title="">RANGO EN EL CUAL EL RESULTADO SE CONSIDERA SATISFACTORIO*</td>
                     <?php rango_formula(488,6204);?></tr><tr id="tr_tipo_rango" >
                     <td class="encabezado" width="20%" title="">LA MEJORA ES CRECIENTE O DECRECIENTE?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(488,6205,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(6206)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(6207)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(6208)); ?>"><input type="hidden" name="idft_formula_indicador" value="<?php echo(validar_valor_campo(6209)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(6210)); ?>"><?php add_edit_formula_ind(488,NULL);?><input type="hidden" name="campo_descripcion" value="6200"><tr>
			<td colspan='2'><?php submit_formato(488);?></td>
		</tr>
		</table></form>
</body>
      <script type="text/javascript">
      setInterval("auto_save('observacion','formula_indicador')",300000);
      </script>
		</html>