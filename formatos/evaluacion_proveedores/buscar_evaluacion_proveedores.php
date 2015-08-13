<html><title>.:BUSCAR 3. EVALUACI&OACUTE;N DE PROVEEDORES:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 3. EVALUACI&Oacute;N DE PROVEEDORES</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ft_recepcion_cotizacion" id="condicion_ft_recepcion_cotizacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PROVEEDOR</td><td class="encabezado">&nbsp;<select name="compara_ft_recepcion_cotizacion" id="compara_ft_recepcion_cotizacion"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(299,3499,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_precio_cotizaciones" id="condicion_precio_cotizaciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PRECIO DE LAS COTIZACIONES</td><td class="encabezado">&nbsp;<select name="compara_precio_cotizaciones" id="compara_precio_cotizaciones"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(299,3493,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_matriculado_camara" id="condicion_matriculado_camara"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MATRICULADO</td><td class="encabezado">&nbsp;<select name="compara_matriculado_camara" id="compara_matriculado_camara"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(299,3492,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_atencion" id="condicion_atencion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">LA ATENCI&Oacute;N A LA SOLICITUD FUE</td><td class="encabezado">&nbsp;<select name="compara_atencion" id="compara_atencion"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(299,3489,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_cumplimiento" id="condicion_cumplimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CUMPLIMIENTO CON LAS ESPECIFICACIONES DEL PRODUCTO REQUERIDO</td><td class="encabezado">&nbsp;<select name="compara_cumplimiento" id="compara_cumplimiento"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(299,3490,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_almacenada" id="condicion_descripcion_almacenada"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_descripcion_almacenada" id="compara_descripcion_almacenada"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_almacenada" name="descripcion_almacenada"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_almacenada").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3491"><?php submit_formato(299);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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