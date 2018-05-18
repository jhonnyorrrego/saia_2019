<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Documentos en formato (WORD)</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Asunto<input type="hidden" name="bksaiacondicion_g@asunto_word" id="bksaiacondicion_g@asunto_word" value="like_total"></b><div class="controls"><input type="text" id="asunto_word" name="bqsaia_g@asunto_word"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@asunto_word',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@asunto_word',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@asunto_word" id="bqsaiaenlace_g@asunto_word" value="y" />
		</div></div></div><div class="control-group"><b>Contenido<input type="hidden" name="bksaiacondicion_g@contenido_word" id="bksaiacondicion_g@contenido_word" value="like_total"></b><div class="controls"><textarea    id="contenido_word" name="bqsaia_g@contenido_word"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@contenido_word',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@contenido_word',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@contenido_word" id="bqsaiaenlace_g@contenido_word" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Clasificar en expediente<input type="hidden" name="bksaiacondicion_clasifica_expediente" id="bksaiacondicion_clasifica_expediente" value="like_total"></b><div id="esperando_clasifica_expediente"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><div id="treeboxbox_clasifica_expediente" height=""></div><input type="hidden" maxlength="255"  name="g@clasifica_expediente" id="clasifica_expediente"   value="" ><label style="display:none" class="error" for="clasifica_expediente">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_clasifica_expediente=new dhtmlXTreeObject("treeboxbox_clasifica_expediente","","",0);
                			tree_clasifica_expediente.setImagePath("../../imgs/");
                			tree_clasifica_expediente.enableIEImageFix(true);tree_clasifica_expediente.enableCheckBoxes(1);
                    tree_clasifica_expediente.enableRadioButtons(true);tree_clasifica_expediente.setOnLoadingStart(cargando_clasifica_expediente);
                      tree_clasifica_expediente.setOnLoadingEnd(fin_cargando_clasifica_expediente);tree_clasifica_expediente.setXMLAutoLoading("../../test_expediente_serie.php?estado=1&carga_partes_serie=1&sin_padre_expediente=1");tree_clasifica_expediente.loadXML("../../test_expediente_serie.php?estado=1&carga_partes_serie=1&sin_padre_expediente=1");
                      tree_clasifica_expediente.setOnCheckHandler(onNodeSelect_clasifica_expediente);
                      function onNodeSelect_clasifica_expediente(nodeId)
                      {valor_destino=document.getElementById("clasifica_expediente");
                       destinos=tree_clasifica_expediente.getAllChecked();
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
                      function fin_cargando_clasifica_expediente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_clasifica_expediente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_clasifica_expediente")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_clasifica_expediente"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_clasifica_expediente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_clasifica_expediente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_clasifica_expediente")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_clasifica_expediente"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="clasifica_expediente@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_oficio_word g @ AND  g.documento_iddocumento=iddocumento "></body>