<html><title>.:BUSCAR RADICACI&OACUTE;N DE FACTURAS:.</title><head><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/>
			<script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script>
			<link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/>
			</head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA RADICACI&Oacute;N DE FACTURAS</td></tr><tr id="tr_fecha_pago"><td class="encabezado">&nbsp;<select name="condicion_fecha_pago" id="condicion_fecha_pago"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA PAGO</td><td class="encabezado">&nbsp;<select name="compara_fecha_pago" id="compara_fecha_pago"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_pago" name="fecha_pago"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_pago").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_observaciones_check"><td class="encabezado">&nbsp;<select name="condicion_observaciones_check" id="condicion_observaciones_check"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES CHECK</td><td class="encabezado">&nbsp;<select name="compara_observaciones_check" id="compara_observaciones_check"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones_check" name="observaciones_check"></select><script>
                     $(document).ready(function()
                      {
                      $("#observaciones_check").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_fecha_radicado"><td class="encabezado">&nbsp;<select name="condicion_fecha_radicado" id="condicion_fecha_radicado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FECHA DE RADICACI&Oacute;N</td><td class="encabezado">&nbsp;<select name="compara_fecha_radicado" id="compara_fecha_radicado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_radicado" name="fecha_radicado"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_radicado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_numero_radicado"><td class="encabezado">&nbsp;<select name="condicion_numero_radicado" id="condicion_numero_radicado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE RADICADO</td><td class="encabezado">&nbsp;<select name="compara_numero_radicado" id="compara_numero_radicado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_radicado" name="numero_radicado"></select><script>
                     $(document).ready(function()
                      {
                      $("#numero_radicado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_natural_juridica"><td class="encabezado">&nbsp;<select name="condicion_natural_juridica" id="condicion_natural_juridica"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">PROVEEDOR</td><td class="encabezado">&nbsp;<select name="compara_natural_juridica" id="compara_natural_juridica"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="natural_juridica" name="natural_juridica"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function()
                      {
                      $("#natural_juridica").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr id="tr_estado"><td class="encabezado">&nbsp;<select name="condicion_estado" id="condicion_estado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ESTADO</td><td class="encabezado">&nbsp;<select name="compara_estado" id="compara_estado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="estado" name="estado"></select><script>
                     $(document).ready(function()
                      {
                      $("#estado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_emision" id="condicion_fecha_emision"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE EMISI&Oacute;N DE LA FACTURA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_emision_1" id="fecha_emision_1" tipo="fecha" value=""><?php selector_fecha("fecha_emision_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_emision_2" id="fecha_emision_2" tipo="fecha" value=""><?php selector_fecha("fecha_emision_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr id="tr_num_factura"><td class="encabezado">&nbsp;<select name="condicion_num_factura" id="condicion_num_factura"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><tr id="tr_descripcion"><td class="encabezado">&nbsp;<select name="condicion_descripcion" id="condicion_descripcion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N SERVICIO O PRODUCTO</td><td class="encabezado">&nbsp;<select name="compara_descripcion" id="compara_descripcion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion" name="descripcion"></select><script>
                     $(document).ready(function()
                      {
                      $("#descripcion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_num_folios"><td class="encabezado">&nbsp;<select name="condicion_num_folios" id="condicion_num_folios"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FOLIOS</td><td class="encabezado">&nbsp;<select name="compara_num_folios" id="compara_num_folios"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="num_folios" name="num_folios"></select><script>
                     $(document).ready(function()
                      {
                      $("#num_folios").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexos_fisicos"><td class="encabezado">&nbsp;<select name="condicion_anexos_fisicos" id="condicion_anexos_fisicos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS F&Iacute;SICOS</td><td class="encabezado">&nbsp;<select name="compara_anexos_fisicos" id="compara_anexos_fisicos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexos_fisicos" name="anexos_fisicos"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos_fisicos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexos_digitales"><td class="encabezado">&nbsp;<select name="condicion_anexos_digitales" id="condicion_anexos_digitales"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td><td class="encabezado">&nbsp;<select name="compara_anexos_digitales" id="compara_anexos_digitales"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="anexos_digitales" name="anexos_digitales"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos_digitales").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_copia_electronica" id="condicion_copia_electronica"><option value="AND">Y</option><option value="OR">O</option></td>
                   <td class="encabezado" width="20%" title="">COPIA ELECTR&OACUTE;NICA A</td><td class="encabezado">&nbsp;<select name="compara_copia_electronica" id="compara_copia_electronica"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><td bgcolor="#F5F5F5"><div id="esperando_copia_electronica"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(473,5973,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_copia_electronica" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia_electronica.findItem((document.getElementById('stext_copia_electronica').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_electronica.findItem((document.getElementById('stext_copia_electronica').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia_electronica.findItem((document.getElementById('stext_copia_electronica').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                <div id="treeboxbox_copia_electronica" height="90%"></div><input type="hidden" maxlength="255"  name="copia_electronica" id="copia_electronica"   value="" ><label style="display:none" class="error" for="copia_electronica">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_electronica=new dhtmlXTreeObject("treeboxbox_copia_electronica","100%","100%",0);
                			tree_copia_electronica.setImagePath("../../imgs/");
                			tree_copia_electronica.enableIEImageFix(true);tree_copia_electronica.enableCheckBoxes(1);
                			tree_copia_electronica.enableThreeStateCheckboxes(1);tree_copia_electronica.setOnLoadingStart(cargando_copia_electronica);
                      tree_copia_electronica.setOnLoadingEnd(fin_cargando_copia_electronica);tree_copia_electronica.enableSmartXMLParsing(true);tree_copia_electronica.loadXML("../../test.php?rol=1");
                      tree_copia_electronica.setOnCheckHandler(onNodeSelect_copia_electronica);
                      function onNodeSelect_copia_electronica(nodeId)
                      {valor_destino=document.getElementById("copia_electronica");
                       destinos=tree_copia_electronica.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_copia_electronica.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_copia_electronica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_electronica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_electronica")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_electronica"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia_electronica() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_electronica")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_electronica")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_electronica"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><input type="hidden" name="campo_descripcion" value="5965"><?php submit_formato(473);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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