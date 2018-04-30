<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Correo SAIA</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Asunto<input type="hidden" name="bksaiacondicion_g@asunto" id="bksaiacondicion_g@asunto" value="like_total"></b><div class="controls"><input type="text" id="asunto" name="bqsaia_g@asunto"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@asunto" id="bqsaiaenlace_g@asunto" value="y" />
		</div></div></div><div class="control-group"><b>Fecha Oficio Entrada<input type="hidden" name="bksaiacondicion_g@fecha_oficio_entrada" id="bksaiacondicion_g@fecha_oficio_entrada" value="like_total"></b><div class="controls"><input type="text" id="fecha_oficio_entrada" name="bqsaia_g@fecha_oficio_entrada"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha_oficio_entrada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha_oficio_entrada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha_oficio_entrada" id="bqsaiaenlace_g@fecha_oficio_entrada" value="y" />
		</div></div></div><div class="control-group"><b>De<input type="hidden" name="bksaiacondicion_g@de" id="bksaiacondicion_g@de" value="like_total"></b><div class="controls"><input type="text" id="de" name="bqsaia_g@de"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@de',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@de',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@de" id="bqsaiaenlace_g@de" value="y" />
		</div></div></div><div class="control-group"><b>Para<input type="hidden" name="bksaiacondicion_g@para" id="bksaiacondicion_g@para" value="like_total"></b><div class="controls"><input type="text" id="para" name="bqsaia_g@para"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@para',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@para',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@para" id="bqsaiaenlace_g@para" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Transferir<input type="hidden" name="bksaiacondicion_transferencia_correo" id="bksaiacondicion_transferencia_correo" value="="></b><div id="esperando_transferencia_correo"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_transferencia_correo" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_transferencia_correo.findItem((document.getElementById('stext_transferencia_correo').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_transferencia_correo.findItem((document.getElementById('stext_transferencia_correo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_transferencia_correo.findItem((document.getElementById('stext_transferencia_correo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_transferencia_correo" height=""></div><input type="hidden" maxlength="11"  name="g@transferencia_correo" id="transferencia_correo"   value="" ><label style="display:none" class="error" for="transferencia_correo">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_transferencia_correo=new dhtmlXTreeObject("treeboxbox_transferencia_correo","","",0);
                			tree_transferencia_correo.setImagePath("../../imgs/");
                			tree_transferencia_correo.enableIEImageFix(true);tree_transferencia_correo.enableCheckBoxes(1);
                    tree_transferencia_correo.enableRadioButtons(true);tree_transferencia_correo.setOnLoadingStart(cargando_transferencia_correo);
                      tree_transferencia_correo.setOnLoadingEnd(fin_cargando_transferencia_correo);tree_transferencia_correo.enableSmartXMLParsing(true);tree_transferencia_correo.loadXML("../../test.php?rol=1");
                      tree_transferencia_correo.setOnCheckHandler(onNodeSelect_transferencia_correo);
                      function onNodeSelect_transferencia_correo(nodeId)
                      {valor_destino=document.getElementById("transferencia_correo");
                       destinos=tree_transferencia_correo.getAllChecked();
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
                      function fin_cargando_transferencia_correo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_transferencia_correo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_transferencia_correo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_transferencia_correo"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_transferencia_correo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_transferencia_correo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_transferencia_correo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_transferencia_correo"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_transferencia_correo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_transferencia_correo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_transferencia_correo" id="bqsaiaenlace_transferencia_correo" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Con Copia<input type="hidden" name="bksaiacondicion_copia_correo" id="bksaiacondicion_copia_correo" value="like_total"></b><div id="esperando_copia_correo"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_copia_correo" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia_correo.findItem((document.getElementById('stext_copia_correo').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_correo.findItem((document.getElementById('stext_copia_correo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia_correo.findItem((document.getElementById('stext_copia_correo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_copia_correo" height=""></div><input type="hidden" maxlength="255"  name="g@copia_correo" id="copia_correo"   value="" ><label style="display:none" class="error" for="copia_correo">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_correo=new dhtmlXTreeObject("treeboxbox_copia_correo","","",0);
                			tree_copia_correo.setImagePath("../../imgs/");
                			tree_copia_correo.enableIEImageFix(true);tree_copia_correo.enableCheckBoxes(1);
                			tree_copia_correo.enableThreeStateCheckboxes(1);tree_copia_correo.setOnLoadingStart(cargando_copia_correo);
                      tree_copia_correo.setOnLoadingEnd(fin_cargando_copia_correo);tree_copia_correo.enableSmartXMLParsing(true);tree_copia_correo.loadXML("../../test.php?rol=1");
                      tree_copia_correo.setOnCheckHandler(onNodeSelect_copia_correo);
                      function onNodeSelect_copia_correo(nodeId)
                      {valor_destino=document.getElementById("copia_correo");
                       destinos=tree_copia_correo.getAllChecked();
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
                      function fin_cargando_copia_correo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_correo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_correo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_correo"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia_correo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_correo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_correo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_correo"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_copia_correo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_copia_correo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_copia_correo" id="bqsaiaenlace_copia_correo" value="y" />
		</div></div></div><div class="control-group"><b>Comentario<input type="hidden" name="bksaiacondicion_g@comentario" id="bksaiacondicion_g@comentario" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="comentario" name="bqsaia_g@comentario"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="transferencia_correo@arbol,copia_correo@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_correo_saia g @ AND  g.documento_iddocumento=iddocumento "></body>