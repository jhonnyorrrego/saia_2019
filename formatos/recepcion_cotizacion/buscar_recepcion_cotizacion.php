<html><title>.:BUSCAR 2. RECEPCI&OACUTE;N DE COTIZACI&OACUTE;N:.</title><head><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 2. RECEPCI&Oacute;N DE COTIZACI&Oacute;N</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_recepcion_cotiza" id="condicion_fecha_recepcion_cotiza"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE RECEPCI&Oacute;N</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_recepcion_cotiza_1" id="fecha_recepcion_cotiza_1" tipo="fecha" value=""><?php selector_fecha("fecha_recepcion_cotiza_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_recepcion_cotiza_2" id="fecha_recepcion_cotiza_2" tipo="fecha" value=""><?php selector_fecha("fecha_recepcion_cotiza_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_proveedor" id="condicion_proveedor"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PROVEEDOR</td><td class="encabezado">&nbsp;<select name="compara_proveedor" id="compara_proveedor"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="proveedor" name="proveedor"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#proveedor").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_regimen" id="condicion_regimen"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">REGIMEN</td><td class="encabezado">&nbsp;<select name="compara_regimen" id="compara_regimen"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(298,3478,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_subtotal" id="condicion_subtotal"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SUBTOTAL</td><td class="encabezado">&nbsp;<select name="compara_subtotal" id="compara_subtotal"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="subtotal" name="subtotal"></select><script>
                     $(document).ready(function() 
                      {
                      $("#subtotal").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor_iva" id="condicion_valor_iva"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR IVA (%)</td><td class="encabezado">&nbsp;<select name="compara_valor_iva" id="compara_valor_iva"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor_iva" name="valor_iva"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor_iva").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor_total" id="condicion_valor_total"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR TOTAL</td><td class="encabezado">&nbsp;<select name="compara_valor_total" id="compara_valor_total"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor_total" name="valor_total"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor_total").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_adjuntos" id="condicion_adjuntos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ADJUNTAR PROPUESTA</td><td class="encabezado">&nbsp;<select name="compara_adjuntos" id="compara_adjuntos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="adjuntos" name="adjuntos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#adjuntos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3477"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(298);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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