<html><title>.:BUSCAR INVENTARIO RETIRADOS:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA INVENTARIO RETIRADOS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ubicacion" id="condicion_ubicacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">UBICACIóN</td><td class="encabezado">&nbsp;<select name="compara_ubicacion" id="compara_ubicacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="ubicacion" name="ubicacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#ubicacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_numero_caja" id="condicion_numero_caja"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NO. DE CAJA</td><td class="encabezado">&nbsp;<select name="compara_numero_caja" id="compara_numero_caja"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_caja" name="numero_caja"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_caja").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_retiro" id="condicion_fecha_retiro"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE RETIRO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_retiro_1" id="fecha_retiro_1" tipo="fecha" value=""><?php selector_fecha("fecha_retiro_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_retiro_2" id="fecha_retiro_2" tipo="fecha" value=""><?php selector_fecha("fecha_retiro_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_primer_apellido" id="condicion_primer_apellido"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">1ER. APELLIDO</td><td class="encabezado">&nbsp;<select name="compara_primer_apellido" id="compara_primer_apellido"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="primer_apellido" name="primer_apellido"></select><script>
                     $(document).ready(function() 
                      {
                      $("#primer_apellido").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_segundo_apellido" id="condicion_segundo_apellido"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">2DO. APELLIDO</td><td class="encabezado">&nbsp;<select name="compara_segundo_apellido" id="compara_segundo_apellido"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="segundo_apellido" name="segundo_apellido"></select><script>
                     $(document).ready(function() 
                      {
                      $("#segundo_apellido").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_completo" id="condicion_nombre_completo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE COMPLETO</td><td class="encabezado">&nbsp;<select name="compara_nombre_completo" id="compara_nombre_completo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_completo" name="nombre_completo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_completo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_num_identificacion" id="condicion_num_identificacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NO. DE IDENTIFICACIóN</td><td class="encabezado">&nbsp;<select name="compara_num_identificacion" id="compara_num_identificacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="num_identificacion" name="num_identificacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#num_identificacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_extrema_inicia" id="condicion_fecha_extrema_inicia"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA EXTREMA INICIAL</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_extrema_inicia_1" id="fecha_extrema_inicia_1" tipo="fecha" value=""><?php selector_fecha("fecha_extrema_inicia_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_extrema_inicia_2" id="fecha_extrema_inicia_2" tipo="fecha" value=""><?php selector_fecha("fecha_extrema_inicia_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_extrema_final" id="condicion_fecha_extrema_final"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA EXTREMA FINAL</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_extrema_final_1" id="fecha_extrema_final_1" tipo="fecha" value=""><?php selector_fecha("fecha_extrema_final_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_extrema_final_2" id="fecha_extrema_final_2" tipo="fecha" value=""><?php selector_fecha("fecha_extrema_final_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_folios" id="condicion_folios"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FOLIOS</td><td class="encabezado">&nbsp;<select name="compara_folios" id="compara_folios"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="folios" name="folios"></select><script>
                     $(document).ready(function() 
                      {
                      $("#folios").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_ultimo_cargo" id="condicion_ultimo_cargo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ÚLTIMO CARGO</td><td class="encabezado">&nbsp;<select name="compara_ultimo_cargo" id="compara_ultimo_cargo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="ultimo_cargo" name="ultimo_cargo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#ultimo_cargo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_estamento" id="condicion_estamento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ESTAMENTO</td><td class="encabezado">&nbsp;<select name="compara_estamento" id="compara_estamento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="estamento" name="estamento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#estamento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_jubilado_otra_instit" id="condicion_jubilado_otra_instit"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">JUBILADO POR OTRA INSTITUCIóN</td><td class="encabezado">&nbsp;<select name="compara_jubilado_otra_instit" id="compara_jubilado_otra_instit"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="jubilado_otra_instit" name="jubilado_otra_instit"></select><script>
                     $(document).ready(function() 
                      {
                      $("#jubilado_otra_instit").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_observaciones" id="condicion_observaciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td><td class="encabezado">&nbsp;<select name="compara_observaciones" id="compara_observaciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones" name="observaciones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observaciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="5031"><?php submit_formato(408);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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