<html><title>.:BUSCAR VERIFICACI&OACUTE;N DE INFORMACI&OACUTE;N:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA VERIFICACI&Oacute;N DE INFORMACI&Oacute;N</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fk_idexpediente" id="condicion_fk_idexpediente"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Muestra enlace para abrir highslide con un listado donde se pueda seleccionar el expediente intermedio que hay entre la serie seleccionada.">EXPEDIENTE VINCULADO</td><td class="encabezado">&nbsp;<select name="compara_fk_idexpediente" id="compara_fk_idexpediente"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fk_idexpediente" name="fk_idexpediente"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fk_idexpediente").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_datos_remitente" id="condicion_datos_remitente"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">AFILIADO</td><td class="encabezado">&nbsp;<select name="compara_datos_remitente" id="compara_datos_remitente"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="datos_remitente" name="datos_remitente"></select><script>
                     $(document).ready(function() 
                      {
                      $("#datos_remitente").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_identifica_afiliado" id="condicion_identifica_afiliado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">IDENTIFICACION</td><td class="encabezado">&nbsp;<select name="compara_identifica_afiliado" id="compara_identifica_afiliado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="identifica_afiliado" name="identifica_afiliado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#identifica_afiliado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_inicial_verifi" id="condicion_fecha_inicial_verifi"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA INICIAL</td><td class="encabezado">&nbsp;<select name="compara_fecha_inicial_verifi" id="compara_fecha_inicial_verifi"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_inicial_verifi" name="fecha_inicial_verifi"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_inicial_verifi").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_numero_folios_verifi" id="condicion_numero_folios_verifi"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FOLIOS REMITIDOS</td><td class="encabezado">&nbsp;<select name="compara_numero_folios_verifi" id="compara_numero_folios_verifi"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_folios_verifi" name="numero_folios_verifi"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_folios_verifi").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_numero_folios_recibi" id="condicion_numero_folios_recibi"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FOLIOS RECIBIDOS</td><td class="encabezado">&nbsp;<select name="compara_numero_folios_recibi" id="compara_numero_folios_recibi"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_folios_recibi" name="numero_folios_recibi"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_folios_recibi").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_presenta_inconsisten" id="condicion_presenta_inconsisten"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PRESENTA INCONSISTENCIAS</td><td class="encabezado">&nbsp;<select name="compara_presenta_inconsisten" id="compara_presenta_inconsisten"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(269,3120,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_observacion_verifica" id="condicion_observacion_verifica"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td><td class="encabezado">&nbsp;<select name="compara_observacion_verifica" id="compara_observacion_verifica"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observacion_verifica" name="observacion_verifica"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observacion_verifica").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_afiliado" id="condicion_nombre_afiliado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE AFILIADO</td><td class="encabezado">&nbsp;<select name="compara_nombre_afiliado" id="compara_nombre_afiliado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_afiliado" name="nombre_afiliado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_afiliado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3120"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(269);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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