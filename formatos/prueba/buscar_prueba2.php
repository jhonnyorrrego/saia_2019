<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato prueba</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>roles<input type="hidden" name="bksaiacondicion_roles" id="bksaiacondicion_roles" value="="></b><div id="esperando_roles"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_roles" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_roles.findItem(htmlentities(document.getElementById('stext_roles').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_roles.findItem(htmlentities(document.getElementById('stext_roles').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_roles.findItem(htmlentities(document.getElementById('stext_roles').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_roles" height=""></div><input type="hidden" maxlength="11"  name="g@roles" id="roles"   value="" ><label style="display:none" class="error" for="roles">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_roles=new dhtmlXTreeObject("treeboxbox_roles","","",0);
                			tree_roles.setImagePath("../../imgs/");
                			tree_roles.enableIEImageFix(true);tree_roles.enableCheckBoxes(1);
                			tree_roles.enableThreeStateCheckboxes(1);tree_roles.setOnLoadingStart(cargando_roles);
                      tree_roles.setOnLoadingEnd(fin_cargando_roles);tree_roles.enableSmartXMLParsing(true);tree_roles.loadXML("../../test.php?rol=1");
                      tree_roles.setOnCheckHandler(onNodeSelect_roles);
                      function onNodeSelect_roles(nodeId)
                      {valor_destino=document.getElementById("roles");
                       destinos=tree_roles.getAllChecked();
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
                      function fin_cargando_roles() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_roles")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_roles")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_roles"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_roles() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_roles")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_roles")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_roles"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_roles',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_roles',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_roles" id="bqsaiaenlace_roles" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="sexo_funcionario"><b>Sexo<input type="hidden" name="bksaiacondicion_g@sexo_funcionario" id="bksaiacondicion_g@sexo_funcionario" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(244,3820,'',1,'buscar');?></div></div><input type="hidden" name="campos_especiales" value="roles@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_prueba g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="idbusqueda_componente" value="154">