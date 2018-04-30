<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Solicitud de elaboraci&oacute;n, modificaci&oacute;n, eliminaci&oacute;n de documentos</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado_doc_calidad"><b>Estado<input type="hidden" name="bksaiacondicion_g@estado_doc_calidad" id="bksaiacondicion_g@estado_doc_calidad" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(498,6599,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@estado_doc_calidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@estado_doc_calidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@estado_doc_calidad" id="bqsaiaenlace_g@estado_doc_calidad" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_solicitud"><b>Tipo solicitud<input type="hidden" name="bksaiacondicion_g@tipo_solicitud" id="bksaiacondicion_g@tipo_solicitud" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(498,6332,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_solicitud" id="bqsaiaenlace_g@tipo_solicitud" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Dependencias Participantes<input type="hidden" name="bksaiacondicion_secretaria" id="bksaiacondicion_secretaria" value="like_total"></b><div id="esperando_secretaria"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_secretaria" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_secretaria.findItem((document.getElementById('stext_secretaria').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_secretaria.findItem((document.getElementById('stext_secretaria').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_secretaria.findItem((document.getElementById('stext_secretaria').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_secretaria" height=""></div><input type="hidden" maxlength="255"  name="g@secretaria" id="secretaria"   value="" ><label style="display:none" class="error" for="secretaria">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_secretaria=new dhtmlXTreeObject("treeboxbox_secretaria","","",0);
                			tree_secretaria.setImagePath("../../imgs/");
                			tree_secretaria.enableIEImageFix(true);tree_secretaria.enableCheckBoxes(1);
                			tree_secretaria.enableThreeStateCheckboxes(1);tree_secretaria.setOnLoadingStart(cargando_secretaria);
                      tree_secretaria.setOnLoadingEnd(fin_cargando_secretaria);tree_secretaria.enableSmartXMLParsing(true);tree_secretaria.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_secretaria.setOnCheckHandler(onNodeSelect_secretaria);
                      function onNodeSelect_secretaria(nodeId)
                      {valor_destino=document.getElementById("secretaria");
                       destinos=tree_secretaria.getAllChecked();
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
                      function fin_cargando_secretaria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_secretaria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_secretaria")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_secretaria"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_secretaria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_secretaria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_secretaria")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_secretaria"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_secretaria',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_secretaria',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_secretaria" id="bqsaiaenlace_secretaria" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="listado_procesos"><b>Proceso/Subproceso<input type="hidden" name="bksaiacondicion_g@listado_procesos" id="bksaiacondicion_g@listado_procesos" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(498,6334,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_listado_procesos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_listado_procesos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_listado_procesos" id="bqsaiaenlace_listado_procesos" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_documento"><b>tipo documento<input type="hidden" name="bksaiacondicion_g@tipo_documento" id="bksaiacondicion_g@tipo_documento" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(498,6338,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_documento" id="bqsaiaenlace_g@tipo_documento" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Serie documental<input type="hidden" name="bksaiacondicion_serie_doc_control" id="bksaiacondicion_serie_doc_control" value="like_total"></b><div id="esperando_serie_doc_control"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_serie_doc_control" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_serie_doc_control.findItem((document.getElementById('stext_serie_doc_control').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_serie_doc_control.findItem((document.getElementById('stext_serie_doc_control').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_serie_doc_control.findItem((document.getElementById('stext_serie_doc_control').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_serie_doc_control" height=""></div><input type="hidden" maxlength="255"  name="g@serie_doc_control" id="serie_doc_control"   value="" ><label style="display:none" class="error" for="serie_doc_control">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_serie_doc_control=new dhtmlXTreeObject("treeboxbox_serie_doc_control","","",0);
                			tree_serie_doc_control.setImagePath("../../imgs/");
                			tree_serie_doc_control.enableIEImageFix(true);tree_serie_doc_control.enableCheckBoxes(1);
                    tree_serie_doc_control.enableRadioButtons(true);tree_serie_doc_control.setOnLoadingStart(cargando_serie_doc_control);
                      tree_serie_doc_control.setOnLoadingEnd(fin_cargando_serie_doc_control);tree_serie_doc_control.enableSmartXMLParsing(true);tree_serie_doc_control.loadXML("../../test_serie_funcionario.php");
                      tree_serie_doc_control.setOnCheckHandler(onNodeSelect_serie_doc_control);
                      function onNodeSelect_serie_doc_control(nodeId)
                      {valor_destino=document.getElementById("serie_doc_control");
                       destinos=tree_serie_doc_control.getAllChecked();
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
                      function fin_cargando_serie_doc_control() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie_doc_control")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie_doc_control")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_serie_doc_control"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_serie_doc_control() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie_doc_control")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie_doc_control")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_serie_doc_control"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_doc_control',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_doc_control',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_doc_control" id="bqsaiaenlace_serie_doc_control" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="otros_documentos"><b>Otros documentos<input type="hidden" name="bksaiacondicion_g@otros_documentos" id="bksaiacondicion_g@otros_documentos" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(498,6340,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@otros_documentos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@otros_documentos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@otros_documentos" id="bqsaiaenlace_g@otros_documentos" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="almacenamiento"><b>almacenamiento<input type="hidden" name="bksaiacondicion_almacenamiento" id="bksaiacondicion_almacenamiento" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(498,6341,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_almacenamiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_almacenamiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_almacenamiento" id="bqsaiaenlace_almacenamiento" value="y" />
		</div></div></div><div class="control-group"><b>nombre documento<input type="hidden" name="bksaiacondicion_g@nombre_documento" id="bksaiacondicion_g@nombre_documento" value="like_total"></b><div class="controls"><input type="text" id="nombre_documento" name="bqsaia_g@nombre_documento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_documento" id="bqsaiaenlace_g@nombre_documento" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Documento de Calidad Vinculado<input type="hidden" name="bksaiacondicion_documento_calidad" id="bksaiacondicion_documento_calidad" value="like_total"></b><div id="esperando_documento_calidad"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_documento_calidad" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_documento_calidad" height=""></div><input type="hidden"  name="g@documento_calidad" id="documento_calidad"   value="" ><label style="display:none" class="error" for="documento_calidad">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_documento_calidad=new dhtmlXTreeObject("treeboxbox_documento_calidad","","",0);
                			tree_documento_calidad.setImagePath("../../imgs/");
                			tree_documento_calidad.enableIEImageFix(true);tree_documento_calidad.enableCheckBoxes(1);
                    tree_documento_calidad.enableRadioButtons(true);tree_documento_calidad.setOnLoadingStart(cargando_documento_calidad);
                      tree_documento_calidad.setOnLoadingEnd(fin_cargando_documento_calidad);tree_documento_calidad.enableSmartXMLParsing(true);tree_documento_calidad.loadXML("test_documentos_calidad.php");
                      tree_documento_calidad.setOnCheckHandler(onNodeSelect_documento_calidad);
                      function onNodeSelect_documento_calidad(nodeId)
                      {valor_destino=document.getElementById("documento_calidad");
                       destinos=tree_documento_calidad.getAllChecked();
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
                      function fin_cargando_documento_calidad() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_documento_calidad")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_documento_calidad")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_documento_calidad"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_documento_calidad() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_documento_calidad")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_documento_calidad")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_documento_calidad"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_documento_calidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_documento_calidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_documento_calidad" id="bqsaiaenlace_documento_calidad" value="y" />
		</div></div></div><div class="control-group"><b>justificacion<input type="hidden" name="bksaiacondicion_g@justificacion" id="bksaiacondicion_g@justificacion" value="like_total"></b><div class="controls"><textarea  maxlength="6000"   id="justificacion" name="bqsaia_g@justificacion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@justificacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@justificacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@justificacion" id="bqsaiaenlace_g@justificacion" value="y" />
		</div></div></div><div class="control-group"><b>propuesta<input type="hidden" name="bksaiacondicion_g@propuesta" id="bksaiacondicion_g@propuesta" value="like_total"></b><div class="controls"><textarea    id="propuesta" name="bqsaia_g@propuesta"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@propuesta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@propuesta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@propuesta" id="bqsaiaenlace_g@propuesta" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>revisado por<input type="hidden" name="bksaiacondicion_revisado" id="bksaiacondicion_revisado" value="like_total"></b><div id="esperando_revisado"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_revisado" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_revisado" height=""></div><input type="hidden" maxlength="255"  name="g@revisado" id="revisado"   value="" ><label style="display:none" class="error" for="revisado">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_revisado=new dhtmlXTreeObject("treeboxbox_revisado","","",0);
                			tree_revisado.setImagePath("../../imgs/");
                			tree_revisado.enableIEImageFix(true);tree_revisado.enableCheckBoxes(1);
                    tree_revisado.enableRadioButtons(true);tree_revisado.setOnLoadingStart(cargando_revisado);
                      tree_revisado.setOnLoadingEnd(fin_cargando_revisado);tree_revisado.enableSmartXMLParsing(true);tree_revisado.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_revisado.setOnCheckHandler(onNodeSelect_revisado);
                      function onNodeSelect_revisado(nodeId)
                      {valor_destino=document.getElementById("revisado");
                       destinos=tree_revisado.getAllChecked();
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
                      function fin_cargando_revisado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_revisado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_revisado")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_revisado"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_revisado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_revisado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_revisado")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_revisado"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_revisado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_revisado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_revisado" id="bqsaiaenlace_revisado" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>aprobado por<input type="hidden" name="bksaiacondicion_aprobado" id="bksaiacondicion_aprobado" value="like_total"></b><div id="esperando_aprobado"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_aprobado" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_aprobado" height=""></div><input type="hidden" maxlength="255"  name="g@aprobado" id="aprobado"   value="" ><label style="display:none" class="error" for="aprobado">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_aprobado=new dhtmlXTreeObject("treeboxbox_aprobado","","",0);
                			tree_aprobado.setImagePath("../../imgs/");
                			tree_aprobado.enableIEImageFix(true);tree_aprobado.enableCheckBoxes(1);
                    tree_aprobado.enableRadioButtons(true);tree_aprobado.setOnLoadingStart(cargando_aprobado);
                      tree_aprobado.setOnLoadingEnd(fin_cargando_aprobado);tree_aprobado.enableSmartXMLParsing(true);tree_aprobado.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_aprobado.setOnCheckHandler(onNodeSelect_aprobado);
                      function onNodeSelect_aprobado(nodeId)
                      {valor_destino=document.getElementById("aprobado");
                       destinos=tree_aprobado.getAllChecked();
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
                      function fin_cargando_aprobado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobado")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_aprobado"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_aprobado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobado")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_aprobado"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="secretaria@arbol,serie_doc_control@arbol,documento_calidad@arbol,revisado@arbol,aprobado@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_control_documentos g @ AND  g.documento_iddocumento=iddocumento "></body>