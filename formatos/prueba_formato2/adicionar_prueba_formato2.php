<html><title>.:ADICIONAR PRUEBA FORMATO 2:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">PRUEBA FORMATO 2</td></tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_prueba_formato"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_prueba_formato"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_prueba_formato);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3847)); ?>"><tr id="tr_radio" >
                     <td class="encabezado" width="20%" title="">RADIO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(329,3848,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">LISTA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(329,3849,$_REQUEST['iddoc']);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">REMITENTE*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="remitente" id="remitente" value=""><?php componente_ejecutor("3850",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                   <td class="encabezado" width="20%" title="">ARBOL*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(329,3857,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_arbol" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_arbol.findItem(htmlentities(document.getElementById('stext_arbol').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_arbol.findItem(htmlentities(document.getElementById('stext_arbol').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_arbol.findItem(htmlentities(document.getElementById('stext_arbol').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_arbol"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_arbol" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="arbol" id="arbol"   value="" ><label style="display:none" class="error" for="arbol">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_arbol=new dhtmlXTreeObject("treeboxbox_arbol","100%","100%",0);
                			tree_arbol.setImagePath("../../imgs/");
                			tree_arbol.enableIEImageFix(true);tree_arbol.enableCheckBoxes(1);
                    tree_arbol.enableRadioButtons(true);tree_arbol.setOnLoadingStart(cargando_arbol);
                      tree_arbol.setOnLoadingEnd(fin_cargando_arbol);tree_arbol.enableSmartXMLParsing(true);tree_arbol.loadXML("../../test.php?rol=1");
                	        tree_arbol.setOnCheckHandler(onNodeSelect_arbol);
                      function onNodeSelect_arbol(nodeId)
                      {valor_destino=document.getElementById("arbol");

                       if(tree_arbol.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_arbol.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_arbol() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_arbol")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_arbol")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_arbol"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_arbol() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_arbol")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_arbol")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_arbol"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><input type="hidden" name="idft_prueba_formato2" value="<?php echo(validar_valor_campo(3852)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3853)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(329,3854);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3855)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3856)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ANEXO*</td>
                     <td class="celda_transparente"><input  tabindex='2'  type="file" maxlength="255"  class="required multi"  name="anexo[]" accept="<?php echo $extensiones;?>"><tr><td colspan='2'><?php submit_formato(329);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>