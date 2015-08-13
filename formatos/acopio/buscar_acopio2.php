<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato 3. Acopio</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>Tipo de acopio<input type="hidden" name="bksaiacondicion_tipo_acopio" id="bksaiacondicion_tipo_acopio" value="="></b><div id="esperando_tipo_acopio"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_tipo_acopio" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_tipo_acopio.findItem(htmlentities(document.getElementById('stext_tipo_acopio').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_tipo_acopio.findItem(htmlentities(document.getElementById('stext_tipo_acopio').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_tipo_acopio.findItem(htmlentities(document.getElementById('stext_tipo_acopio').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_tipo_acopio" height=""></div><input type="hidden" maxlength="11"  name="g@tipo_acopio" id="tipo_acopio"   value="" ><label style="display:none" class="error" for="tipo_acopio">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_tipo_acopio=new dhtmlXTreeObject("treeboxbox_tipo_acopio","","",0);
                			tree_tipo_acopio.setImagePath("../../imgs/");
                			tree_tipo_acopio.enableIEImageFix(true);tree_tipo_acopio.enableCheckBoxes(1);
                    tree_tipo_acopio.enableRadioButtons(true);tree_tipo_acopio.setOnLoadingStart(cargando_tipo_acopio);
                      tree_tipo_acopio.setOnLoadingEnd(fin_cargando_tipo_acopio);tree_tipo_acopio.enableSmartXMLParsing(true);tree_tipo_acopio.loadXML("../../test_serie.php?tabla=serie&id=1083");
                      tree_tipo_acopio.setOnCheckHandler(onNodeSelect_tipo_acopio);
                      function onNodeSelect_tipo_acopio(nodeId)
                      {valor_destino=document.getElementById("tipo_acopio");
                       destinos=tree_tipo_acopio.getAllChecked();
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
                      function fin_cargando_tipo_acopio() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_acopio")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_acopio")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_tipo_acopio"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_tipo_acopio() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_acopio")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_acopio")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_tipo_acopio"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_acopio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_acopio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_acopio" id="bqsaiaenlace_tipo_acopio" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado_acopio"><b>Estado de acopio<input type="hidden" name="bksaiacondicion_g@estado_acopio" id="bksaiacondicion_g@estado_acopio" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(322,3772,'',1,'buscar');?></div></div><input type="hidden" name="campos_especiales" value="tipo_acopio@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_acopio g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="idbusqueda_componente" value="">