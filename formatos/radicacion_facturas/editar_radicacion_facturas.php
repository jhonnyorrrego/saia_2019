<html><title>.:EDITAR RADICACI&Oacute;N DE FACTURAS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">RADICACI&Oacute;N DE FACTURAS</td></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',302,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(302,3534,$_REQUEST['iddoc']);?></tr><tr id="tr_tipo_documento" >
                     <td class="encabezado" width="20%" title="">TIPO DOCUMENTO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(302,3530,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ORDEN DE COMPRA*</td>
                     <?php listar_ordenes_compra(302,3524,$_REQUEST['iddoc']);?></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA EXPEDICI&Oacute;N*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_expedicion" id="fecha_expedicion" tipo="fecha" value="<?php mostrar_valor_campo('fecha_expedicion',302,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_expedicion","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                       <td class="encabezado" width="20%" title="">FECHA VENCIMIENTO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='2'  type="text" readonly="true"  class="required dateISO"  name="fecha_vencimiento" id="fecha_vencimiento" tipo="fecha" value="<?php mostrar_valor_campo('fecha_vencimiento',302,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_vencimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO FACTURA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='3'  type="text" size="100" id="numero_factura" name="numero_factura"  value="<?php echo(mostrar_valor_campo('numero_factura',302,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">PROVEEDOR*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden"  class="required"  name="proveedor" id="proveedor" value="<?php echo(mostrar_valor_campo('proveedor',302,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("3528",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">DETALLE DE FACTURA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='4'  type="text" size="100" id="detalle_factura" name="detalle_factura"  value="<?php echo(mostrar_valor_campo('detalle_factura',302,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">VALOR FACTURA*</td>
                     <td bgcolor="#F5F5F5"><input   class="required"   tabindex='5'  type="text" size="100" id="valor_factura" name="valor_factura"  value="<?php echo(mostrar_valor_campo('valor_factura',302,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">RESPONSABLE ORDEN DE PAGO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(302,3529,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='6'  type="text" id="stext_responsable_op" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_responsable_op"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_responsable_op" height="90%"></div><input type="hidden"  class="required"  name="responsable_op" id="responsable_op"   value="<?php cargar_seleccionados(302,3529,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable_op=new dhtmlXTreeObject("treeboxbox_responsable_op","100%","100%",0);
                			tree_responsable_op.setImagePath("../../imgs/");
                			tree_responsable_op.enableIEImageFix(true);tree_responsable_op.enableCheckBoxes(1);
                    tree_responsable_op.enableRadioButtons(true);tree_responsable_op.setOnLoadingStart(cargando_responsable_op);
                      tree_responsable_op.setOnLoadingEnd(fin_cargando_responsable_op);tree_responsable_op.enableSmartXMLParsing(true);tree_responsable_op.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);
                	        tree_responsable_op.setOnCheckHandler(onNodeSelect_responsable_op);
                      function onNodeSelect_responsable_op(nodeId)
                      {valor_destino=document.getElementById("responsable_op");

                       if(tree_responsable_op.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_responsable_op.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_responsable_op() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_op")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_op")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable_op"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_responsable_op() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_op")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_op")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable_op"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(302,3529,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_responsable_op.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(mostrar_valor_campo('observaciones',302,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">GU&Iacute;A</td>
                     <td bgcolor="#F5F5F5"><input    tabindex='8'  type="text" size="100" id="guia" name="guia"  value="<?php echo(mostrar_valor_campo('guia',302,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">EMPRESA GUIA</td>
                     <td bgcolor="#F5F5F5"><input    tabindex='9'  type="text" size="100" id="empresa_guia" name="empresa_guia"  value="<?php echo(mostrar_valor_campo('empresa_guia',302,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ADJUNTAR</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=302&idcampo=3518" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><input type="hidden" name="idft_radicacion_facturas" value="<?php echo(mostrar_valor_campo('idft_radicacion_facturas',302,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',302,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',302,$_REQUEST['iddoc'])); ?>"><?php digitalizar_formato(302,NULL,$_REQUEST['iddoc']);?><?php codigo_organizacion(302,NULL,$_REQUEST['iddoc']);?><?php validar_fechas(302,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('3526'); ?>"><input type="hidden" name="formato" value="302"><tr><td colspan='2'><?php submit_formato(302,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>