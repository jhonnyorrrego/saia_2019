<html><title>.:EDITAR ACTA:.</title><head><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/cmxforms.js"></script><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_acciones.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css"><script type="text/javascript" src="../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js"></script><?php include_once("../../anexosdigitales/funciones_archivo.php"); ?><script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script><link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style><script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();
	
});
</script> </head><body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");?><form name="formulario_formatos" id="formulario_formatos" method="post" action="../../class_transferencia.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4"><tr><td colspan="2" class="encabezado_list">ACTA</td></tr><input type="hidden" name="estado_documento" value="<?php echo(mostrar_valor_campo('estado_documento',309,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="encabezado" value="<?php echo(mostrar_valor_campo('encabezado',309,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO*</td>
                     <?php buscar_dependencia(309,3644,$_REQUEST['iddoc']);?></tr><input type="hidden" name="idft_acta" value="<?php echo(mostrar_valor_campo('idft_acta',309,$_REQUEST['iddoc'])); ?>"><tr>
                     <td class="encabezado" width="20%" title="">GRUPO QUE SE REUNE*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='1'  type="text" size="100" id="grupo_reunido" name="grupo_reunido"  value="<?php echo(mostrar_valor_campo('grupo_reunido',309,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                       <td class="encabezado" width="20%" title="">FECHA*</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input  tabindex='2'  type="text" readonly="true"  class="required dateISO"  name="fecha_reunion" id="fecha_reunion" tipo="fecha" value="<?php mostrar_valor_campo('fecha_reunion',309,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_reunion","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">HORA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='3'  type="text" size="100" id="hora" name="hora"  value="<?php echo(mostrar_valor_campo('hora',309,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DEL ACTA*</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"  class="required"   tabindex='4'  type="text" size="100" id="numero_acta" name="numero_acta"  value="<?php echo(mostrar_valor_campo('numero_acta',309,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr id="tr_caracter" >
                     <td class="encabezado" width="20%" title="">CARACTER DE LA REUNI&Oacute;N*</td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(309,3625,$_REQUEST['iddoc']);?></td></tr><tr>
                     <td class="encabezado" width="20%" title="">OBJETIVO DE LA REUNI&Oacute;N*</td>
                     <td class="celda_transparente"><textarea  tabindex='5'  name="objetivo_reunion" id="objetivo_reunion" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('objetivo_reunion',309,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">AGENDA*</td>
                     <td class="celda_transparente"><textarea  tabindex='6'  name="ajenda_reunion" id="ajenda_reunion" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('ajenda_reunion',309,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">DESARROLLO*</td>
                     <td class="celda_transparente"><textarea  tabindex='7'  name="desarrollo_reunion" id="desarrollo_reunion" cols="53" rows="3" class="tiny_basico required"><?php echo(mostrar_valor_campo('desarrollo_reunion',309,$_REQUEST['iddoc'])); ?></textarea></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">ASISTENTES*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(309,3624,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='8'  type="text" id="stext_asistentes" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_asistentes.findItem(htmlentities(document.getElementById('stext_asistentes').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_asistentes.findItem(htmlentities(document.getElementById('stext_asistentes').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_asistentes.findItem(htmlentities(document.getElementById('stext_asistentes').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_asistentes"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_asistentes" height="90%"></div><input type="hidden" maxlength="3000"  class="required"  name="asistentes" id="asistentes"   value="<?php cargar_seleccionados(309,3624,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_asistentes=new dhtmlXTreeObject("treeboxbox_asistentes","100%","100%",0);
                			tree_asistentes.setImagePath("../../imgs/");
                			tree_asistentes.enableIEImageFix(true);tree_asistentes.enableCheckBoxes(1);
                			tree_asistentes.enableThreeStateCheckboxes(1);tree_asistentes.setOnLoadingStart(cargando_asistentes);
                      tree_asistentes.setOnLoadingEnd(fin_cargando_asistentes);tree_asistentes.enableSmartXMLParsing(true);tree_asistentes.loadXML("../../test.php?rol=1",checkear_arbol);
                	        
                      tree_asistentes.setOnCheckHandler(onNodeSelect_asistentes);
                      function onNodeSelect_asistentes(nodeId)
                      {valor_destino=document.getElementById("asistentes");
                       destinos=tree_asistentes.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");  
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_asistentes.getAllSubItems(vector[i]);
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
                      function fin_cargando_asistentes() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_asistentes")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_asistentes")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_asistentes"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_asistentes() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_asistentes")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_asistentes")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_asistentes"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(309,3624,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_asistentes.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">INVITADOS</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" maxlength="3000"  name="invitados" id="invitados" value="<?php echo(mostrar_valor_campo('invitados',309,$_REQUEST['iddoc'])); ?>"><?php componente_ejecutor("3634",@$_REQUEST["iddoc"]); ?></td>
                  </tr><tr>
                    <td class="encabezado" width="20%" title="">FECHA PR&Oacute;XIMA REUNI&Oacute;N</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input  tabindex='9'  type="text" readonly="true" name="fecha_proxima_reunion"  id="fecha_proxima_reunion" value="<?php mostrar_valor_campo('fecha_proxima_reunion',309,$_REQUEST['iddoc']); ?>"><?php selector_fecha("fecha_proxima_reunion","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td><tr>
                     <td class="encabezado" width="20%" title="">LUGAR PR&Oacute;XIMA REUNI&Oacute;N</td>
                     <td bgcolor="#F5F5F5"><input  maxlength="255"   tabindex='10'  type="text" size="100" id="lugar_proxima_reunion" name="lugar_proxima_reunion"  value="<?php echo(mostrar_valor_campo('lugar_proxima_reunion',309,$_REQUEST['iddoc'])); ?>"></td>
                    </tr><tr>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td>
                     <td class="celda_transparente"><?php echo '<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key='.$_REQUEST["iddoc"].'&idformato=309&idcampo=3623" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>'; ?><tr>
                   <td class="encabezado" width="20%" title="">FIRMA PRESIDENTE*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(309,3630,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='12'  type="text" id="stext_firma_presidente" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_firma_presidente.findItem(htmlentities(document.getElementById('stext_firma_presidente').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_firma_presidente.findItem(htmlentities(document.getElementById('stext_firma_presidente').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_firma_presidente.findItem(htmlentities(document.getElementById('stext_firma_presidente').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_firma_presidente"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_firma_presidente" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="firma_presidente" id="firma_presidente"   value="<?php cargar_seleccionados(309,3630,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_firma_presidente=new dhtmlXTreeObject("treeboxbox_firma_presidente","100%","100%",0);
                			tree_firma_presidente.setImagePath("../../imgs/");
                			tree_firma_presidente.enableIEImageFix(true);tree_firma_presidente.enableCheckBoxes(1);
                    tree_firma_presidente.enableRadioButtons(true);tree_firma_presidente.setOnLoadingStart(cargando_firma_presidente);
                      tree_firma_presidente.setOnLoadingEnd(fin_cargando_firma_presidente);tree_firma_presidente.enableSmartXMLParsing(true);tree_firma_presidente.loadXML("../../test.php?sin_padre=1&rol=1",checkear_arbol);
                	        tree_firma_presidente.setOnCheckHandler(onNodeSelect_firma_presidente);
                      function onNodeSelect_firma_presidente(nodeId)
                      {valor_destino=document.getElementById("firma_presidente");

                       if(tree_firma_presidente.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_firma_presidente.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_firma_presidente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_firma_presidente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_firma_presidente")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_firma_presidente"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_firma_presidente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_firma_presidente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_firma_presidente")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_firma_presidente"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(309,3630,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_firma_presidente.setCheck(vector2[m],true);
                    }}
--></script></td></tr><tr>
                   <td class="encabezado" width="20%" title="">FIRMA SECRETARIO(A)*</td><td bgcolor="#F5F5F5"><div id="seleccionados"><?php mostrar_seleccionados(309,3631,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input  tabindex='13'  type="text" id="stext_firma_secretaria" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_firma_secretaria.findItem(htmlentities(document.getElementById('stext_firma_secretaria').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_firma_secretaria.findItem(htmlentities(document.getElementById('stext_firma_secretaria').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>                          
                   <a href="javascript:void(0)" onclick="tree_firma_secretaria.findItem(htmlentities(document.getElementById('stext_firma_secretaria').value))"><img src="../../botones/general/siguiente.png"border="0px"></a> 
                          <br /><div id="esperando_firma_secretaria"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_firma_secretaria" height="90%"></div><input type="hidden" maxlength="255"  class="required"  name="firma_secretaria" id="firma_secretaria"   value="<?php cargar_seleccionados(309,3631,1,$_REQUEST['iddoc']);?>" ><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_firma_secretaria=new dhtmlXTreeObject("treeboxbox_firma_secretaria","100%","100%",0);
                			tree_firma_secretaria.setImagePath("../../imgs/");
                			tree_firma_secretaria.enableIEImageFix(true);tree_firma_secretaria.enableCheckBoxes(1);
                    tree_firma_secretaria.enableRadioButtons(true);tree_firma_secretaria.setOnLoadingStart(cargando_firma_secretaria);
                      tree_firma_secretaria.setOnLoadingEnd(fin_cargando_firma_secretaria);tree_firma_secretaria.enableSmartXMLParsing(true);tree_firma_secretaria.loadXML("../../test.php?sin_padre=1&rol=1",checkear_arbol);
                	        tree_firma_secretaria.setOnCheckHandler(onNodeSelect_firma_secretaria);
                      function onNodeSelect_firma_secretaria(nodeId)
                      {valor_destino=document.getElementById("firma_secretaria");

                       if(tree_firma_secretaria.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_firma_secretaria.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_firma_secretaria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_firma_secretaria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_firma_secretaria")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_firma_secretaria"]');
                        document.poppedLayer.style.display = "none";
                      }

                      function cargando_firma_secretaria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_firma_secretaria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_firma_secretaria")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_firma_secretaria"]');
                        document.poppedLayer.style.display = "";
                      }
                	
                  function checkear_arbol(){
                  vector2="<?php cargar_seleccionados(309,3631,1,$_REQUEST['iddoc']);?>";
                  vector2=vector2.split(",");
                  for(m=0;m<vector2.length;m++)
                    {tree_firma_secretaria.setCheck(vector2[m],true);
                    }}
--></script></td></tr><input type="hidden" name="documento_iddocumento" value="<?php echo(mostrar_valor_campo('documento_iddocumento',309,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="firma" value="<?php echo(mostrar_valor_campo('firma',309,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="codigo" value="<?php echo(mostrar_valor_campo('codigo',309,$_REQUEST['iddoc'])); ?>"><input type="hidden" name="campo_descripcion" value="<?php echo('3637'); ?>"><input type="hidden" name="formato" value="309"><tr><td colspan='2'><?php submit_formato(309,$_REQUEST['iddoc']);?></td></tr></table><input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''></form></body></html><?php include_once("../librerias/footer_plantilla.php");?>