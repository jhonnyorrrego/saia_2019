<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><div class="container master-container"><legend>B&Uacute;SQUEDA ACTA DE EVALUACION Y ADJUDICACION</legend><div class="control-group"><label class="string control-label" for="empresa">empresa<input type="hidden" name="bksaiacondicion_empresa" id="bksaiacondicion_empresa" value="="></label><div class="controls"><input type="text" id="bqsaia_empresa" name="bqsaia_empresa"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_empresa',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_empresa',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_empresa" id="bqsaiaenlace_empresa" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="aspectos_tecnicos">Aspectos tecnicos<input type="hidden" name="bksaiacondicion_aspectos_tecnicos" id="bksaiacondicion_aspectos_tecnicos" value="like"></label><div class="controls"><input type="text" id="bqsaia_aspectos_tecnicos" name="bqsaia_aspectos_tecnicos"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_aspectos_tecnicos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_aspectos_tecnicos',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_aspectos_tecnicos" id="bqsaiaenlace_aspectos_tecnicos" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="conclusion_tecnica">Conclusion tecnica<input type="hidden" name="bksaiacondicion_conclusion_tecnica" id="bksaiacondicion_conclusion_tecnica" value="like"></label><div class="controls"><input type="text" id="bqsaia_conclusion_tecnica" name="bqsaia_conclusion_tecnica"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_conclusion_tecnica',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_conclusion_tecnica',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_conclusion_tecnica" id="bqsaiaenlace_conclusion_tecnica" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="aspectos_economicos">Aspectos economicos<input type="hidden" name="bksaiacondicion_aspectos_economicos" id="bksaiacondicion_aspectos_economicos" value="like"></label><div class="controls"><input type="text" id="bqsaia_aspectos_economicos" name="bqsaia_aspectos_economicos"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_aspectos_economicos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_aspectos_economicos',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_aspectos_economicos" id="bqsaiaenlace_aspectos_economicos" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="conclusion_economica">Conclusion economica<input type="hidden" name="bksaiacondicion_conclusion_economica" id="bksaiacondicion_conclusion_economica" value="like"></label><div class="controls"><input type="text" id="bqsaia_conclusion_economica" name="bqsaia_conclusion_economica"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_conclusion_economica',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_conclusion_economica',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_conclusion_economica" id="bqsaiaenlace_conclusion_economica" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="aspectos_juridicos">Aspectos juridicos<input type="hidden" name="bksaiacondicion_aspectos_juridicos" id="bksaiacondicion_aspectos_juridicos" value="like"></label><div class="controls"><input type="text" id="bqsaia_aspectos_juridicos" name="bqsaia_aspectos_juridicos"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_aspectos_juridicos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_aspectos_juridicos',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_aspectos_juridicos" id="bqsaiaenlace_aspectos_juridicos" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="conclusion_juridica">Conclusion juridica<input type="hidden" name="bksaiacondicion_conclusion_juridica" id="bksaiacondicion_conclusion_juridica" value="like"></label><div class="controls"><input type="text" id="bqsaia_conclusion_juridica" name="bqsaia_conclusion_juridica"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_conclusion_juridica',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_conclusion_juridica',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_conclusion_juridica" id="bqsaiaenlace_conclusion_juridica" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="forma_pago">Forma pago<input type="hidden" name="bksaiacondicion_forma_pago" id="bksaiacondicion_forma_pago" value="like"></label><div class="controls"><input type="text" id="bqsaia_forma_pago" name="bqsaia_forma_pago"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_forma_pago',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_forma_pago',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_forma_pago" id="bqsaiaenlace_forma_pago" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="recomendacion">Recomendacion<input type="hidden" name="bksaiacondicion_recomendacion" id="bksaiacondicion_recomendacion" value="like"></label><div class="controls"><input type="text" id="bqsaia_recomendacion" name="bqsaia_recomendacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_recomendacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_recomendacion',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_recomendacion" id="bqsaiaenlace_recomendacion" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="plazo">plazo<input type="hidden" name="bksaiacondicion_plazo" id="bksaiacondicion_plazo" value="like"></label><div class="controls"><input type="text" id="bqsaia_plazo" name="bqsaia_plazo"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_plazo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_plazo',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_plazo" id="bqsaiaenlace_plazo" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="valor">Valor<input type="hidden" name="bksaiacondicion_valor" id="bksaiacondicion_valor" value="like"></label><div class="controls"><input type="text" id="bqsaia_valor" name="bqsaia_valor"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_valor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_valor',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_valor" id="bqsaiaenlace_valor" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="fecha_acta_evaluacion">Fecha Acta de evaluaci&oacute;n<input type="hidden" name="bksaiacondicion_fecha_acta_evaluacion" id="bksaiacondicion_fecha_acta_evaluacion" value="like"></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="fecha_acta_evaluacion_1"  id="fecha_acta_evaluacion_1" value=""><?php selector_fecha("fecha_acta_evaluacion_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_acta_evaluacion_2"  id="fecha_acta_evaluacion_2" value=""><?php selector_fecha("fecha_acta_evaluacion_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_acta_evaluacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_acta_evaluacion',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_fecha_acta_evaluacion" id="bqsaiaenlace_fecha_acta_evaluacion" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="aprobacion_economico">Aprobacion economico<input type="hidden" name="bksaiacondicion_aprobacion_economico" id="bksaiacondicion_aprobacion_economico" value="like"></label><div class="controls"><input type="text" id="bqsaia_aprobacion_economico" name="bqsaia_aprobacion_economico"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_aprobacion_economico',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_aprobacion_economico',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_aprobacion_economico" id="bqsaiaenlace_aprobacion_economico" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="aprobacion_tecnico">Aprobacion tecnica<input type="hidden" name="bksaiacondicion_aprobacion_tecnico" id="bksaiacondicion_aprobacion_tecnico" value="like"></label><div class="controls"><input type="text" id="bqsaia_aprobacion_tecnico" name="bqsaia_aprobacion_tecnico"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_aprobacion_tecnico',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_aprobacion_tecnico',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_aprobacion_tecnico" id="bqsaiaenlace_aprobacion_tecnico" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="aprobacion_juridico">Aprobacion juridico<input type="hidden" name="bksaiacondicion_aprobacion_juridico" id="bksaiacondicion_aprobacion_juridico" value="like"></label><div class="controls"><input type="text" id="bqsaia_aprobacion_juridico" name="bqsaia_aprobacion_juridico"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_aprobacion_juridico',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_aprobacion_juridico',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_aprobacion_juridico" id="bqsaiaenlace_aprobacion_juridico" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="convenio">Convenio<input type="hidden" name="bksaiacondicion_convenio" id="bksaiacondicion_convenio" value="="></label><div class="controls"><input type="text" id="bqsaia_convenio" name="bqsaia_convenio"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_convenio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_convenio',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_convenio" id="bqsaiaenlace_convenio" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="solitud_oferta">Solicitud de oferta<input type="hidden" name="bksaiacondicion_solitud_oferta" id="bksaiacondicion_solitud_oferta" value="="></label><div class="controls"><input type="text" id="bqsaia_solitud_oferta" name="bqsaia_solitud_oferta"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_solitud_oferta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_solitud_oferta',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_solitud_oferta" id="bqsaiaenlace_solitud_oferta" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="lista">A&ntilde;o<input type="hidden" name="bksaiacondicion_lista" id="bksaiacondicion_lista" value="like"></label><div class="controls"><?php genera_campo_listados_editar(82,1075,'',1);?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_lista',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_lista',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_lista" id="bqsaiaenlace_lista" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="evaluador_tecnico">Evaluador tecnico<input type="hidden" name="bksaiacondicion_evaluador_tecnico" id="bksaiacondicion_evaluador_tecnico" value="="></label><div class="controls"><div id="esperando_evaluador_tecnico"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(82,1009,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_evaluador_tecnico" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_evaluador_tecnico.findItem(htmlentities(document.getElementById('stext_evaluador_tecnico').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_evaluador_tecnico.findItem(htmlentities(document.getElementById('stext_evaluador_tecnico').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_evaluador_tecnico.findItem(htmlentities(document.getElementById('stext_evaluador_tecnico').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_evaluador_tecnico" height="90%"></div><input type="hidden" maxlength="11"  name="evaluador_tecnico" id="evaluador_tecnico"   value="" ><label style="display:none" class="error" for="evaluador_tecnico">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_evaluador_tecnico=new dhtmlXTreeObject("treeboxbox_evaluador_tecnico","100%","100%",0);
                			tree_evaluador_tecnico.setImagePath("../../imgs/");
                			tree_evaluador_tecnico.enableIEImageFix(true);tree_evaluador_tecnico.enableCheckBoxes(1);
                    tree_evaluador_tecnico.enableRadioButtons(true);tree_evaluador_tecnico.setOnLoadingStart(cargando_evaluador_tecnico);
                      tree_evaluador_tecnico.setOnLoadingEnd(fin_cargando_evaluador_tecnico);tree_evaluador_tecnico.enableSmartXMLParsing(true);tree_evaluador_tecnico.loadXML("../../test.php?rol=1");
                      tree_evaluador_tecnico.setOnCheckHandler(onNodeSelect_evaluador_tecnico);
                      function onNodeSelect_evaluador_tecnico(nodeId)
                      {valor_destino=document.getElementById("evaluador_tecnico");
                       destinos=tree_evaluador_tecnico.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_evaluador_tecnico.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_evaluador_tecnico() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_evaluador_tecnico")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_evaluador_tecnico")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_evaluador_tecnico"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_evaluador_tecnico() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_evaluador_tecnico")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_evaluador_tecnico")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_evaluador_tecnico"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_evaluador_tecnico',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_evaluador_tecnico',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_evaluador_tecnico" id="bqsaiaenlace_evaluador_tecnico" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="evaluador_economico">Evaluador economico<input type="hidden" name="bksaiacondicion_evaluador_economico" id="bksaiacondicion_evaluador_economico" value="="></label><div class="controls"><div id="esperando_evaluador_economico"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(82,1015,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_evaluador_economico" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_evaluador_economico.findItem(htmlentities(document.getElementById('stext_evaluador_economico').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_evaluador_economico.findItem(htmlentities(document.getElementById('stext_evaluador_economico').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_evaluador_economico.findItem(htmlentities(document.getElementById('stext_evaluador_economico').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_evaluador_economico" height="90%"></div><input type="hidden" maxlength="11"  name="evaluador_economico" id="evaluador_economico"   value="" ><label style="display:none" class="error" for="evaluador_economico">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_evaluador_economico=new dhtmlXTreeObject("treeboxbox_evaluador_economico","100%","100%",0);
                			tree_evaluador_economico.setImagePath("../../imgs/");
                			tree_evaluador_economico.enableIEImageFix(true);tree_evaluador_economico.enableCheckBoxes(1);
                    tree_evaluador_economico.enableRadioButtons(true);tree_evaluador_economico.setOnLoadingStart(cargando_evaluador_economico);
                      tree_evaluador_economico.setOnLoadingEnd(fin_cargando_evaluador_economico);tree_evaluador_economico.enableSmartXMLParsing(true);tree_evaluador_economico.loadXML("../../test.php?rol=1");
                      tree_evaluador_economico.setOnCheckHandler(onNodeSelect_evaluador_economico);
                      function onNodeSelect_evaluador_economico(nodeId)
                      {valor_destino=document.getElementById("evaluador_economico");
                       destinos=tree_evaluador_economico.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_evaluador_economico.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_evaluador_economico() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_evaluador_economico")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_evaluador_economico")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_evaluador_economico"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_evaluador_economico() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_evaluador_economico")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_evaluador_economico")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_evaluador_economico"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_evaluador_economico',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_evaluador_economico',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_evaluador_economico" id="bqsaiaenlace_evaluador_economico" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="evaluador_juridico">Evaluador juridico<input type="hidden" name="bksaiacondicion_evaluador_juridico" id="bksaiacondicion_evaluador_juridico" value="="></label><div class="controls"><div id="esperando_evaluador_juridico"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(82,1016,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_evaluador_juridico" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_evaluador_juridico.findItem(htmlentities(document.getElementById('stext_evaluador_juridico').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_evaluador_juridico.findItem(htmlentities(document.getElementById('stext_evaluador_juridico').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_evaluador_juridico.findItem(htmlentities(document.getElementById('stext_evaluador_juridico').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_evaluador_juridico" height="90%"></div><input type="hidden" maxlength="11"  name="evaluador_juridico" id="evaluador_juridico"   value="" ><label style="display:none" class="error" for="evaluador_juridico">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_evaluador_juridico=new dhtmlXTreeObject("treeboxbox_evaluador_juridico","100%","100%",0);
                			tree_evaluador_juridico.setImagePath("../../imgs/");
                			tree_evaluador_juridico.enableIEImageFix(true);tree_evaluador_juridico.enableCheckBoxes(1);
                    tree_evaluador_juridico.enableRadioButtons(true);tree_evaluador_juridico.setOnLoadingStart(cargando_evaluador_juridico);
                      tree_evaluador_juridico.setOnLoadingEnd(fin_cargando_evaluador_juridico);tree_evaluador_juridico.enableSmartXMLParsing(true);tree_evaluador_juridico.loadXML("../../test.php?rol=1");
                      tree_evaluador_juridico.setOnCheckHandler(onNodeSelect_evaluador_juridico);
                      function onNodeSelect_evaluador_juridico(nodeId)
                      {valor_destino=document.getElementById("evaluador_juridico");
                       destinos=tree_evaluador_juridico.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_evaluador_juridico.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_evaluador_juridico() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_evaluador_juridico")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_evaluador_juridico")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_evaluador_juridico"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_evaluador_juridico() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_evaluador_juridico")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_evaluador_juridico")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_evaluador_juridico"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_evaluador_juridico',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_evaluador_juridico',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_evaluador_juridico" id="bqsaiaenlace_evaluador_juridico" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="interventor">Interventor<input type="hidden" name="bksaiacondicion_interventor" id="bksaiacondicion_interventor" value="="></label><div class="controls"><input type="text" id="bqsaia_interventor" name="bqsaia_interventor"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_interventor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_interventor',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_interventor" id="bqsaiaenlace_interventor" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="objeto_contratacion">Objeto contratacion<input type="hidden" name="bksaiacondicion_objeto_contratacion" id="bksaiacondicion_objeto_contratacion" value="like"></label><div class="controls"><input type="text" id="bqsaia_objeto_contratacion" name="bqsaia_objeto_contratacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_objeto_contratacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_objeto_contratacion',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_objeto_contratacion" id="bqsaiaenlace_objeto_contratacion" value="" />
		</div></div></div><input type="hidden" name="adicionar_consulta" value="1">
     <?php if(@$_REQUEST["campo__retorno"]){ ?>
                <input type="hidden" name="campo__retorno" value="<?php echo($_REQUEST["campo__retorno"]); ?>">
              <?php }
               if(@$_REQUEST["formulario__retorno"]){ ?>
                <input type="hidden" name="formulario__retorno" value="<?php echo($_REQUEST["formulario__retorno"]); ?>">
              <?php }
                if(@$_REQUEST["pagina__retorno"]){ ?>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_REQUEST["pagina__retorno"]); ?>">
             <?php  }
              else{ ?>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_SERVER["PHP_SELF"]); ?>">
             <?php  } ?><div class="form-actions"> <button type="button" class="btn btn-primary" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" id="ksubmit_saia" titulo="Resultado empresa">Buscar</button>
    <input class="btn btn-danger" name="commit" type="reset" value="Cancelar"></div></body><input type="hidden" name="idbusqueda_componente" value="0">