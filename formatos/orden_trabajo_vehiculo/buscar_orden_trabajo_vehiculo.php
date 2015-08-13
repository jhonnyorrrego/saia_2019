<html><title>.:BUSCAR ORDEN DE TRABAJO:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ORDEN DE TRABAJO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_firma_externa_cliente" id="condicion_firma_externa_cliente"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Guarda la ruta de la imagen externa del cliente">FIRMA_EXTERNA_CLIENTE</td><td class="encabezado">&nbsp;<select name="compara_firma_externa_cliente" id="compara_firma_externa_cliente"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="firma_externa_cliente" name="firma_externa_cliente"></select><script>
                     $(document).ready(function() 
                      {
                      $("#firma_externa_cliente").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_firma_externa_satisfaccion" id="condicion_firma_externa_satisfaccion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Guarda la ruta de la imagen externa del recibido a satisfaccion">FIRMA_EXTERNA_SATISFACCION</td><td class="encabezado">&nbsp;<select name="compara_firma_externa_satisfaccion" id="compara_firma_externa_satisfaccion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="firma_externa_satisfaccion" name="firma_externa_satisfaccion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#firma_externa_satisfaccion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_servicio" id="condicion_tipo_servicio"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DE SERVICIO</td><td class="encabezado">&nbsp;<select name="compara_tipo_servicio" id="compara_tipo_servicio"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(262,2988,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_orden_trabajo" id="condicion_fecha_orden_trabajo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA ORDEN (F. OT)</td><td class="encabezado">&nbsp;<select name="compara_fecha_orden_trabajo" id="compara_fecha_orden_trabajo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_orden_trabajo" name="fecha_orden_trabajo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_orden_trabajo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_solicitud_orden" id="condicion_fecha_solicitud_orden"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE SOLICITUD (F. SOL)</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_solicitud_orden_1" id="fecha_solicitud_orden_1" tipo="fecha" value=""><?php selector_fecha("fecha_solicitud_orden_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_solicitud_orden_2" id="fecha_solicitud_orden_2" tipo="fecha" value=""><?php selector_fecha("fecha_solicitud_orden_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_compromiso" id="condicion_fecha_compromiso"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA COMPROMISO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_compromiso_1" id="fecha_compromiso_1" tipo="fecha" value=""><?php selector_fecha("fecha_compromiso_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_compromiso_2" id="fecha_compromiso_2" tipo="fecha" value=""><?php selector_fecha("fecha_compromiso_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_kilometros_vehiculo" id="condicion_kilometros_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">KILOMETROS</td><td class="encabezado">&nbsp;<select name="compara_kilometros_vehiculo" id="compara_kilometros_vehiculo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="kilometros_vehiculo" name="kilometros_vehiculo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#kilometros_vehiculo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_prioridad_servicio" id="condicion_prioridad_servicio"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PRIORIDAD</td><td class="encabezado">&nbsp;<select name="compara_prioridad_servicio" id="compara_prioridad_servicio"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(262,2979,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_solicitante" id="condicion_nombre_solicitante"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SOLICITANTE</td><td class="encabezado">&nbsp;<select name="compara_nombre_solicitante" id="compara_nombre_solicitante"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="nombre_solicitante" name="nombre_solicitante"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#nombre_solicitante").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_asegurador" id="condicion_nombre_asegurador"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ASEGURADOR</td><td class="encabezado">&nbsp;<select name="compara_nombre_asegurador" id="compara_nombre_asegurador"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_asegurador" name="nombre_asegurador"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_asegurador").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_campo_servicio" id="condicion_campo_servicio"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SERVICIO</td><td class="encabezado">&nbsp;<select name="compara_campo_servicio" id="compara_campo_servicio"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="campo_servicio" name="campo_servicio"></select><script>
                     $(document).ready(function() 
                      {
                      $("#campo_servicio").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_ctto_numero" id="condicion_ctto_numero"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CTTO NUMERO</td><td class="encabezado">&nbsp;<select name="compara_ctto_numero" id="compara_ctto_numero"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="ctto_numero" name="ctto_numero"></select><script>
                     $(document).ready(function() 
                      {
                      $("#ctto_numero").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_motivo_servicio" id="condicion_motivo_servicio"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MOTIVO DEL SERVICIO</td><td class="encabezado">&nbsp;<select name="compara_motivo_servicio" id="compara_motivo_servicio"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="motivo_servicio" name="motivo_servicio"></select><script>
                     $(document).ready(function() 
                      {
                      $("#motivo_servicio").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_llamadas_requeridas" id="condicion_llamadas_requeridas"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">LLAMADAS REQUERIDAS</td><td class="encabezado">&nbsp;<select name="compara_llamadas_requeridas" id="compara_llamadas_requeridas"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="llamadas_requeridas" name="llamadas_requeridas"></select><script>
                     $(document).ready(function() 
                      {
                      $("#llamadas_requeridas").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_funcionario_recibo" id="condicion_funcionario_recibo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RECIBO</td><td class="encabezado">&nbsp;<select name="compara_funcionario_recibo" id="compara_funcionario_recibo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="funcionario_recibo" name="funcionario_recibo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#funcionario_recibo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="2977"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(262);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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