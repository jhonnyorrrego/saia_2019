<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Correspondencia de Entrada</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_radicacion_entrada"><b>FECHA DE RADICACION<input type="hidden" name="bksaiacondicion_fecha_radicacion_entrada" id="bksaiacondicion_fecha_radicacion_entrada" value="like_total"></b></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="fecha_radicacion_entrada_1"  id="fecha_radicacion_entrada_1" value=""><?php selector_fecha("fecha_radicacion_entrada_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_radicacion_entrada_2"  id="fecha_radicacion_entrada_2" value=""><?php selector_fecha("fecha_radicacion_entrada_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_radicacion_entrada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_radicacion_entrada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_radicacion_entrada" id="bqsaiaenlace_fecha_radicacion_entrada" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_oficio_entrada"><b>FECHA OFICIO ENTRADA</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_oficio_entrada_x" id="bksaiacondicion_g@fecha_oficio_entrada_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_oficio_entrada_x" id="fecha_oficio_entrada_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_oficio_entrada_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_oficio_entrada_y" id="bksaiacondicion_g@fecha_oficio_entrada_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_oficio_entrada_y" id="fecha_oficio_entrada_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_oficio_entrada_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_oficio_entrada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_oficio_entrada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_oficio_entrada" id="bqsaiaenlace_fecha_oficio_entrada" value="y" />
		</div></div></div><div class="control-group"><b>NUMERO DE DOCUMENTO<input type="hidden" name="bksaiacondicion_g@numero_oficio" id="bksaiacondicion_g@numero_oficio" value="like_total"></b><div class="controls"><input type="text" id="numero_oficio" name="bqsaia_g@numero_oficio"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@numero_oficio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@numero_oficio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@numero_oficio" id="bqsaiaenlace_g@numero_oficio" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>PERSONA NATURAL/JURIDICA</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__3" id="bksaiacondicion_f@nombre__3" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="persona_natural-nombre" name="g@persona_natural-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="persona_natural-identificacion" name="g@persona_natural-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="persona_natural-empresa" name="g@persona_natural-empresa" ></div></div></fieldset><br><div class="control-group"><b>DESCRIPCION O ASUNTO<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea  maxlength="1000"   id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion" id="bqsaiaenlace_g@descripcion" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="tiempo_respuesta"><b>FECHA L&Iacute;MITE DE RESPUESTA</b></label>
                  <input type="hidden" name="bksaiacondicion_g@tiempo_respuesta_x" id="bksaiacondicion_g@tiempo_respuesta_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@tiempo_respuesta_x" id="tiempo_respuesta_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("tiempo_respuesta_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@tiempo_respuesta_y" id="bksaiacondicion_g@tiempo_respuesta_y" value="<=">
                  <input type="text"  name="bqsaia_g@tiempo_respuesta_y" id="tiempo_respuesta_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("tiempo_respuesta_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tiempo_respuesta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tiempo_respuesta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tiempo_respuesta" id="bqsaiaenlace_tiempo_respuesta" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="anexos_fisicos"><b>ANEXOS FISICOS<input type="hidden" name="bksaiacondicion_g@anexos_fisicos" id="bksaiacondicion_g@anexos_fisicos" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(3,40,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
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
		</div></div></div><div class="control-group"><div class="controls"><b>DESTINO<input type="hidden" name="bksaiacondicion_destino" id="bksaiacondicion_destino" value="like_total"></b><div id="esperando_destino"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_destino" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_destino.findItem(htmlentities(document.getElementById('stext_destino').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_destino.findItem(htmlentities(document.getElementById('stext_destino').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_destino.findItem(htmlentities(document.getElementById('stext_destino').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_destino" height=""></div><input type="hidden" maxlength="255"  name="g@destino" id="destino"   value="" ><label style="display:none" class="error" for="destino">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_destino=new dhtmlXTreeObject("treeboxbox_destino","","",0);
                			tree_destino.setImagePath("../../imgs/");
                			tree_destino.enableIEImageFix(true);tree_destino.enableCheckBoxes(1);
                    tree_destino.enableRadioButtons(true);tree_destino.setOnLoadingStart(cargando_destino);
                      tree_destino.setOnLoadingEnd(fin_cargando_destino);tree_destino.enableSmartXMLParsing(true);tree_destino.loadXML("../../test.php?rol=1");
                      tree_destino.setOnCheckHandler(onNodeSelect_destino);
                      function onNodeSelect_destino(nodeId)
                      {valor_destino=document.getElementById("destino");
                       destinos=tree_destino.getAllChecked();
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
                      function fin_cargando_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_destino"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_destino"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_destino" id="bqsaiaenlace_destino" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>COPIA A<input type="hidden" name="bksaiacondicion_copia_a" id="bksaiacondicion_copia_a" value="like_total"></b><div id="esperando_copia_a"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_copia_a" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia_a.findItem(htmlentities(document.getElementById('stext_copia_a').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_a.findItem(htmlentities(document.getElementById('stext_copia_a').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia_a.findItem(htmlentities(document.getElementById('stext_copia_a').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_copia_a" height=""></div><input type="hidden" maxlength="255"  name="g@copia_a" id="copia_a"   value="" ><label style="display:none" class="error" for="copia_a">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_a=new dhtmlXTreeObject("treeboxbox_copia_a","","",0);
                			tree_copia_a.setImagePath("../../imgs/");
                			tree_copia_a.enableIEImageFix(true);tree_copia_a.enableCheckBoxes(1);
                			tree_copia_a.enableThreeStateCheckboxes(1);tree_copia_a.setOnLoadingStart(cargando_copia_a);
                      tree_copia_a.setOnLoadingEnd(fin_cargando_copia_a);tree_copia_a.enableSmartXMLParsing(true);tree_copia_a.loadXML("../../test.php?rol=1");
                      tree_copia_a.setOnCheckHandler(onNodeSelect_copia_a);
                      function onNodeSelect_copia_a(nodeId)
                      {valor_destino=document.getElementById("copia_a");
                       destinos=tree_copia_a.getAllChecked();
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
                      function fin_cargando_copia_a() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_a")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_a")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_a"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia_a() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_a")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_a")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_a"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="persona_natural@ejecutor,destino@arbol,copia_a@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_radicacion_entrada g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_oficio_entrada_x,g@fecha_oficio_entrada_y,g@tiempo_respuesta_x,g@tiempo_respuesta_y"><input type="hidden" name="idbusqueda_componente" value="83">