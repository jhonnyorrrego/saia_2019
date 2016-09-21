<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Registro de Cliente</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Nombre del Cliente</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__0" id="bksaiacondicion_f@nombre__0" value="="></b><div class="controls"><input type="text"  maxlength="11"   id="nombre_cliente-nombre" name="g@nombre_cliente-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="11"   id="nombre_cliente-identificacion" name="g@nombre_cliente-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="11"   id="nombre_cliente-empresa" name="g@nombre_cliente-empresa" ></div></div></fieldset><br><div class="control-group"><b>Descripci&oacute;n de origen del contacto<input type="hidden" name="bksaiacondicion_g@descripcion_origen_contacto" id="bksaiacondicion_g@descripcion_origen_contacto" value="like_total"></b><div class="controls"><textarea    id="descripcion_origen_contacto" name="bqsaia_g@descripcion_origen_contacto"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_origen_contacto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_origen_contacto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_origen_contacto" id="bqsaiaenlace_g@descripcion_origen_contacto" value="y" />
		</div></div></div><div class="control-group"><b>Pagina Web<input type="hidden" name="bksaiacondicion_g@pagina_web" id="bksaiacondicion_g@pagina_web" value="like_total"></b><div class="controls"><input type="text" id="pagina_web" name="bqsaia_g@pagina_web"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@pagina_web',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@pagina_web',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@pagina_web" id="bqsaiaenlace_g@pagina_web" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado_cliente"><b>Estado del Cliente<input type="hidden" name="bksaiacondicion_g@estado_cliente" id="bksaiacondicion_g@estado_cliente" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(245,2786,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@estado_cliente',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@estado_cliente',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@estado_cliente" id="bqsaiaenlace_g@estado_cliente" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Sector<input type="hidden" name="bksaiacondicion_sector" id="bksaiacondicion_sector" value="like_total"></b><div id="esperando_sector"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_sector" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_sector.findItem(htmlentities(document.getElementById('stext_sector').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_sector.findItem(htmlentities(document.getElementById('stext_sector').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_sector.findItem(htmlentities(document.getElementById('stext_sector').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_sector" height=""></div><input type="hidden" maxlength="255"  name="g@sector" id="sector"   value="" ><label style="display:none" class="error" for="sector">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_sector=new dhtmlXTreeObject("treeboxbox_sector","","",0);
                			tree_sector.setImagePath("../../imgs/");
                			tree_sector.enableIEImageFix(true);tree_sector.enableCheckBoxes(1);
                    tree_sector.enableRadioButtons(true);tree_sector.setOnLoadingStart(cargando_sector);
                      tree_sector.setOnLoadingEnd(fin_cargando_sector);tree_sector.enableSmartXMLParsing(true);tree_sector.loadXML("../../test_serie.php?sin_padre=1&id=916&tabla=serie");
                      tree_sector.setOnCheckHandler(onNodeSelect_sector);
                      function onNodeSelect_sector(nodeId)
                      {valor_destino=document.getElementById("sector");
                       destinos=tree_sector.getAllChecked();
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
                      function fin_cargando_sector() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_sector")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_sector")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_sector"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_sector() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_sector")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_sector")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_sector"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_sector',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_sector',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_sector" id="bqsaiaenlace_sector" value="y" />
		</div></div></div><div class="control-group"><b>Nombre Contacto 1<input type="hidden" name="bksaiacondicion_g@nombre_contacto1" id="bksaiacondicion_g@nombre_contacto1" value="like_total"></b><div class="controls"><input type="text" id="nombre_contacto1" name="bqsaia_g@nombre_contacto1"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_contacto1',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_contacto1',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_contacto1" id="bqsaiaenlace_g@nombre_contacto1" value="y" />
		</div></div></div><div class="control-group"><b>Telefono / Ext<input type="hidden" name="bksaiacondicion_g@telefono_contacto1" id="bksaiacondicion_g@telefono_contacto1" value="like_total"></b><div class="controls"><input type="text" id="telefono_contacto1" name="bqsaia_g@telefono_contacto1"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@telefono_contacto1',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@telefono_contacto1',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@telefono_contacto1" id="bqsaiaenlace_g@telefono_contacto1" value="y" />
		</div></div></div><div class="control-group"><b>Cargo<input type="hidden" name="bksaiacondicion_g@cargo_contacto1" id="bksaiacondicion_g@cargo_contacto1" value="like_total"></b><div class="controls"><input type="text" id="cargo_contacto1" name="bqsaia_g@cargo_contacto1"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cargo_contacto1',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cargo_contacto1',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cargo_contacto1" id="bqsaiaenlace_g@cargo_contacto1" value="y" />
		</div></div></div><div class="control-group"><b>Celular<input type="hidden" name="bksaiacondicion_g@celular_contacto1" id="bksaiacondicion_g@celular_contacto1" value="like_total"></b><div class="controls"><input type="text" id="celular_contacto1" name="bqsaia_g@celular_contacto1"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@celular_contacto1',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@celular_contacto1',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@celular_contacto1" id="bqsaiaenlace_g@celular_contacto1" value="y" />
		</div></div></div><div class="control-group"><b>Email<input type="hidden" name="bksaiacondicion_g@email_contacto1" id="bksaiacondicion_g@email_contacto1" value="like_total"></b><div class="controls"><input type="text" id="email_contacto1" name="bqsaia_g@email_contacto1"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@email_contacto1',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@email_contacto1',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@email_contacto1" id="bqsaiaenlace_g@email_contacto1" value="y" />
		</div></div></div><div class="control-group"><b>Nombre Contacto 2<input type="hidden" name="bksaiacondicion_g@nombre_contacto2" id="bksaiacondicion_g@nombre_contacto2" value="like_total"></b><div class="controls"><input type="text" id="nombre_contacto2" name="bqsaia_g@nombre_contacto2"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_contacto2',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_contacto2',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_contacto2" id="bqsaiaenlace_g@nombre_contacto2" value="y" />
		</div></div></div><div class="control-group"><b>Cargo<input type="hidden" name="bksaiacondicion_g@cargo_contacto2" id="bksaiacondicion_g@cargo_contacto2" value="like_total"></b><div class="controls"><input type="text" id="cargo_contacto2" name="bqsaia_g@cargo_contacto2"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cargo_contacto2',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cargo_contacto2',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cargo_contacto2" id="bqsaiaenlace_g@cargo_contacto2" value="y" />
		</div></div></div><div class="control-group"><b>Telefono / Ext<input type="hidden" name="bksaiacondicion_g@telefono_contacto2" id="bksaiacondicion_g@telefono_contacto2" value="like_total"></b><div class="controls"><input type="text" id="telefono_contacto2" name="bqsaia_g@telefono_contacto2"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@telefono_contacto2',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@telefono_contacto2',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@telefono_contacto2" id="bqsaiaenlace_g@telefono_contacto2" value="y" />
		</div></div></div><div class="control-group"><b>Celular<input type="hidden" name="bksaiacondicion_g@celular_contacto2" id="bksaiacondicion_g@celular_contacto2" value="like_total"></b><div class="controls"><input type="text" id="celular_contacto2" name="bqsaia_g@celular_contacto2"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@celular_contacto2',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@celular_contacto2',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@celular_contacto2" id="bqsaiaenlace_g@celular_contacto2" value="y" />
		</div></div></div><div class="control-group"><b>Email<input type="hidden" name="bksaiacondicion_g@email_contacto2" id="bksaiacondicion_g@email_contacto2" value="like_total"></b><div class="controls"><input type="text" id="email_contacto2" name="bqsaia_g@email_contacto2"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@email_contacto2',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@email_contacto2',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@email_contacto2" id="bqsaiaenlace_g@email_contacto2" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Responsable<input type="hidden" name="bksaiacondicion_responsable" id="bksaiacondicion_responsable" value="like_total"></b><div id="esperando_responsable"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_responsable" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_responsable" height=""></div><input type="hidden"  name="g@responsable" id="responsable"   value="" ><label style="display:none" class="error" for="responsable">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable=new dhtmlXTreeObject("treeboxbox_responsable","","",0);
                			tree_responsable.setImagePath("../../imgs/");
                			tree_responsable.enableIEImageFix(true);tree_responsable.enableCheckBoxes(1);
                    tree_responsable.enableRadioButtons(true);tree_responsable.setOnLoadingStart(cargando_responsable);
                      tree_responsable.setOnLoadingEnd(fin_cargando_responsable);tree_responsable.enableSmartXMLParsing(true);tree_responsable.loadXML("../../test_serie.php?sin_padre=1&id=932&tabla=serie");
                      tree_responsable.setOnCheckHandler(onNodeSelect_responsable);
                      function onNodeSelect_responsable(nodeId)
                      {valor_destino=document.getElementById("responsable");
                       destinos=tree_responsable.getAllChecked();
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
                      function fin_cargando_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="nombre_cliente@ejecutor,sector@arbol,responsable@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_registro_cliente g @ AND  g.documento_iddocumento=iddocumento "></body>