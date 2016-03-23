<html><title>.:BUSCAR SALIDA:.</title><head><?php include_once("../../calendario/calendario.php"); ?><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA SALIDA</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_radicacion_entrada" id="condicion_fecha_radicacion_entrada"><option value="AND">Y</option><option value="OR">O</option></td>
                    <td class="encabezado" width="20%" title="">FECHA DE RADICACION</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_radicacion_entrada_1"  id="fecha_radicacion_entrada_1" value=""><?php selector_fecha("fecha_radicacion_entrada_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_radicacion_entrada_2"  id="fecha_radicacion_entrada_2" value=""><?php selector_fecha("fecha_radicacion_entrada_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_numero_radicado" id="condicion_numero_radicado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NUMERO DE RADICADO</td><td class="encabezado">&nbsp;<select name="compara_numero_radicado" id="compara_numero_radicado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_radicado" name="numero_radicado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_radicado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_area_responsable" id="condicion_area_responsable"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">FUNCIONARIO RESPONSABLE</td><td class="encabezado">&nbsp;<select name="compara_area_responsable" id="compara_area_responsable"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_area_responsable"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(207,2196,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_area_responsable" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem(htmlentities(document.getElementById('stext_area_responsable').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem(htmlentities(document.getElementById('stext_area_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_area_responsable.findItem(htmlentities(document.getElementById('stext_area_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_area_responsable" height="90%"></div><input type="hidden" maxlength="255"  name="area_responsable" id="area_responsable"   value="" ><label style="display:none" class="error" for="area_responsable">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_area_responsable=new dhtmlXTreeObject("treeboxbox_area_responsable","100%","100%",0);
                			tree_area_responsable.setImagePath("../../imgs/");
                			tree_area_responsable.enableIEImageFix(true);tree_area_responsable.enableCheckBoxes(1);
                			tree_area_responsable.enableThreeStateCheckboxes(1);tree_area_responsable.setOnLoadingStart(cargando_area_responsable);
                      tree_area_responsable.setOnLoadingEnd(fin_cargando_area_responsable);tree_area_responsable.enableSmartXMLParsing(true);tree_area_responsable.loadXML("../../test.php?rol=1");
                      tree_area_responsable.setOnCheckHandler(onNodeSelect_area_responsable);
                      function onNodeSelect_area_responsable(nodeId)
                      {valor_destino=document.getElementById("area_responsable");
                       destinos=tree_area_responsable.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_area_responsable.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_area_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsable")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_area_responsable"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_area_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsable")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_area_responsable"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_persona_natural" id="condicion_persona_natural"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PERSONA NATURAL O JUR&Iacute;DICA</td><td class="encabezado">&nbsp;<select name="compara_persona_natural" id="compara_persona_natural"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="persona_natural" name="persona_natural"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#persona_natural").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_salida" id="condicion_descripcion_salida"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCION O ASUNTO</td><td class="encabezado">&nbsp;<select name="compara_descripcion_salida" id="compara_descripcion_salida"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_salida" name="descripcion_salida"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_salida").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_num_folios" id="condicion_num_folios"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NUMERO DE FOLIOS</td><td class="encabezado">&nbsp;<select name="compara_num_folios" id="compara_num_folios"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="num_folios" name="num_folios"></select><script>
                     $(document).ready(function() 
                      {
                      $("#num_folios").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexos_fisicos" id="condicion_anexos_fisicos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS FISICOS</td><td class="encabezado">&nbsp;<select name="compara_anexos_fisicos" id="compara_anexos_fisicos"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(207,2189,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_anexos" id="condicion_descripcion_anexos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCION ANEXOS FISICOS</td><td class="encabezado">&nbsp;<select name="compara_descripcion_anexos" id="compara_descripcion_anexos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_anexos" name="descripcion_anexos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_mensajeria"><td class="encabezado">&nbsp;<select name="condicion_tipo_mensajeria" id="condicion_tipo_mensajeria"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DE MENSAJERIA</td><td class="encabezado">&nbsp;<select name="compara_tipo_mensajeria" id="compara_tipo_mensajeria"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(207,2202,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_mensajeros" id="condicion_mensajeros"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MENSAJEROS</td><td class="encabezado">&nbsp;<select name="compara_mensajeros" id="compara_mensajeros"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="mensajeros" name="mensajeros"></select><script>
                     $(document).ready(function() 
                      {
                      $("#mensajeros").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_estado_radicado" id="condicion_estado_radicado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="1:Aprobado
2:Iniciado">ESTADO DE RADICADO</td><td class="encabezado">&nbsp;<select name="compara_estado_radicado" id="compara_estado_radicado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="estado_radicado" name="estado_radicado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#estado_radicado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="2191"><?php submit_formato(207);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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