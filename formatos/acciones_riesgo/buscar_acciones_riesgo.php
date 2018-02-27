<html><title>.:BUSCAR 2. ACCIONES:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 2. ACCIONES</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_acciones_accion" id="condicion_acciones_accion"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_acciones_control" id="condicion_acciones_control"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Control:

Si va a establecer una Acci&oacute;n sobre un control existente por favor seleccionelo de la lista desplegable. Si se requiere un Nuevo Control, favor seleccione esta opci&oacute;n.">CONTROL</td><td class="encabezado">&nbsp;<select name="compara_acciones_control" id="compara_acciones_control"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(275,3142,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_accion" id="condicion_fecha_accion"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE SUSCRIPCION DE LA ACCION</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_accion_1" id="fecha_accion_1" tipo="fecha" value=""><?php selector_fecha("fecha_accion_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_accion_2" id="fecha_accion_2" tipo="fecha" value=""><?php selector_fecha("fecha_accion_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_cumplimiento" id="condicion_fecha_cumplimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE CUMPLIMIENTO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_cumplimiento_1" id="fecha_cumplimiento_1" tipo="fecha" value=""><?php selector_fecha("fecha_cumplimiento_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_cumplimiento_2" id="fecha_cumplimiento_2" tipo="fecha" value=""><?php selector_fecha("fecha_cumplimiento_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_indicador" id="condicion_indicador"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Indicador:

Resultados obtenidos en la medici&oacute;n del indicador, para evaluar el cumplimiento de las acciones de control.">INDICADOR</td><td class="encabezado">&nbsp;<select name="compara_indicador" id="compara_indicador"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="indicador" name="indicador"></select><script>
                     $(document).ready(function() 
                      {
                      $("#indicador").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_opcio_admin_riesgo" id="condicion_opcio_admin_riesgo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Evitar el riesgo, tomar las medidas encaminadas a prevenir su materializaci&oacute;n.
Es siempre la primera alternativa a considerar, se logra cuando al interior de los procesos se generan cambios sustanciales por mejoramiento, redise&ntilde;o o eliminaci&oacute;n, resultado de unos adecuados controles y acciones emprendidas.

Por ejemplo: el control de calidad, manejo de los insumos, mantenimiento preventivo de los equipos, desarrollo tecnol&oacute;gico, etc.

Reducir el riesgo, implica tomar medidas encaminadas a disminuir tanto la probabilidad (medidas de prevenci&oacute;n), como el impacto (medidas de protecci&oacute;n). La reducci&oacute;n del riesgo es probablemente el m&eacute;todo m&aacute;s sencillo y econ&oacute;mico para superar las debilidades antes de aplicar medidas m&aacute;s costosas y dif&iacute;ciles. Por ejemplo: a trav&eacute;s de la optimizaci&oacute;n de los procedimientos y la implementaci&oacute;n de controles.
 
Compartir o transferir el riesgo, reduce su efecto a trav&eacute;s del traspaso de las p&eacute;rdidas a otras organizaciones, como en el caso de los contratos de seguros o a trav&eacute;s de otros medios que permiten distribuir una porci&oacute;n del riesgo con otra entidad, como en los contratos a riesgo compartido. Por ejemplo, la informaci&oacute;n de gran importancia se puede duplicar y almacenar en un lugar distante y de ubicaci&oacute;n segura, en vez de dejarla concentrada en un solo lugar, la tercerizaci&oacute;n.
 
Asumir un riesgo, luego de que el riesgo ha sido reducido o transferido puede quedar un riesgo residual que se mantiene, en este caso, el gerente del proceso simplemente acepta la p&eacute;rdida residual probable y elabora planes de contingencia para su manejo.
   Dicha selecci&oacute;n implica equilibrar los costos y los esfuerzos para su      implementaci&oacute;n, as&iacute; como los beneficios finales, por lo tanto, se          deber&aacute; considerar los siguientes aspectos como:

   * Viabilidad jur&iacute;dica.
   * Viabilidad t&eacute;cnica.
   * Viabilidad institucional.
   * Viabilidad financiera o econ&oacute;mica.
   * An&aacute;lisis de costo-beneficio.">OPCIONES ADMINISTRACION DEL RIESGO</td><td class="encabezado">&nbsp;<select name="compara_opcio_admin_riesgo" id="compara_opcio_admin_riesgo"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(275,3146,'',1);?></td></tr><input type="hidden" name="campo_descripcion" value="3141"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(275);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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