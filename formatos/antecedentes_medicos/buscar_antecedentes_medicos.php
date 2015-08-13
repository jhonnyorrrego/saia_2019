<html><title>.:BUSCAR ANTECEDENTES M&EACUTE;DICOS:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ANTECEDENTES M&Eacute;DICOS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_padece_enfermedad" id="condicion_padece_enfermedad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PADECE DE ALGUNA ENFERMEDAD ACTUALMENTE</td><td class="encabezado">&nbsp;<select name="compara_padece_enfermedad" id="compara_padece_enfermedad"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3158,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_cual_enfermedad" id="condicion_cual_enfermedad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">&iquest;CU&Aacute;L ENFERMEDAD?</td><td class="encabezado">&nbsp;<select name="compara_cual_enfermedad" id="compara_cual_enfermedad"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cual_enfermedad" name="cual_enfermedad"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cual_enfermedad").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_recibe_medicamento" id="condicion_recibe_medicamento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RECIBE ALG&Uacute;N MEDICAMENTO</td><td class="encabezado">&nbsp;<select name="compara_recibe_medicamento" id="compara_recibe_medicamento"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3160,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_cual_medicamento" id="condicion_cual_medicamento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">&iquest;CU&Aacute;L MEDICAMENTO?</td><td class="encabezado">&nbsp;<select name="compara_cual_medicamento" id="compara_cual_medicamento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cual_medicamento" name="cual_medicamento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cual_medicamento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_enfermedades_cardiacas" id="condicion_enfermedades_cardiacas"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ENFERMEDADES CARD&Iacute;ACAS</td><td class="encabezado">&nbsp;<select name="compara_enfermedades_cardiacas" id="compara_enfermedades_cardiacas"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3163,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_hipertension_arterial" id="condicion_hipertension_arterial"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">HIPERTENSI&Oacute;N ARTERIAL</td><td class="encabezado">&nbsp;<select name="compara_hipertension_arterial" id="compara_hipertension_arterial"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3164,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_enfer_respiratoria" id="condicion_enfer_respiratoria"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ENFERMEDAD RESPIRATORIA</td><td class="encabezado">&nbsp;<select name="compara_enfer_respiratoria" id="compara_enfer_respiratoria"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3195,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_enfermedad_renal" id="condicion_enfermedad_renal"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ENFERMEDAD RENAL</td><td class="encabezado">&nbsp;<select name="compara_enfermedad_renal" id="compara_enfermedad_renal"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3167,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_hepatitis" id="condicion_hepatitis"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">HEPATITIS</td><td class="encabezado">&nbsp;<select name="compara_hepatitis" id="compara_hepatitis"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3170,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_diabetes" id="condicion_diabetes"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DIABETES</td><td class="encabezado">&nbsp;<select name="compara_diabetes" id="compara_diabetes"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3168,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_trastorno_sanguineo" id="condicion_trastorno_sanguineo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TRASTORNOS SANGU&Iacute;NEOS</td><td class="encabezado">&nbsp;<select name="compara_trastorno_sanguineo" id="compara_trastorno_sanguineo"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3173,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fiebre_reumatica" id="condicion_fiebre_reumatica"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FIEBRE REUMATICA</td><td class="encabezado">&nbsp;<select name="compara_fiebre_reumatica" id="compara_fiebre_reumatica"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3279,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_alergias" id="condicion_alergias"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ALERGIAS</td><td class="encabezado">&nbsp;<select name="compara_alergias" id="compara_alergias"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3177,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_obstruccion_nasal" id="condicion_obstruccion_nasal"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSTRUCCI&Oacute;N_NASAL</td><td class="encabezado">&nbsp;<select name="compara_obstruccion_nasal" id="compara_obstruccion_nasal"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3179,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_cirujias" id="condicion_cirujias"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CIRUJ&Iacute;AS</td><td class="encabezado">&nbsp;<select name="compara_cirujias" id="compara_cirujias"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3181,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_adenoides" id="condicion_adenoides"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ADENOIDES</td><td class="encabezado">&nbsp;<select name="compara_adenoides" id="compara_adenoides"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3198,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_amigdalas" id="condicion_amigdalas"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">AMIGDALAS</td><td class="encabezado">&nbsp;<select name="compara_amigdalas" id="compara_amigdalas"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(281,3199,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_otro_antecedente" id="condicion_otro_antecedente"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OTRO &iquest;CU&Aacute;L?</td><td class="encabezado">&nbsp;<select name="compara_otro_antecedente" id="compara_otro_antecedente"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="otro_antecedente" name="otro_antecedente"></select><script>
                     $(document).ready(function() 
                      {
                      $("#otro_antecedente").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_edad_menstruacion" id="condicion_edad_menstruacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">EDAD DE LA PRIMERA MENSTRUACI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_edad_menstruacion" id="compara_edad_menstruacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="edad_menstruacion" name="edad_menstruacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#edad_menstruacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_observacion_ante" id="condicion_observacion_ante"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td><td class="encabezado">&nbsp;<select name="compara_observacion_ante" id="compara_observacion_ante"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observacion_ante" name="observacion_ante"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observacion_ante").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3161"><?php submit_formato(281);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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