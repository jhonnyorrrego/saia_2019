<html><title>.:BUSCAR PRUEBA FORMATO 2:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA PRUEBA FORMATO 2</td></tr><tr id="tr_radio"><td class="encabezado">&nbsp;<select name="condicion_radio" id="condicion_radio"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RADIO</td><td class="encabezado">&nbsp;<select name="compara_radio" id="compara_radio"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(329,3848,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_lista" id="condicion_lista"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">LISTA</td><td class="encabezado">&nbsp;<select name="compara_lista" id="compara_lista"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(329,3849,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_remitente" id="condicion_remitente"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">REMITENTE</td><td class="encabezado">&nbsp;<select name="compara_remitente" id="compara_remitente"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="remitente" name="remitente"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#remitente").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_arbol" id="condicion_arbol"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">ARBOL</td><td class="encabezado">&nbsp;<select name="compara_arbol" id="compara_arbol"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_arbol"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(329,3857,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_arbol" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_arbol.findItem(htmlentities(document.getElementById('stext_arbol').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_arbol.findItem(htmlentities(document.getElementById('stext_arbol').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_arbol.findItem(htmlentities(document.getElementById('stext_arbol').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_arbol" height="90%"></div><input type="hidden" maxlength="255"  name="arbol" id="arbol"   value="" ><label style="display:none" class="error" for="arbol">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_arbol=new dhtmlXTreeObject("treeboxbox_arbol","100%","100%",0);
                			tree_arbol.setImagePath("../../imgs/");
                			tree_arbol.enableIEImageFix(true);tree_arbol.enableCheckBoxes(1);
                    tree_arbol.enableRadioButtons(true);tree_arbol.setOnLoadingStart(cargando_arbol);
                      tree_arbol.setOnLoadingEnd(fin_cargando_arbol);tree_arbol.enableSmartXMLParsing(true);tree_arbol.loadXML("../../test.php?rol=1");
                      tree_arbol.setOnCheckHandler(onNodeSelect_arbol);
                      function onNodeSelect_arbol(nodeId)
                      {valor_destino=document.getElementById("arbol");
                       destinos=tree_arbol.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_arbol.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_arbol() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_arbol")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_arbol")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_arbol"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_arbol() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_arbol")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_arbol")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_arbol"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexo" id="condicion_anexo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXO</td><td class="encabezado">&nbsp;<select name="compara_anexo" id="compara_anexo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexo" name="anexo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><?php submit_formato(329);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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