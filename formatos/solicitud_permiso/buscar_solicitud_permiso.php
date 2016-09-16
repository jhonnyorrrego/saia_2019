<html><title>.:BUSCAR SOLICITUD DE PERMISOS:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA SOLICITUD DE PERMISOS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_gestion_humana" id="condicion_gestion_humana"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">GESTION HUMANA</td><td class="encabezado">&nbsp;<select name="compara_gestion_humana" id="compara_gestion_humana"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_gestion_humana"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(215,2285,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_gestion_humana" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_gestion_humana.findItem(htmlentities(document.getElementById('stext_gestion_humana').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_gestion_humana.findItem(htmlentities(document.getElementById('stext_gestion_humana').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_gestion_humana.findItem(htmlentities(document.getElementById('stext_gestion_humana').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_gestion_humana" height="90%"></div><input type="hidden" maxlength="255"  name="gestion_humana" id="gestion_humana"   value="" ><label style="display:none" class="error" for="gestion_humana">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_gestion_humana=new dhtmlXTreeObject("treeboxbox_gestion_humana","100%","100%",0);
                			tree_gestion_humana.setImagePath("../../imgs/");
                			tree_gestion_humana.enableIEImageFix(true);tree_gestion_humana.enableCheckBoxes(1);
                    tree_gestion_humana.enableRadioButtons(true);tree_gestion_humana.setOnLoadingStart(cargando_gestion_humana);
                      tree_gestion_humana.setOnLoadingEnd(fin_cargando_gestion_humana);tree_gestion_humana.enableSmartXMLParsing(true);tree_gestion_humana.loadXML("../../test.php?rol=1&iddependencia=50");
                      tree_gestion_humana.setOnCheckHandler(onNodeSelect_gestion_humana);
                      function onNodeSelect_gestion_humana(nodeId)
                      {valor_destino=document.getElementById("gestion_humana");
                       destinos=tree_gestion_humana.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_gestion_humana.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_gestion_humana() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gestion_humana")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gestion_humana")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_gestion_humana"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_gestion_humana() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_gestion_humana")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_gestion_humana")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_gestion_humana"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_radiccion_permiso" id="condicion_fecha_radiccion_permiso"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHAS SOLICITUD</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_radiccion_permiso_1" id="fecha_radiccion_permiso_1" tipo="fecha" value=""><?php selector_fecha("fecha_radiccion_permiso_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_radiccion_permiso_2" id="fecha_radiccion_permiso_2" tipo="fecha" value=""><?php selector_fecha("fecha_radiccion_permiso_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_hora_cita" id="condicion_fecha_hora_cita"><option value="AND">Y</option><option value="OR">O</option></td>
                    <td class="encabezado" width="20%" title="">FECHA Y HORA DE LA CITA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_hora_cita_1"  id="fecha_hora_cita_1" value=""><?php selector_fecha("fecha_hora_cita_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_hora_cita_2"  id="fecha_hora_cita_2" value=""><?php selector_fecha("fecha_hora_cita_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_motivo_permiso" id="condicion_motivo_permiso"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">MOTIVO DE PERMISO</td><td class="encabezado">&nbsp;<select name="compara_motivo_permiso" id="compara_motivo_permiso"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_motivo_permiso"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(215,2289,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_motivo_permiso" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_motivo_permiso.findItem(htmlentities(document.getElementById('stext_motivo_permiso').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_motivo_permiso.findItem(htmlentities(document.getElementById('stext_motivo_permiso').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_motivo_permiso.findItem(htmlentities(document.getElementById('stext_motivo_permiso').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_motivo_permiso" height="90%"></div><input type="hidden" maxlength="11"  name="motivo_permiso" id="motivo_permiso"   value="" ><label style="display:none" class="error" for="motivo_permiso">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_motivo_permiso=new dhtmlXTreeObject("treeboxbox_motivo_permiso","100%","100%",0);
                			tree_motivo_permiso.setImagePath("../../imgs/");
                			tree_motivo_permiso.enableIEImageFix(true);tree_motivo_permiso.enableCheckBoxes(1);
                    tree_motivo_permiso.enableRadioButtons(true);tree_motivo_permiso.setOnLoadingStart(cargando_motivo_permiso);
                      tree_motivo_permiso.setOnLoadingEnd(fin_cargando_motivo_permiso);tree_motivo_permiso.enableSmartXMLParsing(true);tree_motivo_permiso.loadXML("../../test_serie_funcionario.php?categoria=3&id=856");
                      tree_motivo_permiso.setOnCheckHandler(onNodeSelect_motivo_permiso);
                      function onNodeSelect_motivo_permiso(nodeId)
                      {valor_destino=document.getElementById("motivo_permiso");
                       destinos=tree_motivo_permiso.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_motivo_permiso.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_motivo_permiso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_motivo_permiso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_motivo_permiso")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_motivo_permiso"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_motivo_permiso() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_motivo_permiso")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_motivo_permiso")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_motivo_permiso"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_motivo_otro" id="condicion_motivo_otro"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OTRO</td><td class="encabezado">&nbsp;<select name="compara_motivo_otro" id="compara_motivo_otro"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="motivo_otro" name="motivo_otro"></select><script>
                     $(document).ready(function() 
                      {
                      $("#motivo_otro").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr></td></tr></td></tr><input type="hidden" name="campo_descripcion" value="2286"><?php submit_formato(215);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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