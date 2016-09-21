<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato 1. Documentaci&oacute;n legal</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@observaciones" id="bqsaiaenlace_g@observaciones" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Tipo de documento<input type="hidden" name="bksaiacondicion_tipo_documento" id="bksaiacondicion_tipo_documento" value="like_total"></b><div id="esperando_tipo_documento"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_tipo_documento" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_tipo_documento.findItem(htmlentities(document.getElementById('stext_tipo_documento').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_tipo_documento.findItem(htmlentities(document.getElementById('stext_tipo_documento').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_tipo_documento.findItem(htmlentities(document.getElementById('stext_tipo_documento').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_tipo_documento" height=""></div><input type="hidden"  name="g@tipo_documento" id="tipo_documento"   value="" ><label style="display:none" class="error" for="tipo_documento">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_tipo_documento=new dhtmlXTreeObject("treeboxbox_tipo_documento","","",0);
                			tree_tipo_documento.setImagePath("../../imgs/");
                			tree_tipo_documento.enableIEImageFix(true);tree_tipo_documento.enableCheckBoxes(1);
                    tree_tipo_documento.enableRadioButtons(true);tree_tipo_documento.setOnLoadingStart(cargando_tipo_documento);
                      tree_tipo_documento.setOnLoadingEnd(fin_cargando_tipo_documento);tree_tipo_documento.enableSmartXMLParsing(true);tree_tipo_documento.loadXML("../../test_serie.php?sin_padre=1&id=929&tabla=serie");
                      tree_tipo_documento.setOnCheckHandler(onNodeSelect_tipo_documento);
                      function onNodeSelect_tipo_documento(nodeId)
                      {valor_destino=document.getElementById("tipo_documento");
                       destinos=tree_tipo_documento.getAllChecked();
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
                      function fin_cargando_tipo_documento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_documento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_documento")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_tipo_documento"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_tipo_documento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_documento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_documento")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_tipo_documento"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_documento" id="bqsaiaenlace_tipo_documento" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha"><b>Fecha del documento</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_x" id="bksaiacondicion_g@fecha_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_x" id="fecha_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_y" id="bksaiacondicion_g@fecha_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_y" id="fecha_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></div></div><input type="hidden" name="campos_especiales" value="tipo_documento@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_documentacion_legal g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_x,g@fecha_y">