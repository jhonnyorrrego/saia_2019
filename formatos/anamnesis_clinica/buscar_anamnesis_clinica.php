<html><title>.:BUSCAR 1. ANAMNESIS:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 1. ANAMNESIS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_motivo_consulta" id="condicion_motivo_consulta"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MOTIVO DE CONSULTA</td><td class="encabezado">&nbsp;<select name="compara_motivo_consulta" id="compara_motivo_consulta"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="motivo_consulta" name="motivo_consulta"></select><script>
                     $(document).ready(function() 
                      {
                      $("#motivo_consulta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_enfermedad_actual" id="condicion_enfermedad_actual"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ENFERMEDAD ACTUAL</td><td class="encabezado">&nbsp;<select name="compara_enfermedad_actual" id="compara_enfermedad_actual"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="enfermedad_actual" name="enfermedad_actual"></select><script>
                     $(document).ready(function() 
                      {
                      $("#enfermedad_actual").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_antecedentes_medicos" id="condicion_antecedentes_medicos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANTECEDENTES M&Eacute;DICOS</td><td class="encabezado">&nbsp;<select name="compara_antecedentes_medicos" id="compara_antecedentes_medicos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="antecedentes_medicos" name="antecedentes_medicos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#antecedentes_medicos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_antecedentes_familiares_a" id="condicion_antecedentes_familiares_a"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANTECEDENTES FAMILIARES</td><td class="encabezado">&nbsp;<select name="compara_antecedentes_familiares_a" id="compara_antecedentes_familiares_a"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="antecedentes_familiares_a" name="antecedentes_familiares_a"></select><script>
                     $(document).ready(function() 
                      {
                      $("#antecedentes_familiares_a").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3280"><?php submit_formato(285);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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