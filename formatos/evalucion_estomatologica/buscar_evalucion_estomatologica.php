<html><title>.:BUSCAR EVALUACION ESTOMATOLOGICA:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA EVALUACION ESTOMATOLOGICA</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_proceso_odontologico" id="condicion_proceso_odontologico"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">&iquest;LE HAN REALIZADO ALG&Uacute;N PROCEDIMIENTO ODONTOL&Oacute;GICO ANTERIORMENTE?</td><td class="encabezado">&nbsp;<select name="compara_proceso_odontologico" id="compara_proceso_odontologico"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3254,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_cual_procedimiento" id="condicion_cual_procedimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">&iquest;CU&Aacute;L PROCEDIMIENTO?</td><td class="encabezado">&nbsp;<select name="compara_cual_procedimiento" id="compara_cual_procedimiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cual_procedimiento" name="cual_procedimiento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cual_procedimiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_ultima_visita" id="condicion_ultima_visita"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ULTIMA VISITA</td><td class="encabezado">&nbsp;<select name="compara_ultima_visita" id="compara_ultima_visita"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="ultima_visita" name="ultima_visita"></select><script>
                     $(document).ready(function() 
                      {
                      $("#ultima_visita").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipos_de_limpieza" id="condicion_tipos_de_limpieza"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">TIPOS DE LIMPIEZA</td><td class="encabezado">&nbsp;<select name="compara_tipos_de_limpieza" id="compara_tipos_de_limpieza"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3261,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_labios" id="condicion_labios"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">LABIOS</td><td class="encabezado">&nbsp;<select name="compara_labios" id="compara_labios"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3262,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_lengua" id="condicion_lengua"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">LENGUA</td><td class="encabezado">&nbsp;<select name="compara_lengua" id="compara_lengua"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3263,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_paladar" id="condicion_paladar"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PALADAR</td><td class="encabezado">&nbsp;<select name="compara_paladar" id="compara_paladar"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3264,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_carrillos" id="condicion_carrillos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CARRILLOS</td><td class="encabezado">&nbsp;<select name="compara_carrillos" id="compara_carrillos"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3265,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_piso_de_boca" id="condicion_piso_de_boca"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PISO DE BOCA</td><td class="encabezado">&nbsp;<select name="compara_piso_de_boca" id="compara_piso_de_boca"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3266,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_frenillos" id="condicion_frenillos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FRENILLOS</td><td class="encabezado">&nbsp;<select name="compara_frenillos" id="compara_frenillos"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3267,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_maxilares" id="condicion_maxilares"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MAXILARES</td><td class="encabezado">&nbsp;<select name="compara_maxilares" id="compara_maxilares"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3268,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_funcion_oclusion" id="condicion_funcion_oclusion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FUNCION OCLUSION</td><td class="encabezado">&nbsp;<select name="compara_funcion_oclusion" id="compara_funcion_oclusion"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3269,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_atm" id="condicion_atm"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ATM</td><td class="encabezado">&nbsp;<select name="compara_atm" id="compara_atm"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(284,3270,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_apertura_maxima" id="condicion_apertura_maxima"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">APERTURA MAXIMA</td><td class="encabezado">&nbsp;<select name="compara_apertura_maxima" id="compara_apertura_maxima"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="apertura_maxima" name="apertura_maxima"></select><script>
                     $(document).ready(function() 
                      {
                      $("#apertura_maxima").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_observaciones_tejidob" id="condicion_observaciones_tejidob"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES TEJIDO BLANDO</td><td class="encabezado">&nbsp;<select name="compara_observaciones_tejidob" id="compara_observaciones_tejidob"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones_tejidob" name="observaciones_tejidob"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observaciones_tejidob").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3257"><?php submit_formato(284);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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