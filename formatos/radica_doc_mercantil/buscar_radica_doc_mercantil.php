<html><title>.:BUSCAR RECEPCI&OACUTE;N DE SERVICIOS:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA RECEPCI&Oacute;N DE SERVICIOS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_radicacion_doc" id="condicion_fecha_radicacion_doc"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA Y HORA DE RADICACION</td><td class="encabezado">&nbsp;<select name="compara_fecha_radicacion_doc" id="compara_fecha_radicacion_doc"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_radicacion_doc" name="fecha_radicacion_doc"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_radicacion_doc").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_numero_solicitud" id="condicion_numero_solicitud"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE SOLICITUD</td><td class="encabezado">&nbsp;<select name="compara_numero_solicitud" id="compara_numero_solicitud"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_solicitud" name="numero_solicitud"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_solicitud").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_destino_doc_mercantil" id="condicion_destino_doc_mercantil"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">DESTINO</td><td class="encabezado">&nbsp;<select name="compara_destino_doc_mercantil" id="compara_destino_doc_mercantil"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_destino_doc_mercantil"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(268,3057,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_destino_doc_mercantil" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_destino_doc_mercantil.findItem(htmlentities(document.getElementById('stext_destino_doc_mercantil').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_destino_doc_mercantil.findItem(htmlentities(document.getElementById('stext_destino_doc_mercantil').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_destino_doc_mercantil.findItem(htmlentities(document.getElementById('stext_destino_doc_mercantil').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_destino_doc_mercantil" height="90%"></div><input type="hidden" maxlength="255"  name="destino_doc_mercantil" id="destino_doc_mercantil"   value="" ><label style="display:none" class="error" for="destino_doc_mercantil">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_destino_doc_mercantil=new dhtmlXTreeObject("treeboxbox_destino_doc_mercantil","100%","100%",0);
                			tree_destino_doc_mercantil.setImagePath("../../imgs/");
                			tree_destino_doc_mercantil.enableIEImageFix(true);tree_destino_doc_mercantil.enableCheckBoxes(1);
                    tree_destino_doc_mercantil.enableRadioButtons(true);tree_destino_doc_mercantil.setOnLoadingStart(cargando_destino_doc_mercantil);
                      tree_destino_doc_mercantil.setOnLoadingEnd(fin_cargando_destino_doc_mercantil);tree_destino_doc_mercantil.enableSmartXMLParsing(true);tree_destino_doc_mercantil.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_destino_doc_mercantil.setOnCheckHandler(onNodeSelect_destino_doc_mercantil);
                      function onNodeSelect_destino_doc_mercantil(nodeId)
                      {valor_destino=document.getElementById("destino_doc_mercantil");
                       destinos=tree_destino_doc_mercantil.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_destino_doc_mercantil.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_destino_doc_mercantil() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino_doc_mercantil")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino_doc_mercantil")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_destino_doc_mercantil"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_destino_doc_mercantil() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino_doc_mercantil")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino_doc_mercantil")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_destino_doc_mercantil"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_copia_a_mercantil" id="condicion_copia_a_mercantil"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">COPIA A</td><td class="encabezado">&nbsp;<select name="compara_copia_a_mercantil" id="compara_copia_a_mercantil"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_copia_a_mercantil"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(268,3058,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_copia_a_mercantil" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia_a_mercantil.findItem(htmlentities(document.getElementById('stext_copia_a_mercantil').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_a_mercantil.findItem(htmlentities(document.getElementById('stext_copia_a_mercantil').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia_a_mercantil.findItem(htmlentities(document.getElementById('stext_copia_a_mercantil').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_copia_a_mercantil" height="90%"></div><input type="hidden" maxlength="255"  name="copia_a_mercantil" id="copia_a_mercantil"   value="" ><label style="display:none" class="error" for="copia_a_mercantil">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_a_mercantil=new dhtmlXTreeObject("treeboxbox_copia_a_mercantil","100%","100%",0);
                			tree_copia_a_mercantil.setImagePath("../../imgs/");
                			tree_copia_a_mercantil.enableIEImageFix(true);tree_copia_a_mercantil.enableCheckBoxes(1);
                			tree_copia_a_mercantil.enableThreeStateCheckboxes(1);tree_copia_a_mercantil.setOnLoadingStart(cargando_copia_a_mercantil);
                      tree_copia_a_mercantil.setOnLoadingEnd(fin_cargando_copia_a_mercantil);tree_copia_a_mercantil.enableSmartXMLParsing(true);tree_copia_a_mercantil.loadXML("../../test.php?rol=1");
                      tree_copia_a_mercantil.setOnCheckHandler(onNodeSelect_copia_a_mercantil);
                      function onNodeSelect_copia_a_mercantil(nodeId)
                      {valor_destino=document.getElementById("copia_a_mercantil");
                       destinos=tree_copia_a_mercantil.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_copia_a_mercantil.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_copia_a_mercantil() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_a_mercantil")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_a_mercantil")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_a_mercantil"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia_a_mercantil() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_a_mercantil")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_a_mercantil")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_a_mercantil"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexos_fisicos_radi" id="condicion_anexos_fisicos_radi"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS F&Iacute;SICOS</td><td class="encabezado">&nbsp;<select name="compara_anexos_fisicos_radi" id="compara_anexos_fisicos_radi"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexos_fisicos_radi" name="anexos_fisicos_radi"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexos_fisicos_radi").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexos_digitales_doc" id="condicion_anexos_digitales_doc"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td><td class="encabezado">&nbsp;<select name="compara_anexos_digitales_doc" id="compara_anexos_digitales_doc"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexos_digitales_doc" name="anexos_digitales_doc"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexos_digitales_doc").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_numero_solici_selec" id="condicion_numero_solici_selec"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NUMERO SOLICITUD SELECCIONADA</td><td class="encabezado">&nbsp;<select name="compara_numero_solici_selec" id="compara_numero_solici_selec"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_solici_selec" name="numero_solici_selec"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_solici_selec").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3053"><?php submit_formato(268);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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