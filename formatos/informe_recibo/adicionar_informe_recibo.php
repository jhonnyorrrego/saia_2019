<html><title>.:ADICIONAR INFORME DE RECIBO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">INFORME DE RECIBO</td></tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_factura_proveedor"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_factura_proveedor"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_factura_proveedor);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2654)); ?>"><input type="hidden" name="idft_informe_recibo" value="<?php echo(validar_valor_campo(2655)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2656)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(237,2657);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2658)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2659)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">BIEN  O SERVICIO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(237,2660,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">CANTIDAD*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='1'  type="text" size="100" id="cantidad" name="cantidad"  value="<?php echo(validar_valor_campo(2661)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRPCI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(2662)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CALIFICACI&Oacute;N  DEL SERVICIO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(237,2663,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE LA EXTE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="numer_ext" name="numer_ext"  value="<?php echo(validar_valor_campo(2665)); ?>"></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">OTRO AUTORIZADOR DEL IR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(237,2666,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='4'  type="text" id="stext_otro_responsable" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_otro_responsable.findItem(htmlentities(document.getElementById('stext_otro_responsable').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_otro_responsable.findItem(htmlentities(document.getElementById('stext_otro_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_otro_responsable.findItem(htmlentities(document.getElementById('stext_otro_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_otro_responsable"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_otro_responsable" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="otro_responsable" id="otro_responsable"   value="" ><label style="display:none" class="error" for="otro_responsable">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_otro_responsable=new dhtmlXTreeObject("treeboxbox_otro_responsable","100%","100%",0);
                			tree_otro_responsable.setImagePath("../../imgs/");
                			tree_otro_responsable.enableIEImageFix(true);tree_otro_responsable.enableCheckBoxes(1);
                    tree_otro_responsable.enableRadioButtons(true);tree_otro_responsable.setOnLoadingStart(cargando_otro_responsable);
                      tree_otro_responsable.setOnLoadingEnd(fin_cargando_otro_responsable);tree_otro_responsable.enableSmartXMLParsing(true);tree_otro_responsable.loadXML("../../test.php?rol=1&sin_padre=44");
                	        tree_otro_responsable.setOnCheckHandler(onNodeSelect_otro_responsable);
                      function onNodeSelect_otro_responsable(nodeId)
                      {valor_destino=document.getElementById("otro_responsable");

                       if(tree_otro_responsable.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_otro_responsable.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_otro_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_otro_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_otro_responsable")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_otro_responsable"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_otro_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_otro_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_otro_responsable")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_otro_responsable"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">REQUERIE OP*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(237,2667,$_REQUEST['iddoc']);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">RESPONSABLE OP*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(237,2668,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='5'  type="text" id="stext_responsable_op" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_responsable_op"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_responsable_op" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="responsable_op" id="responsable_op"   value="" ><label style="display:none" class="error" for="responsable_op">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable_op=new dhtmlXTreeObject("treeboxbox_responsable_op","100%","100%",0);
                			tree_responsable_op.setImagePath("../../imgs/");
                			tree_responsable_op.enableIEImageFix(true);tree_responsable_op.enableCheckBoxes(1);
                    tree_responsable_op.enableRadioButtons(true);tree_responsable_op.setOnLoadingStart(cargando_responsable_op);
                      tree_responsable_op.setOnLoadingEnd(fin_cargando_responsable_op);tree_responsable_op.enableSmartXMLParsing(true);tree_responsable_op.loadXML("../../test.php?rol=1&sin_padre=44");
                	        tree_responsable_op.setOnCheckHandler(onNodeSelect_responsable_op);
                      function onNodeSelect_responsable_op(nodeId)
                      {valor_destino=document.getElementById("responsable_op");

                       if(tree_responsable_op.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_responsable_op.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_responsable_op() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_op")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_op")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable_op"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_responsable_op() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_op")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_op")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable_op"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACONES*</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(2669)); ?></textarea></td>
                    </tr><input type="hidden" name="campo_descripcion" value="2669"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(237);?></td></tr></table></form></body></html>