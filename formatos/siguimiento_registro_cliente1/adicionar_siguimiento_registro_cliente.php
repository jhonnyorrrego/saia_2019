<html><title>.:ADICIONAR SEGUIMIENTO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">SEGUIMIENTO</td></tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_registro_cliente"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_registro_cliente"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_registro_cliente);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2805)); ?>"><tr>
                       <td class="encabezado" width="20%" title="">FECHA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha" id="fecha" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">FORMA DE CONTACTO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(246,2807,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">RESULTADO DEL SEGUIMIENTO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="resultado_seguimiento" name="resultado_seguimiento"  value="<?php echo(validar_valor_campo(2808)); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">PR&Oacute;XIMA FECHA DE SEGUIMIENTO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='3'  type="text" readonly="true"  class="required dateISO"  name="fecha_seguimiento" id="fecha_seguimiento" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_seguimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">ESTADO DEL CLIENTE</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(246,2810,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">SE ENVI&Oacute; PROPUESTA</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(246,2811,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE DE LA PROPUESTA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="nombre_propuesta" name="nombre_propuesta"  value="<?php echo(validar_valor_campo(2812)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE DEL PRODUCTO O SERVICIO*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='5'  type="text" size="100" id="nombre_producto_servicio" name="nombre_producto_servicio"  value="<?php echo(validar_valor_campo(2813)); ?>"></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">EMPRESA ASOCIADA*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(246,2814,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='6'  type="text" id="stext_empresa_asociada" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_empresa_asociada.findItem(htmlentities(document.getElementById('stext_empresa_asociada').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_empresa_asociada.findItem(htmlentities(document.getElementById('stext_empresa_asociada').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_empresa_asociada.findItem(htmlentities(document.getElementById('stext_empresa_asociada').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_empresa_asociada"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_empresa_asociada" height="90%"></div><input type="hidden"  class="required"  name="empresa_asociada" id="empresa_asociada"   value="" ><label style="display:none" class="error" for="empresa_asociada">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_empresa_asociada=new dhtmlXTreeObject("treeboxbox_empresa_asociada","100%","100%",0);
                			tree_empresa_asociada.setImagePath("../../imgs/");
                			tree_empresa_asociada.enableIEImageFix(true);tree_empresa_asociada.enableCheckBoxes(1);
                    tree_empresa_asociada.enableRadioButtons(true);tree_empresa_asociada.setOnLoadingStart(cargando_empresa_asociada);
                      tree_empresa_asociada.setOnLoadingEnd(fin_cargando_empresa_asociada);tree_empresa_asociada.enableSmartXMLParsing(true);tree_empresa_asociada.loadXML("../../test.php?sin_padre=1&iddependencia=");
                	        tree_empresa_asociada.setOnCheckHandler(onNodeSelect_empresa_asociada);
                      function onNodeSelect_empresa_asociada(nodeId)
                      {valor_destino=document.getElementById("empresa_asociada");

                       if(tree_empresa_asociada.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_empresa_asociada.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_empresa_asociada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_empresa_asociada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_empresa_asociada")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_empresa_asociada"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_empresa_asociada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_empresa_asociada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_empresa_asociada")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_empresa_asociada"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><input type="hidden" name="idft_siguimiento_registro_cliente" value="<?php echo(validar_valor_campo(2815)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2816)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(246,2817);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2818)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2819)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='7'  type="file" maxlength="255"  class='multi'  name="anexo_formato[]" accept="<?php echo $extensiones;?>"><?php digitalizar_formato(246,NULL);?><input type="hidden" name="campo_descripcion" value="2808,2812"><tr><td colspan='2'><?php submit_formato(246);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>