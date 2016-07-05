<html><title>.:EDITAR MAPA DE PROCESO:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">MAPA DE PROCESO</td></tr><input type="hidden" name="fecha_aprobacion_rie" value="<?php echo(mostrar_valor_campo('fecha_aprobacion_rie',194,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="fecha_revision_riesg" value="<?php echo(mostrar_valor_campo('fecha_revision_riesg',194,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(194,2012,$_REQUEST['iddoc']);?></tr><tr>
                     <td class="encabezado" width="20%" title="Hace referencia al Codigo del Proceso (Campos Alfa Numericos)">C&Oacute;DIGO</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='1'  type="text" size="100" id="codigo" name="codigo"  value="<?php echo(mostrar_valor_campo('codigo',194,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Nombre del proceso">NOMBRE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='2'  type="text" size="100" id="nombre" name="nombre"  value="<?php echo(mostrar_valor_campo('nombre',194,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Version del Documento">VERSI&Oacute;N</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='3'  type="text" size="100" id="version" name="version"  value="<?php echo(mostrar_valor_campo('version',194,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Vigencia del proceso">VIGENCIA</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='4'  type="text" size="100" id="vigencia" name="vigencia"  value="<?php echo(mostrar_valor_campo('vigencia',194,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_estado" >
                     <td class="encabezado" width="20%" title="Estado Actual del Proceso :
ELABORACION,REVISION,APROBACION,DISTRIBUCION,INACTIVO ">ESTADO*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(194,2001,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="Por favor cargar la descripcion de las actividades del proceso y/o la caracterizacion del proceso">DESCRIPCION</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=194&idcampo=4121" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><tr>
                   <td class="encabezado" width="20%" title="Responsable o responsables del Proceso">RESPONSABLE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(194,2607,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='6'  type="text" id="stext_responsable" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem(htmlentities(document.getElementById('stext_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_responsable"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_responsable" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="responsable" id="responsable"   value="<?php cargar_seleccionados(194,2607,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
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
                      tree_responsable.setOnLoadingEnd(fin_cargando_responsable);tree_responsable.enableSmartXMLParsing(true);tree_responsable.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);
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
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(194,2607,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_responsable.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="Funcionario que queda encargado para liderar el proceso">L&Iacute;DER DEL PROCESO*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(194,2000,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='7'  type="text" id="stext_lider_proceso" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_lider_proceso.findItem(htmlentities(document.getElementById('stext_lider_proceso').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_lider_proceso.findItem(htmlentities(document.getElementById('stext_lider_proceso').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_lider_proceso.findItem(htmlentities(document.getElementById('stext_lider_proceso').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_lider_proceso"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_lider_proceso" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="lider_proceso" id="lider_proceso"   value="<?php cargar_seleccionados(194,2000,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_lider_proceso=new dhtmlXTreeObject("treeboxbox_lider_proceso","100%","100%",0);
                			tree_lider_proceso.setImagePath("../../imgs/");
                			tree_lider_proceso.enableIEImageFix(true);tree_lider_proceso.enableCheckBoxes(1);
                    tree_lider_proceso.enableRadioButtons(true);tree_lider_proceso.setOnLoadingStart(cargando_lider_proceso);
                      tree_lider_proceso.setOnLoadingEnd(fin_cargando_lider_proceso);tree_lider_proceso.enableSmartXMLParsing(true);tree_lider_proceso.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);
                	        tree_lider_proceso.setOnCheckHandler(onNodeSelect_lider_proceso);
                      function onNodeSelect_lider_proceso(nodeId)
                      {valor_destino=document.getElementById("lider_proceso");

                       if(tree_lider_proceso.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_lider_proceso.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_lider_proceso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_lider_proceso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_lider_proceso")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_lider_proceso"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_lider_proceso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_lider_proceso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_lider_proceso")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_lider_proceso"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(194,2000,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_lider_proceso.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="Objetivo Principal del Proceso">OBJETIVO*</td>
                     <td class="celda_transparente"><textarea  tabindex='8'  name="objetivo" id="objetivo" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('objetivo',194,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="Este es el alcance del proceso la delimitacion">ALCANCE*</td>
                     <td class="celda_transparente"><textarea  tabindex='9'  name="alcance" id="alcance" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('alcance',194,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=194&idcampo=2002" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><input type="hidden" name="idft_proceso" value="<?php echo(mostrar_valor_campo('idft_proceso',194,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',194,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',194,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',194,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="Listado Maestro de documentos">LISTADO MAESTRO UNIFICADO DE DOCUMENTOS Y REGISTROS</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=194&idcampo=4131" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><input type="hidden" name="listado_maestro_registros" value="<?php echo(mostrar_valor_campo('listado_maestro_registros',194,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="Acta que se genera para aprobar el Proceso">ACTA</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=194&idcampo=4125" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><tr>
                   <td class="encabezado" width="20%" title="Nombre y Cargo de quienes Aprueban el documento de Calidad">APROBADO POR</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(194,4126,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='13'  type="text" id="stext_aprobado_por" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_aprobado_por.findItem(htmlentities(document.getElementById('stext_aprobado_por').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_aprobado_por.findItem(htmlentities(document.getElementById('stext_aprobado_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_aprobado_por.findItem(htmlentities(document.getElementById('stext_aprobado_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_aprobado_por"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_aprobado_por" height="90%"></div><input type="hidden" maxlength="255"  name="aprobado_por" id="aprobado_por"   value="<?php cargar_seleccionados(194,4126,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_aprobado_por=new dhtmlXTreeObject("treeboxbox_aprobado_por","100%","100%",0);
                			tree_aprobado_por.setImagePath("../../imgs/");
                			tree_aprobado_por.enableIEImageFix(true);tree_aprobado_por.enableCheckBoxes(1);
                    tree_aprobado_por.enableRadioButtons(true);tree_aprobado_por.setOnLoadingStart(cargando_aprobado_por);
                      tree_aprobado_por.setOnLoadingEnd(fin_cargando_aprobado_por);tree_aprobado_por.enableSmartXMLParsing(true);tree_aprobado_por.loadXML("../../test.php?rol=1",checkear_arbol);
                	        tree_aprobado_por.setOnCheckHandler(onNodeSelect_aprobado_por);
                      function onNodeSelect_aprobado_por(nodeId)
                      {valor_destino=document.getElementById("aprobado_por");

                       if(tree_aprobado_por.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_aprobado_por.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_aprobado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobado_por")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_aprobado_por"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_aprobado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobado_por")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_aprobado_por"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(194,4126,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_aprobado_por.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                    <td class="encabezado" width="20%" title="Fecha en que se aprob&oacute;">FECHA EN QUE SE APROB&Oacute;</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='14'  type="text" readonly="true" name="fecha_aprobacion"  id="fecha_aprobacion" value="<?php mostrar_valor_campo('fecha_aprobacion',194,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_aprobacion","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td><tr>
                    <td class="encabezado" width="20%" title="Fecha en que se revis&oacute;">FECHA EN QUE SE REVIS&Oacute;</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='15'  type="text" readonly="true" name="fecha_revision"  id="fecha_revision" value="<?php mostrar_valor_campo('fecha_revision',194,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_revision","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td><tr>
                   <td class="encabezado" width="20%" title="">PERMISOS DE ACCESO</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(194,4130,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='16'  type="text" id="stext_permisos_acceso" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_permisos_acceso.findItem(htmlentities(document.getElementById('stext_permisos_acceso').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_permisos_acceso.findItem(htmlentities(document.getElementById('stext_permisos_acceso').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_permisos_acceso.findItem(htmlentities(document.getElementById('stext_permisos_acceso').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_permisos_acceso"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_permisos_acceso" height="90%"></div><input type="hidden" maxlength="255"  name="permisos_acceso" id="permisos_acceso"   value="<?php cargar_seleccionados(194,4130,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_permisos_acceso=new dhtmlXTreeObject("treeboxbox_permisos_acceso","100%","100%",0);
                			tree_permisos_acceso.setImagePath("../../imgs/");
                			tree_permisos_acceso.enableIEImageFix(true);tree_permisos_acceso.enableCheckBoxes(1);
                			tree_permisos_acceso.enableThreeStateCheckboxes(1);tree_permisos_acceso.setOnLoadingStart(cargando_permisos_acceso);
                      tree_permisos_acceso.setOnLoadingEnd(fin_cargando_permisos_acceso);tree_permisos_acceso.enableSmartXMLParsing(true);tree_permisos_acceso.loadXML("../../test.php?ocultar_seleccion_dep=1",checkear_arbol);
                	        
                      tree_permisos_acceso.setOnCheckHandler(onNodeSelect_permisos_acceso);
                      function onNodeSelect_permisos_acceso(nodeId)
                      {valor_destino=document.getElementById("permisos_acceso");
                       destinos=tree_permisos_acceso.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_permisos_acceso.getAllSubItems(vector[i]);
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
                      function fin_cargando_permisos_acceso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_permisos_acceso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_permisos_acceso")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_permisos_acceso"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_permisos_acceso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_permisos_acceso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_permisos_acceso")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_permisos_acceso"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(194,4130,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_permisos_acceso.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">APROBADO POR*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(194,2608,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='17'  type="text" id="stext_aprobado" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_aprobado.findItem(htmlentities(document.getElementById('stext_aprobado').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_aprobado.findItem(htmlentities(document.getElementById('stext_aprobado').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_aprobado.findItem(htmlentities(document.getElementById('stext_aprobado').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_aprobado"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_aprobado" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="aprobado" id="aprobado"   value="<?php cargar_seleccionados(194,2608,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_aprobado=new dhtmlXTreeObject("treeboxbox_aprobado","100%","100%",0);
                			tree_aprobado.setImagePath("../../imgs/");
                			tree_aprobado.enableIEImageFix(true);tree_aprobado.enableCheckBoxes(1);
                    tree_aprobado.enableRadioButtons(true);tree_aprobado.setOnLoadingStart(cargando_aprobado);
                      tree_aprobado.setOnLoadingEnd(fin_cargando_aprobado);tree_aprobado.enableSmartXMLParsing(true);tree_aprobado.loadXML("../../test.php?rol=1&sin_padre=1",checkear_arbol);
                	        tree_aprobado.setOnCheckHandler(onNodeSelect_aprobado);
                      function onNodeSelect_aprobado(nodeId)
                      {valor_destino=document.getElementById("aprobado");

                       if(tree_aprobado.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_aprobado.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_aprobado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobado")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_aprobado"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_aprobado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobado")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_aprobado"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(194,2608,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_aprobado.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">DEPENDENCIAS PARTICIPANTES*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(194,4574,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='18'  type="text" id="stext_dependencias_partici" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_dependencias_partici.findItem(htmlentities(document.getElementById('stext_dependencias_partici').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_dependencias_partici.findItem(htmlentities(document.getElementById('stext_dependencias_partici').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_dependencias_partici.findItem(htmlentities(document.getElementById('stext_dependencias_partici').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_dependencias_partici"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_dependencias_partici" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="dependencias_partici" id="dependencias_partici"   value="<?php cargar_seleccionados(194,4574,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_dependencias_partici=new dhtmlXTreeObject("treeboxbox_dependencias_partici","100%","100%",0);
                			tree_dependencias_partici.setImagePath("../../imgs/");
                			tree_dependencias_partici.enableIEImageFix(true);tree_dependencias_partici.enableCheckBoxes(1);
                			tree_dependencias_partici.enableThreeStateCheckboxes(1);tree_dependencias_partici.setOnLoadingStart(cargando_dependencias_partici);
                      tree_dependencias_partici.setOnLoadingEnd(fin_cargando_dependencias_partici);tree_dependencias_partici.enableSmartXMLParsing(true);tree_dependencias_partici.loadXML("../../test_serie.php?tabla=dependencia&estado=1",checkear_arbol);
                	        
                      tree_dependencias_partici.setOnCheckHandler(onNodeSelect_dependencias_partici);
                      function onNodeSelect_dependencias_partici(nodeId)
                      {valor_destino=document.getElementById("dependencias_partici");
                       destinos=tree_dependencias_partici.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_dependencias_partici.getAllSubItems(vector[i]);
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
                      function fin_cargando_dependencias_partici() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencias_partici")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencias_partici")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_dependencias_partici"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_dependencias_partici() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_dependencias_partici")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_dependencias_partici")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_dependencias_partici"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(194,4574,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_dependencias_partici.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                     <td class="encabezado" width="20%" title="">MACROPROCESO</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(194,2609,$_REQUEST['iddoc']);?></td></tr><input type="hidden" name="campo_descripcion" value="<?php echo('2003,2006,2608'); ?>"><input type="hidden" name="formato" value="194"><tr><td colspan='2'><?php submit_formato(194,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>