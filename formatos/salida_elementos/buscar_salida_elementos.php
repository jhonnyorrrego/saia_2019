<html><title>.:BUSCAR SALIDA DE ELEMENTOS:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA SALIDA DE ELEMENTOS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_adicionar_item" id="condicion_adicionar_item"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ADICIONAR ELEMENTO</td><td class="encabezado">&nbsp;<select name="compara_adicionar_item" id="compara_adicionar_item"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="adicionar_item" name="adicionar_item"></select><script>
                     $(document).ready(function() 
                      {
                      $("#adicionar_item").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_solicitud" id="condicion_fecha_solicitud"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="Fecha de solicitud de la salida de elementos.">FECHA DE SOLICITUD</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_solicitud_1" id="fecha_solicitud_1" tipo="fecha" value=""><?php selector_fecha("fecha_solicitud_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_solicitud_2" id="fecha_solicitud_2" tipo="fecha" value=""><?php selector_fecha("fecha_solicitud_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_solicitante" id="condicion_solicitante"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Nombre del solicitante del servicio">NOMBRE DE SOLICITANTE</td><td class="encabezado">&nbsp;<select name="compara_solicitante" id="compara_solicitante"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="solicitante" name="solicitante"></select><script>
                     $(document).ready(function() 
                      {
                      $("#solicitante").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_salida" id="condicion_descripcion_salida"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Describa brevemente la solicitud.">DESCRIPCI&Oacute;N DE LA SALIDA</td><td class="encabezado">&nbsp;<select name="compara_descripcion_salida" id="compara_descripcion_salida"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_salida" name="descripcion_salida"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_salida").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_salida" id="condicion_fecha_salida"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="Seleccione la fecha de la solicitud.">FECHA DE SALIDA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_salida_1" id="fecha_salida_1" tipo="fecha" value=""><?php selector_fecha("fecha_salida_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_salida_2" id="fecha_salida_2" tipo="fecha" value=""><?php selector_fecha("fecha_salida_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><input type="hidden" name="campo_descripcion" value="3804"><?php submit_formato(325);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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