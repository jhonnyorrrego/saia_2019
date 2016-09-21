<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato SOLICITUD DE MANTENIMIENTO LOCATIVO</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_elaboracion"><b>Fecha de elaboraci&oacute;n</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_elaboracion_x" id="bksaiacondicion_g@fecha_elaboracion_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_elaboracion_x" id="fecha_elaboracion_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_elaboracion_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_elaboracion_y" id="bksaiacondicion_g@fecha_elaboracion_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_elaboracion_y" id="fecha_elaboracion_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_elaboracion_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_elaboracion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_elaboracion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_elaboracion" id="bqsaiaenlace_fecha_elaboracion" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n detallada del requerimiento<input type="hidden" name="bksaiacondicion_g@describe_requerimiento" id="bksaiacondicion_g@describe_requerimiento" value="like_total"></b><div class="controls"><textarea    id="describe_requerimiento" name="bqsaia_g@describe_requerimiento"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@describe_requerimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@describe_requerimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@describe_requerimiento" id="bqsaiaenlace_g@describe_requerimiento" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_solucion"><b>Fecha esperada de soluci&oacute;n</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_solucion_x" id="bksaiacondicion_g@fecha_solucion_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_solucion_x" id="fecha_solucion_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_solucion_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_solucion_y" id="bksaiacondicion_g@fecha_solucion_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_solucion_y" id="fecha_solucion_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_solucion_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_solucion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_solucion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_solucion" id="bqsaiaenlace_fecha_solucion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="prioridad"><b>Prioridad<input type="hidden" name="bksaiacondicion_g@prioridad" id="bksaiacondicion_g@prioridad" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(287,3306,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@prioridad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@prioridad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@prioridad" id="bqsaiaenlace_g@prioridad" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="soportes_anexos"><b>Soportes anexos<input type="hidden" name="bksaiacondicion_g@soportes_anexos" id="bksaiacondicion_g@soportes_anexos" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(287,3307,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@soportes_anexos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@soportes_anexos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@soportes_anexos" id="bqsaiaenlace_g@soportes_anexos" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Jefe del &aacute;rea<input type="hidden" name="bksaiacondicion_jefe_area" id="bksaiacondicion_jefe_area" value="like_total"></b><div id="esperando_jefe_area"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_jefe_area" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_jefe_area.findItem(htmlentities(document.getElementById('stext_jefe_area').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_jefe_area.findItem(htmlentities(document.getElementById('stext_jefe_area').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_jefe_area.findItem(htmlentities(document.getElementById('stext_jefe_area').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_jefe_area" height=""></div><input type="hidden" maxlength="255"  name="g@jefe_area" id="jefe_area"   value="" ><label style="display:none" class="error" for="jefe_area">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_jefe_area=new dhtmlXTreeObject("treeboxbox_jefe_area","","",0);
                			tree_jefe_area.setImagePath("../../imgs/");
                			tree_jefe_area.enableIEImageFix(true);tree_jefe_area.enableCheckBoxes(1);
                    tree_jefe_area.enableRadioButtons(true);tree_jefe_area.setOnLoadingStart(cargando_jefe_area);
                      tree_jefe_area.setOnLoadingEnd(fin_cargando_jefe_area);tree_jefe_area.enableSmartXMLParsing(true);tree_jefe_area.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_jefe_area.setOnCheckHandler(onNodeSelect_jefe_area);
                      function onNodeSelect_jefe_area(nodeId)
                      {valor_destino=document.getElementById("jefe_area");
                       destinos=tree_jefe_area.getAllChecked();
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
                      function fin_cargando_jefe_area() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_jefe_area")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_jefe_area")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_jefe_area"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_jefe_area() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_jefe_area")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_jefe_area")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_jefe_area"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_jefe_area',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_jefe_area',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_jefe_area" id="bqsaiaenlace_jefe_area" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Aprobaci&oacute;n log&iacute;stica<input type="hidden" name="bksaiacondicion_aprovacion_logistica" id="bksaiacondicion_aprovacion_logistica" value="like_total"></b><div id="esperando_aprovacion_logistica"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_aprovacion_logistica" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_aprovacion_logistica.findItem(htmlentities(document.getElementById('stext_aprovacion_logistica').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_aprovacion_logistica.findItem(htmlentities(document.getElementById('stext_aprovacion_logistica').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_aprovacion_logistica.findItem(htmlentities(document.getElementById('stext_aprovacion_logistica').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_aprovacion_logistica" height=""></div><input type="hidden" maxlength="255"  name="g@aprovacion_logistica" id="aprovacion_logistica"   value="" ><label style="display:none" class="error" for="aprovacion_logistica">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_aprovacion_logistica=new dhtmlXTreeObject("treeboxbox_aprovacion_logistica","","",0);
                			tree_aprovacion_logistica.setImagePath("../../imgs/");
                			tree_aprovacion_logistica.enableIEImageFix(true);tree_aprovacion_logistica.enableCheckBoxes(1);
                    tree_aprovacion_logistica.enableRadioButtons(true);tree_aprovacion_logistica.setOnLoadingStart(cargando_aprovacion_logistica);
                      tree_aprovacion_logistica.setOnLoadingEnd(fin_cargando_aprovacion_logistica);tree_aprovacion_logistica.enableSmartXMLParsing(true);tree_aprovacion_logistica.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_aprovacion_logistica.setOnCheckHandler(onNodeSelect_aprovacion_logistica);
                      function onNodeSelect_aprovacion_logistica(nodeId)
                      {valor_destino=document.getElementById("aprovacion_logistica");
                       destinos=tree_aprovacion_logistica.getAllChecked();
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
                      function fin_cargando_aprovacion_logistica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprovacion_logistica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprovacion_logistica")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_aprovacion_logistica"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_aprovacion_logistica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprovacion_logistica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprovacion_logistica")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_aprovacion_logistica"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_aprovacion_logistica',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_aprovacion_logistica',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_aprovacion_logistica" id="bqsaiaenlace_aprovacion_logistica" value="y" />
		</div></div></div><div class="control-group"><b>Usuario que solicita<input type="hidden" name="bksaiacondicion_g@usuario_que_solita" id="bksaiacondicion_g@usuario_que_solita" value="like_total"></b><div class="controls"><input type="text" id="usuario_que_solita" name="bqsaia_g@usuario_que_solita"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@usuario_que_solita',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@usuario_que_solita',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@usuario_que_solita" id="bqsaiaenlace_g@usuario_que_solita" value="y" />
		</div></div></div><div class="control-group"><b>&Aacute;rea del elaborador del formato<input type="hidden" name="bksaiacondicion_g@area" id="bksaiacondicion_g@area" value="like_total"></b><div class="controls"><input type="text" id="area" name="bqsaia_g@area"></div></div><input type="hidden" name="campos_especiales" value="jefe_area@arbol,aprovacion_logistica@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_mantenimiento_locativo g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_elaboracion_x,g@fecha_elaboracion_y,g@fecha_solucion_x,g@fecha_solucion_y">