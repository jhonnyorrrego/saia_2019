<html><title>.:BUSCAR RADICACI&OACUTE;N DE FACTURAS:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA RADICACI&Oacute;N DE FACTURAS</td></tr><tr id="tr_tipo_documento"><td class="encabezado">&nbsp;<select name="condicion_tipo_documento" id="condicion_tipo_documento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DOCUMENTO</td><td class="encabezado">&nbsp;<select name="compara_tipo_documento" id="compara_tipo_documento"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(302,3530,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ft_orden_compra" id="condicion_ft_orden_compra"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ORDEN DE COMPRA</td><td class="encabezado">&nbsp;<select name="compara_ft_orden_compra" id="compara_ft_orden_compra"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(302,3524,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_expedicion" id="condicion_fecha_expedicion"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA EXPEDICI&Oacute;N</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_expedicion_1" id="fecha_expedicion_1" tipo="fecha" value=""><?php selector_fecha("fecha_expedicion_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_expedicion_2" id="fecha_expedicion_2" tipo="fecha" value=""><?php selector_fecha("fecha_expedicion_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_vencimiento" id="condicion_fecha_vencimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA VENCIMIENTO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_vencimiento_1" id="fecha_vencimiento_1" tipo="fecha" value=""><?php selector_fecha("fecha_vencimiento_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_vencimiento_2" id="fecha_vencimiento_2" tipo="fecha" value=""><?php selector_fecha("fecha_vencimiento_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_numero_factura" id="condicion_numero_factura"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO FACTURA</td><td class="encabezado">&nbsp;<select name="compara_numero_factura" id="compara_numero_factura"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_factura" name="numero_factura"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_factura").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_proveedor" id="condicion_proveedor"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PROVEEDOR</td><td class="encabezado">&nbsp;<select name="compara_proveedor" id="compara_proveedor"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple    id="proveedor" name="proveedor"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#proveedor").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_detalle_factura" id="condicion_detalle_factura"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DETALLE DE FACTURA</td><td class="encabezado">&nbsp;<select name="compara_detalle_factura" id="compara_detalle_factura"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="detalle_factura" name="detalle_factura"></select><script>
                     $(document).ready(function() 
                      {
                      $("#detalle_factura").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor_factura" id="condicion_valor_factura"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR FACTURA</td><td class="encabezado">&nbsp;<select name="compara_valor_factura" id="compara_valor_factura"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor_factura" name="valor_factura"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor_factura").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_responsable_op" id="condicion_responsable_op"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">RESPONSABLE ORDEN DE PAGO</td><td class="encabezado">&nbsp;<select name="compara_responsable_op" id="compara_responsable_op"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_responsable_op"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(302,3529,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_responsable_op" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable_op.findItem(htmlentities(document.getElementById('stext_responsable_op').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_responsable_op" height="90%"></div><input type="hidden"  name="responsable_op" id="responsable_op"   value="" ><label style="display:none" class="error" for="responsable_op">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_responsable_op=new dhtmlXTreeObject("treeboxbox_responsable_op","100%","100%",0);
                			tree_responsable_op.setImagePath("../../imgs/");
                			tree_responsable_op.enableIEImageFix(true);tree_responsable_op.enableCheckBoxes(1);
                    tree_responsable_op.enableRadioButtons(true);tree_responsable_op.setOnLoadingStart(cargando_responsable_op);
                      tree_responsable_op.setOnLoadingEnd(fin_cargando_responsable_op);tree_responsable_op.enableSmartXMLParsing(true);tree_responsable_op.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_responsable_op.setOnCheckHandler(onNodeSelect_responsable_op);
                      function onNodeSelect_responsable_op(nodeId)
                      {valor_destino=document.getElementById("responsable_op");
                       destinos=tree_responsable_op.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_responsable_op.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_responsable_op() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_op")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_op")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_responsable_op"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_responsable_op() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_responsable_op")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_responsable_op")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_responsable_op"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_observaciones" id="condicion_observaciones"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_guia" id="condicion_guia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">GU&Iacute;A</td><td class="encabezado">&nbsp;<select name="compara_guia" id="compara_guia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="guia" name="guia"></select><script>
                     $(document).ready(function() 
                      {
                      $("#guia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_empresa_guia" id="condicion_empresa_guia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">EMPRESA GUIA</td><td class="encabezado">&nbsp;<select name="compara_empresa_guia" id="compara_empresa_guia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="empresa_guia" name="empresa_guia"></select><script>
                     $(document).ready(function() 
                      {
                      $("#empresa_guia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_adjuntar" id="condicion_adjuntar"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ADJUNTAR</td><td class="encabezado">&nbsp;<select name="compara_adjuntar" id="compara_adjuntar"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="adjuntar" name="adjuntar"></select><script>
                     $(document).ready(function() 
                      {
                      $("#adjuntar").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3526"><?php submit_formato(302);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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