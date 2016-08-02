<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Justificaci&oacute;n de compra</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_justificacion_compra"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_justificacion_compra_x" id="bksaiacondicion_g@fecha_justificacion_compra_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_justificacion_compra_x" id="fecha_justificacion_compra_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_justificacion_compra_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_justificacion_compra_y" id="bksaiacondicion_g@fecha_justificacion_compra_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_justificacion_compra_y" id="fecha_justificacion_compra_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_justificacion_compra_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_justificacion_compra',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_justificacion_compra',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_justificacion_compra" id="bqsaiaenlace_fecha_justificacion_compra" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Nombre del solicitante<input type="hidden" name="bksaiacondicion_nombre_solicitante" id="bksaiacondicion_nombre_solicitante" value="like_total"></b><div id="esperando_nombre_solicitante"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_nombre_solicitante" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_nombre_solicitante.findItem(htmlentities(document.getElementById('stext_nombre_solicitante').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre_solicitante.findItem(htmlentities(document.getElementById('stext_nombre_solicitante').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_nombre_solicitante.findItem(htmlentities(document.getElementById('stext_nombre_solicitante').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_nombre_solicitante" height=""></div><input type="hidden"  name="g@nombre_solicitante" id="nombre_solicitante"   value="" ><label style="display:none" class="error" for="nombre_solicitante">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre_solicitante=new dhtmlXTreeObject("treeboxbox_nombre_solicitante","","",0);
                			tree_nombre_solicitante.setImagePath("../../imgs/");
                			tree_nombre_solicitante.enableIEImageFix(true);tree_nombre_solicitante.enableCheckBoxes(1);
                    tree_nombre_solicitante.enableRadioButtons(true);tree_nombre_solicitante.setOnLoadingStart(cargando_nombre_solicitante);
                      tree_nombre_solicitante.setOnLoadingEnd(fin_cargando_nombre_solicitante);tree_nombre_solicitante.enableSmartXMLParsing(true);tree_nombre_solicitante.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_nombre_solicitante.setOnCheckHandler(onNodeSelect_nombre_solicitante);
                      function onNodeSelect_nombre_solicitante(nodeId)
                      {valor_destino=document.getElementById("nombre_solicitante");
                       destinos=tree_nombre_solicitante.getAllChecked();
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
                      function fin_cargando_nombre_solicitante() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_solicitante")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_solicitante")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre_solicitante"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_nombre_solicitante() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_solicitante")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_solicitante")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre_solicitante"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre_solicitante',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre_solicitante',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre_solicitante" id="bqsaiaenlace_nombre_solicitante" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion_justificacion" id="bksaiacondicion_g@descripcion_justificacion" value="like_total"></b><div class="controls"><textarea  maxlength="3000"   id="descripcion_justificacion" name="bqsaia_g@descripcion_justificacion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_justificacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_justificacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_justificacion" id="bqsaiaenlace_g@descripcion_justificacion" value="y" />
		</div></div></div><div class="control-group"><b>Justificaci&oacute;n de compra<input type="hidden" name="bksaiacondicion_g@justificacion_compra" id="bksaiacondicion_g@justificacion_compra" value="like_total"></b><div class="controls"><textarea  maxlength="4000"   id="justificacion_compra" name="bqsaia_g@justificacion_compra"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@justificacion_compra',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@justificacion_compra',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@justificacion_compra" id="bqsaiaenlace_g@justificacion_compra" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Primera aprobacion<input type="hidden" name="bksaiacondicion_primera_aprobacion" id="bksaiacondicion_primera_aprobacion" value="like_total"></b><div id="esperando_primera_aprobacion"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_primera_aprobacion" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_primera_aprobacion.findItem(htmlentities(document.getElementById('stext_primera_aprobacion').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_primera_aprobacion.findItem(htmlentities(document.getElementById('stext_primera_aprobacion').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_primera_aprobacion.findItem(htmlentities(document.getElementById('stext_primera_aprobacion').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_primera_aprobacion" height=""></div><input type="hidden"  name="g@primera_aprobacion" id="primera_aprobacion"   value="" ><label style="display:none" class="error" for="primera_aprobacion">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_primera_aprobacion=new dhtmlXTreeObject("treeboxbox_primera_aprobacion","","",0);
                			tree_primera_aprobacion.setImagePath("../../imgs/");
                			tree_primera_aprobacion.enableIEImageFix(true);tree_primera_aprobacion.enableCheckBoxes(1);
                    tree_primera_aprobacion.enableRadioButtons(true);tree_primera_aprobacion.setOnLoadingStart(cargando_primera_aprobacion);
                      tree_primera_aprobacion.setOnLoadingEnd(fin_cargando_primera_aprobacion);tree_primera_aprobacion.enableSmartXMLParsing(true);tree_primera_aprobacion.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_primera_aprobacion.setOnCheckHandler(onNodeSelect_primera_aprobacion);
                      function onNodeSelect_primera_aprobacion(nodeId)
                      {valor_destino=document.getElementById("primera_aprobacion");
                       destinos=tree_primera_aprobacion.getAllChecked();
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
                      function fin_cargando_primera_aprobacion() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_primera_aprobacion")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_primera_aprobacion")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_primera_aprobacion"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_primera_aprobacion() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_primera_aprobacion")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_primera_aprobacion")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_primera_aprobacion"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="nombre_solicitante@arbol,primera_aprobacion@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_justificacion_compra g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_justificacion_compra_x,g@fecha_justificacion_compra_y">