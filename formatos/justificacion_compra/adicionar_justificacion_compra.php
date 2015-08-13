<html><title>.:ADICIONAR JUSTIFICACI&Oacute;N DE COMPRA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">JUSTIFICACI&Oacute;N DE COMPRA</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3465)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(296,3464);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_formato(296,3458);?></tr><tr>
                   <td class="encabezado" width="20%" title="">NOMBRE DEL SOLICITANTE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(296,3461,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_nombre_solicitante" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_nombre_solicitante.findItem(htmlentities(document.getElementById('stext_nombre_solicitante').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre_solicitante.findItem(htmlentities(document.getElementById('stext_nombre_solicitante').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_nombre_solicitante.findItem(htmlentities(document.getElementById('stext_nombre_solicitante').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_nombre_solicitante"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_nombre_solicitante" height="90%"></div><input type="hidden"  class="required"  name="nombre_solicitante" id="nombre_solicitante"   value="" ><label style="display:none" class="error" for="nombre_solicitante">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre_solicitante=new dhtmlXTreeObject("treeboxbox_nombre_solicitante","100%","100%",0);
                			tree_nombre_solicitante.setImagePath("../../imgs/");
                			tree_nombre_solicitante.enableIEImageFix(true);tree_nombre_solicitante.enableCheckBoxes(1);
                    tree_nombre_solicitante.enableRadioButtons(true);tree_nombre_solicitante.setOnLoadingStart(cargando_nombre_solicitante);
                      tree_nombre_solicitante.setOnLoadingEnd(fin_cargando_nombre_solicitante);tree_nombre_solicitante.enableSmartXMLParsing(true);tree_nombre_solicitante.loadXML("../../test.php?rol=1&sin_padre=1");
                	        tree_nombre_solicitante.setOnCheckHandler(onNodeSelect_nombre_solicitante);
                      function onNodeSelect_nombre_solicitante(nodeId)
                      {valor_destino=document.getElementById("nombre_solicitante");

                       if(tree_nombre_solicitante.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_nombre_solicitante.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_nombre_solicitante() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_solicitante")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_solicitante")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre_solicitante"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_nombre_solicitante() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_solicitante")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_solicitante")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre_solicitante"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion_justificacion" id="descripcion_justificacion" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(3457)); ?></textarea></td>
                    </tr><input type="hidden" name="idft_justificacion_compra" value="<?php echo(validar_valor_campo(3462)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">JUSTIFICACI&Oacute;N DE COMPRA*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="justificacion_compra" id="justificacion_compra" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(3459)); ?></textarea></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">PRIMERA APROBACION*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(296,3460,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='4'  type="text" id="stext_primera_aprobacion" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_primera_aprobacion.findItem(htmlentities(document.getElementById('stext_primera_aprobacion').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_primera_aprobacion.findItem(htmlentities(document.getElementById('stext_primera_aprobacion').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_primera_aprobacion.findItem(htmlentities(document.getElementById('stext_primera_aprobacion').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_primera_aprobacion"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_primera_aprobacion" height="90%"></div><input type="hidden"  class="required"  name="primera_aprobacion" id="primera_aprobacion"   value="" ><label style="display:none" class="error" for="primera_aprobacion">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_primera_aprobacion=new dhtmlXTreeObject("treeboxbox_primera_aprobacion","100%","100%",0);
                			tree_primera_aprobacion.setImagePath("../../imgs/");
                			tree_primera_aprobacion.enableIEImageFix(true);tree_primera_aprobacion.enableCheckBoxes(1);
                    tree_primera_aprobacion.enableRadioButtons(true);tree_primera_aprobacion.setOnLoadingStart(cargando_primera_aprobacion);
                      tree_primera_aprobacion.setOnLoadingEnd(fin_cargando_primera_aprobacion);tree_primera_aprobacion.enableSmartXMLParsing(true);tree_primera_aprobacion.loadXML("../../test.php?rol=1&sin_padre=1");
                	        tree_primera_aprobacion.setOnCheckHandler(onNodeSelect_primera_aprobacion);
                      function onNodeSelect_primera_aprobacion(nodeId)
                      {valor_destino=document.getElementById("primera_aprobacion");

                       if(tree_primera_aprobacion.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_primera_aprobacion.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_primera_aprobacion() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_primera_aprobacion")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_primera_aprobacion")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_primera_aprobacion"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_primera_aprobacion() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_primera_aprobacion")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_primera_aprobacion")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_primera_aprobacion"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3463)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3466)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3456)); ?>"><input type="hidden" name="campo_descripcion" value="3459,3461"><tr><td colspan='2'><?php submit_formato(296);?></td></tr></table></form></body></html>