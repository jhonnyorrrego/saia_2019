<html><title>.:BUSCAR SOLICITUD DE MANTENIMIENTO LOCATIVO:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA SOLICITUD DE MANTENIMIENTO LOCATIVO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_elaboracion" id="condicion_fecha_elaboracion"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE ELABORACI&Oacute;N</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_elaboracion_1" id="fecha_elaboracion_1" tipo="fecha" value=""><?php selector_fecha("fecha_elaboracion_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_elaboracion_2" id="fecha_elaboracion_2" tipo="fecha" value=""><?php selector_fecha("fecha_elaboracion_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_describe_requerimiento" id="condicion_describe_requerimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DETALLADA DEL REQUERIMIENTO</td><td class="encabezado">&nbsp;<select name="compara_describe_requerimiento" id="compara_describe_requerimiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="describe_requerimiento" name="describe_requerimiento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#describe_requerimiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_solucion" id="condicion_fecha_solucion"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA ESPERADA DE SOLUCI&Oacute;N</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_solucion_1" id="fecha_solucion_1" tipo="fecha" value=""><?php selector_fecha("fecha_solucion_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_solucion_2" id="fecha_solucion_2" tipo="fecha" value=""><?php selector_fecha("fecha_solucion_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_prioridad" id="condicion_prioridad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PRIORIDAD</td><td class="encabezado">&nbsp;<select name="compara_prioridad" id="compara_prioridad"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(287,3306,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_soportes_anexos" id="condicion_soportes_anexos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SOPORTES ANEXOS</td><td class="encabezado">&nbsp;<select name="compara_soportes_anexos" id="compara_soportes_anexos"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(287,3307,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexos_digitales" id="condicion_anexos_digitales"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_jefe_area" id="condicion_jefe_area"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">JEFE DEL &AACUTE;REA</td><td class="encabezado">&nbsp;<select name="compara_jefe_area" id="compara_jefe_area"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_jefe_area"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(287,3310,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_jefe_area" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_jefe_area.findItem(htmlentities(document.getElementById('stext_jefe_area').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_jefe_area.findItem(htmlentities(document.getElementById('stext_jefe_area').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_jefe_area.findItem(htmlentities(document.getElementById('stext_jefe_area').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_jefe_area" height="90%"></div><input type="hidden" maxlength="255"  name="jefe_area" id="jefe_area"   value="" ><label style="display:none" class="error" for="jefe_area">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_jefe_area=new dhtmlXTreeObject("treeboxbox_jefe_area","100%","100%",0);
                			tree_jefe_area.setImagePath("../../imgs/");
                			tree_jefe_area.enableIEImageFix(true);tree_jefe_area.enableCheckBoxes(1);
                    tree_jefe_area.enableRadioButtons(true);tree_jefe_area.setOnLoadingStart(cargando_jefe_area);
                      tree_jefe_area.setOnLoadingEnd(fin_cargando_jefe_area);tree_jefe_area.enableSmartXMLParsing(true);tree_jefe_area.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_jefe_area.setOnCheckHandler(onNodeSelect_jefe_area);
                      function onNodeSelect_jefe_area(nodeId)
                      {valor_destino=document.getElementById("jefe_area");
                       destinos=tree_jefe_area.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_jefe_area.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_jefe_area() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_jefe_area")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_jefe_area")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_jefe_area"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_jefe_area() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_jefe_area")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_jefe_area")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_jefe_area"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_aprovacion_logistica" id="condicion_aprovacion_logistica"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">APROBACI&OACUTE;N LOG&IACUTE;STICA</td><td class="encabezado">&nbsp;<select name="compara_aprovacion_logistica" id="compara_aprovacion_logistica"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_aprovacion_logistica"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(287,3311,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_aprovacion_logistica" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_aprovacion_logistica.findItem(htmlentities(document.getElementById('stext_aprovacion_logistica').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_aprovacion_logistica.findItem(htmlentities(document.getElementById('stext_aprovacion_logistica').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_aprovacion_logistica.findItem(htmlentities(document.getElementById('stext_aprovacion_logistica').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_aprovacion_logistica" height="90%"></div><input type="hidden" maxlength="255"  name="aprovacion_logistica" id="aprovacion_logistica"   value="" ><label style="display:none" class="error" for="aprovacion_logistica">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_aprovacion_logistica=new dhtmlXTreeObject("treeboxbox_aprovacion_logistica","100%","100%",0);
                			tree_aprovacion_logistica.setImagePath("../../imgs/");
                			tree_aprovacion_logistica.enableIEImageFix(true);tree_aprovacion_logistica.enableCheckBoxes(1);
                    tree_aprovacion_logistica.enableRadioButtons(true);tree_aprovacion_logistica.setOnLoadingStart(cargando_aprovacion_logistica);
                      tree_aprovacion_logistica.setOnLoadingEnd(fin_cargando_aprovacion_logistica);tree_aprovacion_logistica.enableSmartXMLParsing(true);tree_aprovacion_logistica.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_aprovacion_logistica.setOnCheckHandler(onNodeSelect_aprovacion_logistica);
                      function onNodeSelect_aprovacion_logistica(nodeId)
                      {valor_destino=document.getElementById("aprovacion_logistica");
                       destinos=tree_aprovacion_logistica.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_aprovacion_logistica.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_aprovacion_logistica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprovacion_logistica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprovacion_logistica")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_aprovacion_logistica"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_aprovacion_logistica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprovacion_logistica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprovacion_logistica")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_aprovacion_logistica"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_usuario_que_solita" id="condicion_usuario_que_solita"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">USUARIO QUE SOLICITA</td><td class="encabezado">&nbsp;<select name="compara_usuario_que_solita" id="compara_usuario_que_solita"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="usuario_que_solita" name="usuario_que_solita"></select><script>
                     $(document).ready(function() 
                      {
                      $("#usuario_que_solita").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_area" id="condicion_area"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">&Aacute;REA DEL ELABORADOR DEL FORMATO</td><td class="encabezado">&nbsp;<select name="compara_area" id="compara_area"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="area" name="area"></select><script>
                     $(document).ready(function() 
                      {
                      $("#area").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3312"><?php submit_formato(287);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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