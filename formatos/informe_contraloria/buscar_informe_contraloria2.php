<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Informe Seguimiento</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_compromisos"><b>FECHA DE SEGUIMIENTO A COMPROMISOS</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_compromisos_x" id="bksaiacondicion_g@fecha_compromisos_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_compromisos_x" id="fecha_compromisos_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_compromisos_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_compromisos_y" id="bksaiacondicion_g@fecha_compromisos_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_compromisos_y" id="fecha_compromisos_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_compromisos_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_compromisos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_compromisos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_compromisos" id="bqsaiaenlace_fecha_compromisos" value="y" />
		</div></div></div><div class="control-group"><b>Proceso auditado<input type="hidden" name="bksaiacondicion_g@proceso_auditado" id="bksaiacondicion_g@proceso_auditado" value="like_total"></b><div class="controls"><textarea  maxlength="6000"   id="proceso_auditado" name="bqsaia_g@proceso_auditado"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@proceso_auditado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@proceso_auditado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@proceso_auditado" id="bqsaiaenlace_g@proceso_auditado" value="y" />
		</div></div></div><div class="control-group"><b>CUMPLIMIENTO DEL OBJETIVO GENERAL DEL PLAN<input type="hidden" name="bksaiacondicion_g@cumplimiento_general" id="bksaiacondicion_g@cumplimiento_general" value="like_total"></b><div class="controls"><textarea  maxlength="5000"   id="cumplimiento_general" name="bqsaia_g@cumplimiento_general"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cumplimiento_general',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cumplimiento_general',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cumplimiento_general" id="bqsaiaenlace_g@cumplimiento_general" value="y" />
		</div></div></div><div class="control-group"><b>CUMPLIMIENTO DE LOS OBJETIVOS ESPECIFICOS<input type="hidden" name="bksaiacondicion_g@cumplimiento_especificos" id="bksaiacondicion_g@cumplimiento_especificos" value="like_total"></b><div class="controls"><textarea  maxlength="5000"   id="cumplimiento_especificos" name="bqsaia_g@cumplimiento_especificos"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cumplimiento_especificos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cumplimiento_especificos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cumplimiento_especificos" id="bqsaiaenlace_g@cumplimiento_especificos" value="y" />
		</div></div></div><div class="control-group"><b>PORCENTAJE DE CUMPLIMIENTO DEL PLAN<input type="hidden" name="bksaiacondicion_g@cumplimiento_plan" id="bksaiacondicion_g@cumplimiento_plan" value="like_total"></b><div class="controls"><input type="text" id="cumplimiento_plan" name="bqsaia_g@cumplimiento_plan"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cumplimiento_plan',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cumplimiento_plan',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cumplimiento_plan" id="bqsaiaenlace_g@cumplimiento_plan" value="y" />
		</div></div></div><div class="control-group"><b>CONCLUSIONES<input type="hidden" name="bksaiacondicion_g@conclusiones" id="bksaiacondicion_g@conclusiones" value="like_total"></b><div class="controls"><textarea  maxlength="5000"   id="conclusiones" name="bqsaia_g@conclusiones"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@conclusiones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@conclusiones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@conclusiones" id="bqsaiaenlace_g@conclusiones" value="y" />
		</div></div></div><div class="control-group"><div class="controls"><b>JEFE DE CONTROL INTERNO<input type="hidden" name="bksaiacondicion_jefe_control" id="bksaiacondicion_jefe_control" value="like_total"></b><div id="esperando_jefe_control"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"></div><input type="text" id="stext_jefe_control" placeholder="Buscar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_jefe_control.findItem((document.getElementById('stext_jefe_control').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_jefe_control.findItem((document.getElementById('stext_jefe_control').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_jefe_control.findItem((document.getElementById('stext_jefe_control').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_jefe_control" height=""></div><input type="hidden" maxlength="255"  name="g@jefe_control" id="jefe_control"   value="" ><label style="display:none" class="error" for="jefe_control">Campo obligatorio.</b></label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_jefe_control=new dhtmlXTreeObject("treeboxbox_jefe_control","","",0);
                			tree_jefe_control.setImagePath("../../imgs/");
                			tree_jefe_control.enableIEImageFix(true);tree_jefe_control.enableCheckBoxes(1);
                    tree_jefe_control.enableRadioButtons(true);tree_jefe_control.setOnLoadingStart(cargando_jefe_control);
                      tree_jefe_control.setOnLoadingEnd(fin_cargando_jefe_control);tree_jefe_control.enableSmartXMLParsing(true);tree_jefe_control.loadXML("../../test.php?sin_padre=1");
                      tree_jefe_control.setOnCheckHandler(onNodeSelect_jefe_control);
                      function onNodeSelect_jefe_control(nodeId)
                      {valor_destino=document.getElementById("jefe_control");
                       destinos=tree_jefe_control.getAllChecked();
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
                      function fin_cargando_jefe_control() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_jefe_control")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_jefe_control")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_jefe_control"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_jefe_control() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_jefe_control")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_jefe_control")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_jefe_control"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></div></div><input type="hidden" name="campos_especiales" value="jefe_control@arbol"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_informe_contraloria g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_compromisos_x,g@fecha_compromisos_y">