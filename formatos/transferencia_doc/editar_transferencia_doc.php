<html><title>.:EDITAR TRANSFERENCIA DOCUMENTAL:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">TRANSFERENCIA DOCUMENTAL</td></tr><input type="hidden" name="idft_transferencia_doc" value="<?php echo(mostrar_valor_campo('idft_transferencia_doc',343,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',343,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',343,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',343,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(343,3992,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">EXPEDIENTE VINCULADO*</td>
                     <?php guardar_expedientes_add(343,3995,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="">UNIDAD ADMINISTRATIVA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="unidad_admin" name="unidad_admin"  value="<?php echo(mostrar_valor_campo('unidad_admin',343,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OFICINA PRODUCTORA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="oficina_productora" name="oficina_productora"  value="<?php echo(mostrar_valor_campo('oficina_productora',343,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones',343,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=343&idcampo=3999" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><tr>
                   <td class="encabezado" width="20%" title="">ENTREGADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(343,4000,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='5'  type="text" id="stext_entregado_por" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_entregado_por.findItem(htmlentities(document.getElementById('stext_entregado_por').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_entregado_por.findItem(htmlentities(document.getElementById('stext_entregado_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_entregado_por.findItem(htmlentities(document.getElementById('stext_entregado_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_entregado_por"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_entregado_por" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="entregado_por" id="entregado_por"   value="<?php cargar_seleccionados(343,4000,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_entregado_por=new dhtmlXTreeObject("treeboxbox_entregado_por","100%","100%",0);
                			tree_entregado_por.setImagePath("../../imgs/");
                			tree_entregado_por.enableIEImageFix(true);tree_entregado_por.enableCheckBoxes(1);
                    tree_entregado_por.enableRadioButtons(true);tree_entregado_por.setOnLoadingStart(cargando_entregado_por);
                      tree_entregado_por.setOnLoadingEnd(fin_cargando_entregado_por);tree_entregado_por.enableSmartXMLParsing(true);tree_entregado_por.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);
                	        tree_entregado_por.setOnCheckHandler(onNodeSelect_entregado_por);
                      function onNodeSelect_entregado_por(nodeId)
                      {valor_destino=document.getElementById("entregado_por");

                       if(tree_entregado_por.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_entregado_por.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_entregado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_entregado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_entregado_por")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_entregado_por"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_entregado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_entregado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_entregado_por")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_entregado_por"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(343,4000,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_entregado_por.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">RECIBIDO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(343,4001,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='6'  type="text" id="stext_recibido_por" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_recibido_por.findItem(htmlentities(document.getElementById('stext_recibido_por').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_recibido_por.findItem(htmlentities(document.getElementById('stext_recibido_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_recibido_por.findItem(htmlentities(document.getElementById('stext_recibido_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_recibido_por"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_recibido_por" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="recibido_por" id="recibido_por"   value="<?php cargar_seleccionados(343,4001,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_recibido_por=new dhtmlXTreeObject("treeboxbox_recibido_por","100%","100%",0);
                			tree_recibido_por.setImagePath("../../imgs/");
                			tree_recibido_por.enableIEImageFix(true);tree_recibido_por.enableCheckBoxes(1);
                    tree_recibido_por.enableRadioButtons(true);tree_recibido_por.setOnLoadingStart(cargando_recibido_por);
                      tree_recibido_por.setOnLoadingEnd(fin_cargando_recibido_por);tree_recibido_por.enableSmartXMLParsing(true);tree_recibido_por.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);
                	        tree_recibido_por.setOnCheckHandler(onNodeSelect_recibido_por);
                      function onNodeSelect_recibido_por(nodeId)
                      {valor_destino=document.getElementById("recibido_por");

                       if(tree_recibido_por.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_recibido_por.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_recibido_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_recibido_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_recibido_por")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_recibido_por"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_recibido_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_recibido_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_recibido_por")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_recibido_por"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(343,4001,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_recibido_por.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">TRANSFERIR A*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(343,4002,$_REQUEST['iddoc']);?></td></tr><?php validacion_js_transferencia(343,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('3997'); ?>"><input type="hidden" name="formato" value="343"><tr><td colspan='2'><?php submit_formato(343,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>