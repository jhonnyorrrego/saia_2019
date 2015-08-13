<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Radicaci&oacute;n de Facturas</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_documento"><b>Tipo Documento<input type="hidden" name="bksaiacondicion_g@tipo_documento" id="bksaiacondicion_g@tipo_documento" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(302,3530,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_documento" id="bqsaiaenlace_g@tipo_documento" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ft_orden_compra"><b>Orden de compra<input type="hidden" name="bksaiacondicion_g@ft_orden_compra" id="bksaiacondicion_g@ft_orden_compra" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(302,3524,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ft_orden_compra',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ft_orden_compra',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ft_orden_compra" id="bqsaiaenlace_ft_orden_compra" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_expedicion"><b>Fecha Expedici&oacute;n</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_expedicion_x" id="bksaiacondicion_g@fecha_expedicion_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_expedicion_x" id="fecha_expedicion_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_expedicion_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_expedicion_y" id="bksaiacondicion_g@fecha_expedicion_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_expedicion_y" id="fecha_expedicion_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_expedicion_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_expedicion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_expedicion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_expedicion" id="bqsaiaenlace_fecha_expedicion" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_vencimiento"><b>Fecha Vencimiento</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_vencimiento_x" id="bksaiacondicion_g@fecha_vencimiento_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_vencimiento_x" id="fecha_vencimiento_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_vencimiento_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_vencimiento_y" id="bksaiacondicion_g@fecha_vencimiento_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_vencimiento_y" id="fecha_vencimiento_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_vencimiento_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_vencimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_vencimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_vencimiento" id="bqsaiaenlace_fecha_vencimiento" value="y" />
		</div></div></div><div class="control-group"><b>N&uacute;mero Factura<input type="hidden" name="bksaiacondicion_g@numero_factura" id="bksaiacondicion_g@numero_factura" value="like_total"></b><div class="controls"><input type="text" id="numero_factura" name="bqsaia_g@numero_factura"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@numero_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@numero_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@numero_factura" id="bqsaiaenlace_g@numero_factura" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Proveedor</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__5" id="bksaiacondicion_f@nombre__5" value="like_total"></b><div class="controls"><input type="text"    id="proveedor-nombre" name="g@proveedor-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"    id="proveedor-identificacion" name="g@proveedor-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"    id="proveedor-empresa" name="g@proveedor-empresa" ></div></div></fieldset><br><div class="control-group"><b>Detalle de Factura<input type="hidden" name="bksaiacondicion_g@detalle_factura" id="bksaiacondicion_g@detalle_factura" value="like_total"></b><div class="controls"><input type="text" id="detalle_factura" name="bqsaia_g@detalle_factura"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@detalle_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@detalle_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@detalle_factura" id="bqsaiaenlace_g@detalle_factura" value="y" />
		</div></div></div><div class="control-group"><b>Valor Factura<input type="hidden" name="bksaiacondicion_g@valor_factura" id="bksaiacondicion_g@valor_factura" value="like_total"></b><div class="controls"><input type="text" id="valor_factura" name="bqsaia_g@valor_factura"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@valor_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@valor_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@valor_factura" id="bqsaiaenlace_g@valor_factura" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Responsable Orden de Pago<input type="hidden" name="bksaiacondicion_responsable_op" id="bksaiacondicion_responsable_op" value="like_total"></b><div id="esperando_responsable_op"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_responsable_op" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_responsable_op" height=""></div><input type="hidden"  name="g@responsable_op" id="responsable_op"   value="" ><label style="display:none" class="error" for="responsable_op">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable_op=new dhtmlXTreeObject("treeboxbox_responsable_op","","",0);
                			tree_responsable_op.setImagePath("../../imgs/");
                			tree_responsable_op.enableIEImageFix(true);tree_responsable_op.enableCheckBoxes(1);
                    tree_responsable_op.enableRadioButtons(true);tree_responsable_op.setOnLoadingStart(cargando_responsable_op);
                      tree_responsable_op.setOnLoadingEnd(fin_cargando_responsable_op);tree_responsable_op.enableSmartXMLParsing(true);tree_responsable_op.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_responsable_op.setOnCheckHandler(onNodeSelect_responsable_op);
                      function onNodeSelect_responsable_op(nodeId)
                      {valor_destino=document.getElementById("responsable_op");
                       destinos=tree_responsable_op.getAllChecked();
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
                      function fin_cargando_responsable_op() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_op")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_op")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable_op"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_responsable_op() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_op")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_op")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable_op"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_responsable_op',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_responsable_op',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_responsable_op" id="bqsaiaenlace_responsable_op" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@observaciones" id="bqsaiaenlace_g@observaciones" value="y" />
		</div></div></div><div class="control-group"><b>Gu&iacute;a<input type="hidden" name="bksaiacondicion_g@guia" id="bksaiacondicion_g@guia" value="like_total"></b><div class="controls"><input type="text" id="guia" name="bqsaia_g@guia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@guia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@guia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@guia" id="bqsaiaenlace_g@guia" value="y" />
		</div></div></div><div class="control-group"><b>Empresa Guia<input type="hidden" name="bksaiacondicion_g@empresa_guia" id="bksaiacondicion_g@empresa_guia" value="like_total"></b><div class="controls"><input type="text" id="empresa_guia" name="bqsaia_g@empresa_guia"></div></div><input type="hidden" name="campos_especiales" value="proveedor@ejecutor,responsable_op@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_radicacion_facturas g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_expedicion_x,g@fecha_expedicion_y,g@fecha_vencimiento_x,g@fecha_vencimiento_y"><input type="hidden" name="idbusqueda_componente" value="193">