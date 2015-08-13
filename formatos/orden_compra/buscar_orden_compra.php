<html><title>.:BUSCAR ORDEN DE COMPRA:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ORDEN DE COMPRA</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_orden_compra" id="condicion_fecha_orden_compra"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_orden_compra_1" id="fecha_orden_compra_1" tipo="fecha" value=""><?php selector_fecha("fecha_orden_compra_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_orden_compra_2" id="fecha_orden_compra_2" tipo="fecha" value=""><?php selector_fecha("fecha_orden_compra_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_origen_recursos" id="condicion_origen_recursos"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">ORIGEN DE RECURSOS</td><td class="encabezado">&nbsp;<select name="compara_origen_recursos" id="compara_origen_recursos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_origen_recursos"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(301,3511,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_origen_recursos" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_origen_recursos.findItem(htmlentities(document.getElementById('stext_origen_recursos').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_origen_recursos.findItem(htmlentities(document.getElementById('stext_origen_recursos').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_origen_recursos.findItem(htmlentities(document.getElementById('stext_origen_recursos').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_origen_recursos" height="90%"></div><input type="hidden" maxlength="255"  name="origen_recursos" id="origen_recursos"   value="" ><label style="display:none" class="error" for="origen_recursos">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_origen_recursos=new dhtmlXTreeObject("treeboxbox_origen_recursos","100%","100%",0);
                			tree_origen_recursos.setImagePath("../../imgs/");
                			tree_origen_recursos.enableIEImageFix(true);tree_origen_recursos.enableCheckBoxes(1);
                    tree_origen_recursos.enableRadioButtons(true);tree_origen_recursos.setOnLoadingStart(cargando_origen_recursos);
                      tree_origen_recursos.setOnLoadingEnd(fin_cargando_origen_recursos);tree_origen_recursos.enableSmartXMLParsing(true);tree_origen_recursos.loadXML("../../test_serie.php?tabla=serie&id=1021");
                      tree_origen_recursos.setOnCheckHandler(onNodeSelect_origen_recursos);
                      function onNodeSelect_origen_recursos(nodeId)
                      {valor_destino=document.getElementById("origen_recursos");
                       destinos=tree_origen_recursos.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_origen_recursos.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_origen_recursos() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_origen_recursos")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_origen_recursos")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_origen_recursos"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_origen_recursos() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_origen_recursos")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_origen_recursos")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_origen_recursos"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_lugar_entrega" id="condicion_lugar_entrega"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">LUGAR DE ENTREGA</td><td class="encabezado">&nbsp;<select name="compara_lugar_entrega" id="compara_lugar_entrega"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="lugar_entrega" name="lugar_entrega"></select><script>
                     $(document).ready(function() 
                      {
                      $("#lugar_entrega").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_entrega" id="condicion_fecha_entrega"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE ENTREGA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_entrega_1" id="fecha_entrega_1" tipo="fecha" value=""><?php selector_fecha("fecha_entrega_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_entrega_2" id="fecha_entrega_2" tipo="fecha" value=""><?php selector_fecha("fecha_entrega_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_observaciones" id="condicion_observaciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES DE ENTREGA</td><td class="encabezado">&nbsp;<select name="compara_observaciones" id="compara_observaciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones" name="observaciones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observaciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3508,3509"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(301);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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