<html><title>.:BUSCAR 2. PROYECTO:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 2. PROYECTO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_proyecto" id="condicion_nombre_proyecto"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE DEL PROYECTO</td><td class="encabezado">&nbsp;<select name="compara_nombre_proyecto" id="compara_nombre_proyecto"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_proyecto" name="nombre_proyecto"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_proyecto").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion" id="condicion_descripcion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N PROYECTO</td><td class="encabezado">&nbsp;<select name="compara_descripcion" id="compara_descripcion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion" name="descripcion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_empresa_asociada" id="condicion_empresa_asociada"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">EMPRESA ASOCIADA</td><td class="encabezado">&nbsp;<select name="compara_empresa_asociada" id="compara_empresa_asociada"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_empresa_asociada"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(250,2863,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_empresa_asociada" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_empresa_asociada.findItem(htmlentities(document.getElementById('stext_empresa_asociada').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_empresa_asociada.findItem(htmlentities(document.getElementById('stext_empresa_asociada').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_empresa_asociada.findItem(htmlentities(document.getElementById('stext_empresa_asociada').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_empresa_asociada" height="90%"></div><input type="hidden"  name="empresa_asociada" id="empresa_asociada"   value="" ><label style="display:none" class="error" for="empresa_asociada">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_empresa_asociada=new dhtmlXTreeObject("treeboxbox_empresa_asociada","100%","100%",0);
                			tree_empresa_asociada.setImagePath("../../imgs/");
                			tree_empresa_asociada.enableIEImageFix(true);tree_empresa_asociada.enableCheckBoxes(1);
                    tree_empresa_asociada.enableRadioButtons(true);tree_empresa_asociada.setOnLoadingStart(cargando_empresa_asociada);
                      tree_empresa_asociada.setOnLoadingEnd(fin_cargando_empresa_asociada);tree_empresa_asociada.enableSmartXMLParsing(true);tree_empresa_asociada.loadXML("../../test_serie.php?sin_padre=1&id=932&tabla=serie");
                      tree_empresa_asociada.setOnCheckHandler(onNodeSelect_empresa_asociada);
                      function onNodeSelect_empresa_asociada(nodeId)
                      {valor_destino=document.getElementById("empresa_asociada");
                       destinos=tree_empresa_asociada.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_empresa_asociada.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_empresa_asociada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_empresa_asociada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_empresa_asociada")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_empresa_asociada"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_empresa_asociada() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_empresa_asociada")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_empresa_asociada")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_empresa_asociada"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_moneda" id="condicion_moneda"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MONEDA DEL PROYECTO</td><td class="encabezado">&nbsp;<select name="compara_moneda" id="compara_moneda"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(250,2864,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor" id="condicion_valor"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR DEL PROYECTO</td><td class="encabezado">&nbsp;<select name="compara_valor" id="compara_valor"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor" name="valor"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_forma_pago" id="condicion_forma_pago"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FORMA DE PAGO</td><td class="encabezado">&nbsp;<select name="compara_forma_pago" id="compara_forma_pago"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="forma_pago" name="forma_pago"></select><script>
                     $(document).ready(function() 
                      {
                      $("#forma_pago").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_duracion" id="condicion_duracion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIEMPO DE DURACI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_duracion" id="compara_duracion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="duracion" name="duracion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#duracion").fcbkcomplete({
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
                    </tr><input type="hidden" name="campo_descripcion" value="2862"><?php submit_formato(250);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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