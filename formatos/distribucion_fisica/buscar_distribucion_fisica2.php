<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Distribuci&oacute;n F&iacute;&shy;sica</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_documento"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_documento_x" id="bksaiacondicion_g@fecha_documento_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_documento_x" id="fecha_documento_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_documento_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_documento_y" id="bksaiacondicion_g@fecha_documento_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_documento_y" id="fecha_documento_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_documento_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_documento" id="bqsaiaenlace_fecha_documento" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Nombre de mensajero<input type="hidden" name="bksaiacondicion_nombre_mensajero" id="bksaiacondicion_nombre_mensajero" value="like_total"></b><div id="esperando_nombre_mensajero"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_nombre_mensajero" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_nombre_mensajero.findItem((document.getElementById('stext_nombre_mensajero').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre_mensajero.findItem((document.getElementById('stext_nombre_mensajero').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_nombre_mensajero.findItem((document.getElementById('stext_nombre_mensajero').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_nombre_mensajero" height=""></div><input type="hidden" maxlength="255"  name="g@nombre_mensajero" id="nombre_mensajero"   value="" ><label style="display:none" class="error" for="nombre_mensajero">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre_mensajero=new dhtmlXTreeObject("treeboxbox_nombre_mensajero","","",0);
                			tree_nombre_mensajero.setImagePath("../../imgs/");
                			tree_nombre_mensajero.enableIEImageFix(true);tree_nombre_mensajero.enableCheckBoxes(1);
                    tree_nombre_mensajero.enableRadioButtons(true);tree_nombre_mensajero.setOnLoadingStart(cargando_nombre_mensajero);
                      tree_nombre_mensajero.setOnLoadingEnd(fin_cargando_nombre_mensajero);tree_nombre_mensajero.enableSmartXMLParsing(true);tree_nombre_mensajero.loadXML("../../test.php?rol=1");
                      tree_nombre_mensajero.setOnCheckHandler(onNodeSelect_nombre_mensajero);
                      function onNodeSelect_nombre_mensajero(nodeId)
                      {valor_destino=document.getElementById("nombre_mensajero");
                       destinos=tree_nombre_mensajero.getAllChecked();
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
                      function fin_cargando_nombre_mensajero() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_mensajero")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_mensajero")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre_mensajero"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_nombre_mensajero() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_mensajero")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_mensajero")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre_mensajero"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre_mensajero',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre_mensajero',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre_mensajero" id="bqsaiaenlace_nombre_mensajero" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="nivel_urgencia"><b>Estado<input type="hidden" name="bksaiacondicion_g@nivel_urgencia" id="bksaiacondicion_g@nivel_urgencia" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(272,3135,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nivel_urgencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nivel_urgencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nivel_urgencia" id="bqsaiaenlace_g@nivel_urgencia" value="y" />
		</div></div></div><div class="control-group"><b>Destino<input type="hidden" name="bksaiacondicion_g@destino" id="bksaiacondicion_g@destino" value="like_total"></b><div class="controls"><input type="text" id="destino" name="bqsaia_g@destino"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@destino" id="bqsaiaenlace_g@destino" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea  maxlength="4000"   id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="nombre_mensajero@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_distribucion_fisica g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_documento_x,g@fecha_documento_y">