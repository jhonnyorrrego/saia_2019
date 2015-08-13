<html><title>.:ADICIONAR 5. MAPA DE PROCESOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">5. MAPA DE PROCESOS</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(194,2012);?></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha" id="fecha" tipo="fecha" value="<?php echo(date("Y-m-d")); ?>"><?php selector_fecha("fecha","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><input type="hidden" name="coordenadas" value="<?php echo(validar_valor_campo(2015)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(validar_valor_campo(2006)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">C&Oacute;DIGO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="codigo" name="codigo"  value="<?php echo(validar_valor_campo(2003)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">VERSI&Oacute;N*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required"   tabindex='4'  type="text" size="100" id="version" name="version"  value="<?php echo(validar_valor_campo(2007)); ?>"></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">L&Iacute;DER DEL PROCESO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(194,2000,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='5'  type="text" id="stext_lider_proceso" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_lider_proceso.findItem(htmlentities(document.getElementById('stext_lider_proceso').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_lider_proceso.findItem(htmlentities(document.getElementById('stext_lider_proceso').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_lider_proceso.findItem(htmlentities(document.getElementById('stext_lider_proceso').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_lider_proceso"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_lider_proceso" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="lider_proceso" id="lider_proceso"   value="" ><label style="display:none" class="error" for="lider_proceso">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_lider_proceso=new dhtmlXTreeObject("treeboxbox_lider_proceso","100%","100%",0);
                			tree_lider_proceso.setImagePath("../../imgs/");
                			tree_lider_proceso.enableIEImageFix(true);tree_lider_proceso.enableCheckBoxes(1);
                    tree_lider_proceso.enableRadioButtons(true);tree_lider_proceso.setOnLoadingStart(cargando_lider_proceso);
                      tree_lider_proceso.setOnLoadingEnd(fin_cargando_lider_proceso);tree_lider_proceso.enableSmartXMLParsing(true);tree_lider_proceso.loadXML("../../test.php?rol=1&sin_padre=1");
                	        tree_lider_proceso.setOnCheckHandler(onNodeSelect_lider_proceso);
                      function onNodeSelect_lider_proceso(nodeId)
                      {valor_destino=document.getElementById("lider_proceso");

                       if(tree_lider_proceso.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_lider_proceso.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_lider_proceso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_lider_proceso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_lider_proceso")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_lider_proceso"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_lider_proceso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_lider_proceso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_lider_proceso")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_lider_proceso"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">RESPONSABLE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(194,2607,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='6'  type="text" id="stext_responsable" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_responsable"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_responsable" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="responsable" id="responsable"   value="" ><label style="display:none" class="error" for="responsable">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable=new dhtmlXTreeObject("treeboxbox_responsable","100%","100%",0);
                			tree_responsable.setImagePath("../../imgs/");
                			tree_responsable.enableIEImageFix(true);tree_responsable.enableCheckBoxes(1);
                    tree_responsable.enableRadioButtons(true);tree_responsable.setOnLoadingStart(cargando_responsable);
                      tree_responsable.setOnLoadingEnd(fin_cargando_responsable);tree_responsable.enableSmartXMLParsing(true);tree_responsable.loadXML("../../test.php?rol=1&sin_padre=1");
                	        tree_responsable.setOnCheckHandler(onNodeSelect_responsable);
                      function onNodeSelect_responsable(nodeId)
                      {valor_destino=document.getElementById("responsable");

                       if(tree_responsable.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_responsable.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
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
                        document.poppedLayer.style.display = "none";
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
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OBJETIVO*</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="objetivo" id="objetivo" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(2008)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='8'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(2004)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">POLITICA DE OPERACION</td>
                     <td class="celda_transparente"><textarea  tabindex='9'  name="politica_operacion" id="politica_operacion" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(2009)); ?></textarea></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">APROBADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(194,2608,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='10'  type="text" id="stext_aprobado" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_aprobado.findItem(htmlentities(document.getElementById('stext_aprobado').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
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
                      tree_aprobado.setOnLoadingEnd(fin_cargando_aprobado);tree_aprobado.enableSmartXMLParsing(true);tree_aprobado.loadXML("../../test.php?rol=1&sin_padre=1");
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
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">MACROPROCESOS*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(194,2609,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(194,2001,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS</td>
                     <td class="celda_transparente"><input  tabindex='11'  type="file" maxlength="255"  class='multi'  name="anexos[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(1999)); ?>"><input type="hidden" name="idft_proceso" value="<?php echo(validar_valor_campo(2010)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2011)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2013)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2014)); ?>"><input type="hidden" name="campo_descripcion" value="2006,2607,2608"><tr><td colspan='2'><?php submit_formato(194);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>