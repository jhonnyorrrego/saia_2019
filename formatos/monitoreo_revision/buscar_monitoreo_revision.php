<html><title>.:BUSCAR 3. MONITOREO Y REVISION:.</title><head><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 3. MONITOREO Y REVISION</td></tr><tr>
                   <td class="encabezado" width="20%" title="">AYUDA</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="ayuda" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_monitoreo" id="condicion_fecha_monitoreo"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_monitoreo_1" id="fecha_monitoreo_1" tipo="fecha" value=""><?php selector_fecha("fecha_monitoreo_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_monitoreo_2" id="fecha_monitoreo_2" tipo="fecha" value=""><?php selector_fecha("fecha_monitoreo_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_numero_riesgo" id="condicion_numero_riesgo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RIESGO NRO</td><td class="encabezado">&nbsp;<select name="compara_numero_riesgo" id="compara_numero_riesgo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_riesgo" name="numero_riesgo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_riesgo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_riesgo" id="condicion_nombre_riesgo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE DEL RIESGO</td><td class="encabezado">&nbsp;<select name="compara_nombre_riesgo" id="compara_nombre_riesgo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_riesgo" name="nombre_riesgo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_riesgo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_cambio_identificacion"><td class="encabezado">&nbsp;<select name="condicion_cambio_identificacion" id="condicion_cambio_identificacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SE REALIZARON CAMBIOS EN LA IDENTIFICACION DEL RIESGO?</td><td class="encabezado">&nbsp;<select name="compara_cambio_identificacion" id="compara_cambio_identificacion"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(396,4745,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_cambio" id="condicion_descripcion_cambio"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCION DE LOS CAMBIOS</td><td class="encabezado">&nbsp;<select name="compara_descripcion_cambio" id="compara_descripcion_cambio"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_cambio" name="descripcion_cambio"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_cambio").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_cambios_analisis"><td class="encabezado">&nbsp;<select name="condicion_cambios_analisis" id="condicion_cambios_analisis"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SE REALIZARON CAMBIOS EN EL AN&Aacute;LISIS DEL RIESGO?</td><td class="encabezado">&nbsp;<select name="compara_cambios_analisis" id="compara_cambios_analisis"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(396,4747,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_analisis" id="condicion_descripcion_analisis"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DE LOS CAMBIOS</td><td class="encabezado">&nbsp;<select name="compara_descripcion_analisis" id="compara_descripcion_analisis"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_analisis" name="descripcion_analisis"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_analisis").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_controles_existentes" id="condicion_controles_existentes"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SE EVALUARON LOS CONTROLES EXISTENTES?</td><td class="encabezado">&nbsp;<select name="compara_controles_existentes" id="compara_controles_existentes"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="controles_existentes" name="controles_existentes"></select><script>
                     $(document).ready(function() 
                      {
                      $("#controles_existentes").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_resultado_evaluacion" id="condicion_resultado_evaluacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RESULTADOS DE LA EVALUACI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_resultado_evaluacion" id="compara_resultado_evaluacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="resultado_evaluacion" name="resultado_evaluacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#resultado_evaluacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_acciones_propuestas" id="condicion_acciones_propuestas"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SE CUMPLIERON LAS ACCIONES PROPUESTAS?</td><td class="encabezado">&nbsp;<select name="compara_acciones_propuestas" id="compara_acciones_propuestas"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="acciones_propuestas" name="acciones_propuestas"></select><script>
                     $(document).ready(function() 
                      {
                      $("#acciones_propuestas").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_logros_alcanzados" id="condicion_logros_alcanzados"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">LOGROS ALCANZADOS Y/O OBSERVACIONES</td><td class="encabezado">&nbsp;<select name="compara_logros_alcanzados" id="compara_logros_alcanzados"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="logros_alcanzados" name="logros_alcanzados"></select><script>
                     $(document).ready(function() 
                      {
                      $("#logros_alcanzados").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_controles_nuevos"><td class="encabezado">&nbsp;<select name="condicion_controles_nuevos" id="condicion_controles_nuevos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SE IMPLEMENTARON NUEVOS CONTROLES?</td><td class="encabezado">&nbsp;<select name="compara_controles_nuevos" id="compara_controles_nuevos"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(396,4753,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_ncontrol" id="condicion_descripcion_ncontrol"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DEL NUEVO(S) CONTROL(ES)</td><td class="encabezado">&nbsp;<select name="compara_descripcion_ncontrol" id="compara_descripcion_ncontrol"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_ncontrol" name="descripcion_ncontrol"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_ncontrol").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_evidencias_adjuntas" id="condicion_evidencias_adjuntas"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ADJUNTAR EVIDENCIA(S) DOCUMENTAL</td><td class="encabezado">&nbsp;<select name="compara_evidencias_adjuntas" id="compara_evidencias_adjuntas"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="evidencias_adjuntas" name="evidencias_adjuntas"></select><script>
                     $(document).ready(function() 
                      {
                      $("#evidencias_adjuntas").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_observaciones_generales" id="condicion_observaciones_generales"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES GENERALES</td><td class="encabezado">&nbsp;<select name="compara_observaciones_generales" id="compara_observaciones_generales"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones_generales" name="observaciones_generales"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observaciones_generales").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="4742"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(396);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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