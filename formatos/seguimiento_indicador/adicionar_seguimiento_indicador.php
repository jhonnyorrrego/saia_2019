<html>
			<title>.:ADICIONAR SEGUIMIENTO INDICADOR:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/funciones_acciones.php"); ?>
			<?php include_once("../librerias/estilo_formulario.php"); ?>
			<?php include_once("../librerias/header_formato.php"); ?>
			<?php include_once("../../calendario/calendario.php"); ?>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SEGUIMIENTO INDICADOR</td></tr><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(489,6211);?></tr><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(6212)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_formula_indicador"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_formula_indicador"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_formula_indicador);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(6214)); ?>"><tr id="tr_fecha_seguimiento">
                       <td class="encabezado" width="20%" title="Por favor Ingrese la fecha en que se realiza el seguimiento">FECHA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_seguimiento" id="fecha_seguimiento" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha_seguimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_linea_base">
                     <td class="encabezado" width="20%" title="">LIMITE INFERIOR</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="linea_base" name="linea_base"  value="<?php echo(validar_valor_campo(6216)); ?>"></td>
                    </tr><tr id="tr_meta_indicador_actual">
                     <td class="encabezado" width="20%" title="Meta actual del seguimiento">LIMITE SUPERIOR*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="20"  class="required"   tabindex='3'  type="text" size="100" id="meta_indicador_actual" name="meta_indicador_actual"  value="<?php echo(validar_valor_campo(6217)); ?>"></td>
                    </tr><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(6218)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(6219)); ?>"><tr id="tr_resultado">
                     <td class="encabezado" width="20%" title="valores asignados a las variables de la f&oacute;rmula a la cual se hace seguimiento">RESULTADOS</td>
                     <?php formulario_variables(489,6220);?></tr><tr id="tr_observaciones">
                     <td class="encabezado" width="20%" title="an&aacute;lisis de datos">AN&Aacute;LISIS DE DATOS*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(6221)); ?></textarea></td>
                    </tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(6222)); ?>"><input type="hidden" name="idft_seguimiento_indicador" value="<?php echo(validar_valor_campo(6223)); ?>"><?php add_edit_seg_indicador(489,NULL);?><input type="hidden" name="campo_descripcion" value="6215,6217"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr>
			<td colspan='2'><?php submit_formato(489);?></td>
		</tr>
		</table></form>
</body>
      <script type="text/javascript">
      setInterval("auto_save('observaciones','seguimiento_indicador')",300000);
      </script>
		</html>