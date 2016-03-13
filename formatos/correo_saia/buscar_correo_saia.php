<html><title>.:BUSCAR CORREO SAIA:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA CORREO SAIA</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_asunto" id="condicion_asunto"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Asunto del correo">ASUNTO</td><td class="encabezado">&nbsp;<select name="compara_asunto" id="compara_asunto"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="asunto" name="asunto"></select><script>
                     $(document).ready(function() 
                      {
                      $("#asunto").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_oficio_entrada" id="condicion_fecha_oficio_entrada"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Fecha de entrada del oficio">FECHA OFICIO ENTRADA</td><td class="encabezado">&nbsp;<select name="compara_fecha_oficio_entrada" id="compara_fecha_oficio_entrada"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_oficio_entrada" name="fecha_oficio_entrada"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_oficio_entrada").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_de" id="condicion_de"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Remitente del correo">DE</td><td class="encabezado">&nbsp;<select name="compara_de" id="compara_de"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="de" name="de"></select><script>
                     $(document).ready(function() 
                      {
                      $("#de").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_para" id="condicion_para"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PARA</td><td class="encabezado">&nbsp;<select name="compara_para" id="compara_para"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="para" name="para"></select><script>
                     $(document).ready(function() 
                      {
                      $("#para").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_comentario" id="condicion_comentario"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Comentario del correo">COMENTARIO</td><td class="encabezado">&nbsp;<select name="compara_comentario" id="compara_comentario"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="comentario" name="comentario"></select><script>
                     $(document).ready(function() 
                      {
                      $("#comentario").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexos" id="condicion_anexos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Anexos del correo">ANEXOS</td><td class="encabezado">&nbsp;<select name="compara_anexos" id="compara_anexos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexos" name="anexos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="4031"><?php submit_formato(348);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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