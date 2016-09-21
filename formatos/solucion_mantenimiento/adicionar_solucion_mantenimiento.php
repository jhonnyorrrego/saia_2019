<html><title>.:ADICIONAR SOLUCI&Oacute;N MANTENIMIENTO LOCATIVO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLUCI&Oacute;N MANTENIMIENTO LOCATIVO</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3337)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(288,3336);?></tr><tr>
                  <td class="encabezado" width="20%" title="">TIPO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(288,3325,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE DE RESPONSABLE</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="nombre_responsable" name="nombre_responsable"  value="<?php echo(validar_valor_campo(3326)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">BREVE DESCRIPCI&Oacute;N SOLUCI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion_solucion" id="descripcion_solucion" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(3327)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">PRE-REQUISITOS DE MONTAJE</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="prerequisitos_montaje" id="prerequisitos_montaje" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(3328)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(3329)); ?></textarea></td>
                    </tr><tr id="tr_anexos_solucion" >
                     <td class="encabezado" width="20%" title="">ANEXOS SOLUCI&Oacute;N</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(288,3330,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='5'  type="file"  class='multi'  name="solucion_digital[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="idft_solucion_mantenimiento" value="<?php echo(validar_valor_campo(3334)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3335)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3338)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_mantenimiento_locativo"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_mantenimiento_locativo"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_mantenimiento_locativo);} ?><tr>
                   <td class="encabezado" width="20%" title="">IMPLEMENTADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(288,3332,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='6'  type="text" id="stext_implementado_por" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_implementado_por.findItem(htmlentities(document.getElementById('stext_implementado_por').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_implementado_por.findItem(htmlentities(document.getElementById('stext_implementado_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_implementado_por.findItem(htmlentities(document.getElementById('stext_implementado_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_implementado_por"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_implementado_por" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="implementado_por" id="implementado_por"   value="" ><label style="display:none" class="error" for="implementado_por">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_implementado_por=new dhtmlXTreeObject("treeboxbox_implementado_por","100%","100%",0);
                			tree_implementado_por.setImagePath("../../imgs/");
                			tree_implementado_por.enableIEImageFix(true);tree_implementado_por.enableCheckBoxes(1);
                    tree_implementado_por.enableRadioButtons(true);tree_implementado_por.setOnLoadingStart(cargando_implementado_por);
                      tree_implementado_por.setOnLoadingEnd(fin_cargando_implementado_por);tree_implementado_por.enableSmartXMLParsing(true);tree_implementado_por.loadXML("../../test.php?rol=1");
                	        tree_implementado_por.setOnCheckHandler(onNodeSelect_implementado_por);
                      function onNodeSelect_implementado_por(nodeId)
                      {valor_destino=document.getElementById("implementado_por");

                       if(tree_implementado_por.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_implementado_por.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_implementado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_implementado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_implementado_por")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_implementado_por"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_implementado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_implementado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_implementado_por")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_implementado_por"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">APROBACI&Oacute;N LOG&Iacute;STICA*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(288,3333,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='7'  type="text" id="stext_aprobacion_logistica" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_aprobacion_logistica.findItem(htmlentities(document.getElementById('stext_aprobacion_logistica').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_aprobacion_logistica.findItem(htmlentities(document.getElementById('stext_aprobacion_logistica').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_aprobacion_logistica.findItem(htmlentities(document.getElementById('stext_aprobacion_logistica').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_aprobacion_logistica"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_aprobacion_logistica" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="aprobacion_logistica" id="aprobacion_logistica"   value="" ><label style="display:none" class="error" for="aprobacion_logistica">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_aprobacion_logistica=new dhtmlXTreeObject("treeboxbox_aprobacion_logistica","100%","100%",0);
                			tree_aprobacion_logistica.setImagePath("../../imgs/");
                			tree_aprobacion_logistica.enableIEImageFix(true);tree_aprobacion_logistica.enableCheckBoxes(1);
                    tree_aprobacion_logistica.enableRadioButtons(true);tree_aprobacion_logistica.setOnLoadingStart(cargando_aprobacion_logistica);
                      tree_aprobacion_logistica.setOnLoadingEnd(fin_cargando_aprobacion_logistica);tree_aprobacion_logistica.enableSmartXMLParsing(true);tree_aprobacion_logistica.loadXML("../../test.php?rol=1");
                	        tree_aprobacion_logistica.setOnCheckHandler(onNodeSelect_aprobacion_logistica);
                      function onNodeSelect_aprobacion_logistica(nodeId)
                      {valor_destino=document.getElementById("aprobacion_logistica");

                       if(tree_aprobacion_logistica.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_aprobacion_logistica.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_aprobacion_logistica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobacion_logistica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobacion_logistica")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_aprobacion_logistica"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_aprobacion_logistica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobacion_logistica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobacion_logistica")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_aprobacion_logistica"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3324)); ?>"><?php muestra_campo_anexos(288,NULL);?><?php carga_nombre_responsable(288,NULL);?><input type="hidden" name="campo_descripcion" value="3325,3332,3334"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(288);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>