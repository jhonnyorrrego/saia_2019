<html><title>.:ADICIONAR ACTIVOS FIJOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">ACTIVOS FIJOS</td></tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE ACTIVO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="nombre_activo" name="nombre_activo"  value="<?php echo(validar_valor_campo(2687)); ?>"></td>
                    </tr><input type="hidden" name="idft_activo_fijo" value="<?php echo(validar_valor_campo(2574)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2575)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(231,2576);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2577)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2578)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2554)); ?>"><tr>
                   <td class="encabezado" width="20%" title="">RESPONSABLE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(231,2555,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_nombre" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_nombre.findItem(htmlentities(document.getElementById('stext_nombre').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre.findItem(htmlentities(document.getElementById('stext_nombre').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_nombre.findItem(htmlentities(document.getElementById('stext_nombre').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_nombre"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_nombre" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="nombre" id="nombre"   value="" ><label style="display:none" class="error" for="nombre">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre=new dhtmlXTreeObject("treeboxbox_nombre","100%","100%",0);
                			tree_nombre.setImagePath("../../imgs/");
                			tree_nombre.enableIEImageFix(true);tree_nombre.enableCheckBoxes(1);
                    tree_nombre.enableRadioButtons(true);tree_nombre.setOnLoadingStart(cargando_nombre);
                      tree_nombre.setOnLoadingEnd(fin_cargando_nombre);tree_nombre.enableSmartXMLParsing(true);tree_nombre.loadXML("../../test.php?rol=1&iddependencia=51");
                	        tree_nombre.setOnCheckHandler(onNodeSelect_nombre);
                      function onNodeSelect_nombre(nodeId)
                      {valor_destino=document.getElementById("nombre");

                       if(tree_nombre.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_nombre.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_nombre() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_nombre() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">C&Oacute;DIGO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="codigo" name="codigo"  value="<?php echo(validar_valor_campo(2556)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CONSIDERACIONES*</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="consideraciones" id="consideraciones" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(2558)); ?></textarea></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA ACTIVACI&Oacute;N</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='5'  type="text" readonly="true"  name="fecha" id="fecha" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">UBICACI&Oacute;N</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(231,2573,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ESTADO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(231,2560,$_REQUEST['iddoc']);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">PROVEEDOR</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="255"  name="proveedor" id="proveedor" value=""><?php componente_ejecutor("2561",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE COMPRA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='6'  type="text" readonly="true"  class="required dateISO"  name="fecha_compra" id="fecha_compra" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_compra","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">VALOR DE LA COMPRA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='7'  type="text" size="100" id="valor_compra" name="valor_compra"  value="<?php echo(validar_valor_campo(2563)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">PROPIETARIO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='8'  type="text" size="100" id="propietario" name="propietario"  value="<?php echo(validar_valor_campo(2564)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">VALOR DEL SEGURO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='9'  type="text" size="100" id="valor_seguro" name="valor_seguro"  value="<?php echo(validar_valor_campo(2565)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">SEGURO 1</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(231,2566,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">SEGURO 2</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(231,2567,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">SEGURO 3</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(231,2568,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">FOTO ACTIVO</td>
                     <td class="celda_transparente"><input  tabindex='10'  type="file" maxlength="255"  class='multi'  name="foto[]" accept="<?php echo $extensiones;?>"><tr>
                     <td class="encabezado" width="20%" title="" colspan="2"><CENTER>INFORMACI&Oacute;N DE VENTA</CENTER></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">COMPRADOR</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='11'  type="text" size="100" id="comprador" name="comprador"  value="<?php echo(validar_valor_campo(2591)); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE LA VENTA</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='12'  type="text" readonly="true"  name="fecha_venta" id="fecha_venta" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_venta","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">VALOR DE LA VENTA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='13'  type="text" size="100" id="valor_venta" name="valor_venta"  value="<?php echo(validar_valor_campo(2571)); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">MANTENIMIENTO</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='14'  type="text" readonly="true"  name="fecha_mantenimiento" id="fecha_mantenimiento" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_mantenimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><?php formatear_numeros(231,NULL);?><input type="hidden" name="campo_descripcion" value="2555,2564"><tr><td colspan='2'><?php submit_formato(231);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>