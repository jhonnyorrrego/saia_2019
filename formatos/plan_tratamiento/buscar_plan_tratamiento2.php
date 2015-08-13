<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend" style="font-size:9pt;">B&uacute;squeda en formato 3. Plan de tratamiento</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Diagnostico<input type="hidden" name="bksaiacondicion_g@plan_diagnostico" id="bksaiacondicion_g@plan_diagnostico" value="like_total"></b><div class="controls"><textarea    id="plan_diagnostico" name="bqsaia_g@plan_diagnostico"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@plan_diagnostico',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@plan_diagnostico',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@plan_diagnostico" id="bqsaiaenlace_g@plan_diagnostico" value="y" />
		</div></div></div><div class="control-group"><b>Valor Del Tratamiento<input type="hidden" name="bksaiacondicion_g@valor_plan_tratamiento" id="bksaiacondicion_g@valor_plan_tratamiento" value="="></b><div class="controls"><input type="text" id="valor_plan_tratamiento" name="bqsaia_g@valor_plan_tratamiento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@valor_plan_tratamiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@valor_plan_tratamiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@valor_plan_tratamiento" id="bqsaiaenlace_g@valor_plan_tratamiento" value="y" />
		</div></div></div><div class="control-group"><b>Paciente O Acudiente<input type="hidden" name="bksaiacondicion_g@paciente_tratamiento" id="bksaiacondicion_g@paciente_tratamiento" value="like_total"></b><div class="controls"><input type="text" id="paciente_tratamiento" name="bqsaia_g@paciente_tratamiento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@paciente_tratamiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@paciente_tratamiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@paciente_tratamiento" id="bqsaiaenlace_g@paciente_tratamiento" value="y" />
		</div></div></div><div class="control-group"><b>Documento De Identidad<input type="hidden" name="bksaiacondicion_g@documento_paciente" id="bksaiacondicion_g@documento_paciente" value="like_total"></b><div class="controls"><input type="text" id="documento_paciente" name="bqsaia_g@documento_paciente"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@documento_paciente',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@documento_paciente',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@documento_paciente" id="bqsaiaenlace_g@documento_paciente" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Odontologo<input type="hidden" name="bksaiacondicion_odontologo_tratamiento" id="bksaiacondicion_odontologo_tratamiento" value="like_total"></b><div id="esperando_odontologo_tratamiento"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_odontologo_tratamiento" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_odontologo_tratamiento.findItem(htmlentities(document.getElementById('stext_odontologo_tratamiento').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_odontologo_tratamiento.findItem(htmlentities(document.getElementById('stext_odontologo_tratamiento').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_odontologo_tratamiento.findItem(htmlentities(document.getElementById('stext_odontologo_tratamiento').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_odontologo_tratamiento" height=""></div><input type="hidden" maxlength="255"  name="g@odontologo_tratamiento" id="odontologo_tratamiento"   value="" ><label style="display:none" class="error" for="odontologo_tratamiento">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_odontologo_tratamiento=new dhtmlXTreeObject("treeboxbox_odontologo_tratamiento","","",0);
                			tree_odontologo_tratamiento.setImagePath("../../imgs/");
                			tree_odontologo_tratamiento.enableIEImageFix(true);tree_odontologo_tratamiento.enableCheckBoxes(1);
                    tree_odontologo_tratamiento.enableRadioButtons(true);tree_odontologo_tratamiento.setOnLoadingStart(cargando_odontologo_tratamiento);
                      tree_odontologo_tratamiento.setOnLoadingEnd(fin_cargando_odontologo_tratamiento);tree_odontologo_tratamiento.enableSmartXMLParsing(true);tree_odontologo_tratamiento.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_odontologo_tratamiento.setOnCheckHandler(onNodeSelect_odontologo_tratamiento);
                      function onNodeSelect_odontologo_tratamiento(nodeId)
                      {valor_destino=document.getElementById("odontologo_tratamiento");
                       destinos=tree_odontologo_tratamiento.getAllChecked();
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
                      function fin_cargando_odontologo_tratamiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_odontologo_tratamiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_odontologo_tratamiento")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_odontologo_tratamiento"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_odontologo_tratamiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_odontologo_tratamiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_odontologo_tratamiento")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_odontologo_tratamiento"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_odontologo_tratamiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_odontologo_tratamiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_odontologo_tratamiento" id="bqsaiaenlace_odontologo_tratamiento" value="y" />
		</div></div></div><div class="control-group"><b>N&uacute;mero De Registro<input type="hidden" name="bksaiacondicion_g@registro_tratamiento" id="bksaiacondicion_g@registro_tratamiento" value="like_total"></b><div class="controls"><input type="text" id="registro_tratamiento" name="bqsaia_g@registro_tratamiento"></div></div><input type="hidden" name="campos_especiales" value="odontologo_tratamiento@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_plan_tratamiento g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="idbusqueda_componente" value="182">