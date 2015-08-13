<html><title>.:BUSCAR SOLICITUD DE VACACIONES:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA SOLICITUD DE VACACIONES</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_gestio_humana" id="condicion_gestio_humana"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">RESPONSABLE</td><td class="encabezado">&nbsp;<select name="compara_gestio_humana" id="compara_gestio_humana"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_gestio_humana"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(216,2297,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_gestio_humana" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_gestio_humana.findItem(htmlentities(document.getElementById('stext_gestio_humana').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_gestio_humana.findItem(htmlentities(document.getElementById('stext_gestio_humana').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_gestio_humana.findItem(htmlentities(document.getElementById('stext_gestio_humana').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_gestio_humana" height="90%"></div><input type="hidden" maxlength="255"  name="gestio_humana" id="gestio_humana"   value="" ><label style="display:none" class="error" for="gestio_humana">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_gestio_humana=new dhtmlXTreeObject("treeboxbox_gestio_humana","100%","100%",0);
                			tree_gestio_humana.setImagePath("../../imgs/");
                			tree_gestio_humana.enableIEImageFix(true);tree_gestio_humana.enableCheckBoxes(1);
                    tree_gestio_humana.enableRadioButtons(true);tree_gestio_humana.setOnLoadingStart(cargando_gestio_humana);
                      tree_gestio_humana.setOnLoadingEnd(fin_cargando_gestio_humana);tree_gestio_humana.enableSmartXMLParsing(true);tree_gestio_humana.loadXML("../../test.php?rol=1&iddependencia=50");
                      tree_gestio_humana.setOnCheckHandler(onNodeSelect_gestio_humana);
                      function onNodeSelect_gestio_humana(nodeId)
                      {valor_destino=document.getElementById("gestio_humana");
                       destinos=tree_gestio_humana.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_gestio_humana.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_gestio_humana() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gestio_humana")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gestio_humana")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_gestio_humana"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_gestio_humana() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gestio_humana")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gestio_humana")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_gestio_humana"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_doc" id="condicion_fecha_doc"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DOCUMENTO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_doc_1" id="fecha_doc_1" tipo="fecha" value=""><?php selector_fecha("fecha_doc_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_doc_2" id="fecha_doc_2" tipo="fecha" value=""><?php selector_fecha("fecha_doc_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_ini_vacaciones" id="condicion_fecha_ini_vacaciones"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">INICIO DE VACACIONES</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_ini_vacaciones_1" id="fecha_ini_vacaciones_1" tipo="fecha" value=""><?php selector_fecha("fecha_ini_vacaciones_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_ini_vacaciones_2" id="fecha_ini_vacaciones_2" tipo="fecha" value=""><?php selector_fecha("fecha_ini_vacaciones_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_fin_vaciones" id="condicion_fecha_fin_vaciones"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FIN DE LAS VACACIONES</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_fin_vaciones_1" id="fecha_fin_vaciones_1" tipo="fecha" value=""><?php selector_fecha("fecha_fin_vaciones_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_fin_vaciones_2" id="fecha_fin_vaciones_2" tipo="fecha" value=""><?php selector_fecha("fecha_fin_vaciones_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_ini_labores" id="condicion_fecha_ini_labores"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA INICIO DE LABORES</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_ini_labores_1" id="fecha_ini_labores_1" tipo="fecha" value=""><?php selector_fecha("fecha_ini_labores_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_ini_labores_2" id="fecha_ini_labores_2" tipo="fecha" value=""><?php selector_fecha("fecha_ini_labores_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><input type="hidden" name="campo_descripcion" value="2297"><?php submit_formato(216);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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