<?php include_once("../librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato destino_radicacion</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>Destino*<input type="hidden" name="bksaiacondicion_nombre_destino" id="bksaiacondicion_nombre_destino" value="like_total"></b><div id="esperando_nombre_destino"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_nombre_destino" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_nombre_destino.findItem((document.getElementById('stext_nombre_destino').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre_destino.findItem((document.getElementById('stext_nombre_destino').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_nombre_destino.findItem((document.getElementById('stext_nombre_destino').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_nombre_destino" height=""></div><input type="hidden" maxlength="255"  name="g@nombre_destino" id="nombre_destino"   value="" ><label style="display:none" class="error" for="nombre_destino">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre_destino=new dhtmlXTreeObject("treeboxbox_nombre_destino","","",0);
                			tree_nombre_destino.setImagePath("../../imgs/");
                			tree_nombre_destino.enableIEImageFix(true);tree_nombre_destino.enableCheckBoxes(1);
                    tree_nombre_destino.enableRadioButtons(true);tree_nombre_destino.setOnLoadingStart(cargando_nombre_destino);
                      tree_nombre_destino.setOnLoadingEnd(fin_cargando_nombre_destino);tree_nombre_destino.enableSmartXMLParsing(true);tree_nombre_destino.loadXML("../../test.php?sin_padre=1&rol=1");
                      tree_nombre_destino.setOnCheckHandler(onNodeSelect_nombre_destino);
                      function onNodeSelect_nombre_destino(nodeId)
                      {valor_destino=document.getElementById("nombre_destino");
                       destinos=tree_nombre_destino.getAllChecked();
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
                      function fin_cargando_nombre_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_destino")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre_destino"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_nombre_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_destino")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre_destino"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre_destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre_destino" id="bqsaiaenlace_nombre_destino" value="y" />
		</div></div></div><div class="control-group"><b>Observaci&oacute;n<input type="hidden" name="bksaiacondicion_g@observacion_destino" id="bksaiacondicion_g@observacion_destino" value="like_total"></b><div class="controls"><input type="text" id="observacion_destino" name="bqsaia_g@observacion_destino"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@observacion_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@observacion_destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@observacion_destino" id="bqsaiaenlace_g@observacion_destino" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Destino*</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__2" id="bksaiacondicion_f@nombre__2" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="destino_externo-nombre" name="g@destino_externo-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="destino_externo-identificacion" name="g@destino_externo-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="destino_externo-empresa" name="g@destino_externo-empresa" ></div></div></fieldset><br><input type="hidden" name="campos_especiales" value="nombre_destino@arbol,destino_externo@ejecutor"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_destino_radicacion g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="destino_radicacion"></body>