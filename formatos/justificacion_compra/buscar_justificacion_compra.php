<html><title>.:BUSCAR JUSTIFICACI&OACUTE;N DE COMPRA:.</title><head><?php include_once("../../calendario/calendario.php"); ?><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA JUSTIFICACI&Oacute;N DE COMPRA</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_justificacion_compra" id="condicion_fecha_justificacion_compra"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_justificacion_compra_1" id="fecha_justificacion_compra_1" tipo="fecha" value=""><?php selector_fecha("fecha_justificacion_compra_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_justificacion_compra_2" id="fecha_justificacion_compra_2" tipo="fecha" value=""><?php selector_fecha("fecha_justificacion_compra_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_solicitante" id="condicion_nombre_solicitante"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">NOMBRE DEL SOLICITANTE</td><td class="encabezado">&nbsp;<select name="compara_nombre_solicitante" id="compara_nombre_solicitante"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_nombre_solicitante"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(296,3461,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_nombre_solicitante" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_nombre_solicitante.findItem(htmlentities(document.getElementById('stext_nombre_solicitante').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre_solicitante.findItem(htmlentities(document.getElementById('stext_nombre_solicitante').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_nombre_solicitante.findItem(htmlentities(document.getElementById('stext_nombre_solicitante').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_nombre_solicitante" height="90%"></div><input type="hidden"  name="nombre_solicitante" id="nombre_solicitante"   value="" ><label style="display:none" class="error" for="nombre_solicitante">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre_solicitante=new dhtmlXTreeObject("treeboxbox_nombre_solicitante","100%","100%",0);
                			tree_nombre_solicitante.setImagePath("../../imgs/");
                			tree_nombre_solicitante.enableIEImageFix(true);tree_nombre_solicitante.enableCheckBoxes(1);
                    tree_nombre_solicitante.enableRadioButtons(true);tree_nombre_solicitante.setOnLoadingStart(cargando_nombre_solicitante);
                      tree_nombre_solicitante.setOnLoadingEnd(fin_cargando_nombre_solicitante);tree_nombre_solicitante.enableSmartXMLParsing(true);tree_nombre_solicitante.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_nombre_solicitante.setOnCheckHandler(onNodeSelect_nombre_solicitante);
                      function onNodeSelect_nombre_solicitante(nodeId)
                      {valor_destino=document.getElementById("nombre_solicitante");
                       destinos=tree_nombre_solicitante.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_nombre_solicitante.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_nombre_solicitante() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_solicitante")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_solicitante")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre_solicitante"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_nombre_solicitante() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_solicitante")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_solicitante")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre_solicitante"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_descripcion_justificacion" id="condicion_descripcion_justificacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_descripcion_justificacion" id="compara_descripcion_justificacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_justificacion" name="descripcion_justificacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#descripcion_justificacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_justificacion_compra" id="condicion_justificacion_compra"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">JUSTIFICACI&Oacute;N DE COMPRA</td><td class="encabezado">&nbsp;<select name="compara_justificacion_compra" id="compara_justificacion_compra"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="justificacion_compra" name="justificacion_compra"></select><script>
                     $(document).ready(function() 
                      {
                      $("#justificacion_compra").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_primera_aprobacion" id="condicion_primera_aprobacion"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">PRIMERA APROBACION</td><td class="encabezado">&nbsp;<select name="compara_primera_aprobacion" id="compara_primera_aprobacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_primera_aprobacion"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(296,3460,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_primera_aprobacion" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_primera_aprobacion.findItem(htmlentities(document.getElementById('stext_primera_aprobacion').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_primera_aprobacion.findItem(htmlentities(document.getElementById('stext_primera_aprobacion').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_primera_aprobacion.findItem(htmlentities(document.getElementById('stext_primera_aprobacion').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_primera_aprobacion" height="90%"></div><input type="hidden"  name="primera_aprobacion" id="primera_aprobacion"   value="" ><label style="display:none" class="error" for="primera_aprobacion">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_primera_aprobacion=new dhtmlXTreeObject("treeboxbox_primera_aprobacion","100%","100%",0);
                			tree_primera_aprobacion.setImagePath("../../imgs/");
                			tree_primera_aprobacion.enableIEImageFix(true);tree_primera_aprobacion.enableCheckBoxes(1);
                    tree_primera_aprobacion.enableRadioButtons(true);tree_primera_aprobacion.setOnLoadingStart(cargando_primera_aprobacion);
                      tree_primera_aprobacion.setOnLoadingEnd(fin_cargando_primera_aprobacion);tree_primera_aprobacion.enableSmartXMLParsing(true);tree_primera_aprobacion.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_primera_aprobacion.setOnCheckHandler(onNodeSelect_primera_aprobacion);
                      function onNodeSelect_primera_aprobacion(nodeId)
                      {valor_destino=document.getElementById("primera_aprobacion");
                       destinos=tree_primera_aprobacion.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_primera_aprobacion.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_primera_aprobacion() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_primera_aprobacion")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_primera_aprobacion")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_primera_aprobacion"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_primera_aprobacion() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_primera_aprobacion")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_primera_aprobacion")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_primera_aprobacion"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><input type="hidden" name="campo_descripcion" value="3459,3461"><?php submit_formato(296);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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