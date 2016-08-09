<html><title>.:BUSCAR RIESGOS:.</title><head><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA RIESGOS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_riesgo_antiguo" id="condicion_riesgo_antiguo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="1: Riesgo o documento antiguo
2: Riesgo o documento nuevo">RIESGO ANTIGUO</td><td class="encabezado">&nbsp;<select name="compara_riesgo_antiguo" id="compara_riesgo_antiguo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="riesgo_antiguo" name="riesgo_antiguo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#riesgo_antiguo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">IDENTIFICACION DEL RIESGO</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="identificacion_riesgo" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_riesgo" id="condicion_fecha_riesgo"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_riesgo_1" id="fecha_riesgo_1" tipo="fecha" value=""><?php selector_fecha("fecha_riesgo_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_riesgo_2" id="fecha_riesgo_2" tipo="fecha" value=""><?php selector_fecha("fecha_riesgo_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_consecutivo" id="condicion_consecutivo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO</td><td class="encabezado">&nbsp;<select name="compara_consecutivo" id="compara_consecutivo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="consecutivo" name="consecutivo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#consecutivo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_riesgo" id="condicion_riesgo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RIESGO</td><td class="encabezado">&nbsp;<select name="compara_riesgo" id="compara_riesgo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="riesgo" name="riesgo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#riesgo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_riesgo" id="condicion_tipo_riesgo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DE RIESGO</td><td class="encabezado">&nbsp;<select name="compara_tipo_riesgo" id="compara_tipo_riesgo"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(13,2703,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_opciones_manejo" id="condicion_opciones_manejo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OPCIONES DE MANEJO</td><td class="encabezado">&nbsp;<select name="compara_opciones_manejo" id="compara_opciones_manejo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="opciones_manejo" name="opciones_manejo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#opciones_manejo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_acciones" id="condicion_acciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ACCIONES</td><td class="encabezado">&nbsp;<select name="compara_acciones" id="compara_acciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="acciones" name="acciones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#acciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">ANALISIS DE RIESGO</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="analisis_riego" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_responsables" id="condicion_responsables"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RESPONSABLES</td><td class="encabezado">&nbsp;<select name="compara_responsables" id="compara_responsables"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="responsables" name="responsables"></select><script>
                     $(document).ready(function() 
                      {
                      $("#responsables").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_indicador" id="condicion_indicador"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">INDICADOR</td><td class="encabezado">&nbsp;<select name="compara_indicador" id="compara_indicador"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="indicador" name="indicador"></select><script>
                     $(document).ready(function() 
                      {
                      $("#indicador").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_cronograma" id="condicion_cronograma"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CRONOGRAMA</td><td class="encabezado">&nbsp;<select name="compara_cronograma" id="compara_cronograma"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cronograma" name="cronograma"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cronograma").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="2704"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(13);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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