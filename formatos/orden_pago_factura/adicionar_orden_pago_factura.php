<html><title>.:ADICIONAR ORDEN DE PAGO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">ORDEN DE PAGO</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3549)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(303,3548);?></tr><tr>
                   <td class="encabezado" width="20%" title="">TIPO GASTO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(303,3543,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_tipo_gasto" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_tipo_gasto.findItem(htmlentities(document.getElementById('stext_tipo_gasto').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_tipo_gasto.findItem(htmlentities(document.getElementById('stext_tipo_gasto').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_tipo_gasto.findItem(htmlentities(document.getElementById('stext_tipo_gasto').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_tipo_gasto"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_tipo_gasto" height="90%"></div><input type="hidden"  class="required"  name="tipo_gasto" id="tipo_gasto"   value="" ><label style="display:none" class="error" for="tipo_gasto">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_tipo_gasto=new dhtmlXTreeObject("treeboxbox_tipo_gasto","100%","100%",0);
                			tree_tipo_gasto.setImagePath("../../imgs/");
                			tree_tipo_gasto.enableIEImageFix(true);tree_tipo_gasto.enableCheckBoxes(1);
                    tree_tipo_gasto.enableRadioButtons(true);tree_tipo_gasto.setOnLoadingStart(cargando_tipo_gasto);
                      tree_tipo_gasto.setOnLoadingEnd(fin_cargando_tipo_gasto);tree_tipo_gasto.enableSmartXMLParsing(true);tree_tipo_gasto.loadXML("../../test_serie.php?tabla=serie&id=1029&sin_padre=1");
                	        tree_tipo_gasto.setOnCheckHandler(onNodeSelect_tipo_gasto);
                      function onNodeSelect_tipo_gasto(nodeId)
                      {valor_destino=document.getElementById("tipo_gasto");

                       if(tree_tipo_gasto.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_tipo_gasto.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_tipo_gasto() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_gasto")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_gasto")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_tipo_gasto"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_tipo_gasto() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_gasto")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_gasto")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_tipo_gasto"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">CALIFICACON SERVICIO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(303,3539,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">URGENCIA PAGO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(303,3544,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(3542)); ?></textarea></td>
                    </tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_radicacion_facturas"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_radicacion_facturas"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_radicacion_facturas);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3538)); ?>"><input type="hidden" name="usuario_causo" value="<?php echo(validar_valor_campo(3545)); ?>"><input type="hidden" name="fecha_causacion" value="<?php echo(validar_valor_campo(3541)); ?>"><input type="hidden" name="causacion" value="<?php echo(validar_valor_campo(3540)); ?>"><input type="hidden" name="idft_orden_pago_factura" value="<?php echo(validar_valor_campo(3546)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3547)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3550)); ?>"><input type="hidden" name="campo_descripcion" value="3539"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(303);?></td></tr></table></form></body></html>