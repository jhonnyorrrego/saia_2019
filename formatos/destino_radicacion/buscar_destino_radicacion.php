<html><title>.:BUSCAR DESTINO_RADICACION:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA DESTINO_RADICACION</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_numero_item" id="condicion_numero_item"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NO. ITEM</td><td class="encabezado">&nbsp;<select name="compara_numero_item" id="compara_numero_item"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_item" name="numero_item"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_item").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_estado_item" id="condicion_estado_item"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ESTADO ITEM</td><td class="encabezado">&nbsp;<select name="compara_estado_item" id="compara_estado_item"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="estado_item" name="estado_item"></select><script>
                     $(document).ready(function() 
                      {
                      $("#estado_item").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_recepcion_fecha" id="condicion_recepcion_fecha"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA DE RECEPCION</td><td class="encabezado">&nbsp;<select name="compara_recepcion_fecha" id="compara_recepcion_fecha"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="recepcion_fecha" name="recepcion_fecha"></select><script>
                     $(document).ready(function() 
                      {
                      $("#recepcion_fecha").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_destino_externo" id="condicion_destino_externo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESTINO*</td><td class="encabezado">&nbsp;<select name="compara_destino_externo" id="compara_destino_externo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="destino_externo" name="destino_externo"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#destino_externo").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_origen_externo" id="condicion_origen_externo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ORIGEN*</td><td class="encabezado">&nbsp;<select name="compara_origen_externo" id="compara_origen_externo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="origen_externo" name="origen_externo"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#origen_externo").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_origen" id="condicion_nombre_origen"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">ORIGEN*</td><td class="encabezado">&nbsp;<select name="compara_nombre_origen" id="compara_nombre_origen"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_nombre_origen"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(403,4978,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_nombre_origen" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_nombre_origen.findItem(htmlentities(document.getElementById('stext_nombre_origen').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre_origen.findItem(htmlentities(document.getElementById('stext_nombre_origen').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_nombre_origen.findItem(htmlentities(document.getElementById('stext_nombre_origen').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_nombre_origen" height="90%"></div><input type="hidden" maxlength="255"  name="nombre_origen" id="nombre_origen"   value="" ><label style="display:none" class="error" for="nombre_origen">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre_origen=new dhtmlXTreeObject("treeboxbox_nombre_origen","100%","100%",0);
                			tree_nombre_origen.setImagePath("../../imgs/");
                			tree_nombre_origen.enableIEImageFix(true);tree_nombre_origen.enableCheckBoxes(1);
                    tree_nombre_origen.enableRadioButtons(true);tree_nombre_origen.setOnLoadingStart(cargando_nombre_origen);
                      tree_nombre_origen.setOnLoadingEnd(fin_cargando_nombre_origen);tree_nombre_origen.enableSmartXMLParsing(true);tree_nombre_origen.loadXML("../../test.php?sin_padre=1&rol=1");
                      tree_nombre_origen.setOnCheckHandler(onNodeSelect_nombre_origen);
                      function onNodeSelect_nombre_origen(nodeId)
                      {valor_destino=document.getElementById("nombre_origen");
                       destinos=tree_nombre_origen.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_nombre_origen.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_nombre_origen() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_origen")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_origen")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre_origen"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_nombre_origen() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_origen")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_origen")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre_origen"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_destino" id="condicion_nombre_destino"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">DESTINO*</td><td class="encabezado">&nbsp;<select name="compara_nombre_destino" id="compara_nombre_destino"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_nombre_destino"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(403,4972,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_nombre_destino" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_nombre_destino.findItem(htmlentities(document.getElementById('stext_nombre_destino').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre_destino.findItem(htmlentities(document.getElementById('stext_nombre_destino').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_nombre_destino.findItem(htmlentities(document.getElementById('stext_nombre_destino').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_nombre_destino" height="90%"></div><input type="hidden" maxlength="255"  name="nombre_destino" id="nombre_destino"   value="" ><label style="display:none" class="error" for="nombre_destino">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre_destino=new dhtmlXTreeObject("treeboxbox_nombre_destino","100%","100%",0);
                			tree_nombre_destino.setImagePath("../../imgs/");
                			tree_nombre_destino.enableIEImageFix(true);tree_nombre_destino.enableCheckBoxes(1);
                    tree_nombre_destino.enableRadioButtons(true);tree_nombre_destino.setOnLoadingStart(cargando_nombre_destino);
                      tree_nombre_destino.setOnLoadingEnd(fin_cargando_nombre_destino);tree_nombre_destino.enableSmartXMLParsing(true);tree_nombre_destino.loadXML("../../test.php?sin_padre=1&rol=1");
                      tree_nombre_destino.setOnCheckHandler(onNodeSelect_nombre_destino);
                      function onNodeSelect_nombre_destino(nodeId)
                      {valor_destino=document.getElementById("nombre_destino");
                       destinos=tree_nombre_destino.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_nombre_destino.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_nombre_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_destino")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre_destino"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_nombre_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_destino")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre_destino"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_observacion_destino" id="condicion_observacion_destino"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_observacion_destino" id="compara_observacion_destino"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observacion_destino" name="observacion_destino"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observacion_destino").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_recepcion" id="condicion_recepcion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RECEPCION</td><td class="encabezado">&nbsp;<select name="compara_recepcion" id="compara_recepcion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="recepcion" name="recepcion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#recepcion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_mensajero_encargado" id="condicion_mensajero_encargado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MENSAJERO</td><td class="encabezado">&nbsp;<select name="compara_mensajero_encargado" id="compara_mensajero_encargado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="mensajero_encargado" name="mensajero_encargado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#mensajero_encargado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_destino" id="condicion_tipo_destino"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO_DESTINO</td><td class="encabezado">&nbsp;<select name="compara_tipo_destino" id="compara_tipo_destino"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="tipo_destino" name="tipo_destino"></select><script>
                     $(document).ready(function() 
                      {
                      $("#tipo_destino").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_origen" id="condicion_tipo_origen"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO_ORIGEN</td><td class="encabezado">&nbsp;<select name="compara_tipo_origen" id="compara_tipo_origen"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="tipo_origen" name="tipo_origen"></select><script>
                     $(document).ready(function() 
                      {
                      $("#tipo_origen").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="destino_radicacion"><?php submit_formato(403);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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