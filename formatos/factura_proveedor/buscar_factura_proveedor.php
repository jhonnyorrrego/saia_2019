<html><title>.:BUSCAR RADICACION FACTURAS:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA RADICACION FACTURAS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_factura_correcta" id="condicion_factura_correcta"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FACTURA_CORRECTA</td><td class="encabezado">&nbsp;<select name="compara_factura_correcta" id="compara_factura_correcta"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="factura_correcta" name="factura_correcta"></select><script>
                     $(document).ready(function() 
                      {
                      $("#factura_correcta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_cia" id="condicion_cia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">C&Oacute;DIGO DE LA COMPA&Ntilde;IA</td><td class="encabezado">&nbsp;<select name="compara_cia" id="compara_cia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cia" name="cia"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_doc"><td class="encabezado">&nbsp;<select name="condicion_tipo_doc" id="condicion_tipo_doc"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO DOCUMENTO</td><td class="encabezado">&nbsp;<select name="compara_tipo_doc" id="compara_tipo_doc"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(236,2631,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_exp" id="condicion_fecha_exp"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE EXPEDICION</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_exp_1" id="fecha_exp_1" tipo="fecha" value=""><?php selector_fecha("fecha_exp_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_exp_2" id="fecha_exp_2" tipo="fecha" value=""><?php selector_fecha("fecha_exp_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_venc" id="condicion_fecha_venc"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE VENCIMIENTO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_venc_1" id="fecha_venc_1" tipo="fecha" value=""><?php selector_fecha("fecha_venc_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_venc_2" id="fecha_venc_2" tipo="fecha" value=""><?php selector_fecha("fecha_venc_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_num_factura" id="condicion_num_factura"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FACTURA</td><td class="encabezado">&nbsp;<select name="compara_num_factura" id="compara_num_factura"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="num_factura" name="num_factura"></select><script>
                     $(document).ready(function() 
                      {
                      $("#num_factura").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_prooveedor" id="condicion_prooveedor"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PROVEEDOR</td><td class="encabezado">&nbsp;<select name="compara_prooveedor" id="compara_prooveedor"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="prooveedor" name="prooveedor"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#prooveedor").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_moneda" id="condicion_tipo_moneda"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TIPO MONEDA</td><td class="encabezado">&nbsp;<select name="compara_tipo_moneda" id="compara_tipo_moneda"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(236,2636,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_enviar" id="condicion_enviar"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">ENVIAR A</td><td class="encabezado">&nbsp;<select name="compara_enviar" id="compara_enviar"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_enviar"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(236,5068,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_enviar" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_enviar.findItem(htmlentities(document.getElementById('stext_enviar').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_enviar.findItem(htmlentities(document.getElementById('stext_enviar').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_enviar.findItem(htmlentities(document.getElementById('stext_enviar').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_enviar" height="90%"></div><input type="hidden" maxlength="255"  name="enviar" id="enviar"   value="" ><label style="display:none" class="error" for="enviar">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_enviar=new dhtmlXTreeObject("treeboxbox_enviar","100%","100%",0);
                			tree_enviar.setImagePath("../../imgs/");
                			tree_enviar.enableIEImageFix(true);tree_enviar.enableCheckBoxes(1);
                    tree_enviar.enableRadioButtons(true);tree_enviar.setOnLoadingStart(cargando_enviar);
                      tree_enviar.setOnLoadingEnd(fin_cargando_enviar);tree_enviar.enableSmartXMLParsing(true);tree_enviar.loadXML("../../test.php?rol=1&iddependencia=51");
                      tree_enviar.setOnCheckHandler(onNodeSelect_enviar);
                      function onNodeSelect_enviar(nodeId)
                      {valor_destino=document.getElementById("enviar");
                       destinos=tree_enviar.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_enviar.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_enviar() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_enviar")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_enviar")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_enviar"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_enviar() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_enviar")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_enviar")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_enviar"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_factura" id="condicion_fecha_factura"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE LA GUIA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_factura_1" id="fecha_factura_1" tipo="fecha" value=""><?php selector_fecha("fecha_factura_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_factura_2" id="fecha_factura_2" tipo="fecha" value=""><?php selector_fecha("fecha_factura_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_observaciones" id="condicion_observaciones"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_caja" id="condicion_caja"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CAJA</td><td class="encabezado">&nbsp;<select name="compara_caja" id="compara_caja"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="caja" name="caja"></select><script>
                     $(document).ready(function() 
                      {
                      $("#caja").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_unidad_documenta" id="condicion_unidad_documenta"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">UNIDAD DOCUMENTAL</td><td class="encabezado">&nbsp;<select name="compara_unidad_documenta" id="compara_unidad_documenta"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="unidad_documenta" name="unidad_documenta"></select><script>
                     $(document).ready(function() 
                      {
                      $("#unidad_documenta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_requiere_irecibo"><td class="encabezado">&nbsp;<select name="condicion_requiere_irecibo" id="condicion_requiere_irecibo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">REQUIERE IR?</td><td class="encabezado">&nbsp;<select name="compara_requiere_irecibo" id="compara_requiere_irecibo"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(236,2642,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_numero_guia" id="condicion_numero_guia"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">GUIA</td><td class="encabezado">&nbsp;<select name="compara_numero_guia" id="compara_numero_guia"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_guia" name="numero_guia"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_guia").fcbkcomplete({
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
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_orden_compra" id="condicion_orden_compra"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ORDEN COMPRA</td><td class="encabezado">&nbsp;<select name="compara_orden_compra" id="compara_orden_compra"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="orden_compra" name="orden_compra"></select><script>
                     $(document).ready(function() 
                      {
                      $("#orden_compra").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_archivo_ubicacion" id="condicion_archivo_ubicacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ARCHIVO UBICACI&Oacute;N CAJA</td><td class="encabezado">&nbsp;<select name="compara_archivo_ubicacion" id="compara_archivo_ubicacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="archivo_ubicacion" name="archivo_ubicacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#archivo_ubicacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor_factura" id="condicion_valor_factura"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR DE LA FACTURA</td><td class="encabezado">&nbsp;<select name="compara_valor_factura" id="compara_valor_factura"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor_factura" name="valor_factura"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor_factura").fcbkcomplete({
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
                    </tr><input type="hidden" name="campo_descripcion" value="2634,2635,2636,2638,2640,2641,2644,2646"><?php submit_formato(236);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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