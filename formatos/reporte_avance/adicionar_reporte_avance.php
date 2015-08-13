<html><title>.:ADICIONAR AVANCES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">AVANCES</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2550)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(230,2549);?></tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_solicitud_soporte"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_solicitud_soporte"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_solicitud_soporte);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2540)); ?>"><tr>
                   <td class="encabezado" width="20%" title="">CATEGORIA*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(230,2541,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_categoria" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_categoria.findItem(htmlentities(document.getElementById('stext_categoria').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_categoria.findItem(htmlentities(document.getElementById('stext_categoria').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_categoria.findItem(htmlentities(document.getElementById('stext_categoria').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_categoria"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_categoria" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="categoria" id="categoria"   value="" ><label style="display:none" class="error" for="categoria">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_categoria=new dhtmlXTreeObject("treeboxbox_categoria","100%","100%",0);
                			tree_categoria.setImagePath("../../imgs/");
                			tree_categoria.enableIEImageFix(true);tree_categoria.enableCheckBoxes(1);
                    tree_categoria.enableRadioButtons(true);tree_categoria.setOnLoadingStart(cargando_categoria);
                      tree_categoria.setOnLoadingEnd(fin_cargando_categoria);tree_categoria.enableSmartXMLParsing(true);tree_categoria.loadXML("../../test_serie_funcionario.php?categoria=3&id=884");
                	        tree_categoria.setOnCheckHandler(onNodeSelect_categoria);
                      function onNodeSelect_categoria(nodeId)
                      {valor_destino=document.getElementById("categoria");

                       if(tree_categoria.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_categoria.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_categoria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_categoria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_categoria")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_categoria"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_categoria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_categoria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_categoria")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_categoria"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ESTADO ACTUAL*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(230,2542,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DIAGNOSTICO*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(2543)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">INSUMOS</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="insumos" id="insumos" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(2544)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="observaciones" id="observaciones" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(2545)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS</td>
                     <td class="celda_transparente"><input  tabindex='5'  type="file" maxlength="255"  class='multi'  name="anexos[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="idft_reporte_avance" value="<?php echo(validar_valor_campo(2547)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2548)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2551)); ?>"><input type="hidden" name="campo_descripcion" value="2543"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(230);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>