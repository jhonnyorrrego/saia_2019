<html><title>.:BUSCAR DIAGNOSTICO Y PLAN DE TRATAMIENTO:.</title><head><?php include_once("../../calendario/calendario.php"); ?><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA DIAGNOSTICO Y PLAN DE TRATAMIENTO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_item_evolucion" id="condicion_item_evolucion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ITEM</td><td class="encabezado">&nbsp;<select name="compara_item_evolucion" id="compara_item_evolucion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="item_evolucion" name="item_evolucion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#item_evolucion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_diagnostico" id="condicion_fecha_diagnostico"><option value="AND">Y</option><option value="OR">O</option></td>
                    <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_diagnostico_1"  id="fecha_diagnostico_1" value=""><?php selector_fecha("fecha_diagnostico_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_diagnostico_2"  id="fecha_diagnostico_2" value=""><?php selector_fecha("fecha_diagnostico_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_diagnosticado" id="condicion_nombre_diagnosticado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE DEL PACIENTE</td><td class="encabezado">&nbsp;<select name="compara_nombre_diagnosticado" id="compara_nombre_diagnosticado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_diagnosticado" name="nombre_diagnosticado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_diagnosticado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">ESQUELETICO</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="etiqueta_esqueletico" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_sna" id="condicion_sna"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">SNA</td><td class="encabezado">&nbsp;<select name="compara_sna" id="compara_sna"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3382,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_snb" id="condicion_snb"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">SNB</td><td class="encabezado">&nbsp;<select name="compara_snb" id="compara_snb"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3383,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_anb" id="condicion_anb"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">ANB</td><td class="encabezado">&nbsp;<select name="compara_anb" id="compara_anb"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3384,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_mx_md" id="condicion_mx_md"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">MX-MD</td><td class="encabezado">&nbsp;<select name="compara_mx_md" id="compara_mx_md"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3385,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_snmd" id="condicion_snmd"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">SNMD</td><td class="encabezado">&nbsp;<select name="compara_snmd" id="compara_snmd"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3386,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_wits" id="condicion_wits"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">WITS</td><td class="encabezado">&nbsp;<select name="compara_wits" id="compara_wits"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3387,'',1);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">DENTAL</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="etiqueta_dental" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_interincisivo" id="condicion_interincisivo"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">INTERINCISIVO</td><td class="encabezado">&nbsp;<select name="compara_interincisivo" id="compara_interincisivo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3389,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_uno_mx" id="condicion_uno_mx"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">1 - MX</td><td class="encabezado">&nbsp;<select name="compara_uno_mx" id="compara_uno_mx"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3390,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_uno_md" id="condicion_uno_md"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">1 - MD</td><td class="encabezado">&nbsp;<select name="compara_uno_md" id="compara_uno_md"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3391,'',1);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">M.E.A.W</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="etiqueta_meaw" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_odi" id="condicion_odi"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">ODI</td><td class="encabezado">&nbsp;<select name="compara_odi" id="compara_odi"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3393,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_apdi" id="condicion_apdi"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">APDI</td><td class="encabezado">&nbsp;<select name="compara_apdi" id="compara_apdi"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3394,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_cf" id="condicion_cf"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">CF</td><td class="encabezado">&nbsp;<select name="compara_cf" id="compara_cf"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3395,'',1);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">FACIAL</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="etiqueta_facial" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_linea_e_superior" id="condicion_linea_e_superior"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">LINEA E SUP</td><td class="encabezado">&nbsp;<select name="compara_linea_e_superior" id="compara_linea_e_superior"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3397,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_linea_e_inferior" id="condicion_linea_e_inferior"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">LINEA E INF</td><td class="encabezado">&nbsp;<select name="compara_linea_e_inferior" id="compara_linea_e_inferior"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3398,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fhi_ls" id="condicion_fhi_ls"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">FHI - LS</td><td class="encabezado">&nbsp;<select name="compara_fhi_ls" id="compara_fhi_ls"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3399,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_menor_nl" id="condicion_menor_nl"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">< - NL</td><td class="encabezado">&nbsp;<select name="compara_menor_nl" id="compara_menor_nl"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3400,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ortodoncista" id="condicion_ortodoncista"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">ORTODONCISTA</td><td class="encabezado">&nbsp;<select name="compara_ortodoncista" id="compara_ortodoncista"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_ortodoncista"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(293,3401,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_ortodoncista" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_ortodoncista.findItem(htmlentities(document.getElementById('stext_ortodoncista').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_ortodoncista.findItem(htmlentities(document.getElementById('stext_ortodoncista').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_ortodoncista.findItem(htmlentities(document.getElementById('stext_ortodoncista').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_ortodoncista" height="90%"></div><input type="hidden" maxlength="11"  name="ortodoncista" id="ortodoncista"   value="" ><label style="display:none" class="error" for="ortodoncista">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_ortodoncista=new dhtmlXTreeObject("treeboxbox_ortodoncista","100%","100%",0);
                			tree_ortodoncista.setImagePath("../../imgs/");
                			tree_ortodoncista.enableIEImageFix(true);tree_ortodoncista.enableCheckBoxes(1);
                    tree_ortodoncista.enableRadioButtons(true);tree_ortodoncista.setOnLoadingStart(cargando_ortodoncista);
                      tree_ortodoncista.setOnLoadingEnd(fin_cargando_ortodoncista);tree_ortodoncista.enableSmartXMLParsing(true);tree_ortodoncista.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_ortodoncista.setOnCheckHandler(onNodeSelect_ortodoncista);
                      function onNodeSelect_ortodoncista(nodeId)
                      {valor_destino=document.getElementById("ortodoncista");
                       destinos=tree_ortodoncista.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_ortodoncista.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_ortodoncista() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_ortodoncista")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_ortodoncista")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_ortodoncista"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_ortodoncista() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_ortodoncista")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_ortodoncista")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_ortodoncista"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_auxiliar" id="condicion_auxiliar"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">AUXILIAR</td><td class="encabezado">&nbsp;<select name="compara_auxiliar" id="compara_auxiliar"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_auxiliar"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(293,3402,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_auxiliar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_auxiliar.findItem(htmlentities(document.getElementById('stext_auxiliar').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_auxiliar.findItem(htmlentities(document.getElementById('stext_auxiliar').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_auxiliar.findItem(htmlentities(document.getElementById('stext_auxiliar').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_auxiliar" height="90%"></div><input type="hidden" maxlength="255"  name="auxiliar" id="auxiliar"   value="" ><label style="display:none" class="error" for="auxiliar">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_auxiliar=new dhtmlXTreeObject("treeboxbox_auxiliar","100%","100%",0);
                			tree_auxiliar.setImagePath("../../imgs/");
                			tree_auxiliar.enableIEImageFix(true);tree_auxiliar.enableCheckBoxes(1);
                    tree_auxiliar.enableRadioButtons(true);tree_auxiliar.setOnLoadingStart(cargando_auxiliar);
                      tree_auxiliar.setOnLoadingEnd(fin_cargando_auxiliar);tree_auxiliar.enableSmartXMLParsing(true);tree_auxiliar.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_auxiliar.setOnCheckHandler(onNodeSelect_auxiliar);
                      function onNodeSelect_auxiliar(nodeId)
                      {valor_destino=document.getElementById("auxiliar");
                       destinos=tree_auxiliar.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_auxiliar.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_auxiliar() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_auxiliar")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_auxiliar")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_auxiliar"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_auxiliar() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_auxiliar")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_auxiliar")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_auxiliar"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_esqueletico" id="condicion_esqueletico"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ESQUELETICO</td><td class="encabezado">&nbsp;<select name="compara_esqueletico" id="compara_esqueletico"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="esqueletico" name="esqueletico"></select><script>
                     $(document).ready(function() 
                      {
                      $("#esqueletico").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_oclusal" id="condicion_oclusal"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OCLUSAL</td><td class="encabezado">&nbsp;<select name="compara_oclusal" id="compara_oclusal"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="oclusal" name="oclusal"></select><script>
                     $(document).ready(function() 
                      {
                      $("#oclusal").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_dental" id="condicion_dental"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DENTAL</td><td class="encabezado">&nbsp;<select name="compara_dental" id="compara_dental"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="dental" name="dental"></select><script>
                     $(document).ready(function() 
                      {
                      $("#dental").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tejido_blando" id="condicion_tejido_blando"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TEJIDOS BLANDOS</td><td class="encabezado">&nbsp;<select name="compara_tejido_blando" id="compara_tejido_blando"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="tejido_blando" name="tejido_blando"></select><script>
                     $(document).ready(function() 
                      {
                      $("#tejido_blando").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_funcional" id="condicion_funcional"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FUNCIONAL</td><td class="encabezado">&nbsp;<select name="compara_funcional" id="compara_funcional"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="funcional" name="funcional"></select><script>
                     $(document).ready(function() 
                      {
                      $("#funcional").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_plan_tratamiento" id="condicion_plan_tratamiento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PLAN DE TRATAMIENTO</td><td class="encabezado">&nbsp;<select name="compara_plan_tratamiento" id="compara_plan_tratamiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="plan_tratamiento" name="plan_tratamiento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#plan_tratamiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_re_evaluaciones" id="condicion_re_evaluaciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RE-EVALUACIONES</td><td class="encabezado">&nbsp;<select name="compara_re_evaluaciones" id="compara_re_evaluaciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="re_evaluaciones" name="re_evaluaciones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#re_evaluaciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_retencion" id="condicion_retencion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RETENCI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_retencion" id="compara_retencion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="retencion" name="retencion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#retencion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_plan_preventivo" id="condicion_plan_preventivo"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">PLAN PREVENTIVO</td><td class="encabezado">&nbsp;<select name="compara_plan_preventivo" id="compara_plan_preventivo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3436,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ext_seriada" id="condicion_ext_seriada"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">EXT. SERIADA</td><td class="encabezado">&nbsp;<select name="compara_ext_seriada" id="compara_ext_seriada"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3437,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ortopedia" id="condicion_ortopedia"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">ORTOPEDIA</td><td class="encabezado">&nbsp;<select name="compara_ortopedia" id="compara_ortopedia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3438,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ortopedia_ortodoncia" id="condicion_ortopedia_ortodoncia"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">ORTOPEDIA Y ORTODONCIA</td><td class="encabezado">&nbsp;<select name="compara_ortopedia_ortodoncia" id="compara_ortopedia_ortodoncia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3439,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_otro_tratamiento" id="condicion_otro_tratamiento"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">OTRO</td><td class="encabezado">&nbsp;<select name="compara_otro_tratamiento" id="compara_otro_tratamiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3440,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ortodoncia_caso" id="condicion_ortodoncia_caso"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">ORTODONCIA 1/2 CASO</td><td class="encabezado">&nbsp;<select name="compara_ortodoncia_caso" id="compara_ortodoncia_caso"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3441,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ortodoncia_no_complicada" id="condicion_ortodoncia_no_complicada"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">ORTODONCIA NO COMPLICADA</td><td class="encabezado">&nbsp;<select name="compara_ortodoncia_no_complicada" id="compara_ortodoncia_no_complicada"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3442,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ortodoncia" id="condicion_ortodoncia"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">ORTODONCIA</td><td class="encabezado">&nbsp;<select name="compara_ortodoncia" id="compara_ortodoncia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3443,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ortodoncia_cirugia" id="condicion_ortodoncia_cirugia"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">ORTODONCIA Y CIRUGIA</td><td class="encabezado">&nbsp;<select name="compara_ortodoncia_cirugia" id="compara_ortodoncia_cirugia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3444,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_otro_evaluaciones" id="condicion_otro_evaluaciones"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">OTRO</td><td class="encabezado">&nbsp;<select name="compara_otro_evaluaciones" id="compara_otro_evaluaciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(293,3445,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_remision_procedimiento" id="condicion_remision_procedimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">REMISIONES PARA PROCEDIMIENTOS ESPECIALIZADOS</td><td class="encabezado">&nbsp;<select name="compara_remision_procedimiento" id="compara_remision_procedimiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="remision_procedimiento" name="remision_procedimiento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#remision_procedimiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3380"><?php submit_formato(293);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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