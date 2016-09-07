<html><title>.:BUSCAR F. ACTA DE EVALUACI&OACUTE;N:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA F. ACTA DE EVALUACI&Oacute;N</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_evaluacion_tecnica" id="condicion_evaluacion_tecnica"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">EVALUACI&Oacute;N T&Eacute;CNICA</td><td class="encabezado">&nbsp;<select name="compara_evaluacion_tecnica" id="compara_evaluacion_tecnica"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="evaluacion_tecnica" name="evaluacion_tecnica"></select><script>
                     $(document).ready(function() 
                      {
                      $("#evaluacion_tecnica").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_evaluacion_economica" id="condicion_evaluacion_economica"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">EVALUACI&Oacute;N ECON&Oacute;MICA</td><td class="encabezado">&nbsp;<select name="compara_evaluacion_economica" id="compara_evaluacion_economica"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="evaluacion_economica" name="evaluacion_economica"></select><script>
                     $(document).ready(function() 
                      {
                      $("#evaluacion_economica").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexo_tecnica" id="condicion_anexo_tecnica"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXAR EVALUACI&Oacute;N T&Eacute;CNICA</td><td class="encabezado">&nbsp;<select name="compara_anexo_tecnica" id="compara_anexo_tecnica"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexo_tecnica" name="anexo_tecnica"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexo_tecnica").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_proponentes" id="condicion_proponentes"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">PROPONENTES QUE NO CUMPLEN</td><td class="encabezado">&nbsp;<select name="compara_proponentes" id="compara_proponentes"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_proponentes"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(402,4736,'',$_REQUEST['iddoc']);?></div>
                          <br />  <div id="treeboxbox_proponentes" height="90%"></div><input type="hidden" maxlength="11"  name="proponentes" id="proponentes"   value="" ><label style="display:none" class="error" for="proponentes">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_proponentes=new dhtmlXTreeObject("treeboxbox_proponentes","100%","100%",0);
                			tree_proponentes.setImagePath("../../imgs/");
                			tree_proponentes.enableIEImageFix(true);tree_proponentes.setOnLoadingStart(cargando_proponentes);
                      tree_proponentes.setOnLoadingEnd(fin_cargando_proponentes);tree_proponentes.setXMLAutoLoading("{*proponentes_informacio*}");tree_proponentes.loadXML("{*proponentes_informacio*}");
                      tree_proponentes.setOnCheckHandler(onNodeSelect_proponentes);
                      function onNodeSelect_proponentes(nodeId)
                      {valor_destino=document.getElementById("proponentes");
                       destinos=tree_proponentes.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_proponentes.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_proponentes() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_proponentes")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_proponentes")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_proponentes"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_proponentes() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_proponentes")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_proponentes")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_proponentes"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexo_economica" id="condicion_anexo_economica"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS EVALUACI&Oacute;N ECON&Oacute;MICA</td><td class="encabezado">&nbsp;<select name="compara_anexo_economica" id="compara_anexo_economica"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexo_economica" name="anexo_economica"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexo_economica").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_proponente_recomenda" id="condicion_proponente_recomenda"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PROPONENTE RECOMENDADO</td><td class="encabezado">&nbsp;<select name="compara_proponente_recomenda" id="compara_proponente_recomenda"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(402,4735,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_gerente" id="condicion_gerente"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">GERENTE DEL &AACUTE;REA</td><td class="encabezado">&nbsp;<select name="compara_gerente" id="compara_gerente"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_gerente"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(402,4727,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_gerente" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_gerente.findItem(htmlentities(document.getElementById('stext_gerente').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_gerente.findItem(htmlentities(document.getElementById('stext_gerente').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_gerente.findItem(htmlentities(document.getElementById('stext_gerente').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_gerente" height="90%"></div><input type="hidden" maxlength="11"  name="gerente" id="gerente"   value="" ><label style="display:none" class="error" for="gerente">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_gerente=new dhtmlXTreeObject("treeboxbox_gerente","100%","100%",0);
                			tree_gerente.setImagePath("../../imgs/");
                			tree_gerente.enableIEImageFix(true);tree_gerente.enableCheckBoxes(1);
                    tree_gerente.enableRadioButtons(true);tree_gerente.setOnLoadingStart(cargando_gerente);
                      tree_gerente.setOnLoadingEnd(fin_cargando_gerente);tree_gerente.enableSmartXMLParsing(true);tree_gerente.loadXML("../../test.php?sin_padre=1");
                      tree_gerente.setOnCheckHandler(onNodeSelect_gerente);
                      function onNodeSelect_gerente(nodeId)
                      {valor_destino=document.getElementById("gerente");
                       destinos=tree_gerente.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_gerente.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_gerente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gerente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gerente")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_gerente"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_gerente() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gerente")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gerente")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_gerente"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexar_acta" id="condicion_anexar_acta"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXAR ACTA DE EVALUACI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_anexar_acta" id="compara_anexar_acta"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexar_acta" name="anexar_acta"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexar_acta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="4727"><?php submit_formato(402);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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