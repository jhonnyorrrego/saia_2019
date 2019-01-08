<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato 1. Valoracion Controles Riesgos</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Consecutivo<input type="hidden" name="bksaiacondicion_g@consecutivo_control" id="bksaiacondicion_g@consecutivo_control" value="like_total"></b><div class="controls"><input type="text" id="consecutivo_control" name="bqsaia_g@consecutivo_control"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@consecutivo_control',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@consecutivo_control',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@consecutivo_control" id="bqsaiaenlace_g@consecutivo_control" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_valoracion"><b>Fecha valoracion</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_valoracion_x" id="bksaiacondicion_g@fecha_valoracion_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_valoracion_x" id="fecha_valoracion_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_valoracion_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_valoracion_y" id="bksaiacondicion_g@fecha_valoracion_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_valoracion_y" id="fecha_valoracion_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_valoracion_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_valoracion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_valoracion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_valoracion" id="bqsaiaenlace_fecha_valoracion" value="y" />
		</div></div></div><div class="control-group"><b>DESCRIPCION DEL CONTROL EXISTENTE<input type="hidden" name="bksaiacondicion_g@descripcion_control" id="bksaiacondicion_g@descripcion_control" value="like_total"></b><div class="controls"><textarea    id="descripcion_control" name="bqsaia_g@descripcion_control"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_control',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_control',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_control" id="bqsaiaenlace_g@descripcion_control" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_control"><b>El control afecta?<input type="hidden" name="bksaiacondicion_g@tipo_control" id="bksaiacondicion_g@tipo_control" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(500,6388,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_control',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_control',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_control" id="bqsaiaenlace_g@tipo_control" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="herramientas_ejercer"><b>Herramientas para ejercer el control<input type="hidden" name="bksaiacondicion_herramientas_ejercer" id="bksaiacondicion_herramientas_ejercer" value="like_total"></b></label></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="herramienta_ejercer"><b>1. Posee una herramienta para ejercer el control?<input type="hidden" name="bksaiacondicion_g@herramienta_ejercer" id="bksaiacondicion_g@herramienta_ejercer" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(500,6393,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@herramienta_ejercer',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@herramienta_ejercer',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@herramienta_ejercer" id="bqsaiaenlace_g@herramienta_ejercer" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n de la Herramienta<input type="hidden" name="bksaiacondicion_g@desc_herramienta" id="bksaiacondicion_g@desc_herramienta" value="like_total"></b><div class="controls"><textarea    id="desc_herramienta" name="bqsaia_g@desc_herramienta"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@desc_herramienta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@desc_herramienta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@desc_herramienta" id="bqsaiaenlace_g@desc_herramienta" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="procedimiento_herram"><b>2. Existen manuales, instructivos o procedimientos para el manejo de la herramienta?<input type="hidden" name="bksaiacondicion_g@procedimiento_herram" id="bksaiacondicion_g@procedimiento_herram" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(500,6396,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@procedimiento_herram',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@procedimiento_herram',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@procedimiento_herram" id="bqsaiaenlace_g@procedimiento_herram" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n del documento<input type="hidden" name="bksaiacondicion_g@desc_documento" id="bksaiacondicion_g@desc_documento" value="like_total"></b><div class="controls"><textarea    id="desc_documento" name="bqsaia_g@desc_documento"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@desc_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@desc_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@desc_documento" id="bqsaiaenlace_g@desc_documento" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="herramienta_efectiva"><b>3. En el tiempo que lleva la herramienta, ha demostrado ser efectiva?<input type="hidden" name="bksaiacondicion_g@herramienta_efectiva" id="bksaiacondicion_g@herramienta_efectiva" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(500,6399,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@herramienta_efectiva',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@herramienta_efectiva',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@herramienta_efectiva" id="bqsaiaenlace_g@herramienta_efectiva" value="y" />
		</div></div></div><div class="control-group"><b>Por qu&eacute;?<input type="hidden" name="bksaiacondicion_g@pregunta_porque" id="bksaiacondicion_g@pregunta_porque" value="like_total"></b><div class="controls"><textarea    id="pregunta_porque" name="bqsaia_g@pregunta_porque"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@pregunta_porque',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@pregunta_porque',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@pregunta_porque" id="bqsaiaenlace_g@pregunta_porque" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="seguimiento_al_contr"><b>SEGUIMIENTO AL CONTROL<input type="hidden" name="bksaiacondicion_seguimiento_al_contr" id="bksaiacondicion_seguimiento_al_contr" value="like_total"></b></label></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="responsables_ejecuci"><b>4. Estan definidos los responsables de la ejecucion del control y del seguimiento?<input type="hidden" name="bksaiacondicion_g@responsables_ejecuci" id="bksaiacondicion_g@responsables_ejecuci" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(500,6402,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@responsables_ejecuci',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@responsables_ejecuci',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@responsables_ejecuci" id="bqsaiaenlace_g@responsables_ejecuci" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>QUIEN ES EL RESPONSABLES DE LA EJECUCI&Oacute;N DEL CONTROL<input type="hidden" name="bksaiacondicion_responsable_seg" id="bksaiacondicion_responsable_seg" value="like_total"></b><div id="esperando_responsable_seg"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_responsable_seg" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable_seg.findItem((document.getElementById('stext_responsable_seg').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable_seg.findItem((document.getElementById('stext_responsable_seg').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable_seg.findItem((document.getElementById('stext_responsable_seg').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_responsable_seg" height=""></div><input type="hidden" maxlength="255"  name="g@responsable_seg" id="responsable_seg"   value="" ><label style="display:none" class="error" for="responsable_seg">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable_seg=new dhtmlXTreeObject("treeboxbox_responsable_seg","","",0);
                			tree_responsable_seg.setImagePath("../../imgs/");
                			tree_responsable_seg.enableIEImageFix(true);tree_responsable_seg.enableCheckBoxes(1);
                			tree_responsable_seg.enableThreeStateCheckboxes(1);tree_responsable_seg.setOnLoadingStart(cargando_responsable_seg);
                      tree_responsable_seg.setOnLoadingEnd(fin_cargando_responsable_seg);tree_responsable_seg.enableSmartXMLParsing(true);tree_responsable_seg.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_responsable_seg.setOnCheckHandler(onNodeSelect_responsable_seg);
                      function onNodeSelect_responsable_seg(nodeId)
                      {valor_destino=document.getElementById("responsable_seg");
                       destinos=tree_responsable_seg.getAllChecked();
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
                      function fin_cargando_responsable_seg() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_seg")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_seg")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable_seg"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_responsable_seg() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_seg")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_seg")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable_seg"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_responsable_seg',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_responsable_seg',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_responsable_seg" id="bqsaiaenlace_responsable_seg" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>QUIEN ES EL RESPONSABLES DE LA EJECUCI&Oacute;N DEL SEGUIMIENTO<input type="hidden" name="bksaiacondicion_respon_seguimiento" id="bksaiacondicion_respon_seguimiento" value="like_total"></b><div id="esperando_respon_seguimiento"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_respon_seguimiento" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_respon_seguimiento.findItem((document.getElementById('stext_respon_seguimiento').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_respon_seguimiento.findItem((document.getElementById('stext_respon_seguimiento').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_respon_seguimiento.findItem((document.getElementById('stext_respon_seguimiento').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_respon_seguimiento" height=""></div><input type="hidden" maxlength="255"  name="g@respon_seguimiento" id="respon_seguimiento"   value="" ><label style="display:none" class="error" for="respon_seguimiento">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_respon_seguimiento=new dhtmlXTreeObject("treeboxbox_respon_seguimiento","","",0);
                			tree_respon_seguimiento.setImagePath("../../imgs/");
                			tree_respon_seguimiento.enableIEImageFix(true);tree_respon_seguimiento.enableCheckBoxes(1);
                			tree_respon_seguimiento.enableThreeStateCheckboxes(1);tree_respon_seguimiento.setOnLoadingStart(cargando_respon_seguimiento);
                      tree_respon_seguimiento.setOnLoadingEnd(fin_cargando_respon_seguimiento);tree_respon_seguimiento.enableSmartXMLParsing(true);tree_respon_seguimiento.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_respon_seguimiento.setOnCheckHandler(onNodeSelect_respon_seguimiento);
                      function onNodeSelect_respon_seguimiento(nodeId)
                      {valor_destino=document.getElementById("respon_seguimiento");
                       destinos=tree_respon_seguimiento.getAllChecked();
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
                      function fin_cargando_respon_seguimiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_respon_seguimiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_respon_seguimiento")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_respon_seguimiento"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_respon_seguimiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_respon_seguimiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_respon_seguimiento")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_respon_seguimiento"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_respon_seguimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_respon_seguimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_respon_seguimiento" id="bqsaiaenlace_respon_seguimiento" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="frecuencia_ejecucion"><b>5. La frecuencia de la ejecucion del control y seguimiento es adecuado?<input type="hidden" name="bksaiacondicion_g@frecuencia_ejecucion" id="bksaiacondicion_g@frecuencia_ejecucion" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(500,6405,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@frecuencia_ejecucion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@frecuencia_ejecucion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@frecuencia_ejecucion" id="bqsaiaenlace_g@frecuencia_ejecucion" value="y" />
		</div></div></div><div class="control-group"><b>Cual es la frecuencia<input type="hidden" name="bksaiacondicion_g@cual_frecuencia" id="bksaiacondicion_g@cual_frecuencia" value="like_total"></b><div class="controls"><textarea    id="cual_frecuencia" name="bqsaia_g@cual_frecuencia"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="responsable_seg@arbol,respon_seguimiento@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_control_riesgos g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_valoracion_x,g@fecha_valoracion_y">