<html><title>.:ADICIONAR RECEPCI&Oacute;N DE SERVICIOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../carta/funciones.php"); ?><?php include_once("../radicacion_entrada/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><?php include_once("../librerias/header_formato.php"); ?><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">RECEPCI&Oacute;N DE SERVICIOS</td></tr><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(3063)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(268,3062);?></tr><tr>
                     <td class="encabezado" width="20%" title="">FECHA Y HORA DE RADICACION*</td>
                     <?php fecha_formato(268,3053);?></tr><tr>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE SOLICITUD*</td>
                     <?php cargar_lista_solicitud_servicio(268,3054);?></tr><tr>
                   <td class="encabezado" width="20%" title="">DESTINO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(268,3057,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_destino_doc_mercantil" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_destino_doc_mercantil.findItem(htmlentities(document.getElementById('stext_destino_doc_mercantil').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_destino_doc_mercantil.findItem(htmlentities(document.getElementById('stext_destino_doc_mercantil').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_destino_doc_mercantil.findItem(htmlentities(document.getElementById('stext_destino_doc_mercantil').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_destino_doc_mercantil"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_destino_doc_mercantil" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="destino_doc_mercantil" id="destino_doc_mercantil"   value="" ><label style="display:none" class="error" for="destino_doc_mercantil">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_destino_doc_mercantil=new dhtmlXTreeObject("treeboxbox_destino_doc_mercantil","100%","100%",0);
                			tree_destino_doc_mercantil.setImagePath("../../imgs/");
                			tree_destino_doc_mercantil.enableIEImageFix(true);tree_destino_doc_mercantil.enableCheckBoxes(1);
                    tree_destino_doc_mercantil.enableRadioButtons(true);tree_destino_doc_mercantil.setOnLoadingStart(cargando_destino_doc_mercantil);
                      tree_destino_doc_mercantil.setOnLoadingEnd(fin_cargando_destino_doc_mercantil);tree_destino_doc_mercantil.enableSmartXMLParsing(true);tree_destino_doc_mercantil.loadXML("../../test.php?rol=1&sin_padre=1");
                	        tree_destino_doc_mercantil.setOnCheckHandler(onNodeSelect_destino_doc_mercantil);
                      function onNodeSelect_destino_doc_mercantil(nodeId)
                      {valor_destino=document.getElementById("destino_doc_mercantil");

                       if(tree_destino_doc_mercantil.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_destino_doc_mercantil.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_destino_doc_mercantil() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino_doc_mercantil")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino_doc_mercantil")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_destino_doc_mercantil"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_destino_doc_mercantil() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino_doc_mercantil")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino_doc_mercantil")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_destino_doc_mercantil"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">COPIA A</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(268,3058,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_copia_a_mercantil" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_copia_a_mercantil.findItem(htmlentities(document.getElementById('stext_copia_a_mercantil').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_a_mercantil.findItem(htmlentities(document.getElementById('stext_copia_a_mercantil').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_copia_a_mercantil.findItem(htmlentities(document.getElementById('stext_copia_a_mercantil').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_copia_a_mercantil"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_copia_a_mercantil" height="90%"></div><input type="hidden" maxlength="255"  name="copia_a_mercantil" id="copia_a_mercantil"   value="" ><label style="display:none" class="error" for="copia_a_mercantil">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_a_mercantil=new dhtmlXTreeObject("treeboxbox_copia_a_mercantil","100%","100%",0);
                			tree_copia_a_mercantil.setImagePath("../../imgs/");
                			tree_copia_a_mercantil.enableIEImageFix(true);tree_copia_a_mercantil.enableCheckBoxes(1);
                			tree_copia_a_mercantil.enableThreeStateCheckboxes(1);tree_copia_a_mercantil.setOnLoadingStart(cargando_copia_a_mercantil);
                      tree_copia_a_mercantil.setOnLoadingEnd(fin_cargando_copia_a_mercantil);tree_copia_a_mercantil.enableSmartXMLParsing(true);tree_copia_a_mercantil.loadXML("../../test.php?rol=1");
                	        
                      tree_copia_a_mercantil.setOnCheckHandler(onNodeSelect_copia_a_mercantil);
                      function onNodeSelect_copia_a_mercantil(nodeId)
                      {valor_destino=document.getElementById("copia_a_mercantil");
                       destinos=tree_copia_a_mercantil.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_copia_a_mercantil.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               
                               for(h=0;h<vectorh.length;h++)
                                  {if(vectorh[h].indexOf("_")!=-1)
                                      vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
                                   nuevo=eliminarItem(nuevo,vectorh[h]);
                                  } 
                              }
                          }
                       nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");   
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_copia_a_mercantil() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_a_mercantil")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_a_mercantil")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_a_mercantil"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_copia_a_mercantil() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_a_mercantil")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_a_mercantil")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_a_mercantil"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS F&Iacute;SICOS</td>
                     <?php carga_lista_anexos_fisicos(268,3056);?></tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><input  tabindex='3'  type="file" maxlength="255"  class='multi'  name="anexos_digitales_doc[]" accept="<?php echo $extensiones;?>"><tr>
                     <td class="encabezado" width="20%" title="">NUMERO SOLICITUD SELECCIONADA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="numero_solici_selec" name="numero_solici_selec"  value="<?php echo(validar_valor_campo(3059)); ?>"></td>
                    </tr><input type="hidden" name="idft_radica_doc_mercantil" value="<?php echo(validar_valor_campo(3060)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(3061)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(3064)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(3052)); ?>"><?php digitalizar_formato_radicacion(268,NULL);?><input type="hidden" name="campo_descripcion" value="3053"><tr><td colspan='2'><?php submit_formato(268);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>