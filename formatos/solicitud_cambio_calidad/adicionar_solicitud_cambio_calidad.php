<html><title>.:ADICIONAR SOLICITUD DE ELABORACI&Atilde;&SUP3;N, MODIFICACI&Atilde;&SUP3;N, ELIMINACI&Atilde;&SUP3;N DE DOCUMENTOS DE CALIDAD:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SOLICITUD DE ELABORACI&Atilde;&SUP3;N, MODIFICACI&Atilde;&SUP3;N, ELIMINACI&Atilde;&SUP3;N DE DOCUMENTOS DE CALIDAD</td></tr><input type="hidden" name="proceso_macroproceso" value="<?php echo(validar_valor_campo(4407)); ?>"><input type="hidden" name="idft_solicitud_cambio_calidad" value="<?php echo(validar_valor_campo(4409)); ?>"><tr id="tr_tipo_solicitud" >
                     <td class="encabezado" width="20%" title="Tipo de Solicitud: Elaboraci&oacute;n, Modificaci&oacute;n,Eliminaci&oacute;n.">TIPO DE SOLICITUD</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(377,4411,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="Por Favor Seleccione el Proceso sobre el que va vinculado el cambio">PROCESO VINCULADO*</td>
                     <?php listar_procesos_macros(377,4412);?></tr><tr>
                   <td class="encabezado" width="20%" title="Documento de Calidad Vinculado">DOCUMENTO DE CALIDAD VINCULADO</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(377,4413,'3',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_documento_calidad" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_documento_calidad.findItem(htmlentities(document.getElementById('stext_documento_calidad').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem(htmlentities(document.getElementById('stext_documento_calidad').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem(htmlentities(document.getElementById('stext_documento_calidad').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_documento_calidad"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_documento_calidad" height="90%"></div><input type="hidden" maxlength="255"  name="documento_calidad" id="documento_calidad"   value="" ><label style="display:none" class="error" for="documento_calidad">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_documento_calidad=new dhtmlXTreeObject("treeboxbox_documento_calidad","100%","100%",0);
                			tree_documento_calidad.setImagePath("../../imgs/");
                			tree_documento_calidad.enableIEImageFix(true);tree_documento_calidad.enableCheckBoxes(1);
                    tree_documento_calidad.enableRadioButtons(true);tree_documento_calidad.setOnLoadingStart(cargando_documento_calidad);
                      tree_documento_calidad.setOnLoadingEnd(fin_cargando_documento_calidad);tree_documento_calidad.enableSmartXMLParsing(true);tree_documento_calidad.loadXML("../arboles/test_cambio_calidad.xml");
                	        tree_documento_calidad.setOnCheckHandler(onNodeSelect_documento_calidad);
                      function onNodeSelect_documento_calidad(nodeId)
                      {valor_destino=document.getElementById("documento_calidad");

                       if(tree_documento_calidad.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_documento_calidad.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_documento_calidad() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_documento_calidad")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_documento_calidad")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_documento_calidad"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_documento_calidad() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_documento_calidad")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_documento_calidad")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_documento_calidad"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="Versi&oacute;n que posee el documento de calidad">VERSI&Oacute;N ORGINAL</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='2'  type="text" size="100" id="version_original" name="version_original"  value="<?php echo(validar_valor_campo(4414)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Nueva Versi&oacute;n del documento">NUEVA VERSI&Oacute;N</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="nueva_version" name="nueva_version"  value="<?php echo(validar_valor_campo(4415)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Motivo de la solicitud">JUSTIFICACI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="justificacion" id="justificacion" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4416)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Sugerencia del proponente">PROPUESTA*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="propuesta" id="propuesta" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4417)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Anexos Digitales">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='6'  type="file" maxlength="255"  class='multi'  name="anexos[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4419)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4420)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4421)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(377,4422);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4423)); ?>"><input type="hidden" name="campo_descripcion" value="4411,4417"><tr><td colspan='2'><?php submit_formato(377);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body>
              <script type="text/javascript">
              setInterval("auto_save('justificacion,propuesta','solicitud_cambio_calidad')",300000);
              </script></html>