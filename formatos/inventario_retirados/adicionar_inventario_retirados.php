<html><title>.:ADICIONAR INVENTARIO RETIRADOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.spin.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">INVENTARIO RETIRADOS</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(408,5042);?></tr><tr id="tr_ubicacion">
                     <td class="encabezado" width="20%" title="">UBICACIóN*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="ubicacion" name="ubicacion"  value="<?php echo(validar_valor_campo(5026)); ?>"></td>
                    </tr><tr id="tr_numero_caja">
                     <td class="encabezado" width="20%" title="">NO. DE CAJA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="numero_caja" name="numero_caja"  value="<?php echo(validar_valor_campo(5027)); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE RETIRO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='3'  type="text" readonly="true"  class="required dateISO"  name="fecha_retiro" id="fecha_retiro" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha_retiro","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_primer_apellido">
                     <td class="encabezado" width="20%" title="">1ER. APELLIDO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="primer_apellido" name="primer_apellido"  value="<?php echo(validar_valor_campo(5029)); ?>"></td>
                    </tr><tr id="tr_segundo_apellido">
                     <td class="encabezado" width="20%" title="">2DO. APELLIDO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='5'  type="text" size="100" id="segundo_apellido" name="segundo_apellido"  value="<?php echo(validar_valor_campo(5030)); ?>"></td>
                    </tr><tr id="tr_nombre_completo">
                     <td class="encabezado" width="20%" title="">NOMBRE COMPLETO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='6'  type="text" size="100" id="nombre_completo" name="nombre_completo"  value="<?php echo(validar_valor_campo(5031)); ?>"></td>
                    </tr><tr id="tr_num_identificacion">
                     <td class="encabezado" width="20%" title="">NO. DE IDENTIFICACIóN*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='7'  type="text" size="100" id="num_identificacion" name="num_identificacion"  value="<?php echo(validar_valor_campo(5032)); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA EXTREMA INICIAL*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='8'  type="text" readonly="true"  class="required dateISO"  name="fecha_extrema_inicia" id="fecha_extrema_inicia" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_extrema_inicia","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                       <td class="encabezado" width="20%" title="">FECHA EXTREMA FINAL*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='9'  type="text" readonly="true"  class="required dateISO"  name="fecha_extrema_final" id="fecha_extrema_final" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_extrema_final","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">FOLIOS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required" min="0" max="100"  tabindex='10'  type="input" id="folios" name="folios"  value="<?php echo(validar_valor_campo(5035)); ?>"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#folios").spin({imageBasePath:'../../images/',min:0,max:100,interval:1});
              });
              </script><tr id="tr_ultimo_cargo">
                     <td class="encabezado" width="20%" title="">ÚLTIMO CARGO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='11'  type="text" size="100" id="ultimo_cargo" name="ultimo_cargo"  value="<?php echo(validar_valor_campo(5036)); ?>"></td>
                    </tr><tr id="tr_estamento">
                     <td class="encabezado" width="20%" title="">ESTAMENTO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='12'  type="text" size="100" id="estamento" name="estamento"  value="<?php echo(validar_valor_campo(5037)); ?>"></td>
                    </tr><tr id="tr_jubilado_otra_instit">
                     <td class="encabezado" width="20%" title="">JUBILADO POR OTRA INSTITUCIóN</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='13'  type="text" size="100" id="jubilado_otra_instit" name="jubilado_otra_instit"  value="<?php echo(validar_valor_campo(5038)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='14'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_sin_tiny"><?php echo(validar_valor_campo(5039)); ?></textarea></td>
                    </tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(5025)); ?>"><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(5024)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(5043)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(5044)); ?>"><input type="hidden" name="idft_inventario_retirados" value="<?php echo(validar_valor_campo(5040)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(5041)); ?>"><input type="hidden" name="campo_descripcion" value="5031"><tr><td colspan='2'><?php submit_formato(408);?></td></tr></table></form></body></html>