<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend" style="font-size:9pt;">B&uacute;squeda en formato Datos del Veh&iacute;culo</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>Veh&iacute;culo<input type="hidden" name="bksaiacondicion_nombre_vehiculo" id="bksaiacondicion_nombre_vehiculo" value="like_total"></b><div id="esperando_nombre_vehiculo"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_nombre_vehiculo" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_nombre_vehiculo.findItem(htmlentities(document.getElementById('stext_nombre_vehiculo').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre_vehiculo.findItem(htmlentities(document.getElementById('stext_nombre_vehiculo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_nombre_vehiculo.findItem(htmlentities(document.getElementById('stext_nombre_vehiculo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_nombre_vehiculo" height=""></div><input type="hidden" maxlength="255"  name="g@nombre_vehiculo" id="nombre_vehiculo"   value="" ><label style="display:none" class="error" for="nombre_vehiculo">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre_vehiculo=new dhtmlXTreeObject("treeboxbox_nombre_vehiculo","","",0);
                			tree_nombre_vehiculo.setImagePath("../../imgs/");
                			tree_nombre_vehiculo.enableIEImageFix(true);tree_nombre_vehiculo.enableCheckBoxes(1);
                    tree_nombre_vehiculo.enableRadioButtons(true);tree_nombre_vehiculo.setOnLoadingStart(cargando_nombre_vehiculo);
                      tree_nombre_vehiculo.setOnLoadingEnd(fin_cargando_nombre_vehiculo);tree_nombre_vehiculo.enableSmartXMLParsing(true);tree_nombre_vehiculo.loadXML("../../test_serie.php?sin_padre=1&id=940&tabla=serie");
                      tree_nombre_vehiculo.setOnCheckHandler(onNodeSelect_nombre_vehiculo);
                      function onNodeSelect_nombre_vehiculo(nodeId)
                      {valor_destino=document.getElementById("nombre_vehiculo");
                       destinos=tree_nombre_vehiculo.getAllChecked();
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
                      function fin_cargando_nombre_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_vehiculo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre_vehiculo"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_nombre_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_vehiculo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre_vehiculo"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre_vehiculo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre_vehiculo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre_vehiculo" id="bqsaiaenlace_nombre_vehiculo" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="modelo_vehiculo"><b>Modelo<input type="hidden" name="bksaiacondicion_g@modelo_vehiculo" id="bksaiacondicion_g@modelo_vehiculo" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(258,2933,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_modelo_vehiculo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_modelo_vehiculo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_modelo_vehiculo" id="bqsaiaenlace_modelo_vehiculo" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Color<input type="hidden" name="bksaiacondicion_color_vehiculo" id="bksaiacondicion_color_vehiculo" value="like_total"></b><div id="esperando_color_vehiculo"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_color_vehiculo" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_color_vehiculo.findItem(htmlentities(document.getElementById('stext_color_vehiculo').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_color_vehiculo.findItem(htmlentities(document.getElementById('stext_color_vehiculo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_color_vehiculo.findItem(htmlentities(document.getElementById('stext_color_vehiculo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_color_vehiculo" height=""></div><input type="hidden" maxlength="255"  name="g@color_vehiculo" id="color_vehiculo"   value="" ><label style="display:none" class="error" for="color_vehiculo">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_color_vehiculo=new dhtmlXTreeObject("treeboxbox_color_vehiculo","","",0);
                			tree_color_vehiculo.setImagePath("../../imgs/");
                			tree_color_vehiculo.enableIEImageFix(true);tree_color_vehiculo.enableCheckBoxes(1);
                    tree_color_vehiculo.enableRadioButtons(true);tree_color_vehiculo.setOnLoadingStart(cargando_color_vehiculo);
                      tree_color_vehiculo.setOnLoadingEnd(fin_cargando_color_vehiculo);tree_color_vehiculo.enableSmartXMLParsing(true);tree_color_vehiculo.loadXML("../../test_serie.php?sin_padre=1&id=937&tabla=serie");
                      tree_color_vehiculo.setOnCheckHandler(onNodeSelect_color_vehiculo);
                      function onNodeSelect_color_vehiculo(nodeId)
                      {valor_destino=document.getElementById("color_vehiculo");
                       destinos=tree_color_vehiculo.getAllChecked();
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
                      function fin_cargando_color_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_color_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_color_vehiculo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_color_vehiculo"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_color_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_color_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_color_vehiculo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_color_vehiculo"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_color_vehiculo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_color_vehiculo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_color_vehiculo" id="bqsaiaenlace_color_vehiculo" value="y" />
		</div></div></div><div class="control-group"><b>Motor<input type="hidden" name="bksaiacondicion_g@motor_vehiculo" id="bksaiacondicion_g@motor_vehiculo" value="like_total"></b><div class="controls"><input type="text" id="motor_vehiculo" name="bqsaia_g@motor_vehiculo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@motor_vehiculo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@motor_vehiculo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@motor_vehiculo" id="bqsaiaenlace_g@motor_vehiculo" value="y" />
		</div></div></div><div class="control-group"><b>Serie / Chas&iacute;s<input type="hidden" name="bksaiacondicion_g@serie_chasis_vehiculo" id="bksaiacondicion_g@serie_chasis_vehiculo" value="like_total"></b><div class="controls"><input type="text" id="serie_chasis_vehiculo" name="bqsaia_g@serie_chasis_vehiculo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@serie_chasis_vehiculo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@serie_chasis_vehiculo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@serie_chasis_vehiculo" id="bqsaiaenlace_g@serie_chasis_vehiculo" value="y" />
		</div></div></div><div class="control-group"><b>Valor Del Veh&iacute;culo<input type="hidden" name="bksaiacondicion_g@valor_vehiculo" id="bksaiacondicion_g@valor_vehiculo" value="="></b><div class="controls"><input type="text" id="valor_vehiculo" name="bqsaia_g@valor_vehiculo"></div></div><input type="hidden" name="campos_especiales" value="nombre_vehiculo@arbol,color_vehiculo@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_datos_vehiculo g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="idbusqueda_componente" value="123">