<?php include_once("../librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Funcionarios Ausentes</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>Funcionario ausente<input type="hidden" name="bksaiacondicion_funcionario_ausente" id="bksaiacondicion_funcionario_ausente" value="like_total"></b><div id="esperando_funcionario_ausente"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_funcionario_ausente" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_funcionario_ausente.findItem(htmlentities(document.getElementById('stext_funcionario_ausente').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_funcionario_ausente.findItem(htmlentities(document.getElementById('stext_funcionario_ausente').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_funcionario_ausente.findItem(htmlentities(document.getElementById('stext_funcionario_ausente').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_funcionario_ausente" height=""></div><input type="hidden" maxlength="255"  name="g@funcionario_ausente" id="funcionario_ausente"   value="" ><label style="display:none" class="error" for="funcionario_ausente">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_funcionario_ausente=new dhtmlXTreeObject("treeboxbox_funcionario_ausente","","",0);
                			tree_funcionario_ausente.setImagePath("../../imgs/");
                			tree_funcionario_ausente.enableIEImageFix(true);tree_funcionario_ausente.enableCheckBoxes(1);
                    tree_funcionario_ausente.enableRadioButtons(true);tree_funcionario_ausente.setOnLoadingStart(cargando_funcionario_ausente);
                      tree_funcionario_ausente.setOnLoadingEnd(fin_cargando_funcionario_ausente);tree_funcionario_ausente.enableSmartXMLParsing(true);tree_funcionario_ausente.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_funcionario_ausente.setOnCheckHandler(onNodeSelect_funcionario_ausente);
                      function onNodeSelect_funcionario_ausente(nodeId)
                      {valor_destino=document.getElementById("funcionario_ausente");
                       destinos=tree_funcionario_ausente.getAllChecked();
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
                      function fin_cargando_funcionario_ausente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_funcionario_ausente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_funcionario_ausente")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_funcionario_ausente"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_funcionario_ausente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_funcionario_ausente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_funcionario_ausente")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_funcionario_ausente"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_funcionario_ausente',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_funcionario_ausente',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_funcionario_ausente" id="bqsaiaenlace_funcionario_ausente" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="justificada"><b>Ausencia justificada<input type="hidden" name="bksaiacondicion_g@justificada" id="bksaiacondicion_g@justificada" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(310,3652,'',1,'buscar');?></div></div><input type="hidden" name="campos_especiales" value="funcionario_ausente@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_ausentes_acta g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="ausentes_acta"></body>