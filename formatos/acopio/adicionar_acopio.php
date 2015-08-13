<html><title>.:ADICIONAR 3. ACOPIO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">3. ACOPIO</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(322,3769);?></tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_readh"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_readh"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_readh);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3765)); ?>"><tr>
                   <td class="encabezado" width="20%" title="">TIPO DE ACOPIO</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(322,3766,'3',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_tipo_acopio" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_tipo_acopio.findItem(htmlentities(document.getElementById('stext_tipo_acopio').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_tipo_acopio.findItem(htmlentities(document.getElementById('stext_tipo_acopio').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_tipo_acopio.findItem(htmlentities(document.getElementById('stext_tipo_acopio').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_tipo_acopio"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_tipo_acopio" height="90%"></div><input type="hidden" maxlength="11"  name="tipo_acopio" id="tipo_acopio"   value="" ><label style="display:none" class="error" for="tipo_acopio">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_tipo_acopio=new dhtmlXTreeObject("treeboxbox_tipo_acopio","100%","100%",0);
                			tree_tipo_acopio.setImagePath("../../imgs/");
                			tree_tipo_acopio.enableIEImageFix(true);tree_tipo_acopio.enableCheckBoxes(1);
                    tree_tipo_acopio.enableRadioButtons(true);tree_tipo_acopio.setOnLoadingStart(cargando_tipo_acopio);
                      tree_tipo_acopio.setOnLoadingEnd(fin_cargando_tipo_acopio);tree_tipo_acopio.enableSmartXMLParsing(true);tree_tipo_acopio.loadXML("../../test_serie.php?tabla=serie&id=1083");
                	        tree_tipo_acopio.setOnCheckHandler(onNodeSelect_tipo_acopio);
                      function onNodeSelect_tipo_acopio(nodeId)
                      {valor_destino=document.getElementById("tipo_acopio");

                       if(tree_tipo_acopio.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_tipo_acopio.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_tipo_acopio() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_acopio")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_acopio")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_tipo_acopio"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_tipo_acopio() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_acopio")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_acopio")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_tipo_acopio"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><input type="hidden" name="idft_acopio" value="<?php echo(validar_valor_campo(3767)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3768)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3770)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3771)); ?>"><tr id="tr_estado_acopio" >
                     <td class="encabezado" width="20%" title="">ESTADO DE ACOPIO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(322,3772,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="campo_descripcion" value="3772"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(322);?></td></tr></table></form></body></html>