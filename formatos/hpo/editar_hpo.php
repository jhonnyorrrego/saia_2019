<html><title>.:EDITAR DETALLE ORDENES DE COMPRA Y REQUISICIONES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.spin.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><input type="hidden" name="phid" value="<?php echo(mostrar_valor_campo('phid',316,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="pline" value="<?php echo(mostrar_valor_campo('pline',316,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">CANTIDAD ORDENADA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"   tabindex='1'  type="input" id="pqord" name="pqord"  value="<?php echo(mostrar_valor_campo('pqord',316,$_REQUEST['iddoc'])); ?>"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#pqord").spin({imageBasePath:'../../images/'});
              });
              </script><tr>
                       <td class="encabezado" width="20%" title="">FECHA VENCIMIENTO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='2'  type="text" readonly="true"  class="required dateISO"  name="pddte" id="pddte" tipo="fecha" value="<?php mostrar_valor_campo('pddte',316,$_REQUEST['iddoc']); ?>"><?php selector_fecha("pddte","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><input type="hidden" name="idft_hpo" value="<?php echo(mostrar_valor_campo('idft_hpo',316,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">NUMERO DE REQUISICION</td>
                     <?php pord(316,3710,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CODIGO DEL PRODUCTO</td>
                     <?php pprod(316,3711,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CODIGO UNIDAD DE MEDIDA</td>
                     <?php pum(316,3712,$_REQUEST['iddoc']);?></tr><input type="hidden" name="formato" value="316"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="hpo"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(316,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>