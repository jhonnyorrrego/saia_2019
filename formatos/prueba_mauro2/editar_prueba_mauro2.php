<html><title>.:EDITAR MAURO HIJO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">MAURO HIJO</td></tr><tr>
                   <td class="encabezado" width="20%" title="">USUARIOS*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(418,5172,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_usuarios" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_usuarios.findItem(htmlentities(document.getElementById('stext_usuarios').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_usuarios.findItem(htmlentities(document.getElementById('stext_usuarios').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_usuarios.findItem(htmlentities(document.getElementById('stext_usuarios').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_usuarios"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_usuarios" height="90%"></div><input type="hidden" maxlength="11"  class="required"  name="usuarios" id="usuarios"   value="<?php cargar_seleccionados(418,5172,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_usuarios=new dhtmlXTreeObject("treeboxbox_usuarios","100%","100%",0);
                			tree_usuarios.setImagePath("../../imgs/");
                			tree_usuarios.enableIEImageFix(true);tree_usuarios.enableCheckBoxes(1);
                    tree_usuarios.enableRadioButtons(true);tree_usuarios.setOnLoadingStart(cargando_usuarios);
                      tree_usuarios.setOnLoadingEnd(fin_cargando_usuarios);tree_usuarios.enableSmartXMLParsing(true);tree_usuarios.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);
                	        tree_usuarios.setOnCheckHandler(onNodeSelect_usuarios);
                      function onNodeSelect_usuarios(nodeId)
                      {valor_destino=document.getElementById("usuarios");

                       if(tree_usuarios.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_usuarios.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_usuarios() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_usuarios")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_usuarios")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_usuarios"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_usuarios() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_usuarios")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_usuarios")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_usuarios"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(418,5172,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_usuarios.setCheck(vector2[m],true);
                    }}
--></script></td></tr><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',418,$_REQUEST['iddoc'])); ?>"><tr id="tr_texto">
                     <td class="encabezado" width="20%" title="">TEXTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="texto" name="texto"  value="<?php echo(mostrar_valor_campo('texto',418,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',418,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(418,5168,$_REQUEST['iddoc']);?></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',418,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="idft_prueba_mauro2" value="<?php echo(mostrar_valor_campo('idft_prueba_mauro2',418,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('5171'); ?>"><input type="hidden" name="formato" value="418"><tr><td colspan='2'><?php submit_formato(418,$_REQUEST['iddoc']);?></td></tr></table></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>