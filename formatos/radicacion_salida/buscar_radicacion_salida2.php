<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Salida</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_radicacion_entrada"><b>FECHA DE RADICACION<input type="hidden" name="bksaiacondicion_fecha_radicacion_entrada" id="bksaiacondicion_fecha_radicacion_entrada" value="like_total"></b></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="fecha_radicacion_entrada_1"  id="fecha_radicacion_entrada_1" value=""><?php selector_fecha("fecha_radicacion_entrada_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_radicacion_entrada_2"  id="fecha_radicacion_entrada_2" value=""><?php selector_fecha("fecha_radicacion_entrada_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_radicacion_entrada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_radicacion_entrada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_radicacion_entrada" id="bqsaiaenlace_fecha_radicacion_entrada" value="y" />
		</div></div></div><div class="control-group"><b>NUMERO DE RADICADO<input type="hidden" name="bksaiacondicion_g@numero_radicado" id="bksaiacondicion_g@numero_radicado" value="="></b><div class="controls"><input type="text" id="numero_radicado" name="bqsaia_g@numero_radicado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@numero_radicado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@numero_radicado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@numero_radicado" id="bqsaiaenlace_g@numero_radicado" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Funcionario responsable<input type="hidden" name="bksaiacondicion_area_responsable" id="bksaiacondicion_area_responsable" value="like_total"></b><div id="esperando_area_responsable"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_area_responsable" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_area_responsable" height=""></div><input type="hidden" maxlength="255"  name="g@area_responsable" id="area_responsable"   value="" ><label style="display:none" class="error" for="area_responsable">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_area_responsable=new dhtmlXTreeObject("treeboxbox_area_responsable","","",0);
                			tree_area_responsable.setImagePath("../../imgs/");
                			tree_area_responsable.enableIEImageFix(true);tree_area_responsable.enableCheckBoxes(1);
                			tree_area_responsable.enableThreeStateCheckboxes(1);tree_area_responsable.setOnLoadingStart(cargando_area_responsable);
                      tree_area_responsable.setOnLoadingEnd(fin_cargando_area_responsable);tree_area_responsable.enableSmartXMLParsing(true);tree_area_responsable.loadXML("../../test.php?rol=1");
                      tree_area_responsable.setOnCheckHandler(onNodeSelect_area_responsable);
                      function onNodeSelect_area_responsable(nodeId)
                      {valor_destino=document.getElementById("area_responsable");
                       destinos=tree_area_responsable.getAllChecked();
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
                      function fin_cargando_area_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsable")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_area_responsable"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_area_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsable")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_area_responsable"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_area_responsable',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_area_responsable',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_area_responsable" id="bqsaiaenlace_area_responsable" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Persona natural o jur&iacute;dica</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__3" id="bksaiacondicion_f@nombre__3" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="persona_natural-nombre" name="g@persona_natural-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="persona_natural-identificacion" name="g@persona_natural-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="persona_natural-empresa" name="g@persona_natural-empresa" ></div></div></fieldset><br><div class="control-group"><b>DESCRIPCION O ASUNTO<input type="hidden" name="bksaiacondicion_g@descripcion_salida" id="bksaiacondicion_g@descripcion_salida" value="like_total"></b><div class="controls"><textarea  maxlength="1000"   id="descripcion_salida" name="bqsaia_g@descripcion_salida"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_salida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_salida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_salida" id="bqsaiaenlace_g@descripcion_salida" value="y" />
		</div></div></div><div class="control-group"><b>Numero de folios<input type="hidden" name="bksaiacondicion_g@num_folios" id="bksaiacondicion_g@num_folios" value="="></b><div class="controls"><input type="text" id="num_folios" name="bqsaia_g@num_folios"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@num_folios',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@num_folios',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@num_folios" id="bqsaiaenlace_g@num_folios" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="anexos_fisicos"><b>ANEXOS FISICOS<input type="hidden" name="bksaiacondicion_g@anexos_fisicos" id="bksaiacondicion_g@anexos_fisicos" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(207,2189,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_anexos_fisicos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_anexos_fisicos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_anexos_fisicos" id="bqsaiaenlace_anexos_fisicos" value="y" />
		</div></div></div><div class="control-group"><b>DESCRIPCION ANEXOS FISICOS<input type="hidden" name="bksaiacondicion_g@descripcion_anexos" id="bksaiacondicion_g@descripcion_anexos" value="like_total"></b><div class="controls"><textarea  maxlength="1000"   id="descripcion_anexos" name="bqsaia_g@descripcion_anexos"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_anexos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_anexos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_anexos" id="bqsaiaenlace_g@descripcion_anexos" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_mensajeria"><b>TIPO DE MENSAJERIA<input type="hidden" name="bksaiacondicion_g@tipo_mensajeria" id="bksaiacondicion_g@tipo_mensajeria" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(207,2202,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_mensajeria',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_mensajeria',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_mensajeria" id="bqsaiaenlace_g@tipo_mensajeria" value="y" />
		</div></div></div><div class="control-group"><b>Mensajeros<input type="hidden" name="bksaiacondicion_g@mensajeros" id="bksaiacondicion_g@mensajeros" value="="></b><div class="controls"><input type="text" id="mensajeros" name="bqsaia_g@mensajeros"></div></div><input type="hidden" name="campos_especiales" value="area_responsable@arbol,persona_natural@ejecutor"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_radicacion_salida g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|">