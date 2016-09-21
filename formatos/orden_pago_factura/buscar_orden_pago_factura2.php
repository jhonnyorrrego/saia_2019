<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Orden de Pago</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>Tipo Gasto<input type="hidden" name="bksaiacondicion_tipo_gasto" id="bksaiacondicion_tipo_gasto" value="like_total"></b><div id="esperando_tipo_gasto"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_tipo_gasto" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_tipo_gasto.findItem(htmlentities(document.getElementById('stext_tipo_gasto').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_tipo_gasto.findItem(htmlentities(document.getElementById('stext_tipo_gasto').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_tipo_gasto.findItem(htmlentities(document.getElementById('stext_tipo_gasto').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_tipo_gasto" height=""></div><input type="hidden"  name="g@tipo_gasto" id="tipo_gasto"   value="" ><label style="display:none" class="error" for="tipo_gasto">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_tipo_gasto=new dhtmlXTreeObject("treeboxbox_tipo_gasto","","",0);
                			tree_tipo_gasto.setImagePath("../../imgs/");
                			tree_tipo_gasto.enableIEImageFix(true);tree_tipo_gasto.enableCheckBoxes(1);
                    tree_tipo_gasto.enableRadioButtons(true);tree_tipo_gasto.setOnLoadingStart(cargando_tipo_gasto);
                      tree_tipo_gasto.setOnLoadingEnd(fin_cargando_tipo_gasto);tree_tipo_gasto.enableSmartXMLParsing(true);tree_tipo_gasto.loadXML("../../test_serie.php?tabla=serie&id=1029&sin_padre=1");
                      tree_tipo_gasto.setOnCheckHandler(onNodeSelect_tipo_gasto);
                      function onNodeSelect_tipo_gasto(nodeId)
                      {valor_destino=document.getElementById("tipo_gasto");
                       destinos=tree_tipo_gasto.getAllChecked();
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
                      function fin_cargando_tipo_gasto() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_gasto")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_gasto")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_tipo_gasto"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_tipo_gasto() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_gasto")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_gasto")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_tipo_gasto"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_gasto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_gasto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_gasto" id="bqsaiaenlace_tipo_gasto" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="calificacion"><b>Calificacon Servicio<input type="hidden" name="bksaiacondicion_g@calificacion" id="bksaiacondicion_g@calificacion" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(303,3539,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@calificacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@calificacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@calificacion" id="bqsaiaenlace_g@calificacion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="urgencia_pago"><b>Urgencia Pago<input type="hidden" name="bksaiacondicion_g@urgencia_pago" id="bksaiacondicion_g@urgencia_pago" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(303,3544,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@urgencia_pago',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@urgencia_pago',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@urgencia_pago" id="bqsaiaenlace_g@urgencia_pago" value="y" />
		</div></div></div><div class="control-group"><b>observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="tipo_gasto@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_orden_pago_factura g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body>