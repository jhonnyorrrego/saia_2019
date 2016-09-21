<html><title>.:ADICIONAR DATOS DEL VEH&Iacute;CULO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">DATOS DEL VEH&Iacute;CULO</td></tr><input type="hidden" name="idft_datos_vehiculo" value="<?php echo(validar_valor_campo(2939)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2940)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(258,2941);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2942)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2943)); ?>"><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(5094)); ?>"><tr>
                   <td class="encabezado" width="20%" title="">VEH&Iacute;CULO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(258,2932,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_nombre_vehiculo" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_nombre_vehiculo.findItem(htmlentities(document.getElementById('stext_nombre_vehiculo').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre_vehiculo.findItem(htmlentities(document.getElementById('stext_nombre_vehiculo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_nombre_vehiculo.findItem(htmlentities(document.getElementById('stext_nombre_vehiculo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_nombre_vehiculo"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_nombre_vehiculo" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="nombre_vehiculo" id="nombre_vehiculo"   value="" ><label style="display:none" class="error" for="nombre_vehiculo">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre_vehiculo=new dhtmlXTreeObject("treeboxbox_nombre_vehiculo","100%","100%",0);
                			tree_nombre_vehiculo.setImagePath("../../imgs/");
                			tree_nombre_vehiculo.enableIEImageFix(true);tree_nombre_vehiculo.enableCheckBoxes(1);
                    tree_nombre_vehiculo.enableRadioButtons(true);tree_nombre_vehiculo.setOnLoadingStart(cargando_nombre_vehiculo);
                      tree_nombre_vehiculo.setOnLoadingEnd(fin_cargando_nombre_vehiculo);tree_nombre_vehiculo.enableSmartXMLParsing(true);tree_nombre_vehiculo.loadXML("../../test_serie.php?sin_padre=1&id=940&tabla=serie");
                	        tree_nombre_vehiculo.setOnCheckHandler(onNodeSelect_nombre_vehiculo);
                      function onNodeSelect_nombre_vehiculo(nodeId)
                      {valor_destino=document.getElementById("nombre_vehiculo");

                       if(tree_nombre_vehiculo.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_nombre_vehiculo.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_nombre_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_vehiculo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre_vehiculo"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_nombre_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_vehiculo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre_vehiculo"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">MODELO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(258,2933,$_REQUEST['iddoc']);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">COLOR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(258,2934,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_color_vehiculo" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_color_vehiculo.findItem(htmlentities(document.getElementById('stext_color_vehiculo').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_color_vehiculo.findItem(htmlentities(document.getElementById('stext_color_vehiculo').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_color_vehiculo.findItem(htmlentities(document.getElementById('stext_color_vehiculo').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_color_vehiculo"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_color_vehiculo" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="color_vehiculo" id="color_vehiculo"   value="" ><label style="display:none" class="error" for="color_vehiculo">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_color_vehiculo=new dhtmlXTreeObject("treeboxbox_color_vehiculo","100%","100%",0);
                			tree_color_vehiculo.setImagePath("../../imgs/");
                			tree_color_vehiculo.enableIEImageFix(true);tree_color_vehiculo.enableCheckBoxes(1);
                    tree_color_vehiculo.enableRadioButtons(true);tree_color_vehiculo.setOnLoadingStart(cargando_color_vehiculo);
                      tree_color_vehiculo.setOnLoadingEnd(fin_cargando_color_vehiculo);tree_color_vehiculo.enableSmartXMLParsing(true);tree_color_vehiculo.loadXML("../../test_serie.php?sin_padre=1&id=937&tabla=serie");
                	        tree_color_vehiculo.setOnCheckHandler(onNodeSelect_color_vehiculo);
                      function onNodeSelect_color_vehiculo(nodeId)
                      {valor_destino=document.getElementById("color_vehiculo");

                       if(tree_color_vehiculo.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_color_vehiculo.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_color_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_color_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_color_vehiculo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_color_vehiculo"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_color_vehiculo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_color_vehiculo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_color_vehiculo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_color_vehiculo"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">MOTOR*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="motor_vehiculo" name="motor_vehiculo"  value="<?php echo(validar_valor_campo(2938)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">SERIE / CHAS&Iacute;S*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="serie_chasis_vehiculo" name="serie_chasis_vehiculo"  value="<?php echo(validar_valor_campo(2935)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">VALOR DEL VEH&Iacute;CULO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="15"  class="required"   tabindex='5'  type="text" size="100" id="valor_vehiculo" name="valor_vehiculo"  value="<?php echo(validar_valor_campo(2936)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">IMAGEN DEL VEH&Iacute;CULO</td>
                     <td class="celda_transparente"><input  tabindex='6'  type="file" maxlength="255"  class='multi'  name="imagen_vehiculo[]" accept="jpg|png"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2931)); ?>"><?php separar_miles_valor_vehiculo(258,NULL);?><input type="hidden" name="campo_descripcion" value="2932"><tr><td colspan='2'><?php submit_formato(258);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>