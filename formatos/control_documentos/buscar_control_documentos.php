<html><title>.:BUSCAR SOLICITUD DE ELABORACI&OACUTE;N, MODIFICACI&OACUTE;N, ELIMINACI&OACUTE;N DE DOCUMENTOS:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/>
			<script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script>
			<link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/>
			</head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA SOLICITUD DE ELABORACI&Oacute;N, MODIFICACI&Oacute;N, ELIMINACI&Oacute;N DE DOCUMENTOS</td></tr><tr id="tr_estado_doc_calidad"><td class="encabezado">&nbsp;<select name="condicion_estado_doc_calidad" id="condicion_estado_doc_calidad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ESTADO</td><td class="encabezado">&nbsp;<select name="compara_estado_doc_calidad" id="compara_estado_doc_calidad"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(498,6599,'',1);?></td></tr><tr id="tr_idformato_calidad"><td class="encabezado">&nbsp;<select name="condicion_idformato_calidad" id="condicion_idformato_calidad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">IDFORMATO_CALIDAD</td><td class="encabezado">&nbsp;<select name="compara_idformato_calidad" id="compara_idformato_calidad"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="idformato_calidad" name="idformato_calidad"></select><script>
                     $(document).ready(function()
                      {
                      $("#idformato_calidad").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_iddocumento_calidad"><td class="encabezado">&nbsp;<select name="condicion_iddocumento_calidad" id="condicion_iddocumento_calidad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">IDDOCUMENTO CALIDAD</td><td class="encabezado">&nbsp;<select name="compara_iddocumento_calidad" id="compara_iddocumento_calidad"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="iddocumento_calidad" name="iddocumento_calidad"></select><script>
                     $(document).ready(function()
                      {
                      $("#iddocumento_calidad").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_solicitud"><td class="encabezado">&nbsp;<select name="condicion_tipo_solicitud" id="condicion_tipo_solicitud"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO SOLICITUD</td><td class="encabezado">&nbsp;<select name="compara_tipo_solicitud" id="compara_tipo_solicitud"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(498,6332,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_secretaria" id="condicion_secretaria"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">DEPENDENCIAS PARTICIPANTES</td><td class="encabezado">&nbsp;<select name="compara_secretaria" id="compara_secretaria"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_secretaria"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(498,6333,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_secretaria" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_secretaria.findItem((document.getElementById('stext_secretaria').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_secretaria.findItem((document.getElementById('stext_secretaria').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_secretaria.findItem((document.getElementById('stext_secretaria').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_secretaria" height="90%"></div><input type="hidden" maxlength="255"  name="secretaria" id="secretaria"   value="" ><label style="display:none" class="error" for="secretaria">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_secretaria=new dhtmlXTreeObject("treeboxbox_secretaria","100%","100%",0);
                			tree_secretaria.setImagePath("../../imgs/");
                			tree_secretaria.enableIEImageFix(true);tree_secretaria.enableCheckBoxes(1);
                			tree_secretaria.enableThreeStateCheckboxes(1);tree_secretaria.setOnLoadingStart(cargando_secretaria);
                      tree_secretaria.setOnLoadingEnd(fin_cargando_secretaria);tree_secretaria.enableSmartXMLParsing(true);tree_secretaria.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_secretaria.setOnCheckHandler(onNodeSelect_secretaria);
                      function onNodeSelect_secretaria(nodeId)
                      {valor_destino=document.getElementById("secretaria");
                       destinos=tree_secretaria.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_secretaria.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_secretaria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_secretaria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_secretaria")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_secretaria"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_secretaria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_secretaria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_secretaria")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_secretaria"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_listado_procesos" id="condicion_listado_procesos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PROCESO/SUBPROCESO</td><td class="encabezado">&nbsp;<select name="compara_listado_procesos" id="compara_listado_procesos"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(498,6334,'',1);?></td></tr><tr id="tr_tipo_documento"><td class="encabezado">&nbsp;<select name="condicion_tipo_documento" id="condicion_tipo_documento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DOCUMENTO</td><td class="encabezado">&nbsp;<select name="compara_tipo_documento" id="compara_tipo_documento"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(498,6338,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_serie_doc_control" id="condicion_serie_doc_control"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">SERIE DOCUMENTAL</td><td class="encabezado">&nbsp;<select name="compara_serie_doc_control" id="compara_serie_doc_control"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_serie_doc_control"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(498,6339,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_serie_doc_control" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_serie_doc_control.findItem((document.getElementById('stext_serie_doc_control').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_serie_doc_control.findItem((document.getElementById('stext_serie_doc_control').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_serie_doc_control.findItem((document.getElementById('stext_serie_doc_control').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_serie_doc_control" height="90%"></div><input type="hidden" maxlength="255"  name="serie_doc_control" id="serie_doc_control"   value="" ><label style="display:none" class="error" for="serie_doc_control">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_serie_doc_control=new dhtmlXTreeObject("treeboxbox_serie_doc_control","100%","100%",0);
                			tree_serie_doc_control.setImagePath("../../imgs/");
                			tree_serie_doc_control.enableIEImageFix(true);tree_serie_doc_control.enableCheckBoxes(1);
                    tree_serie_doc_control.enableRadioButtons(true);tree_serie_doc_control.setOnLoadingStart(cargando_serie_doc_control);
                      tree_serie_doc_control.setOnLoadingEnd(fin_cargando_serie_doc_control);tree_serie_doc_control.enableSmartXMLParsing(true);tree_serie_doc_control.loadXML("../../test_serie_funcionario.php");
                      tree_serie_doc_control.setOnCheckHandler(onNodeSelect_serie_doc_control);
                      function onNodeSelect_serie_doc_control(nodeId)
                      {valor_destino=document.getElementById("serie_doc_control");
                       destinos=tree_serie_doc_control.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_serie_doc_control.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_serie_doc_control() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie_doc_control")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie_doc_control")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_serie_doc_control"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_serie_doc_control() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie_doc_control")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie_doc_control")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_serie_doc_control"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_otros_documentos"><td class="encabezado">&nbsp;<select name="condicion_otros_documentos" id="condicion_otros_documentos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OTROS DOCUMENTOS</td><td class="encabezado">&nbsp;<select name="compara_otros_documentos" id="compara_otros_documentos"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(498,6340,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_almacenamiento" id="condicion_almacenamiento"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">ALMACENAMIENTO</td><td class="encabezado">&nbsp;<select name="compara_almacenamiento" id="compara_almacenamiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(498,6341,'',1);?></td></tr><tr id="tr_nombre_documento"><td class="encabezado">&nbsp;<select name="condicion_nombre_documento" id="condicion_nombre_documento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE DOCUMENTO</td><td class="encabezado">&nbsp;<select name="compara_nombre_documento" id="compara_nombre_documento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_documento" name="nombre_documento"></select><script>
                     $(document).ready(function()
                      {
                      $("#nombre_documento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_documento_calidad" id="condicion_documento_calidad"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">DOCUMENTO DE CALIDAD VINCULADO</td><td class="encabezado">&nbsp;<select name="compara_documento_calidad" id="compara_documento_calidad"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_documento_calidad"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(498,6343,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_documento_calidad" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_documento_calidad" height="90%"></div><input type="hidden"  name="documento_calidad" id="documento_calidad"   value="" ><label style="display:none" class="error" for="documento_calidad">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_documento_calidad=new dhtmlXTreeObject("treeboxbox_documento_calidad","100%","100%",0);
                			tree_documento_calidad.setImagePath("../../imgs/");
                			tree_documento_calidad.enableIEImageFix(true);tree_documento_calidad.enableCheckBoxes(1);
                    tree_documento_calidad.enableRadioButtons(true);tree_documento_calidad.setOnLoadingStart(cargando_documento_calidad);
                      tree_documento_calidad.setOnLoadingEnd(fin_cargando_documento_calidad);tree_documento_calidad.enableSmartXMLParsing(true);tree_documento_calidad.loadXML("test_documentos_calidad.php");
                      tree_documento_calidad.setOnCheckHandler(onNodeSelect_documento_calidad);
                      function onNodeSelect_documento_calidad(nodeId)
                      {valor_destino=document.getElementById("documento_calidad");
                       destinos=tree_documento_calidad.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_documento_calidad.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_documento_calidad() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_documento_calidad")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_documento_calidad")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_documento_calidad"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_documento_calidad() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_documento_calidad")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_documento_calidad")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_documento_calidad"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_justificacion"><td class="encabezado">&nbsp;<select name="condicion_justificacion" id="condicion_justificacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">JUSTIFICACION</td><td class="encabezado">&nbsp;<select name="compara_justificacion" id="compara_justificacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="justificacion" name="justificacion"></select><script>
                     $(document).ready(function()
                      {
                      $("#justificacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_propuesta"><td class="encabezado">&nbsp;<select name="condicion_propuesta" id="condicion_propuesta"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PROPUESTA</td><td class="encabezado">&nbsp;<select name="compara_propuesta" id="compara_propuesta"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="propuesta" name="propuesta"></select><script>
                     $(document).ready(function()
                      {
                      $("#propuesta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexo_formato"><td class="encabezado">&nbsp;<select name="condicion_anexo_formato" id="condicion_anexo_formato"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXO FORMATO</td><td class="encabezado">&nbsp;<select name="compara_anexo_formato" id="compara_anexo_formato"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexo_formato" name="anexo_formato"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexo_formato").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_revisado" id="condicion_revisado"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">REVISADO POR</td><td class="encabezado">&nbsp;<select name="compara_revisado" id="compara_revisado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_revisado"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(498,6347,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_revisado" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_revisado" height="90%"></div><input type="hidden" maxlength="255"  name="revisado" id="revisado"   value="" ><label style="display:none" class="error" for="revisado">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_revisado=new dhtmlXTreeObject("treeboxbox_revisado","100%","100%",0);
                			tree_revisado.setImagePath("../../imgs/");
                			tree_revisado.enableIEImageFix(true);tree_revisado.enableCheckBoxes(1);
                    tree_revisado.enableRadioButtons(true);tree_revisado.setOnLoadingStart(cargando_revisado);
                      tree_revisado.setOnLoadingEnd(fin_cargando_revisado);tree_revisado.enableSmartXMLParsing(true);tree_revisado.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_revisado.setOnCheckHandler(onNodeSelect_revisado);
                      function onNodeSelect_revisado(nodeId)
                      {valor_destino=document.getElementById("revisado");
                       destinos=tree_revisado.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_revisado.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_revisado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_revisado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_revisado")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_revisado"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_revisado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_revisado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_revisado")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_revisado"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_aprobado" id="condicion_aprobado"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">APROBADO POR</td><td class="encabezado">&nbsp;<select name="compara_aprobado" id="compara_aprobado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_aprobado"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(498,6348,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_aprobado" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_aprobado" height="90%"></div><input type="hidden" maxlength="255"  name="aprobado" id="aprobado"   value="" ><label style="display:none" class="error" for="aprobado">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_aprobado.setOnLoadingEnd(fin_cargando_aprobado);tree_aprobado.enableSmartXMLParsing(true);tree_aprobado.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_aprobado.setOnCheckHandler(onNodeSelect_aprobado);
                      function onNodeSelect_aprobado(nodeId)
                      {valor_destino=document.getElementById("aprobado");
                       destinos=tree_aprobado.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_aprobado.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
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
                        document.poppedLayer.style.visibility = "hidden";
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
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_fecha_confirmacion"><td class="encabezado">&nbsp;<select name="condicion_fecha_confirmacion" id="condicion_fecha_confirmacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA CONFIRMACION</td><td class="encabezado">&nbsp;<select name="compara_fecha_confirmacion" id="compara_fecha_confirmacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_confirmacion" name="fecha_confirmacion"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_confirmacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="6332"><?php submit_formato(498);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
                <input type="hidden" name="campo__retorno" value="<?php echo($_REQUEST["campo__retorno"]); ?>">
              <?php }
               if(@$_REQUEST["formulario__retorno"]){ ?>
                <input type="hidden" name="formulario__retorno" value="<?php echo($_REQUEST["formulario__retorno"]); ?>">
              <?php }
                if(@$_REQUEST["pagina__retorno"]){ ?>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_REQUEST["pagina__retorno"]); ?>">
             <?php  }
              else{ ?>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_SERVER["PHP_SELF"]); ?>">
             <?php  } ?></form></body></html>