<html><title>.:BUSCAR BASES DE CALIDAD:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script>
			<link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/>
			</head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA BASES DE CALIDAD</td></tr><tr id="tr_tipo_base_calidad"><td class="encabezado">&nbsp;<select name="condicion_tipo_base_calidad" id="condicion_tipo_base_calidad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO</td><td class="encabezado">&nbsp;<select name="compara_tipo_base_calidad" id="compara_tipo_base_calidad"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(479,6050,'',1);?></td></tr><tr id="tr_version_base_calidad"><td class="encabezado">&nbsp;<select name="condicion_version_base_calidad" id="condicion_version_base_calidad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VERSI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_version_base_calidad" id="compara_version_base_calidad"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="version_base_calidad" name="version_base_calidad"></select><script>
                     $(document).ready(function()
                      {
                      $("#version_base_calidad").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_descripcion_base"><td class="encabezado">&nbsp;<select name="condicion_descripcion_base" id="condicion_descripcion_base"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_descripcion_base" id="compara_descripcion_base"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_base" name="descripcion_base"></select><script>
                     $(document).ready(function()
                      {
                      $("#descripcion_base").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexo_soporte"><td class="encabezado">&nbsp;<select name="condicion_anexo_soporte" id="condicion_anexo_soporte"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MAPA DE PROCESO</td><td class="encabezado">&nbsp;<select name="compara_anexo_soporte" id="compara_anexo_soporte"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexo_soporte" name="anexo_soporte"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexo_soporte").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="6050"><?php submit_formato(479);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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