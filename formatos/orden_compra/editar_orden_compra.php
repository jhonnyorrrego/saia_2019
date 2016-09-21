<html><title>.:EDITAR ORDEN DE COMPRA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">ORDEN DE COMPRA</td></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',301,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(301,3514,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA*</td>
                     <?php fecha_formato(301,3508,$_REQUEST['iddoc']);?></tr><tr>
                   <td class="encabezado" width="20%" title="">ORIGEN DE RECURSOS</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(301,3511,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_origen_recursos" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_origen_recursos.findItem(htmlentities(document.getElementById('stext_origen_recursos').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_origen_recursos.findItem(htmlentities(document.getElementById('stext_origen_recursos').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_origen_recursos.findItem(htmlentities(document.getElementById('stext_origen_recursos').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_origen_recursos"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_origen_recursos" height="90%"></div><input type="hidden" maxlength="255"  name="origen_recursos" id="origen_recursos"   value="<?php cargar_seleccionados(301,3511,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_origen_recursos=new dhtmlXTreeObject("treeboxbox_origen_recursos","100%","100%",0);
                			tree_origen_recursos.setImagePath("../../imgs/");
                			tree_origen_recursos.enableIEImageFix(true);tree_origen_recursos.enableCheckBoxes(1);
                    tree_origen_recursos.enableRadioButtons(true);tree_origen_recursos.setOnLoadingStart(cargando_origen_recursos);
                      tree_origen_recursos.setOnLoadingEnd(fin_cargando_origen_recursos);tree_origen_recursos.enableSmartXMLParsing(true);tree_origen_recursos.loadXML("../../test_serie.php?tabla=serie&id=1021",checkear_arbol);
                	        tree_origen_recursos.setOnCheckHandler(onNodeSelect_origen_recursos);
                      function onNodeSelect_origen_recursos(nodeId)
                      {valor_destino=document.getElementById("origen_recursos");

                       if(tree_origen_recursos.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_origen_recursos.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_origen_recursos() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_origen_recursos")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_origen_recursos")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_origen_recursos"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_origen_recursos() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_origen_recursos")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_origen_recursos")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_origen_recursos"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(301,3511,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_origen_recursos.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">LUGAR DE ENTREGA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="lugar_entrega" name="lugar_entrega"  value="<?php echo(mostrar_valor_campo('lugar_entrega',301,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE ENTREGA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='3'  type="text" readonly="true"  class="required dateISO"  name="fecha_entrega" id="fecha_entrega" tipo="fecha" value="<?php mostrar_valor_campo('fecha_entrega',301,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_entrega","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES DE ENTREGA</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones',301,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><input type="hidden" name="idft_orden_compra" value="<?php echo(mostrar_valor_campo('idft_orden_compra',301,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',301,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',301,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('3508,3509'); ?>"><input type="hidden" name="formato" value="301"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(301,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>