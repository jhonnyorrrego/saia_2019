<html><title>.: TRANSFERENCIA DOCUMENTAL:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA TRANSFERENCIA DOCUMENTAL</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_iddependencia_compania"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_iddependencia_compania',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_iddependencia_compania',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_iddependencia_compania" id="bqsaiaenlace_iddependencia_compania" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">COMPANIA</td><input type="hidden" name="bksaiacondicion_iddependencia_compania" id="bksaiacondicion_iddependencia_compania" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="iddependencia_compania" name="iddependencia_compania"></select><script>
                     $(document).ready(function()
                      {
                      $("#iddependencia_compania").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_transferencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_transferencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_transferencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_transferencia" id="bqsaiaenlace_tipo_transferencia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TIPO_TRANSFERENCIA</td><input type="hidden" name="bksaiacondicion_tipo_transferencia" id="bksaiacondicion_tipo_transferencia" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="tipo_transferencia" name="tipo_transferencia"></select><script>
                     $(document).ready(function()
                      {
                      $("#tipo_transferencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_estado_documento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado_documento" id="bqsaiaenlace_estado_documento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ESTADO DEL DOCUMENTO</td><input type="hidden" name="bksaiacondicion_estado_documento" id="bksaiacondicion_estado_documento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="estado_documento" name="estado_documento"></select><script>
                     $(document).ready(function()
                      {
                      $("#estado_documento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_idft_transferencia_doc"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_transferencia_doc',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_transferencia_doc',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_transferencia_doc" id="bqsaiaenlace_idft_transferencia_doc" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TRANSFERENCIA_DOC</td><input type="hidden" name="bksaiacondicion_idft_transferencia_doc" id="bksaiacondicion_idft_transferencia_doc" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_transferencia_doc" name="idft_transferencia_doc"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_transferencia_doc").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_documento_iddocumento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_documento_iddocumento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_documento_iddocumento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_documento_iddocumento" id="bqsaiaenlace_documento_iddocumento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DOCUMENTO ASOCIADO</td><input type="hidden" name="bksaiacondicion_documento_iddocumento" id="bksaiacondicion_documento_iddocumento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="documento_iddocumento" name="documento_iddocumento"></select><script>
                     $(document).ready(function()
                      {
                      $("#documento_iddocumento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_encabezado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_encabezado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_encabezado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_encabezado" id="bqsaiaenlace_encabezado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ENCABEZADO</td><input type="hidden" name="bksaiacondicion_encabezado" id="bksaiacondicion_encabezado" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="encabezado" name="encabezado"></select><script>
                     $(document).ready(function()
                      {
                      $("#encabezado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_firma"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_firma',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_firma',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_firma" id="bqsaiaenlace_firma" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FIRMAS DIGITALES</td><input type="hidden" name="bksaiacondicion_firma" id="bksaiacondicion_firma" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="firma" name="firma"></select><script>
                     $(document).ready(function()
                      {
                      $("#firma").fcbkcomplete({
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
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_expediente_vinculado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_expediente_vinculado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_expediente_vinculado" id="bqsaiaenlace_expediente_vinculado" value="y" />
		</div>
                  <td class="encabezado" width="20%" title="">TRANSFERENCIA VINCULADA</td><input type="hidden" name="bksaiacondicion_expediente_vinculado" id="bksaiacondicion_expediente_vinculado" value="like"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(343,3995,'',1,'buscar');?></td></tr><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Transferencia documental">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_oficina_productora',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_oficina_productora',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_oficina_productora" id="bqsaiaenlace_oficina_productora" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">OFICINA PRODUCTORA</td><input type="hidden" name="bksaiacondicion_oficina_productora" id="bksaiacondicion_oficina_productora" value="like"><td bgcolor="#F5F5F5"><div id="esperando_oficina_productora"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(343,3997,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_oficina_productora" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_oficina_productora.findItem((document.getElementById('stext_oficina_productora').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_oficina_productora" height="90%"></div><input type="hidden" maxlength="255"  name="oficina_productora" id="oficina_productora"   value="" ><label style="display:none" class="error" for="oficina_productora">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_oficina_productora=new dhtmlXTreeObject("treeboxbox_oficina_productora","100%","100%",0);
                			tree_oficina_productora.setImagePath("../../imgs/");
                			tree_oficina_productora.enableIEImageFix(true);tree_oficina_productora.enableCheckBoxes(1);
                    tree_oficina_productora.enableRadioButtons(true);tree_oficina_productora.setOnLoadingStart(cargando_oficina_productora);
                      tree_oficina_productora.setOnLoadingEnd(fin_cargando_oficina_productora);tree_oficina_productora.enableSmartXMLParsing(true);tree_oficina_productora.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_oficina_productora.setOnCheckHandler(onNodeSelect_oficina_productora);
                      function onNodeSelect_oficina_productora(nodeId)
                      {valor_destino=document.getElementById("oficina_productora");
                       destinos=tree_oficina_productora.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_oficina_productora.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_oficina_productora() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_oficina_productora")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_oficina_productora")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_oficina_productora"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_oficina_productora() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_oficina_productora")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_oficina_productora")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_oficina_productora"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_observaciones"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_observaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_observaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_observaciones" id="bqsaiaenlace_observaciones" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td><input type="hidden" name="bksaiacondicion_observaciones" id="bksaiacondicion_observaciones" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones" name="observaciones"></select><script>
                     $(document).ready(function()
                      {
                      $("#observaciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_anexos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_anexos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_anexos" id="bqsaiaenlace_anexos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ANEXOS</td><input type="hidden" name="bksaiacondicion_anexos" id="bksaiacondicion_anexos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexos" name="anexos"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_entregado_por',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_entregado_por',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_entregado_por" id="bqsaiaenlace_entregado_por" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">ENTREGADO POR</td><input type="hidden" name="bksaiacondicion_entregado_por" id="bksaiacondicion_entregado_por" value="like"><td bgcolor="#F5F5F5"><div id="esperando_entregado_por"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(343,4000,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_entregado_por" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_entregado_por.findItem((document.getElementById('stext_entregado_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_entregado_por" height="90%"></div><input type="hidden" maxlength="255"  name="entregado_por" id="entregado_por"   value="" ><label style="display:none" class="error" for="entregado_por">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_entregado_por=new dhtmlXTreeObject("treeboxbox_entregado_por","100%","100%",0);
                			tree_entregado_por.setImagePath("../../imgs/");
                			tree_entregado_por.enableIEImageFix(true);tree_entregado_por.enableCheckBoxes(1);
                    tree_entregado_por.enableRadioButtons(true);tree_entregado_por.setOnLoadingStart(cargando_entregado_por);
                      tree_entregado_por.setOnLoadingEnd(fin_cargando_entregado_por);tree_entregado_por.enableSmartXMLParsing(true);tree_entregado_por.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_entregado_por.setOnCheckHandler(onNodeSelect_entregado_por);
                      function onNodeSelect_entregado_por(nodeId)
                      {valor_destino=document.getElementById("entregado_por");
                       destinos=tree_entregado_por.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_entregado_por.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_entregado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_entregado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_entregado_por")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_entregado_por"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_entregado_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_entregado_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_entregado_por")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_entregado_por"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_recibido_por',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_recibido_por',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_recibido_por" id="bqsaiaenlace_recibido_por" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">RECIBIDO POR</td><input type="hidden" name="bksaiacondicion_recibido_por" id="bksaiacondicion_recibido_por" value="like"><td bgcolor="#F5F5F5"><div id="esperando_recibido_por"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(343,4001,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_recibido_por" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_recibido_por.findItem((document.getElementById('stext_recibido_por').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_recibido_por" height="90%"></div><input type="hidden" maxlength="255"  name="recibido_por" id="recibido_por"   value="" ><label style="display:none" class="error" for="recibido_por">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_recibido_por=new dhtmlXTreeObject("treeboxbox_recibido_por","100%","100%",0);
                			tree_recibido_por.setImagePath("../../imgs/");
                			tree_recibido_por.enableIEImageFix(true);tree_recibido_por.enableCheckBoxes(1);
                    tree_recibido_por.enableRadioButtons(true);tree_recibido_por.setOnLoadingStart(cargando_recibido_por);
                      tree_recibido_por.setOnLoadingEnd(fin_cargando_recibido_por);tree_recibido_por.enableSmartXMLParsing(true);tree_recibido_por.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_recibido_por.setOnCheckHandler(onNodeSelect_recibido_por);
                      function onNodeSelect_recibido_por(nodeId)
                      {valor_destino=document.getElementById("recibido_por");
                       destinos=tree_recibido_por.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_recibido_por.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_recibido_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_recibido_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_recibido_por")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_recibido_por"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_recibido_por() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_recibido_por")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_recibido_por")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_recibido_por"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_transferir_a',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_transferir_a',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_transferir_a" id="bqsaiaenlace_transferir_a" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TRANSFERIR A</td><input type="hidden" name="bksaiacondicion_transferir_a" id="bksaiacondicion_transferir_a" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(343,4002,'',1,'buscar');?></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_agrupador',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_agrupador',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_agrupador" id="bqsaiaenlace_agrupador" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">AGRUPADOR</td><input type="hidden" name="bksaiacondicion_agrupador" id="bksaiacondicion_agrupador" value="like"><td bgcolor="#F5F5F5"><div id="esperando_agrupador"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(343,6752,'3',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_agrupador" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_agrupador.findItem((document.getElementById('stext_agrupador').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_agrupador.findItem((document.getElementById('stext_agrupador').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_agrupador.findItem((document.getElementById('stext_agrupador').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_agrupador" height="90%"></div><input type="hidden" maxlength="11"  name="agrupador" id="agrupador"   value="" ><label style="display:none" class="error" for="agrupador">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_agrupador=new dhtmlXTreeObject("treeboxbox_agrupador","100%","100%",0);
                			tree_agrupador.setImagePath("../../imgs/");
                			tree_agrupador.enableIEImageFix(true);tree_agrupador.enableCheckBoxes(1);
                    tree_agrupador.enableRadioButtons(true);tree_agrupador.setOnLoadingStart(cargando_agrupador);
                      tree_agrupador.setOnLoadingEnd(fin_cargando_agrupador);tree_agrupador.setXMLAutoLoading("../../vacio.php");tree_agrupador.loadXML("../../vacio.php");
                      tree_agrupador.setOnCheckHandler(onNodeSelect_agrupador);
                      function onNodeSelect_agrupador(nodeId)
                      {valor_destino=document.getElementById("agrupador");
                       destinos=tree_agrupador.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_agrupador.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_agrupador() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_agrupador")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_agrupador")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_agrupador"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_agrupador() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_agrupador")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_agrupador")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_agrupador"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_expedientes_padre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_expedientes_padre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_expedientes_padre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_expedientes_padre" id="bqsaiaenlace_expedientes_padre" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">PADRES</td><input type="hidden" name="bksaiacondicion_expedientes_padre" id="bksaiacondicion_expedientes_padre" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="expedientes_padre" name="expedientes_padre"></select><script>
                     $(document).ready(function()
                      {
                      $("#expedientes_padre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3997"><?php submit_formato(343);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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