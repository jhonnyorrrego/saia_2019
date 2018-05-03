<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Radicaci&oacute;n de Facturas</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>FECHA DE RADICACI&Oacute;N<input type="hidden" name="bksaiacondicion_g@fecha_radicado" id="bksaiacondicion_g@fecha_radicado" value="like_total"></b><div class="controls"><input type="text" id="fecha_radicado" name="bqsaia_g@fecha_radicado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha_radicado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha_radicado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha_radicado" id="bqsaiaenlace_g@fecha_radicado" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>PROVEEDOR</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__1" id="bksaiacondicion_f@nombre__1" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="natural_juridica-nombre" name="g@natural_juridica-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="natural_juridica-identificacion" name="g@natural_juridica-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="natural_juridica-empresa" name="g@natural_juridica-empresa" ></div></div></fieldset><br><div class="control-group">
                  <label class="string control-label" for="fecha_emision"><b>FECHA DE EMISI&Oacute;N DE LA FACTURA</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_emision_x" id="bksaiacondicion_g@fecha_emision_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_emision_x" id="fecha_emision_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_emision_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_emision_y" id="bksaiacondicion_g@fecha_emision_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_emision_y" id="fecha_emision_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_emision_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_emision',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_emision',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_emision" id="bqsaiaenlace_fecha_emision" value="y" />
		</div></div></div><div class="control-group"><b>N&Uacute;MERO DE FACTURA<input type="hidden" name="bksaiacondicion_g@num_factura" id="bksaiacondicion_g@num_factura" value="like_total"></b><div class="controls"><input type="text" id="num_factura" name="bqsaia_g@num_factura"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@num_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@num_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@num_factura" id="bqsaiaenlace_g@num_factura" value="y" />
		</div></div></div><div class="control-group"><b>DESCRIPCI&Oacute;N SERVICIO O PRODUCTO<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea    id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion" id="bqsaiaenlace_g@descripcion" value="y" />
		</div></div></div><div class="control-group"><b>N&Uacute;MERO DE FOLIOS<input type="hidden" name="bksaiacondicion_g@num_folios" id="bksaiacondicion_g@num_folios" value="like_total"></b><div class="controls"><input type="text" id="num_folios" name="bqsaia_g@num_folios"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@num_folios',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@num_folios',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@num_folios" id="bqsaiaenlace_g@num_folios" value="y" />
		</div></div></div><div class="control-group"><b>ANEXOS F&Iacute;SICOS<input type="hidden" name="bksaiacondicion_g@anexos_fisicos" id="bksaiacondicion_g@anexos_fisicos" value="like_total"></b><div class="controls"><textarea    id="anexos_fisicos" name="bqsaia_g@anexos_fisicos"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@anexos_fisicos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@anexos_fisicos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@anexos_fisicos" id="bqsaiaenlace_g@anexos_fisicos" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>COPIA ELECTR&Oacute;NICA A<input type="hidden" name="bksaiacondicion_copia_electronica" id="bksaiacondicion_copia_electronica" value="like_total"></b><div id="esperando_copia_electronica"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_copia_electronica" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia_electronica.findItem((document.getElementById('stext_copia_electronica').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_electronica.findItem((document.getElementById('stext_copia_electronica').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia_electronica.findItem((document.getElementById('stext_copia_electronica').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_copia_electronica" height=""></div><input type="hidden" maxlength="255"  name="g@copia_electronica" id="copia_electronica"   value="" ><label style="display:none" class="error" for="copia_electronica">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_electronica=new dhtmlXTreeObject("treeboxbox_copia_electronica","","",0);
                			tree_copia_electronica.setImagePath("../../imgs/");
                			tree_copia_electronica.enableIEImageFix(true);tree_copia_electronica.enableCheckBoxes(1);
                			tree_copia_electronica.enableThreeStateCheckboxes(1);tree_copia_electronica.setOnLoadingStart(cargando_copia_electronica);
                      tree_copia_electronica.setOnLoadingEnd(fin_cargando_copia_electronica);tree_copia_electronica.enableSmartXMLParsing(true);tree_copia_electronica.loadXML("../../test.php?rol=1");
                      tree_copia_electronica.setOnCheckHandler(onNodeSelect_copia_electronica);
                      function onNodeSelect_copia_electronica(nodeId)
                      {valor_destino=document.getElementById("copia_electronica");
                       destinos=tree_copia_electronica.getAllChecked();
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
                      function fin_cargando_copia_electronica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_electronica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_electronica")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_electronica"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia_electronica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_electronica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_electronica")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_electronica"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="natural_juridica@ejecutor,copia_electronica@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_radicacion_facturas g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_emision_x,g@fecha_emision_y">