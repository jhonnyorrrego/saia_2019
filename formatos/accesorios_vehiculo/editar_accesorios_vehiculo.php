<html><title>.:EDITAR ACCESORIOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_item.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><input type="hidden" name="idft_accesorios_vehiculo" value="<?php echo(mostrar_valor_campo('idft_accesorios_vehiculo',259,$_REQUEST['iddoc'])); ?>"><tr>
                   <td class="encabezado" width="20%" title="">ACCESORIOS*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(259,2946,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_accesorio_vehiculo" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_accesorio_vehiculo.findItem(htmlentities(document.getElementById('stext_accesorio_vehiculo').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_accesorio_vehiculo.findItem(htmlentities(document.getElementById('stext_accesorio_vehiculo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_accesorio_vehiculo.findItem(htmlentities(document.getElementById('stext_accesorio_vehiculo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_accesorio_vehiculo"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_accesorio_vehiculo" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="accesorio_vehiculo" id="accesorio_vehiculo"   value="<?php cargar_seleccionados(259,2946,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_accesorio_vehiculo=new dhtmlXTreeObject("treeboxbox_accesorio_vehiculo","100%","100%",0);
                			tree_accesorio_vehiculo.setImagePath("../../imgs/");
                			tree_accesorio_vehiculo.enableIEImageFix(true);tree_accesorio_vehiculo.enableCheckBoxes(1);
                    tree_accesorio_vehiculo.enableRadioButtons(true);tree_accesorio_vehiculo.setOnLoadingStart(cargando_accesorio_vehiculo);
                      tree_accesorio_vehiculo.setOnLoadingEnd(fin_cargando_accesorio_vehiculo);tree_accesorio_vehiculo.enableSmartXMLParsing(true);tree_accesorio_vehiculo.loadXML("../../test_serie.php?sin_padre=1&id=942&tabla=serie",checkear_arbol);
                	        tree_accesorio_vehiculo.setOnCheckHandler(onNodeSelect_accesorio_vehiculo);
                      function onNodeSelect_accesorio_vehiculo(nodeId)
                      {valor_destino=document.getElementById("accesorio_vehiculo");

                       if(tree_accesorio_vehiculo.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_accesorio_vehiculo.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_accesorio_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_accesorio_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_accesorio_vehiculo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_accesorio_vehiculo"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_accesorio_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_accesorio_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_accesorio_vehiculo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_accesorio_vehiculo"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(259,2946,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_accesorio_vehiculo.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">VALOR DEL ACCESORIO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="15"  class="required"   tabindex='2'  type="text" size="100" id="valor_accesorio" name="valor_accesorio"  value="<?php echo(mostrar_valor_campo('valor_accesorio',259,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><?php separar_miles_valor_accesorio(259,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('2946'); ?>"><input type="hidden" name="formato" value="259"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="accesorios_vehiculo"><input type="hidden" name="accion" value="editar" ><input type="hidden" name="item" value="<?php echo $_REQUEST["item"]; ?>" ><input type="hidden" name="anterior" value="<?php echo $_REQUEST["campo"]; ?>" ><tr><td colspan='2'><?php submit_formato(259,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>