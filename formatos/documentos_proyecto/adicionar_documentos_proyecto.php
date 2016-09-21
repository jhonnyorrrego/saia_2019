<html><title>.:ADICIONAR 4. DOCUMENTOS DEL PROYECTO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">4. DOCUMENTOS DEL PROYECTO</td></tr><input type="hidden" name="idft_documentos_proyecto" value="<?php echo(validar_valor_campo(2915)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2916)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(254,2917);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2918)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2919)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_proyecto_registro_cliente"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_proyecto_registro_cliente"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_proyecto_registro_cliente);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2911)); ?>"><tr>
                       <td class="encabezado" width="20%" title="">FECHA DEL DOCUMENTO</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  name="fecha_documento" id="fecha_documento" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_documento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                   <td class="encabezado" width="20%" title="">TIPO DE DOCUMENTO</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(254,2913,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_tipo_documento" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_tipo_documento.findItem(htmlentities(document.getElementById('stext_tipo_documento').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_tipo_documento.findItem(htmlentities(document.getElementById('stext_tipo_documento').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_tipo_documento.findItem(htmlentities(document.getElementById('stext_tipo_documento').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_tipo_documento"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_tipo_documento" height="90%"></div><input type="hidden" maxlength="11"  name="tipo_documento" id="tipo_documento"   value="" ><label style="display:none" class="error" for="tipo_documento">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_tipo_documento=new dhtmlXTreeObject("treeboxbox_tipo_documento","100%","100%",0);
                			tree_tipo_documento.setImagePath("../../imgs/");
                			tree_tipo_documento.enableIEImageFix(true);tree_tipo_documento.enableCheckBoxes(1);
                    tree_tipo_documento.enableRadioButtons(true);tree_tipo_documento.setOnLoadingStart(cargando_tipo_documento);
                      tree_tipo_documento.setOnLoadingEnd(fin_cargando_tipo_documento);tree_tipo_documento.enableSmartXMLParsing(true);tree_tipo_documento.loadXML("../../test_serie.php?sin_padre=1&id=929&tabla=serie");
                	        tree_tipo_documento.setOnCheckHandler(onNodeSelect_tipo_documento);
                      function onNodeSelect_tipo_documento(nodeId)
                      {valor_destino=document.getElementById("tipo_documento");

                       if(tree_tipo_documento.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_tipo_documento.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_tipo_documento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_documento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_documento")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_tipo_documento"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_tipo_documento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_documento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_documento")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_tipo_documento"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(2914)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='4'  type="file" maxlength="255"  class='multi'  name="anexo_formato[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="campo_descripcion" value="2912"><tr><td colspan='2'><?php submit_formato(254);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>