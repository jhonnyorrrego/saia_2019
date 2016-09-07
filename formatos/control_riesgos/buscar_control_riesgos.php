<html><title>.:BUSCAR 1. VALORACION CONTROLES RIESGOS:.</title><head><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 1. VALORACION CONTROLES RIESGOS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_consecutivo_control" id="condicion_consecutivo_control"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONSECUTIVO</td><td class="encabezado">&nbsp;<select name="compara_consecutivo_control" id="compara_consecutivo_control"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="consecutivo_control" name="consecutivo_control"></select><script>
                     $(document).ready(function() 
                      {
                      $("#consecutivo_control").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_valoracion" id="condicion_fecha_valoracion"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA VALORACION</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_valoracion_1" id="fecha_valoracion_1" tipo="fecha" value=""><?php selector_fecha("fecha_valoracion_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_valoracion_2" id="fecha_valoracion_2" tipo="fecha" value=""><?php selector_fecha("fecha_valoracion_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_control" id="condicion_descripcion_control"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DEL CONTROL EXISTENTE</td><td class="encabezado">&nbsp;<select name="compara_descripcion_control" id="compara_descripcion_control"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_control" name="descripcion_control"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_control").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_control"><td class="encabezado">&nbsp;<select name="condicion_tipo_control" id="condicion_tipo_control"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">EL CONTROL AFECTA?</td><td class="encabezado">&nbsp;<select name="compara_tipo_control" id="compara_tipo_control"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(394,4711,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_desplazamiento" id="condicion_desplazamiento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESPLAZAMIENTO EN LA MATRIZ</td><td class="encabezado">&nbsp;<select name="compara_desplazamiento" id="compara_desplazamiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="desplazamiento" name="desplazamiento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#desplazamiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">HERRAMIENTAS PARA EJERCER EL CONTROL</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="herramientas_ejercer_control" value=""></td>
                  </tr><tr id="tr_herramienta_ejercer"><td class="encabezado">&nbsp;<select name="condicion_herramienta_ejercer" id="condicion_herramienta_ejercer"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">1. POSEE UNA HERRAMIENTA PARA EJERCER EL CONTROL?</td><td class="encabezado">&nbsp;<select name="compara_herramienta_ejercer" id="compara_herramienta_ejercer"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(394,4716,'',1);?></td></tr><tr id="tr_procedimiento_herramienta"><td class="encabezado">&nbsp;<select name="condicion_procedimiento_herramienta" id="condicion_procedimiento_herramienta"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">2. EXISTEN MANUALES, INSTRUCTIVOS O PROCEDIMIENTOS PARA EL MANEJO DE LA HERRAMIENTA?</td><td class="encabezado">&nbsp;<select name="compara_procedimiento_herramienta" id="compara_procedimiento_herramienta"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(394,4717,'',1);?></td></tr><tr id="tr_herramienta_efectiva"><td class="encabezado">&nbsp;<select name="condicion_herramienta_efectiva" id="condicion_herramienta_efectiva"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">3. EN EL TIEMPO QUE LLEVA LA HERRAMIENTA, HA DEMOSTRADO SER EFECTIVA?</td><td class="encabezado">&nbsp;<select name="compara_herramienta_efectiva" id="compara_herramienta_efectiva"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(394,4718,'',1);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">SEGUIMIENTO AL CONTROL</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="seguimiento_al_control" value=""></td>
                  </tr><tr id="tr_responsables_ejecucion"><td class="encabezado">&nbsp;<select name="condicion_responsables_ejecucion" id="condicion_responsables_ejecucion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">4. ESTAN DEFINIDOS LOS RESPONSABLES DE LA EJECUCI&Oacute;N DEL CONTROL Y DEL SEGUIMIENTO?</td><td class="encabezado">&nbsp;<select name="compara_responsables_ejecucion" id="compara_responsables_ejecucion"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(394,4720,'',1);?></td></tr><tr id="tr_frecuencia_ejecucion"><td class="encabezado">&nbsp;<select name="condicion_frecuencia_ejecucion" id="condicion_frecuencia_ejecucion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">5. LA FRECUENCIA DE LA EJECUCI&Oacute;N DEL CONTROL Y SEGUIMIENTO ES ADECUADO?</td><td class="encabezado">&nbsp;<select name="compara_frecuencia_ejecucion" id="compara_frecuencia_ejecucion"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(394,4721,'',1);?></td></tr><input type="hidden" name="campo_descripcion" value="4710"><?php submit_formato(394);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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