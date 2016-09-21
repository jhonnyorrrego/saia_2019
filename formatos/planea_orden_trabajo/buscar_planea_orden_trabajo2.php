<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Planeaci&oacute;n de OT</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>Concepto<input type="hidden" name="bksaiacondicion_concepto_trabajo" id="bksaiacondicion_concepto_trabajo" value="like_total"></b><div id="esperando_concepto_trabajo"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_concepto_trabajo" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_concepto_trabajo.findItem(htmlentities(document.getElementById('stext_concepto_trabajo').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_concepto_trabajo.findItem(htmlentities(document.getElementById('stext_concepto_trabajo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_concepto_trabajo.findItem(htmlentities(document.getElementById('stext_concepto_trabajo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_concepto_trabajo" height=""></div><input type="hidden" maxlength="255"  name="g@concepto_trabajo" id="concepto_trabajo"   value="" ><label style="display:none" class="error" for="concepto_trabajo">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_concepto_trabajo=new dhtmlXTreeObject("treeboxbox_concepto_trabajo","","",0);
                			tree_concepto_trabajo.setImagePath("../../imgs/");
                			tree_concepto_trabajo.enableIEImageFix(true);tree_concepto_trabajo.enableCheckBoxes(1);
                    tree_concepto_trabajo.enableRadioButtons(true);tree_concepto_trabajo.setOnLoadingStart(cargando_concepto_trabajo);
                      tree_concepto_trabajo.setOnLoadingEnd(fin_cargando_concepto_trabajo);tree_concepto_trabajo.enableSmartXMLParsing(true);tree_concepto_trabajo.loadXML("../../test_serie.php?sin_padre=1&id=952&tabla=serie");
                      tree_concepto_trabajo.setOnCheckHandler(onNodeSelect_concepto_trabajo);
                      function onNodeSelect_concepto_trabajo(nodeId)
                      {valor_destino=document.getElementById("concepto_trabajo");
                       destinos=tree_concepto_trabajo.getAllChecked();
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
                      function fin_cargando_concepto_trabajo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_concepto_trabajo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_concepto_trabajo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_concepto_trabajo"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_concepto_trabajo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_concepto_trabajo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_concepto_trabajo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_concepto_trabajo"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_concepto_trabajo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_concepto_trabajo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_concepto_trabajo" id="bqsaiaenlace_concepto_trabajo" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion_orden" id="bksaiacondicion_g@descripcion_orden" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="descripcion_orden" name="bqsaia_g@descripcion_orden"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_orden',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_orden',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_orden" id="bqsaiaenlace_g@descripcion_orden" value="y" />
		</div></div></div><div class="control-group"><b>Cantidad<input type="hidden" name="bksaiacondicion_g@cantidad_solicitada" id="bksaiacondicion_g@cantidad_solicitada" value="="></b><div class="controls"><input type="text" id="cantidad_solicitada" name="bqsaia_g@cantidad_solicitada"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cantidad_solicitada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cantidad_solicitada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cantidad_solicitada" id="bqsaiaenlace_g@cantidad_solicitada" value="y" />
		</div></div></div><div class="control-group"><b>Costo<input type="hidden" name="bksaiacondicion_g@costo_trabajo" id="bksaiacondicion_g@costo_trabajo" value="="></b><div class="controls"><input type="text" id="costo_trabajo" name="bqsaia_g@costo_trabajo"></div></div><input type="hidden" name="campos_especiales" value="concepto_trabajo@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_planea_orden_trabajo g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="planea_orden_trabajo"></body>