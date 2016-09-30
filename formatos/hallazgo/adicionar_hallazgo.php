<html><title>.:ADICIONAR HALLAZGO PLAN DE MEJORAMIENTO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">HALLAZGO PLAN DE MEJORAMIENTO</td></tr><input type="hidden" name="notifica_cump" value="<?php echo(validar_valor_campo(4623)); ?>"><input type="hidden" name="notifica_seg" value="<?php echo(validar_valor_campo(4624)); ?>"><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(4884)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(390,4625);?></tr><tr>
                     <td class="encabezado" width="20%" title="">GESTION CALIDAD</td>
                     <?php ft_gestion_calid_funcion(390,4626);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CLASE ACCION*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(390,4627,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="radicado del plan de mejoramiento padre">RADICADO DEL PLAN VINCULADO</td>
                     <?php radicado_plan_padre(390,4628);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CONSECUTIVO</td>
                     <?php consecutivo_hallazgo_funcion(390,4629);?></tr><tr>
                   <td class="encabezado" width="20%" title="Procesos Vinculados">PROCESOS VINCULADOS*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(390,4630,'3',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_procesos_vinculados" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_procesos_vinculados.findItem(htmlentities(document.getElementById('stext_procesos_vinculados').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_procesos_vinculados.findItem(htmlentities(document.getElementById('stext_procesos_vinculados').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_procesos_vinculados.findItem(htmlentities(document.getElementById('stext_procesos_vinculados').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_procesos_vinculados"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_procesos_vinculados" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="procesos_vinculados" id="procesos_vinculados"   value="" ><label style="display:none" class="error" for="procesos_vinculados">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_procesos_vinculados=new dhtmlXTreeObject("treeboxbox_procesos_vinculados","100%","100%",0);
                			tree_procesos_vinculados.setImagePath("../../imgs/");
                			tree_procesos_vinculados.enableIEImageFix(true);tree_procesos_vinculados.enableCheckBoxes(1);
                			tree_procesos_vinculados.enableThreeStateCheckboxes(1);tree_procesos_vinculados.setOnLoadingStart(cargando_procesos_vinculados);
                      tree_procesos_vinculados.setOnLoadingEnd(fin_cargando_procesos_vinculados);tree_procesos_vinculados.enableSmartXMLParsing(true);tree_procesos_vinculados.loadXML("test_procesos.php");
                	        
                      tree_procesos_vinculados.setOnCheckHandler(onNodeSelect_procesos_vinculados);
                      function onNodeSelect_procesos_vinculados(nodeId)
                      {valor_destino=document.getElementById("procesos_vinculados");
                       destinos=tree_procesos_vinculados.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_procesos_vinculados.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               
                               for(h=0;h<vectorh.length;h++)
                                  {if(vectorh[h].indexOf("_")!=-1)
                                      vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
                                   nuevo=eliminarItem(nuevo,vectorh[h]);
                                  } 
                              }
                          }
                       nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");   
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_procesos_vinculados() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_procesos_vinculados")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_procesos_vinculados")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_procesos_vinculados"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_procesos_vinculados() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_procesos_vinculados")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_procesos_vinculados")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_procesos_vinculados"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">CLASE DE OBSERVACI&Oacute;N*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(390,4631,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEFICIENCIA</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="deficiencia" id="deficiencia" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(4632)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CORRECCI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="correcion_hallazgo" id="correcion_hallazgo" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4633)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CAUSAS</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="causas" id="causas" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(4634)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ACCI&Oacute;N CORRECTIVA/PREVENTIVA Y/O MEJORA*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="accion_mejoramiento" id="accion_mejoramiento" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4635)); ?></textarea></td>
                    </tr><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="Estado Actual del Proceso :
