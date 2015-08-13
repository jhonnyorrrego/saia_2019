<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Dependencia<input type="hidden" name="bksaiacondicion_g@dependencia" id="bksaiacondicion_g@dependencia" value="="></b><div class="controls"><input type="text" id="dependencia" name="bqsaia_g@dependencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@dependencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@dependencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@dependencia" id="bqsaiaenlace_g@dependencia" value="y" />
		</div></div></div><div class="control-group"><b>Fecha<input type="hidden" name="bksaiacondicion_g@fecha" id="bksaiacondicion_g@fecha" value="like_total"></b><div class="controls"><input type="text" id="fecha" name="bqsaia_g@fecha"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha" id="bqsaiaenlace_g@fecha" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Destino<input type="hidden" name="bksaiacondicion_destino" id="bksaiacondicion_destino" value="like_total"></b><div id="esperando_destino"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_destino" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_destino.findItem(htmlentities(document.getElementById('stext_destino').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_destino.findItem(htmlentities(document.getElementById('stext_destino').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_destino.findItem(htmlentities(document.getElementById('stext_destino').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_destino" height=""></div><input type="hidden" maxlength="200"  name="g@destino" id="destino"   value="" ><label style="display:none" class="error" for="destino">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_destino=new dhtmlXTreeObject("treeboxbox_destino","","",0);
                			tree_destino.setImagePath("../../imgs/");
                			tree_destino.enableIEImageFix(true);tree_destino.enableCheckBoxes(1);
                			tree_destino.enableThreeStateCheckboxes(1);tree_destino.setOnLoadingStart(cargando_destino);
                      tree_destino.setOnLoadingEnd(fin_cargando_destino);tree_destino.enableSmartXMLParsing(true);tree_destino.loadXML("../../test.php?rol=1");
                      tree_destino.setOnCheckHandler(onNodeSelect_destino);
                      function onNodeSelect_destino(nodeId)
                      {valor_destino=document.getElementById("destino");
                       destinos=tree_destino.getAllChecked();
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
                      function fin_cargando_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_destino"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_destino"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_destino" id="bqsaiaenlace_destino" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Con copia a<input type="hidden" name="bksaiacondicion_copia_a" id="bksaiacondicion_copia_a" value="like_total"></b><div id="esperando_copia_a"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_copia_a" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia_a.findItem(htmlentities(document.getElementById('stext_copia_a').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_a.findItem(htmlentities(document.getElementById('stext_copia_a').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia_a.findItem(htmlentities(document.getElementById('stext_copia_a').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_copia_a" height=""></div><input type="hidden" maxlength="200"  name="g@copia_a" id="copia_a"   value="" ><label style="display:none" class="error" for="copia_a">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_a=new dhtmlXTreeObject("treeboxbox_copia_a","","",0);
                			tree_copia_a.setImagePath("../../imgs/");
                			tree_copia_a.enableIEImageFix(true);tree_copia_a.enableCheckBoxes(1);
                			tree_copia_a.enableThreeStateCheckboxes(1);tree_copia_a.setOnLoadingStart(cargando_copia_a);
                      tree_copia_a.setOnLoadingEnd(fin_cargando_copia_a);tree_copia_a.enableSmartXMLParsing(true);tree_copia_a.loadXML("../../test.php?rol=1");
                      tree_copia_a.setOnCheckHandler(onNodeSelect_copia_a);
                      function onNodeSelect_copia_a(nodeId)
                      {valor_destino=document.getElementById("copia_a");
                       destinos=tree_copia_a.getAllChecked();
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
                      function fin_cargando_copia_a() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_a")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_a")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_a"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia_a() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_a")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_a")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_a"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_copia_a',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_copia_a',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_copia_a" id="bqsaiaenlace_copia_a" value="y" />
		</div></div></div><div class="control-group"><b>Asunto<input type="hidden" name="bksaiacondicion_g@asunto" id="bksaiacondicion_g@asunto" value="like_total"></b><div class="controls"><input type="text" id="asunto" name="bqsaia_g@asunto"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@asunto" id="bqsaiaenlace_g@asunto" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="saludo"><b>Saludos<input type="hidden" name="bksaiacondicion_g@saludo" id="bksaiacondicion_g@saludo" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(242,2740,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_saludo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_saludo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_saludo" id="bqsaiaenlace_saludo" value="y" />
		</div></div></div><div class="control-group"><b>contenido<input type="hidden" name="bksaiacondicion_g@contenido" id="bksaiacondicion_g@contenido" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="contenido" name="bqsaia_g@contenido"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@contenido',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@contenido',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@contenido" id="bqsaiaenlace_g@contenido" value="y" />
		</div></div></div><div class="control-group"><b>Despedida<input type="hidden" name="bksaiacondicion_g@despedida" id="bksaiacondicion_g@despedida" value="like_total"></b><div class="controls"><input type="text" id="despedida" name="bqsaia_g@despedida"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@despedida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@despedida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@despedida" id="bqsaiaenlace_g@despedida" value="y" />
		</div></div></div><div class="control-group"><b>Iniciales quien preparo<input type="hidden" name="bksaiacondicion_g@iniciales" id="bksaiacondicion_g@iniciales" value="like_total"></b><div class="controls"><input type="text" id="iniciales" name="bqsaia_g@iniciales"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@iniciales',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@iniciales',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@iniciales" id="bqsaiaenlace_g@iniciales" value="y" />
		</div></div></div><div class="control-group"><b>Anexos fisicos<input type="hidden" name="bksaiacondicion_g@anexos_fisicos" id="bksaiacondicion_g@anexos_fisicos" value="like_total"></b><div class="controls"><input type="text" id="anexos_fisicos" name="bqsaia_g@anexos_fisicos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@anexos_fisicos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@anexos_fisicos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@anexos_fisicos" id="bqsaiaenlace_g@anexos_fisicos" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="origen"><b>De<input type="hidden" name="bksaiacondicion_g@origen" id="bksaiacondicion_g@origen" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(242,2753,'',1,'buscar');?></div></div><input type="hidden" name="campos_especiales" value="destino@arbol,copia_a@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_notificacion_interna g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="idbusqueda_componente" value="0">