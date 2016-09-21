<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Informe de recibido</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="bien_servicio"><b>Bien  o servicio<input type="hidden" name="bksaiacondicion_g@bien_servicio" id="bksaiacondicion_g@bien_servicio" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(237,2660,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@bien_servicio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@bien_servicio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@bien_servicio" id="bqsaiaenlace_g@bien_servicio" value="y" />
		</div></div></div><div class="control-group"><b>Cantidad<input type="hidden" name="bksaiacondicion_g@cantidad" id="bksaiacondicion_g@cantidad" value="like_total"></b><div class="controls"><input type="text" id="cantidad" name="bqsaia_g@cantidad"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cantidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cantidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cantidad" id="bqsaiaenlace_g@cantidad" value="y" />
		</div></div></div><div class="control-group"><b>Descrpci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea    id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion" id="bqsaiaenlace_g@descripcion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="califica_servicio"><b>Calificaci&oacute;n  del servicio<input type="hidden" name="bksaiacondicion_g@califica_servicio" id="bksaiacondicion_g@califica_servicio" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(237,2663,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@califica_servicio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@califica_servicio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@califica_servicio" id="bqsaiaenlace_g@califica_servicio" value="y" />
		</div></div></div><div class="control-group"><b>N&uacute;mero de la exte<input type="hidden" name="bksaiacondicion_g@numer_ext" id="bksaiacondicion_g@numer_ext" value="like_total"></b><div class="controls"><input type="text" id="numer_ext" name="bqsaia_g@numer_ext"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@numer_ext',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@numer_ext',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@numer_ext" id="bqsaiaenlace_g@numer_ext" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Otro autorizador del IR<input type="hidden" name="bksaiacondicion_otro_responsable" id="bksaiacondicion_otro_responsable" value="like_total"></b><div id="esperando_otro_responsable"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_otro_responsable" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_otro_responsable.findItem(htmlentities(document.getElementById('stext_otro_responsable').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_otro_responsable.findItem(htmlentities(document.getElementById('stext_otro_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_otro_responsable.findItem(htmlentities(document.getElementById('stext_otro_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_otro_responsable" height=""></div><input type="hidden" maxlength="255"  name="g@otro_responsable" id="otro_responsable"   value="" ><label style="display:none" class="error" for="otro_responsable">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_otro_responsable=new dhtmlXTreeObject("treeboxbox_otro_responsable","","",0);
                			tree_otro_responsable.setImagePath("../../imgs/");
                			tree_otro_responsable.enableIEImageFix(true);tree_otro_responsable.enableCheckBoxes(1);
                    tree_otro_responsable.enableRadioButtons(true);tree_otro_responsable.setOnLoadingStart(cargando_otro_responsable);
                      tree_otro_responsable.setOnLoadingEnd(fin_cargando_otro_responsable);tree_otro_responsable.enableSmartXMLParsing(true);tree_otro_responsable.loadXML("../../test.php?rol=1&sin_padre=44");
                      tree_otro_responsable.setOnCheckHandler(onNodeSelect_otro_responsable);
                      function onNodeSelect_otro_responsable(nodeId)
                      {valor_destino=document.getElementById("otro_responsable");
                       destinos=tree_otro_responsable.getAllChecked();
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
                      function fin_cargando_otro_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_otro_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_otro_responsable")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_otro_responsable"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_otro_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_otro_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_otro_responsable")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_otro_responsable"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_otro_responsable',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_otro_responsable',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_otro_responsable" id="bqsaiaenlace_otro_responsable" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="requiere_op"><b>Requerie OP<input type="hidden" name="bksaiacondicion_g@requiere_op" id="bksaiacondicion_g@requiere_op" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(237,2667,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@requiere_op',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@requiere_op',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@requiere_op" id="bqsaiaenlace_g@requiere_op" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Responsable OP<input type="hidden" name="bksaiacondicion_responsable_op" id="bksaiacondicion_responsable_op" value="like_total"></b><div id="esperando_responsable_op"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_responsable_op" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_responsable_op" height=""></div><input type="hidden" maxlength="255"  name="g@responsable_op" id="responsable_op"   value="" ><label style="display:none" class="error" for="responsable_op">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable_op=new dhtmlXTreeObject("treeboxbox_responsable_op","","",0);
                			tree_responsable_op.setImagePath("../../imgs/");
                			tree_responsable_op.enableIEImageFix(true);tree_responsable_op.enableCheckBoxes(1);
                    tree_responsable_op.enableRadioButtons(true);tree_responsable_op.setOnLoadingStart(cargando_responsable_op);
                      tree_responsable_op.setOnLoadingEnd(fin_cargando_responsable_op);tree_responsable_op.enableSmartXMLParsing(true);tree_responsable_op.loadXML("../../test.php?rol=1&sin_padre=44");
                      tree_responsable_op.setOnCheckHandler(onNodeSelect_responsable_op);
                      function onNodeSelect_responsable_op(nodeId)
                      {valor_destino=document.getElementById("responsable_op");
                       destinos=tree_responsable_op.getAllChecked();
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
                      function fin_cargando_responsable_op() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_op")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_op")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable_op"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_responsable_op() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_op")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_op")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable_op"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_responsable_op',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_responsable_op',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_responsable_op" id="bqsaiaenlace_responsable_op" value="y" />
		</div></div></div><div class="control-group"><b>Observacones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="otro_responsable@arbol,responsable_op@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_informe_recibo g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body>