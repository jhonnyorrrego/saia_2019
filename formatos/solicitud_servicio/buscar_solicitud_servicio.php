<html><title>.:BUSCAR SOLICITUD DE SERVICIO:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA SOLICITUD DE SERVICIO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_hora_solicitud" id="condicion_fecha_hora_solicitud"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA Y HORA DE SOLICITUD</td><td class="encabezado">&nbsp;<select name="compara_fecha_hora_solicitud" id="compara_fecha_hora_solicitud"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_hora_solicitud" name="fecha_hora_solicitud"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_hora_solicitud").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_asunto_solicitud" id="condicion_asunto_solicitud"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ASUNTO</td><td class="encabezado">&nbsp;<select name="compara_asunto_solicitud" id="compara_asunto_solicitud"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="asunto_solicitud" name="asunto_solicitud"></select><script>
                     $(document).ready(function() 
                      {
                      $("#asunto_solicitud").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_ciudad_origen" id="condicion_ciudad_origen"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CIUDAD DE ORIGEN</td><td class="encabezado">&nbsp;<select name="compara_ciudad_origen" id="compara_ciudad_origen"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3034,$_REQUEST['iddoc']);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fk_idsolicitud_afiliacion" id="condicion_fk_idsolicitud_afiliacion"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">SELECCIONE EL DOCUMENTO</td><td class="encabezado">&nbsp;<select name="compara_fk_idsolicitud_afiliacion" id="compara_fk_idsolicitud_afiliacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3116,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_solicitud_servi" id="condicion_tipo_solicitud_servi"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DE SOLICITUD</td><td class="encabezado">&nbsp;<select name="compara_tipo_solicitud_servi" id="compara_tipo_solicitud_servi"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3035,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_mercancia" id="condicion_tipo_mercancia"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">TIPO DE MERCANCIA</td><td class="encabezado">&nbsp;<select name="compara_tipo_mercancia" id="compara_tipo_mercancia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3036,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_referencia_caja" id="condicion_referencia_caja"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">REFERENCIA DE CAJA</td><td class="encabezado">&nbsp;<select name="compara_referencia_caja" id="compara_referencia_caja"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3105,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_cantidad_mercancia" id="condicion_cantidad_mercancia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CANTIDAD (UNIDADES)</td><td class="encabezado">&nbsp;<select name="compara_cantidad_mercancia" id="compara_cantidad_mercancia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cantidad_mercancia" name="cantidad_mercancia"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cantidad_mercancia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_privilegios" id="condicion_tipo_privilegios"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DE PRIVILEGIOS</td><td class="encabezado">&nbsp;<select name="compara_tipo_privilegios" id="compara_tipo_privilegios"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3037,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_envio_solicitud" id="condicion_tipo_envio_solicitud"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DE ENV&Iacute;O</td><td class="encabezado">&nbsp;<select name="compara_tipo_envio_solicitud" id="compara_tipo_envio_solicitud"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3038,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor_declarado" id="condicion_valor_declarado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR DECLARADO</td><td class="encabezado">&nbsp;<select name="compara_valor_declarado" id="compara_valor_declarado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor_declarado" name="valor_declarado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor_declarado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_peso_envio_solicitud" id="condicion_peso_envio_solicitud"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PESO (KILOS)</td><td class="encabezado">&nbsp;<select name="compara_peso_envio_solicitud" id="compara_peso_envio_solicitud"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="peso_envio_solicitud" name="peso_envio_solicitud"></select><script>
                     $(document).ready(function() 
                      {
                      $("#peso_envio_solicitud").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tamanio_aproximado" id="condicion_tamanio_aproximado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TAMA&Ntilde;O APROXIMADO</td><td class="encabezado">&nbsp;<select name="compara_tamanio_aproximado" id="compara_tamanio_aproximado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="tamanio_aproximado" name="tamanio_aproximado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#tamanio_aproximado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_requiere_recoleccion" id="condicion_requiere_recoleccion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">REQUIERE RECOLECCI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_requiere_recoleccion" id="compara_requiere_recoleccion"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(267,3042,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_direccion_recoleccion" id="condicion_direccion_recoleccion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DIRECCI&Oacute;N DE RECOLECCI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_direccion_recoleccion" id="compara_direccion_recoleccion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="direccion_recoleccion" name="direccion_recoleccion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#direccion_recoleccion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_recoleccion" id="condicion_fecha_recoleccion"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE RECOLECCI&Oacute;N</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_recoleccion_1" id="fecha_recoleccion_1" tipo="fecha" value=""><?php selector_fecha("fecha_recoleccion_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_recoleccion_2" id="fecha_recoleccion_2" tipo="fecha" value=""><?php selector_fecha("fecha_recoleccion_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_observacion_solicitud" id="condicion_observacion_solicitud"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td><td class="encabezado">&nbsp;<select name="compara_observacion_solicitud" id="compara_observacion_solicitud"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observacion_solicitud" name="observacion_solicitud"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observacion_solicitud").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexos_digitales" id="condicion_anexos_digitales"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><input type="hidden" name="campo_descripcion" value="3065"><?php submit_formato(267);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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