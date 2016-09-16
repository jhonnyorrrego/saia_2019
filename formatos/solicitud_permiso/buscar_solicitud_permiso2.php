<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato SOLICITUD DE PERMISOS</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>Gestion Humana<input type="hidden" name="bksaiacondicion_gestion_humana" id="bksaiacondicion_gestion_humana" value="like_total"></b><div id="esperando_gestion_humana"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_gestion_humana" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_gestion_humana.findItem(htmlentities(document.getElementById('stext_gestion_humana').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_gestion_humana.findItem(htmlentities(document.getElementById('stext_gestion_humana').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_gestion_humana.findItem(htmlentities(document.getElementById('stext_gestion_humana').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_gestion_humana" height=""></div><input type="hidden" maxlength="255"  name="g@gestion_humana" id="gestion_humana"   value="" ><label style="display:none" class="error" for="gestion_humana">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_gestion_humana=new dhtmlXTreeObject("treeboxbox_gestion_humana","","",0);
                			tree_gestion_humana.setImagePath("../../imgs/");
                			tree_gestion_humana.enableIEImageFix(true);tree_gestion_humana.enableCheckBoxes(1);
                    tree_gestion_humana.enableRadioButtons(true);tree_gestion_humana.setOnLoadingStart(cargando_gestion_humana);
                      tree_gestion_humana.setOnLoadingEnd(fin_cargando_gestion_humana);tree_gestion_humana.enableSmartXMLParsing(true);tree_gestion_humana.loadXML("../../test.php?rol=1&iddependencia=50");
                      tree_gestion_humana.setOnCheckHandler(onNodeSelect_gestion_humana);
                      function onNodeSelect_gestion_humana(nodeId)
                      {valor_destino=document.getElementById("gestion_humana");
                       destinos=tree_gestion_humana.getAllChecked();
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
                      function fin_cargando_gestion_humana() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gestion_humana")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gestion_humana")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_gestion_humana"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_gestion_humana() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gestion_humana")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gestion_humana")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_gestion_humana"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_gestion_humana',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_gestion_humana',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_gestion_humana" id="bqsaiaenlace_gestion_humana" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_radiccion_permiso"><b>Fechas Solicitud</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_radiccion_permiso_x" id="bksaiacondicion_g@fecha_radiccion_permiso_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_radiccion_permiso_x" id="fecha_radiccion_permiso_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_radiccion_permiso_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_radiccion_permiso_y" id="bksaiacondicion_g@fecha_radiccion_permiso_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_radiccion_permiso_y" id="fecha_radiccion_permiso_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_radiccion_permiso_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_radiccion_permiso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_radiccion_permiso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_radiccion_permiso" id="bqsaiaenlace_fecha_radiccion_permiso" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_hora_cita"><b>Fecha y Hora de la cita<input type="hidden" name="bksaiacondicion_fecha_hora_cita" id="bksaiacondicion_fecha_hora_cita" value="like_total"></b></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="fecha_hora_cita_1"  id="fecha_hora_cita_1" value=""><?php selector_fecha("fecha_hora_cita_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_hora_cita_2"  id="fecha_hora_cita_2" value=""><?php selector_fecha("fecha_hora_cita_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_hora_cita',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_hora_cita',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_hora_cita" id="bqsaiaenlace_fecha_hora_cita" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Motivo de Permiso<input type="hidden" name="bksaiacondicion_motivo_permiso" id="bksaiacondicion_motivo_permiso" value="="></b><div id="esperando_motivo_permiso"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_motivo_permiso" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_motivo_permiso.findItem(htmlentities(document.getElementById('stext_motivo_permiso').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_motivo_permiso.findItem(htmlentities(document.getElementById('stext_motivo_permiso').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_motivo_permiso.findItem(htmlentities(document.getElementById('stext_motivo_permiso').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_motivo_permiso" height=""></div><input type="hidden" maxlength="11"  name="g@motivo_permiso" id="motivo_permiso"   value="" ><label style="display:none" class="error" for="motivo_permiso">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_motivo_permiso=new dhtmlXTreeObject("treeboxbox_motivo_permiso","","",0);
                			tree_motivo_permiso.setImagePath("../../imgs/");
                			tree_motivo_permiso.enableIEImageFix(true);tree_motivo_permiso.enableCheckBoxes(1);
                    tree_motivo_permiso.enableRadioButtons(true);tree_motivo_permiso.setOnLoadingStart(cargando_motivo_permiso);
                      tree_motivo_permiso.setOnLoadingEnd(fin_cargando_motivo_permiso);tree_motivo_permiso.enableSmartXMLParsing(true);tree_motivo_permiso.loadXML("../../test_serie_funcionario.php?categoria=3&id=856");
                      tree_motivo_permiso.setOnCheckHandler(onNodeSelect_motivo_permiso);
                      function onNodeSelect_motivo_permiso(nodeId)
                      {valor_destino=document.getElementById("motivo_permiso");
                       destinos=tree_motivo_permiso.getAllChecked();
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
                      function fin_cargando_motivo_permiso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_motivo_permiso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_motivo_permiso")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_motivo_permiso"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_motivo_permiso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_motivo_permiso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_motivo_permiso")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_motivo_permiso"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_motivo_permiso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_motivo_permiso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_motivo_permiso" id="bqsaiaenlace_motivo_permiso" value="y" />
		</div></div></div><div class="control-group"><b>Otro<input type="hidden" name="bksaiacondicion_g@motivo_otro" id="bksaiacondicion_g@motivo_otro" value="like_total"></b><div class="controls"><input type="text" id="motivo_otro" name="bqsaia_g@motivo_otro"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@motivo_otro',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@motivo_otro',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@motivo_otro" id="bqsaiaenlace_g@motivo_otro" value="y" />
		</div></div></div><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_hora_entrada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_hora_entrada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_hora_entrada" id="bqsaiaenlace_hora_entrada" value="y" />
		</div></div></div></div></div><input type="hidden" name="campos_especiales" value="gestion_humana@arbol,motivo_permiso@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicitud_permiso g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_radiccion_permiso_x,g@fecha_radiccion_permiso_y">