ELABORACION,REVISION,APROBACION,DISTRIBUCION,INACTIVO ">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(390,4636,$_REQUEST['iddoc']);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">AREA RESPONSABLE</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(390,4637,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='6'  type="text" id="stext_secretarias" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_secretarias.findItem(htmlentities(document.getElementById('stext_secretarias').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_secretarias.findItem(htmlentities(document.getElementById('stext_secretarias').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_secretarias.findItem(htmlentities(document.getElementById('stext_secretarias').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_secretarias"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_secretarias" height="90%"></div><input type="hidden" maxlength="255"  name="secretarias" id="secretarias"   value="" ><label style="display:none" class="error" for="secretarias">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_secretarias=new dhtmlXTreeObject("treeboxbox_secretarias","100%","100%",0);
                			tree_secretarias.setImagePath("../../imgs/");
                			tree_secretarias.enableIEImageFix(true);tree_secretarias.enableCheckBoxes(1);
                			tree_secretarias.enableThreeStateCheckboxes(1);tree_secretarias.setOnLoadingStart(cargando_secretarias);
                      tree_secretarias.setOnLoadingEnd(fin_cargando_secretarias);tree_secretarias.enableSmartXMLParsing(true);tree_secretarias.loadXML("../../test_serie.php?tabla=dependencia");
                	        
                      tree_secretarias.setOnCheckHandler(onNodeSelect_secretarias);
                      function onNodeSelect_secretarias(nodeId)
                      {valor_destino=document.getElementById("secretarias");
                       destinos=tree_secretarias.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_secretarias.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               
                               for(h=0;h<vectorh.length;h++)
                                  {if(vectorh[h].indexOf("_")!=-1)
                                      vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
                                   nuevo=eliminarItem(nuevo,vectorh[h]);
                                  } 
                              }
                          }
                       nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");   
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_secretarias() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_secretarias")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_secretarias")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_secretarias"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_secretarias() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_secretarias")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_secretarias")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_secretarias"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">RESPONSABLES DE MEJORAMIENTO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(390,4638,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='7'  type="text" id="stext_responsables" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_responsables.findItem(htmlentities(document.getElementById('stext_responsables').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsables.findItem(htmlentities(document.getElementById('stext_responsables').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_responsables.findItem(htmlentities(document.getElementById('stext_responsables').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_responsables"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_responsables" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="responsables" id="responsables"   value="" ><label style="display:none" class="error" for="responsables">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsables=new dhtmlXTreeObject("treeboxbox_responsables","100%","100%",0);
                			tree_responsables.setImagePath("../../imgs/");
                			tree_responsables.enableIEImageFix(true);tree_responsables.enableCheckBoxes(1);
                			tree_responsables.enableThreeStateCheckboxes(1);tree_responsables.setOnLoadingStart(cargando_responsables);
                      tree_responsables.setOnLoadingEnd(fin_cargando_responsables);tree_responsables.enableSmartXMLParsing(true);tree_responsables.loadXML("../../test.php");
                	        
                      tree_responsables.setOnCheckHandler(onNodeSelect_responsables);
                      function onNodeSelect_responsables(nodeId)
                      {valor_destino=document.getElementById("responsables");
                       destinos=tree_responsables.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_responsables.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               
                               for(h=0;h<vectorh.length;h++)
                                  {if(vectorh[h].indexOf("_")!=-1)
                                      vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
                                   nuevo=eliminarItem(nuevo,vectorh[h]);
                                  } 
                              }
                          }
                       nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");   
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_responsables() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsables")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsables")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsables"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_responsables() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsables")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsables")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsables"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                       <td class="encabezado" width="20%" title="">TIEMPO PROGRAMADO PARA CUMPLIMIENTO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='8'  type="text" readonly="true"  class="required dateISO"  name="tiempo_cumplimiento" id="tiempo_cumplimiento" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("tiempo_cumplimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                       <td class="encabezado" width="20%" title="">TIEMPO PROGRAMADO PARA SEGUIMIENTO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='9'  type="text" readonly="true"  class="required dateISO"  name="tiempo_seguimiento" id="tiempo_seguimiento" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("tiempo_seguimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                   <td class="encabezado" width="20%" title="">RESPONSABLES DE SEGUIMIENTO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(390,4641,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='10'  type="text" id="stext_responsable_seguimiento" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_responsable_seguimiento.findItem(htmlentities(document.getElementById('stext_responsable_seguimiento').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable_seguimiento.findItem(htmlentities(document.getElementById('stext_responsable_seguimiento').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_responsable_seguimiento.findItem(htmlentities(document.getElementById('stext_responsable_seguimiento').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_responsable_seguimiento"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_responsable_seguimiento" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="responsable_seguimiento" id="responsable_seguimiento"   value="" ><label style="display:none" class="error" for="responsable_seguimiento">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable_seguimiento=new dhtmlXTreeObject("treeboxbox_responsable_seguimiento","100%","100%",0);
                			tree_responsable_seguimiento.setImagePath("../../imgs/");
                			tree_responsable_seguimiento.enableIEImageFix(true);tree_responsable_seguimiento.enableCheckBoxes(1);
                			tree_responsable_seguimiento.enableThreeStateCheckboxes(1);tree_responsable_seguimiento.setOnLoadingStart(cargando_responsable_seguimiento);
                      tree_responsable_seguimiento.setOnLoadingEnd(fin_cargando_responsable_seguimiento);tree_responsable_seguimiento.enableSmartXMLParsing(true);tree_responsable_seguimiento.loadXML("../../test.php?sin_padre=1");
                	        
                      tree_responsable_seguimiento.setOnCheckHandler(onNodeSelect_responsable_seguimiento);
                      function onNodeSelect_responsable_seguimiento(nodeId)
                      {valor_destino=document.getElementById("responsable_seguimiento");
                       destinos=tree_responsable_seguimiento.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_responsable_seguimiento.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               
                               for(h=0;h<vectorh.length;h++)
                                  {if(vectorh[h].indexOf("_")!=-1)
                                      vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
                                   nuevo=eliminarItem(nuevo,vectorh[h]);
                                  } 
                              }
                          }
                       nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");   
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_responsable_seguimiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_seguimiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_seguimiento")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable_seguimiento"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_responsable_seguimiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_seguimiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_seguimiento")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable_seguimiento"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">INDICADOR DE ACCI&Oacute;N DE CUMPLIMIENTO*</td>
                     <td class="celda_transparente"><textarea  tabindex='11'  name="indicador_cumplimiento" id="indicador_cumplimiento" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4642)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='12'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(4643)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="mecanismo_interno">MECANISMO DE SEGUIMIENTO INTERNO*</td>
                     <td class="celda_transparente"><textarea  tabindex='13'  name="mecanismo_interno" id="mecanismo_interno" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4644)); ?></textarea></td>
                    </tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4645)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4646)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4647)); ?>"><input type="hidden" name="idft_hallazgo" value="<?php echo(validar_valor_campo(4648)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4649)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_plan_mejoramiento"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_plan_mejoramiento"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_plan_mejoramiento);} ?><?php tipo_plan_plan_mejoramiento(390,NULL);?><?php validar_entrada_hallazgo(390,NULL);?><input type="hidden" name="campo_descripcion" value="4628,4629,4632"><tr><td colspan='2'><?php submit_formato(390);?></td></tr></table></form></body></html>