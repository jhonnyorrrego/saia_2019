<html><title>.:BUSCAR RUTAS DE DISTRIBUCI&OACUTE;N:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA RUTAS DE DISTRIBUCI&Oacute;N</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_ruta_distribuc" id="condicion_fecha_ruta_distribuc"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">&nbsp;<select name="compara_fecha_ruta_distribuc" id="compara_fecha_ruta_distribuc"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_ruta_distribuc" name="fecha_ruta_distribuc"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_ruta_distribuc").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_ruta" id="condicion_nombre_ruta"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE DE LA RUTA</td><td class="encabezado">&nbsp;<select name="compara_nombre_ruta" id="compara_nombre_ruta"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_ruta" name="nombre_ruta"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_ruta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_ruta" id="condicion_descripcion_ruta"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCIóN RUTA</td><td class="encabezado">&nbsp;<select name="compara_descripcion_ruta" id="compara_descripcion_ruta"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_ruta" name="descripcion_ruta"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_ruta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_asignar_dependencias" id="condicion_asignar_dependencias"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">DEPENDENCIAS DE LA RUTA</td><td class="encabezado">&nbsp;<select name="compara_asignar_dependencias" id="compara_asignar_dependencias"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_asignar_dependencias"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(404,4998,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_asignar_dependencias" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_asignar_dependencias.findItem(htmlentities(document.getElementById('stext_asignar_dependencias').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_asignar_dependencias.findItem(htmlentities(document.getElementById('stext_asignar_dependencias').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_asignar_dependencias.findItem(htmlentities(document.getElementById('stext_asignar_dependencias').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_asignar_dependencias" height="90%"></div><input type="hidden" maxlength="255"  name="asignar_dependencias" id="asignar_dependencias"   value="" ><label style="display:none" class="error" for="asignar_dependencias">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_asignar_dependencias=new dhtmlXTreeObject("treeboxbox_asignar_dependencias","100%","100%",0);
                			tree_asignar_dependencias.setImagePath("../../imgs/");
                			tree_asignar_dependencias.enableIEImageFix(true);tree_asignar_dependencias.enableCheckBoxes(1);
                			tree_asignar_dependencias.enableThreeStateCheckboxes(1);tree_asignar_dependencias.setOnLoadingStart(cargando_asignar_dependencias);
                      tree_asignar_dependencias.setOnLoadingEnd(fin_cargando_asignar_dependencias);tree_asignar_dependencias.enableSmartXMLParsing(true);tree_asignar_dependencias.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_asignar_dependencias.setOnCheckHandler(onNodeSelect_asignar_dependencias);
                      function onNodeSelect_asignar_dependencias(nodeId)
                      {valor_destino=document.getElementById("asignar_dependencias");
                       destinos=tree_asignar_dependencias.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_asignar_dependencias.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_asignar_dependencias() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_asignar_dependencias")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_asignar_dependencias")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_asignar_dependencias"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_asignar_dependencias() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_asignar_dependencias")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_asignar_dependencias")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_asignar_dependencias"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_asignar_mensajeros" id="condicion_asignar_mensajeros"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">MENSAJEROS DE LA RUTA</td><td class="encabezado">&nbsp;<select name="compara_asignar_mensajeros" id="compara_asignar_mensajeros"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_asignar_mensajeros"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(404,4999,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_asignar_mensajeros" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_asignar_mensajeros.findItem(htmlentities(document.getElementById('stext_asignar_mensajeros').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_asignar_mensajeros.findItem(htmlentities(document.getElementById('stext_asignar_mensajeros').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_asignar_mensajeros.findItem(htmlentities(document.getElementById('stext_asignar_mensajeros').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_asignar_mensajeros" height="90%"></div><input type="hidden" maxlength="255"  name="asignar_mensajeros" id="asignar_mensajeros"   value="" ><label style="display:none" class="error" for="asignar_mensajeros">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_asignar_mensajeros=new dhtmlXTreeObject("treeboxbox_asignar_mensajeros","100%","100%",0);
                			tree_asignar_mensajeros.setImagePath("../../imgs/");
                			tree_asignar_mensajeros.enableIEImageFix(true);tree_asignar_mensajeros.enableCheckBoxes(1);
                			tree_asignar_mensajeros.enableThreeStateCheckboxes(1);tree_asignar_mensajeros.setOnLoadingStart(cargando_asignar_mensajeros);
                      tree_asignar_mensajeros.setOnLoadingEnd(fin_cargando_asignar_mensajeros);tree_asignar_mensajeros.enableSmartXMLParsing(true);tree_asignar_mensajeros.loadXML("../../test.php?iddependencia=75&rol=1");
                      tree_asignar_mensajeros.setOnCheckHandler(onNodeSelect_asignar_mensajeros);
                      function onNodeSelect_asignar_mensajeros(nodeId)
                      {valor_destino=document.getElementById("asignar_mensajeros");
                       destinos=tree_asignar_mensajeros.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_asignar_mensajeros.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_asignar_mensajeros() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_asignar_mensajeros")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_asignar_mensajeros")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_asignar_mensajeros"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_asignar_mensajeros() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_asignar_mensajeros")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_asignar_mensajeros")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_asignar_mensajeros"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><?php submit_formato(404);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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