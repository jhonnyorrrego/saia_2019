<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><legend id="label_formato" class="legend" style="font-size:9pt;">B&uacute;squeda en formato SOLICITUD DE VACACIONES</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>Responsable<input type="hidden" name="bksaiacondicion_gestio_humana" id="bksaiacondicion_gestio_humana" value="like_total"></b><div id="esperando_gestio_humana"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_gestio_humana" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_gestio_humana.findItem(htmlentities(document.getElementById('stext_gestio_humana').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_gestio_humana.findItem(htmlentities(document.getElementById('stext_gestio_humana').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_gestio_humana.findItem(htmlentities(document.getElementById('stext_gestio_humana').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_gestio_humana" height=""></div><input type="hidden" maxlength="255"  name="g@gestio_humana" id="gestio_humana"   value="" ><label style="display:none" class="error" for="gestio_humana">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_gestio_humana=new dhtmlXTreeObject("treeboxbox_gestio_humana","","",0);
                			tree_gestio_humana.setImagePath("../../imgs/");
                			tree_gestio_humana.enableIEImageFix(true);tree_gestio_humana.enableCheckBoxes(1);
                    tree_gestio_humana.enableRadioButtons(true);tree_gestio_humana.setOnLoadingStart(cargando_gestio_humana);
                      tree_gestio_humana.setOnLoadingEnd(fin_cargando_gestio_humana);tree_gestio_humana.enableSmartXMLParsing(true);tree_gestio_humana.loadXML("../../test.php?rol=1&iddependencia=50");
                      tree_gestio_humana.setOnCheckHandler(onNodeSelect_gestio_humana);
                      function onNodeSelect_gestio_humana(nodeId)
                      {valor_destino=document.getElementById("gestio_humana");
                       destinos=tree_gestio_humana.getAllChecked();
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
                      function fin_cargando_gestio_humana() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gestio_humana")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gestio_humana")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_gestio_humana"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_gestio_humana() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gestio_humana")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gestio_humana")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_gestio_humana"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_gestio_humana',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_gestio_humana',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_gestio_humana" id="bqsaiaenlace_gestio_humana" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_doc"><b>Fecha Documento</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_doc_x" id="bksaiacondicion_g@fecha_doc_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_doc_x" id="fecha_doc_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_doc_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_doc_y" id="bksaiacondicion_g@fecha_doc_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_doc_y" id="fecha_doc_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_doc_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_doc',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_doc',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_doc" id="bqsaiaenlace_fecha_doc" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_ini_vacaciones"><b>Inicio De Vacaciones</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_ini_vacaciones_x" id="bksaiacondicion_g@fecha_ini_vacaciones_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_ini_vacaciones_x" id="fecha_ini_vacaciones_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_ini_vacaciones_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_ini_vacaciones_y" id="bksaiacondicion_g@fecha_ini_vacaciones_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_ini_vacaciones_y" id="fecha_ini_vacaciones_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_ini_vacaciones_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_ini_vacaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_ini_vacaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_ini_vacaciones" id="bqsaiaenlace_fecha_ini_vacaciones" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_fin_vaciones"><b>Fin De Las Vacaciones</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_fin_vaciones_x" id="bksaiacondicion_g@fecha_fin_vaciones_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_fin_vaciones_x" id="fecha_fin_vaciones_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_fin_vaciones_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_fin_vaciones_y" id="bksaiacondicion_g@fecha_fin_vaciones_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_fin_vaciones_y" id="fecha_fin_vaciones_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_fin_vaciones_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_fin_vaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_fin_vaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_fin_vaciones" id="bqsaiaenlace_fecha_fin_vaciones" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_ini_labores"><b>Fecha Inicio De Labores</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_ini_labores_x" id="bksaiacondicion_g@fecha_ini_labores_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_ini_labores_x" id="fecha_ini_labores_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_ini_labores_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_ini_labores_y" id="bksaiacondicion_g@fecha_ini_labores_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_ini_labores_y" id="fecha_ini_labores_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_ini_labores_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></div></div><input type="hidden" name="campos_especiales" value="gestio_humana@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicitud_vaciones g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_doc_x,g@fecha_doc_y,g@fecha_ini_vacaciones_x,g@fecha_ini_vacaciones_y,g@fecha_fin_vaciones_x,g@fecha_fin_vaciones_y,g@fecha_ini_labores_x,g@fecha_ini_labores_y"><input type="hidden" name="idbusqueda_componente" value="153">