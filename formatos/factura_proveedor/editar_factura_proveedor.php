<html><title>.:EDITAR RADICACION FACTURAS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">RADICACION FACTURAS</td></tr><input type="hidden" name="factura_correcta" value="<?php echo(mostrar_valor_campo('factura_correcta',236,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(236,2650,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',236,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">C&Oacute;DIGO DE LA COMPA&Ntilde;IA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="cia" name="cia"  value="<?php echo(mostrar_valor_campo('cia',236,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_tipo_doc" >
                     <td class="encabezado" width="20%" title="">TIPO DOCUMENTO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(236,2631,$_REQUEST['iddoc']);?></td></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE EXPEDICION*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='2'  type="text" readonly="true"  class="required dateISO"  name="fecha_exp" id="fecha_exp" tipo="fecha" value="<?php mostrar_valor_campo('fecha_exp',236,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_exp","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE VENCIMIENTO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='3'  type="text" readonly="true"  class="required dateISO"  name="fecha_venc" id="fecha_venc" tipo="fecha" value="<?php mostrar_valor_campo('fecha_venc',236,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_venc","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FACTURA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="num_factura" name="num_factura"  value="<?php echo(mostrar_valor_campo('num_factura',236,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">PROVEEDOR*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  class="required"  name="prooveedor" id="prooveedor" value="<?php echo(mostrar_valor_campo('prooveedor',236,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("2635",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">TIPO MONEDA*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(236,2636,$_REQUEST['iddoc']);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">ENVIAR A*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(236,5068,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='5'  type="text" id="stext_enviar" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_enviar.findItem(htmlentities(document.getElementById('stext_enviar').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_enviar.findItem(htmlentities(document.getElementById('stext_enviar').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_enviar.findItem(htmlentities(document.getElementById('stext_enviar').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_enviar"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_enviar" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="enviar" id="enviar"   value="<?php cargar_seleccionados(236,5068,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
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
                      tree_enviar.setOnLoadingEnd(fin_cargando_enviar);tree_enviar.enableSmartXMLParsing(true);tree_enviar.loadXML("../../test.php?rol=1&iddependencia=51",checkear_arbol);
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
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(236,5068,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_enviar.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE LA GUIA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='6'  type="text" readonly="true"  class="required dateISO"  name="fecha_factura" id="fecha_factura" tipo="fecha" value="<?php mostrar_valor_campo('fecha_factura',236,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_factura","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones',236,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CAJA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="20"  class="required"   tabindex='8'  type="text" size="100" id="caja" name="caja"  value="<?php echo(mostrar_valor_campo('caja',236,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">UNIDAD DOCUMENTAL*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="20"  class="required"   tabindex='9'  type="text" size="100" id="unidad_documenta" name="unidad_documenta"  value="<?php echo(mostrar_valor_campo('unidad_documenta',236,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_requiere_irecibo" >
                     <td class="encabezado" width="20%" title="">REQUIERE IR?</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(236,2642,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">GUIA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='10'  type="text" size="100" id="numero_guia" name="numero_guia"  value="<?php echo(mostrar_valor_campo('numero_guia',236,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">EMPRESA GUIA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='11'  type="text" size="100" id="empresa_guia" name="empresa_guia"  value="<?php echo(mostrar_valor_campo('empresa_guia',236,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ORDEN COMPRA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="10"   tabindex='12'  type="text" size="100" id="orden_compra" name="orden_compra"  value="<?php echo(mostrar_valor_campo('orden_compra',236,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ARCHIVO UBICACI&Oacute;N CAJA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="20"  class="required"   tabindex='13'  type="text" size="100" id="archivo_ubicacion" name="archivo_ubicacion"  value="<?php echo(mostrar_valor_campo('archivo_ubicacion',236,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><input type="hidden" name="idft_factura_proveedor" value="<?php echo(mostrar_valor_campo('idft_factura_proveedor',236,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">VALOR DE LA FACTURA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='14'  type="text" size="100" id="valor_factura" name="valor_factura"  value="<?php echo(mostrar_valor_campo('valor_factura',236,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',236,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',236,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=236&idcampo=2628" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',236,$_REQUEST['iddoc'])); ?>"><?php digitalizar_formato(236,NULL,$_REQUEST['iddoc']);?><?php formatear_valor_numero(236,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('2634,2635,2636,2638,2640,2641,2644,2646'); ?>"><input type="hidden" name="formato" value="236"><tr><td colspan='2'><?php submit_formato(236,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>