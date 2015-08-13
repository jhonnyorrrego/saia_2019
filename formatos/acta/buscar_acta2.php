<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend" style="font-size:9pt;">B&uacute;squeda en formato ACTA</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Grupo Que Se Reune<input type="hidden" name="bksaiacondicion_g@grupo_reunido" id="bksaiacondicion_g@grupo_reunido" value="like_total"></b><div class="controls"><input type="text" id="grupo_reunido" name="bqsaia_g@grupo_reunido"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@grupo_reunido',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@grupo_reunido',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@grupo_reunido" id="bqsaiaenlace_g@grupo_reunido" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_reunion"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_reunion_x" id="bksaiacondicion_g@fecha_reunion_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_reunion_x" id="fecha_reunion_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_reunion_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_reunion_y" id="bksaiacondicion_g@fecha_reunion_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_reunion_y" id="fecha_reunion_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_reunion_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_reunion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_reunion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_reunion" id="bqsaiaenlace_fecha_reunion" value="y" />
		</div></div></div><div class="control-group"><b>Hora<input type="hidden" name="bksaiacondicion_g@hora" id="bksaiacondicion_g@hora" value="like_total"></b><div class="controls"><input type="text" id="hora" name="bqsaia_g@hora"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@hora',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@hora',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@hora" id="bqsaiaenlace_g@hora" value="y" />
		</div></div></div><div class="control-group"><b>N&uacute;mero Del Acta<input type="hidden" name="bksaiacondicion_g@numero_acta" id="bksaiacondicion_g@numero_acta" value="like_total"></b><div class="controls"><input type="text" id="numero_acta" name="bqsaia_g@numero_acta"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@numero_acta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@numero_acta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@numero_acta" id="bqsaiaenlace_g@numero_acta" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="caracter"><b>Caracter De La Reuni&oacute;n<input type="hidden" name="bksaiacondicion_g@caracter" id="bksaiacondicion_g@caracter" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(309,3625,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@caracter',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@caracter',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@caracter" id="bqsaiaenlace_g@caracter" value="y" />
		</div></div></div><div class="control-group"><b>Objetivo De La Reuni&oacute;n<input type="hidden" name="bksaiacondicion_g@objetivo_reunion" id="bksaiacondicion_g@objetivo_reunion" value="like_total"></b><div class="controls"><textarea  maxlength="4000"   id="objetivo_reunion" name="bqsaia_g@objetivo_reunion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@objetivo_reunion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@objetivo_reunion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@objetivo_reunion" id="bqsaiaenlace_g@objetivo_reunion" value="y" />
		</div></div></div><div class="control-group"><b>Agenda<input type="hidden" name="bksaiacondicion_g@ajenda_reunion" id="bksaiacondicion_g@ajenda_reunion" value="like_total"></b><div class="controls"><textarea  maxlength="4000"   id="ajenda_reunion" name="bqsaia_g@ajenda_reunion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@ajenda_reunion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@ajenda_reunion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@ajenda_reunion" id="bqsaiaenlace_g@ajenda_reunion" value="y" />
		</div></div></div><div class="control-group"><b>Desarrollo<input type="hidden" name="bksaiacondicion_g@desarrollo_reunion" id="bksaiacondicion_g@desarrollo_reunion" value="like_total"></b><div class="controls"><textarea  maxlength="4000"   id="desarrollo_reunion" name="bqsaia_g@desarrollo_reunion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@desarrollo_reunion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@desarrollo_reunion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@desarrollo_reunion" id="bqsaiaenlace_g@desarrollo_reunion" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Asistentes<input type="hidden" name="bksaiacondicion_asistentes" id="bksaiacondicion_asistentes" value="like_total"></b><div id="esperando_asistentes"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_asistentes" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_asistentes.findItem(htmlentities(document.getElementById('stext_asistentes').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_asistentes.findItem(htmlentities(document.getElementById('stext_asistentes').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_asistentes.findItem(htmlentities(document.getElementById('stext_asistentes').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_asistentes" height=""></div><input type="hidden" maxlength="3000"  name="g@asistentes" id="asistentes"   value="" ><label style="display:none" class="error" for="asistentes">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_asistentes=new dhtmlXTreeObject("treeboxbox_asistentes","","",0);
                			tree_asistentes.setImagePath("../../imgs/");
                			tree_asistentes.enableIEImageFix(true);tree_asistentes.enableCheckBoxes(1);
                			tree_asistentes.enableThreeStateCheckboxes(1);tree_asistentes.setOnLoadingStart(cargando_asistentes);
                      tree_asistentes.setOnLoadingEnd(fin_cargando_asistentes);tree_asistentes.enableSmartXMLParsing(true);tree_asistentes.loadXML("../../test.php?rol=1");
                      tree_asistentes.setOnCheckHandler(onNodeSelect_asistentes);
                      function onNodeSelect_asistentes(nodeId)
                      {valor_destino=document.getElementById("asistentes");
                       destinos=tree_asistentes.getAllChecked();
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
                      function fin_cargando_asistentes() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_asistentes")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_asistentes")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_asistentes"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_asistentes() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_asistentes")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_asistentes")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_asistentes"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_asistentes',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_asistentes',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_asistentes" id="bqsaiaenlace_asistentes" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="line-height:15px;font-size:9pt;"><b>Invitados</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__9" id="bksaiacondicion_f@nombre__9" value="like_total"></b><div class="controls"><input type="text"  maxlength="3000"   id="invitados-nombre" name="g@invitados-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="3000"   id="invitados-identificacion" name="g@invitados-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="3000"   id="invitados-empresa" name="g@invitados-empresa" ></div></div></fieldset><br><div class="control-group"><b>Ausentes<input type="hidden" name="bksaiacondicion_g@ausentes" id="bksaiacondicion_g@ausentes" value="like_total"></b><div class="controls"><input type="text" id="ausentes" name="bqsaia_g@ausentes"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@ausentes',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@ausentes',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@ausentes" id="bqsaiaenlace_g@ausentes" value="y" />
		</div></div></div><div class="control-group"><b>Acciones Tareas Y Compromisos<input type="hidden" name="bksaiacondicion_g@tareas" id="bksaiacondicion_g@tareas" value="="></b><div class="controls"><input type="text" id="tareas" name="bqsaia_g@tareas"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tareas',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tareas',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tareas" id="bqsaiaenlace_g@tareas" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_proxima_reunion"><b>Fecha Pr&oacute;xima Reuni&oacute;n<input type="hidden" name="bksaiacondicion_fecha_proxima_reunion" id="bksaiacondicion_fecha_proxima_reunion" value="like_total"></b></label><div class="controls">
                    Entre &nbsp;<input type="text" readonly="true" name="fecha_proxima_reunion_1"  id="fecha_proxima_reunion_1" value=""><?php selector_fecha("fecha_proxima_reunion_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y <input type="text" readonly="true" name="fecha_proxima_reunion_2"  id="fecha_proxima_reunion_2" value=""><?php selector_fecha("fecha_proxima_reunion_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_proxima_reunion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_proxima_reunion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_proxima_reunion" id="bqsaiaenlace_fecha_proxima_reunion" value="y" />
		</div></div></div><div class="control-group"><b>Lugar Pr&oacute;xima Reuni&oacute;n<input type="hidden" name="bksaiacondicion_g@lugar_proxima_reunion" id="bksaiacondicion_g@lugar_proxima_reunion" value="like_total"></b><div class="controls"><input type="text" id="lugar_proxima_reunion" name="bqsaia_g@lugar_proxima_reunion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@lugar_proxima_reunion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@lugar_proxima_reunion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@lugar_proxima_reunion" id="bqsaiaenlace_g@lugar_proxima_reunion" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Firma Presidente<input type="hidden" name="bksaiacondicion_firma_presidente" id="bksaiacondicion_firma_presidente" value="like_total"></b><div id="esperando_firma_presidente"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_firma_presidente" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_firma_presidente.findItem(htmlentities(document.getElementById('stext_firma_presidente').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_firma_presidente.findItem(htmlentities(document.getElementById('stext_firma_presidente').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_firma_presidente.findItem(htmlentities(document.getElementById('stext_firma_presidente').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_firma_presidente" height=""></div><input type="hidden" maxlength="255"  name="g@firma_presidente" id="firma_presidente"   value="" ><label style="display:none" class="error" for="firma_presidente">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_firma_presidente=new dhtmlXTreeObject("treeboxbox_firma_presidente","","",0);
                			tree_firma_presidente.setImagePath("../../imgs/");
                			tree_firma_presidente.enableIEImageFix(true);tree_firma_presidente.enableCheckBoxes(1);
                    tree_firma_presidente.enableRadioButtons(true);tree_firma_presidente.setOnLoadingStart(cargando_firma_presidente);
                      tree_firma_presidente.setOnLoadingEnd(fin_cargando_firma_presidente);tree_firma_presidente.enableSmartXMLParsing(true);tree_firma_presidente.loadXML("../../test.php?sin_padre=1&rol=1");
                      tree_firma_presidente.setOnCheckHandler(onNodeSelect_firma_presidente);
                      function onNodeSelect_firma_presidente(nodeId)
                      {valor_destino=document.getElementById("firma_presidente");
                       destinos=tree_firma_presidente.getAllChecked();
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
                      function fin_cargando_firma_presidente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_firma_presidente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_firma_presidente")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_firma_presidente"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_firma_presidente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_firma_presidente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_firma_presidente")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_firma_presidente"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_firma_presidente',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_firma_presidente',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_firma_presidente" id="bqsaiaenlace_firma_presidente" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Firma Secretario(a)<input type="hidden" name="bksaiacondicion_firma_secretaria" id="bksaiacondicion_firma_secretaria" value="="></b><div id="esperando_firma_secretaria"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_firma_secretaria" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_firma_secretaria.findItem(htmlentities(document.getElementById('stext_firma_secretaria').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_firma_secretaria.findItem(htmlentities(document.getElementById('stext_firma_secretaria').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_firma_secretaria.findItem(htmlentities(document.getElementById('stext_firma_secretaria').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_firma_secretaria" height=""></div><input type="hidden" maxlength="255"  name="g@firma_secretaria" id="firma_secretaria"   value="" ><label style="display:none" class="error" for="firma_secretaria">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_firma_secretaria=new dhtmlXTreeObject("treeboxbox_firma_secretaria","","",0);
                			tree_firma_secretaria.setImagePath("../../imgs/");
                			tree_firma_secretaria.enableIEImageFix(true);tree_firma_secretaria.enableCheckBoxes(1);
                    tree_firma_secretaria.enableRadioButtons(true);tree_firma_secretaria.setOnLoadingStart(cargando_firma_secretaria);
                      tree_firma_secretaria.setOnLoadingEnd(fin_cargando_firma_secretaria);tree_firma_secretaria.enableSmartXMLParsing(true);tree_firma_secretaria.loadXML("../../test.php?sin_padre=1&rol=1");
                      tree_firma_secretaria.setOnCheckHandler(onNodeSelect_firma_secretaria);
                      function onNodeSelect_firma_secretaria(nodeId)
                      {valor_destino=document.getElementById("firma_secretaria");
                       destinos=tree_firma_secretaria.getAllChecked();
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
                      function fin_cargando_firma_secretaria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_firma_secretaria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_firma_secretaria")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_firma_secretaria"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_firma_secretaria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_firma_secretaria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_firma_secretaria")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_firma_secretaria"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="asistentes@arbol,invitados@ejecutor,firma_presidente@arbol,firma_secretaria@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_acta g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_reunion_x,g@fecha_reunion_y"><input type="hidden" name="idbusqueda_componente" value="200">