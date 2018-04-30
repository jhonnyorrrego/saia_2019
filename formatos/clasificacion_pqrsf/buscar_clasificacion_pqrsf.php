<html><title>.:BUSCAR 1. CLASIFICACION PQRSF:.</title><head><?php include_once("../../calendario/calendario.php"); ?>
			<link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/>
			<script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script>
			<link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/>
			</head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA 1. CLASIFICACION PQRSF</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha" id="condicion_fecha"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_1" id="fecha_1" tipo="fecha" value=""><?php selector_fecha("fecha_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_2" id="fecha_2" tipo="fecha" value=""><?php selector_fecha("fecha_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_serie" id="condicion_serie"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">CLASIFICACION</td><td class="encabezado">&nbsp;<select name="compara_serie" id="compara_serie"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_serie"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(306,3586,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_serie" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_serie.findItem((document.getElementById('stext_serie').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_serie" height="90%"></div><input type="hidden" maxlength="255"  name="serie" id="serie"   value="" ><label style="display:none" class="error" for="serie">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_serie=new dhtmlXTreeObject("treeboxbox_serie","100%","100%",0);
                			tree_serie.setImagePath("../../imgs/");
                			tree_serie.enableIEImageFix(true);tree_serie.enableCheckBoxes(1);
                    tree_serie.enableRadioButtons(true);tree_serie.setOnLoadingStart(cargando_serie);
                      tree_serie.setOnLoadingEnd(fin_cargando_serie);tree_serie.enableSmartXMLParsing(true);tree_serie.loadXML("../../test_serie.php?tabla=serie&id=1033");
                      tree_serie.setOnCheckHandler(onNodeSelect_serie);
                      function onNodeSelect_serie(nodeId)
                      {valor_destino=document.getElementById("serie");
                       destinos=tree_serie.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_serie.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_serie() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_serie"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_serie() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_serie"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_responsable" id="condicion_responsable"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">RESPONSABLE</td><td class="encabezado">&nbsp;<select name="compara_responsable" id="compara_responsable"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_responsable"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(306,3585,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_responsable" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_responsable" height="90%"></div><input type="hidden" maxlength="255"  name="responsable" id="responsable"   value="" ><label style="display:none" class="error" for="responsable">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable=new dhtmlXTreeObject("treeboxbox_responsable","100%","100%",0);
                			tree_responsable.setImagePath("../../imgs/");
                			tree_responsable.enableIEImageFix(true);tree_responsable.enableCheckBoxes(1);
                    tree_responsable.enableRadioButtons(true);tree_responsable.setOnLoadingStart(cargando_responsable);
                      tree_responsable.setOnLoadingEnd(fin_cargando_responsable);tree_responsable.enableSmartXMLParsing(true);tree_responsable.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_responsable.setOnCheckHandler(onNodeSelect_responsable);
                      function onNodeSelect_responsable(nodeId)
                      {valor_destino=document.getElementById("responsable");
                       destinos=tree_responsable.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_responsable.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_observaciones"><td class="encabezado">&nbsp;<select name="condicion_observaciones" id="condicion_observaciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td><td class="encabezado">&nbsp;<select name="compara_observaciones" id="compara_observaciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones" name="observaciones"></select><script>
                     $(document).ready(function()
                      {
                      $("#observaciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3586"><?php submit_formato(306);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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