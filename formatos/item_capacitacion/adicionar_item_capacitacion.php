<html><title>.:ADICIONAR ITEM CAPACITACION:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_encuesta_ingreso"  value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden"  name="idpadre"  value="<?php echo $_REQUEST["idpadre"]; ?>"><?php } ?><tr id="tr_etiqueta2">
                     <td class="encabezado" width="20%" title="" colspan="2" id="etiqueta2"><center>En qu&eacute; le gustar&iacute;a recibir capacitaci&oacute;n?</center></td>
                    </tr><tr id="tr_conocimiento_tecnico">
                     <td class="encabezado" width="20%" title="">CONOCIMIENTOS T&Eacute;CNICOS EN*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="conocimiento_tecnico" name="conocimiento_tecnico"  value="<?php echo(validar_valor_campo(5540)); ?>"></td>
                    </tr><tr id="tr_etiqueta1">
                     <td class="encabezado" width="20%" title="" colspan="2" id="etiqueta1"><center>En qu&eacute; le gustar&iacute;a recibir capacitaci&oacute;n?</center></td>
                    </tr><tr id="tr_conocimiento_personal">
                     <td class="encabezado" width="20%" title="">CRECIMIENTO PERSONAL EN*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="conocimiento_personal" name="conocimiento_personal"  value="<?php echo(validar_valor_campo(5542)); ?>"></td>
                    </tr><input type="hidden" name="idft_item_capacitacion" value="<?php echo(validar_valor_campo(5543)); ?>"><tr><td class="encabezado">ACCION A SEGUIR LUEGO DE GUARDAR</td><td ><input type="radio" name="opcion_item" id="opcion_item1" value="adicionar">Adicionar otro&nbsp;&nbsp;<input type="radio" id="opcion_item2" name="opcion_item" value="terminar" checked>Terminar</td></tr><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="item_capacitacion"><input type="hidden" name="accion" value="guardar_item" ><tr><td colspan='2'><?php submit_formato(445);?></td></tr></table></form></body></html>