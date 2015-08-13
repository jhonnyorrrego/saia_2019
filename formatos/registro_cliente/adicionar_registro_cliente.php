<html><title>.:ADICIONAR REGISTRO DE CLIENTE:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">REGISTRO DE CLIENTE</td></tr><input type="hidden" name="idft_registro_cliente" value="<?php echo(validar_valor_campo(2798)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(2799)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(245,2800);?></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(2801)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(2802)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(2782)); ?>"><tr>
                   <td class="encabezado" width="20%" title="">NOMBRE DEL CLIENTE*</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="11"  class="required"  name="nombre_cliente" id="nombre_cliente" value=""><?php componente_ejecutor("2783",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DE ORIGEN DEL CONTACTO</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="descripcion_origen_contacto" id="descripcion_origen_contacto" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(2784)); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">PAGINA WEB</td>
                     <td bgcolor="#F5F5F5"><input    tabindex='2'  type="text" size="100" id="pagina_web" name="pagina_web"  value="<?php echo(validar_valor_campo(2785)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ESTADO DEL CLIENTE*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(245,2786,$_REQUEST['iddoc']);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">SECTOR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(245,2787,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='3'  type="text" id="stext_sector" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_sector.findItem(htmlentities(document.getElementById('stext_sector').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_sector.findItem(htmlentities(document.getElementById('stext_sector').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_sector.findItem(htmlentities(document.getElementById('stext_sector').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_sector"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_sector" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="sector" id="sector"   value="" ><label style="display:none" class="error" for="sector">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_sector=new dhtmlXTreeObject("treeboxbox_sector","100%","100%",0);
                			tree_sector.setImagePath("../../imgs/");
                			tree_sector.enableIEImageFix(true);tree_sector.enableCheckBoxes(1);
                    tree_sector.enableRadioButtons(true);tree_sector.setOnLoadingStart(cargando_sector);
                      tree_sector.setOnLoadingEnd(fin_cargando_sector);tree_sector.enableSmartXMLParsing(true);tree_sector.loadXML("../../test_serie.php?sin_padre=1&id=916&tabla=serie");
                	        tree_sector.setOnCheckHandler(onNodeSelect_sector);
                      function onNodeSelect_sector(nodeId)
                      {valor_destino=document.getElementById("sector");

                       if(tree_sector.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_sector.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_sector() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_sector")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_sector")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_sector"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_sector() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_sector")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_sector")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_sector"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE CONTACTO 1</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="nombre_contacto1" name="nombre_contacto1"  value="<?php echo(validar_valor_campo(2788)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TELEFONO / EXT</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='5'  type="text" size="100" id="telefono_contacto1" name="telefono_contacto1"  value="<?php echo(validar_valor_campo(2794)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CARGO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='6'  type="text" size="100" id="cargo_contacto1" name="cargo_contacto1"  value="<?php echo(validar_valor_campo(2789)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CELULAR</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='7'  type="text" size="100" id="celular_contacto1" name="celular_contacto1"  value="<?php echo(validar_valor_campo(2790)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">EMAIL</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='8'  type="text" size="100" id="email_contacto1" name="email_contacto1"  value="<?php echo(validar_valor_campo(2791)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">NOMBRE CONTACTO 2</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='9'  type="text" size="100" id="nombre_contacto2" name="nombre_contacto2"  value="<?php echo(validar_valor_campo(2792)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CARGO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='10'  type="text" size="100" id="cargo_contacto2" name="cargo_contacto2"  value="<?php echo(validar_valor_campo(2793)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">TELEFONO / EXT</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='11'  type="text" size="100" id="telefono_contacto2" name="telefono_contacto2"  value="<?php echo(validar_valor_campo(2795)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">CELULAR</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='12'  type="text" size="100" id="celular_contacto2" name="celular_contacto2"  value="<?php echo(validar_valor_campo(2796)); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">EMAIL</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='13'  type="text" size="100" id="email_contacto2" name="email_contacto2"  value="<?php echo(validar_valor_campo(2797)); ?>"></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">RESPONSABLE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(245,2803,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='14'  type="text" id="stext_responsable" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_responsable"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_responsable" height="90%"></div><input type="hidden"  class="required"  name="responsable" id="responsable"   value="" ><label style="display:none" class="error" for="responsable">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable=new dhtmlXTreeObject("treeboxbox_responsable","100%","100%",0);
                			tree_responsable.setImagePath("../../imgs/");
                			tree_responsable.enableIEImageFix(true);tree_responsable.enableCheckBoxes(1);
                    tree_responsable.enableRadioButtons(true);tree_responsable.setOnLoadingStart(cargando_responsable);
                      tree_responsable.setOnLoadingEnd(fin_cargando_responsable);tree_responsable.enableSmartXMLParsing(true);tree_responsable.loadXML("../../test_serie.php?sin_padre=1&id=932&tabla=serie");
                	        tree_responsable.setOnCheckHandler(onNodeSelect_responsable);
                      function onNodeSelect_responsable(nodeId)
                      {valor_destino=document.getElementById("responsable");

                       if(tree_responsable.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_responsable.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">LOGO EMPRESA</td>
                     <td class="celda_transparente"><input  tabindex='15'  type="file" maxlength="255"  class='multi'  name="anexo_formato[]" accept="<?php echo $extensiones;?>"><input type="hidden" name="campo_descripcion" value="2783"><tr><td colspan='2'><?php submit_formato(245);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>