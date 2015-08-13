<html><title>.:BUSCAR CONFIRMACI&OACUTE;N NEGOCIACI&OACUTE;N VEH&IACUTE;CULO:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA CONFIRMACI&Oacute;N NEGOCIACI&Oacute;N VEH&Iacute;CULO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_confirmacion" id="condicion_fecha_confirmacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">&nbsp;<select name="compara_fecha_confirmacion" id="compara_fecha_confirmacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_confirmacion" name="fecha_confirmacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_confirmacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_placa_asignada_vehiculo" id="condicion_placa_asignada_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PLACA ASIGNADA</td><td class="encabezado">&nbsp;<select name="compara_placa_asignada_vehiculo" id="compara_placa_asignada_vehiculo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="placa_asignada_vehiculo" name="placa_asignada_vehiculo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#placa_asignada_vehiculo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_datos_vehiculo" id="condicion_datos_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DATOS DEL VEH&Iacute;CULO</td><td class="encabezado">&nbsp;<select name="compara_datos_vehiculo" id="compara_datos_vehiculo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="datos_vehiculo" name="datos_vehiculo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#datos_vehiculo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_ver_info_vehiculo" id="condicion_ver_info_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VER INFORMACI&Oacute;N DEL VEH&Iacute;CULO</td><td class="encabezado">&nbsp;<select name="compara_ver_info_vehiculo" id="compara_ver_info_vehiculo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="ver_info_vehiculo" name="ver_info_vehiculo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#ver_info_vehiculo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_accesorios_vehiculo" id="condicion_accesorios_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ACCESORIOS</td><td class="encabezado">&nbsp;<select name="compara_accesorios_vehiculo" id="compara_accesorios_vehiculo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="accesorios_vehiculo" name="accesorios_vehiculo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#accesorios_vehiculo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_datos_cliente" id="condicion_datos_cliente"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DATOS DEL CLIENTE</td><td class="encabezado">&nbsp;<select name="compara_datos_cliente" id="compara_datos_cliente"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="datos_cliente" name="datos_cliente"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#datos_cliente").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr>
                   <td class="encabezado" width="20%" title="">ETIQUETA MATR&Iacute;CULA</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="matricula_etiqueta" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_numero_matricula" id="condicion_numero_matricula"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MATR&Iacute;CULA</td><td class="encabezado">&nbsp;<select name="compara_numero_matricula" id="compara_numero_matricula"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_matricula" name="numero_matricula"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_matricula").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor_matricula" id="condicion_valor_matricula"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR MATR&Iacute;CULA</td><td class="encabezado">&nbsp;<select name="compara_valor_matricula" id="compara_valor_matricula"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor_matricula" name="valor_matricula"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor_matricula").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">ETIQUETA SEGUROS</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="seguros_etiqueta" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_campo_seguros" id="condicion_campo_seguros"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SEGUROS</td><td class="encabezado">&nbsp;<select name="compara_campo_seguros" id="compara_campo_seguros"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="campo_seguros" name="campo_seguros"></select><script>
                     $(document).ready(function() 
                      {
                      $("#campo_seguros").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor_seguros" id="condicion_valor_seguros"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR SEGUROS</td><td class="encabezado">&nbsp;<select name="compara_valor_seguros" id="compara_valor_seguros"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor_seguros" name="valor_seguros"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor_seguros").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_observaciones_negocia" id="condicion_observaciones_negocia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td><td class="encabezado">&nbsp;<select name="compara_observaciones_negocia" id="compara_observaciones_negocia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones_negocia" name="observaciones_negocia"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observaciones_negocia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="2951"><?php submit_formato(260);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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