<html><title>.:BUSCAR RADICACI&OACUTE;N DE CORRESPONDENCIA:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/>
			<script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script>
			<link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/>
			</head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA RADICACI&Oacute;N DE CORRESPONDENCIA</td></tr><tr id="tr_despachado"><td class="encabezado">&nbsp;<select name="condicion_despachado" id="condicion_despachado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESPACHADO</td><td class="encabezado">&nbsp;<select name="compara_despachado" id="compara_despachado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="despachado" name="despachado"></select><script>
                     $(document).ready(function()
                      {
                      $("#despachado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_etiqueta_datos_gener">
                   <td class="encabezado" width="20%" title="">ETIQUETA_DATOS_GENER</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="etiqueta_datos_gener" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_radicacion_entrada" id="condicion_fecha_radicacion_entrada"><option value="AND">Y</option><option value="OR">O</option></td>
                    <td class="encabezado" width="20%" title="">FECHA DE RADICACI&Oacute;N</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_radicacion_entrada_1"  id="fecha_radicacion_entrada_1" value=""><?php selector_fecha("fecha_radicacion_entrada_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_radicacion_entrada_2"  id="fecha_radicacion_entrada_2" value=""><?php selector_fecha("fecha_radicacion_entrada_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr id="tr_numero_radicado"><td class="encabezado">&nbsp;<select name="condicion_numero_radicado" id="condicion_numero_radicado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE RADICADO</td><td class="encabezado">&nbsp;<select name="compara_numero_radicado" id="compara_numero_radicado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_radicado" name="numero_radicado"></select><script>
                     $(document).ready(function()
                      {
                      $("#numero_radicado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_origen"><td class="encabezado">&nbsp;<select name="condicion_tipo_origen" id="condicion_tipo_origen"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ORIGEN DEL DOCUMENTO</td><td class="encabezado">&nbsp;<select name="compara_tipo_origen" id="compara_tipo_origen"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,4966,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_oficio_entrada" id="condicion_fecha_oficio_entrada"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DOCUMENTO ENTRADA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_oficio_entrada_1" id="fecha_oficio_entrada_1" tipo="fecha" value=""><?php selector_fecha("fecha_oficio_entrada_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_oficio_entrada_2" id="fecha_oficio_entrada_2" tipo="fecha" value=""><?php selector_fecha("fecha_oficio_entrada_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr id="tr_numero_oficio"><td class="encabezado">&nbsp;<select name="condicion_numero_oficio" id="condicion_numero_oficio"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE DOCUMENTO</td><td class="encabezado">&nbsp;<select name="compara_numero_oficio" id="compara_numero_oficio"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_oficio" name="numero_oficio"></select><script>
                     $(document).ready(function()
                      {
                      $("#numero_oficio").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_descripcion"><td class="encabezado">&nbsp;<select name="condicion_descripcion" id="condicion_descripcion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N O ASUNTO</td><td class="encabezado">&nbsp;<select name="compara_descripcion" id="compara_descripcion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion" name="descripcion"></select><script>
                     $(document).ready(function()
                      {
                      $("#descripcion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_descripcion_anexos"><td class="encabezado">&nbsp;<select name="condicion_descripcion_anexos" id="condicion_descripcion_anexos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS FISICOS</td><td class="encabezado">&nbsp;<select name="compara_descripcion_anexos" id="compara_descripcion_anexos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_anexos" name="descripcion_anexos"></select><script>
                     $(document).ready(function()
                      {
                      $("#descripcion_anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexos_digitales"><td class="encabezado">&nbsp;<select name="condicion_anexos_digitales" id="condicion_anexos_digitales"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td><td class="encabezado">&nbsp;<select name="compara_anexos_digitales" id="compara_anexos_digitales"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexos_digitales" name="anexos_digitales"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos_digitales").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_requiere_recogida"><td class="encabezado">&nbsp;<select name="condicion_requiere_recogida" id="condicion_requiere_recogida"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">REQUIERE SERVICIO DE RECOGIDA?</td><td class="encabezado">&nbsp;<select name="compara_requiere_recogida" id="compara_requiere_recogida"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,5199,'',1);?></td></tr><tr id="tr_tipo_mensajeria"><td class="encabezado">&nbsp;<select name="condicion_tipo_mensajeria" id="condicion_tipo_mensajeria"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">REQUIERE SERVICIO DE ENTREGA?</td><td class="encabezado">&nbsp;<select name="compara_tipo_mensajeria" id="compara_tipo_mensajeria"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,4970,'',1);?></td></tr><tr id="tr_numero_guia"><td class="encabezado">&nbsp;<select name="condicion_numero_guia" id="condicion_numero_guia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE GU&Iacute;A</td><td class="encabezado">&nbsp;<select name="compara_numero_guia" id="compara_numero_guia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_guia" name="numero_guia"></select><script>
                     $(document).ready(function()
                      {
                      $("#numero_guia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_empresa_transportado" id="condicion_empresa_transportado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">EMPRESA TRANSPORTADORA</td><td class="encabezado">&nbsp;<select name="compara_empresa_transportado" id="compara_empresa_transportado"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,5084,'',1);?></td></tr><tr id="tr_etiqueta_origen">
                   <td class="encabezado" width="20%" title="">ETIQUETA_ORIGEN</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="etiqueta_origen" value=""></td>
                  </tr><tr id="tr_persona_natural"><td class="encabezado">&nbsp;<select name="condicion_persona_natural" id="condicion_persona_natural"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PERSONA NATURAL/JUR&Iacute;DICA*</td><td class="encabezado">&nbsp;<select name="compara_persona_natural" id="compara_persona_natural"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="persona_natural" name="persona_natural"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function()
                      {
                      $("#persona_natural").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_area_responsable" id="condicion_area_responsable"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">FUNCIONARIO RESPONSABLE*</td><td class="encabezado">&nbsp;<select name="compara_area_responsable" id="compara_area_responsable"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_area_responsable"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(3,4967,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_area_responsable" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_area_responsable" height="90%"></div><input type="hidden" maxlength="255"  name="area_responsable" id="area_responsable"   value="" ><label style="display:none" class="error" for="area_responsable">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_area_responsable=new dhtmlXTreeObject("treeboxbox_area_responsable","100%","100%",0);
                			tree_area_responsable.setImagePath("../../imgs/");
                			tree_area_responsable.enableIEImageFix(true);tree_area_responsable.enableCheckBoxes(1);
                    tree_area_responsable.enableRadioButtons(true);tree_area_responsable.setOnLoadingStart(cargando_area_responsable);
                      tree_area_responsable.setOnLoadingEnd(fin_cargando_area_responsable);tree_area_responsable.enableSmartXMLParsing(true);tree_area_responsable.loadXML("../../test.php?sin_padre=1&rol=1");
                      tree_area_responsable.setOnCheckHandler(onNodeSelect_area_responsable);
                      function onNodeSelect_area_responsable(nodeId)
                      {valor_destino=document.getElementById("area_responsable");
                       destinos=tree_area_responsable.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_area_responsable.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_area_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsable")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_area_responsable"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_area_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsable")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_area_responsable"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_etiqueta_destino">
                   <td class="encabezado" width="20%" title="">ETIQUETA_DESTINO</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="etiqueta_destino" value=""></td>
                  </tr><tr id="tr_tipo_destino"><td class="encabezado">&nbsp;<select name="condicion_tipo_destino" id="condicion_tipo_destino"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESTINO DEL DOCUMENTO</td><td class="encabezado">&nbsp;<select name="compara_tipo_destino" id="compara_tipo_destino"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,4968,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_destino" id="condicion_destino"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">DESTINO*</td><td class="encabezado">&nbsp;<select name="compara_destino" id="compara_destino"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_destino"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(3,43,'5
',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_destino" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_destino" height="90%"></div><input type="hidden"  name="destino" id="destino"   value="" ><label style="display:none" class="error" for="destino">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_destino=new dhtmlXTreeObject("treeboxbox_destino","100%","100%",0);
                			tree_destino.setImagePath("../../imgs/");
                			tree_destino.enableIEImageFix(true);tree_destino.enableCheckBoxes(1);
                			tree_destino.enableThreeStateCheckboxes(1);tree_destino.setOnLoadingStart(cargando_destino);
                      tree_destino.setOnLoadingEnd(fin_cargando_destino);tree_destino.enableSmartXMLParsing(true);tree_destino.loadXML("../../test.php?rol=1");
                      tree_destino.setOnCheckHandler(onNodeSelect_destino);
                      function onNodeSelect_destino(nodeId)
                      {valor_destino=document.getElementById("destino");
                       destinos=tree_destino.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_destino.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_destino"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_destino"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_copia_a" id="condicion_copia_a"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">COPIA ELECTR&OACUTE;NICA A</td><td class="encabezado">&nbsp;<select name="compara_copia_a" id="compara_copia_a"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_copia_a"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(3,44,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_copia_a" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia_a.findItem((document.getElementById('stext_copia_a').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_a.findItem((document.getElementById('stext_copia_a').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia_a.findItem((document.getElementById('stext_copia_a').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_copia_a" height="90%"></div><input type="hidden"  name="copia_a" id="copia_a"   value="" ><label style="display:none" class="error" for="copia_a">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_a=new dhtmlXTreeObject("treeboxbox_copia_a","100%","100%",0);
                			tree_copia_a.setImagePath("../../imgs/");
                			tree_copia_a.enableIEImageFix(true);tree_copia_a.enableCheckBoxes(1);
                			tree_copia_a.enableThreeStateCheckboxes(1);tree_copia_a.setOnLoadingStart(cargando_copia_a);
                      tree_copia_a.setOnLoadingEnd(fin_cargando_copia_a);tree_copia_a.enableSmartXMLParsing(true);tree_copia_a.loadXML("../../test.php?rol=1");
                      tree_copia_a.setOnCheckHandler(onNodeSelect_copia_a);
                      function onNodeSelect_copia_a(nodeId)
                      {valor_destino=document.getElementById("copia_a");
                       destinos=tree_copia_a.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_copia_a.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_copia_a() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_a")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_a")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_a"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia_a() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_a")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_a")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_a"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_persona_natural_dest"><td class="encabezado">&nbsp;<select name="condicion_persona_natural_dest" id="condicion_persona_natural_dest"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PERSONA NATURAL O JUR&Iacute;DICA*</td><td class="encabezado">&nbsp;<select name="compara_persona_natural_dest" id="compara_persona_natural_dest"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="persona_natural_dest" name="persona_natural_dest"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function()
                      {
                      $("#persona_natural_dest").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr id="tr_estado_radicado"><td class="encabezado">&nbsp;<select name="condicion_estado_radicado" id="condicion_estado_radicado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="1:Aprobado
2:Iniciado">ESTADO DOCUMENTO</td><td class="encabezado">&nbsp;<select name="compara_estado_radicado" id="compara_estado_radicado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="estado_radicado" name="estado_radicado"></select><script>
                     $(document).ready(function()
                      {
                      $("#estado_radicado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="39"><?php submit_formato(3);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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