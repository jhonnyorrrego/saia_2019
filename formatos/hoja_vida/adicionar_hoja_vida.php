<html><title>.:ADICIONAR HISTORIA LABORAL:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../librerias/dependientes.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">HISTORIA LABORAL</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2361)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(219,2360);?></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2339)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(2340)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">APELLIDOS*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='2'  type="text" size="100" id="apellidos" name="apellidos"  value="<?php echo(validar_valor_campo(2341)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DOCUMENTO DE IDENTIDAD*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="documento_identidad" name="documento_identidad"  value="<?php echo(validar_valor_campo(2342)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DE (MUNICIPIO DE EXPEDICION)*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(219,2343,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DIRECCION*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="direccion" name="direccion"  value="<?php echo(validar_valor_campo(2344)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TEL&Eacute;FONOS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='5'  type="text" size="100" id="telefonos" name="telefonos"  value="<?php echo(validar_valor_campo(2345)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CELULAR</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='6'  type="text" size="100" id="celular" name="celular"  value="<?php echo(validar_valor_campo(2346)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">E-MAIL</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="email"   tabindex='7'  type="text" size="100" id="email" name="email"  value="<?php echo(validar_valor_campo(2347)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">LUGAR DE NACIMIENTO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(219,2348,$_REQUEST['iddoc']);?></td></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE NACIMIENTO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='8'  type="text" readonly="true"  class="required dateISO"  name="fecha_nacimiento" id="fecha_nacimiento" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_nacimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">EPS EN LA QUE SE ENCUENTRA AFILIADO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='9'  type="text" size="100" id="eps" name="eps"  value="<?php echo(validar_valor_campo(2350)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CUENTA DE AHORRO N&Uacute;MERO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="50"   tabindex='10'  type="text" size="100" id="cuenta_ahorro" name="cuenta_ahorro"  value="<?php echo(validar_valor_campo(2352)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">FONDO DE PENSIONES EN LAS QUE SE ENCUENTRA AFILIADO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='11'  type="text" size="100" id="pensiones" name="pensiones"  value="<?php echo(validar_valor_campo(2482)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">FONDO DE CESANT&Iacute;AS EN LA QUE SE ENCUENTRA AFILIADO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='12'  type="text" size="100" id="cesantias" name="cesantias"  value="<?php echo(validar_valor_campo(2357)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">BANCO DE LA CUENTA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='13'  type="text" size="100" id="banco" name="banco"  value="<?php echo(validar_valor_campo(2353)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TALLA BLUSA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='14'  type="text" size="100" id="blusa" name="blusa"  value="<?php echo(validar_valor_campo(2354)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TALLA PANTALON</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='15'  type="text" size="100" id="pantalon" name="pantalon"  value="<?php echo(validar_valor_campo(2355)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CALZADO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="5"  class="required"   tabindex='16'  type="text" size="100" id="calzado" name="calzado"  value="<?php echo(validar_valor_campo(2356)); ?>"></td>
                    </tr><input type="hidden" name="idft_hoja_vida" value="<?php echo(validar_valor_campo(2358)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2359)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2362)); ?>"><input type="hidden" name="campo_descripcion" value="2340"><tr><td colspan='2'><?php submit_formato(219);?></td></tr></table></form></body></html>