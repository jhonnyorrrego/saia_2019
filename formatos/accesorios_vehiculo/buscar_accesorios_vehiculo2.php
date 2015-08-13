<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>Accesorios<input type="hidden" name="bksaiacondicion_accesorio_vehiculo" id="bksaiacondicion_accesorio_vehiculo" value="like_total"></b><div id="esperando_accesorio_vehiculo"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_accesorio_vehiculo" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_accesorio_vehiculo.findItem(htmlentities(document.getElementById('stext_accesorio_vehiculo').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_accesorio_vehiculo.findItem(htmlentities(document.getElementById('stext_accesorio_vehiculo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_accesorio_vehiculo.findItem(htmlentities(document.getElementById('stext_accesorio_vehiculo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_accesorio_vehiculo" height=""></div><input type="hidden" maxlength="255"  name="g@accesorio_vehiculo" id="accesorio_vehiculo"   value="" ><label style="display:none" class="error" for="accesorio_vehiculo">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_accesorio_vehiculo=new dhtmlXTreeObject("treeboxbox_accesorio_vehiculo","","",0);
                			tree_accesorio_vehiculo.setImagePath("../../imgs/");
                			tree_accesorio_vehiculo.enableIEImageFix(true);tree_accesorio_vehiculo.enableCheckBoxes(1);
                    tree_accesorio_vehiculo.enableRadioButtons(true);tree_accesorio_vehiculo.setOnLoadingStart(cargando_accesorio_vehiculo);
                      tree_accesorio_vehiculo.setOnLoadingEnd(fin_cargando_accesorio_vehiculo);tree_accesorio_vehiculo.enableSmartXMLParsing(true);tree_accesorio_vehiculo.loadXML("../../test_serie.php?sin_padre=1&id=942&tabla=serie");
                      tree_accesorio_vehiculo.setOnCheckHandler(onNodeSelect_accesorio_vehiculo);
                      function onNodeSelect_accesorio_vehiculo(nodeId)
                      {valor_destino=document.getElementById("accesorio_vehiculo");
                       destinos=tree_accesorio_vehiculo.getAllChecked();
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
                      function fin_cargando_accesorio_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_accesorio_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_accesorio_vehiculo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_accesorio_vehiculo"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_accesorio_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_accesorio_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_accesorio_vehiculo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_accesorio_vehiculo"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_accesorio_vehiculo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_accesorio_vehiculo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_accesorio_vehiculo" id="bqsaiaenlace_accesorio_vehiculo" value="y" />
		</div></div></div><div class="control-group"><b>Valor del accesorio<input type="hidden" name="bksaiacondicion_g@valor_accesorio" id="bksaiacondicion_g@valor_accesorio" value="="></b><div class="controls"><input type="text" id="valor_accesorio" name="bqsaia_g@valor_accesorio"></div></div><input type="hidden" name="campos_especiales" value="accesorio_vehiculo@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_accesorios_vehiculo g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="accesorios_vehiculo"></body><input type="hidden" name="idbusqueda_componente" value="124">