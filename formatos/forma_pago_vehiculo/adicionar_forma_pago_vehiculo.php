<html><title>.:ADICIONAR FORMA DE PAGO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><input type="hidden" name="idft_forma_pago_vehiculo" value="<?php echo(validar_valor_campo(2974)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">FECHA</td>
                     <?php fecha_formato(261,2970);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CONCEPTO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(261,2971,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">VALOR*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='1'  type="text" size="100" id="valor_forma_pago" name="valor_forma_pago"  value="<?php echo(validar_valor_campo(2972)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="observaciones_pago" name="observaciones_pago"  value="<?php echo(validar_valor_campo(2973)); ?>"></td>
                    </tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_confir_negoci_vehiculo"  value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden"  name="idpadre"  value="<?php echo $_REQUEST["idpadre"]; ?>"><?php } ?><tr><td class="encabezado">ACCION A SEGUIR LUEGO DE GUARDAR</td><td ><input type="radio" name="opcion_item" value="adicionar">Adicionar otro&nbsp;&nbsp;<input type="radio" name="opcion_item" value="terminar">Terminar</td></tr><?php separar_miles_valor_pago(261,NULL);?><input type="hidden" name="campo_descripcion" value="2971"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="forma_pago_vehiculo"><input type="hidden" name="accion" value="guardar_item" ><tr><td colspan='2'><?php submit_formato(261);?></td></tr></table></form></body></html>