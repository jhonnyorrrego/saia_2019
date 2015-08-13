<html><title>.:BUSCAR EVOLUCION DE TRATAMIENTO:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA EVOLUCION DE TRATAMIENTO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_evolucion" id="condicion_fecha_evolucion"><option value="AND">Y</option><option value="OR">O</option></td>
                    <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_evolucion_1"  id="fecha_evolucion_1" value=""><?php selector_fecha("fecha_evolucion_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_evolucion_2"  id="fecha_evolucion_2" value=""><?php selector_fecha("fecha_evolucion_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_procedimiento_evolucion" id="condicion_procedimiento_evolucion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PROCEDIMIENTO</td><td class="encabezado">&nbsp;<select name="compara_procedimiento_evolucion" id="compara_procedimiento_evolucion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="procedimiento_evolucion" name="procedimiento_evolucion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#procedimiento_evolucion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_firma_paciente" id="condicion_firma_paciente"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FIRMA PACIENTE</td><td class="encabezado">&nbsp;<select name="compara_firma_paciente" id="compara_firma_paciente"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="firma_paciente" name="firma_paciente"></select><script>
                     $(document).ready(function() 
                      {
                      $("#firma_paciente").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_firma_profesional" id="condicion_firma_profesional"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FIRMA PROFESIONAL</td><td class="encabezado">&nbsp;<select name="compara_firma_profesional" id="compara_firma_profesional"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="firma_profesional" name="firma_profesional"></select><script>
                     $(document).ready(function() 
                      {
                      $("#firma_profesional").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_abono_evoluciones" id="condicion_abono_evoluciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ABONO</td><td class="encabezado">&nbsp;<select name="compara_abono_evoluciones" id="compara_abono_evoluciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="abono_evoluciones" name="abono_evoluciones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#abono_evoluciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="evolucion_tratamiento"><?php submit_formato(294);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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