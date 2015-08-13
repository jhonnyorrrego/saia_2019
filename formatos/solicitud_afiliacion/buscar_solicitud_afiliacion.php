<html><title>.:BUSCAR SOLICITUD DE AFILIACI&OACUTE;N:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA SOLICITUD DE AFILIACI&Oacute;N</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_solicitud" id="condicion_fecha_solicitud"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE SOLICITUD</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_solicitud_1" id="fecha_solicitud_1" tipo="fecha" value=""><?php selector_fecha("fecha_solicitud_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_solicitud_2" id="fecha_solicitud_2" tipo="fecha" value=""><?php selector_fecha("fecha_solicitud_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_datos_solicitante" id="condicion_datos_solicitante"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DATOS DEL SOLICITANTE DE AFILIACI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_datos_solicitante" id="compara_datos_solicitante"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="datos_solicitante" name="datos_solicitante"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#datos_solicitante").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_numero_folios_afilia" id="condicion_numero_folios_afilia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FOLIOS</td><td class="encabezado">&nbsp;<select name="compara_numero_folios_afilia" id="compara_numero_folios_afilia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_folios_afilia" name="numero_folios_afilia"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_folios_afilia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_adjuntar_documento" id="condicion_adjuntar_documento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ADJUNTAR</td><td class="encabezado">&nbsp;<select name="compara_adjuntar_documento" id="compara_adjuntar_documento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="adjuntar_documento" name="adjuntar_documento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#adjuntar_documento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3107"><?php submit_formato(271);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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