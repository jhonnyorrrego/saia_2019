<html><title>.:BUSCAR 2. ACCIONES:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 2. ACCIONES</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_acciones_control" id="condicion_acciones_control"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONTROL</td><td class="encabezado">&nbsp;<select name="compara_acciones_control" id="compara_acciones_control"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(395,4727,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_acciones_accion" id="condicion_acciones_accion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ACCION</td><td class="encabezado">&nbsp;<select name="compara_acciones_accion" id="compara_acciones_accion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="acciones_accion" name="acciones_accion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#acciones_accion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_opcio_admin_riesgo"><td class="encabezado">&nbsp;<select name="condicion_opcio_admin_riesgo" id="condicion_opcio_admin_riesgo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OPCIONES ADMINISTRACI&Oacute;N DEL RIESGO</td><td class="encabezado">&nbsp;<select name="compara_opcio_admin_riesgo" id="compara_opcio_admin_riesgo"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(395,4730,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_indicador" id="condicion_indicador"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_accion" id="condicion_fecha_accion"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE SUSCRIPCI&Oacute;N DE LA ACCI&Oacute;N</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_accion_1" id="fecha_accion_1" tipo="fecha" value=""><?php selector_fecha("fecha_accion_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_accion_2" id="fecha_accion_2" tipo="fecha" value=""><?php selector_fecha("fecha_accion_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_cumplimiento" id="condicion_fecha_cumplimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE CUMPLIMIENTO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_cumplimiento_1" id="fecha_cumplimiento_1" tipo="fecha" value=""><?php selector_fecha("fecha_cumplimiento_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_cumplimiento_2" id="fecha_cumplimiento_2" tipo="fecha" value=""><?php selector_fecha("fecha_cumplimiento_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><input type="hidden" name="campo_descripcion" value="4729"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(395);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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