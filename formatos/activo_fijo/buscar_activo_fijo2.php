<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Nombre activo<input type="hidden" name="bksaiacondicion_g@nombre_activo" id="bksaiacondicion_g@nombre_activo" value="like_total"></b><div class="controls"><input type="text" id="nombre_activo" name="bqsaia_g@nombre_activo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_activo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_activo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_activo" id="bqsaiaenlace_g@nombre_activo" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Responsable<input type="hidden" name="bksaiacondicion_nombre" id="bksaiacondicion_nombre" value="like_total"></b><div id="esperando_nombre"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_nombre" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_nombre.findItem(htmlentities(document.getElementById('stext_nombre').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre.findItem(htmlentities(document.getElementById('stext_nombre').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_nombre.findItem(htmlentities(document.getElementById('stext_nombre').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_nombre" height=""></div><input type="hidden" maxlength="255"  name="g@nombre" id="nombre"   value="" ><label style="display:none" class="error" for="nombre">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre=new dhtmlXTreeObject("treeboxbox_nombre","","",0);
                			tree_nombre.setImagePath("../../imgs/");
                			tree_nombre.enableIEImageFix(true);tree_nombre.enableCheckBoxes(1);
                    tree_nombre.enableRadioButtons(true);tree_nombre.setOnLoadingStart(cargando_nombre);
                      tree_nombre.setOnLoadingEnd(fin_cargando_nombre);tree_nombre.enableSmartXMLParsing(true);tree_nombre.loadXML("../../test.php?rol=1&iddependencia=51");
                      tree_nombre.setOnCheckHandler(onNodeSelect_nombre);
                      function onNodeSelect_nombre(nodeId)
                      {valor_destino=document.getElementById("nombre");
                       destinos=tree_nombre.getAllChecked();
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
                      function fin_cargando_nombre() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_nombre() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre" id="bqsaiaenlace_nombre" value="y" />
		</div></div></div><div class="control-group"><b>C&oacute;digo<input type="hidden" name="bksaiacondicion_g@codigo" id="bksaiacondicion_g@codigo" value="like_total"></b><div class="controls"><input type="text" id="codigo" name="bqsaia_g@codigo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@codigo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@codigo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@codigo" id="bqsaiaenlace_g@codigo" value="y" />
		</div></div></div><div class="control-group"><b>Consideraciones<input type="hidden" name="bksaiacondicion_g@consideraciones" id="bksaiacondicion_g@consideraciones" value="like_total"></b><div class="controls"><textarea    id="consideraciones" name="bqsaia_g@consideraciones"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@consideraciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@consideraciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@consideraciones" id="bqsaiaenlace_g@consideraciones" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ubicacion"><b>Ubicaci&oacute;n<input type="hidden" name="bksaiacondicion_g@ubicacion" id="bksaiacondicion_g@ubicacion" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(231,2573,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ubicacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ubicacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ubicacion" id="bqsaiaenlace_ubicacion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado"><b>Estado<input type="hidden" name="bksaiacondicion_g@estado" id="bksaiacondicion_g@estado" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(231,2560,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado" id="bqsaiaenlace_estado" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Proveedor</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__6" id="bksaiacondicion_f@nombre__6" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="proveedor-nombre" name="g@proveedor-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="proveedor-identificacion" name="g@proveedor-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="proveedor-empresa" name="g@proveedor-empresa" ></div></div></fieldset><br><div class="control-group"><b>Valor de la compra<input type="hidden" name="bksaiacondicion_g@valor_compra" id="bksaiacondicion_g@valor_compra" value="like_total"></b><div class="controls"><input type="text" id="valor_compra" name="bqsaia_g@valor_compra"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@valor_compra',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@valor_compra',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@valor_compra" id="bqsaiaenlace_g@valor_compra" value="y" />
		</div></div></div><div class="control-group"><b>Propietario<input type="hidden" name="bksaiacondicion_g@propietario" id="bksaiacondicion_g@propietario" value="like_total"></b><div class="controls"><input type="text" id="propietario" name="bqsaia_g@propietario"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@propietario',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@propietario',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@propietario" id="bqsaiaenlace_g@propietario" value="y" />
		</div></div></div><div class="control-group"><b>Valor del seguro<input type="hidden" name="bksaiacondicion_g@valor_seguro" id="bksaiacondicion_g@valor_seguro" value="like_total"></b><div class="controls"><input type="text" id="valor_seguro" name="bqsaia_g@valor_seguro"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@valor_seguro',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@valor_seguro',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@valor_seguro" id="bqsaiaenlace_g@valor_seguro" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="Seguro1"><b>Seguro 1<input type="hidden" name="bksaiacondicion_g@Seguro1" id="bksaiacondicion_g@Seguro1" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(231,2566,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_Seguro1',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_Seguro1',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_Seguro1" id="bqsaiaenlace_Seguro1" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="seguro2"><b>Seguro 2<input type="hidden" name="bksaiacondicion_g@seguro2" id="bksaiacondicion_g@seguro2" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(231,2567,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_seguro2',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_seguro2',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_seguro2" id="bqsaiaenlace_seguro2" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="seguro3"><b>Seguro 3<input type="hidden" name="bksaiacondicion_g@seguro3" id="bksaiacondicion_g@seguro3" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(231,2568,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_seguro3',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_seguro3',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_seguro3" id="bqsaiaenlace_seguro3" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="informacion_venta"><b>INFORMACION DE VANTA<input type="hidden" name="bksaiacondicion_informacion_venta" id="bksaiacondicion_informacion_venta" value="like_total"></b></label></div><div class="control-group"><b>comprador<input type="hidden" name="bksaiacondicion_g@comprador" id="bksaiacondicion_g@comprador" value="like_total"></b><div class="controls"><input type="text" id="comprador" name="bqsaia_g@comprador"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@comprador',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@comprador',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@comprador" id="bqsaiaenlace_g@comprador" value="y" />
		</div></div></div><div class="control-group"><b>Valor de la venta<input type="hidden" name="bksaiacondicion_g@valor_venta" id="bksaiacondicion_g@valor_venta" value="like_total"></b><div class="controls"><input type="text" id="valor_venta" name="bqsaia_g@valor_venta"></div></div><input type="hidden" name="campos_especiales" value="nombre@arbol,proveedor@ejecutor"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_activo_fijo g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="idbusqueda_componente" value="0">