<html><title>.:ADICIONAR HOJA DE VIDA:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><?php include_once("../../calendario/calendario.php"); ?><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">HOJA DE VIDA</td></tr><input type="hidden" name="idft_hoja_vida" value="<?php echo(validar_valor_campo(856)); ?>"><tr>
                     <td class="encabezado" width="20%" title="Cedula de ciudadania">DOCUMENTO IDENTIDAD*</td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"  class="required"   type="text" size="100" id="documento_identidad" name="documento_identidad"  value="<?php echo(validar_valor_campo(861)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRES*</td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"  class="required"   type="text" size="100" id="nombres" name="nombres"  value="<?php echo(validar_valor_campo(852)); ?>"></td>
                    </tr><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(857)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">APELLIDOS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"  class="required"   type="text" size="100" id="apellidos" name="apellidos"  value="<?php echo(validar_valor_campo(848)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(71,858);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(859)); ?>"><tr>
                     <td class="encabezado" width="20%" title="Dependencia a la que pertenece la persona">DEPENDENCIA</td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   type="text" size="100" id="dependencia_hoja_vida" name="dependencia_hoja_vida"  value="<?php echo(validar_valor_campo(883)); ?>"></td>
                    </tr><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(860)); ?>"><tr>
                     <td class="encabezado" width="20%" title="Cargo al que pertenece la persona">CARGO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"  class="required"   type="text" size="100" id="cargo" name="cargo"  value="<?php echo(validar_valor_campo(882)); ?>"></td>
                    </tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(847)); ?>"><tr>
                       <td class="encabezado" width="20%" title="Fecha nacimiento">FECHA NACIMIENTO</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_nacimiento" id="fecha_nacimiento" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_nacimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,TRUE); ?><input type="hidden" name="asig_fecha_nacimiento" id="asig_fecha_nacimiento" value=""></span></font></td><tr>
                     <td class="encabezado" width="20%" title="Tipo de sangre">TIPO SANGUINEO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(71,854,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="Direcci&oacute;n Residencia">DIRECCIóN RESIDENCIA</td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   type="text" size="100" id="direccion_residencia" name="direccion_residencia"  value="<?php echo(validar_valor_campo(855)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TELEFONO</td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="11"   type="text" size="100" id="telefono" name="telefono"  value="<?php echo(validar_valor_campo(853)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CELULAR</td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   type="text" size="100" id="celular" name="celular"  value="<?php echo(validar_valor_campo(849)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Correo electr&oacute;nico">EMAIL</td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   type="text" size="100" id="email" name="email"  value="<?php echo(validar_valor_campo(850)); ?>"></td>
                    </tr><input type="hidden" name="campo_descripcion" value="848,852,861"><tr><td colspan='2'><?php submit_formato(71);?></td></tr></table></form></body></html>