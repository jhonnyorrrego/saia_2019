<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Transferencia documental</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="expediente_vinculado"><b>Transferencia Vinculada<input type="hidden" name="bksaiacondicion_expediente_vinculado" id="bksaiacondicion_expediente_vinculado" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(343,3995,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_expediente_vinculado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_expediente_vinculado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_expediente_vinculado" id="bqsaiaenlace_expediente_vinculado" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Oficina productora<input type="hidden" name="bksaiacondicion_oficina_productora" id="bksaiacondicion_oficina_productora" value="like_total"></b><div id="esperando_oficina_productora"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_oficina_productora" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_oficina_productora" height=""></div><input type="hidden" maxlength="255"  name="g@oficina_productora" id="oficina_productora"   value="" ><label style="display:none" class="error" for="oficina_productora">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_oficina_productora=new dhtmlXTreeObject("treeboxbox_oficina_productora","","",0);
                			tree_oficina_productora.setImagePath("../../imgs/");
                			tree_oficina_productora.enableIEImageFix(true);tree_oficina_productora.enableCheckBoxes(1);
                    tree_oficina_productora.enableRadioButtons(true);tree_oficina_productora.setOnLoadingStart(cargando_oficina_productora);
                      tree_oficina_productora.setOnLoadingEnd(fin_cargando_oficina_productora);tree_oficina_productora.enableSmartXMLParsing(true);tree_oficina_productora.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_oficina_productora.setOnCheckHandler(onNodeSelect_oficina_productora);
                      function onNodeSelect_oficina_productora(nodeId)
                      {valor_destino=document.getElementById("oficina_productora");
                       destinos=tree_oficina_productora.getAllChecked();
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
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_oficina_productora',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_oficina_productora',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_oficina_productora" id="bqsaiaenlace_oficina_productora" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@observaciones" id="bqsaiaenlace_g@observaciones" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Entregado por<input type="hidden" name="bksaiacondicion_entregado_por" id="bksaiacondicion_entregado_por" value="like_total"></b><div id="esperando_entregado_por"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_entregado_por" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_entregado_por" height=""></div><input type="hidden" maxlength="255"  name="g@entregado_por" id="entregado_por"   value="" ><label style="display:none" class="error" for="entregado_por">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_entregado_por=new dhtmlXTreeObject("treeboxbox_entregado_por","","",0);
                			tree_entregado_por.setImagePath("../../imgs/");
                			tree_entregado_por.enableIEImageFix(true);tree_entregado_por.enableCheckBoxes(1);
                    tree_entregado_por.enableRadioButtons(true);tree_entregado_por.setOnLoadingStart(cargando_entregado_por);
                      tree_entregado_por.setOnLoadingEnd(fin_cargando_entregado_por);tree_entregado_por.enableSmartXMLParsing(true);tree_entregado_por.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_entregado_por.setOnCheckHandler(onNodeSelect_entregado_por);
                      function onNodeSelect_entregado_por(nodeId)
                      {valor_destino=document.getElementById("entregado_por");
                       destinos=tree_entregado_por.getAllChecked();
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
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_entregado_por',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_entregado_por',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_entregado_por" id="bqsaiaenlace_entregado_por" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Recibido por<input type="hidden" name="bksaiacondicion_recibido_por" id="bksaiacondicion_recibido_por" value="like_total"></b><div id="esperando_recibido_por"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_recibido_por" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_recibido_por" height=""></div><input type="hidden" maxlength="255"  name="g@recibido_por" id="recibido_por"   value="" ><label style="display:none" class="error" for="recibido_por">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_recibido_por=new dhtmlXTreeObject("treeboxbox_recibido_por","","",0);
                			tree_recibido_por.setImagePath("../../imgs/");
                			tree_recibido_por.enableIEImageFix(true);tree_recibido_por.enableCheckBoxes(1);
                    tree_recibido_por.enableRadioButtons(true);tree_recibido_por.setOnLoadingStart(cargando_recibido_por);
                      tree_recibido_por.setOnLoadingEnd(fin_cargando_recibido_por);tree_recibido_por.enableSmartXMLParsing(true);tree_recibido_por.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_recibido_por.setOnCheckHandler(onNodeSelect_recibido_por);
                      function onNodeSelect_recibido_por(nodeId)
                      {valor_destino=document.getElementById("recibido_por");
                       destinos=tree_recibido_por.getAllChecked();
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
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_recibido_por',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_recibido_por',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_recibido_por" id="bqsaiaenlace_recibido_por" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="transferir_a"><b>Transferir a<input type="hidden" name="bksaiacondicion_g@transferir_a" id="bksaiacondicion_g@transferir_a" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(343,4002,'',1,'buscar');?></div></div><input type="hidden" name="campos_especiales" value="oficina_productora@arbol,entregado_por@arbol,recibido_por@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_transferencia_doc g @ AND  g.documento_iddocumento=iddocumento "></body>