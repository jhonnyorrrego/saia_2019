<html><title>.:BUSCAR INFORMACI&OACUTE;N DA&NTILDE;O:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA INFORMACI&Oacute;N DA&Ntilde;O</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_problema" id="condicion_problema"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">PROBLEMA</td><td class="encabezado">&nbsp;<select name="compara_problema" id="compara_problema"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(264,2998,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ft_orden_trabajo_vehiculo" id="condicion_ft_orden_trabajo_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FT_ORDEN_TRABAJO_VEHICULO</td><td class="encabezado">&nbsp;<select name="compara_ft_orden_trabajo_vehiculo" id="compara_ft_orden_trabajo_vehiculo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="ft_orden_trabajo_vehiculo" name="ft_orden_trabajo_vehiculo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#ft_orden_trabajo_vehiculo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_x" id="condicion_x"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">POSICION X</td><td class="encabezado">&nbsp;<select name="compara_x" id="compara_x"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="x" name="x"></select><script>
                     $(document).ready(function() 
                      {
                      $("#x").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_y" id="condicion_y"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">POSICION Y</td><td class="encabezado">&nbsp;<select name="compara_y" id="compara_y"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="y" name="y"></select><script>
                     $(document).ready(function() 
                      {
                      $("#y").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_x2" id="condicion_x2"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">POSICION X2</td><td class="encabezado">&nbsp;<select name="compara_x2" id="compara_x2"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="x2" name="x2"></select><script>
                     $(document).ready(function() 
                      {
                      $("#x2").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_y2" id="condicion_y2"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">POSICION Y2</td><td class="encabezado">&nbsp;<select name="compara_y2" id="compara_y2"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="y2" name="y2"></select><script>
                     $(document).ready(function() 
                      {
                      $("#y2").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_w" id="condicion_w"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">POSICION W</td><td class="encabezado">&nbsp;<select name="compara_w" id="compara_w"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="w" name="w"></select><script>
                     $(document).ready(function() 
                      {
                      $("#w").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_h" id="condicion_h"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">POSICION H</td><td class="encabezado">&nbsp;<select name="compara_h" id="compara_h"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="h" name="h"></select><script>
                     $(document).ready(function() 
                      {
                      $("#h").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="2998"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="informacion_dano"><?php submit_formato(264);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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