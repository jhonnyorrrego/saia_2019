<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato avances</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><div class="controls"><b>Categoria<input type="hidden" name="bksaiacondicion_categoria" id="bksaiacondicion_categoria" value="like_total"></b><div id="esperando_categoria"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_categoria" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_categoria.findItem(htmlentities(document.getElementById('stext_categoria').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_categoria.findItem(htmlentities(document.getElementById('stext_categoria').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_categoria.findItem(htmlentities(document.getElementById('stext_categoria').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_categoria" height=""></div><input type="hidden" maxlength="255"  name="g@categoria" id="categoria"   value="" ><label style="display:none" class="error" for="categoria">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_categoria=new dhtmlXTreeObject("treeboxbox_categoria","","",0);
                			tree_categoria.setImagePath("../../imgs/");
                			tree_categoria.enableIEImageFix(true);tree_categoria.enableCheckBoxes(1);
                    tree_categoria.enableRadioButtons(true);tree_categoria.setOnLoadingStart(cargando_categoria);
                      tree_categoria.setOnLoadingEnd(fin_cargando_categoria);tree_categoria.enableSmartXMLParsing(true);tree_categoria.loadXML("../../test_serie_funcionario.php?categoria=3&id=884");
                      tree_categoria.setOnCheckHandler(onNodeSelect_categoria);
                      function onNodeSelect_categoria(nodeId)
                      {valor_destino=document.getElementById("categoria");
                       destinos=tree_categoria.getAllChecked();
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
                      function fin_cargando_categoria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_categoria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_categoria")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_categoria"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_categoria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_categoria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_categoria")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_categoria"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_categoria',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_categoria',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_categoria" id="bqsaiaenlace_categoria" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado_proceso"><b>Estado actual<input type="hidden" name="bksaiacondicion_g@estado_proceso" id="bksaiacondicion_g@estado_proceso" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(230,2542,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado_proceso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado_proceso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado_proceso" id="bqsaiaenlace_estado_proceso" value="y" />
		</div></div></div><div class="control-group"><b>Diagnostico<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion" id="bqsaiaenlace_g@descripcion" value="y" />
		</div></div></div><div class="control-group"><b>Insumos<input type="hidden" name="bksaiacondicion_g@insumos" id="bksaiacondicion_g@insumos" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="insumos" name="bqsaia_g@insumos"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@insumos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@insumos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@insumos" id="bqsaiaenlace_g@insumos" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="categoria@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_reporte_avance g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body>