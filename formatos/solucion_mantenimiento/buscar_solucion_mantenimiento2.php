<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend" style="font-size:9pt;">B&uacute;squeda en formato Soluci&oacute;n mantenimiento locativo</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo"><b>Tipo<input type="hidden" name="bksaiacondicion_tipo" id="bksaiacondicion_tipo" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(288,3325,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo" id="bqsaiaenlace_tipo" value="y" />
		</div></div></div><div class="control-group"><b>Nombre De Responsable<input type="hidden" name="bksaiacondicion_g@nombre_responsable" id="bksaiacondicion_g@nombre_responsable" value="like_total"></b><div class="controls"><input type="text" id="nombre_responsable" name="bqsaia_g@nombre_responsable"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_responsable',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_responsable',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_responsable" id="bqsaiaenlace_g@nombre_responsable" value="y" />
		</div></div></div><div class="control-group"><b>Breve Descripci&oacute;n Soluci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion_solucion" id="bksaiacondicion_g@descripcion_solucion" value="like_total"></b><div class="controls"><textarea    id="descripcion_solucion" name="bqsaia_g@descripcion_solucion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_solucion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_solucion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_solucion" id="bqsaiaenlace_g@descripcion_solucion" value="y" />
		</div></div></div><div class="control-group"><b>Pre-requisitos De Montaje<input type="hidden" name="bksaiacondicion_g@prerequisitos_montaje" id="bksaiacondicion_g@prerequisitos_montaje" value="like_total"></b><div class="controls"><textarea    id="prerequisitos_montaje" name="bqsaia_g@prerequisitos_montaje"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@prerequisitos_montaje',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@prerequisitos_montaje',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@prerequisitos_montaje" id="bqsaiaenlace_g@prerequisitos_montaje" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@observaciones" id="bqsaiaenlace_g@observaciones" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="anexos_solucion"><b>Anexos Soluci&oacute;n<input type="hidden" name="bksaiacondicion_g@anexos_solucion" id="bksaiacondicion_g@anexos_solucion" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(288,3330,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@anexos_solucion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@anexos_solucion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@anexos_solucion" id="bqsaiaenlace_g@anexos_solucion" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Implementado Por<input type="hidden" name="bksaiacondicion_implementado_por" id="bksaiacondicion_implementado_por" value="like_total"></b><div id="esperando_implementado_por"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_implementado_por" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_implementado_por.findItem(htmlentities(document.getElementById('stext_implementado_por').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_implementado_por.findItem(htmlentities(document.getElementById('stext_implementado_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_implementado_por.findItem(htmlentities(document.getElementById('stext_implementado_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_implementado_por" height=""></div><input type="hidden" maxlength="255"  name="g@implementado_por" id="implementado_por"   value="" ><label style="display:none" class="error" for="implementado_por">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_implementado_por=new dhtmlXTreeObject("treeboxbox_implementado_por","","",0);
                			tree_implementado_por.setImagePath("../../imgs/");
                			tree_implementado_por.enableIEImageFix(true);tree_implementado_por.enableCheckBoxes(1);
                    tree_implementado_por.enableRadioButtons(true);tree_implementado_por.setOnLoadingStart(cargando_implementado_por);
                      tree_implementado_por.setOnLoadingEnd(fin_cargando_implementado_por);tree_implementado_por.enableSmartXMLParsing(true);tree_implementado_por.loadXML("../../test.php?rol=1");
                      tree_implementado_por.setOnCheckHandler(onNodeSelect_implementado_por);
                      function onNodeSelect_implementado_por(nodeId)
                      {valor_destino=document.getElementById("implementado_por");
                       destinos=tree_implementado_por.getAllChecked();
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
                      function fin_cargando_implementado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_implementado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_implementado_por")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_implementado_por"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_implementado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_implementado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_implementado_por")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_implementado_por"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_implementado_por',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_implementado_por',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_implementado_por" id="bqsaiaenlace_implementado_por" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Aprobaci&oacute;n Log&iacute;stica<input type="hidden" name="bksaiacondicion_aprobacion_logistica" id="bksaiacondicion_aprobacion_logistica" value="like_total"></b><div id="esperando_aprobacion_logistica"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_aprobacion_logistica" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_aprobacion_logistica.findItem(htmlentities(document.getElementById('stext_aprobacion_logistica').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_aprobacion_logistica.findItem(htmlentities(document.getElementById('stext_aprobacion_logistica').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_aprobacion_logistica.findItem(htmlentities(document.getElementById('stext_aprobacion_logistica').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_aprobacion_logistica" height=""></div><input type="hidden" maxlength="255"  name="g@aprobacion_logistica" id="aprobacion_logistica"   value="" ><label style="display:none" class="error" for="aprobacion_logistica">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_aprobacion_logistica=new dhtmlXTreeObject("treeboxbox_aprobacion_logistica","","",0);
                			tree_aprobacion_logistica.setImagePath("../../imgs/");
                			tree_aprobacion_logistica.enableIEImageFix(true);tree_aprobacion_logistica.enableCheckBoxes(1);
                    tree_aprobacion_logistica.enableRadioButtons(true);tree_aprobacion_logistica.setOnLoadingStart(cargando_aprobacion_logistica);
                      tree_aprobacion_logistica.setOnLoadingEnd(fin_cargando_aprobacion_logistica);tree_aprobacion_logistica.enableSmartXMLParsing(true);tree_aprobacion_logistica.loadXML("../../test.php?rol=1");
                      tree_aprobacion_logistica.setOnCheckHandler(onNodeSelect_aprobacion_logistica);
                      function onNodeSelect_aprobacion_logistica(nodeId)
                      {valor_destino=document.getElementById("aprobacion_logistica");
                       destinos=tree_aprobacion_logistica.getAllChecked();
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
                      function fin_cargando_aprobacion_logistica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobacion_logistica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobacion_logistica")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_aprobacion_logistica"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_aprobacion_logistica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobacion_logistica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobacion_logistica")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_aprobacion_logistica"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="implementado_por@arbol,aprobacion_logistica@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solucion_mantenimiento g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="idbusqueda_componente" value="176">