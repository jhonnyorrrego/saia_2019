<html><title>.:ADICIONAR PLAN DE MEJORAMIENTO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">PLAN DE MEJORAMIENTO</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4453)); ?>"><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(4883)); ?>"><input type="hidden" name="estado_terminado" value="<?php echo(validar_valor_campo(4454)); ?>"><input type="hidden" name="fecha_elaborado" value="<?php echo(validar_valor_campo(4455)); ?>"><input type="hidden" name="fecha_aprobado" value="<?php echo(validar_valor_campo(4456)); ?>"><input type="hidden" name="fecha_revisado" value="<?php echo(validar_valor_campo(4457)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(379,4458);?></tr><tr id="tr_tipo_plan" >
                     <td class="encabezado" width="20%" title="">TIPO DE PLAN*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(379,4459,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4460)); ?>"><input type="hidden" name="idft_plan_mejoramiento" value="<?php echo(validar_valor_campo(4461)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">FECHA DE SUSCRIPCION*</td>
                     <?php fecha_formato(379,4462);?></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA RECEPCI&Oacute;N INFORME FINAL*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_informe" id="fecha_informe" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_informe","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="Anexar informes auditoria">ANEXAR INFORMES AUDITORIA</td>
                     <td class="celda_transparente"><input  tabindex='2'  type="file" maxlength="255"  class='multi'  name="adjuntos[]" accept="<?php echo $extensiones;?>"><tr>
                     <td class="encabezado" width="20%" title="Plan de Mejoramiento Institucional, Funcional o Individual">TIPO DE AUDITORIA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(379,4465,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">AUDITOR*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(379,4466,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N AUDITOR OTROS/AUTOEVALUACI&Oacute;N/RETROALIMENTACI&Oacute;N CLIENTE.</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="descripcion_otros" id="descripcion_otros" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(4467)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Realizar una breve descripci&oacute;n del alcance de la Auditor&iacute;a o l&iacute;nea de auditor&iacute;a realizada">DESCRIPCION*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="descripcion_plan" id="descripcion_plan" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4468)); ?></textarea></td>
                    </tr><input type="hidden" name="estado_plan_mejoramiento" value="<?php echo(validar_valor_campo(4469)); ?>"><tr>
                     <td class="encabezado" width="20%" title="Periodo que cubri&oacute; la auditor&iacute;a">PERIODO EVALUADO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='5'  type="text" size="100" id="periodo_evaluado" name="periodo_evaluado"  value="<?php echo(validar_valor_campo(4471)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBJETIVO GENERAL*</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="objetivo" id="objetivo" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4472)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBJETIVOS ESPECIFICOS*</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="objetivos_especificos" id="objetivos_especificos" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4473)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='8'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(4474)); ?></textarea></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">ELABORADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(379,4475,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='9'  type="text" id="stext_elaborado" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_elaborado.findItem(htmlentities(document.getElementById('stext_elaborado').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_elaborado.findItem(htmlentities(document.getElementById('stext_elaborado').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_elaborado.findItem(htmlentities(document.getElementById('stext_elaborado').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_elaborado"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_elaborado" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="elaborado" id="elaborado"   value="" ><label style="display:none" class="error" for="elaborado">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_elaborado.setOnLoadingEnd(fin_cargando_elaborado);tree_elaborado.enableSmartXMLParsing(true);tree_elaborado.loadXML("../../test.php");
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
                	--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">REVISADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(379,4476,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='10'  type="text" id="stext_revisado" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_revisado.findItem(htmlentities(document.getElementById('stext_revisado').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_revisado.findItem(htmlentities(document.getElementById('stext_revisado').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_revisado.findItem(htmlentities(document.getElementById('stext_revisado').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_revisado"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_revisado" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="revisado" id="revisado"   value="" ><label style="display:none" class="error" for="revisado">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_revisado.setOnLoadingEnd(fin_cargando_revisado);tree_revisado.enableSmartXMLParsing(true);tree_revisado.loadXML("../../test.php");
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
                	--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">APROBADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(379,4477,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='11'  type="text" id="stext_aprobado" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_aprobado.findItem(htmlentities(document.getElementById('stext_aprobado').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_aprobado.findItem(htmlentities(document.getElementById('stext_aprobado').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_aprobado.findItem(htmlentities(document.getElementById('stext_aprobado').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_aprobado"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_aprobado" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="aprobado" id="aprobado"   value="" ><label style="display:none" class="error" for="aprobado">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_aprobado.setOnLoadingEnd(fin_cargando_aprobado);tree_aprobado.enableSmartXMLParsing(true);tree_aprobado.loadXML("../../test.php");
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
                	--></script></td></tr><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4478)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4479)); ?>"><input type="hidden" name="version" value="<?php echo(validar_valor_campo(4480)); ?>"><?php seguimiento_indicador(379,NULL);?><?php ver_campo_estado(379,NULL);?><input type="hidden" name="campo_descripcion" value="4462,4468"><tr><td colspan='2'><?php submit_formato(379);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>