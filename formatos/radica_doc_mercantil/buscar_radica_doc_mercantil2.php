<?php include_once("../librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Recepci&oacute;n de Servicios</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Fecha y Hora de Radicacion<input type="hidden" name="bksaiacondicion_g@fecha_radicacion_doc" id="bksaiacondicion_g@fecha_radicacion_doc" value="like_total"></b><div class="controls"><input type="text" id="fecha_radicacion_doc" name="bqsaia_g@fecha_radicacion_doc"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha_radicacion_doc',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha_radicacion_doc',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha_radicacion_doc" id="bqsaiaenlace_g@fecha_radicacion_doc" value="y" />
		</div></div></div><div class="control-group"><b>N&uacute;mero de Solicitud<input type="hidden" name="bksaiacondicion_g@numero_solicitud" id="bksaiacondicion_g@numero_solicitud" value="="></b><div class="controls"><input type="text" id="numero_solicitud" name="bqsaia_g@numero_solicitud"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@numero_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@numero_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@numero_solicitud" id="bqsaiaenlace_g@numero_solicitud" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Destino<input type="hidden" name="bksaiacondicion_destino_doc_mercantil" id="bksaiacondicion_destino_doc_mercantil" value="like_total"></b><div id="esperando_destino_doc_mercantil"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_destino_doc_mercantil" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_destino_doc_mercantil.findItem(htmlentities(document.getElementById('stext_destino_doc_mercantil').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_destino_doc_mercantil.findItem(htmlentities(document.getElementById('stext_destino_doc_mercantil').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_destino_doc_mercantil.findItem(htmlentities(document.getElementById('stext_destino_doc_mercantil').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_destino_doc_mercantil" height=""></div><input type="hidden" maxlength="255"  name="g@destino_doc_mercantil" id="destino_doc_mercantil"   value="" ><label style="display:none" class="error" for="destino_doc_mercantil">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_destino_doc_mercantil=new dhtmlXTreeObject("treeboxbox_destino_doc_mercantil","","",0);
                			tree_destino_doc_mercantil.setImagePath("../../imgs/");
                			tree_destino_doc_mercantil.enableIEImageFix(true);tree_destino_doc_mercantil.enableCheckBoxes(1);
                    tree_destino_doc_mercantil.enableRadioButtons(true);tree_destino_doc_mercantil.setOnLoadingStart(cargando_destino_doc_mercantil);
                      tree_destino_doc_mercantil.setOnLoadingEnd(fin_cargando_destino_doc_mercantil);tree_destino_doc_mercantil.enableSmartXMLParsing(true);tree_destino_doc_mercantil.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_destino_doc_mercantil.setOnCheckHandler(onNodeSelect_destino_doc_mercantil);
                      function onNodeSelect_destino_doc_mercantil(nodeId)
                      {valor_destino=document.getElementById("destino_doc_mercantil");
                       destinos=tree_destino_doc_mercantil.getAllChecked();
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
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_destino_doc_mercantil',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_destino_doc_mercantil',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_destino_doc_mercantil" id="bqsaiaenlace_destino_doc_mercantil" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Copia a<input type="hidden" name="bksaiacondicion_copia_a_mercantil" id="bksaiacondicion_copia_a_mercantil" value="like_total"></b><div id="esperando_copia_a_mercantil"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_copia_a_mercantil" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia_a_mercantil.findItem(htmlentities(document.getElementById('stext_copia_a_mercantil').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_a_mercantil.findItem(htmlentities(document.getElementById('stext_copia_a_mercantil').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia_a_mercantil.findItem(htmlentities(document.getElementById('stext_copia_a_mercantil').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_copia_a_mercantil" height=""></div><input type="hidden" maxlength="255"  name="g@copia_a_mercantil" id="copia_a_mercantil"   value="" ><label style="display:none" class="error" for="copia_a_mercantil">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_a_mercantil=new dhtmlXTreeObject("treeboxbox_copia_a_mercantil","","",0);
                			tree_copia_a_mercantil.setImagePath("../../imgs/");
                			tree_copia_a_mercantil.enableIEImageFix(true);tree_copia_a_mercantil.enableCheckBoxes(1);
                			tree_copia_a_mercantil.enableThreeStateCheckboxes(1);tree_copia_a_mercantil.setOnLoadingStart(cargando_copia_a_mercantil);
                      tree_copia_a_mercantil.setOnLoadingEnd(fin_cargando_copia_a_mercantil);tree_copia_a_mercantil.enableSmartXMLParsing(true);tree_copia_a_mercantil.loadXML("../../test.php?rol=1");
                      tree_copia_a_mercantil.setOnCheckHandler(onNodeSelect_copia_a_mercantil);
                      function onNodeSelect_copia_a_mercantil(nodeId)
                      {valor_destino=document.getElementById("copia_a_mercantil");
                       destinos=tree_copia_a_mercantil.getAllChecked();
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
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_copia_a_mercantil',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_copia_a_mercantil',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_copia_a_mercantil" id="bqsaiaenlace_copia_a_mercantil" value="y" />
		</div></div></div><div class="control-group"><b>Anexos F&iacute;sicos<input type="hidden" name="bksaiacondicion_g@anexos_fisicos_radi" id="bksaiacondicion_g@anexos_fisicos_radi" value="="></b><div class="controls"><input type="text" id="anexos_fisicos_radi" name="bqsaia_g@anexos_fisicos_radi"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@anexos_fisicos_radi',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@anexos_fisicos_radi',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@anexos_fisicos_radi" id="bqsaiaenlace_g@anexos_fisicos_radi" value="y" />
		</div></div></div><div class="control-group"><b>Numero Solicitud Seleccionada<input type="hidden" name="bksaiacondicion_g@numero_solici_selec" id="bksaiacondicion_g@numero_solici_selec" value="like_total"></b><div class="controls"><input type="text" id="numero_solici_selec" name="bqsaia_g@numero_solici_selec"></div></div><input type="hidden" name="campos_especiales" value="destino_doc_mercantil@arbol,copia_a_mercantil@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_radica_doc_mercantil g @ AND  g.documento_iddocumento=iddocumento "></body>