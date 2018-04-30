<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Caracterizaci&oacute;n de Proceso</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>C&oacute;digo<input type="hidden" name="bksaiacondicion_g@codigo" id="bksaiacondicion_g@codigo" value="like_total"></b><div class="controls"><input type="text" id="codigo" name="bqsaia_g@codigo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@codigo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@codigo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@codigo" id="bqsaiaenlace_g@codigo" value="y" />
		</div></div></div><div class="control-group"><b>Nombre<input type="hidden" name="bksaiacondicion_g@nombre" id="bksaiacondicion_g@nombre" value="like_total"></b><div class="controls"><input type="text" id="nombre" name="bqsaia_g@nombre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre" id="bqsaiaenlace_g@nombre" value="y" />
		</div></div></div><div class="control-group"><b>Versi&oacute;n<input type="hidden" name="bksaiacondicion_g@version" id="bksaiacondicion_g@version" value="like_total"></b><div class="controls"><input type="text" id="version" name="bqsaia_g@version"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@version',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@version',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@version" id="bqsaiaenlace_g@version" value="y" />
		</div></div></div><div class="control-group"><b>vigencia<input type="hidden" name="bksaiacondicion_g@vigencia" id="bksaiacondicion_g@vigencia" value="like_total"></b><div class="controls"><input type="text" id="vigencia" name="bqsaia_g@vigencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@vigencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@vigencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@vigencia" id="bqsaiaenlace_g@vigencia" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado"><b>estado<input type="hidden" name="bksaiacondicion_g@estado" id="bksaiacondicion_g@estado" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(477,6011,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@estado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@estado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@estado" id="bqsaiaenlace_g@estado" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Responsable<input type="hidden" name="bksaiacondicion_responsable" id="bksaiacondicion_responsable" value="like_total"></b><div id="esperando_responsable"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_responsable" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_responsable" height=""></div><input type="hidden" maxlength="255"  name="g@responsable" id="responsable"   value="" ><label style="display:none" class="error" for="responsable">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable=new dhtmlXTreeObject("treeboxbox_responsable","","",0);
                			tree_responsable.setImagePath("../../imgs/");
                			tree_responsable.enableIEImageFix(true);tree_responsable.enableCheckBoxes(1);
                    tree_responsable.enableRadioButtons(true);tree_responsable.setOnLoadingStart(cargando_responsable);
                      tree_responsable.setOnLoadingEnd(fin_cargando_responsable);tree_responsable.enableSmartXMLParsing(true);tree_responsable.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_responsable.setOnCheckHandler(onNodeSelect_responsable);
                      function onNodeSelect_responsable(nodeId)
                      {valor_destino=document.getElementById("responsable");
                       destinos=tree_responsable.getAllChecked();
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
                      function fin_cargando_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_responsable',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_responsable',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_responsable" id="bqsaiaenlace_responsable" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>L&iacute;der del proceso<input type="hidden" name="bksaiacondicion_lider_proceso" id="bksaiacondicion_lider_proceso" value="like_total"></b><div id="esperando_lider_proceso"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_lider_proceso" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_lider_proceso.findItem((document.getElementById('stext_lider_proceso').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_lider_proceso.findItem((document.getElementById('stext_lider_proceso').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_lider_proceso.findItem((document.getElementById('stext_lider_proceso').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_lider_proceso" height=""></div><input type="hidden" maxlength="255"  name="g@lider_proceso" id="lider_proceso"   value="" ><label style="display:none" class="error" for="lider_proceso">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_lider_proceso=new dhtmlXTreeObject("treeboxbox_lider_proceso","","",0);
                			tree_lider_proceso.setImagePath("../../imgs/");
                			tree_lider_proceso.enableIEImageFix(true);tree_lider_proceso.enableCheckBoxes(1);
                    tree_lider_proceso.enableRadioButtons(true);tree_lider_proceso.setOnLoadingStart(cargando_lider_proceso);
                      tree_lider_proceso.setOnLoadingEnd(fin_cargando_lider_proceso);tree_lider_proceso.enableSmartXMLParsing(true);tree_lider_proceso.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_lider_proceso.setOnCheckHandler(onNodeSelect_lider_proceso);
                      function onNodeSelect_lider_proceso(nodeId)
                      {valor_destino=document.getElementById("lider_proceso");
                       destinos=tree_lider_proceso.getAllChecked();
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
                      function fin_cargando_lider_proceso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_lider_proceso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_lider_proceso")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_lider_proceso"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_lider_proceso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_lider_proceso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_lider_proceso")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_lider_proceso"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_lider_proceso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_lider_proceso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_lider_proceso" id="bqsaiaenlace_lider_proceso" value="y" />
		</div></div></div><div class="control-group"><b>objetivo<input type="hidden" name="bksaiacondicion_g@objetivo" id="bksaiacondicion_g@objetivo" value="like_total"></b><div class="controls"><textarea  maxlength="3000"   id="objetivo" name="bqsaia_g@objetivo"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@objetivo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@objetivo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@objetivo" id="bqsaiaenlace_g@objetivo" value="y" />
		</div></div></div><div class="control-group"><b>Alcance<input type="hidden" name="bksaiacondicion_g@alcance" id="bksaiacondicion_g@alcance" value="like_total"></b><div class="controls"><textarea    id="alcance" name="bqsaia_g@alcance"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@alcance',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@alcance',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@alcance" id="bqsaiaenlace_g@alcance" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Revisado por<input type="hidden" name="bksaiacondicion_revisado_por" id="bksaiacondicion_revisado_por" value="="></b><div id="esperando_revisado_por"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_revisado_por" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_revisado_por.findItem((document.getElementById('stext_revisado_por').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_revisado_por.findItem((document.getElementById('stext_revisado_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_revisado_por.findItem((document.getElementById('stext_revisado_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_revisado_por" height=""></div><input type="hidden" maxlength="11"  name="g@revisado_por" id="revisado_por"   value="" ><label style="display:none" class="error" for="revisado_por">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_revisado_por=new dhtmlXTreeObject("treeboxbox_revisado_por","","",0);
                			tree_revisado_por.setImagePath("../../imgs/");
                			tree_revisado_por.enableIEImageFix(true);tree_revisado_por.enableCheckBoxes(1);
                    tree_revisado_por.enableRadioButtons(true);tree_revisado_por.setOnLoadingStart(cargando_revisado_por);
                      tree_revisado_por.setOnLoadingEnd(fin_cargando_revisado_por);tree_revisado_por.enableSmartXMLParsing(true);tree_revisado_por.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_revisado_por.setOnCheckHandler(onNodeSelect_revisado_por);
                      function onNodeSelect_revisado_por(nodeId)
                      {valor_destino=document.getElementById("revisado_por");
                       destinos=tree_revisado_por.getAllChecked();
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
                      function fin_cargando_revisado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_revisado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_revisado_por")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_revisado_por"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_revisado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_revisado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_revisado_por")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_revisado_por"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_revisado_por',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_revisado_por',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_revisado_por" id="bqsaiaenlace_revisado_por" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>permisos de acceso<input type="hidden" name="bksaiacondicion_permisos_acceso" id="bksaiacondicion_permisos_acceso" value="like_total"></b><div id="esperando_permisos_acceso"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_permisos_acceso" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_permisos_acceso.findItem((document.getElementById('stext_permisos_acceso').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_permisos_acceso.findItem((document.getElementById('stext_permisos_acceso').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_permisos_acceso.findItem((document.getElementById('stext_permisos_acceso').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_permisos_acceso" height=""></div><input type="hidden" maxlength="255"  name="g@permisos_acceso" id="permisos_acceso"   value="" ><label style="display:none" class="error" for="permisos_acceso">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_permisos_acceso=new dhtmlXTreeObject("treeboxbox_permisos_acceso","","",0);
                			tree_permisos_acceso.setImagePath("../../imgs/");
                			tree_permisos_acceso.enableIEImageFix(true);tree_permisos_acceso.enableCheckBoxes(1);
                			tree_permisos_acceso.enableThreeStateCheckboxes(1);tree_permisos_acceso.setOnLoadingStart(cargando_permisos_acceso);
                      tree_permisos_acceso.setOnLoadingEnd(fin_cargando_permisos_acceso);tree_permisos_acceso.enableSmartXMLParsing(true);tree_permisos_acceso.loadXML("../../test.php?sin_padre=1");
                      tree_permisos_acceso.setOnCheckHandler(onNodeSelect_permisos_acceso);
                      function onNodeSelect_permisos_acceso(nodeId)
                      {valor_destino=document.getElementById("permisos_acceso");
                       destinos=tree_permisos_acceso.getAllChecked();
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
                      function fin_cargando_permisos_acceso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_permisos_acceso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_permisos_acceso")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_permisos_acceso"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_permisos_acceso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_permisos_acceso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_permisos_acceso")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_permisos_acceso"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_permisos_acceso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_permisos_acceso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_permisos_acceso" id="bqsaiaenlace_permisos_acceso" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Dependencias Participantes<input type="hidden" name="bksaiacondicion_dependencias_partici" id="bksaiacondicion_dependencias_partici" value="like_total"></b><div id="esperando_dependencias_partici"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_dependencias_partici" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_dependencias_partici.findItem((document.getElementById('stext_dependencias_partici').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_dependencias_partici.findItem((document.getElementById('stext_dependencias_partici').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_dependencias_partici.findItem((document.getElementById('stext_dependencias_partici').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_dependencias_partici" height=""></div><input type="hidden" maxlength="255"  name="g@dependencias_partici" id="dependencias_partici"   value="" ><label style="display:none" class="error" for="dependencias_partici">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_dependencias_partici=new dhtmlXTreeObject("treeboxbox_dependencias_partici","","",0);
                			tree_dependencias_partici.setImagePath("../../imgs/");
                			tree_dependencias_partici.enableIEImageFix(true);tree_dependencias_partici.enableCheckBoxes(1);
                			tree_dependencias_partici.enableThreeStateCheckboxes(1);tree_dependencias_partici.setOnLoadingStart(cargando_dependencias_partici);
                      tree_dependencias_partici.setOnLoadingEnd(fin_cargando_dependencias_partici);tree_dependencias_partici.enableSmartXMLParsing(true);tree_dependencias_partici.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_dependencias_partici.setOnCheckHandler(onNodeSelect_dependencias_partici);
                      function onNodeSelect_dependencias_partici(nodeId)
                      {valor_destino=document.getElementById("dependencias_partici");
                       destinos=tree_dependencias_partici.getAllChecked();
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
                      function fin_cargando_dependencias_partici() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencias_partici")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencias_partici")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_dependencias_partici"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_dependencias_partici() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencias_partici")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencias_partici")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_dependencias_partici"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_dependencias_partici',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_dependencias_partici',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_dependencias_partici" id="bqsaiaenlace_dependencias_partici" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="macroproceso"><b>Macro Proceso<input type="hidden" name="bksaiacondicion_g@macroproceso" id="bksaiacondicion_g@macroproceso" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(477,6036,'',1,'buscar');?></div></div><input type="hidden" name="campos_especiales" value="responsable@arbol,lider_proceso@arbol,revisado_por@arbol,permisos_acceso@arbol,dependencias_partici@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_proceso g @ AND  g.documento_iddocumento=iddocumento "></body>