<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend" style="font-size:9pt;">B&uacute;squeda en formato Orden de compra</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_orden_compra"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_orden_compra_x" id="bksaiacondicion_g@fecha_orden_compra_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_orden_compra_x" id="fecha_orden_compra_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_orden_compra_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_orden_compra_y" id="bksaiacondicion_g@fecha_orden_compra_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_orden_compra_y" id="fecha_orden_compra_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_orden_compra_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_orden_compra',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_orden_compra',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_orden_compra" id="bqsaiaenlace_fecha_orden_compra" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Origen De Recursos<input type="hidden" name="bksaiacondicion_origen_recursos" id="bksaiacondicion_origen_recursos" value="like_total"></b><div id="esperando_origen_recursos"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_origen_recursos" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_origen_recursos.findItem(htmlentities(document.getElementById('stext_origen_recursos').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_origen_recursos.findItem(htmlentities(document.getElementById('stext_origen_recursos').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_origen_recursos.findItem(htmlentities(document.getElementById('stext_origen_recursos').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_origen_recursos" height=""></div><input type="hidden" maxlength="255"  name="g@origen_recursos" id="origen_recursos"   value="" ><label style="display:none" class="error" for="origen_recursos">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_origen_recursos=new dhtmlXTreeObject("treeboxbox_origen_recursos","","",0);
                			tree_origen_recursos.setImagePath("../../imgs/");
                			tree_origen_recursos.enableIEImageFix(true);tree_origen_recursos.enableCheckBoxes(1);
                    tree_origen_recursos.enableRadioButtons(true);tree_origen_recursos.setOnLoadingStart(cargando_origen_recursos);
                      tree_origen_recursos.setOnLoadingEnd(fin_cargando_origen_recursos);tree_origen_recursos.enableSmartXMLParsing(true);tree_origen_recursos.loadXML("../../test_serie.php?tabla=serie&id=1021");
                      tree_origen_recursos.setOnCheckHandler(onNodeSelect_origen_recursos);
                      function onNodeSelect_origen_recursos(nodeId)
                      {valor_destino=document.getElementById("origen_recursos");
                       destinos=tree_origen_recursos.getAllChecked();
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
                      function fin_cargando_origen_recursos() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_origen_recursos")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_origen_recursos")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_origen_recursos"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_origen_recursos() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_origen_recursos")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_origen_recursos")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_origen_recursos"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_origen_recursos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_origen_recursos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_origen_recursos" id="bqsaiaenlace_origen_recursos" value="y" />
		</div></div></div><div class="control-group"><b>Lugar De Entrega<input type="hidden" name="bksaiacondicion_g@lugar_entrega" id="bksaiacondicion_g@lugar_entrega" value="like_total"></b><div class="controls"><input type="text" id="lugar_entrega" name="bqsaia_g@lugar_entrega"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@lugar_entrega',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@lugar_entrega',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@lugar_entrega" id="bqsaiaenlace_g@lugar_entrega" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_entrega"><b>Fecha De Entrega</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_entrega_x" id="bksaiacondicion_g@fecha_entrega_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_entrega_x" id="fecha_entrega_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_entrega_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_entrega_y" id="bksaiacondicion_g@fecha_entrega_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_entrega_y" id="fecha_entrega_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_entrega_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_entrega',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_entrega',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_entrega" id="bqsaiaenlace_fecha_entrega" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones De Entrega<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea  maxlength="4000"   id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="origen_recursos@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_orden_compra g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_orden_compra_x,g@fecha_orden_compra_y,g@fecha_entrega_x,g@fecha_entrega_y"><input type="hidden" name="idbusqueda_componente" value="192">