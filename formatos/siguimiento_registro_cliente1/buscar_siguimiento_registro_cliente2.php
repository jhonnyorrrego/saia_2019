<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="forma_contacto"><b>Forma de Contacto<input type="hidden" name="bksaiacondicion_g@forma_contacto" id="bksaiacondicion_g@forma_contacto" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(246,2807,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@forma_contacto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@forma_contacto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@forma_contacto" id="bqsaiaenlace_g@forma_contacto" value="y" />
		</div></div></div><div class="control-group"><b>Resultado del Seguimiento<input type="hidden" name="bksaiacondicion_g@resultado_seguimiento" id="bksaiacondicion_g@resultado_seguimiento" value="like_total"></b><div class="controls"><input type="text" id="resultado_seguimiento" name="bqsaia_g@resultado_seguimiento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@resultado_seguimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@resultado_seguimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@resultado_seguimiento" id="bqsaiaenlace_g@resultado_seguimiento" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado_cliente"><b>Estado del Cliente<input type="hidden" name="bksaiacondicion_g@estado_cliente" id="bksaiacondicion_g@estado_cliente" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(246,2810,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@estado_cliente',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@estado_cliente',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@estado_cliente" id="bqsaiaenlace_g@estado_cliente" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="envio_propuesta"><b>Se envi&oacute; propuesta<input type="hidden" name="bksaiacondicion_g@envio_propuesta" id="bksaiacondicion_g@envio_propuesta" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(246,2811,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@envio_propuesta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@envio_propuesta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@envio_propuesta" id="bqsaiaenlace_g@envio_propuesta" value="y" />
		</div></div></div><div class="control-group"><b>Nombre de la propuesta<input type="hidden" name="bksaiacondicion_g@nombre_propuesta" id="bksaiacondicion_g@nombre_propuesta" value="like_total"></b><div class="controls"><input type="text" id="nombre_propuesta" name="bqsaia_g@nombre_propuesta"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_propuesta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_propuesta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_propuesta" id="bqsaiaenlace_g@nombre_propuesta" value="y" />
		</div></div></div><div class="control-group"><b>Nombre del Producto o Servicio<input type="hidden" name="bksaiacondicion_g@nombre_producto_servicio" id="bksaiacondicion_g@nombre_producto_servicio" value="like_total"></b><div class="controls"><input type="text" id="nombre_producto_servicio" name="bqsaia_g@nombre_producto_servicio"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_producto_servicio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_producto_servicio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_producto_servicio" id="bqsaiaenlace_g@nombre_producto_servicio" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Empresa Asociada<input type="hidden" name="bksaiacondicion_empresa_asociada" id="bksaiacondicion_empresa_asociada" value="like_total"></b><div id="esperando_empresa_asociada"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_empresa_asociada" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_empresa_asociada.findItem(htmlentities(document.getElementById('stext_empresa_asociada').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_empresa_asociada.findItem(htmlentities(document.getElementById('stext_empresa_asociada').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_empresa_asociada.findItem(htmlentities(document.getElementById('stext_empresa_asociada').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_empresa_asociada" height=""></div><input type="hidden"  name="g@empresa_asociada" id="empresa_asociada"   value="" ><label style="display:none" class="error" for="empresa_asociada">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_empresa_asociada=new dhtmlXTreeObject("treeboxbox_empresa_asociada","","",0);
                			tree_empresa_asociada.setImagePath("../../imgs/");
                			tree_empresa_asociada.enableIEImageFix(true);tree_empresa_asociada.enableCheckBoxes(1);
                    tree_empresa_asociada.enableRadioButtons(true);tree_empresa_asociada.setOnLoadingStart(cargando_empresa_asociada);
                      tree_empresa_asociada.setOnLoadingEnd(fin_cargando_empresa_asociada);tree_empresa_asociada.enableSmartXMLParsing(true);tree_empresa_asociada.loadXML("../../test.php?sin_padre=1&iddependencia=");
                      tree_empresa_asociada.setOnCheckHandler(onNodeSelect_empresa_asociada);
                      function onNodeSelect_empresa_asociada(nodeId)
                      {valor_destino=document.getElementById("empresa_asociada");
                       destinos=tree_empresa_asociada.getAllChecked();
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
                      function fin_cargando_empresa_asociada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_empresa_asociada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_empresa_asociada")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_empresa_asociada"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_empresa_asociada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_empresa_asociada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_empresa_asociada")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_empresa_asociada"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="empresa_asociada@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_siguimiento_registro_cliente g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="idbusqueda_componente" value="112">