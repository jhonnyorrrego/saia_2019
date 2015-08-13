<html><title>.:ADICIONAR SOLICITUD DE MANTENIMIENTO LOCATIVO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLICITUD DE MANTENIMIENTO LOCATIVO</td></tr><input type="hidden" name="idft_mantenimiento_locativo" value="<?php echo(validar_valor_campo(3316)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3317)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(287,3318);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3319)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3320)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">FECHA DE ELABORACI&Oacute;N*</td>
                     <?php fecha_formato(287,3303);?></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DETALLADA DEL REQUERIMIENTO*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="describe_requerimiento" id="describe_requerimiento" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(3304)); ?></textarea></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA ESPERADA DE SOLUCI&Oacute;N</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='2'  type="text" readonly="true"  name="fecha_solucion" id="fecha_solucion" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_solucion","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">PRIORIDAD</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(287,3306,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">SOPORTES ANEXOS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(287,3307,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='3'  type="file" maxlength="255"  class='multi'  name="anexos_digitales[]" accept="<?php echo $extensiones;?>"><tr>
                   <td class="encabezado" width="20%" title="">JEFE DEL &Aacute;REA*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(287,3310,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='4'  type="text" id="stext_jefe_area" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_jefe_area.findItem(htmlentities(document.getElementById('stext_jefe_area').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_jefe_area.findItem(htmlentities(document.getElementById('stext_jefe_area').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_jefe_area.findItem(htmlentities(document.getElementById('stext_jefe_area').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_jefe_area"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_jefe_area" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="jefe_area" id="jefe_area"   value="" ><label style="display:none" class="error" for="jefe_area">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_jefe_area=new dhtmlXTreeObject("treeboxbox_jefe_area","100%","100%",0);
                			tree_jefe_area.setImagePath("../../imgs/");
                			tree_jefe_area.enableIEImageFix(true);tree_jefe_area.enableCheckBoxes(1);
                    tree_jefe_area.enableRadioButtons(true);tree_jefe_area.setOnLoadingStart(cargando_jefe_area);
                      tree_jefe_area.setOnLoadingEnd(fin_cargando_jefe_area);tree_jefe_area.enableSmartXMLParsing(true);tree_jefe_area.loadXML("../../test.php?rol=1&sin_padre=1");
                	        tree_jefe_area.setOnCheckHandler(onNodeSelect_jefe_area);
                      function onNodeSelect_jefe_area(nodeId)
                      {valor_destino=document.getElementById("jefe_area");

                       if(tree_jefe_area.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_jefe_area.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_jefe_area() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_jefe_area")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_jefe_area")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_jefe_area"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_jefe_area() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_jefe_area")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_jefe_area")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_jefe_area"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">APROBACI&Oacute;N LOG&Iacute;STICA*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(287,3311,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='5'  type="text" id="stext_aprovacion_logistica" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_aprovacion_logistica.findItem(htmlentities(document.getElementById('stext_aprovacion_logistica').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_aprovacion_logistica.findItem(htmlentities(document.getElementById('stext_aprovacion_logistica').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_aprovacion_logistica.findItem(htmlentities(document.getElementById('stext_aprovacion_logistica').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_aprovacion_logistica"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_aprovacion_logistica" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="aprovacion_logistica" id="aprovacion_logistica"   value="" ><label style="display:none" class="error" for="aprovacion_logistica">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_aprovacion_logistica=new dhtmlXTreeObject("treeboxbox_aprovacion_logistica","100%","100%",0);
                			tree_aprovacion_logistica.setImagePath("../../imgs/");
                			tree_aprovacion_logistica.enableIEImageFix(true);tree_aprovacion_logistica.enableCheckBoxes(1);
                    tree_aprovacion_logistica.enableRadioButtons(true);tree_aprovacion_logistica.setOnLoadingStart(cargando_aprovacion_logistica);
                      tree_aprovacion_logistica.setOnLoadingEnd(fin_cargando_aprovacion_logistica);tree_aprovacion_logistica.enableSmartXMLParsing(true);tree_aprovacion_logistica.loadXML("../../test.php?rol=1&sin_padre=1");
                	        tree_aprovacion_logistica.setOnCheckHandler(onNodeSelect_aprovacion_logistica);
                      function onNodeSelect_aprovacion_logistica(nodeId)
                      {valor_destino=document.getElementById("aprovacion_logistica");

                       if(tree_aprovacion_logistica.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_aprovacion_logistica.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_aprovacion_logistica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprovacion_logistica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprovacion_logistica")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_aprovacion_logistica"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_aprovacion_logistica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprovacion_logistica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprovacion_logistica")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_aprovacion_logistica"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">USUARIO QUE SOLICITA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='6'  type="text" size="100" id="usuario_que_solita" name="usuario_que_solita"  value="<?php echo(validar_valor_campo(3312)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">&Aacute;REA DEL ELABORADOR DEL FORMATO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='7'  type="text" size="100" id="area" name="area"  value="<?php echo(validar_valor_campo(3313)); ?>"></td>
                    </tr><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3302)); ?>"><?php carga_nombre_solicita(287,NULL);?><?php muestra_campo_anexos(287,NULL);?><input type="hidden" name="campo_descripcion" value="3312"><tr><td colspan='2'><?php submit_formato(287);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>