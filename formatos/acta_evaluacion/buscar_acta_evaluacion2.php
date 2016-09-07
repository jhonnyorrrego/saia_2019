<?php include_once("../librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato f. Acta de evaluaci&oacute;n</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Evaluaci&oacute;n t&eacute;cnica<input type="hidden" name="bksaiacondicion_g@evaluacion_tecnica" id="bksaiacondicion_g@evaluacion_tecnica" value="="></b><div class="controls"><input type="text" id="evaluacion_tecnica" name="bqsaia_g@evaluacion_tecnica"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@evaluacion_tecnica',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@evaluacion_tecnica',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@evaluacion_tecnica" id="bqsaiaenlace_g@evaluacion_tecnica" value="y" />
		</div></div></div><div class="control-group"><b>Evaluaci&oacute;n econ&oacute;mica<input type="hidden" name="bksaiacondicion_g@evaluacion_economica" id="bksaiacondicion_g@evaluacion_economica" value="="></b><div class="controls"><input type="text" id="evaluacion_economica" name="bqsaia_g@evaluacion_economica"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@evaluacion_economica',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@evaluacion_economica',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@evaluacion_economica" id="bqsaiaenlace_g@evaluacion_economica" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Proponentes que no cumplen<input type="hidden" name="bksaiacondicion_proponentes" id="bksaiacondicion_proponentes" value="="></b><div id="esperando_proponentes"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><div id="treeboxbox_proponentes" height=""></div><input type="hidden" maxlength="11"  name="g@proponentes" id="proponentes"   value="" ><label style="display:none" class="error" for="proponentes">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_proponentes=new dhtmlXTreeObject("treeboxbox_proponentes","","",0);
                			tree_proponentes.setImagePath("../../imgs/");
                			tree_proponentes.enableIEImageFix(true);tree_proponentes.setOnLoadingStart(cargando_proponentes);
                      tree_proponentes.setOnLoadingEnd(fin_cargando_proponentes);tree_proponentes.setXMLAutoLoading("{*proponentes_informacio*}");tree_proponentes.loadXML("{*proponentes_informacio*}");
                      tree_proponentes.setOnCheckHandler(onNodeSelect_proponentes);
                      function onNodeSelect_proponentes(nodeId)
                      {valor_destino=document.getElementById("proponentes");
                       destinos=tree_proponentes.getAllChecked();
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
                      function fin_cargando_proponentes() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_proponentes")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_proponentes")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_proponentes"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_proponentes() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_proponentes")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_proponentes")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_proponentes"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_proponentes',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_proponentes',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_proponentes" id="bqsaiaenlace_proponentes" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="proponente_recomenda"><b>Proponente recomendado<input type="hidden" name="bksaiacondicion_g@proponente_recomenda" id="bksaiacondicion_g@proponente_recomenda" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(402,4735,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_proponente_recomenda',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_proponente_recomenda',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_proponente_recomenda" id="bqsaiaenlace_proponente_recomenda" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Gerente del &aacute;rea<input type="hidden" name="bksaiacondicion_gerente" id="bksaiacondicion_gerente" value="="></b><div id="esperando_gerente"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_gerente" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_gerente.findItem(htmlentities(document.getElementById('stext_gerente').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_gerente.findItem(htmlentities(document.getElementById('stext_gerente').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_gerente.findItem(htmlentities(document.getElementById('stext_gerente').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_gerente" height=""></div><input type="hidden" maxlength="11"  name="g@gerente" id="gerente"   value="" ><label style="display:none" class="error" for="gerente">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_gerente=new dhtmlXTreeObject("treeboxbox_gerente","","",0);
                			tree_gerente.setImagePath("../../imgs/");
                			tree_gerente.enableIEImageFix(true);tree_gerente.enableCheckBoxes(1);
                    tree_gerente.enableRadioButtons(true);tree_gerente.setOnLoadingStart(cargando_gerente);
                      tree_gerente.setOnLoadingEnd(fin_cargando_gerente);tree_gerente.enableSmartXMLParsing(true);tree_gerente.loadXML("../../test.php?sin_padre=1");
                      tree_gerente.setOnCheckHandler(onNodeSelect_gerente);
                      function onNodeSelect_gerente(nodeId)
                      {valor_destino=document.getElementById("gerente");
                       destinos=tree_gerente.getAllChecked();
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
                      function fin_cargando_gerente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gerente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gerente")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_gerente"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_gerente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gerente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gerente")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_gerente"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="proponentes@arbol,gerente@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_acta_evaluacion g @ AND  g.documento_iddocumento=iddocumento "></body>