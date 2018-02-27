<html><title>.:ADICIONAR 1. VALORACION CONTROLES RIESGOS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">1. VALORACION CONTROLES RIESGOS</td></tr><tr id="tr_dependencia">
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(500,6384);?></tr><tr id="tr_consecutivo_control">
                     <td class="encabezado" width="20%" title="">CONSECUTIVO</td>
                     <?php consecutivo_funcion_control(500,6385);?></tr><tr id="tr_fecha_valoracion">
                     <td class="encabezado" width="20%" title="">FECHA VALORACION*</td>
                     <?php fecha_bloqueada_valoracion(500,6386);?></tr><tr id="tr_descripcion_control">
                     <td class="encabezado" width="20%" title="Descripci&oacute;n del control existente:

Hacer una descripci&oacute;n en  forma detallada del control Existente que se tiene implementado.">DESCRIPCION DEL CONTROL EXISTENTE*</td>
                     <td class="celda_transparente"><textarea  tabindex='1'  name="descripcion_control" id="descripcion_control" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(6387)); ?></textarea></td>
                    </tr><tr id="tr_tipo_control" >
                     <td class="encabezado" width="20%" title="Los controles luego de su valoraci&oacute;n permiten desplazarse en la matriz, de acuerdo a si afecta probabilidad o impacto, en el caso de la probabilidad desplazar&iacute;a casillas hacia arriba y en el caso del impacto, hacia la izquierda de acuerdo a la valoraci&oacute;n de controles.
