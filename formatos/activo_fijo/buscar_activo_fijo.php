<html><title>.:BUSCAR ACTIVOS FIJOS:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ACTIVOS FIJOS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_activo" id="condicion_nombre_activo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE ACTIVO</td><td class="encabezado">&nbsp;<select name="compara_nombre_activo" id="compara_nombre_activo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_activo" name="nombre_activo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_activo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre" id="condicion_nombre"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">RESPONSABLE</td><td class="encabezado">&nbsp;<select name="compara_nombre" id="compara_nombre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_nombre"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(231,2555,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_nombre" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_nombre.findItem(htmlentities(document.getElementById('stext_nombre').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre.findItem(htmlentities(document.getElementById('stext_nombre').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_nombre.findItem(htmlentities(document.getElementById('stext_nombre').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_nombre" height="90%"></div><input type="hidden" maxlength="255"  name="nombre" id="nombre"   value="" ><label style="display:none" class="error" for="nombre">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre=new dhtmlXTreeObject("treeboxbox_nombre","100%","100%",0);
                			tree_nombre.setImagePath("../../imgs/");
                			tree_nombre.enableIEImageFix(true);tree_nombre.enableCheckBoxes(1);
                    tree_nombre.enableRadioButtons(true);tree_nombre.setOnLoadingStart(cargando_nombre);
                      tree_nombre.setOnLoadingEnd(fin_cargando_nombre);tree_nombre.enableSmartXMLParsing(true);tree_nombre.loadXML("../../test.php?rol=1&iddependencia=51");
                      tree_nombre.setOnCheckHandler(onNodeSelect_nombre);
                      function onNodeSelect_nombre(nodeId)
                      {valor_destino=document.getElementById("nombre");
                       destinos=tree_nombre.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_nombre.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_nombre() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_nombre() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_codigo" id="condicion_codigo"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_consideraciones" id="condicion_consideraciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONSIDERACIONES</td><td class="encabezado">&nbsp;<select name="compara_consideraciones" id="compara_consideraciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="consideraciones" name="consideraciones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#consideraciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha" id="condicion_fecha"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA ACTIVACI&Oacute;N</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_1" id="fecha_1" tipo="fecha" value=""><?php selector_fecha("fecha_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_2" id="fecha_2" tipo="fecha" value=""><?php selector_fecha("fecha_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ubicacion" id="condicion_ubicacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">UBICACI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_ubicacion" id="compara_ubicacion"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(231,2573,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_estado" id="condicion_estado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ESTADO</td><td class="encabezado">&nbsp;<select name="compara_estado" id="compara_estado"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(231,2560,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_proveedor" id="condicion_proveedor"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PROVEEDOR</td><td class="encabezado">&nbsp;<select name="compara_proveedor" id="compara_proveedor"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="proveedor" name="proveedor"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#proveedor").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_compra" id="condicion_fecha_compra"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE COMPRA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_compra_1" id="fecha_compra_1" tipo="fecha" value=""><?php selector_fecha("fecha_compra_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_compra_2" id="fecha_compra_2" tipo="fecha" value=""><?php selector_fecha("fecha_compra_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor_compra" id="condicion_valor_compra"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR DE LA COMPRA</td><td class="encabezado">&nbsp;<select name="compara_valor_compra" id="compara_valor_compra"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor_compra" name="valor_compra"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor_compra").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_propietario" id="condicion_propietario"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PROPIETARIO</td><td class="encabezado">&nbsp;<select name="compara_propietario" id="compara_propietario"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="propietario" name="propietario"></select><script>
                     $(document).ready(function() 
                      {
                      $("#propietario").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor_seguro" id="condicion_valor_seguro"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR DEL SEGURO</td><td class="encabezado">&nbsp;<select name="compara_valor_seguro" id="compara_valor_seguro"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor_seguro" name="valor_seguro"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor_seguro").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_Seguro1" id="condicion_Seguro1"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SEGURO 1</td><td class="encabezado">&nbsp;<select name="compara_Seguro1" id="compara_Seguro1"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(231,2566,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_seguro2" id="condicion_seguro2"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SEGURO 2</td><td class="encabezado">&nbsp;<select name="compara_seguro2" id="compara_seguro2"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(231,2567,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_seguro3" id="condicion_seguro3"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SEGURO 3</td><td class="encabezado">&nbsp;<select name="compara_seguro3" id="compara_seguro3"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(231,2568,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_foto" id="condicion_foto"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FOTO ACTIVO</td><td class="encabezado">&nbsp;<select name="compara_foto" id="compara_foto"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="foto" name="foto"></select><script>
                     $(document).ready(function() 
                      {
                      $("#foto").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">INFORMACION DE VANTA</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="informacion_venta" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_comprador" id="condicion_comprador"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">COMPRADOR</td><td class="encabezado">&nbsp;<select name="compara_comprador" id="compara_comprador"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="comprador" name="comprador"></select><script>
                     $(document).ready(function() 
                      {
                      $("#comprador").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_venta" id="condicion_fecha_venta"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE LA VENTA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_venta_1" id="fecha_venta_1" tipo="fecha" value=""><?php selector_fecha("fecha_venta_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_venta_2" id="fecha_venta_2" tipo="fecha" value=""><?php selector_fecha("fecha_venta_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_valor_venta" id="condicion_valor_venta"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">VALOR DE LA VENTA</td><td class="encabezado">&nbsp;<select name="compara_valor_venta" id="compara_valor_venta"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="valor_venta" name="valor_venta"></select><script>
                     $(document).ready(function() 
                      {
                      $("#valor_venta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_mantenimiento" id="condicion_fecha_mantenimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">MANTENIMIENTO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_mantenimiento_1" id="fecha_mantenimiento_1" tipo="fecha" value=""><?php selector_fecha("fecha_mantenimiento_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_mantenimiento_2" id="fecha_mantenimiento_2" tipo="fecha" value=""><?php selector_fecha("fecha_mantenimiento_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><input type="hidden" name="campo_descripcion" value="2555,2564"><?php submit_formato(231);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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