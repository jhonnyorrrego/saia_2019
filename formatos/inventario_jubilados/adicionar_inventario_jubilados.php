<html><title>.:ADICIONAR INVENTARIO JUBILADOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.spin.js"></script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">INVENTARIO JUBILADOS</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(409,5068);?></tr><tr id="tr_ubicacion">
                     <td class="encabezado" width="20%" title="">UBICACIóN*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="ubicacion" name="ubicacion"  value="<?php echo(validar_valor_campo(5047)); ?>"></td>
                    </tr><tr id="tr_numero_caja">
                     <td class="encabezado" width="20%" title="">NO. DE CAJA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="numero_caja" name="numero_caja"  value="<?php echo(validar_valor_campo(5048)); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE JUBILACIóN*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='3'  type="text" readonly="true"  class="required dateISO"  name="fecha_jubilacion" id="fecha_jubilacion" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha_jubilacion","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_numero_resolucion">
                     <td class="encabezado" width="20%" title="">NO. DE RESOLUCIóN	</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="numero_resolucion" name="numero_resolucion"  value="<?php echo(validar_valor_campo(5050)); ?>"></td>
                    </tr><tr id="tr_emanada_de">
                     <td class="encabezado" width="20%" title="">EMANADA DE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='5'  type="text" size="100" id="emanada_de" name="emanada_de"  value="<?php echo(validar_valor_campo(5051)); ?>"></td>
                    </tr><tr id="tr_primer_apellido">
                     <td class="encabezado" width="20%" title="">1ER. APELLIDO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='6'  type="text" size="100" id="primer_apellido" name="primer_apellido"  value="<?php echo(validar_valor_campo(5052)); ?>"></td>
                    </tr><tr id="tr_segundo_apellido">
                     <td class="encabezado" width="20%" title="">2DO. APELLIDO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"   tabindex='7'  type="text" size="100" id="segundo_apellido" name="segundo_apellido"  value="<?php echo(validar_valor_campo(5053)); ?>"></td>
                    </tr><tr id="tr_nombre_completo">
                     <td class="encabezado" width="20%" title="">NOMBRE COMPLETO	*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='8'  type="text" size="100" id="nombre_completo" name="nombre_completo"  value="<?php echo(validar_valor_campo(5054)); ?>"></td>
                    </tr><tr id="tr_num_identificacion">
                     <td class="encabezado" width="20%" title="">NO. DE IDENTIFICACIóN*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='9'  type="text" size="100" id="num_identificacion" name="num_identificacion"  value="<?php echo(validar_valor_campo(5055)); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA EXTREMA INICIAL*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='10'  type="text" readonly="true"  class="required dateISO"  name="fecha_extrema_inicia" id="fecha_extrema_inicia" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_extrema_inicia","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                       <td class="encabezado" width="20%" title="">FECHA EXTREMA FINAL*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='11'  type="text" readonly="true"  class="required dateISO"  name="fecha_extrema_final" id="fecha_extrema_final" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_extrema_final","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">FOLIOS*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required" min="0" max="1000"  tabindex='12'  type="input" id="folios" name="folios"  value="<?php echo(validar_valor_campo(5058)); ?>"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#folios").spin({imageBasePath:'../../images/',min:0,max:1000,interval:1});
              });
              </script><tr id="tr_ultimo_cargo">
                     <td class="encabezado" width="20%" title="">ÚLTIMO CARGO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='13'  type="text" size="100" id="ultimo_cargo" name="ultimo_cargo"  value="<?php echo(validar_valor_campo(5059)); ?>"></td>
                    </tr><tr id="tr_estamento">
                     <td class="encabezado" width="20%" title="">ESTAMENTO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='14'  type="text" size="100" id="estamento" name="estamento"  value="<?php echo(validar_valor_campo(5060)); ?>"></td>
                    </tr><tr id="tr_demandado">
                     <td class="encabezado" width="20%" title="">DEMANDADO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='15'  type="text" size="100" id="demandado" name="demandado"  value="<?php echo(validar_valor_campo(5061)); ?>"></td>
                    </tr><tr id="tr_sustitucion_pensiona">
                     <td class="encabezado" width="20%" title="">SUSTITUCIóN PENSIONAL</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='16'  type="text" size="100" id="sustitucion_pensiona" name="sustitucion_pensiona"  value="<?php echo(validar_valor_campo(5062)); ?>"></td>
                    </tr><tr id="tr_cedula_sustitucion">
                     <td class="encabezado" width="20%" title="">CéDULA SUSTITUCIóN PENSIONAL	</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='17'  type="text" size="100" id="cedula_sustitucion" name="cedula_sustitucion"  value="<?php echo(validar_valor_campo(5063)); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE RECONOCIMIENTO SUSTITUCI&Oacute;N PENSIONAL	</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='18'  type="text" readonly="true"  name="fecha_reconocimiento" id="fecha_reconocimiento" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha_reconocimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='19'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_sin_tiny"><?php echo(validar_valor_campo(5065)); ?></textarea></td>
                    </tr><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(5070)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(5069)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(5067)); ?>"><input type="hidden" name="idft_inventario_jubilados" value="<?php echo(validar_valor_campo(5066)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(5046)); ?>"><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(5045)); ?>"><tr><td colspan='2'><?php submit_formato(409);?></td></tr></table></form></body></html>