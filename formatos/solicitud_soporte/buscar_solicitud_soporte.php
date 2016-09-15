<html><title>.:BUSCAR SOLICITUD DE SOPORTE:.</title><head><?php include_once("../../calendario/calendario.php"); ?><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA SOLICITUD DE SOPORTE</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_arbol_funs" id="condicion_arbol_funs"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">ARBOL DE FUNCIONARIOS</td><td class="encabezado">&nbsp;<select name="compara_arbol_funs" id="compara_arbol_funs"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_arbol_funs"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(218,4792,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_arbol_funs" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_arbol_funs.findItem(htmlentities(document.getElementById('stext_arbol_funs').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_arbol_funs.findItem(htmlentities(document.getElementById('stext_arbol_funs').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_arbol_funs.findItem(htmlentities(document.getElementById('stext_arbol_funs').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_arbol_funs" height="90%"></div><input type="hidden" maxlength="11"  name="arbol_funs" id="arbol_funs"   value="" ><label style="display:none" class="error" for="arbol_funs">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_arbol_funs=new dhtmlXTreeObject("treeboxbox_arbol_funs","100%","100%",0);
                			tree_arbol_funs.setImagePath("../../imgs/");
                			tree_arbol_funs.enableIEImageFix(true);tree_arbol_funs.enableCheckBoxes(1);
                    tree_arbol_funs.enableRadioButtons(true);tree_arbol_funs.setOnLoadingStart(cargando_arbol_funs);
                      tree_arbol_funs.setOnLoadingEnd(fin_cargando_arbol_funs);tree_arbol_funs.enableSmartXMLParsing(true);tree_arbol_funs.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_arbol_funs.setOnCheckHandler(onNodeSelect_arbol_funs);
                      function onNodeSelect_arbol_funs(nodeId)
                      {valor_destino=document.getElementById("arbol_funs");
                       destinos=tree_arbol_funs.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_arbol_funs.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_arbol_funs() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_arbol_funs")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_arbol_funs")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_arbol_funs"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_arbol_funs() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_arbol_funs")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_arbol_funs")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_arbol_funs"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_soporte" id="condicion_fecha_soporte"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA SOLICITUD</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_soporte_1" id="fecha_soporte_1" tipo="fecha" value=""><?php selector_fecha("fecha_soporte_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_soporte_2" id="fecha_soporte_2" tipo="fecha" value=""><?php selector_fecha("fecha_soporte_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_solitud" id="condicion_tipo_solitud"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">TIPO DE SOLICITUD</td><td class="encabezado">&nbsp;<select name="compara_tipo_solitud" id="compara_tipo_solitud"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_tipo_solitud"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(218,2333,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_tipo_solitud" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_tipo_solitud.findItem(htmlentities(document.getElementById('stext_tipo_solitud').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_tipo_solitud.findItem(htmlentities(document.getElementById('stext_tipo_solitud').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_tipo_solitud.findItem(htmlentities(document.getElementById('stext_tipo_solitud').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_tipo_solitud" height="90%"></div><input type="hidden" maxlength="255"  name="tipo_solitud" id="tipo_solitud"   value="" ><label style="display:none" class="error" for="tipo_solitud">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_tipo_solitud=new dhtmlXTreeObject("treeboxbox_tipo_solitud","100%","100%",0);
                			tree_tipo_solitud.setImagePath("../../imgs/");
                			tree_tipo_solitud.enableIEImageFix(true);tree_tipo_solitud.enableCheckBoxes(1);
                    tree_tipo_solitud.enableRadioButtons(true);tree_tipo_solitud.setOnLoadingStart(cargando_tipo_solitud);
                      tree_tipo_solitud.setOnLoadingEnd(fin_cargando_tipo_solitud);tree_tipo_solitud.enableSmartXMLParsing(true);tree_tipo_solitud.loadXML("../../test_serie_funcionario.php?categoria=3&id=884");
                      tree_tipo_solitud.setOnCheckHandler(onNodeSelect_tipo_solitud);
                      function onNodeSelect_tipo_solitud(nodeId)
                      {valor_destino=document.getElementById("tipo_solitud");
                       destinos=tree_tipo_solitud.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_tipo_solitud.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_tipo_solitud() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_solitud")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_solitud")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_tipo_solitud"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_tipo_solitud() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_tipo_solitud")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_tipo_solitud")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_tipo_solitud"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_prioridad"><td class="encabezado">&nbsp;<select name="condicion_prioridad" id="condicion_prioridad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PRIORIDAD</td><td class="encabezado">&nbsp;<select name="compara_prioridad" id="compara_prioridad"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(218,2553,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion" id="condicion_descripcion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_descripcion" id="compara_descripcion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion" name="descripcion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexos" id="condicion_anexos"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><input type="hidden" name="campo_descripcion" value="2330"><?php submit_formato(218);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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