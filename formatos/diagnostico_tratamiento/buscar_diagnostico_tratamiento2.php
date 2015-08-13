<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend" style="font-size:9pt;">B&uacute;squeda en formato Diagnostico y plan de tratamiento</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Item<input type="hidden" name="bksaiacondicion_g@item_evolucion" id="bksaiacondicion_g@item_evolucion" value="like_total"></b><div class="controls"><input type="text" id="item_evolucion" name="bqsaia_g@item_evolucion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@item_evolucion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@item_evolucion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@item_evolucion" id="bqsaiaenlace_g@item_evolucion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_diagnostico"><b>Fecha<input type="hidden" name="bksaiacondicion_fecha_diagnostico" id="bksaiacondicion_fecha_diagnostico" value="like_total"></b></label><div class="controls">
                    Entre &nbsp;<input type="text" readonly="true" name="fecha_diagnostico_1"  id="fecha_diagnostico_1" value=""><?php selector_fecha("fecha_diagnostico_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y <input type="text" readonly="true" name="fecha_diagnostico_2"  id="fecha_diagnostico_2" value=""><?php selector_fecha("fecha_diagnostico_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_diagnostico',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_diagnostico',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_diagnostico" id="bqsaiaenlace_fecha_diagnostico" value="y" />
		</div></div></div><div class="control-group"><b>Nombre Del Paciente<input type="hidden" name="bksaiacondicion_g@nombre_diagnosticado" id="bksaiacondicion_g@nombre_diagnosticado" value="like_total"></b><div class="controls"><input type="text" id="nombre_diagnosticado" name="bqsaia_g@nombre_diagnosticado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_diagnosticado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_diagnosticado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_diagnosticado" id="bqsaiaenlace_g@nombre_diagnosticado" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="etiqueta_esqueletico"><b>Esqueletico<input type="hidden" name="bksaiacondicion_etiqueta_esqueletico" id="bksaiacondicion_etiqueta_esqueletico" value="like_total"></b></label></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="sna"><b>Sna<input type="hidden" name="bksaiacondicion_sna" id="bksaiacondicion_sna" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(293,3382,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_sna',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_sna',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_sna" id="bqsaiaenlace_sna" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="snb"><b>Snb<input type="hidden" name="bksaiacondicion_snb" id="bksaiacondicion_snb" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3383,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_snb',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_snb',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_snb" id="bqsaiaenlace_snb" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="anb"><b>Anb<input type="hidden" name="bksaiacondicion_anb" id="bksaiacondicion_anb" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3384,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_anb',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_anb',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_anb" id="bqsaiaenlace_anb" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="mx_md"><b>Mx-md<input type="hidden" name="bksaiacondicion_mx_md" id="bksaiacondicion_mx_md" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3385,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_mx_md',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_mx_md',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_mx_md" id="bqsaiaenlace_mx_md" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="snmd"><b>Snmd<input type="hidden" name="bksaiacondicion_snmd" id="bksaiacondicion_snmd" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3386,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_snmd',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_snmd',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_snmd" id="bqsaiaenlace_snmd" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="wits"><b>Wits<input type="hidden" name="bksaiacondicion_wits" id="bksaiacondicion_wits" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3387,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_wits',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_wits',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_wits" id="bqsaiaenlace_wits" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="etiqueta_dental"><b>Dental<input type="hidden" name="bksaiacondicion_etiqueta_dental" id="bksaiacondicion_etiqueta_dental" value="="></b></label></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="interincisivo"><b>Interincisivo<input type="hidden" name="bksaiacondicion_interincisivo" id="bksaiacondicion_interincisivo" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3389,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_interincisivo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_interincisivo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_interincisivo" id="bqsaiaenlace_interincisivo" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="uno_mx"><b>1 - Mx<input type="hidden" name="bksaiacondicion_uno_mx" id="bksaiacondicion_uno_mx" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3390,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_uno_mx',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_uno_mx',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_uno_mx" id="bqsaiaenlace_uno_mx" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="uno_md"><b>1 - Md<input type="hidden" name="bksaiacondicion_uno_md" id="bksaiacondicion_uno_md" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3391,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_uno_md',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_uno_md',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_uno_md" id="bqsaiaenlace_uno_md" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="etiqueta_meaw"><b>M.e.a.w<input type="hidden" name="bksaiacondicion_etiqueta_meaw" id="bksaiacondicion_etiqueta_meaw" value="like_total"></b></label></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="odi"><b>Odi<input type="hidden" name="bksaiacondicion_odi" id="bksaiacondicion_odi" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(293,3393,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_odi',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_odi',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_odi" id="bqsaiaenlace_odi" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="apdi"><b>Apdi<input type="hidden" name="bksaiacondicion_apdi" id="bksaiacondicion_apdi" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3394,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_apdi',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_apdi',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_apdi" id="bqsaiaenlace_apdi" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="cf"><b>Cf<input type="hidden" name="bksaiacondicion_cf" id="bksaiacondicion_cf" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3395,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_cf',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_cf',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_cf" id="bqsaiaenlace_cf" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="etiqueta_facial"><b>Facial<input type="hidden" name="bksaiacondicion_etiqueta_facial" id="bksaiacondicion_etiqueta_facial" value="like_total"></b></label></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="linea_e_superior"><b>Linea E Sup<input type="hidden" name="bksaiacondicion_linea_e_superior" id="bksaiacondicion_linea_e_superior" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3397,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_linea_e_superior',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_linea_e_superior',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_linea_e_superior" id="bqsaiaenlace_linea_e_superior" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="linea_e_inferior"><b>Linea E Inf<input type="hidden" name="bksaiacondicion_linea_e_inferior" id="bksaiacondicion_linea_e_inferior" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3398,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_linea_e_inferior',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_linea_e_inferior',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_linea_e_inferior" id="bqsaiaenlace_linea_e_inferior" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fhi_ls"><b>Fhi - Ls<input type="hidden" name="bksaiacondicion_fhi_ls" id="bksaiacondicion_fhi_ls" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3399,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fhi_ls',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fhi_ls',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fhi_ls" id="bqsaiaenlace_fhi_ls" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="menor_nl"><b>< - Nl<input type="hidden" name="bksaiacondicion_menor_nl" id="bksaiacondicion_menor_nl" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(293,3400,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_menor_nl',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_menor_nl',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_menor_nl" id="bqsaiaenlace_menor_nl" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Ortodoncista<input type="hidden" name="bksaiacondicion_ortodoncista" id="bksaiacondicion_ortodoncista" value="="></b><div id="esperando_ortodoncista"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_ortodoncista" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_ortodoncista.findItem(htmlentities(document.getElementById('stext_ortodoncista').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_ortodoncista.findItem(htmlentities(document.getElementById('stext_ortodoncista').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_ortodoncista.findItem(htmlentities(document.getElementById('stext_ortodoncista').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_ortodoncista" height=""></div><input type="hidden" maxlength="11"  name="g@ortodoncista" id="ortodoncista"   value="" ><label style="display:none" class="error" for="ortodoncista">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_ortodoncista=new dhtmlXTreeObject("treeboxbox_ortodoncista","","",0);
                			tree_ortodoncista.setImagePath("../../imgs/");
                			tree_ortodoncista.enableIEImageFix(true);tree_ortodoncista.enableCheckBoxes(1);
                    tree_ortodoncista.enableRadioButtons(true);tree_ortodoncista.setOnLoadingStart(cargando_ortodoncista);
                      tree_ortodoncista.setOnLoadingEnd(fin_cargando_ortodoncista);tree_ortodoncista.enableSmartXMLParsing(true);tree_ortodoncista.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_ortodoncista.setOnCheckHandler(onNodeSelect_ortodoncista);
                      function onNodeSelect_ortodoncista(nodeId)
                      {valor_destino=document.getElementById("ortodoncista");
                       destinos=tree_ortodoncista.getAllChecked();
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
                      function fin_cargando_ortodoncista() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_ortodoncista")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_ortodoncista")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_ortodoncista"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_ortodoncista() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_ortodoncista")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_ortodoncista")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_ortodoncista"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ortodoncista',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ortodoncista',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ortodoncista" id="bqsaiaenlace_ortodoncista" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Auxiliar<input type="hidden" name="bksaiacondicion_auxiliar" id="bksaiacondicion_auxiliar" value="like_total"></b><div id="esperando_auxiliar"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_auxiliar" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_auxiliar.findItem(htmlentities(document.getElementById('stext_auxiliar').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_auxiliar.findItem(htmlentities(document.getElementById('stext_auxiliar').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_auxiliar.findItem(htmlentities(document.getElementById('stext_auxiliar').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_auxiliar" height=""></div><input type="hidden" maxlength="255"  name="g@auxiliar" id="auxiliar"   value="" ><label style="display:none" class="error" for="auxiliar">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_auxiliar=new dhtmlXTreeObject("treeboxbox_auxiliar","","",0);
                			tree_auxiliar.setImagePath("../../imgs/");
                			tree_auxiliar.enableIEImageFix(true);tree_auxiliar.enableCheckBoxes(1);
                    tree_auxiliar.enableRadioButtons(true);tree_auxiliar.setOnLoadingStart(cargando_auxiliar);
                      tree_auxiliar.setOnLoadingEnd(fin_cargando_auxiliar);tree_auxiliar.enableSmartXMLParsing(true);tree_auxiliar.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_auxiliar.setOnCheckHandler(onNodeSelect_auxiliar);
                      function onNodeSelect_auxiliar(nodeId)
                      {valor_destino=document.getElementById("auxiliar");
                       destinos=tree_auxiliar.getAllChecked();
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
                      function fin_cargando_auxiliar() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_auxiliar")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_auxiliar")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_auxiliar"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_auxiliar() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_auxiliar")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_auxiliar")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_auxiliar"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_auxiliar',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_auxiliar',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_auxiliar" id="bqsaiaenlace_auxiliar" value="y" />
		</div></div></div><div class="control-group"><b>Esqueletico<input type="hidden" name="bksaiacondicion_g@esqueletico" id="bksaiacondicion_g@esqueletico" value="like_total"></b><div class="controls"><textarea    id="esqueletico" name="bqsaia_g@esqueletico"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@esqueletico',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@esqueletico',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@esqueletico" id="bqsaiaenlace_g@esqueletico" value="y" />
		</div></div></div><div class="control-group"><b>Oclusal<input type="hidden" name="bksaiacondicion_g@oclusal" id="bksaiacondicion_g@oclusal" value="like_total"></b><div class="controls"><textarea    id="oclusal" name="bqsaia_g@oclusal"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@oclusal',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@oclusal',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@oclusal" id="bqsaiaenlace_g@oclusal" value="y" />
		</div></div></div><div class="control-group"><b>Dental<input type="hidden" name="bksaiacondicion_g@dental" id="bksaiacondicion_g@dental" value="like_total"></b><div class="controls"><textarea    id="dental" name="bqsaia_g@dental"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@dental',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@dental',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@dental" id="bqsaiaenlace_g@dental" value="y" />
		</div></div></div><div class="control-group"><b>Tejidos Blandos<input type="hidden" name="bksaiacondicion_g@tejido_blando" id="bksaiacondicion_g@tejido_blando" value="like_total"></b><div class="controls"><textarea    id="tejido_blando" name="bqsaia_g@tejido_blando"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tejido_blando',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tejido_blando',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tejido_blando" id="bqsaiaenlace_g@tejido_blando" value="y" />
		</div></div></div><div class="control-group"><b>Funcional<input type="hidden" name="bksaiacondicion_g@funcional" id="bksaiacondicion_g@funcional" value="like_total"></b><div class="controls"><textarea    id="funcional" name="bqsaia_g@funcional"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@funcional',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@funcional',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@funcional" id="bqsaiaenlace_g@funcional" value="y" />
		</div></div></div><div class="control-group"><b>Plan De Tratamiento<input type="hidden" name="bksaiacondicion_g@plan_tratamiento" id="bksaiacondicion_g@plan_tratamiento" value="like_total"></b><div class="controls"><textarea    id="plan_tratamiento" name="bqsaia_g@plan_tratamiento"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@plan_tratamiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@plan_tratamiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@plan_tratamiento" id="bqsaiaenlace_g@plan_tratamiento" value="y" />
		</div></div></div><div class="control-group"><b>Re-evaluaciones<input type="hidden" name="bksaiacondicion_g@re_evaluaciones" id="bksaiacondicion_g@re_evaluaciones" value="like_total"></b><div class="controls"><textarea    id="re_evaluaciones" name="bqsaia_g@re_evaluaciones"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@re_evaluaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@re_evaluaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@re_evaluaciones" id="bqsaiaenlace_g@re_evaluaciones" value="y" />
		</div></div></div><div class="control-group"><b>Retenci&oacute;n<input type="hidden" name="bksaiacondicion_g@retencion" id="bksaiacondicion_g@retencion" value="like_total"></b><div class="controls"><textarea    id="retencion" name="bqsaia_g@retencion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@retencion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@retencion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@retencion" id="bqsaiaenlace_g@retencion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="plan_preventivo"><b>Plan Preventivo<input type="hidden" name="bksaiacondicion_plan_preventivo" id="bksaiacondicion_plan_preventivo" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(293,3436,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_plan_preventivo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_plan_preventivo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_plan_preventivo" id="bqsaiaenlace_plan_preventivo" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ext_seriada"><b>Ext. Seriada<input type="hidden" name="bksaiacondicion_ext_seriada" id="bksaiacondicion_ext_seriada" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(293,3437,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ext_seriada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ext_seriada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ext_seriada" id="bqsaiaenlace_ext_seriada" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ortopedia"><b>Ortopedia<input type="hidden" name="bksaiacondicion_ortopedia" id="bksaiacondicion_ortopedia" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(293,3438,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ortopedia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ortopedia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ortopedia" id="bqsaiaenlace_ortopedia" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ortopedia_ortodoncia"><b>Ortopedia Y Ortodoncia<input type="hidden" name="bksaiacondicion_ortopedia_ortodoncia" id="bksaiacondicion_ortopedia_ortodoncia" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(293,3439,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ortopedia_ortodoncia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ortopedia_ortodoncia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ortopedia_ortodoncia" id="bqsaiaenlace_ortopedia_ortodoncia" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="otro_tratamiento"><b>Otro<input type="hidden" name="bksaiacondicion_otro_tratamiento" id="bksaiacondicion_otro_tratamiento" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(293,3440,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_otro_tratamiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_otro_tratamiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_otro_tratamiento" id="bqsaiaenlace_otro_tratamiento" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ortodoncia_caso"><b>Ortodoncia 1/2 Caso<input type="hidden" name="bksaiacondicion_ortodoncia_caso" id="bksaiacondicion_ortodoncia_caso" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(293,3441,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ortodoncia_caso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ortodoncia_caso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ortodoncia_caso" id="bqsaiaenlace_ortodoncia_caso" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ortodoncia_no_complicada"><b>Ortodoncia No Complicada<input type="hidden" name="bksaiacondicion_ortodoncia_no_complicada" id="bksaiacondicion_ortodoncia_no_complicada" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(293,3442,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ortodoncia_no_complicada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ortodoncia_no_complicada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ortodoncia_no_complicada" id="bqsaiaenlace_ortodoncia_no_complicada" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ortodoncia"><b>Ortodoncia<input type="hidden" name="bksaiacondicion_ortodoncia" id="bksaiacondicion_ortodoncia" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(293,3443,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ortodoncia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ortodoncia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ortodoncia" id="bqsaiaenlace_ortodoncia" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ortodoncia_cirugia"><b>Ortodoncia Y Cirugia<input type="hidden" name="bksaiacondicion_ortodoncia_cirugia" id="bksaiacondicion_ortodoncia_cirugia" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(293,3444,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ortodoncia_cirugia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ortodoncia_cirugia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ortodoncia_cirugia" id="bqsaiaenlace_ortodoncia_cirugia" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="otro_evaluaciones"><b>Otro<input type="hidden" name="bksaiacondicion_otro_evaluaciones" id="bksaiacondicion_otro_evaluaciones" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(293,3445,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_otro_evaluaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_otro_evaluaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_otro_evaluaciones" id="bqsaiaenlace_otro_evaluaciones" value="y" />
		</div></div></div><div class="control-group"><b>Remisiones Para Procedimientos Especializados<input type="hidden" name="bksaiacondicion_g@remision_procedimiento" id="bksaiacondicion_g@remision_procedimiento" value="like_total"></b><div class="controls"><textarea    id="remision_procedimiento" name="bqsaia_g@remision_procedimiento"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="ortodoncista@arbol,auxiliar@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_diagnostico_tratamiento g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|"><input type="hidden" name="idbusqueda_componente" value="180">