<html><title>.:BUSCAR 2. RESPUESTA PQRSF:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/>
			<script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script>
			<link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/>
			</head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 2. RESPUESTA PQRSF</td></tr><tr id="tr_expediente_serie"><td class="encabezado">&nbsp;<select name="condicion_expediente_serie" id="condicion_expediente_serie"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">EXPEDIENTE_SERIE</td><td class="encabezado">&nbsp;<select name="compara_expediente_serie" id="compara_expediente_serie"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="expediente_serie" name="expediente_serie"></select><script>
                     $(document).ready(function()
                      {
                      $("#expediente_serie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_destinos"><td class="encabezado">&nbsp;<select name="condicion_destinos" id="condicion_destinos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESTINOS</td><td class="encabezado">&nbsp;<select name="compara_destinos" id="compara_destinos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple    id="destinos" name="destinos"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function()
                      {
                      $("#destinos").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr id="tr_requiere_recogida"><td class="encabezado">&nbsp;<select name="condicion_requiere_recogida" id="condicion_requiere_recogida"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">REQUIERE RECOGIDA?</td><td class="encabezado">&nbsp;<select name="compara_requiere_recogida" id="compara_requiere_recogida"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(307,6627,'',1);?></td></tr><tr id="tr_copia"><td class="encabezado">&nbsp;<select name="condicion_copia" id="condicion_copia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Personas a quienes se les Envia Copia de la Carta">CON COPIA A</td><td class="encabezado">&nbsp;<select name="compara_copia" id="compara_copia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="2000"   id="copia" name="copia"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function()
                      {
                      $("#copia").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr id="tr_tipo_mensajeria"><td class="encabezado">&nbsp;<select name="condicion_tipo_mensajeria" id="condicion_tipo_mensajeria"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DE MENSAJER&Iacute;A</td><td class="encabezado">&nbsp;<select name="compara_tipo_mensajeria" id="compara_tipo_mensajeria"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(307,6629,'',1);?></td></tr><tr id="tr_asunto"><td class="encabezado">&nbsp;<select name="condicion_asunto" id="condicion_asunto"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ASUNTO</td><td class="encabezado">&nbsp;<select name="compara_asunto" id="compara_asunto"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="asunto" name="asunto"></select><script>
                     $(document).ready(function()
                      {
                      $("#asunto").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_contenido"><td class="encabezado">&nbsp;<select name="condicion_contenido" id="condicion_contenido"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONTENIDO</td><td class="encabezado">&nbsp;<select name="compara_contenido" id="compara_contenido"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="contenido" name="contenido"></select><script>
                     $(document).ready(function()
                      {
                      $("#contenido").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_copiainterna" id="condicion_copiainterna"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">CON COPIA INTERNA A</td><td class="encabezado">&nbsp;<select name="compara_copiainterna" id="compara_copiainterna"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_copiainterna"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(307,6633,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_copiainterna" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copiainterna.findItem((document.getElementById('stext_copiainterna').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copiainterna.findItem((document.getElementById('stext_copiainterna').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copiainterna.findItem((document.getElementById('stext_copiainterna').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_copiainterna" height="90%"></div><input type="hidden"  name="copiainterna" id="copiainterna"   value="" ><label style="display:none" class="error" for="copiainterna">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copiainterna=new dhtmlXTreeObject("treeboxbox_copiainterna","100%","100%",0);
                			tree_copiainterna.setImagePath("../../imgs/");
                			tree_copiainterna.enableIEImageFix(true);tree_copiainterna.enableCheckBoxes(1);
                			tree_copiainterna.enableThreeStateCheckboxes(1);tree_copiainterna.setOnLoadingStart(cargando_copiainterna);
                      tree_copiainterna.setOnLoadingEnd(fin_cargando_copiainterna);tree_copiainterna.enableSmartXMLParsing(true);tree_copiainterna.loadXML("../../test.php?rol=1");
                      tree_copiainterna.setOnCheckHandler(onNodeSelect_copiainterna);
                      function onNodeSelect_copiainterna(nodeId)
                      {valor_destino=document.getElementById("copiainterna");
                       destinos=tree_copiainterna.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_copiainterna.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_copiainterna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copiainterna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copiainterna")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copiainterna"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copiainterna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copiainterna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copiainterna")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copiainterna"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_anexos_digitales"><td class="encabezado">&nbsp;<select name="condicion_anexos_digitales" id="condicion_anexos_digitales"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><input type="hidden" name="campo_descripcion" value="6630"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(307);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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