<html><title>.:BUSCAR NOVEDADES:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA NOVEDADES</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_creacion" id="condicion_fecha_creacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA CREACION</td><td class="encabezado">&nbsp;<select name="compara_fecha_creacion" id="compara_fecha_creacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_creacion" name="fecha_creacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#fecha_creacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_destinos" id="condicion_destinos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESTINOS</td><td class="encabezado">&nbsp;<select name="compara_destinos" id="compara_destinos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="2000"   id="destinos" name="destinos"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#destinos").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_copia" id="condicion_copia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CON COPIA A</td><td class="encabezado">&nbsp;<select name="compara_copia" id="compara_copia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
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
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_despedida" id="condicion_despedida"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESPEDIDA</td><td class="encabezado">&nbsp;<select name="compara_despedida" id="compara_despedida"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="despedida" name="despedida"></select><script>
                     $(document).ready(function() 
                      {
                      $("#despedida").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_copiainterna" id="condicion_copiainterna"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">CON COPIA INTERNA A</td><td class="encabezado">&nbsp;<select name="compara_copiainterna" id="compara_copiainterna"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_copiainterna"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(270,3088,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_copiainterna" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copiainterna.findItem(htmlentities(document.getElementById('stext_copiainterna').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copiainterna.findItem(htmlentities(document.getElementById('stext_copiainterna').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copiainterna.findItem(htmlentities(document.getElementById('stext_copiainterna').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_copiainterna" height="90%"></div><input type="hidden" maxlength="2000"  name="copiainterna" id="copiainterna"   value="" ><label style="display:none" class="error" for="copiainterna">Campo obligatorio.</label><script type="text/javascript">
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
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexos_fisicos" id="condicion_anexos_fisicos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXO FISICOS</td><td class="encabezado">&nbsp;<select name="compara_anexos_fisicos" id="compara_anexos_fisicos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexos_fisicos" name="anexos_fisicos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexos_fisicos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_mensajeria" id="condicion_tipo_mensajeria"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DE MENSAJERIA</td><td class="encabezado">&nbsp;<select name="compara_tipo_mensajeria" id="compara_tipo_mensajeria"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(270,3097,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_vercopiainterna" id="condicion_vercopiainterna"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VISIBLE LA COPIA INTERNA</td><td class="encabezado">&nbsp;<select name="compara_vercopiainterna" id="compara_vercopiainterna"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(270,3096,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_iniciales" id="condicion_iniciales"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TRANSCRIPTOR</td><td class="encabezado">&nbsp;<select name="compara_iniciales" id="compara_iniciales"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
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
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_varios_radicados" id="condicion_varios_radicados"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CREAR UN RADICADO DIFERENTE PARA CADA DESTINO</td><td class="encabezado">&nbsp;<select name="compara_varios_radicados" id="compara_varios_radicados"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(270,3095,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_firma" id="condicion_firma"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MOSTRAR FIRMAS DIGITALIZADA</td><td class="encabezado">&nbsp;<select name="compara_firma" id="compara_firma"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(270,3092,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_saludo" id="condicion_saludo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SALUDO</td><td class="encabezado">&nbsp;<select name="compara_saludo" id="compara_saludo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="saludo" name="saludo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#saludo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_codigo" id="condicion_codigo"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><input type="hidden" name="campo_descripcion" value="3084"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(270);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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