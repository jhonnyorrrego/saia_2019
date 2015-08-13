<html><title>.:ADICIONAR PLANEACI&Oacute;N DE OT:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><input type="hidden" name="idft_planea_orden_trabajo" value="<?php echo(validar_valor_campo(2994)); ?>"><tr>
                   <td class="encabezado" width="20%" title="">CONCEPTO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(263,3012,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_concepto_trabajo" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_concepto_trabajo.findItem(htmlentities(document.getElementById('stext_concepto_trabajo').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_concepto_trabajo.findItem(htmlentities(document.getElementById('stext_concepto_trabajo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_concepto_trabajo.findItem(htmlentities(document.getElementById('stext_concepto_trabajo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_concepto_trabajo"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_concepto_trabajo" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="concepto_trabajo" id="concepto_trabajo"   value="" ><label style="display:none" class="error" for="concepto_trabajo">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_concepto_trabajo=new dhtmlXTreeObject("treeboxbox_concepto_trabajo","100%","100%",0);
                			tree_concepto_trabajo.setImagePath("../../imgs/");
                			tree_concepto_trabajo.enableIEImageFix(true);tree_concepto_trabajo.enableCheckBoxes(1);
                    tree_concepto_trabajo.enableRadioButtons(true);tree_concepto_trabajo.setOnLoadingStart(cargando_concepto_trabajo);
                      tree_concepto_trabajo.setOnLoadingEnd(fin_cargando_concepto_trabajo);tree_concepto_trabajo.enableSmartXMLParsing(true);tree_concepto_trabajo.loadXML("../../test_serie.php?sin_padre=1&id=952&tabla=serie");
                	        tree_concepto_trabajo.setOnCheckHandler(onNodeSelect_concepto_trabajo);
                      function onNodeSelect_concepto_trabajo(nodeId)
                      {valor_destino=document.getElementById("concepto_trabajo");

                       if(tree_concepto_trabajo.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_concepto_trabajo.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_concepto_trabajo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_concepto_trabajo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_concepto_trabajo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_concepto_trabajo"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_concepto_trabajo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_concepto_trabajo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_concepto_trabajo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_concepto_trabajo"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion_orden" id="descripcion_orden" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(2992)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CANTIDAD*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="11"  class="required digits"   tabindex='3'  type="text" size="100" id="cantidad_solicitada" name="cantidad_solicitada"  value="<?php echo(validar_valor_campo(2993)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">COSTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="15"  class="required"   tabindex='4'  type="text" size="100" id="costo_trabajo" name="costo_trabajo"  value="<?php echo(validar_valor_campo(3011)); ?>"></td>
                    </tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_orden_trabajo_vehiculo"  value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden"  name="idpadre"  value="<?php echo $_REQUEST["idpadre"]; ?>"><?php } ?><tr><td class="encabezado">ACCION A SEGUIR LUEGO DE GUARDAR</td><td ><input type="radio" name="opcion_item" value="adicionar">Adicionar otro&nbsp;&nbsp;<input type="radio" name="opcion_item" value="terminar">Terminar</td></tr><?php separar_miles_costo_trabajo(263,NULL);?><input type="hidden" name="campo_descripcion" value="2992"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="planea_orden_trabajo"><input type="hidden" name="accion" value="guardar_item" ><tr><td colspan='2'><?php submit_formato(263);?></td></tr></table></form></body></html>