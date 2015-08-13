<html><title>.:BUSCAR ORDEN DE PAGO:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ORDEN DE PAGO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_gasto" id="condicion_tipo_gasto"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">TIPO GASTO</td><td class="encabezado">&nbsp;<select name="compara_tipo_gasto" id="compara_tipo_gasto"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_tipo_gasto"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(303,3543,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_tipo_gasto" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_tipo_gasto.findItem(htmlentities(document.getElementById('stext_tipo_gasto').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_tipo_gasto.findItem(htmlentities(document.getElementById('stext_tipo_gasto').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_tipo_gasto.findItem(htmlentities(document.getElementById('stext_tipo_gasto').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_tipo_gasto" height="90%"></div><input type="hidden"  name="tipo_gasto" id="tipo_gasto"   value="" ><label style="display:none" class="error" for="tipo_gasto">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_tipo_gasto=new dhtmlXTreeObject("treeboxbox_tipo_gasto","100%","100%",0);
                			tree_tipo_gasto.setImagePath("../../imgs/");
                			tree_tipo_gasto.enableIEImageFix(true);tree_tipo_gasto.enableCheckBoxes(1);
                    tree_tipo_gasto.enableRadioButtons(true);tree_tipo_gasto.setOnLoadingStart(cargando_tipo_gasto);
                      tree_tipo_gasto.setOnLoadingEnd(fin_cargando_tipo_gasto);tree_tipo_gasto.enableSmartXMLParsing(true);tree_tipo_gasto.loadXML("../../test_serie.php?tabla=serie&id=1029&sin_padre=1");
                      tree_tipo_gasto.setOnCheckHandler(onNodeSelect_tipo_gasto);
                      function onNodeSelect_tipo_gasto(nodeId)
                      {valor_destino=document.getElementById("tipo_gasto");
                       destinos=tree_tipo_gasto.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_tipo_gasto.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_tipo_gasto() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_gasto")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_gasto")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_tipo_gasto"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_tipo_gasto() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_gasto")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_gasto")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_tipo_gasto"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_calificacion" id="condicion_calificacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CALIFICACON SERVICIO</td><td class="encabezado">&nbsp;<select name="compara_calificacion" id="compara_calificacion"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(303,3539,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_urgencia_pago" id="condicion_urgencia_pago"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">URGENCIA PAGO</td><td class="encabezado">&nbsp;<select name="compara_urgencia_pago" id="compara_urgencia_pago"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(303,3544,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_observaciones" id="condicion_observaciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td><td class="encabezado">&nbsp;<select name="compara_observaciones" id="compara_observaciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones" name="observaciones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observaciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_usuario_causo" id="condicion_usuario_causo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">USUARIO CAUSACI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_usuario_causo" id="compara_usuario_causo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="usuario_causo" name="usuario_causo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#usuario_causo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_causacion" id="condicion_fecha_causacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA CAUSACI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_fecha_causacion" id="compara_fecha_causacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_causacion" name="fecha_causacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_causacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_causacion" id="condicion_causacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CAUSACI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_causacion" id="compara_causacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="causacion" name="causacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#causacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3539"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(303);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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