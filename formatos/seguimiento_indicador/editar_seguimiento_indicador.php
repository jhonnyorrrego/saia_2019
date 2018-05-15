<html><title>.:EDITAR SEGUIMIENTO INDICADOR:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/funciones_acciones.php"); ?>
			<?php include_once("../librerias/estilo_formulario.php"); ?>
			<?php include_once("../librerias/header_formato.php"); ?>
			<?php include_once("../../calendario/calendario.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_validar_formulario()); ?><script type="text/javascript" src="../../js/title2note.js"></script>
			<style>label.error{color:red}</style>
				<script type='text/javascript'>
  $(document).ready(function() {
			  		$('#formulario_formatos').validate();
				});
				</script> 
			</head>
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SEGUIMIENTO INDICADOR</td></tr><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(489,6211,$_REQUEST['iddoc']);?></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',489,$_REQUEST['iddoc'])); ?>"><tr id="tr_fecha_seguimiento">
                       <td class="encabezado" width="20%" title="Por favor Ingrese la fecha en que se realiza el seguimiento">FECHA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_seguimiento" id="fecha_seguimiento" tipo="fecha" value="<?php mostrar_valor_campo('fecha_seguimiento',489,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_seguimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_linea_base">
                     <td class="encabezado" width="20%" title="">LIMITE INFERIOR</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="linea_base" name="linea_base"  value="<?php echo(mostrar_valor_campo('linea_base',489,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_meta_indicador_actual">
                     <td class="encabezado" width="20%" title="Meta actual del seguimiento">LIMITE SUPERIOR*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="20"  class="required"   tabindex='3'  type="text" size="100" id="meta_indicador_actual" name="meta_indicador_actual"  value="<?php echo(mostrar_valor_campo('meta_indicador_actual',489,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',489,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',489,$_REQUEST['iddoc'])); ?>"><tr id="tr_resultado">
                     <td class="encabezado" width="20%" title="valores asignados a las variables de la f&oacute;rmula a la cual se hace seguimiento">RESULTADOS</td>
                     <?php formulario_variables(489,6220,$_REQUEST['iddoc']);?></tr><tr id="tr_observaciones">
                     <td class="encabezado" width="20%" title="an&aacute;lisis de datos">AN&Aacute;LISIS DE DATOS*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('observaciones',489,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',489,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_seguimiento_indicador" value="<?php echo(mostrar_valor_campo('idft_seguimiento_indicador',489,$_REQUEST['iddoc'])); ?>"><?php add_edit_seg_indicador(489,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('6215,6217'); ?>"><input type="hidden" name="formato" value="489"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(489,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../librerias/footer_plantilla.php");?>