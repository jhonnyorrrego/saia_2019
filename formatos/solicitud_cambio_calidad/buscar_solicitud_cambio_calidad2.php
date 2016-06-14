<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Solicitud de Elaboraci&Atilde;&sup3;n, Modificaci&Atilde;&sup3;n, Eliminaci&Atilde;&sup3;n de Documentos de Calidad</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_vigencia"><b>Fecha Vigencia<input type="hidden" name="bksaiacondicion_fecha_vigencia" id="bksaiacondicion_fecha_vigencia" value="like_total"></b></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="fecha_vigencia_1"  id="fecha_vigencia_1" value=""><?php selector_fecha("fecha_vigencia_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_vigencia_2"  id="fecha_vigencia_2" value=""><?php selector_fecha("fecha_vigencia_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_vigencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_vigencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_vigencia" id="bqsaiaenlace_fecha_vigencia" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Firma Coordinador de Calidad <input type="hidden" name="bksaiacondicion_firma_sgc" id="bksaiacondicion_firma_sgc" value="like_total"></b><div id="esperando_firma_sgc"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_firma_sgc" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_firma_sgc.findItem(htmlentities(document.getElementById('stext_firma_sgc').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_firma_sgc.findItem(htmlentities(document.getElementById('stext_firma_sgc').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_firma_sgc.findItem(htmlentities(document.getElementById('stext_firma_sgc').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_firma_sgc" height=""></div><input type="hidden" maxlength="200"  name="g@firma_sgc" id="firma_sgc"   value="" ><label style="display:none" class="error" for="firma_sgc">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_firma_sgc=new dhtmlXTreeObject("treeboxbox_firma_sgc","","",0);
                			tree_firma_sgc.setImagePath("../../imgs/");
                			tree_firma_sgc.enableIEImageFix(true);tree_firma_sgc.enableCheckBoxes(1);
                			tree_firma_sgc.enableThreeStateCheckboxes(1);tree_firma_sgc.setOnLoadingStart(cargando_firma_sgc);
                      tree_firma_sgc.setOnLoadingEnd(fin_cargando_firma_sgc);tree_firma_sgc.enableSmartXMLParsing(true);tree_firma_sgc.loadXML("../../test.php");
                      tree_firma_sgc.setOnCheckHandler(onNodeSelect_firma_sgc);
                      function onNodeSelect_firma_sgc(nodeId)
                      {valor_destino=document.getElementById("firma_sgc");
                       destinos=tree_firma_sgc.getAllChecked();
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
                      function fin_cargando_firma_sgc() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_firma_sgc")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_firma_sgc")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_firma_sgc"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_firma_sgc() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_firma_sgc")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_firma_sgc")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_firma_sgc"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_firma_sgc',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_firma_sgc',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_firma_sgc" id="bqsaiaenlace_firma_sgc" value="y" />
		</div></div></div><div class="control-group"><b>Propuesta<input type="hidden" name="bksaiacondicion_g@propuesta" id="bksaiacondicion_g@propuesta" value="like_total"></b><div class="controls"><textarea  maxlength="3500"   id="propuesta" name="bqsaia_g@propuesta"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="firma_sgc@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicitud_cambio_calidad g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|">