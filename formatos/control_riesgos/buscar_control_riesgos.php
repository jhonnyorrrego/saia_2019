<html><title>.:BUSCAR 1. VALORACION CONTROLES RIESGOS:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 1. VALORACION CONTROLES RIESGOS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_consecutivo_control" id="condicion_consecutivo_control"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONSECUTIVO</td><td class="encabezado">&nbsp;<select name="compara_consecutivo_control" id="compara_consecutivo_control"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="consecutivo_control" name="consecutivo_control"></select><script>
                     $(document).ready(function() 
                      {
                      $("#consecutivo_control").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_valoracion" id="condicion_fecha_valoracion"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA VALORACION</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_valoracion_1" id="fecha_valoracion_1" tipo="fecha" value=""><?php selector_fecha("fecha_valoracion_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_valoracion_2" id="fecha_valoracion_2" tipo="fecha" value=""><?php selector_fecha("fecha_valoracion_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_control" id="condicion_descripcion_control"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Descripci&oacute;n del control existente:

Hacer una descripci&oacute;n en  forma detallada del control Existente que se tiene implementado.">DESCRIPCION DEL CONTROL EXISTENTE</td><td class="encabezado">&nbsp;<select name="compara_descripcion_control" id="compara_descripcion_control"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_control" name="descripcion_control"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_control").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_control" id="condicion_tipo_control"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Los controles luego de su valoraci&oacute;n permiten desplazarse en la matriz, de acuerdo a si afecta probabilidad o impacto, en el caso de la probabilidad desplazar&iacute;a casillas hacia arriba y en el caso del impacto, hacia la izquierda de acuerdo a la valoraci&oacute;n de controles.
Es por ello que se debe seleccionar si el control existente me permite disminuir el nivel de probabilidad o el nivel de impacto.">EL CONTROL AFECTA?</td><td class="encabezado">&nbsp;<select name="compara_tipo_control" id="compara_tipo_control"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(274,3115,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_desplazamiento" id="condicion_desplazamiento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESPLAZAMIENTO EN LA MATRIZ</td><td class="encabezado">&nbsp;<select name="compara_desplazamiento" id="compara_desplazamiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="desplazamiento" name="desplazamiento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#desplazamiento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">HERRAMIENTAS PARA EJERCER EL CONTROL</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="herramientas_ejercer" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_herramienta_ejercer" id="condicion_herramienta_ejercer"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">1. POSEE UNA HERRAMIENTA PARA EJERCER EL CONTROL?</td><td class="encabezado">&nbsp;<select name="compara_herramienta_ejercer" id="compara_herramienta_ejercer"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(274,3120,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_desc_herramienta" id="condicion_desc_herramienta"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DE LA HERRAMIENTA</td><td class="encabezado">&nbsp;<select name="compara_desc_herramienta" id="compara_desc_herramienta"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="desc_herramienta" name="desc_herramienta"></select><script>
                     $(document).ready(function() 
                      {
                      $("#desc_herramienta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexar_herramienta" id="condicion_anexar_herramienta"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXAR HERRAMIENTA</td><td class="encabezado">&nbsp;<select name="compara_anexar_herramienta" id="compara_anexar_herramienta"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexar_herramienta" name="anexar_herramienta"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexar_herramienta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_procedimiento_herram" id="condicion_procedimiento_herram"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">2. EXISTEN MANUALES, INSTRUCTIVOS O PROCEDIMIENTOS PARA EL MANEJO DE LA HERRAMIENTA?</td><td class="encabezado">&nbsp;<select name="compara_procedimiento_herram" id="compara_procedimiento_herram"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(274,3123,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_desc_documento" id="condicion_desc_documento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N DEL DOCUMENTO</td><td class="encabezado">&nbsp;<select name="compara_desc_documento" id="compara_desc_documento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="desc_documento" name="desc_documento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#desc_documento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_anexar_documento" id="condicion_anexar_documento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXAR DOCUMENTO</td><td class="encabezado">&nbsp;<select name="compara_anexar_documento" id="compara_anexar_documento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexar_documento" name="anexar_documento"></select><script>
                     $(document).ready(function() 
                      {
                      $("#anexar_documento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_herramienta_efectiva" id="condicion_herramienta_efectiva"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">3. EN EL TIEMPO QUE LLEVA LA HERRAMIENTA, HA DEMOSTRADO SER EFECTIVA?</td><td class="encabezado">&nbsp;<select name="compara_herramienta_efectiva" id="compara_herramienta_efectiva"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(274,3126,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_pregunta_porque" id="condicion_pregunta_porque"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">POR QU&Eacute;?</td><td class="encabezado">&nbsp;<select name="compara_pregunta_porque" id="compara_pregunta_porque"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="pregunta_porque" name="pregunta_porque"></select><script>
                     $(document).ready(function() 
                      {
                      $("#pregunta_porque").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">SEGUIMIENTO AL CONTROL</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="seguimiento_al_contr" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_responsables_ejecuci" id="condicion_responsables_ejecuci"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">4. ESTAN DEFINIDOS LOS RESPONSABLES DE LA EJECUCION DEL CONTROL Y DEL SEGUIMIENTO?</td><td class="encabezado">&nbsp;<select name="compara_responsables_ejecuci" id="compara_responsables_ejecuci"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(274,3129,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_responsable_seg" id="condicion_responsable_seg"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">QUIEN ES EL RESPONSABLES DE LA EJECUCI&OACUTE;N DEL CONTROL</td><td class="encabezado">&nbsp;<select name="compara_responsable_seg" id="compara_responsable_seg"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_responsable_seg"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(274,3130,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_responsable_seg" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable_seg.findItem(htmlentities(document.getElementById('stext_responsable_seg').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable_seg.findItem(htmlentities(document.getElementById('stext_responsable_seg').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable_seg.findItem(htmlentities(document.getElementById('stext_responsable_seg').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_responsable_seg" height="90%"></div><input type="hidden" maxlength="255"  name="responsable_seg" id="responsable_seg"   value="" ><label style="display:none" class="error" for="responsable_seg">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable_seg=new dhtmlXTreeObject("treeboxbox_responsable_seg","100%","100%",0);
                			tree_responsable_seg.setImagePath("../../imgs/");
                			tree_responsable_seg.enableIEImageFix(true);tree_responsable_seg.enableCheckBoxes(1);
                			tree_responsable_seg.enableThreeStateCheckboxes(1);tree_responsable_seg.setOnLoadingStart(cargando_responsable_seg);
                      tree_responsable_seg.setOnLoadingEnd(fin_cargando_responsable_seg);tree_responsable_seg.enableSmartXMLParsing(true);tree_responsable_seg.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_responsable_seg.setOnCheckHandler(onNodeSelect_responsable_seg);
                      function onNodeSelect_responsable_seg(nodeId)
                      {valor_destino=document.getElementById("responsable_seg");
                       destinos=tree_responsable_seg.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_responsable_seg.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_responsable_seg() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_seg")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_seg")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable_seg"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_responsable_seg() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_seg")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_seg")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable_seg"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_respon_seguimiento" id="condicion_respon_seguimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">QUIEN ES EL RESPONSABLES DE LA EJECUCI&OACUTE;N DEL SEGUIMIENTO</td><td class="encabezado">&nbsp;<select name="compara_respon_seguimiento" id="compara_respon_seguimiento"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_respon_seguimiento"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(274,3131,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_respon_seguimiento" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_respon_seguimiento.findItem(htmlentities(document.getElementById('stext_respon_seguimiento').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_respon_seguimiento.findItem(htmlentities(document.getElementById('stext_respon_seguimiento').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_respon_seguimiento.findItem(htmlentities(document.getElementById('stext_respon_seguimiento').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_respon_seguimiento" height="90%"></div><input type="hidden" maxlength="255"  name="respon_seguimiento" id="respon_seguimiento"   value="" ><label style="display:none" class="error" for="respon_seguimiento">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_respon_seguimiento=new dhtmlXTreeObject("treeboxbox_respon_seguimiento","100%","100%",0);
                			tree_respon_seguimiento.setImagePath("../../imgs/");
                			tree_respon_seguimiento.enableIEImageFix(true);tree_respon_seguimiento.enableCheckBoxes(1);
                			tree_respon_seguimiento.enableThreeStateCheckboxes(1);tree_respon_seguimiento.setOnLoadingStart(cargando_respon_seguimiento);
                      tree_respon_seguimiento.setOnLoadingEnd(fin_cargando_respon_seguimiento);tree_respon_seguimiento.enableSmartXMLParsing(true);tree_respon_seguimiento.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_respon_seguimiento.setOnCheckHandler(onNodeSelect_respon_seguimiento);
                      function onNodeSelect_respon_seguimiento(nodeId)
                      {valor_destino=document.getElementById("respon_seguimiento");
                       destinos=tree_respon_seguimiento.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_respon_seguimiento.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_respon_seguimiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_respon_seguimiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_respon_seguimiento")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_respon_seguimiento"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_respon_seguimiento() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_respon_seguimiento")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_respon_seguimiento")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_respon_seguimiento"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_frecuencia_ejecucion" id="condicion_frecuencia_ejecucion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">5. LA FRECUENCIA DE LA EJECUCION DEL CONTROL Y SEGUIMIENTO ES ADECUADO?</td><td class="encabezado">&nbsp;<select name="compara_frecuencia_ejecucion" id="compara_frecuencia_ejecucion"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(274,3132,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_cual_frecuencia" id="condicion_cual_frecuencia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CUAL ES LA FRECUENCIA</td><td class="encabezado">&nbsp;<select name="compara_cual_frecuencia" id="compara_cual_frecuencia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cual_frecuencia" name="cual_frecuencia"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cual_frecuencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3114"><?php submit_formato(274);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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