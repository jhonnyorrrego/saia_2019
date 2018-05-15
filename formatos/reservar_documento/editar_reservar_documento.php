<html><title>.:EDITAR RESERVAR:.</title>
			<head><?php include_once("../../librerias_saia.php"); ?>
			<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
			<?php include_once("../carta/funciones.php"); ?>
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
			<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">RESERVAR</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',324,$_REQUEST['iddoc'])); ?>"><tr id="tr_doc_relacionado">
                     <td class="encabezado" width="20%" title="Guarda el iddocumento relacionado">DOCUMENTO RELACIONADO</td>
                     <?php ft_tabla_funcion(324,3789,$_REQUEST['iddoc']);?></tr><input type="hidden" name="fecha_entrega" value="<?php echo(mostrar_valor_campo('fecha_entrega',324,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="usuario_entrega" value="<?php echo(mostrar_valor_campo('usuario_entrega',324,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="observacion_entrega" value="<?php echo(mostrar_valor_campo('observacion_entrega',324,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_devolver" value="<?php echo(mostrar_valor_campo('fecha_devolver',324,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="usuario_devolver" value="<?php echo(mostrar_valor_campo('usuario_devolver',324,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="observacion_devolver" value="<?php echo(mostrar_valor_campo('observacion_devolver',324,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_doc" value="<?php echo(mostrar_valor_campo('estado_doc',324,$_REQUEST['iddoc'])); ?>"><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(324,3781,$_REQUEST['iddoc']);?></tr><input type="hidden" name="idft_reservar_documento" value="<?php echo(mostrar_valor_campo('idft_reservar_documento',324,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',324,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',324,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',324,$_REQUEST['iddoc'])); ?>"><tr id="tr_fecha_solicitud">
                     <td class="encabezado" width="20%" title="">FECHA DE SOLICITUD*</td>
                     <?php fecha_formato(324,3784,$_REQUEST['iddoc']);?></tr><tr id="tr_desde">
                    <td class="encabezado" width="20%" title="">DESDE*</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='1'  type="text" readonly="true" name="desde"  class="required dateISO"  id="desde" value="<?php mostrar_valor_campo('desde',324,$_REQUEST['iddoc']); ?>"><?php selector_fecha("desde","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td><tr id="tr_hasta">
                    <td class="encabezado" width="20%" title="">HASTA*</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='2'  type="text" readonly="true" name="hasta"  class="required dateISO"  id="hasta" value="<?php mostrar_valor_campo('hasta',324,$_REQUEST['iddoc']); ?>"><?php selector_fecha("hasta","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td><tr id="tr_solicitar_a">
                     <td class="encabezado" width="20%" title="">SOLICITAR A*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(324,3787,$_REQUEST['iddoc']);?></td></tr><tr id="tr_observaciones">
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones',324,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="campo_descripcion" value="<?php echo('3784'); ?>"><input type="hidden" name="formato" value="324"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(324,$_REQUEST['iddoc']);?></td></tr></table></form></body>
		</html><?php include_once("../librerias/footer_plantilla.php");?>