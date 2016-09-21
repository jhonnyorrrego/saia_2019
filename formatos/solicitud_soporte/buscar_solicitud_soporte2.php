<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Solicitud de soporte</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_soporte"><b>Fecha solicitud</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_soporte_x" id="bksaiacondicion_g@fecha_soporte_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_soporte_x" id="fecha_soporte_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_soporte_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_soporte_y" id="bksaiacondicion_g@fecha_soporte_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_soporte_y" id="fecha_soporte_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_soporte_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_soporte',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_soporte',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_soporte" id="bqsaiaenlace_fecha_soporte" value="y" />
		</div></div></div><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_hora_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_hora_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_hora_solicitud" id="bqsaiaenlace_hora_solicitud" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Tipo de solicitud<input type="hidden" name="bksaiacondicion_tipo_solitud" id="bksaiacondicion_tipo_solitud" value="like_total"></b><div id="esperando_tipo_solitud"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_tipo_solitud" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_tipo_solitud.findItem(htmlentities(document.getElementById('stext_tipo_solitud').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_tipo_solitud.findItem(htmlentities(document.getElementById('stext_tipo_solitud').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_tipo_solitud.findItem(htmlentities(document.getElementById('stext_tipo_solitud').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_tipo_solitud" height=""></div><input type="hidden" maxlength="255"  name="g@tipo_solitud" id="tipo_solitud"   value="" ><label style="display:none" class="error" for="tipo_solitud">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_tipo_solitud=new dhtmlXTreeObject("treeboxbox_tipo_solitud","","",0);
                			tree_tipo_solitud.setImagePath("../../imgs/");
                			tree_tipo_solitud.enableIEImageFix(true);tree_tipo_solitud.enableCheckBoxes(1);
                    tree_tipo_solitud.enableRadioButtons(true);tree_tipo_solitud.setOnLoadingStart(cargando_tipo_solitud);
                      tree_tipo_solitud.setOnLoadingEnd(fin_cargando_tipo_solitud);tree_tipo_solitud.enableSmartXMLParsing(true);tree_tipo_solitud.loadXML("../../test_serie_funcionario.php?categoria=3&id=884");
                      tree_tipo_solitud.setOnCheckHandler(onNodeSelect_tipo_solitud);
                      function onNodeSelect_tipo_solitud(nodeId)
                      {valor_destino=document.getElementById("tipo_solitud");
                       destinos=tree_tipo_solitud.getAllChecked();
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
                      function fin_cargando_tipo_solitud() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_solitud")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_solitud")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_tipo_solitud"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_tipo_solitud() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_solitud")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_solitud")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_tipo_solitud"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_solitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_solitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_solitud" id="bqsaiaenlace_tipo_solitud" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="prioridad"><b>Prioridad<input type="hidden" name="bksaiacondicion_g@prioridad" id="bksaiacondicion_g@prioridad" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(218,2553,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@prioridad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@prioridad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@prioridad" id="bqsaiaenlace_g@prioridad" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="tipo_solitud@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicitud_soporte g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_soporte_x,g@fecha_soporte_y">