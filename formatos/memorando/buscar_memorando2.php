<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Comunicaci&oacute;n Interna</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>Destino<input type="hidden" name="bksaiacondicion_destino" id="bksaiacondicion_destino" value="like_total"></b><div id="esperando_destino"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_destino" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_destino" height=""></div><input type="hidden" maxlength="2000"  name="g@destino" id="destino"   value="" ><label style="display:none" class="error" for="destino">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_destino=new dhtmlXTreeObject("treeboxbox_destino","","",0);
                			tree_destino.setImagePath("../../imgs/");
                			tree_destino.enableIEImageFix(true);tree_destino.enableCheckBoxes(1);
                			tree_destino.enableThreeStateCheckboxes(1);tree_destino.setOnLoadingStart(cargando_destino);
                      tree_destino.setOnLoadingEnd(fin_cargando_destino);tree_destino.enableSmartXMLParsing(true);tree_destino.loadXML("../../test.php?rol=1");
                      tree_destino.setOnCheckHandler(onNodeSelect_destino);
                      function onNodeSelect_destino(nodeId)
                      {valor_destino=document.getElementById("destino");
                       destinos=tree_destino.getAllChecked();
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
                      function fin_cargando_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_destino"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_destino"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_destino" id="bqsaiaenlace_destino" value="y" />
		</div></div></div><div class="control-group"><b>Asunto<input type="hidden" name="bksaiacondicion_g@asunto" id="bksaiacondicion_g@asunto" value="like_total"></b><div class="controls"><input type="text" id="asunto" name="bqsaia_g@asunto"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@asunto" id="bqsaiaenlace_g@asunto" value="y" />
		</div></div></div><div class="control-group"><b>Contenido<input type="hidden" name="bksaiacondicion_g@contenido" id="bksaiacondicion_g@contenido" value="like_total"></b><div class="controls"><textarea    id="contenido" name="bqsaia_g@contenido"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@contenido',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@contenido',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@contenido" id="bqsaiaenlace_g@contenido" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="email_aprobar"><b>Aprobar fuera de SAIA<input type="hidden" name="bksaiacondicion_g@email_aprobar" id="bksaiacondicion_g@email_aprobar" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(2,5176,'',1,'buscar');?></div></div><input type="hidden" name="campos_especiales" value="destino@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_memorando g @ AND  g.documento_iddocumento=iddocumento "></body>