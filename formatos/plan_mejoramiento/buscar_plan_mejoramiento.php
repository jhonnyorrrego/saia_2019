<html><title>.:BUSCAR PLAN DE MEJORAMIENTO:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA PLAN DE MEJORAMIENTO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_estado_terminado" id="condicion_estado_terminado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ESTADO TEMRINADO</td><td class="encabezado">&nbsp;<select name="compara_estado_terminado" id="compara_estado_terminado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="estado_terminado" name="estado_terminado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#estado_terminado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_elaborado" id="condicion_fecha_elaborado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA DE ELABORACION</td><td class="encabezado">&nbsp;<select name="compara_fecha_elaborado" id="compara_fecha_elaborado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_elaborado" name="fecha_elaborado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_elaborado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_aprobado" id="condicion_fecha_aprobado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA_APROBADO</td><td class="encabezado">&nbsp;<select name="compara_fecha_aprobado" id="compara_fecha_aprobado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_aprobado" name="fecha_aprobado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_aprobado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_revisado" id="condicion_fecha_revisado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA DE REVISADO</td><td class="encabezado">&nbsp;<select name="compara_fecha_revisado" id="compara_fecha_revisado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_revisado" name="fecha_revisado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_revisado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_plan"><td class="encabezado">&nbsp;<select name="condicion_tipo_plan" id="condicion_tipo_plan"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DE PLAN</td><td class="encabezado">&nbsp;<select name="compara_tipo_plan" id="compara_tipo_plan"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(379,4459,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_suscripcion" id="condicion_fecha_suscripcion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA DE SUSCRIPCION</td><td class="encabezado">&nbsp;<select name="compara_fecha_suscripcion" id="compara_fecha_suscripcion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_suscripcion" name="fecha_suscripcion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_suscripcion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_adjuntos" id="condicion_adjuntos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Anexar informes auditoria">ANEXAR INFORMES AUDITORIA</td><td class="encabezado">&nbsp;<select name="compara_adjuntos" id="compara_adjuntos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="adjuntos" name="adjuntos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#adjuntos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_auditoria" id="condicion_tipo_auditoria"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Plan de Mejoramiento Institucional, Funcional o Individual">TIPO DE AUDITORIA</td><td class="encabezado">&nbsp;<select name="compara_tipo_auditoria" id="compara_tipo_auditoria"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(379,4465,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_auditor" id="condicion_auditor"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">AUDITOR</td><td class="encabezado">&nbsp;<select name="compara_auditor" id="compara_auditor"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(379,4466,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_otros" id="condicion_descripcion_otros"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N AUDITOR OTROS/AUTOEVALUACI&Oacute;N/RETROALIMENTACI&Oacute;N CLIENTE.</td><td class="encabezado">&nbsp;<select name="compara_descripcion_otros" id="compara_descripcion_otros"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_otros" name="descripcion_otros"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_otros").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_plan" id="condicion_descripcion_plan"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Realizar una breve descripci&oacute;n del alcance de la Auditor&iacute;a o l&iacute;nea de auditor&iacute;a realizada">DESCRIPCION</td><td class="encabezado">&nbsp;<select name="compara_descripcion_plan" id="compara_descripcion_plan"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_plan" name="descripcion_plan"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_plan").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_estado_plan_mejoramiento" id="condicion_estado_plan_mejoramiento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ESTADO DEL PLAN DE MEJORAMIENTO</td><td class="encabezado">&nbsp;<select name="compara_estado_plan_mejoramiento" id="compara_estado_plan_mejoramiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="estado_plan_mejoramiento" name="estado_plan_mejoramiento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#estado_plan_mejoramiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_estado"><td class="encabezado">&nbsp;<select name="condicion_estado" id="condicion_estado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Estado Actual del Proceso :
ELABORACION,REVISION,APROBACION,DISTRIBUCION,INACTIVO ">ESTADO</td><td class="encabezado">&nbsp;<select name="compara_estado" id="compara_estado"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(379,4470,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_periodo_evaluado" id="condicion_periodo_evaluado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Periodo que cubri&oacute; la auditor&iacute;a">PERIODO EVALUADO</td><td class="encabezado">&nbsp;<select name="compara_periodo_evaluado" id="compara_periodo_evaluado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="periodo_evaluado" name="periodo_evaluado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#periodo_evaluado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_objetivo" id="condicion_objetivo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBJETIVO GENERAL</td><td class="encabezado">&nbsp;<select name="compara_objetivo" id="compara_objetivo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="objetivo" name="objetivo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#objetivo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_objetivos_especificos" id="condicion_objetivos_especificos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBJETIVOS ESPECIFICOS</td><td class="encabezado">&nbsp;<select name="compara_objetivos_especificos" id="compara_objetivos_especificos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="objetivos_especificos" name="objetivos_especificos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#objetivos_especificos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="4462,4468"><?php submit_formato(379);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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