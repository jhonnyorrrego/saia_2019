<?php include_once("../librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato flujos padre</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>arbol fun<input type="hidden" name="bksaiacondicion_arbol_fun" id="bksaiacondicion_arbol_fun" value="="></b><div id="esperando_arbol_fun"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_arbol_fun" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_arbol_fun.findItem(htmlentities(document.getElementById('stext_arbol_fun').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_arbol_fun.findItem(htmlentities(document.getElementById('stext_arbol_fun').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_arbol_fun.findItem(htmlentities(document.getElementById('stext_arbol_fun').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_arbol_fun" height=""></div><input type="hidden" maxlength="11"  name="g@arbol_fun" id="arbol_fun"   value="" ><label style="display:none" class="error" for="arbol_fun">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_arbol_fun=new dhtmlXTreeObject("treeboxbox_arbol_fun","","",0);
                			tree_arbol_fun.setImagePath("../../imgs/");
                			tree_arbol_fun.enableIEImageFix(true);tree_arbol_fun.enableCheckBoxes(1);
                    tree_arbol_fun.enableRadioButtons(true);tree_arbol_fun.setOnLoadingStart(cargando_arbol_fun);
                      tree_arbol_fun.setOnLoadingEnd(fin_cargando_arbol_fun);tree_arbol_fun.enableSmartXMLParsing(true);tree_arbol_fun.loadXML("../../test.php?sin_padre=1");
                      tree_arbol_fun.setOnCheckHandler(onNodeSelect_arbol_fun);
                      function onNodeSelect_arbol_fun(nodeId)
                      {valor_destino=document.getElementById("arbol_fun");
                       destinos=tree_arbol_fun.getAllChecked();
                       var nuevos_valores=destinos.split(",");
						var cantidad=nuevos_valores.length;
						var funcionarios=new Array();
						var indice=0;
						for(var i=0;i<cantidad;i++){
							//if(nuevos_valores[i].indexOf("#")=="-1"){
								if(nuevos_valores[i]!=""){
									funcionarios[indice]=nuevos_valores[i];
									indice++;
								}
							//}
						}
						valor_destino.value=funcionarios.join(",");
                      }
                      function fin_cargando_arbol_fun() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_arbol_fun")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_arbol_fun")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_arbol_fun"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_arbol_fun() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_arbol_fun")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_arbol_fun")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_arbol_fun"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="arbol_fun@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_flujos_padre g @ AND  g.documento_iddocumento=iddocumento "></body>