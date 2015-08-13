<html><title>.:BUSCAR DATOS DEL VEH&IACUTE;CULO:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA DATOS DEL VEH&Iacute;CULO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_vehiculo" id="condicion_nombre_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">VEH&IACUTE;CULO</td><td class="encabezado">&nbsp;<select name="compara_nombre_vehiculo" id="compara_nombre_vehiculo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_nombre_vehiculo"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(258,2932,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_nombre_vehiculo" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_nombre_vehiculo.findItem(htmlentities(document.getElementById('stext_nombre_vehiculo').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre_vehiculo.findItem(htmlentities(document.getElementById('stext_nombre_vehiculo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_nombre_vehiculo.findItem(htmlentities(document.getElementById('stext_nombre_vehiculo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_nombre_vehiculo" height="90%"></div><input type="hidden" maxlength="255"  name="nombre_vehiculo" id="nombre_vehiculo"   value="" ><label style="display:none" class="error" for="nombre_vehiculo">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre_vehiculo=new dhtmlXTreeObject("treeboxbox_nombre_vehiculo","100%","100%",0);
                			tree_nombre_vehiculo.setImagePath("../../imgs/");
                			tree_nombre_vehiculo.enableIEImageFix(true);tree_nombre_vehiculo.enableCheckBoxes(1);
                    tree_nombre_vehiculo.enableRadioButtons(true);tree_nombre_vehiculo.setOnLoadingStart(cargando_nombre_vehiculo);
                      tree_nombre_vehiculo.setOnLoadingEnd(fin_cargando_nombre_vehiculo);tree_nombre_vehiculo.enableSmartXMLParsing(true);tree_nombre_vehiculo.loadXML("../../test_serie.php?sin_padre=1&id=940&tabla=serie");
                      tree_nombre_vehiculo.setOnCheckHandler(onNodeSelect_nombre_vehiculo);
                      function onNodeSelect_nombre_vehiculo(nodeId)
                      {valor_destino=document.getElementById("nombre_vehiculo");
                       destinos=tree_nombre_vehiculo.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_nombre_vehiculo.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_nombre_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_vehiculo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre_vehiculo"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_nombre_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_vehiculo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre_vehiculo"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_modelo_vehiculo" id="condicion_modelo_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MODELO</td><td class="encabezado">&nbsp;<select name="compara_modelo_vehiculo" id="compara_modelo_vehiculo"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(258,2933,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_color_vehiculo" id="condicion_color_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">COLOR</td><td class="encabezado">&nbsp;<select name="compara_color_vehiculo" id="compara_color_vehiculo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_color_vehiculo"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(258,2934,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_color_vehiculo" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_color_vehiculo.findItem(htmlentities(document.getElementById('stext_color_vehiculo').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_color_vehiculo.findItem(htmlentities(document.getElementById('stext_color_vehiculo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_color_vehiculo.findItem(htmlentities(document.getElementById('stext_color_vehiculo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_color_vehiculo" height="90%"></div><input type="hidden" maxlength="255"  name="color_vehiculo" id="color_vehiculo"   value="" ><label style="display:none" class="error" for="color_vehiculo">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_color_vehiculo=new dhtmlXTreeObject("treeboxbox_color_vehiculo","100%","100%",0);
                			tree_color_vehiculo.setImagePath("../../imgs/");
                			tree_color_vehiculo.enableIEImageFix(true);tree_color_vehiculo.enableCheckBoxes(1);
                    tree_color_vehiculo.enableRadioButtons(true);tree_color_vehiculo.setOnLoadingStart(cargando_color_vehiculo);
                      tree_color_vehiculo.setOnLoadingEnd(fin_cargando_color_vehiculo);tree_color_vehiculo.enableSmartXMLParsing(true);tree_color_vehiculo.loadXML("../../test_serie.php?sin_padre=1&id=937&tabla=serie");
                      tree_color_vehiculo.setOnCheckHandler(onNodeSelect_color_vehiculo);
                      function onNodeSelect_color_vehiculo(nodeId)
                      {valor_destino=document.getElementById("color_vehiculo");
                       destinos=tree_color_vehiculo.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_color_vehiculo.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_color_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_color_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_color_vehiculo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_color_vehiculo"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_color_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_color_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_color_vehiculo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_color_vehiculo"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_motor_vehiculo" id="condicion_motor_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MOTOR</td><td class="encabezado">&nbsp;<select name="compara_motor_vehiculo" id="compara_motor_vehiculo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="motor_vehiculo" name="motor_vehiculo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#motor_vehiculo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_serie_chasis_vehiculo" id="condicion_serie_chasis_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SERIE / CHAS&Iacute;S</td><td class="encabezado">&nbsp;<select name="compara_serie_chasis_vehiculo" id="compara_serie_chasis_vehiculo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="serie_chasis_vehiculo" name="serie_chasis_vehiculo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#serie_chasis_vehiculo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor_vehiculo" id="condicion_valor_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR DEL VEH&Iacute;CULO</td><td class="encabezado">&nbsp;<select name="compara_valor_vehiculo" id="compara_valor_vehiculo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor_vehiculo" name="valor_vehiculo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor_vehiculo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_imagen_vehiculo" id="condicion_imagen_vehiculo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">IMAGEN DEL VEH&Iacute;CULO</td><td class="encabezado">&nbsp;<select name="compara_imagen_vehiculo" id="compara_imagen_vehiculo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="imagen_vehiculo" name="imagen_vehiculo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#imagen_vehiculo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="2932"><?php submit_formato(258);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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