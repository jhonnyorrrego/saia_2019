<html><title>.:ADICIONAR CONTACTOS ADICIONALES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_readh"  value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden"  name="idpadre"  value="<?php echo $_REQUEST["idpadre"]; ?>"><?php } ?><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(3740)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">IDENTIFICACION*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='2'  type="text" size="100" id="identificacion" name="identificacion"  value="<?php echo(validar_valor_campo(3741)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DIRECCI&Oacute;N</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="direccion" name="direccion"  value="<?php echo(validar_valor_campo(3742)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TELEFONO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="telefono" name="telefono"  value="<?php echo(validar_valor_campo(3743)); ?>"></td>
                    </tr><input type="hidden" name="idft_contacto_adicional" value="<?php echo(validar_valor_campo(3744)); ?>"><tr><td class="encabezado">ACCION A SEGUIR LUEGO DE GUARDAR</td><td ><input type="radio" name="opcion_item" value="adicionar">Adicionar otro&nbsp;&nbsp;<input type="radio" name="opcion_item" value="terminar">Terminar</td></tr><input type="hidden" name="campo_descripcion" value="3740"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="contacto_adicional"><input type="hidden" name="accion" value="guardar_item" ><tr><td colspan='2'><?php submit_formato(319);?></td></tr></table></form></body></html>