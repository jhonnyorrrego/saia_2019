<html><title>.:BUSCAR CARTA DE RESPUESTA A LA PQR:.</title><head><?php include_once("../../calendario/calendario.php"); ?><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA CARTA DE RESPUESTA A LA PQR</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_firma_externa" id="condicion_firma_externa"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FIRMA_EXTERNA</td><td class="encabezado">&nbsp;<select name="compara_firma_externa" id="compara_firma_externa"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="firma_externa" name="firma_externa"></select><script>
                     $(document).ready(function() 
                      {
                      $("#firma_externa").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_carta_respuesta" id="condicion_fecha_carta_respuesta"><option value="AND">Y</option><option value="OR">O</option></td>
                    <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_carta_respuesta_1"  id="fecha_carta_respuesta_1" value=""><?php selector_fecha("fecha_carta_respuesta_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_carta_respuesta_2"  id="fecha_carta_respuesta_2" value=""><?php selector_fecha("fecha_carta_respuesta_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_destinos" id="condicion_destinos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESTINOS</td><td class="encabezado">&nbsp;<select name="compara_destinos" id="compara_destinos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="destinos" name="destinos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#destinos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_copia" id="condicion_copia"><option value="AND">Y</option><option value="OR">O</option></td>
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
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_asunto" id="condicion_asunto"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_saludo" id="condicion_saludo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SALUDO</td><td class="encabezado">&nbsp;<select name="compara_saludo" id="compara_saludo"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(212,2264,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_contenido" id="condicion_contenido"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_despedida" id="condicion_despedida"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Despedida de la Carta, Atentamente, Cordialmente, ...">DESPEDIDA</td><td class="encabezado">&nbsp;<select name="compara_despedida" id="compara_despedida"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="despedida" name="despedida"></select><script>
                     $(document).ready(function() 
                      {
                      $("#despedida").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_copia_interna" id="condicion_copia_interna"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">CON COPIA INTERNA A</td><td class="encabezado">&nbsp;<select name="compara_copia_interna" id="compara_copia_interna"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_copia_interna"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(212,2255,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_copia_interna" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia_interna.findItem(htmlentities(document.getElementById('stext_copia_interna').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_interna.findItem(htmlentities(document.getElementById('stext_copia_interna').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia_interna.findItem(htmlentities(document.getElementById('stext_copia_interna').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_copia_interna" height="90%"></div><input type="hidden" maxlength="2000"  name="copia_interna" id="copia_interna"   value="" ><label style="display:none" class="error" for="copia_interna">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_interna=new dhtmlXTreeObject("treeboxbox_copia_interna","100%","100%",0);
                			tree_copia_interna.setImagePath("../../imgs/");
                			tree_copia_interna.enableIEImageFix(true);tree_copia_interna.enableCheckBoxes(1);
                			tree_copia_interna.enableThreeStateCheckboxes(1);tree_copia_interna.setOnLoadingStart(cargando_copia_interna);
                      tree_copia_interna.setOnLoadingEnd(fin_cargando_copia_interna);tree_copia_interna.enableSmartXMLParsing(true);tree_copia_interna.loadXML("../../test.php");
                      tree_copia_interna.setOnCheckHandler(onNodeSelect_copia_interna);
                      function onNodeSelect_copia_interna(nodeId)
                      {valor_destino=document.getElementById("copia_interna");
                       destinos=tree_copia_interna.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_copia_interna.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_copia_interna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_interna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_interna")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_interna"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia_interna() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_interna")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_interna")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_interna"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_iniciales" id="condicion_iniciales"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Persona que Genera la Carta ">PERSONA QUE GENERA LA CARTA</td><td class="encabezado">&nbsp;<select name="compara_iniciales" id="compara_iniciales"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="iniciales" name="iniciales"></select><script>
                     $(document).ready(function() 
                      {
                      $("#iniciales").fcbkcomplete({
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
                    </tr><input type="hidden" name="campo_descripcion" value="2252"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(212);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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