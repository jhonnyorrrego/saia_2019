<html><title>.:BUSCAR HOJA DE VIDA:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><?php include_once("../../calendario/calendario.php"); ?></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA HOJA DE VIDA</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_documento_identidad" id="condicion_documento_identidad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Cedula de ciudadania">DOCUMENTO IDENTIDAD</td><td class="encabezado">&nbsp;<select name="compara_documento_identidad" id="compara_documento_identidad"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   type="text" size="70" id="documento_identidad" name="documento_identidad"  value="<?php echo(validar_valor_campo(861)); ?>"></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombres" id="condicion_nombres"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRES</td><td class="encabezado">&nbsp;<select name="compara_nombres" id="compara_nombres"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   type="text" size="70" id="nombres" name="nombres"  value="<?php echo(validar_valor_campo(852)); ?>"></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_apellidos" id="condicion_apellidos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">APELLIDOS</td><td class="encabezado">&nbsp;<select name="compara_apellidos" id="compara_apellidos"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   type="text" size="70" id="apellidos" name="apellidos"  value="<?php echo(validar_valor_campo(848)); ?>"></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_nacimiento" id="condicion_fecha_nacimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="Fecha nacimiento">FECHA NACIMIENTO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_nacimiento_1" id="fecha_nacimiento_1" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_nacimiento_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_nacimiento_2" id="fecha_nacimiento_2" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha_nacimiento_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_sanguineo" id="condicion_tipo_sanguineo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Tipo de sangre">TIPO SANGUINEO</td><td class="encabezado">&nbsp;<select name="compara_tipo_sanguineo" id="compara_tipo_sanguineo"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(71,854,$_REQUEST['iddoc']);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_direccion_residencia" id="condicion_direccion_residencia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Direcci&oacute;n Residencia">DIRECCIóN RESIDENCIA</td><td class="encabezado">&nbsp;<select name="compara_direccion_residencia" id="compara_direccion_residencia"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   type="text" size="70" id="direccion_residencia" name="direccion_residencia"  value="<?php echo(validar_valor_campo(855)); ?>"></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_telefono" id="condicion_telefono"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TELEFONO</td><td class="encabezado">&nbsp;<select name="compara_telefono" id="compara_telefono"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="11"   type="text" size="70" id="telefono" name="telefono"  value="<?php echo(validar_valor_campo(853)); ?>"></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_celular" id="condicion_celular"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CELULAR</td><td class="encabezado">&nbsp;<select name="compara_celular" id="compara_celular"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td>
                     <td bgcolor="#F5F5F5"><input  maxlenght="255"   type="text" size="70" id="celular" name="celular"  value="<?php echo(validar_valor_campo(849)); ?>"></td>
                    </tr><input type="hidden" name="campo_descripcion" value="848,852,861"><?php submit_formato(71);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
                <input type="hidden" name="campo__retorno" value="<?php echo($_REQUEST["campo__retorno"]); ?>">
              <?php }
               if(@$_REQUEST["formulario__retorno"]){ ?>
                <input type="hidden" name="formulario__retorno" value="<?php echo($_REQUEST["formulario__retorno"]); ?>">
              <?php }
                if(@$_REQUEST["pagina__retorno"]){ ?>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_REQUEST["pagina__retorno"]); ?>">
             <?php  }
              else{ ?>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_SERVER["PHP_SELF"]); ?>">
             <?php  } ?></form></body></html>