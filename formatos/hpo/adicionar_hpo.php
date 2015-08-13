<html><title>.:ADICIONAR DETALLE ORDENES DE COMPRA Y REQUISICIONES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.spin.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_requisicion_compra"  value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden"  name="idpadre"  value="<?php echo $_REQUEST["idpadre"]; ?>"><?php } ?><input type="hidden" name="phid" value="<?php echo(validar_valor_campo(3702)); ?>"><input type="hidden" name="pline" value="<?php echo(validar_valor_campo(3703)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">CANTIDAD ORDENADA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"   tabindex='1'  type="input" id="pqord" name="pqord"  value="<?php echo(validar_valor_campo(3704)); ?>"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#pqord").spin({imageBasePath:'../../images/'});
              });
              </script><tr>
                       <td class="encabezado" width="20%" title="">FECHA VENCIMIENTO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='2'  type="text" readonly="true"  class="required dateISO"  name="pddte" id="pddte" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("pddte","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><input type="hidden" name="idft_hpo" value="<?php echo(validar_valor_campo(3706)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">NUMERO DE REQUISICION</td>
                     <?php pord(316,3710);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CODIGO DEL PRODUCTO</td>
                     <?php pprod(316,3711);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CODIGO UNIDAD DE MEDIDA</td>
                     <?php pum(316,3712);?></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3713)); ?>"><tr><td class="encabezado">ACCION A SEGUIR LUEGO DE GUARDAR</td><td ><input type="radio" name="opcion_item" value="adicionar">Adicionar otro&nbsp;&nbsp;<input type="radio" name="opcion_item" value="terminar">Terminar</td></tr><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="hpo"><input type="hidden" name="accion" value="guardar_item" ><tr><td colspan='2'><?php submit_formato(316);?></td></tr></table></form></body></html>