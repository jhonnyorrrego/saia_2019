<html><title>.:BUSCAR ACTA:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ACTA</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_grupo_reunido" id="condicion_grupo_reunido"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">GRUPO QUE SE REUNE</td><td class="encabezado">&nbsp;<select name="compara_grupo_reunido" id="compara_grupo_reunido"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="grupo_reunido" name="grupo_reunido"></select><script>
                     $(document).ready(function() 
                      {
                      $("#grupo_reunido").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_reunion" id="condicion_fecha_reunion"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_reunion_1" id="fecha_reunion_1" tipo="fecha" value=""><?php selector_fecha("fecha_reunion_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_reunion_2" id="fecha_reunion_2" tipo="fecha" value=""><?php selector_fecha("fecha_reunion_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_hora" id="condicion_hora"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">HORA</td><td class="encabezado">&nbsp;<select name="compara_hora" id="compara_hora"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="hora" name="hora"></select><script>
                     $(document).ready(function() 
                      {
                      $("#hora").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_numero_acta" id="condicion_numero_acta"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DEL ACTA</td><td class="encabezado">&nbsp;<select name="compara_numero_acta" id="compara_numero_acta"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_acta" name="numero_acta"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_acta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_caracter" id="condicion_caracter"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CARACTER DE LA REUNI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_caracter" id="compara_caracter"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(309,3625,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_objetivo_reunion" id="condicion_objetivo_reunion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBJETIVO DE LA REUNI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_objetivo_reunion" id="compara_objetivo_reunion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="objetivo_reunion" name="objetivo_reunion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#objetivo_reunion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_ajenda_reunion" id="condicion_ajenda_reunion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">AGENDA</td><td class="encabezado">&nbsp;<select name="compara_ajenda_reunion" id="compara_ajenda_reunion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="ajenda_reunion" name="ajenda_reunion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#ajenda_reunion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_desarrollo_reunion" id="condicion_desarrollo_reunion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESARROLLO</td><td class="encabezado">&nbsp;<select name="compara_desarrollo_reunion" id="compara_desarrollo_reunion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="desarrollo_reunion" name="desarrollo_reunion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#desarrollo_reunion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_asistentes" id="condicion_asistentes"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">ASISTENTES</td><td class="encabezado">&nbsp;<select name="compara_asistentes" id="compara_asistentes"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_asistentes"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(309,3624,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_asistentes" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_asistentes.findItem(htmlentities(document.getElementById('stext_asistentes').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_asistentes.findItem(htmlentities(document.getElementById('stext_asistentes').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_asistentes.findItem(htmlentities(document.getElementById('stext_asistentes').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_asistentes" height="90%"></div><input type="hidden" maxlength="3000"  name="asistentes" id="asistentes"   value="" ><label style="display:none" class="error" for="asistentes">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_asistentes.setOnLoadingEnd(fin_cargando_asistentes);tree_asistentes.enableSmartXMLParsing(true);tree_asistentes.loadXML("../../test.php?rol=1");
                      tree_asistentes.setOnCheckHandler(onNodeSelect_asistentes);
                      function onNodeSelect_asistentes(nodeId)
                      {valor_destino=document.getElementById("asistentes");
                       destinos=tree_asistentes.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_asistentes.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
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
                        document.poppedLayer.style.visibility = "hidden";
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
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_invitados" id="condicion_invitados"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">INVITADOS</td><td class="encabezado">&nbsp;<select name="compara_invitados" id="compara_invitados"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="3000"   id="invitados" name="invitados"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#invitados").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_ausentes" id="condicion_ausentes"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">AUSENTES</td><td class="encabezado">&nbsp;<select name="compara_ausentes" id="compara_ausentes"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="ausentes" name="ausentes"></select><script>
                     $(document).ready(function() 
                      {
                      $("#ausentes").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tareas" id="condicion_tareas"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ACCIONES TAREAS Y COMPROMISOS</td><td class="encabezado">&nbsp;<select name="compara_tareas" id="compara_tareas"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="tareas" name="tareas"></select><script>
                     $(document).ready(function() 
                      {
                      $("#tareas").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_proxima_reunion" id="condicion_fecha_proxima_reunion"><option value="AND">Y</option><option value="OR">O</option></td>
                    <td class="encabezado" width="20%" title="">FECHA PR&Oacute;XIMA REUNI&Oacute;N</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_proxima_reunion_1"  id="fecha_proxima_reunion_1" value=""><?php selector_fecha("fecha_proxima_reunion_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_proxima_reunion_2"  id="fecha_proxima_reunion_2" value=""><?php selector_fecha("fecha_proxima_reunion_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_lugar_proxima_reunion" id="condicion_lugar_proxima_reunion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">LUGAR PR&Oacute;XIMA REUNI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_lugar_proxima_reunion" id="compara_lugar_proxima_reunion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="lugar_proxima_reunion" name="lugar_proxima_reunion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#lugar_proxima_reunion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexo_formato" id="condicion_anexo_formato"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td><td class="encabezado">&nbsp;<select name="compara_anexo_formato" id="compara_anexo_formato"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexo_formato" name="anexo_formato"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexo_formato").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_firma_presidente" id="condicion_firma_presidente"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">FIRMA PRESIDENTE</td><td class="encabezado">&nbsp;<select name="compara_firma_presidente" id="compara_firma_presidente"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_firma_presidente"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(309,3630,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_firma_presidente" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_firma_presidente.findItem(htmlentities(document.getElementById('stext_firma_presidente').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_firma_presidente.findItem(htmlentities(document.getElementById('stext_firma_presidente').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_firma_presidente.findItem(htmlentities(document.getElementById('stext_firma_presidente').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_firma_presidente" height="90%"></div><input type="hidden" maxlength="255"  name="firma_presidente" id="firma_presidente"   value="" ><label style="display:none" class="error" for="firma_presidente">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_firma_presidente.setOnLoadingEnd(fin_cargando_firma_presidente);tree_firma_presidente.enableSmartXMLParsing(true);tree_firma_presidente.loadXML("../../test.php?sin_padre=1&rol=1");
                      tree_firma_presidente.setOnCheckHandler(onNodeSelect_firma_presidente);
                      function onNodeSelect_firma_presidente(nodeId)
                      {valor_destino=document.getElementById("firma_presidente");
                       destinos=tree_firma_presidente.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_firma_presidente.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
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
                        document.poppedLayer.style.visibility = "hidden";
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
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_firma_secretaria" id="condicion_firma_secretaria"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">FIRMA SECRETARIO(A)</td><td class="encabezado">&nbsp;<select name="compara_firma_secretaria" id="compara_firma_secretaria"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_firma_secretaria"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(309,3631,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_firma_secretaria" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_firma_secretaria.findItem(htmlentities(document.getElementById('stext_firma_secretaria').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_firma_secretaria.findItem(htmlentities(document.getElementById('stext_firma_secretaria').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_firma_secretaria.findItem(htmlentities(document.getElementById('stext_firma_secretaria').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_firma_secretaria" height="90%"></div><input type="hidden" maxlength="255"  name="firma_secretaria" id="firma_secretaria"   value="" ><label style="display:none" class="error" for="firma_secretaria">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_firma_secretaria.setOnLoadingEnd(fin_cargando_firma_secretaria);tree_firma_secretaria.enableSmartXMLParsing(true);tree_firma_secretaria.loadXML("../../test.php?sin_padre=1&rol=1");
                      tree_firma_secretaria.setOnCheckHandler(onNodeSelect_firma_secretaria);
                      function onNodeSelect_firma_secretaria(nodeId)
                      {valor_destino=document.getElementById("firma_secretaria");
                       destinos=tree_firma_secretaria.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_firma_secretaria.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
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
                        document.poppedLayer.style.visibility = "hidden";
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
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_codigo" id="condicion_codigo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">C&Oacute;DIGO</td><td class="encabezado">&nbsp;<select name="compara_codigo" id="compara_codigo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="codigo" name="codigo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#codigo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3637"><?php submit_formato(309);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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