<html><title>.:BUSCAR PLANEACI&OACUTE;N DE OT:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA PLANEACI&Oacute;N DE OT</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_concepto_trabajo" id="condicion_concepto_trabajo"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">CONCEPTO</td><td class="encabezado">&nbsp;<select name="compara_concepto_trabajo" id="compara_concepto_trabajo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_concepto_trabajo"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(263,3012,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_concepto_trabajo" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_concepto_trabajo.findItem(htmlentities(document.getElementById('stext_concepto_trabajo').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_concepto_trabajo.findItem(htmlentities(document.getElementById('stext_concepto_trabajo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_concepto_trabajo.findItem(htmlentities(document.getElementById('stext_concepto_trabajo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_concepto_trabajo" height="90%"></div><input type="hidden" maxlength="255"  name="concepto_trabajo" id="concepto_trabajo"   value="" ><label style="display:none" class="error" for="concepto_trabajo">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_concepto_trabajo=new dhtmlXTreeObject("treeboxbox_concepto_trabajo","100%","100%",0);
                			tree_concepto_trabajo.setImagePath("../../imgs/");
                			tree_concepto_trabajo.enableIEImageFix(true);tree_concepto_trabajo.enableCheckBoxes(1);
                    tree_concepto_trabajo.enableRadioButtons(true);tree_concepto_trabajo.setOnLoadingStart(cargando_concepto_trabajo);
                      tree_concepto_trabajo.setOnLoadingEnd(fin_cargando_concepto_trabajo);tree_concepto_trabajo.enableSmartXMLParsing(true);tree_concepto_trabajo.loadXML("../../test_serie.php?sin_padre=1&id=952&tabla=serie");
                      tree_concepto_trabajo.setOnCheckHandler(onNodeSelect_concepto_trabajo);
                      function onNodeSelect_concepto_trabajo(nodeId)
                      {valor_destino=document.getElementById("concepto_trabajo");
                       destinos=tree_concepto_trabajo.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_concepto_trabajo.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_concepto_trabajo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_concepto_trabajo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_concepto_trabajo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_concepto_trabajo"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_concepto_trabajo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_concepto_trabajo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_concepto_trabajo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_concepto_trabajo"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_orden" id="condicion_descripcion_orden"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_descripcion_orden" id="compara_descripcion_orden"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_orden" name="descripcion_orden"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_orden").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_cantidad_solicitada" id="condicion_cantidad_solicitada"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CANTIDAD</td><td class="encabezado">&nbsp;<select name="compara_cantidad_solicitada" id="compara_cantidad_solicitada"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cantidad_solicitada" name="cantidad_solicitada"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cantidad_solicitada").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_costo_trabajo" id="condicion_costo_trabajo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">COSTO</td><td class="encabezado">&nbsp;<select name="compara_costo_trabajo" id="compara_costo_trabajo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="costo_trabajo" name="costo_trabajo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#costo_trabajo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="2992"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="planea_orden_trabajo"><?php submit_formato(263);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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