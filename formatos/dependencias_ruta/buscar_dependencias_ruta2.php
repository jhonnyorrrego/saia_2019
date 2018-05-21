<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Dependencias de la Ruta</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_item_dependenc"><b>Fecha<input type="hidden" name="bksaiacondicion_fecha_item_dependenc" id="bksaiacondicion_fecha_item_dependenc" value="like_total"></b></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="fecha_item_dependenc_1" style="width: 100px;" id="fecha_item_dependenc_1" value=""><?php selector_fecha("fecha_item_dependenc_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_item_dependenc_2" style="width: 100px;" id="fecha_item_dependenc_2" value=""><?php selector_fecha("fecha_item_dependenc_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_item_dependenc',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_item_dependenc',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_item_dependenc" id="bqsaiaenlace_fecha_item_dependenc" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Dependencia<input type="hidden" name="bksaiacondicion_dependencia_asignada" id="bksaiacondicion_dependencia_asignada" value="like_total"></b><div id="esperando_dependencia_asignada"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_dependencia_asignada" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_dependencia_asignada.findItem((document.getElementById('stext_dependencia_asignada').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_dependencia_asignada" height=""></div><input type="hidden" maxlength="255"  name="g@dependencia_asignada" id="dependencia_asignada"   value="" ><label style="display:none" class="error" for="dependencia_asignada">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_dependencia_asignada=new dhtmlXTreeObject("treeboxbox_dependencia_asignada","","",0);
                			tree_dependencia_asignada.setImagePath("../../imgs/");
                			tree_dependencia_asignada.enableIEImageFix(true);tree_dependencia_asignada.enableCheckBoxes(1);
                    tree_dependencia_asignada.enableRadioButtons(true);tree_dependencia_asignada.setOnLoadingStart(cargando_dependencia_asignada);
                      tree_dependencia_asignada.setOnLoadingEnd(fin_cargando_dependencia_asignada);tree_dependencia_asignada.enableSmartXMLParsing(true);tree_dependencia_asignada.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_dependencia_asignada.setOnCheckHandler(onNodeSelect_dependencia_asignada);
                      function onNodeSelect_dependencia_asignada(nodeId)
                      {valor_destino=document.getElementById("dependencia_asignada");
                       destinos=tree_dependencia_asignada.getAllChecked();
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
                      function fin_cargando_dependencia_asignada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencia_asignada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencia_asignada")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_dependencia_asignada"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_dependencia_asignada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencia_asignada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencia_asignada")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_dependencia_asignada"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_dependencia_asignada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_dependencia_asignada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_dependencia_asignada" id="bqsaiaenlace_dependencia_asignada" value="y" />
		</div></div></div><div class="control-group"><b>Descripción<input type="hidden" name="bksaiacondicion_g@descripcion_dependen" id="bksaiacondicion_g@descripcion_dependen" value="like_total"></b><div class="controls"><textarea    id="descripcion_dependen" name="bqsaia_g@descripcion_dependen"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="dependencia_asignada@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_dependencias_ruta g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="dependencias_ruta"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|">