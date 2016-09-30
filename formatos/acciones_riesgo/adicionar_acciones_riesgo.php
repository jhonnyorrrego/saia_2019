<html><title>.:ADICIONAR 2. ACCIONES:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../riesgos_proceso/../riesgos_proceso/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">2. ACCIONES</td></tr><input type="hidden" name="estado_documento" value="<?php echo(validar_valor_campo(4946)); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(395,4726);?></tr><tr>
                     <td class="encabezado" width="20%" title="">CONTROL*</td>
                     <?php control_funcion(395,4727);?></tr><tr>
                   <td class="encabezado" width="20%" title="">RESPONSABLES*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(395,4728,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='1'  type="text" id="stext_reponsables" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_reponsables.findItem(htmlentities(document.getElementById('stext_reponsables').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_reponsables.findItem(htmlentities(document.getElementById('stext_reponsables').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_reponsables.findItem(htmlentities(document.getElementById('stext_reponsables').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_reponsables"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_reponsables" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="reponsables" id="reponsables"   value="" ><label style="display:none" class="error" for="reponsables">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_reponsables=new dhtmlXTreeObject("treeboxbox_reponsables","100%","100%",0);
                			tree_reponsables.setImagePath("../../imgs/");
                			tree_reponsables.enableIEImageFix(true);tree_reponsables.enableCheckBoxes(1);
                			tree_reponsables.enableThreeStateCheckboxes(1);tree_reponsables.setOnLoadingStart(cargando_reponsables);
                      tree_reponsables.setOnLoadingEnd(fin_cargando_reponsables);tree_reponsables.enableSmartXMLParsing(true);tree_reponsables.loadXML("../../test.php?sin_padre=1");
                	        
                      tree_reponsables.setOnCheckHandler(onNodeSelect_reponsables);
                      function onNodeSelect_reponsables(nodeId)
                      {valor_destino=document.getElementById("reponsables");
                       destinos=tree_reponsables.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_reponsables.getAllSubItems(vector[i]);
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
                      function fin_cargando_reponsables() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_reponsables")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_reponsables")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_reponsables"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_reponsables() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_reponsables")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_reponsables")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_reponsables"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">ACCION*</td>
                     <td class="celda_transparente"><textarea  tabindex='2'  name="acciones_accion" id="acciones_accion" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4729)); ?></textarea></td>
                    </tr><tr id="tr_opcio_admin_riesgo" >
                     <td class="encabezado" width="20%" title="">OPCIONES ADMINISTRACI&Oacute;N DEL RIESGO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(395,4730,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">INDICADOR*</td>
                     <td class="celda_transparente"><textarea  tabindex='3'  name="indicador" id="indicador" cols="53" rows="3" class="tiny_basico required"><?php echo(validar_valor_campo(4731)); ?></textarea></td>
                    </tr><input type="hidden" name="idft_acciones_riesgo" value="<?php echo(validar_valor_campo(4732)); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(validar_valor_campo(4733)); ?>"><input type="hidden" name="firma" value="<?php echo(validar_valor_campo(4734)); ?>"><input type="hidden" name="serie_idserie" value="<?php echo(validar_valor_campo(4736)); ?>"><input type="hidden" name="encabezado" value="<?php echo(validar_valor_campo(4737)); ?>"><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE SUSCRIPCI&Oacute;N DE LA ACCI&Oacute;N*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='4'  type="text" readonly="true"  class="required dateISO"  name="fecha_accion" id="fecha_accion" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_accion","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE CUMPLIMIENTO*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='5'  type="text" readonly="true"  class="required dateISO"  name="fecha_cumplimiento" id="fecha_cumplimiento" tipo="fecha" value="<?php echo(date("0000-00-00")); ?>"><?php selector_fecha("fecha_cumplimiento","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><?php validar_edicion_adicion_formatos_riesgo_aprobados(395,NULL);?><?php validar_entrada_acciones_riesgo(395,NULL);?><?php validar_opciones_administrativas(395,NULL);?><?php validar_revision_aprobacion_acciones_riesgo(395,NULL);?><input type="hidden" name="campo_descripcion" value="4729"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><input type="hidden" name="accion" value="guardar_detalle" ><tr><td colspan='2'><?php submit_formato(395);?></td></tr></table></form></body></html>