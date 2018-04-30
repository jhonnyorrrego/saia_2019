<html><title>.:BUSCAR TRANSFERENCIA DOCUMENTAL:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA TRANSFERENCIA DOCUMENTAL</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_expediente_vinculado" id="condicion_expediente_vinculado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TRANSFERENCIA VINCULADA</td><td class="encabezado">&nbsp;<select name="compara_expediente_vinculado" id="compara_expediente_vinculado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="expediente_vinculado" name="expediente_vinculado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#expediente_vinculado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_oficina_productora" id="condicion_oficina_productora"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">OFICINA PRODUCTORA</td><td class="encabezado">&nbsp;<select name="compara_oficina_productora" id="compara_oficina_productora"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_oficina_productora"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(343,3997,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_oficina_productora" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_oficina_productora" height="90%"></div><input type="hidden" maxlength="255"  name="oficina_productora" id="oficina_productora"   value="" ><label style="display:none" class="error" for="oficina_productora">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_oficina_productora=new dhtmlXTreeObject("treeboxbox_oficina_productora","100%","100%",0);
                			tree_oficina_productora.setImagePath("../../imgs/");
                			tree_oficina_productora.enableIEImageFix(true);tree_oficina_productora.enableCheckBoxes(1);
                    tree_oficina_productora.enableRadioButtons(true);tree_oficina_productora.setOnLoadingStart(cargando_oficina_productora);
                      tree_oficina_productora.setOnLoadingEnd(fin_cargando_oficina_productora);tree_oficina_productora.enableSmartXMLParsing(true);tree_oficina_productora.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_oficina_productora.setOnCheckHandler(onNodeSelect_oficina_productora);
                      function onNodeSelect_oficina_productora(nodeId)
                      {valor_destino=document.getElementById("oficina_productora");
                       destinos=tree_oficina_productora.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_oficina_productora.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_oficina_productora() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_oficina_productora")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_oficina_productora")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_oficina_productora"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_oficina_productora() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_oficina_productora")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_oficina_productora")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_oficina_productora"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_observaciones" id="condicion_observaciones"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexos" id="condicion_anexos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS</td><td class="encabezado">&nbsp;<select name="compara_anexos" id="compara_anexos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexos" name="anexos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_entregado_por" id="condicion_entregado_por"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">ENTREGADO POR</td><td class="encabezado">&nbsp;<select name="compara_entregado_por" id="compara_entregado_por"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_entregado_por"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(343,4000,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_entregado_por" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_entregado_por" height="90%"></div><input type="hidden" maxlength="255"  name="entregado_por" id="entregado_por"   value="" ><label style="display:none" class="error" for="entregado_por">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_entregado_por=new dhtmlXTreeObject("treeboxbox_entregado_por","100%","100%",0);
                			tree_entregado_por.setImagePath("../../imgs/");
                			tree_entregado_por.enableIEImageFix(true);tree_entregado_por.enableCheckBoxes(1);
                    tree_entregado_por.enableRadioButtons(true);tree_entregado_por.setOnLoadingStart(cargando_entregado_por);
                      tree_entregado_por.setOnLoadingEnd(fin_cargando_entregado_por);tree_entregado_por.enableSmartXMLParsing(true);tree_entregado_por.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_entregado_por.setOnCheckHandler(onNodeSelect_entregado_por);
                      function onNodeSelect_entregado_por(nodeId)
                      {valor_destino=document.getElementById("entregado_por");
                       destinos=tree_entregado_por.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_entregado_por.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_entregado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_entregado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_entregado_por")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_entregado_por"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_entregado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_entregado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_entregado_por")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_entregado_por"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_recibido_por" id="condicion_recibido_por"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">RECIBIDO POR</td><td class="encabezado">&nbsp;<select name="compara_recibido_por" id="compara_recibido_por"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_recibido_por"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(343,4001,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_recibido_por" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_recibido_por" height="90%"></div><input type="hidden" maxlength="255"  name="recibido_por" id="recibido_por"   value="" ><label style="display:none" class="error" for="recibido_por">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_recibido_por=new dhtmlXTreeObject("treeboxbox_recibido_por","100%","100%",0);
                			tree_recibido_por.setImagePath("../../imgs/");
                			tree_recibido_por.enableIEImageFix(true);tree_recibido_por.enableCheckBoxes(1);
                    tree_recibido_por.enableRadioButtons(true);tree_recibido_por.setOnLoadingStart(cargando_recibido_por);
                      tree_recibido_por.setOnLoadingEnd(fin_cargando_recibido_por);tree_recibido_por.enableSmartXMLParsing(true);tree_recibido_por.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_recibido_por.setOnCheckHandler(onNodeSelect_recibido_por);
                      function onNodeSelect_recibido_por(nodeId)
                      {valor_destino=document.getElementById("recibido_por");
                       destinos=tree_recibido_por.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_recibido_por.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_recibido_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_recibido_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_recibido_por")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_recibido_por"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_recibido_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_recibido_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_recibido_por")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_recibido_por"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_transferir_a" id="condicion_transferir_a"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TRANSFERIR A</td><td class="encabezado">&nbsp;<select name="compara_transferir_a" id="compara_transferir_a"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(343,4002,'',1);?></td></tr><input type="hidden" name="campo_descripcion" value="3997"><?php submit_formato(343);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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