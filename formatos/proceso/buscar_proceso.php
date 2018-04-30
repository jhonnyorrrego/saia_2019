<html><title>.:BUSCAR CARACTERIZACI&OACUTE;N DE PROCESO:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/>
			<script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script>
			<link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/>
			</head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA CARACTERIZACI&Oacute;N DE PROCESO</td></tr><tr id="tr_fecha_aprobacion_rie"><td class="encabezado">&nbsp;<select name="condicion_fecha_aprobacion_rie" id="condicion_fecha_aprobacion_rie"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA APROBACI&Oacute;N RIESGO</td><td class="encabezado">&nbsp;<select name="compara_fecha_aprobacion_rie" id="compara_fecha_aprobacion_rie"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_aprobacion_rie" name="fecha_aprobacion_rie"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_aprobacion_rie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_fecha_revision_riesg"><td class="encabezado">&nbsp;<select name="condicion_fecha_revision_riesg" id="condicion_fecha_revision_riesg"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA REVISI&Oacute;N RIESGO</td><td class="encabezado">&nbsp;<select name="compara_fecha_revision_riesg" id="compara_fecha_revision_riesg"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_revision_riesg" name="fecha_revision_riesg"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_revision_riesg").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_codigo"><td class="encabezado">&nbsp;<select name="condicion_codigo" id="condicion_codigo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Hace referencia al Codigo del Proceso (Campos Alfa Numericos)">C&Oacute;DIGO</td><td class="encabezado">&nbsp;<select name="compara_codigo" id="compara_codigo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="codigo" name="codigo"></select><script>
                     $(document).ready(function()
                      {
                      $("#codigo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_nombre"><td class="encabezado">&nbsp;<select name="condicion_nombre" id="condicion_nombre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Nombre del proceso">NOMBRE</td><td class="encabezado">&nbsp;<select name="compara_nombre" id="compara_nombre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre" name="nombre"></select><script>
                     $(document).ready(function()
                      {
                      $("#nombre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_version"><td class="encabezado">&nbsp;<select name="condicion_version" id="condicion_version"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Version del Documento">VERSI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_version" id="compara_version"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="version" name="version"></select><script>
                     $(document).ready(function()
                      {
                      $("#version").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_vigencia"><td class="encabezado">&nbsp;<select name="condicion_vigencia" id="condicion_vigencia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Vigencia del proceso">VIGENCIA</td><td class="encabezado">&nbsp;<select name="compara_vigencia" id="compara_vigencia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="vigencia" name="vigencia"></select><script>
                     $(document).ready(function()
                      {
                      $("#vigencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_estado"><td class="encabezado">&nbsp;<select name="condicion_estado" id="condicion_estado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Estado Actual del Proceso :
ELABORACION,REVISION,APROBACION,DISTRIBUCION,INACTIVO ">ESTADO</td><td class="encabezado">&nbsp;<select name="compara_estado" id="compara_estado"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(477,6011,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_responsable" id="condicion_responsable"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="Responsable o responsables del Proceso">RESPONSABLE</td><td class="encabezado">&nbsp;<select name="compara_responsable" id="compara_responsable"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_responsable"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(477,6013,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_responsable" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_responsable" height="90%"></div><input type="hidden" maxlength="255"  name="responsable" id="responsable"   value="" ><label style="display:none" class="error" for="responsable">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_responsable.setOnLoadingEnd(fin_cargando_responsable);tree_responsable.enableSmartXMLParsing(true);tree_responsable.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_responsable.setOnCheckHandler(onNodeSelect_responsable);
                      function onNodeSelect_responsable(nodeId)
                      {valor_destino=document.getElementById("responsable");
                       destinos=tree_responsable.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_responsable.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
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
                        document.poppedLayer.style.visibility = "hidden";
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
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_lider_proceso" id="condicion_lider_proceso"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="Funcionario que queda encargado para liderar el proceso">L&IACUTE;DER DEL PROCESO</td><td class="encabezado">&nbsp;<select name="compara_lider_proceso" id="compara_lider_proceso"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_lider_proceso"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(477,6014,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_lider_proceso" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_lider_proceso.findItem((document.getElementById('stext_lider_proceso').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_lider_proceso.findItem((document.getElementById('stext_lider_proceso').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_lider_proceso.findItem((document.getElementById('stext_lider_proceso').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_lider_proceso" height="90%"></div><input type="hidden" maxlength="255"  name="lider_proceso" id="lider_proceso"   value="" ><label style="display:none" class="error" for="lider_proceso">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_lider_proceso.setOnLoadingEnd(fin_cargando_lider_proceso);tree_lider_proceso.enableSmartXMLParsing(true);tree_lider_proceso.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_lider_proceso.setOnCheckHandler(onNodeSelect_lider_proceso);
                      function onNodeSelect_lider_proceso(nodeId)
                      {valor_destino=document.getElementById("lider_proceso");
                       destinos=tree_lider_proceso.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_lider_proceso.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
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
                        document.poppedLayer.style.visibility = "hidden";
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
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_objetivo"><td class="encabezado">&nbsp;<select name="condicion_objetivo" id="condicion_objetivo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Objetivo Principal del Proceso">OBJETIVO</td><td class="encabezado">&nbsp;<select name="compara_objetivo" id="compara_objetivo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="objetivo" name="objetivo"></select><script>
                     $(document).ready(function()
                      {
                      $("#objetivo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_alcance"><td class="encabezado">&nbsp;<select name="condicion_alcance" id="condicion_alcance"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Este es el alcance del proceso la delimitacion">ALCANCE</td><td class="encabezado">&nbsp;<select name="compara_alcance" id="compara_alcance"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="alcance" name="alcance"></select><script>
                     $(document).ready(function()
                      {
                      $("#alcance").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexos"><td class="encabezado">&nbsp;<select name="condicion_anexos" id="condicion_anexos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS</td><td class="encabezado">&nbsp;<select name="compara_anexos" id="compara_anexos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexos" name="anexos"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_revisado_por" id="condicion_revisado_por"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">REVISADO POR</td><td class="encabezado">&nbsp;<select name="compara_revisado_por" id="compara_revisado_por"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_revisado_por"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(477,6026,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_revisado_por" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_revisado_por.findItem((document.getElementById('stext_revisado_por').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_revisado_por.findItem((document.getElementById('stext_revisado_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_revisado_por.findItem((document.getElementById('stext_revisado_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_revisado_por" height="90%"></div><input type="hidden" maxlength="11"  name="revisado_por" id="revisado_por"   value="" ><label style="display:none" class="error" for="revisado_por">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_revisado_por=new dhtmlXTreeObject("treeboxbox_revisado_por","100%","100%",0);
                			tree_revisado_por.setImagePath("../../imgs/");
                			tree_revisado_por.enableIEImageFix(true);tree_revisado_por.enableCheckBoxes(1);
                    tree_revisado_por.enableRadioButtons(true);tree_revisado_por.setOnLoadingStart(cargando_revisado_por);
                      tree_revisado_por.setOnLoadingEnd(fin_cargando_revisado_por);tree_revisado_por.enableSmartXMLParsing(true);tree_revisado_por.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_revisado_por.setOnCheckHandler(onNodeSelect_revisado_por);
                      function onNodeSelect_revisado_por(nodeId)
                      {valor_destino=document.getElementById("revisado_por");
                       destinos=tree_revisado_por.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_revisado_por.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_revisado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_revisado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_revisado_por")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_revisado_por"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_revisado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_revisado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_revisado_por")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_revisado_por"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_permisos_acceso" id="condicion_permisos_acceso"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">PERMISOS DE ACCESO</td><td class="encabezado">&nbsp;<select name="compara_permisos_acceso" id="compara_permisos_acceso"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_permisos_acceso"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(477,6033,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_permisos_acceso" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_permisos_acceso.findItem((document.getElementById('stext_permisos_acceso').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_permisos_acceso.findItem((document.getElementById('stext_permisos_acceso').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_permisos_acceso.findItem((document.getElementById('stext_permisos_acceso').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_permisos_acceso" height="90%"></div><input type="hidden" maxlength="255"  name="permisos_acceso" id="permisos_acceso"   value="" ><label style="display:none" class="error" for="permisos_acceso">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_permisos_acceso.setOnLoadingEnd(fin_cargando_permisos_acceso);tree_permisos_acceso.enableSmartXMLParsing(true);tree_permisos_acceso.loadXML("../../test.php?sin_padre=1");
                      tree_permisos_acceso.setOnCheckHandler(onNodeSelect_permisos_acceso);
                      function onNodeSelect_permisos_acceso(nodeId)
                      {valor_destino=document.getElementById("permisos_acceso");
                       destinos=tree_permisos_acceso.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_permisos_acceso.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
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
                        document.poppedLayer.style.visibility = "hidden";
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
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_dependencias_partici" id="condicion_dependencias_partici"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">DEPENDENCIAS PARTICIPANTES</td><td class="encabezado">&nbsp;<select name="compara_dependencias_partici" id="compara_dependencias_partici"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_dependencias_partici"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(477,6035,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_dependencias_partici" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_dependencias_partici.findItem((document.getElementById('stext_dependencias_partici').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_dependencias_partici.findItem((document.getElementById('stext_dependencias_partici').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_dependencias_partici.findItem((document.getElementById('stext_dependencias_partici').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_dependencias_partici" height="90%"></div><input type="hidden" maxlength="255"  name="dependencias_partici" id="dependencias_partici"   value="" ><label style="display:none" class="error" for="dependencias_partici">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_dependencias_partici.setOnLoadingEnd(fin_cargando_dependencias_partici);tree_dependencias_partici.enableSmartXMLParsing(true);tree_dependencias_partici.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_dependencias_partici.setOnCheckHandler(onNodeSelect_dependencias_partici);
                      function onNodeSelect_dependencias_partici(nodeId)
                      {valor_destino=document.getElementById("dependencias_partici");
                       destinos=tree_dependencias_partici.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_dependencias_partici.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
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
                        document.poppedLayer.style.visibility = "hidden";
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
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_macroproceso" id="condicion_macroproceso"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MACRO PROCESO</td><td class="encabezado">&nbsp;<select name="compara_macroproceso" id="compara_macroproceso"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(477,6036,'',1);?></td></tr><input type="hidden" name="campo_descripcion" value="6007,6008"><?php submit_formato(477);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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