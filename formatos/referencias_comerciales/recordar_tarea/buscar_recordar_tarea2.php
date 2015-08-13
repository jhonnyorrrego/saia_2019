<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_formato"><b>Fecha Tarea</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_formato_x" id="bksaiacondicion_g@fecha_formato_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_formato_x" id="fecha_formato_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_formato_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_formato_y" id="bksaiacondicion_g@fecha_formato_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_formato_y" id="fecha_formato_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_formato_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_formato',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_formato',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_formato" id="bqsaiaenlace_fecha_formato" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Responsable<input type="hidden" name="bksaiacondicion_responsable" id="bksaiacondicion_responsable" value="like_total"></b><div id="esperando_responsable"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_responsable" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_responsable" height=""></div><input type="hidden" maxlength="255"  name="g@responsable" id="responsable"   value="" ><label style="display:none" class="error" for="responsable">Campo obligatorio.</b></label><script type="text/javascript">
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
                			tree_responsable.enableThreeStateCheckboxes(1);tree_responsable.setOnLoadingStart(cargando_responsable);
                      tree_responsable.setOnLoadingEnd(fin_cargando_responsable);tree_responsable.enableSmartXMLParsing(true);tree_responsable.loadXML("../../test.php?rol=1");
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
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_responsable',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_responsable',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_responsable" id="bqsaiaenlace_responsable" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>Vinculados<input type="hidden" name="bksaiacondicion_vinculados" id="bksaiacondicion_vinculados" value="like_total"></b><div id="esperando_vinculados"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_vinculados" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_vinculados.findItem(htmlentities(document.getElementById('stext_vinculados').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_vinculados.findItem(htmlentities(document.getElementById('stext_vinculados').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_vinculados.findItem(htmlentities(document.getElementById('stext_vinculados').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_vinculados" height=""></div><input type="hidden" maxlength="255"  name="g@vinculados" id="vinculados"   value="" ><label style="display:none" class="error" for="vinculados">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_vinculados=new dhtmlXTreeObject("treeboxbox_vinculados","","",0);
                			tree_vinculados.setImagePath("../../imgs/");
                			tree_vinculados.enableIEImageFix(true);tree_vinculados.enableCheckBoxes(1);
                			tree_vinculados.enableThreeStateCheckboxes(1);tree_vinculados.setOnLoadingStart(cargando_vinculados);
                      tree_vinculados.setOnLoadingEnd(fin_cargando_vinculados);tree_vinculados.enableSmartXMLParsing(true);tree_vinculados.loadXML("../../test.php?rol=1");
                      tree_vinculados.setOnCheckHandler(onNodeSelect_vinculados);
                      function onNodeSelect_vinculados(nodeId)
                      {valor_destino=document.getElementById("vinculados");
                       destinos=tree_vinculados.getAllChecked();
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
                      function fin_cargando_vinculados() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_vinculados")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_vinculados")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_vinculados"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_vinculados() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_vinculados")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_vinculados")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_vinculados"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_vinculados',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_vinculados',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_vinculados" id="bqsaiaenlace_vinculados" value="y" />
		</div></div></div><div class="control-group"><b>Tarea asignada<input type="hidden" name="bksaiacondicion_g@tarea_asiganda" id="bksaiacondicion_g@tarea_asiganda" value="like_total"></b><div class="controls"><input type="text" id="tarea_asiganda" name="bqsaia_g@tarea_asiganda"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tarea_asiganda',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tarea_asiganda',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tarea_asiganda" id="bqsaiaenlace_g@tarea_asiganda" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="prioridad"><b>Prioridad<input type="hidden" name="bksaiacondicion_g@prioridad" id="bksaiacondicion_g@prioridad" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(239,2693,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@prioridad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@prioridad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@prioridad" id="bqsaiaenlace_g@prioridad" value="y" />
		</div></div></div><div class="control-group"><b>Descrpci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion" id="bqsaiaenlace_g@descripcion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo"><b>Tipo<input type="hidden" name="bksaiacondicion_g@tipo" id="bksaiacondicion_g@tipo" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(239,2695,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo" id="bqsaiaenlace_g@tipo" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="periodicidad"><b>Periodicidad<input type="hidden" name="bksaiacondicion_g@periodicidad" id="bksaiacondicion_g@periodicidad" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(239,2696,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@periodicidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@periodicidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@periodicidad" id="bqsaiaenlace_g@periodicidad" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_entraga"><b>Fecha de entrega</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_entraga_x" id="bksaiacondicion_g@fecha_entraga_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_entraga_x" id="fecha_entraga_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_entraga_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_entraga_y" id="bksaiacondicion_g@fecha_entraga_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_entraga_y" id="fecha_entraga_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_entraga_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_entraga',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_entraga',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_entraga" id="bqsaiaenlace_fecha_entraga" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_periodo"><b>Tipo periodo a recordar<input type="hidden" name="bksaiacondicion_g@tipo_periodo" id="bksaiacondicion_g@tipo_periodo" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(239,2728,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_periodo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_periodo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_periodo" id="bqsaiaenlace_g@tipo_periodo" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="dias_recordar"><b>Dias<input type="hidden" name="bksaiacondicion_g@dias_recordar" id="bksaiacondicion_g@dias_recordar" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(239,2699,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_dias_recordar',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_dias_recordar',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_dias_recordar" id="bqsaiaenlace_dias_recordar" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="horas_recordar"><b>Horas <input type="hidden" name="bksaiacondicion_g@horas_recordar" id="bksaiacondicion_g@horas_recordar" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(239,2700,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_horas_recordar',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_horas_recordar',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_horas_recordar" id="bqsaiaenlace_horas_recordar" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="mes_recordar"><b>Mes<input type="hidden" name="bksaiacondicion_g@mes_recordar" id="bksaiacondicion_g@mes_recordar" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(239,2701,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_mes_recordar',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_mes_recordar',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_mes_recordar" id="bqsaiaenlace_mes_recordar" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="semanas_recordar"><b>Semanas<input type="hidden" name="bksaiacondicion_g@semanas_recordar" id="bksaiacondicion_g@semanas_recordar" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(239,2702,'',1,'buscar');?></div></div><input type="hidden" name="campos_especiales" value="responsable@arbol,vinculados@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_recordar_tarea g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_formato_x,g@fecha_formato_y,g@fecha_entraga_x,g@fecha_entraga_y"><input type="hidden" name="idbusqueda_componente" value="156">