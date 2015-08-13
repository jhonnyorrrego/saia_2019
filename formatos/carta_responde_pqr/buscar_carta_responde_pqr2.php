<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Destinos<input type="hidden" name="bksaiacondicion_g@destinos" id="bksaiacondicion_g@destinos" value="like_total"></b><div class="controls"><input type="text" id="destinos" name="bqsaia_g@destinos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@destinos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@destinos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@destinos" id="bqsaiaenlace_g@destinos" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Con Copia A</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__1" id="bksaiacondicion_f@nombre__1" value="like_total"></b><div class="controls"><input type="text"  maxlength="2000"   id="copia-nombre" name="g@copia-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="2000"   id="copia-identificacion" name="g@copia-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="2000"   id="copia-empresa" name="g@copia-empresa" ></div></div></fieldset><br><div class="control-group"><b>Asunto<input type="hidden" name="bksaiacondicion_g@asunto" id="bksaiacondicion_g@asunto" value="like_total"></b><div class="controls"><input type="text" id="asunto" name="bqsaia_g@asunto"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@asunto" id="bqsaiaenlace_g@asunto" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="saludo"><b>Saludo<input type="hidden" name="bksaiacondicion_g@saludo" id="bksaiacondicion_g@saludo" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(212,2264,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_saludo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_saludo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_saludo" id="bqsaiaenlace_saludo" value="y" />
		</div></div></div><div class="control-group"><b>Contenido<input type="hidden" name="bksaiacondicion_g@contenido" id="bksaiacondicion_g@contenido" value="like_total"></b><div class="controls"><textarea  maxlength="4000"   id="contenido" name="bqsaia_g@contenido"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@contenido',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@contenido',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@contenido" id="bqsaiaenlace_g@contenido" value="y" />
		</div></div></div><div class="control-group"><b>Despedida<input type="hidden" name="bksaiacondicion_g@despedida" id="bksaiacondicion_g@despedida" value="like_total"></b><div class="controls"><input type="text" id="despedida" name="bqsaia_g@despedida"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@despedida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@despedida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@despedida" id="bqsaiaenlace_g@despedida" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Con Copia Interna A<input type="hidden" name="bksaiacondicion_copia_interna" id="bksaiacondicion_copia_interna" value="like_total"></b><div id="esperando_copia_interna"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_copia_interna" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia_interna.findItem(htmlentities(document.getElementById('stext_copia_interna').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_interna.findItem(htmlentities(document.getElementById('stext_copia_interna').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia_interna.findItem(htmlentities(document.getElementById('stext_copia_interna').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_copia_interna" height=""></div><input type="hidden" maxlength="2000"  name="g@copia_interna" id="copia_interna"   value="" ><label style="display:none" class="error" for="copia_interna">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_interna=new dhtmlXTreeObject("treeboxbox_copia_interna","","",0);
                			tree_copia_interna.setImagePath("../../imgs/");
                			tree_copia_interna.enableIEImageFix(true);tree_copia_interna.enableCheckBoxes(1);
                			tree_copia_interna.enableThreeStateCheckboxes(1);tree_copia_interna.setOnLoadingStart(cargando_copia_interna);
                      tree_copia_interna.setOnLoadingEnd(fin_cargando_copia_interna);tree_copia_interna.enableSmartXMLParsing(true);tree_copia_interna.loadXML("../../test.php");
                      tree_copia_interna.setOnCheckHandler(onNodeSelect_copia_interna);
                      function onNodeSelect_copia_interna(nodeId)
                      {valor_destino=document.getElementById("copia_interna");
                       destinos=tree_copia_interna.getAllChecked();
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
                      function fin_cargando_copia_interna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_interna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_interna")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_interna"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia_interna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_interna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_interna")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_interna"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="copia@ejecutor,copia_interna@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_carta_responde_pqr g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="idbusqueda_componente" value="0">