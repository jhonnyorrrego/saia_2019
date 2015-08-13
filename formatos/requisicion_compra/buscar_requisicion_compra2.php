<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato requisicion orden de compra</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Estado<input type="hidden" name="bksaiacondicion_g@phstat" id="bksaiacondicion_g@phstat" value="like_total"></b><div class="controls"><input type="text" id="phstat" name="bqsaia_g@phstat"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@phstat',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@phstat',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@phstat" id="bqsaiaenlace_g@phstat" value="y" />
		</div></div></div><div class="control-group"><b>codigo de la compa&ntilde;ia<input type="hidden" name="bksaiacondicion_g@phcomp" id="bksaiacondicion_g@phcomp" value="like_total"></b><div class="controls"><input type="text" id="phcomp" name="bqsaia_g@phcomp"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@phcomp',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@phcomp',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@phcomp" id="bqsaiaenlace_g@phcomp" value="y" />
		</div></div></div><div class="control-group"><b>codigo de la instalacion<input type="hidden" name="bksaiacondicion_g@phfac" id="bksaiacondicion_g@phfac" value="like_total"></b><div class="controls"><input type="text" id="phfac" name="bqsaia_g@phfac"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@phfac',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@phfac',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@phfac" id="bqsaiaenlace_g@phfac" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>codigo quien recibe mercancia<input type="hidden" name="bksaiacondicion_phship" id="bksaiacondicion_phship" value="like_total"></b><div id="esperando_phship"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_phship" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_phship.findItem(htmlentities(document.getElementById('stext_phship').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_phship.findItem(htmlentities(document.getElementById('stext_phship').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_phship.findItem(htmlentities(document.getElementById('stext_phship').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_phship" height=""></div><input type="hidden" maxlength="255"  name="g@phship" id="phship"   value="" ><label style="display:none" class="error" for="phship">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_phship=new dhtmlXTreeObject("treeboxbox_phship","","",0);
                			tree_phship.setImagePath("../../imgs/");
                			tree_phship.enableIEImageFix(true);tree_phship.enableCheckBoxes(1);
                			tree_phship.enableThreeStateCheckboxes(1);tree_phship.setOnLoadingStart(cargando_phship);
                      tree_phship.setOnLoadingEnd(fin_cargando_phship);tree_phship.enableSmartXMLParsing(true);tree_phship.loadXML("../../test.php?rol=1");
                      tree_phship.setOnCheckHandler(onNodeSelect_phship);
                      function onNodeSelect_phship(nodeId)
                      {valor_destino=document.getElementById("phship");
                       destinos=tree_phship.getAllChecked();
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
                      function fin_cargando_phship() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_phship")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_phship")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_phship"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_phship() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_phship")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_phship")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_phship"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_phship',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_phship',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_phship" id="bqsaiaenlace_phship" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="phendt"><b>fecha de creacion orden</b></label>
                  <input type="hidden" name="bksaiacondicion_g@phendt_x" id="bksaiacondicion_g@phendt_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@phendt_x" id="phendt_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("phendt_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@phendt_y" id="bksaiacondicion_g@phendt_y" value="<=">
                  <input type="text"  name="bqsaia_g@phendt_y" id="phendt_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("phendt_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_phendt',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_phendt',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_phendt" id="bqsaiaenlace_phendt" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="phcur"><b>moneda de la operacion<input type="hidden" name="bksaiacondicion_g@phcur" id="bksaiacondicion_g@phcur" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(315,3695,'',1,'buscar');?></div></div><input type="hidden" name="campos_especiales" value="phship@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_requisicion_compra g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@phendt_x,g@phendt_y"><input type="hidden" name="idbusqueda_componente" value="">