<html><title>.:ADICIONAR ACTIVIDAD PROCESO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">ACTIVIDAD PROCESO</td></tr><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(4864)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4305)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4306)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(368,4307);?></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4308)); ?>"><input type="hidden" name="idft_actividad_proceso" value="<?php echo(validar_valor_campo(4309)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4310)); ?>"><tr>
                     <td class="encabezado" width="20%" title="Proveedor de la Actividad puede ser una Entidad o Porceso">PROVEEDOR*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="proveedor" id="proveedor" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4311)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Nombre de la Entrada puede ser un proceso o Entidad Externa">ENTRADA*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="entrada" id="entrada" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4312)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Nombre de la Actividad del Proceso">ACTIVIDAD/SUBPROCESO*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="nombre" id="nombre" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4313)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Puntos de control de la Actividad">PUNTO DE CONTROL</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="punto_control" id="punto_control" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(4314)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Salidas que Entrega la Actividad del proceso">SALIDA*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="salida" id="salida" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4315)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Cliente de la Actividad puede ser una Entidad o Porceso">CLIENTE*</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="cliente" id="cliente" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4316)); ?></textarea></td>
                    </tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_proceso"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_proceso"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_proceso);} ?><input type="hidden" name="campo_descripcion" value="4313"><tr><td colspan='2'><?php submit_formato(368);?></td></tr></table></form></body></html>