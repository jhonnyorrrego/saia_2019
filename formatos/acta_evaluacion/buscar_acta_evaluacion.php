<html><title>.:BUSCAR ACTA DE EVALUACION Y ADJUDICACION:.</title><head><?php include_once("../../calendario/calendario.php"); ?><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ACTA DE EVALUACION Y ADJUDICACION</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_empresa" id="condicion_empresa"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">EMPRESA</td><td class="encabezado">&nbsp;<select name="compara_empresa" id="compara_empresa"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="empresa" name="empresa"></select><script>
                     $(document).ready(function() 
                      {
                      $("#empresa").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_aspectos_tecnicos" id="condicion_aspectos_tecnicos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ASPECTOS TECNICOS</td><td class="encabezado">&nbsp;<select name="compara_aspectos_tecnicos" id="compara_aspectos_tecnicos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="aspectos_tecnicos" name="aspectos_tecnicos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#aspectos_tecnicos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_conclusion_tecnica" id="condicion_conclusion_tecnica"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONCLUSION TECNICA</td><td class="encabezado">&nbsp;<select name="compara_conclusion_tecnica" id="compara_conclusion_tecnica"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="conclusion_tecnica" name="conclusion_tecnica"></select><script>
                     $(document).ready(function() 
                      {
                      $("#conclusion_tecnica").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_aspectos_economicos" id="condicion_aspectos_economicos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ASPECTOS ECONOMICOS</td><td class="encabezado">&nbsp;<select name="compara_aspectos_economicos" id="compara_aspectos_economicos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="aspectos_economicos" name="aspectos_economicos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#aspectos_economicos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_conclusion_economica" id="condicion_conclusion_economica"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONCLUSION ECONOMICA</td><td class="encabezado">&nbsp;<select name="compara_conclusion_economica" id="compara_conclusion_economica"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="conclusion_economica" name="conclusion_economica"></select><script>
                     $(document).ready(function() 
                      {
                      $("#conclusion_economica").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_aspectos_juridicos" id="condicion_aspectos_juridicos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ASPECTOS JURIDICOS</td><td class="encabezado">&nbsp;<select name="compara_aspectos_juridicos" id="compara_aspectos_juridicos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="aspectos_juridicos" name="aspectos_juridicos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#aspectos_juridicos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_conclusion_juridica" id="condicion_conclusion_juridica"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONCLUSION JURIDICA</td><td class="encabezado">&nbsp;<select name="compara_conclusion_juridica" id="compara_conclusion_juridica"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="conclusion_juridica" name="conclusion_juridica"></select><script>
                     $(document).ready(function() 
                      {
                      $("#conclusion_juridica").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_forma_pago" id="condicion_forma_pago"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FORMA PAGO</td><td class="encabezado">&nbsp;<select name="compara_forma_pago" id="compara_forma_pago"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="forma_pago" name="forma_pago"></select><script>
                     $(document).ready(function() 
                      {
                      $("#forma_pago").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_recomendacion" id="condicion_recomendacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RECOMENDACION</td><td class="encabezado">&nbsp;<select name="compara_recomendacion" id="compara_recomendacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="recomendacion" name="recomendacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#recomendacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_plazo" id="condicion_plazo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PLAZO</td><td class="encabezado">&nbsp;<select name="compara_plazo" id="compara_plazo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="plazo" name="plazo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#plazo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor" id="condicion_valor"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR</td><td class="encabezado">&nbsp;<select name="compara_valor" id="compara_valor"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor" name="valor"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_acta_evaluacion" id="condicion_fecha_acta_evaluacion"><option value="AND">Y</option><option value="OR">O</option></td>
                    <td class="encabezado" width="20%" title="">FECHA ACTA DE EVALUACI&Oacute;N</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_acta_evaluacion_1"  id="fecha_acta_evaluacion_1" value=""><?php selector_fecha("fecha_acta_evaluacion_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_acta_evaluacion_2"  id="fecha_acta_evaluacion_2" value=""><?php selector_fecha("fecha_acta_evaluacion_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_aprobacion_economico" id="condicion_aprobacion_economico"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">APROBACION ECONOMICO</td><td class="encabezado">&nbsp;<select name="compara_aprobacion_economico" id="compara_aprobacion_economico"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="aprobacion_economico" name="aprobacion_economico"></select><script>
                     $(document).ready(function() 
                      {
                      $("#aprobacion_economico").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_aprobacion_tecnico" id="condicion_aprobacion_tecnico"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">APROBACION TECNICA</td><td class="encabezado">&nbsp;<select name="compara_aprobacion_tecnico" id="compara_aprobacion_tecnico"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="aprobacion_tecnico" name="aprobacion_tecnico"></select><script>
                     $(document).ready(function() 
                      {
                      $("#aprobacion_tecnico").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_aprobacion_juridico" id="condicion_aprobacion_juridico"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">APROBACION JURIDICO</td><td class="encabezado">&nbsp;<select name="compara_aprobacion_juridico" id="compara_aprobacion_juridico"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="aprobacion_juridico" name="aprobacion_juridico"></select><script>
                     $(document).ready(function() 
                      {
                      $("#aprobacion_juridico").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_convenio" id="condicion_convenio"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONVENIO</td><td class="encabezado">&nbsp;<select name="compara_convenio" id="compara_convenio"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="convenio" name="convenio"></select><script>
                     $(document).ready(function() 
                      {
                      $("#convenio").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_solitud_oferta" id="condicion_solitud_oferta"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SOLICITUD DE OFERTA</td><td class="encabezado">&nbsp;<select name="compara_solitud_oferta" id="compara_solitud_oferta"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="solitud_oferta" name="solitud_oferta"></select><script>
                     $(document).ready(function() 
                      {
                      $("#solitud_oferta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_lista" id="condicion_lista"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">A&Ntilde;O</td><td class="encabezado">&nbsp;<select name="compara_lista" id="compara_lista"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(82,1075,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_evaluador_tecnico" id="condicion_evaluador_tecnico"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">EVALUADOR TECNICO</td><td class="encabezado">&nbsp;<select name="compara_evaluador_tecnico" id="compara_evaluador_tecnico"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_evaluador_tecnico"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(82,1009,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_evaluador_tecnico" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_evaluador_tecnico.findItem(htmlentities(document.getElementById('stext_evaluador_tecnico').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_evaluador_tecnico.findItem(htmlentities(document.getElementById('stext_evaluador_tecnico').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_evaluador_tecnico.findItem(htmlentities(document.getElementById('stext_evaluador_tecnico').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_evaluador_tecnico" height="90%"></div><input type="hidden" maxlength="11"  name="evaluador_tecnico" id="evaluador_tecnico"   value="" ><label style="display:none" class="error" for="evaluador_tecnico">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_evaluador_tecnico.setOnLoadingEnd(fin_cargando_evaluador_tecnico);tree_evaluador_tecnico.enableSmartXMLParsing(true);tree_evaluador_tecnico.loadXML("../../test.php");
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
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_evaluador_economico" id="condicion_evaluador_economico"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">EVALUADOR ECONOMICO</td><td class="encabezado">&nbsp;<select name="compara_evaluador_economico" id="compara_evaluador_economico"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_evaluador_economico"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(82,1015,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_evaluador_economico" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_evaluador_economico.findItem(htmlentities(document.getElementById('stext_evaluador_economico').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_evaluador_economico.findItem(htmlentities(document.getElementById('stext_evaluador_economico').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_evaluador_economico.findItem(htmlentities(document.getElementById('stext_evaluador_economico').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_evaluador_economico" height="90%"></div><input type="hidden" maxlength="11"  name="evaluador_economico" id="evaluador_economico"   value="" ><label style="display:none" class="error" for="evaluador_economico">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_evaluador_economico.setOnLoadingEnd(fin_cargando_evaluador_economico);tree_evaluador_economico.enableSmartXMLParsing(true);tree_evaluador_economico.loadXML("../../test.php");
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
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_evaluador_juridico" id="condicion_evaluador_juridico"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">EVALUADOR JURIDICO</td><td class="encabezado">&nbsp;<select name="compara_evaluador_juridico" id="compara_evaluador_juridico"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_evaluador_juridico"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(82,1016,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_evaluador_juridico" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_evaluador_juridico.findItem(htmlentities(document.getElementById('stext_evaluador_juridico').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_evaluador_juridico.findItem(htmlentities(document.getElementById('stext_evaluador_juridico').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_evaluador_juridico.findItem(htmlentities(document.getElementById('stext_evaluador_juridico').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_evaluador_juridico" height="90%"></div><input type="hidden" maxlength="11"  name="evaluador_juridico" id="evaluador_juridico"   value="" ><label style="display:none" class="error" for="evaluador_juridico">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_evaluador_juridico.setOnLoadingEnd(fin_cargando_evaluador_juridico);tree_evaluador_juridico.enableSmartXMLParsing(true);tree_evaluador_juridico.loadXML("../../test.php");
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
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_interventor" id="condicion_interventor"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">INTERVENTOR</td><td class="encabezado">&nbsp;<select name="compara_interventor" id="compara_interventor"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="interventor" name="interventor"></select><script>
                     $(document).ready(function() 
                      {
                      $("#interventor").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_objeto_contratacion" id="condicion_objeto_contratacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBJETO CONTRATACION</td><td class="encabezado">&nbsp;<select name="compara_objeto_contratacion" id="compara_objeto_contratacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="objeto_contratacion" name="objeto_contratacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#objeto_contratacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="1017,1074"><?php submit_formato(82);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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
             <?php  } ?></form></body></html>