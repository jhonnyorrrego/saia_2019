<html><title>.:BUSCAR ENTREGA INTERNA:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script>
			<link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/>
			</head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ENTREGA INTERNA</td></tr><tr id="tr_tipo_mensajero"><td class="encabezado">&nbsp;<select name="condicion_tipo_mensajero" id="condicion_tipo_mensajero"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO_MENSAJERO</td><td class="encabezado">&nbsp;<select name="compara_tipo_mensajero" id="compara_tipo_mensajero"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="tipo_mensajero" name="tipo_mensajero"></select><script>
                     $(document).ready(function() 
                      {
                      $("#tipo_mensajero").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexo"><td class="encabezado">&nbsp;<select name="condicion_anexo" id="condicion_anexo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXO</td><td class="encabezado">&nbsp;<select name="compara_anexo" id="compara_anexo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexo" name="anexo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_iddestino_radicacion"><td class="encabezado">&nbsp;<select name="condicion_iddestino_radicacion" id="condicion_iddestino_radicacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESTINO_RADICACION</td><td class="encabezado">&nbsp;<select name="compara_iddestino_radicacion" id="compara_iddestino_radicacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="iddestino_radicacion" name="iddestino_radicacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#iddestino_radicacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_recorrido"><td class="encabezado">&nbsp;<select name="condicion_tipo_recorrido" id="condicion_tipo_recorrido"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RECORRIDO DEL DIA</td><td class="encabezado">&nbsp;<select name="compara_tipo_recorrido" id="compara_tipo_recorrido"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(353,5087,'',1);?></td></tr><tr id="tr_docs_seleccionados"><td class="encabezado">&nbsp;<select name="condicion_docs_seleccionados" id="condicion_docs_seleccionados"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DOCUMENTOS SELECCIONADOS</td><td class="encabezado">&nbsp;<select name="compara_docs_seleccionados" id="compara_docs_seleccionados"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="docs_seleccionados" name="docs_seleccionados"></select><script>
                     $(document).ready(function() 
                      {
                      $("#docs_seleccionados").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_mensajero"><td class="encabezado">&nbsp;<select name="condicion_mensajero" id="condicion_mensajero"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="rol del funcionario mensajero">SELECCIONE MENSAJERO</td><td class="encabezado">&nbsp;<select name="compara_mensajero" id="compara_mensajero"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="mensajero" name="mensajero"></select><script>
                     $(document).ready(function() 
                      {
                      $("#mensajero").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_fecha_entrega"><td class="encabezado">&nbsp;<select name="condicion_fecha_entrega" id="condicion_fecha_entrega"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">&nbsp;<select name="compara_fecha_entrega" id="compara_fecha_entrega"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_entrega" name="fecha_entrega"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_entrega").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="4080"><?php submit_formato(353);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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