<html><title>.:ADICIONAR RADICACION FACTURAS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">RADICACION FACTURAS</td></tr><input type="hidden" name="factura_correcta" value="<?php echo(validar_valor_campo(5073)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(236,2650);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2651)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2629)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">C&Oacute;DIGO DE LA COMPA&Ntilde;IA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="cia" name="cia"  value="<?php echo(validar_valor_campo(2630)); ?>"></td>
                    </tr><tr id="tr_tipo_doc" >
                     <td class="encabezado" width="20%" title="">TIPO DOCUMENTO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(236,2631,$_REQUEST['iddoc']);?></td></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE EXPEDICION*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='2'  type="text" readonly="true"  class="required dateISO"  name="fecha_exp" id="fecha_exp" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_exp","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE VENCIMIENTO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='3'  type="text" readonly="true"  class="required dateISO"  name="fecha_venc" id="fecha_venc" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_venc","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FACTURA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="num_factura" name="num_factura"  value="<?php echo(validar_valor_campo(2634)); ?>"></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">PROVEEDOR*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="prooveedor" id="prooveedor" value=""><?php componente_ejecutor("2635",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">TIPO MONEDA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(236,2636,$_REQUEST['iddoc']);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">ENVIAR A*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(236,5068,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='5'  type="text" id="stext_enviar" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_enviar.findItem(htmlentities(document.getElementById('stext_enviar').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_enviar.findItem(htmlentities(document.getElementById('stext_enviar').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_enviar.findItem(htmlentities(document.getElementById('stext_enviar').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_enviar"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_enviar" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="enviar" id="enviar"   value="" ><label style="display:none" class="error" for="enviar">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_enviar=new dhtmlXTreeObject("treeboxbox_enviar","100%","100%",0);
                			tree_enviar.setImagePath("../../imgs/");
                			tree_enviar.enableIEImageFix(true);tree_enviar.enableCheckBoxes(1);
                    tree_enviar.enableRadioButtons(true);tree_enviar.setOnLoadingStart(cargando_enviar);
                      tree_enviar.setOnLoadingEnd(fin_cargando_enviar);tree_enviar.enableSmartXMLParsing(true);tree_enviar.loadXML("../../test.php?rol=1&iddependencia=51");
                	        tree_enviar.setOnCheckHandler(onNodeSelect_enviar);
                      function onNodeSelect_enviar(nodeId)
                      {valor_destino=document.getElementById("enviar");

                       if(tree_enviar.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_enviar.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_enviar() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_enviar")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_enviar")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_enviar"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_enviar() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_enviar")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_enviar")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_enviar"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE LA GUIA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='6'  type="text" readonly="true"  class="required dateISO"  name="fecha_factura" id="fecha_factura" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_factura","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(2639)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CAJA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="20"  class="required"   tabindex='8'  type="text" size="100" id="caja" name="caja"  value="<?php echo(validar_valor_campo(2640)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">UNIDAD DOCUMENTAL*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="20"  class="required"   tabindex='9'  type="text" size="100" id="unidad_documenta" name="unidad_documenta"  value="<?php echo(validar_valor_campo(2641)); ?>"></td>
                    </tr><tr id="tr_requiere_irecibo" >
                     <td class="encabezado" width="20%" title="">REQUIERE IR?</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(236,2642,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">GUIA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='10'  type="text" size="100" id="numero_guia" name="numero_guia"  value="<?php echo(validar_valor_campo(2643)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">EMPRESA GUIA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='11'  type="text" size="100" id="empresa_guia" name="empresa_guia"  value="<?php echo(validar_valor_campo(2644)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ORDEN COMPRA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="10"   tabindex='12'  type="text" size="100" id="orden_compra" name="orden_compra"  value="<?php echo(validar_valor_campo(2646)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ARCHIVO UBICACI&Oacute;N CAJA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="20"  class="required"   tabindex='13'  type="text" size="100" id="archivo_ubicacion" name="archivo_ubicacion"  value="<?php echo(validar_valor_campo(2647)); ?>"></td>
                    </tr><input type="hidden" name="idft_factura_proveedor" value="<?php echo(validar_valor_campo(2648)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">VALOR DE LA FACTURA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='14'  type="text" size="100" id="valor_factura" name="valor_factura"  value="<?php echo(validar_valor_campo(2685)); ?>"></td>
                    </tr><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2649)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2652)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='15'  type="file" maxlength="255"  class='multi'  name="anexo_formato[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(5066)); ?>"><?php digitalizar_formato(236,NULL);?><?php formatear_valor_numero(236,NULL);?><input type="hidden" name="campo_descripcion" value="2634,2635,2636,2638,2640,2641,2644,2646"><tr><td colspan='2'><?php submit_formato(236);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>