<html><title>.:EDITAR FUNCIONARIOS AUSENTES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><input type="hidden" name="idft_ausentes_acta" value="<?php echo(mostrar_valor_campo('idft_ausentes_acta',310,$_REQUEST['iddoc'])); ?>"><tr>
                   <td class="encabezado" width="20%" title="">FUNCIONARIO AUSENTE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(310,3651,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_funcionario_ausente" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_funcionario_ausente.findItem(htmlentities(document.getElementById('stext_funcionario_ausente').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_funcionario_ausente.findItem(htmlentities(document.getElementById('stext_funcionario_ausente').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_funcionario_ausente.findItem(htmlentities(document.getElementById('stext_funcionario_ausente').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_funcionario_ausente"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_funcionario_ausente" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="funcionario_ausente" id="funcionario_ausente"   value="<?php cargar_seleccionados(310,3651,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_funcionario_ausente=new dhtmlXTreeObject("treeboxbox_funcionario_ausente","100%","100%",0);
                			tree_funcionario_ausente.setImagePath("../../imgs/");
                			tree_funcionario_ausente.enableIEImageFix(true);tree_funcionario_ausente.enableCheckBoxes(1);
                    tree_funcionario_ausente.enableRadioButtons(true);tree_funcionario_ausente.setOnLoadingStart(cargando_funcionario_ausente);
                      tree_funcionario_ausente.setOnLoadingEnd(fin_cargando_funcionario_ausente);tree_funcionario_ausente.enableSmartXMLParsing(true);tree_funcionario_ausente.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);
                	        tree_funcionario_ausente.setOnCheckHandler(onNodeSelect_funcionario_ausente);
                      function onNodeSelect_funcionario_ausente(nodeId)
                      {valor_destino=document.getElementById("funcionario_ausente");

                       if(tree_funcionario_ausente.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_funcionario_ausente.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_funcionario_ausente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_funcionario_ausente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_funcionario_ausente")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_funcionario_ausente"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_funcionario_ausente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_funcionario_ausente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_funcionario_ausente")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_funcionario_ausente"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(310,3651,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_funcionario_ausente.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr id="tr_justificada" >
                     <td class="encabezado" width="20%" title="">AUSENCIA JUSTIFICADA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(310,3652,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="formato" value="310"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="ausentes_acta"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(310,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>