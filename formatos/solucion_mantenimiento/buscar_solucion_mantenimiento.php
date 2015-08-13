<html><title>.:BUSCAR SOLUCI&OACUTE;N MANTENIMIENTO LOCATIVO:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA SOLUCI&Oacute;N MANTENIMIENTO LOCATIVO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo" id="condicion_tipo"><option value="AND">Y</option><option value="OR">O</option></td>
                  <td class="encabezado" width="20%" title="">TIPO</td><td class="encabezado">&nbsp;<select name="compara_tipo" id="compara_tipo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(288,3325,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_responsable" id="condicion_nombre_responsable"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE DE RESPONSABLE</td><td class="encabezado">&nbsp;<select name="compara_nombre_responsable" id="compara_nombre_responsable"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_responsable" name="nombre_responsable"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_responsable").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_solucion" id="condicion_descripcion_solucion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">BREVE DESCRIPCI&Oacute;N SOLUCI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_descripcion_solucion" id="compara_descripcion_solucion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_solucion" name="descripcion_solucion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_solucion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_prerequisitos_montaje" id="condicion_prerequisitos_montaje"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PRE-REQUISITOS DE MONTAJE</td><td class="encabezado">&nbsp;<select name="compara_prerequisitos_montaje" id="compara_prerequisitos_montaje"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="prerequisitos_montaje" name="prerequisitos_montaje"></select><script>
                     $(document).ready(function() 
                      {
                      $("#prerequisitos_montaje").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_observaciones" id="condicion_observaciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td><td class="encabezado">&nbsp;<select name="compara_observaciones" id="compara_observaciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones" name="observaciones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observaciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexos_solucion" id="condicion_anexos_solucion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS SOLUCI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_anexos_solucion" id="compara_anexos_solucion"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(288,3330,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_solucion_digital" id="condicion_solucion_digital"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td><td class="encabezado">&nbsp;<select name="compara_solucion_digital" id="compara_solucion_digital"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="solucion_digital" name="solucion_digital"></select><script>
                     $(document).ready(function() 
                      {
                      $("#solucion_digital").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_implementado_por" id="condicion_implementado_por"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">IMPLEMENTADO POR</td><td class="encabezado">&nbsp;<select name="compara_implementado_por" id="compara_implementado_por"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_implementado_por"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(288,3332,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_implementado_por" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_implementado_por.findItem(htmlentities(document.getElementById('stext_implementado_por').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_implementado_por.findItem(htmlentities(document.getElementById('stext_implementado_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_implementado_por.findItem(htmlentities(document.getElementById('stext_implementado_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_implementado_por" height="90%"></div><input type="hidden" maxlength="255"  name="implementado_por" id="implementado_por"   value="" ><label style="display:none" class="error" for="implementado_por">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_implementado_por=new dhtmlXTreeObject("treeboxbox_implementado_por","100%","100%",0);
                			tree_implementado_por.setImagePath("../../imgs/");
                			tree_implementado_por.enableIEImageFix(true);tree_implementado_por.enableCheckBoxes(1);
                    tree_implementado_por.enableRadioButtons(true);tree_implementado_por.setOnLoadingStart(cargando_implementado_por);
                      tree_implementado_por.setOnLoadingEnd(fin_cargando_implementado_por);tree_implementado_por.enableSmartXMLParsing(true);tree_implementado_por.loadXML("../../test.php?rol=1");
                      tree_implementado_por.setOnCheckHandler(onNodeSelect_implementado_por);
                      function onNodeSelect_implementado_por(nodeId)
                      {valor_destino=document.getElementById("implementado_por");
                       destinos=tree_implementado_por.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_implementado_por.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_implementado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_implementado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_implementado_por")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_implementado_por"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_implementado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_implementado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_implementado_por")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_implementado_por"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_aprobacion_logistica" id="condicion_aprobacion_logistica"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">APROBACI&OACUTE;N LOG&IACUTE;STICA</td><td class="encabezado">&nbsp;<select name="compara_aprobacion_logistica" id="compara_aprobacion_logistica"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_aprobacion_logistica"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(288,3333,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_aprobacion_logistica" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_aprobacion_logistica.findItem(htmlentities(document.getElementById('stext_aprobacion_logistica').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_aprobacion_logistica.findItem(htmlentities(document.getElementById('stext_aprobacion_logistica').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_aprobacion_logistica.findItem(htmlentities(document.getElementById('stext_aprobacion_logistica').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_aprobacion_logistica" height="90%"></div><input type="hidden" maxlength="255"  name="aprobacion_logistica" id="aprobacion_logistica"   value="" ><label style="display:none" class="error" for="aprobacion_logistica">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_aprobacion_logistica=new dhtmlXTreeObject("treeboxbox_aprobacion_logistica","100%","100%",0);
                			tree_aprobacion_logistica.setImagePath("../../imgs/");
                			tree_aprobacion_logistica.enableIEImageFix(true);tree_aprobacion_logistica.enableCheckBoxes(1);
                    tree_aprobacion_logistica.enableRadioButtons(true);tree_aprobacion_logistica.setOnLoadingStart(cargando_aprobacion_logistica);
                      tree_aprobacion_logistica.setOnLoadingEnd(fin_cargando_aprobacion_logistica);tree_aprobacion_logistica.enableSmartXMLParsing(true);tree_aprobacion_logistica.loadXML("../../test.php?rol=1");
                      tree_aprobacion_logistica.setOnCheckHandler(onNodeSelect_aprobacion_logistica);
                      function onNodeSelect_aprobacion_logistica(nodeId)
                      {valor_destino=document.getElementById("aprobacion_logistica");
                       destinos=tree_aprobacion_logistica.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_aprobacion_logistica.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_aprobacion_logistica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobacion_logistica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobacion_logistica")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_aprobacion_logistica"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_aprobacion_logistica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobacion_logistica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobacion_logistica")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_aprobacion_logistica"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><input type="hidden" name="campo_descripcion" value="3325,3332,3334"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(288);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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