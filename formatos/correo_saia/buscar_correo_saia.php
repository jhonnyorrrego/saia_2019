<html><title>.:BUSCAR CORREO SAIA:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA CORREO SAIA</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_asunto" id="condicion_asunto"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Asunto del correo">ASUNTO</td><td class="encabezado">&nbsp;<select name="compara_asunto" id="compara_asunto"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="asunto" name="asunto"></select><script>
                     $(document).ready(function() 
                      {
                      $("#asunto").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_oficio_entrada" id="condicion_fecha_oficio_entrada"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Fecha de entrada del oficio">FECHA OFICIO ENTRADA</td><td class="encabezado">&nbsp;<select name="compara_fecha_oficio_entrada" id="compara_fecha_oficio_entrada"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_oficio_entrada" name="fecha_oficio_entrada"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_oficio_entrada").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_de" id="condicion_de"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Remitente del correo">DE</td><td class="encabezado">&nbsp;<select name="compara_de" id="compara_de"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="de" name="de"></select><script>
                     $(document).ready(function() 
                      {
                      $("#de").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_para" id="condicion_para"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PARA</td><td class="encabezado">&nbsp;<select name="compara_para" id="compara_para"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="para" name="para"></select><script>
                     $(document).ready(function() 
                      {
                      $("#para").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_transferencia_correo" id="condicion_transferencia_correo"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">TRANSFERIR</td><td class="encabezado">&nbsp;<select name="compara_transferencia_correo" id="compara_transferencia_correo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_transferencia_correo"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(348,4084,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_transferencia_correo" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_transferencia_correo.findItem(htmlentities(document.getElementById('stext_transferencia_correo').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_transferencia_correo.findItem(htmlentities(document.getElementById('stext_transferencia_correo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_transferencia_correo.findItem(htmlentities(document.getElementById('stext_transferencia_correo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_transferencia_correo" height="90%"></div><input type="hidden" maxlength="11"  name="transferencia_correo" id="transferencia_correo"   value="" ><label style="display:none" class="error" for="transferencia_correo">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_transferencia_correo=new dhtmlXTreeObject("treeboxbox_transferencia_correo","100%","100%",0);
                			tree_transferencia_correo.setImagePath("../../imgs/");
                			tree_transferencia_correo.enableIEImageFix(true);tree_transferencia_correo.enableCheckBoxes(1);
                    tree_transferencia_correo.enableRadioButtons(true);tree_transferencia_correo.setOnLoadingStart(cargando_transferencia_correo);
                      tree_transferencia_correo.setOnLoadingEnd(fin_cargando_transferencia_correo);tree_transferencia_correo.enableSmartXMLParsing(true);tree_transferencia_correo.loadXML("../../test.php?rol=1");
                      tree_transferencia_correo.setOnCheckHandler(onNodeSelect_transferencia_correo);
                      function onNodeSelect_transferencia_correo(nodeId)
                      {valor_destino=document.getElementById("transferencia_correo");
                       destinos=tree_transferencia_correo.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_transferencia_correo.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_transferencia_correo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_transferencia_correo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_transferencia_correo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_transferencia_correo"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_transferencia_correo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_transferencia_correo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_transferencia_correo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_transferencia_correo"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_copia_correo" id="condicion_copia_correo"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">CON COPIA</td><td class="encabezado">&nbsp;<select name="compara_copia_correo" id="compara_copia_correo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_copia_correo"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(348,4085,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_copia_correo" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia_correo.findItem(htmlentities(document.getElementById('stext_copia_correo').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_correo.findItem(htmlentities(document.getElementById('stext_copia_correo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia_correo.findItem(htmlentities(document.getElementById('stext_copia_correo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_copia_correo" height="90%"></div><input type="hidden" maxlength="255"  name="copia_correo" id="copia_correo"   value="" ><label style="display:none" class="error" for="copia_correo">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_correo=new dhtmlXTreeObject("treeboxbox_copia_correo","100%","100%",0);
                			tree_copia_correo.setImagePath("../../imgs/");
                			tree_copia_correo.enableIEImageFix(true);tree_copia_correo.enableCheckBoxes(1);
                			tree_copia_correo.enableThreeStateCheckboxes(1);tree_copia_correo.setOnLoadingStart(cargando_copia_correo);
                      tree_copia_correo.setOnLoadingEnd(fin_cargando_copia_correo);tree_copia_correo.enableSmartXMLParsing(true);tree_copia_correo.loadXML("../../test.php?rol=1");
                      tree_copia_correo.setOnCheckHandler(onNodeSelect_copia_correo);
                      function onNodeSelect_copia_correo(nodeId)
                      {valor_destino=document.getElementById("copia_correo");
                       destinos=tree_copia_correo.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_copia_correo.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_copia_correo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_correo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_correo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_correo"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia_correo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_correo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_correo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_correo"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_comentario" id="condicion_comentario"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Comentario del correo">COMENTARIO</td><td class="encabezado">&nbsp;<select name="compara_comentario" id="compara_comentario"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="comentario" name="comentario"></select><script>
                     $(document).ready(function() 
                      {
                      $("#comentario").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexos" id="condicion_anexos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Anexos del correo">ANEXOS</td><td class="encabezado">&nbsp;<select name="compara_anexos" id="compara_anexos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexos" name="anexos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="4031"><?php submit_formato(348);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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