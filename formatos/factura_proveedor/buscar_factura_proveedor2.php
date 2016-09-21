<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Radicacion Facturas</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>C&oacute;digo de la compa&ntilde;ia<input type="hidden" name="bksaiacondicion_g@cia" id="bksaiacondicion_g@cia" value="like_total"></b><div class="controls"><input type="text" id="cia" name="bqsaia_g@cia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cia" id="bqsaiaenlace_g@cia" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_doc"><b>Tipo documento<input type="hidden" name="bksaiacondicion_g@tipo_doc" id="bksaiacondicion_g@tipo_doc" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(236,2631,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_doc',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_doc',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_doc" id="bqsaiaenlace_g@tipo_doc" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_exp"><b>Fecha de expedicion</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_exp_x" id="bksaiacondicion_g@fecha_exp_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_exp_x" id="fecha_exp_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_exp_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_exp_y" id="bksaiacondicion_g@fecha_exp_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_exp_y" id="fecha_exp_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_exp_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_exp',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_exp',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_exp" id="bqsaiaenlace_fecha_exp" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_venc"><b>Fecha de vencimiento</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_venc_x" id="bksaiacondicion_g@fecha_venc_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_venc_x" id="fecha_venc_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_venc_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_venc_y" id="bksaiacondicion_g@fecha_venc_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_venc_y" id="fecha_venc_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_venc_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_venc',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_venc',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_venc" id="bqsaiaenlace_fecha_venc" value="y" />
		</div></div></div><div class="control-group"><b>N&uacute;mero de factura<input type="hidden" name="bksaiacondicion_g@num_factura" id="bksaiacondicion_g@num_factura" value="like_total"></b><div class="controls"><input type="text" id="num_factura" name="bqsaia_g@num_factura"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@num_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@num_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@num_factura" id="bqsaiaenlace_g@num_factura" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Proveedor</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__5" id="bksaiacondicion_f@nombre__5" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="prooveedor-nombre" name="g@prooveedor-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="prooveedor-identificacion" name="g@prooveedor-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="prooveedor-empresa" name="g@prooveedor-empresa" ></div></div></fieldset><br><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_moneda"><b>Tipo moneda<input type="hidden" name="bksaiacondicion_g@tipo_moneda" id="bksaiacondicion_g@tipo_moneda" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(236,2636,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_moneda',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_moneda',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_moneda" id="bqsaiaenlace_tipo_moneda" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Enviar a<input type="hidden" name="bksaiacondicion_enviar" id="bksaiacondicion_enviar" value="like_total"></b><div id="esperando_enviar"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_enviar" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_enviar.findItem(htmlentities(document.getElementById('stext_enviar').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_enviar.findItem(htmlentities(document.getElementById('stext_enviar').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_enviar.findItem(htmlentities(document.getElementById('stext_enviar').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_enviar" height=""></div><input type="hidden" maxlength="255"  name="g@enviar" id="enviar"   value="" ><label style="display:none" class="error" for="enviar">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_enviar=new dhtmlXTreeObject("treeboxbox_enviar","","",0);
                			tree_enviar.setImagePath("../../imgs/");
                			tree_enviar.enableIEImageFix(true);tree_enviar.enableCheckBoxes(1);
                    tree_enviar.enableRadioButtons(true);tree_enviar.setOnLoadingStart(cargando_enviar);
                      tree_enviar.setOnLoadingEnd(fin_cargando_enviar);tree_enviar.enableSmartXMLParsing(true);tree_enviar.loadXML("../../test.php?rol=1&iddependencia=51");
                      tree_enviar.setOnCheckHandler(onNodeSelect_enviar);
                      function onNodeSelect_enviar(nodeId)
                      {valor_destino=document.getElementById("enviar");
                       destinos=tree_enviar.getAllChecked();
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
                      function fin_cargando_enviar() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_enviar")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_enviar")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_enviar"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_enviar() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_enviar")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_enviar")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_enviar"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_enviar',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_enviar',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_enviar" id="bqsaiaenlace_enviar" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_factura"><b>Fecha de la guia</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_factura_x" id="bksaiacondicion_g@fecha_factura_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_factura_x" id="fecha_factura_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_factura_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_factura_y" id="bksaiacondicion_g@fecha_factura_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_factura_y" id="fecha_factura_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_factura_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_factura" id="bqsaiaenlace_fecha_factura" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@observaciones" id="bqsaiaenlace_g@observaciones" value="y" />
		</div></div></div><div class="control-group"><b>Caja<input type="hidden" name="bksaiacondicion_g@caja" id="bksaiacondicion_g@caja" value="="></b><div class="controls"><input type="text" id="caja" name="bqsaia_g@caja"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@caja',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@caja',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@caja" id="bqsaiaenlace_g@caja" value="y" />
		</div></div></div><div class="control-group"><b>Unidad documental<input type="hidden" name="bksaiacondicion_g@unidad_documenta" id="bksaiacondicion_g@unidad_documenta" value="like_total"></b><div class="controls"><input type="text" id="unidad_documenta" name="bqsaia_g@unidad_documenta"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@unidad_documenta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@unidad_documenta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@unidad_documenta" id="bqsaiaenlace_g@unidad_documenta" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="requiere_irecibo"><b>Requiere ir?<input type="hidden" name="bksaiacondicion_g@requiere_irecibo" id="bksaiacondicion_g@requiere_irecibo" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(236,2642,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@requiere_irecibo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@requiere_irecibo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@requiere_irecibo" id="bqsaiaenlace_g@requiere_irecibo" value="y" />
		</div></div></div><div class="control-group"><b>Guia<input type="hidden" name="bksaiacondicion_g@numero_guia" id="bksaiacondicion_g@numero_guia" value="like_total"></b><div class="controls"><input type="text" id="numero_guia" name="bqsaia_g@numero_guia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@numero_guia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@numero_guia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@numero_guia" id="bqsaiaenlace_g@numero_guia" value="y" />
		</div></div></div><div class="control-group"><b>Empresa guia<input type="hidden" name="bksaiacondicion_g@empresa_guia" id="bksaiacondicion_g@empresa_guia" value="like_total"></b><div class="controls"><input type="text" id="empresa_guia" name="bqsaia_g@empresa_guia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@empresa_guia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@empresa_guia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@empresa_guia" id="bqsaiaenlace_g@empresa_guia" value="y" />
		</div></div></div><div class="control-group"><b>Orden compra<input type="hidden" name="bksaiacondicion_g@orden_compra" id="bksaiacondicion_g@orden_compra" value="like_total"></b><div class="controls"><input type="text" id="orden_compra" name="bqsaia_g@orden_compra"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@orden_compra',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@orden_compra',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@orden_compra" id="bqsaiaenlace_g@orden_compra" value="y" />
		</div></div></div><div class="control-group"><b>Archivo ubicaci&oacute;n caja<input type="hidden" name="bksaiacondicion_g@archivo_ubicacion" id="bksaiacondicion_g@archivo_ubicacion" value="like_total"></b><div class="controls"><input type="text" id="archivo_ubicacion" name="bqsaia_g@archivo_ubicacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@archivo_ubicacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@archivo_ubicacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@archivo_ubicacion" id="bqsaiaenlace_g@archivo_ubicacion" value="y" />
		</div></div></div><div class="control-group"><b>Valor de la factura<input type="hidden" name="bksaiacondicion_g@valor_factura" id="bksaiacondicion_g@valor_factura" value="like_total"></b><div class="controls"><input type="text" id="valor_factura" name="bqsaia_g@valor_factura"></div></div><input type="hidden" name="campos_especiales" value="prooveedor@ejecutor,enviar@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_factura_proveedor g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_exp_x,g@fecha_exp_y,g@fecha_venc_x,g@fecha_venc_y,g@fecha_factura_x,g@fecha_factura_y">