<html><title>.:BUSCAR PETICIONES QUEJAS RECLAMOS SOLICITUDES FELICITACIONES:.</title><head><?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_jquery('1.7')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script>
			<script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script>
			<link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/>
			</head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA PETICIONES QUEJAS RECLAMOS SOLICITUDES FELICITACIONES</td></tr><tr id="tr_remitente_origen"><td class="encabezado">&nbsp;<select name="condicion_remitente_origen" id="condicion_remitente_origen"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">REMITENTE_ORIGEN</td><td class="encabezado">&nbsp;<select name="compara_remitente_origen" id="compara_remitente_origen"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="remitente_origen" name="remitente_origen"></select><script>
                     $(document).ready(function()
                      {
                      $("#remitente_origen").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_nombre"><td class="encabezado">&nbsp;<select name="condicion_nombre" id="condicion_nombre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE COMPLETOS</td><td class="encabezado">&nbsp;<select name="compara_nombre" id="compara_nombre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre" name="nombre"></select><script>
                     $(document).ready(function()
                      {
                      $("#nombre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_documento"><td class="encabezado">&nbsp;<select name="condicion_documento" id="condicion_documento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DOCUMENTO</td><td class="encabezado">&nbsp;<select name="compara_documento" id="compara_documento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="documento" name="documento"></select><script>
                     $(document).ready(function()
                      {
                      $("#documento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_email"><td class="encabezado">&nbsp;<select name="condicion_email" id="condicion_email"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">EMAIL</td><td class="encabezado">&nbsp;<select name="compara_email" id="compara_email"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="email" name="email"></select><script>
                     $(document).ready(function()
                      {
                      $("#email").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_telefono"><td class="encabezado">&nbsp;<select name="condicion_telefono" id="condicion_telefono"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TELEFONO O CELULAR</td><td class="encabezado">&nbsp;<select name="compara_telefono" id="compara_telefono"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="telefono" name="telefono"></select><script>
                     $(document).ready(function()
                      {
                      $("#telefono").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_rol_institucion" id="condicion_rol_institucion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ROL EN LA INSTITUCION</td><td class="encabezado">&nbsp;<select name="compara_rol_institucion" id="compara_rol_institucion"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(305,3573,'',1);?></td></tr><tr id="tr_tipo"><td class="encabezado">&nbsp;<select name="condicion_tipo" id="condicion_tipo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO COMENTARIO</td><td class="encabezado">&nbsp;<select name="compara_tipo" id="compara_tipo"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(305,3575,'',1);?></td></tr><tr id="tr_comentarios"><td class="encabezado">&nbsp;<select name="condicion_comentarios" id="condicion_comentarios"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">COMENTARIOS</td><td class="encabezado">&nbsp;<select name="compara_comentarios" id="compara_comentarios"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="comentarios" name="comentarios"></select><script>
                     $(document).ready(function()
                      {
                      $("#comentarios").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexos"><td class="encabezado">&nbsp;<select name="condicion_anexos" id="condicion_anexos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DOCUMENTO SOPORTE COMENTARIO</td><td class="encabezado">&nbsp;<select name="compara_anexos" id="compara_anexos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexos" name="anexos"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_fecha_reporte"><td class="encabezado">&nbsp;<select name="condicion_fecha_reporte" id="condicion_fecha_reporte"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA REPORTE</td><td class="encabezado">&nbsp;<select name="compara_fecha_reporte" id="compara_fecha_reporte"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_reporte" name="fecha_reporte"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_reporte").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_funcionario_reporte"><td class="encabezado">&nbsp;<select name="condicion_funcionario_reporte" id="condicion_funcionario_reporte"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FUNCIONARIO REPORTE</td><td class="encabezado">&nbsp;<select name="compara_funcionario_reporte" id="compara_funcionario_reporte"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="funcionario_reporte" name="funcionario_reporte"></select><script>
                     $(document).ready(function()
                      {
                      $("#funcionario_reporte").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3564,3567,3572,3573,3575"><?php submit_formato(305);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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