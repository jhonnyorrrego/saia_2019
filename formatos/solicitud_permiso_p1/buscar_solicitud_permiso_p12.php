<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Solicitud Permiso P1</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="clase_permiso"><b>Clase de Permiso<input type="hidden" name="bksaiacondicion_g@clase_permiso" id="bksaiacondicion_g@clase_permiso" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(512,6680,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@clase_permiso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@clase_permiso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@clase_permiso" id="bqsaiaenlace_g@clase_permiso" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_solicitud"><b>Fecha de Solicitud<input type="hidden" name="bksaiacondicion_fecha_solicitud" id="bksaiacondicion_fecha_solicitud" value="like_total"></b></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="fecha_solicitud_1"  id="fecha_solicitud_1" value=""><?php selector_fecha("fecha_solicitud_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_solicitud_2"  id="fecha_solicitud_2" value=""><?php selector_fecha("fecha_solicitud_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_solicitud" id="bqsaiaenlace_fecha_solicitud" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Funcionario<input type="hidden" name="bksaiacondicion_funcionario" id="bksaiacondicion_funcionario" value="like_total"></b><div id="esperando_funcionario"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_funcionario" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_funcionario.findItem((document.getElementById('stext_funcionario').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_funcionario.findItem((document.getElementById('stext_funcionario').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_funcionario.findItem((document.getElementById('stext_funcionario').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_funcionario" height=""></div><input type="hidden" maxlength="255"  name="g@funcionario" id="funcionario"   value="" ><label style="display:none" class="error" for="funcionario">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_funcionario=new dhtmlXTreeObject("treeboxbox_funcionario","","",0);
                			tree_funcionario.setImagePath("../../imgs/");
                			tree_funcionario.enableIEImageFix(true);tree_funcionario.enableCheckBoxes(1);
                    tree_funcionario.enableRadioButtons(true);tree_funcionario.setOnLoadingStart(cargando_funcionario);
                      tree_funcionario.setOnLoadingEnd(fin_cargando_funcionario);tree_funcionario.enableSmartXMLParsing(true);tree_funcionario.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_funcionario.setOnCheckHandler(onNodeSelect_funcionario);
                      function onNodeSelect_funcionario(nodeId)
                      {valor_destino=document.getElementById("funcionario");
                       destinos=tree_funcionario.getAllChecked();
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
                      function fin_cargando_funcionario() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_funcionario")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_funcionario")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_funcionario"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_funcionario() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_funcionario")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_funcionario")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_funcionario"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_funcionario',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_funcionario',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_funcionario" id="bqsaiaenlace_funcionario" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_permiso"><b>Tipo de Permiso<input type="hidden" name="bksaiacondicion_g@tipo_permiso" id="bksaiacondicion_g@tipo_permiso" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(512,6656,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_permiso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_permiso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_permiso" id="bqsaiaenlace_g@tipo_permiso" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_permiso"><b>Fecha del Permiso<input type="hidden" name="bksaiacondicion_fecha_permiso" id="bksaiacondicion_fecha_permiso" value="like_total"></b></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="fecha_permiso_1"  id="fecha_permiso_1" value=""><?php selector_fecha("fecha_permiso_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_permiso_2"  id="fecha_permiso_2" value=""><?php selector_fecha("fecha_permiso_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_permiso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_permiso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_permiso" id="bqsaiaenlace_fecha_permiso" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="salida_porteria"><b>Porteria de Salida<input type="hidden" name="bksaiacondicion_g@salida_porteria" id="bksaiacondicion_g@salida_porteria" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(512,6665,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_salida_porteria',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_salida_porteria',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_salida_porteria" id="bqsaiaenlace_salida_porteria" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="compensacion"><b>Compensaci&oacute;n del Permiso<input type="hidden" name="bksaiacondicion_g@compensacion" id="bksaiacondicion_g@compensacion" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(512,6666,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@compensacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@compensacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@compensacion" id="bqsaiaenlace_g@compensacion" value="y" />
		</div></div></div><div class="control-group"><b>Describa el Permiso<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea    id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="funcionario@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicitud_permiso_p1 g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|">