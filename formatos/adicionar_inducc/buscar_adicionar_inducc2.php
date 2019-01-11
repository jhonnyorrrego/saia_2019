<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Adicionar inducci&oacute;n</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_horario"><b>Fecha y horarios<input type="hidden" name="bksaiacondicion_fecha_horario" id="bksaiacondicion_fecha_horario" value="like_total"></b></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="fecha_horario_1"  id="fecha_horario_1" value=""><?php selector_fecha("fecha_horario_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_horario_2"  id="fecha_horario_2" value=""><?php selector_fecha("fecha_horario_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_horario',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_horario',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_horario" id="bqsaiaenlace_fecha_horario" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>&Aacute;rea y responsable<input type="hidden" name="bksaiacondicion_area_responsa" id="bksaiacondicion_area_responsa" value="="></b><div id="esperando_area_responsa"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_area_responsa" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_area_responsa.findItem((document.getElementById('stext_area_responsa').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_area_responsa.findItem((document.getElementById('stext_area_responsa').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_area_responsa.findItem((document.getElementById('stext_area_responsa').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_area_responsa" height=""></div><input type="hidden" maxlength="11"  name="g@area_responsa" id="area_responsa"   value="" ><label style="display:none" class="error" for="area_responsa">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_area_responsa=new dhtmlXTreeObject("treeboxbox_area_responsa","","",0);
                			tree_area_responsa.setImagePath("../../imgs/");
                			tree_area_responsa.enableIEImageFix(true);tree_area_responsa.enableCheckBoxes(1);
                    tree_area_responsa.enableRadioButtons(true);tree_area_responsa.setOnLoadingStart(cargando_area_responsa);
                      tree_area_responsa.setOnLoadingEnd(fin_cargando_area_responsa);tree_area_responsa.enableSmartXMLParsing(true);tree_area_responsa.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_area_responsa.setOnCheckHandler(onNodeSelect_area_responsa);
                      function onNodeSelect_area_responsa(nodeId)
                      {valor_destino=document.getElementById("area_responsa");
                       destinos=tree_area_responsa.getAllChecked();
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
                      function fin_cargando_area_responsa() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsa")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsa")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_area_responsa"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_area_responsa() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsa")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsa")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_area_responsa"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_area_responsa',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_area_responsa',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_area_responsa" id="bqsaiaenlace_area_responsa" value="y" />
		</div></div></div><div class="control-group"><b>Especificaci&oacute;n tema/documentaci&oacute;n revisada<input type="hidden" name="bksaiacondicion_g@contenido" id="bksaiacondicion_g@contenido" value="like_total"></b><div class="controls"><textarea    id="contenido" name="bqsaia_g@contenido"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="area_responsa@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_adicionar_inducc g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="adicionar_inducc"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|">