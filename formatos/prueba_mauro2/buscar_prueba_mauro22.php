<?php include_once("../librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Mauro hijo</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>Usuarios<input type="hidden" name="bksaiacondicion_usuarios" id="bksaiacondicion_usuarios" value="="></b><div id="esperando_usuarios"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_usuarios" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_usuarios.findItem(htmlentities(document.getElementById('stext_usuarios').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_usuarios.findItem(htmlentities(document.getElementById('stext_usuarios').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_usuarios.findItem(htmlentities(document.getElementById('stext_usuarios').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_usuarios" height=""></div><input type="hidden" maxlength="11"  name="g@usuarios" id="usuarios"   value="" ><label style="display:none" class="error" for="usuarios">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_usuarios=new dhtmlXTreeObject("treeboxbox_usuarios","","",0);
                			tree_usuarios.setImagePath("../../imgs/");
                			tree_usuarios.enableIEImageFix(true);tree_usuarios.enableCheckBoxes(1);
                    tree_usuarios.enableRadioButtons(true);tree_usuarios.setOnLoadingStart(cargando_usuarios);
                      tree_usuarios.setOnLoadingEnd(fin_cargando_usuarios);tree_usuarios.enableSmartXMLParsing(true);tree_usuarios.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_usuarios.setOnCheckHandler(onNodeSelect_usuarios);
                      function onNodeSelect_usuarios(nodeId)
                      {valor_destino=document.getElementById("usuarios");
                       destinos=tree_usuarios.getAllChecked();
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
                      function fin_cargando_usuarios() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_usuarios")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_usuarios")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_usuarios"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_usuarios() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_usuarios")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_usuarios")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_usuarios"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_usuarios',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_usuarios',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_usuarios" id="bqsaiaenlace_usuarios" value="y" />
		</div></div></div><div class="control-group"><b>texto<input type="hidden" name="bksaiacondicion_g@texto" id="bksaiacondicion_g@texto" value="like_total"></b><div class="controls"><input type="text" id="texto" name="bqsaia_g@texto"></div></div><input type="hidden" name="campos_especiales" value="usuarios@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_prueba_mauro2 g @ AND  g.documento_iddocumento=iddocumento "></body>