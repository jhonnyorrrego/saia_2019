<html><title>.:BUSCAR ENFERMEDAD ACTUAL (SIGNOS Y S&IACUTE;NTOMAS RELACIONADOS CON EL MOTIVO DE CONSULTA):.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ENFERMEDAD ACTUAL (SIGNOS Y S&Iacute;NTOMAS RELACIONADOS CON EL MOTIVO DE CONSULTA)</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_enfermedad_actual_ortodoncia" id="condicion_enfermedad_actual_ortodoncia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ENFERMEDAD ACTUAL (SIGNOS Y S&Iacute;NTOMAS RELACIONADOS CON EL MOTIVO DE CONSULTA)</td><td class="encabezado">&nbsp;<select name="compara_enfermedad_actual_ortodoncia" id="compara_enfermedad_actual_ortodoncia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="enfermedad_actual_ortodoncia" name="enfermedad_actual_ortodoncia"></select><script>
                     $(document).ready(function() 
                      {
                      $("#enfermedad_actual_ortodoncia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3291"><?php submit_formato(286);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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