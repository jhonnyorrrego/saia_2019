<html><title>.:BUSCAR ANTECEDENTES FAMILIARES:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ANTECEDENTES FAMILIARES</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_cardiaca_familia" id="condicion_cardiaca_familia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ENFERMEDAD CARD&Iacute;ACA EN LA FAMILIA</td><td class="encabezado">&nbsp;<select name="compara_cardiaca_familia" id="compara_cardiaca_familia"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(283,3281,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_cardiaca_quien" id="condicion_cardiaca_quien"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ENFERMEDAD CARDIACA &iquest;QUI&Eacute;N?</td><td class="encabezado">&nbsp;<select name="compara_cardiaca_quien" id="compara_cardiaca_quien"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cardiaca_quien" name="cardiaca_quien"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cardiaca_quien").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_hipertension_familia" id="condicion_hipertension_familia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">HIPERTENSION EN LA FAMILIA</td><td class="encabezado">&nbsp;<select name="compara_hipertension_familia" id="compara_hipertension_familia"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(283,3283,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_hipertension_quien" id="condicion_hipertension_quien"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">HIPERTENSION &iquest;QUI&Eacute;N?</td><td class="encabezado">&nbsp;<select name="compara_hipertension_quien" id="compara_hipertension_quien"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="hipertension_quien" name="hipertension_quien"></select><script>
                     $(document).ready(function() 
                      {
                      $("#hipertension_quien").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_cancer_familia" id="condicion_cancer_familia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CANCER EN LA FAMILIA</td><td class="encabezado">&nbsp;<select name="compara_cancer_familia" id="compara_cancer_familia"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(283,3222,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_cancer_quien" id="condicion_cancer_quien"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CANCER &iquest;QUI&Eacute;N?</td><td class="encabezado">&nbsp;<select name="compara_cancer_quien" id="compara_cancer_quien"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cancer_quien" name="cancer_quien"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cancer_quien").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_respiratoria_familia" id="condicion_respiratoria_familia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ENFERMEDAD RESPIRATORIA EN LA FAMILIA </td><td class="encabezado">&nbsp;<select name="compara_respiratoria_familia" id="compara_respiratoria_familia"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(283,3282,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_respiratorio_quien" id="condicion_respiratorio_quien"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ENFERMEDAD RESPIRATORIA &iquest;QUI&Eacute;N?</td><td class="encabezado">&nbsp;<select name="compara_respiratorio_quien" id="compara_respiratorio_quien"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="respiratorio_quien" name="respiratorio_quien"></select><script>
                     $(document).ready(function() 
                      {
                      $("#respiratorio_quien").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_diabetes_mellitus" id="condicion_diabetes_mellitus"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DIABETES_MELLITUS EN LA FAMILIA</td><td class="encabezado">&nbsp;<select name="compara_diabetes_mellitus" id="compara_diabetes_mellitus"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(283,3228,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_diabetes_quien" id="condicion_diabetes_quien"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DIABETES &iquest;QUI&Eacute;N?</td><td class="encabezado">&nbsp;<select name="compara_diabetes_quien" id="compara_diabetes_quien"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="diabetes_quien" name="diabetes_quien"></select><script>
                     $(document).ready(function() 
                      {
                      $("#diabetes_quien").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_asma_familia" id="condicion_asma_familia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ASMA EN LA FAMILIA</td><td class="encabezado">&nbsp;<select name="compara_asma_familia" id="compara_asma_familia"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(283,3232,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_asma_quien" id="condicion_asma_quien"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ASMA &iquest;QUI&Eacute;N?</td><td class="encabezado">&nbsp;<select name="compara_asma_quien" id="compara_asma_quien"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="asma_quien" name="asma_quien"></select><script>
                     $(document).ready(function() 
                      {
                      $("#asma_quien").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_observacion_familia" id="condicion_observacion_familia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACION FAMILIA</td><td class="encabezado">&nbsp;<select name="compara_observacion_familia" id="compara_observacion_familia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observacion_familia" name="observacion_familia"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observacion_familia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3228"><?php submit_formato(283);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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