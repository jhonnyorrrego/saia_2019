<html><title>.:BUSCAR DEPENDENCIAS DE LA RUTA:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA DEPENDENCIAS DE LA RUTA</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_item_dependenc" id="condicion_fecha_item_dependenc"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">&nbsp;<select name="compara_fecha_item_dependenc" id="compara_fecha_item_dependenc"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_item_dependenc" name="fecha_item_dependenc"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_item_dependenc").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_estado_dependencia" id="condicion_estado_dependencia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ESTADO_DEPENDENCIA</td><td class="encabezado">&nbsp;<select name="compara_estado_dependencia" id="compara_estado_dependencia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="estado_dependencia" name="estado_dependencia"></select><script>
                     $(document).ready(function() 
                      {
                      $("#estado_dependencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_orden_dependencia" id="condicion_orden_dependencia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ORDEN_DEPENDENCIA</td><td class="encabezado">&nbsp;<select name="compara_orden_dependencia" id="compara_orden_dependencia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="orden_dependencia" name="orden_dependencia"></select><script>
                     $(document).ready(function() 
                      {
                      $("#orden_dependencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_dependencia_asignada" id="condicion_dependencia_asignada"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">DEPENDENCIA</td><td class="encabezado">&nbsp;<select name="compara_dependencia_asignada" id="compara_dependencia_asignada"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_dependencia_asignada"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(405,4995,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_dependencia_asignada" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_dependencia_asignada" height="90%"></div><input type="hidden" maxlength="255"  name="dependencia_asignada" id="dependencia_asignada"   value="" ><label style="display:none" class="error" for="dependencia_asignada">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_dependencia_asignada=new dhtmlXTreeObject("treeboxbox_dependencia_asignada","100%","100%",0);
                			tree_dependencia_asignada.setImagePath("../../imgs/");
                			tree_dependencia_asignada.enableIEImageFix(true);tree_dependencia_asignada.enableCheckBoxes(1);
                    tree_dependencia_asignada.enableRadioButtons(true);tree_dependencia_asignada.setOnLoadingStart(cargando_dependencia_asignada);
                      tree_dependencia_asignada.setOnLoadingEnd(fin_cargando_dependencia_asignada);tree_dependencia_asignada.enableSmartXMLParsing(true);tree_dependencia_asignada.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_dependencia_asignada.setOnCheckHandler(onNodeSelect_dependencia_asignada);
                      function onNodeSelect_dependencia_asignada(nodeId)
                      {valor_destino=document.getElementById("dependencia_asignada");
                       destinos=tree_dependencia_asignada.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_dependencia_asignada.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_dependencia_asignada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencia_asignada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencia_asignada")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_dependencia_asignada"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_dependencia_asignada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencia_asignada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencia_asignada")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_dependencia_asignada"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_dependen" id="condicion_descripcion_dependen"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCIóN</td><td class="encabezado">&nbsp;<select name="compara_descripcion_dependen" id="compara_descripcion_dependen"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_dependen" name="descripcion_dependen"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_dependen").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="dependencias_ruta"><?php submit_formato(405);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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