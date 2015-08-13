<html><title>.:BUSCAR REGISTRO ESPECIAL DE ARCHIVO (READH):.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA REGISTRO ESPECIAL DE ARCHIVO (READH)</td></tr><tr id="tr_tipo_entidad"><td class="encabezado">&nbsp;<select name="condicion_tipo_entidad" id="condicion_tipo_entidad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DE ENTIDAD</td><td class="encabezado">&nbsp;<select name="compara_tipo_entidad" id="compara_tipo_entidad"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(317,3715,'',1);?></td></tr><tr id="tr_enfoque_diferencial"><td class="encabezado">&nbsp;<select name="condicion_enfoque_diferencial" id="condicion_enfoque_diferencial"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ENFOQUE DIFERENCIAL</td><td class="encabezado">&nbsp;<select name="compara_enfoque_diferencial" id="compara_enfoque_diferencial"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(317,3716,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ubicacion_geografica" id="condicion_ubicacion_geografica"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">UBICACI&Oacute;N GEOGR&Aacute;FICA</td><td class="encabezado">&nbsp;<select name="compara_ubicacion_geografica" id="compara_ubicacion_geografica"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(317,3717,$_REQUEST['iddoc']);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_entidad" id="condicion_nombre_entidad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE DE LA ENTIDAD</td><td class="encabezado">&nbsp;<select name="compara_nombre_entidad" id="compara_nombre_entidad"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="11"   id="nombre_entidad" name="nombre_entidad"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#nombre_entidad").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_paralelo" id="condicion_nombre_paralelo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE PARALELO</td><td class="encabezado">&nbsp;<select name="compara_nombre_paralelo" id="compara_nombre_paralelo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_paralelo" name="nombre_paralelo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_paralelo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_readh" id="condicion_descripcion_readh"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_descripcion_readh" id="compara_descripcion_readh"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_readh" name="descripcion_readh"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_readh").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_contexto_geografico" id="condicion_contexto_geografico"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONTEXTO GEOGR&Aacute;FICO Y CULTURAL</td><td class="encabezado">&nbsp;<select name="compara_contexto_geografico" id="compara_contexto_geografico"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="contexto_geografico" name="contexto_geografico"></select><script>
                     $(document).ready(function() 
                      {
                      $("#contexto_geografico").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_registro_funciones"><td class="encabezado">&nbsp;<select name="condicion_registro_funciones" id="condicion_registro_funciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">REGISTRO DE FUNCIONES</td><td class="encabezado">&nbsp;<select name="compara_registro_funciones" id="compara_registro_funciones"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(317,3722,'',1);?></td></tr><tr id="tr_estado_registro"><td class="encabezado">&nbsp;<select name="condicion_estado_registro" id="condicion_estado_registro"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ESTADO DEL REGISTRO</td><td class="encabezado">&nbsp;<select name="compara_estado_registro" id="compara_estado_registro"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(317,3723,'',1);?></td></tr><tr id="tr_palabras_clave"><td class="encabezado">&nbsp;<select name="condicion_palabras_clave" id="condicion_palabras_clave"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PALABRAS CLAVE</td><td class="encabezado">&nbsp;<select name="compara_palabras_clave" id="compara_palabras_clave"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(317,3724,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexos_digitales" id="condicion_anexos_digitales"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td><td class="encabezado">&nbsp;<select name="compara_anexos_digitales" id="compara_anexos_digitales"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexos_digitales" name="anexos_digitales"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexos_digitales").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3718"><?php submit_formato(317);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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