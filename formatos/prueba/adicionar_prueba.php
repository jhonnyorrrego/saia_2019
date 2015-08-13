<html><title>.:ADICIONAR PRUEBA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">PRUEBA</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2780)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(244,2779);?></tr><tr>
                   <td class="encabezado" width="20%" title="">ROLES*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(244,3819,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_roles" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_roles.findItem(htmlentities(document.getElementById('stext_roles').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_roles.findItem(htmlentities(document.getElementById('stext_roles').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_roles.findItem(htmlentities(document.getElementById('stext_roles').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_roles"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_roles" height="90%"></div><input type="hidden" maxlength="11"  class="required"  name="roles" id="roles"   value="" ><label style="display:none" class="error" for="roles">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_roles=new dhtmlXTreeObject("treeboxbox_roles","100%","100%",0);
                			tree_roles.setImagePath("../../imgs/");
                			tree_roles.enableIEImageFix(true);tree_roles.enableCheckBoxes(1);
                			tree_roles.enableThreeStateCheckboxes(1);tree_roles.setOnLoadingStart(cargando_roles);
                      tree_roles.setOnLoadingEnd(fin_cargando_roles);tree_roles.enableSmartXMLParsing(true);tree_roles.loadXML("../../test.php?rol=1");
                	        
                      tree_roles.setOnCheckHandler(onNodeSelect_roles);
                      function onNodeSelect_roles(nodeId)
                      {valor_destino=document.getElementById("roles");
                       destinos=tree_roles.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_roles.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               
                               for(h=0;h<vectorh.length;h++)
                                  {if(vectorh[h].indexOf("_")!=-1)
                                      vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
                                   nuevo=eliminarItem(nuevo,vectorh[h]);
                                  } 
                              }
                          }
                       nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");   
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_roles() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_roles")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_roles")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_roles"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_roles() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_roles")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_roles")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_roles"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr id="tr_sexo_funcionario" >
                     <td class="encabezado" width="20%" title="">SEXO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(244,3820,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2775)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2781)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2778)); ?>"><input type="hidden" name="idft_prueba" value="<?php echo(validar_valor_campo(2777)); ?>"><tr><td colspan='2'><?php submit_formato(244);?></td></tr></table></form></body></html>