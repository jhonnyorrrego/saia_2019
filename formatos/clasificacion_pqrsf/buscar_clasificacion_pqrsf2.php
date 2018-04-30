<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Clasificacion PQRSF</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_x" id="bksaiacondicion_g@fecha_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_x" id="fecha_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_y" id="bksaiacondicion_g@fecha_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_y" id="fecha_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha" id="bqsaiaenlace_fecha" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Clasificacion<input type="hidden" name="bksaiacondicion_serie" id="bksaiacondicion_serie" value="like_total"></b><div id="esperando_serie"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_serie" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_serie" height=""></div><input type="hidden" maxlength="255"  name="g@serie" id="serie"   value="" ><label style="display:none" class="error" for="serie">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_serie=new dhtmlXTreeObject("treeboxbox_serie","","",0);
                			tree_serie.setImagePath("../../imgs/");
                			tree_serie.enableIEImageFix(true);tree_serie.enableCheckBoxes(1);
                    tree_serie.enableRadioButtons(true);tree_serie.setOnLoadingStart(cargando_serie);
                      tree_serie.setOnLoadingEnd(fin_cargando_serie);tree_serie.enableSmartXMLParsing(true);tree_serie.loadXML("../../test_serie.php?tabla=serie&id=1033");
                      tree_serie.setOnCheckHandler(onNodeSelect_serie);
                      function onNodeSelect_serie(nodeId)
                      {valor_destino=document.getElementById("serie");
                       destinos=tree_serie.getAllChecked();
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
                      function fin_cargando_serie() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_serie"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_serie() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_serie"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie" id="bqsaiaenlace_serie" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>responsable<input type="hidden" name="bksaiacondicion_responsable" id="bksaiacondicion_responsable" value="like_total"></b><div id="esperando_responsable"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_responsable" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_responsable" height=""></div><input type="hidden" maxlength="255"  name="g@responsable" id="responsable"   value="" ><label style="display:none" class="error" for="responsable">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable=new dhtmlXTreeObject("treeboxbox_responsable","","",0);
                			tree_responsable.setImagePath("../../imgs/");
                			tree_responsable.enableIEImageFix(true);tree_responsable.enableCheckBoxes(1);
                    tree_responsable.enableRadioButtons(true);tree_responsable.setOnLoadingStart(cargando_responsable);
                      tree_responsable.setOnLoadingEnd(fin_cargando_responsable);tree_responsable.enableSmartXMLParsing(true);tree_responsable.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_responsable.setOnCheckHandler(onNodeSelect_responsable);
                      function onNodeSelect_responsable(nodeId)
                      {valor_destino=document.getElementById("responsable");
                       destinos=tree_responsable.getAllChecked();
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
                      function fin_cargando_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_responsable',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_responsable',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_responsable" id="bqsaiaenlace_responsable" value="y" />
		</div></div></div><div class="control-group"><b>observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="serie@arbol,responsable@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_clasificacion_pqrsf g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_x,g@fecha_y">