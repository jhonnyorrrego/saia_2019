<html><title>.:EDITAR ORDEN DE PAGO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">ORDEN DE PAGO</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',238,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(238,2682,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CC-OT-PEDIDOS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(238,2673,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRPCI&Oacute;N</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('descripcion',238,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">PAGUESE A*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="page_a" id="page_a" value="<?php echo(mostrar_valor_campo('page_a',238,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("2675",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('observaciones',238,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES DE RETE IVA*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="observaciones_iva" id="observaciones_iva" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('observaciones_iva',238,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_urgencia_pago" >
                     <td class="encabezado" width="20%" title="">URGENCIA DEL PAGO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(238,2679,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="idft_orden_pago" value="<?php echo(mostrar_valor_campo('idft_orden_pago',238,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',238,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',238,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',238,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('2675,2676'); ?>"><input type="hidden" name="formato" value="238"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(238,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>