Es por ello que se debe seleccionar si el control existente me permite disminuir el nivel de probabilidad o el nivel de impacto.">EL CONTROL AFECTA?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(500,6388,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="desplazamiento" value="<?php echo(validar_valor_campo(6389)); ?>"><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_riesgos_proceso"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_riesgos_proceso"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_riesgos_proceso);} ?><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(6391)); ?>"><tr id="tr_herramientas_ejercer">
                     <td class="encabezado" width="20%" title="" colspan="2" id="herramientas_ejercer"><center>HERRAMIENTAS PARA EJERCER EL CONTROL</center></td>
                    </tr><tr id="tr_herramienta_ejercer" >
                     <td class="encabezado" width="20%" title="">1. POSEE UNA HERRAMIENTA PARA EJERCER EL CONTROL?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(500,6393,$_REQUEST['iddoc']);?></td></tr><tr id="tr_desc_herramienta">
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DE LA HERRAMIENTA</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="desc_herramienta" id="desc_herramienta" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(6394)); ?></textarea></td>
                    </tr><tr id="tr_anexar_herramienta">
                     <td class="encabezado" width="20%" title="">ANEXAR HERRAMIENTA</td>
                     <td class="celda_transparente"><input  tabindex='3'  type="file"  class='multi'  id="anexar_herramienta" name="anexar_herramienta[]" accept="<?php echo $extensiones;?>"><tr id="tr_procedimiento_herram" >
                     <td class="encabezado" width="20%" title="">2. EXISTEN MANUALES, INSTRUCTIVOS O PROCEDIMIENTOS PARA EL MANEJO DE LA HERRAMIENTA?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(500,6396,$_REQUEST['iddoc']);?></td></tr><tr id="tr_desc_documento">
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DEL DOCUMENTO</td>
                     <td class="celda_transparente"><textarea  tabindex='4'  name="desc_documento" id="desc_documento" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(6397)); ?></textarea></td>
                    </tr><tr id="tr_anexar_documento">
                     <td class="encabezado" width="20%" title="">ANEXAR DOCUMENTO</td>
                     <td class="celda_transparente"><input  tabindex='5'  type="file"  class='multi'  id="anexar_documento" name="anexar_documento[]" accept="<?php echo $extensiones;?>"><tr id="tr_herramienta_efectiva" >
                     <td class="encabezado" width="20%" title="">3. EN EL TIEMPO QUE LLEVA LA HERRAMIENTA, HA DEMOSTRADO SER EFECTIVA?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(500,6399,$_REQUEST['iddoc']);?></td></tr><tr id="tr_pregunta_porque">
                     <td class="encabezado" width="20%" title="">POR QU&Eacute;?*</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="pregunta_porque" id="pregunta_porque" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(6400)); ?></textarea></td>
                    </tr><tr id="tr_seguimiento_al_contr">
                     <td class="encabezado" width="20%" title="" colspan="2" id="seguimiento_al_contr"><center>SEGUIMIENTO AL CONTROL</center></td>
                    </tr><tr id="tr_responsables_ejecuci" >
                     <td class="encabezado" width="20%" title="">4. ESTAN DEFINIDOS LOS RESPONSABLES DE LA EJECUCION DEL CONTROL Y DEL SEGUIMIENTO?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(500,6402,$_REQUEST['iddoc']);?></td></tr><tr id="tr_responsable_seg">
                   <td class="encabezado" width="20%" title="">QUIEN ES EL RESPONSABLES DE LA EJECUCI&Oacute;N DEL CONTROL</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(500,6403,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='7'  type="text" id="stext_responsable_seg" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_responsable_seg.findItem((document.getElementById('stext_responsable_seg').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable_seg.findItem((document.getElementById('stext_responsable_seg').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_responsable_seg.findItem((document.getElementById('stext_responsable_seg').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_responsable_seg"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_responsable_seg" height="90%"></div><input type="hidden" maxlength="255"  name="responsable_seg" id="responsable_seg"   value="" ><label style="display:none" class="error" for="responsable_seg">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable_seg=new dhtmlXTreeObject("treeboxbox_responsable_seg","100%","100%",0);
                			tree_responsable_seg.setImagePath("../../imgs/");
                			tree_responsable_seg.enableIEImageFix(true);tree_responsable_seg.enableCheckBoxes(1);
                			tree_responsable_seg.enableThreeStateCheckboxes(1);tree_responsable_seg.setOnLoadingStart(cargando_responsable_seg);
                      tree_responsable_seg.setOnLoadingEnd(fin_cargando_responsable_seg);tree_responsable_seg.enableSmartXMLParsing(true);tree_responsable_seg.loadXML("../../test.php?rol=1&sin_padre=1");
                	        
                      tree_responsable_seg.setOnCheckHandler(onNodeSelect_responsable_seg);
                      function onNodeSelect_responsable_seg(nodeId)
                      {valor_destino=document.getElementById("responsable_seg");
                       destinos=tree_responsable_seg.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_responsable_seg.getAllSubItems(vector[i]);
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
                      function fin_cargando_responsable_seg() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_seg")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_seg")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable_seg"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_responsable_seg() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_seg")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_seg")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable_seg"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr id="tr_respon_seguimiento">
                   <td class="encabezado" width="20%" title="">QUIEN ES EL RESPONSABLES DE LA EJECUCI&Oacute;N DEL SEGUIMIENTO</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(500,6404,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='8'  type="text" id="stext_respon_seguimiento" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_respon_seguimiento.findItem((document.getElementById('stext_respon_seguimiento').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_respon_seguimiento.findItem((document.getElementById('stext_respon_seguimiento').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_respon_seguimiento.findItem((document.getElementById('stext_respon_seguimiento').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_respon_seguimiento"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_respon_seguimiento" height="90%"></div><input type="hidden" maxlength="255"  name="respon_seguimiento" id="respon_seguimiento"   value="" ><label style="display:none" class="error" for="respon_seguimiento">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_respon_seguimiento=new dhtmlXTreeObject("treeboxbox_respon_seguimiento","100%","100%",0);
                			tree_respon_seguimiento.setImagePath("../../imgs/");
                			tree_respon_seguimiento.enableIEImageFix(true);tree_respon_seguimiento.enableCheckBoxes(1);
                			tree_respon_seguimiento.enableThreeStateCheckboxes(1);tree_respon_seguimiento.setOnLoadingStart(cargando_respon_seguimiento);
                      tree_respon_seguimiento.setOnLoadingEnd(fin_cargando_respon_seguimiento);tree_respon_seguimiento.enableSmartXMLParsing(true);tree_respon_seguimiento.loadXML("../../test.php?rol=1&sin_padre=1");
                	        
                      tree_respon_seguimiento.setOnCheckHandler(onNodeSelect_respon_seguimiento);
                      function onNodeSelect_respon_seguimiento(nodeId)
                      {valor_destino=document.getElementById("respon_seguimiento");
                       destinos=tree_respon_seguimiento.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_respon_seguimiento.getAllSubItems(vector[i]);
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
                      function fin_cargando_respon_seguimiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_respon_seguimiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_respon_seguimiento")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_respon_seguimiento"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_respon_seguimiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_respon_seguimiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_respon_seguimiento")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_respon_seguimiento"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr id="tr_frecuencia_ejecucion" >
                     <td class="encabezado" width="20%" title="">5. LA FRECUENCIA DE LA EJECUCION DEL CONTROL Y SEGUIMIENTO ES ADECUADO?*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(500,6405,$_REQUEST['iddoc']);?></td></tr><tr id="tr_cual_frecuencia">
                     <td class="encabezado" width="20%" title="">CUAL ES LA FRECUENCIA</td>
                     <td class="celda_transparente"><textarea  tabindex='9'  name="cual_frecuencia" id="cual_frecuencia" cols="53" rows="3" class="tiny_basico"><?php echo(validar_valor_campo(6406)); ?></textarea></td>
                    </tr><input type="hidden" name="idft_control_riesgos" value="<?php echo(validar_valor_campo(6407)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(6408)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(6409)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(6410)); ?>"><?php llenar_orientacion(500,NULL);?><?php validar_revision_aprobacion_control_riesgos(500,NULL);?><?php validar_tipo_riesgo(500,NULL);?><input type="hidden" name="campo_descripcion" value="6387"><tr><td colspan='2'><?php submit_formato(500);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html>