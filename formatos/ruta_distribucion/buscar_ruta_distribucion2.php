<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Rutas de Distribuci&oacute;n</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_ruta_distribuc"><b>Fecha<input type="hidden" name="bksaiacondicion_g@fecha_ruta_distribuc" id="bksaiacondicion_g@fecha_ruta_distribuc" value="date"></b></label><div class="controls">
                   <input type="text" readonly="true" style="width: 100px;" name="bqsaia_g@fecha_ruta_distribuc" id="fecha_ruta_distribuc" tipo="fecha" value=""><?php selector_fecha("fecha_ruta_distribuc","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></form><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha_ruta_distribuc',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha_ruta_distribuc',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha_ruta_distribuc" id="bqsaiaenlace_g@fecha_ruta_distribuc" value="y" />
		</div></div></div><div class="control-group"><b>Nombre de la Ruta<input type="hidden" name="bksaiacondicion_g@nombre_ruta" id="bksaiacondicion_g@nombre_ruta" value="like_total"></b><div class="controls"><input type="text" id="nombre_ruta" name="bqsaia_g@nombre_ruta"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_ruta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_ruta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_ruta" id="bqsaiaenlace_g@nombre_ruta" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&Oacute;n ruta<input type="hidden" name="bksaiacondicion_g@descripcion_ruta" id="bksaiacondicion_g@descripcion_ruta" value="like_total"></b><div class="controls"><textarea    id="descripcion_ruta" name="bqsaia_g@descripcion_ruta"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_ruta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_ruta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_ruta" id="bqsaiaenlace_g@descripcion_ruta" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Dependencias de la Ruta<input type="hidden" name="bksaiacondicion_asignar_dependencias" id="bksaiacondicion_asignar_dependencias" value="like_total"></b><div id="esperando_asignar_dependencias"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_asignar_dependencias" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_asignar_dependencias.findItem((document.getElementById('stext_asignar_dependencias').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_asignar_dependencias.findItem((document.getElementById('stext_asignar_dependencias').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_asignar_dependencias.findItem((document.getElementById('stext_asignar_dependencias').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_asignar_dependencias" height=""></div><input type="hidden"  name="g@asignar_dependencias" id="asignar_dependencias"   value="" ><label style="display:none" class="error" for="asignar_dependencias">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_asignar_dependencias=new dhtmlXTreeObject("treeboxbox_asignar_dependencias","","",0);
                			tree_asignar_dependencias.setImagePath("../../imgs/");
                			tree_asignar_dependencias.enableIEImageFix(true);tree_asignar_dependencias.enableCheckBoxes(1);
                			tree_asignar_dependencias.enableThreeStateCheckboxes(1);tree_asignar_dependencias.setOnLoadingStart(cargando_asignar_dependencias);
                      tree_asignar_dependencias.setOnLoadingEnd(fin_cargando_asignar_dependencias);tree_asignar_dependencias.enableSmartXMLParsing(true);tree_asignar_dependencias.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_asignar_dependencias.setOnCheckHandler(onNodeSelect_asignar_dependencias);
                      function onNodeSelect_asignar_dependencias(nodeId)
                      {valor_destino=document.getElementById("asignar_dependencias");
                       destinos=tree_asignar_dependencias.getAllChecked();
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
                      function fin_cargando_asignar_dependencias() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_asignar_dependencias")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_asignar_dependencias")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_asignar_dependencias"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_asignar_dependencias() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_asignar_dependencias")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_asignar_dependencias")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_asignar_dependencias"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_asignar_dependencias',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_asignar_dependencias',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_asignar_dependencias" id="bqsaiaenlace_asignar_dependencias" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="asignar_mensajeros"><b>Mensajeros de la Ruta<input type="hidden" name="bksaiacondicion_g@asignar_mensajeros" id="bksaiacondicion_g@asignar_mensajeros" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(404,4999,'',1,'buscar');?></div></div><input type="hidden" name="campos_especiales" value="asignar_dependencias@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_ruta_distribucion g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|">