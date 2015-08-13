<html><title>.:ADICIONAR REFERENCIAS COMERCIALES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">REFERENCIAS COMERCIALES</td></tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_hoja_vida"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_hoja_vida"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_hoja_vida);} ?><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(226,2479);?></tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(2522)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ENTIDAD*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="entidad" name="entidad"  value="<?php echo(validar_valor_campo(2474)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CARGO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="cargo_desempeniado" name="cargo_desempeniado"  value="<?php echo(validar_valor_campo(2470)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TEL&Eacute;FONOS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='4'  type="text" size="100" id="telefono" name="telefono"  value="<?php echo(validar_valor_campo(2477)); ?>"></td>
                    </tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2468)); ?>"><input type="hidden" name="idft_referencias_comerciales" value="<?php echo(validar_valor_campo(2475)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2478)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2480)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2481)); ?>"><input type="hidden" name="campo_descripcion" value="2474"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(226);?></td></tr></table></form></body></html>