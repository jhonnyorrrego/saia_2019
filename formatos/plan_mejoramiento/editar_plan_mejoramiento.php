<html><title>.:EDITAR PLAN DE MEJORAMIENTO:.</title><head><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">PLAN DE MEJORAMIENTO</td></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',379,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',379,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="estado_terminado" value="<?php echo(mostrar_valor_campo('estado_terminado',379,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_elaborado" value="<?php echo(mostrar_valor_campo('fecha_elaborado',379,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_aprobado" value="<?php echo(mostrar_valor_campo('fecha_aprobado',379,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_revisado" value="<?php echo(mostrar_valor_campo('fecha_revisado',379,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(379,4458,$_REQUEST['iddoc']);?></tr><tr id="tr_tipo_plan" >
                     <td class="encabezado" width="20%" title="">TIPO DE PLAN*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(379,4459,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',379,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_plan_mejoramiento" value="<?php echo(mostrar_valor_campo('idft_plan_mejoramiento',379,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">FECHA DE SUSCRIPCION*</td>
                     <?php fecha_formato(379,4462,$_REQUEST['iddoc']);?></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA RECEPCI&Oacute;N INFORME FINAL*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_informe" id="fecha_informe" tipo="fecha" value="<?php mostrar_valor_campo('fecha_informe',379,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_informe","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="Anexar informes auditoria">ANEXAR INFORMES AUDITORIA</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=379&idcampo=4464" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><tr>
                     <td class="encabezado" width="20%" title="Plan de Mejoramiento Institucional, Funcional o Individual">TIPO DE AUDITORIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(379,4465,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">AUDITOR*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(379,4466,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N AUDITOR OTROS/AUTOEVALUACI&Oacute;N/RETROALIMENTACI&Oacute;N CLIENTE.</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="descripcion_otros" id="descripcion_otros" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('descripcion_otros',379,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Realizar una breve descripci&oacute;n del alcance de la Auditor&iacute;a o l&iacute;nea de auditor&iacute;a realizada">DESCRIPCION*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="descripcion_plan" id="descripcion_plan" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('descripcion_plan',379,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="estado_plan_mejoramiento" value="<?php echo(mostrar_valor_campo('estado_plan_mejoramiento',379,$_REQUEST['iddoc'])); ?>"><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="Estado Actual del Proceso :
ELABORACION,REVISION,APROBACION,DISTRIBUCION,INACTIVO ">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(379,4470,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="Periodo que cubri&oacute; la auditor&iacute;a">PERIODO EVALUADO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='5'  type="text" size="100" id="periodo_evaluado" name="periodo_evaluado"  value="<?php echo(mostrar_valor_campo('periodo_evaluado',379,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBJETIVO GENERAL*</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="objetivo" id="objetivo" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('objetivo',379,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBJETIVOS ESPECIFICOS*</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="objetivos_especificos" id="objetivos_especificos" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('objetivos_especificos',379,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='8'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones',379,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">ELABORADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(379,4475,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='9'  type="text" id="stext_elaborado" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_elaborado.findItem(htmlentities(document.getElementById('stext_elaborado').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_elaborado.findItem(htmlentities(document.getElementById('stext_elaborado').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_elaborado.findItem(htmlentities(document.getElementById('stext_elaborado').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_elaborado"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_elaborado" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="elaborado" id="elaborado"   value="<?php cargar_seleccionados(379,4475,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_elaborado=new dhtmlXTreeObject("treeboxbox_elaborado","100%","100%",0);
                			tree_elaborado.setImagePath("../../imgs/");
                			tree_elaborado.enableIEImageFix(true);tree_elaborado.enableCheckBoxes(1);
                    tree_elaborado.enableRadioButtons(true);tree_elaborado.setOnLoadingStart(cargando_elaborado);
                      tree_elaborado.setOnLoadingEnd(fin_cargando_elaborado);tree_elaborado.enableSmartXMLParsing(true);tree_elaborado.loadXML("../../test.php",checkear_arbol);
                	        tree_elaborado.setOnCheckHandler(onNodeSelect_elaborado);
                      function onNodeSelect_elaborado(nodeId)
                      {valor_destino=document.getElementById("elaborado");

                       if(tree_elaborado.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_elaborado.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_elaborado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_elaborado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_elaborado")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_elaborado"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_elaborado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_elaborado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_elaborado")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_elaborado"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(379,4475,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_elaborado.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">REVISADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(379,4476,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='10'  type="text" id="stext_revisado" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_revisado.findItem(htmlentities(document.getElementById('stext_revisado').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_revisado.findItem(htmlentities(document.getElementById('stext_revisado').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_revisado.findItem(htmlentities(document.getElementById('stext_revisado').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_revisado"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_revisado" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="revisado" id="revisado"   value="<?php cargar_seleccionados(379,4476,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_revisado=new dhtmlXTreeObject("treeboxbox_revisado","100%","100%",0);
                			tree_revisado.setImagePath("../../imgs/");
                			tree_revisado.enableIEImageFix(true);tree_revisado.enableCheckBoxes(1);
                    tree_revisado.enableRadioButtons(true);tree_revisado.setOnLoadingStart(cargando_revisado);
                      tree_revisado.setOnLoadingEnd(fin_cargando_revisado);tree_revisado.enableSmartXMLParsing(true);tree_revisado.loadXML("../../test.php",checkear_arbol);
                	        tree_revisado.setOnCheckHandler(onNodeSelect_revisado);
                      function onNodeSelect_revisado(nodeId)
                      {valor_destino=document.getElementById("revisado");

                       if(tree_revisado.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_revisado.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_revisado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_revisado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_revisado")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_revisado"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_revisado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_revisado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_revisado")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_revisado"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(379,4476,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_revisado.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">APROBADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(379,4477,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='11'  type="text" id="stext_aprobado" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_aprobado.findItem(htmlentities(document.getElementById('stext_aprobado').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_aprobado.findItem(htmlentities(document.getElementById('stext_aprobado').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_aprobado.findItem(htmlentities(document.getElementById('stext_aprobado').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_aprobado"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_aprobado" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="aprobado" id="aprobado"   value="<?php cargar_seleccionados(379,4477,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_aprobado=new dhtmlXTreeObject("treeboxbox_aprobado","100%","100%",0);
                			tree_aprobado.setImagePath("../../imgs/");
                			tree_aprobado.enableIEImageFix(true);tree_aprobado.enableCheckBoxes(1);
                    tree_aprobado.enableRadioButtons(true);tree_aprobado.setOnLoadingStart(cargando_aprobado);
                      tree_aprobado.setOnLoadingEnd(fin_cargando_aprobado);tree_aprobado.enableSmartXMLParsing(true);tree_aprobado.loadXML("../../test.php",checkear_arbol);
                	        tree_aprobado.setOnCheckHandler(onNodeSelect_aprobado);
                      function onNodeSelect_aprobado(nodeId)
                      {valor_destino=document.getElementById("aprobado");

                       if(tree_aprobado.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_aprobado.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_aprobado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobado")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_aprobado"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_aprobado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobado")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_aprobado"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(379,4477,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_aprobado.setCheck(vector2[m],true);
                    }}
--></script></td></tr><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',379,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="version" value="<?php echo(mostrar_valor_campo('version',379,$_REQUEST['iddoc'])); ?>"><?php ver_campo_estado(379,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('4462,4468'); ?>"><input type="hidden" name="formato" value="379"><tr><td colspan='2'><?php submit_formato(379,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>