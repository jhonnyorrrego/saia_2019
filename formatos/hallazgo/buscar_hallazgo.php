<html><title>.:BUSCAR HALLAZGO PLAN DE MEJORAMIENTO:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script>
			<link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/>
			</head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA HALLAZGO PLAN DE MEJORAMIENTO</td></tr><tr id="tr_ft_gestion_calid"><td class="encabezado">&nbsp;<select name="condicion_ft_gestion_calid" id="condicion_ft_gestion_calid"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">GESTION CALIDAD</td><td class="encabezado">&nbsp;<select name="compara_ft_gestion_calid" id="compara_ft_gestion_calid"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="ft_gestion_calid" name="ft_gestion_calid"></select><script>
                     $(document).ready(function()
                      {
                      $("#ft_gestion_calid").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_clase_accion" id="condicion_clase_accion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CLASE ACCION</td><td class="encabezado">&nbsp;<select name="compara_clase_accion" id="compara_clase_accion"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(481,6094,'',1);?></td></tr><tr id="tr_radicado_plan"><td class="encabezado">&nbsp;<select name="condicion_radicado_plan" id="condicion_radicado_plan"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RADICADO DEL PLAN VINCULADO</td><td class="encabezado">&nbsp;<select name="compara_radicado_plan" id="compara_radicado_plan"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="radicado_plan" name="radicado_plan"></select><script>
                     $(document).ready(function()
                      {
                      $("#radicado_plan").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_consecutivo_hallazgo"><td class="encabezado">&nbsp;<select name="condicion_consecutivo_hallazgo" id="condicion_consecutivo_hallazgo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONSECUTIVO</td><td class="encabezado">&nbsp;<select name="compara_consecutivo_hallazgo" id="compara_consecutivo_hallazgo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="consecutivo_hallazgo" name="consecutivo_hallazgo"></select><script>
                     $(document).ready(function()
                      {
                      $("#consecutivo_hallazgo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_correcion_hallazgo"><td class="encabezado">&nbsp;<select name="condicion_correcion_hallazgo" id="condicion_correcion_hallazgo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CORRECCI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_correcion_hallazgo" id="compara_correcion_hallazgo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="correcion_hallazgo" name="correcion_hallazgo"></select><script>
                     $(document).ready(function()
                      {
                      $("#correcion_hallazgo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="6095,6096,6099"><?php submit_formato(481);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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