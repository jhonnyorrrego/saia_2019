<html><title>.:EDITAR TAREAS:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">TAREAS</td></tr><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(239,2705,$_REQUEST['iddoc']);?></tr><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',239,$_REQUEST['iddoc'])); ?>"><tr>
                       <td class="encabezado" width="20%" title="">FECHA TAREA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='1'  type="text" readonly="true"  class="required dateISO"  name="fecha_formato" id="fecha_formato" tipo="fecha" value="<?php mostrar_valor_campo('fecha_formato',239,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_formato","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                   <td class="encabezado" width="20%" title="">RESPONSABLE</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(239,2690,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='2'  type="text" id="stext_responsable" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_responsable"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_responsable" height="90%"></div><input type="hidden" maxlength="255"  name="responsable" id="responsable"   value="<?php cargar_seleccionados(239,2690,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
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
                			tree_responsable.enableThreeStateCheckboxes(1);tree_responsable.setOnLoadingStart(cargando_responsable);
                      tree_responsable.setOnLoadingEnd(fin_cargando_responsable);tree_responsable.enableSmartXMLParsing(true);tree_responsable.loadXML("../../test.php?rol=1",checkear_arbol);
                	        
                      tree_responsable.setOnCheckHandler(onNodeSelect_responsable);
                      function onNodeSelect_responsable(nodeId)
                      {valor_destino=document.getElementById("responsable");
                       destinos=tree_responsable.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_responsable.getAllSubItems(vector[i]);
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
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(239,2690,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_responsable.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">VINCULADOS*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(239,2691,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='3'  type="text" id="stext_vinculados" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_vinculados.findItem(htmlentities(document.getElementById('stext_vinculados').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_vinculados.findItem(htmlentities(document.getElementById('stext_vinculados').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_vinculados.findItem(htmlentities(document.getElementById('stext_vinculados').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_vinculados"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_vinculados" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="vinculados" id="vinculados"   value="<?php cargar_seleccionados(239,2691,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_vinculados=new dhtmlXTreeObject("treeboxbox_vinculados","100%","100%",0);
                			tree_vinculados.setImagePath("../../imgs/");
                			tree_vinculados.enableIEImageFix(true);tree_vinculados.enableCheckBoxes(1);
                			tree_vinculados.enableThreeStateCheckboxes(1);tree_vinculados.setOnLoadingStart(cargando_vinculados);
                      tree_vinculados.setOnLoadingEnd(fin_cargando_vinculados);tree_vinculados.enableSmartXMLParsing(true);tree_vinculados.loadXML("../../test.php?rol=1",checkear_arbol);
                	        
                      tree_vinculados.setOnCheckHandler(onNodeSelect_vinculados);
                      function onNodeSelect_vinculados(nodeId)
                      {valor_destino=document.getElementById("vinculados");
                       destinos=tree_vinculados.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_vinculados.getAllSubItems(vector[i]);
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
                      function fin_cargando_vinculados() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_vinculados")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_vinculados")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_vinculados"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_vinculados() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_vinculados")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_vinculados")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_vinculados"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(239,2691,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_vinculados.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">TAREA ASIGNADA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="tarea_asiganda" name="tarea_asiganda"  value="<?php echo(mostrar_valor_campo('tarea_asiganda',239,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_prioridad" >
                     <td class="encabezado" width="20%" title="">PRIORIDAD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(239,2693,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DESCRPCI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="descripcion" id="descripcion" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('descripcion',239,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr id="tr_tipo" >
                     <td class="encabezado" width="20%" title="">TIPO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(239,2695,$_REQUEST['iddoc']);?></td></tr><tr id="tr_periodicidad" >
                     <td class="encabezado" width="20%" title="">PERIODICIDAD*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(239,2696,$_REQUEST['iddoc']);?></td></tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA DE ENTREGA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='6'  type="text" readonly="true"  class="required dateISO"  name="fecha_entraga" id="fecha_entraga" tipo="fecha" value="<?php mostrar_valor_campo('fecha_entraga',239,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_entraga","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr id="tr_tipo_periodo" >
                     <td class="encabezado" width="20%" title="">TIPO PERIODO A RECORDAR</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(239,2728,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">DIAS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(239,2699,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">HORAS </td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(239,2700,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">MES</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(239,2701,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">SEMANAS</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(239,2702,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="idft_recordar_tarea" value="<?php echo(mostrar_valor_campo('idft_recordar_tarea',239,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',239,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',239,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=239&idcampo=2698" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><?php recordatorio_funcion(239,NULL,$_REQUEST['iddoc']);?><input type="hidden" name="campo_descripcion" value="<?php echo('2729'); ?>"><input type="hidden" name="formato" value="239"><tr><td colspan='2'><?php submit_formato(239,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>