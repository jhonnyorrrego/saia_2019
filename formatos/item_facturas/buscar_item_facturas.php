<html><title>.: CLASIFICACION DE FACTURA:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/funciones_formatos_generales.php"); ?><?php include_once("../librerias/funciones_formatos_generales.php"); ?><?php include_once("../funciones.php"); ?><?php include_once("../funciones.php"); ?><?php include_once("../funciones.php"); ?><?php include_once("../funciones.php"); ?><?php include_once("../funciones.php"); ?><?php include_once("../funciones.php"); ?><?php include_once("../funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../funciones.php"); ?><?php include_once("../funciones.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA CLASIFICACION DE FACTURA</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_transferido"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_transferido',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_transferido',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_transferido" id="bqsaiaenlace_transferido" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TRANSFERIDO</td><input type="hidden" name="bksaiacondicion_transferido" id="bksaiacondicion_transferido" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="transferido" name="transferido"></select><script>
                     $(document).ready(function()
                      {
                      $("#transferido").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_posterior_adicionar"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_posterior_adicionar',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_posterior_adicionar',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_posterior_adicionar" id="bqsaiaenlace_posterior_adicionar" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TRANSFERIR RESPONDER</td><input type="hidden" name="bksaiacondicion_posterior_adicionar" id="bksaiacondicion_posterior_adicionar" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="posterior_adicionar" name="posterior_adicionar"></select><script>
                     $(document).ready(function()
                      {
                      $("#posterior_adicionar").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Prueba 5 ">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_dependencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_dependencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_dependencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_dependencia" id="bqsaiaenlace_dependencia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO</td><input type="hidden" name="bksaiacondicion_dependencia" id="bksaiacondicion_dependencia" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="dependencia" name="dependencia"></select><script>
                     $(document).ready(function()
                      {
                      $("#dependencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_clasificacion_fact"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_clasificacion_fact',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_clasificacion_fact',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_clasificacion_fact" id="bqsaiaenlace_clasificacion_fact" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CLASIFICACI&Oacute;N</td><input type="hidden" name="bksaiacondicion_clasificacion_fact" id="bksaiacondicion_clasificacion_fact" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,7054,'',1,'buscar');?></td></tr><tr id="tr_pago_desde"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_pago_desde',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_pago_desde',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_pago_desde" id="bqsaiaenlace_pago_desde" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">PAGO REALIZADO DESDE</td><input type="hidden" name="bksaiacondicion_pago_desde" id="bksaiacondicion_pago_desde" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,7061,'',1,'buscar');?></td></tr><tr id="tr_no_convenio"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_no_convenio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_no_convenio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_no_convenio" id="bqsaiaenlace_no_convenio" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">NOMBRE CONVENIO</td><input type="hidden" name="bksaiacondicion_no_convenio" id="bksaiacondicion_no_convenio" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="no_convenio" name="no_convenio"></select><script>
                     $(document).ready(function()
                      {
                      $("#no_convenio").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_valor_factura"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_valor_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_valor_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_valor_factura" id="bqsaiaenlace_valor_factura" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">VALOR DE LA FACTURA</td><input type="hidden" name="bksaiacondicion_valor_factura" id="bksaiacondicion_valor_factura" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="valor_factura" name="valor_factura"></select><script>
                     $(document).ready(function()
                      {
                      $("#valor_factura").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_programada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_programada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_programada" id="bqsaiaenlace_fecha_programada" value="y" />
		</div>
                       <td class="encabezado" width="20%" title="">FECHA PROGRAMADA DE PAGO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_programada_1" id="fecha_programada_1" tipo="fecha" value=""><?php selector_fecha("fecha_programada_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_programada_2" id="fecha_programada_2" tipo="fecha" value=""><?php selector_fecha("fecha_programada_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr id="tr_prioridad"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_prioridad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_prioridad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_prioridad" id="bqsaiaenlace_prioridad" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="1,Baja;2,Media;3,Alta">PRIORIDAD</td><input type="hidden" name="bksaiacondicion_prioridad" id="bksaiacondicion_prioridad" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,7063,'',1,'buscar');?></td></tr><tr id="tr_numero_orden"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_numero_orden',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_numero_orden',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_numero_orden" id="bqsaiaenlace_numero_orden" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO ORDEN COMPRA / CONTRATO</td><input type="hidden" name="bksaiacondicion_numero_orden" id="bksaiacondicion_numero_orden" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="numero_orden" name="numero_orden"></select><script>
                     $(document).ready(function()
                      {
                      $("#numero_orden").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_responsable',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_responsable',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_responsable" id="bqsaiaenlace_responsable" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">RESPONSABLE</td><input type="hidden" name="bksaiacondicion_responsable" id="bksaiacondicion_responsable" value="like"><td bgcolor="#F5F5F5"><div id="esperando_responsable"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,7064,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_responsable" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_responsable.findItem((document.getElementById('stext_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_responsable" height="90%"></div><input type="hidden" maxlength="255"  name="responsable" id="responsable"   value="" ><label style="display:none" class="error" for="responsable">Campo obligatorio.</label><script type="text/javascript">
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
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_responsable.getAllSubItems(vector[i]);
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
                	--></script></td></tr><tr id="tr_idft_item_facturas"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_item_facturas',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_item_facturas',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_item_facturas" id="bqsaiaenlace_idft_item_facturas" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ITEM_FACTURAS</td><input type="hidden" name="bksaiacondicion_idft_item_facturas" id="bksaiacondicion_idft_item_facturas" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_item_facturas" name="idft_item_facturas"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_item_facturas").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="item_facturas"><?php submit_formato();?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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