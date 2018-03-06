<html><title>.:EDITAR ADICIONAR INDUCCI&Oacute;N:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><input type="hidden" name="firma_induccion" value="<?php echo(mostrar_valor_campo('firma_induccion',447,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_adicionar_inducc" value="<?php echo(mostrar_valor_campo('idft_adicionar_inducc',447,$_REQUEST['iddoc'])); ?>"><tr id="tr_fecha_horario">
                    <td class="encabezado" width="20%" title="">FECHA Y HORARIOS*</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='1'  type="text" readonly="true" name="fecha_horario"  class="required dateISO"  id="fecha_horario" value="<?php mostrar_valor_campo('fecha_horario',447,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_horario","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td><tr id="tr_area_responsa">
                   <td class="encabezado" width="20%" title="">&Aacute;REA Y RESPONSABLE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(447,5559,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_area_responsa" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_area_responsa.findItem((document.getElementById('stext_area_responsa').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_area_responsa.findItem((document.getElementById('stext_area_responsa').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_area_responsa.findItem((document.getElementById('stext_area_responsa').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_area_responsa"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_area_responsa" height="90%"></div><input type="hidden" maxlength="11"  class="required"  name="area_responsa" id="area_responsa"   value="<?php cargar_seleccionados(447,5559,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_area_responsa=new dhtmlXTreeObject("treeboxbox_area_responsa","100%","100%",0);
                			tree_area_responsa.setImagePath("../../imgs/");
                			tree_area_responsa.enableIEImageFix(true);tree_area_responsa.enableCheckBoxes(1);
                    tree_area_responsa.enableRadioButtons(true);tree_area_responsa.setOnLoadingStart(cargando_area_responsa);
                      tree_area_responsa.setOnLoadingEnd(fin_cargando_area_responsa);tree_area_responsa.enableSmartXMLParsing(true);tree_area_responsa.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);
                	        tree_area_responsa.setOnCheckHandler(onNodeSelect_area_responsa);
                      function onNodeSelect_area_responsa(nodeId)
                      {valor_destino=document.getElementById("area_responsa");

                       if(tree_area_responsa.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_area_responsa.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_area_responsa() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsa")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsa")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_area_responsa"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_area_responsa() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsa")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsa")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_area_responsa"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(447,5559,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_area_responsa.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr id="tr_contenido">
                     <td class="encabezado" width="20%" title="">ESPECIFICACI&Oacute;N TEMA/DOCUMENTACI&Oacute;N REVISADA*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="contenido" id="contenido" cols="53" rows="3" class="tiny_avanzado required"><?php echo(mostrar_valor_campo('contenido',447,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><?php editar_item_induccion(447,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('5559'); ?>"><input type="hidden" name="formato" value="447"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="adicionar_inducc"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(447,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>