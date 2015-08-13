<html><title>.:ADICIONAR VOLUMEN DOCUMENTAL:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.spin.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_readh"  value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden"  name="idpadre"  value="<?php echo $_REQUEST["idpadre"]; ?>"><?php } ?><tr id="tr_tipo_soporte" >
                     <td class="encabezado" width="20%" title="">TIPO DE SOPORTE*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(318,3733,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">CANTIDAD*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required digits"   tabindex='1'  type="input" id="cantidad" name="cantidad"  value="<?php echo(validar_valor_campo(3734)); ?>"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#cantidad").spin({imageBasePath:'../../images/'});
              });
              </script><tr>
                  <td class="encabezado" width="20%" title="">RIESGOS*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(318,3735,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCION*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion_volumen" id="descripcion_volumen" cols="53" rows="3" class="tiny_sin_tiny required"><?php echo(validar_valor_campo(3736)); ?></textarea></td>
                    </tr><tr id="tr_nivel_pertinencia" >
                     <td class="encabezado" width="20%" title="">NIVEL DE PERTINENCIA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(318,3737,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="idft_volumen_documental" value="<?php echo(validar_valor_campo(3738)); ?>"><tr><td class="encabezado">ACCION A SEGUIR LUEGO DE GUARDAR</td><td ><input type="radio" name="opcion_item" value="adicionar">Adicionar otro&nbsp;&nbsp;<input type="radio" name="opcion_item" value="terminar">Terminar</td></tr><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="volumen_documental"><input type="hidden" name="accion" value="guardar_item" ><tr><td colspan='2'><?php submit_formato(318);?></td></tr></table></form></body></html>