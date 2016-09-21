<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato 2. Proyecto</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Nombre del proyecto<input type="hidden" name="bksaiacondicion_g@nombre_proyecto" id="bksaiacondicion_g@nombre_proyecto" value="like_total"></b><div class="controls"><input type="text" id="nombre_proyecto" name="bqsaia_g@nombre_proyecto"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_proyecto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_proyecto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_proyecto" id="bqsaiaenlace_g@nombre_proyecto" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n proyecto<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea    id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion" id="bqsaiaenlace_g@descripcion" value="y" />
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
                      tree_empresa_asociada.setOnLoadingEnd(fin_cargando_empresa_asociada);tree_empresa_asociada.enableSmartXMLParsing(true);tree_empresa_asociada.loadXML("../../test_serie.php?sin_padre=1&id=932&tabla=serie");
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
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_empresa_asociada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_empresa_asociada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_empresa_asociada" id="bqsaiaenlace_empresa_asociada" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="moneda"><b>Moneda del proyecto<input type="hidden" name="bksaiacondicion_g@moneda" id="bksaiacondicion_g@moneda" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(250,2864,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@moneda',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@moneda',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@moneda" id="bqsaiaenlace_g@moneda" value="y" />
		</div></div></div><div class="control-group"><b>Valor del Proyecto<input type="hidden" name="bksaiacondicion_g@valor" id="bksaiacondicion_g@valor" value="like_total"></b><div class="controls"><input type="text" id="valor" name="bqsaia_g@valor"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@valor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@valor',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@valor" id="bqsaiaenlace_g@valor" value="y" />
		</div></div></div><div class="control-group"><b>Forma de pago<input type="hidden" name="bksaiacondicion_g@forma_pago" id="bksaiacondicion_g@forma_pago" value="like_total"></b><div class="controls"><input type="text" id="forma_pago" name="bqsaia_g@forma_pago"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@forma_pago',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@forma_pago',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@forma_pago" id="bqsaiaenlace_g@forma_pago" value="y" />
		</div></div></div><div class="control-group"><b>Tiempo de Duraci&oacute;n<input type="hidden" name="bksaiacondicion_g@duracion" id="bksaiacondicion_g@duracion" value="like_total"></b><div class="controls"><input type="text" id="duracion" name="bqsaia_g@duracion"></div></div><input type="hidden" name="campos_especiales" value="empresa_asociada@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_proyecto_registro_cliente g @ AND  g.documento_iddocumento=iddocumento "></body>