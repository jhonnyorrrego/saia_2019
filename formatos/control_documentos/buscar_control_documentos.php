<html><title>.: SOLICITUD DE ELABORACI&OACUTE;N, MODIFICACI&OACUTE;N, ELIMINACI&OACUTE;N DE DOCUMENTOS:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA SOLICITUD DE ELABORACI&Oacute;N, MODIFICACI&Oacute;N, ELIMINACI&Oacute;N DE DOCUMENTOS</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_estado_doc_calidad"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado_doc_calidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado_doc_calidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado_doc_calidad" id="bqsaiaenlace_estado_doc_calidad" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ESTADO</td><input type="hidden" name="bksaiacondicion_estado_doc_calidad" id="bksaiacondicion_estado_doc_calidad" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6599,'',1,'buscar');?></td></tr><tr id="tr_estado_documento"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr id="tr_idformato_calidad"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idformato_calidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idformato_calidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idformato_calidad" id="bqsaiaenlace_idformato_calidad" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">IDFORMATO_CALIDAD</td><input type="hidden" name="bksaiacondicion_idformato_calidad" id="bksaiacondicion_idformato_calidad" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idformato_calidad" name="idformato_calidad"></select><script>
                     $(document).ready(function()
                      {
                      $("#idformato_calidad").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_iddocumento_calidad"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_iddocumento_calidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_iddocumento_calidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_iddocumento_calidad" id="bqsaiaenlace_iddocumento_calidad" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">IDDOCUMENTO CALIDAD</td><input type="hidden" name="bksaiacondicion_iddocumento_calidad" id="bksaiacondicion_iddocumento_calidad" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="iddocumento_calidad" name="iddocumento_calidad"></select><script>
                     $(document).ready(function()
                      {
                      $("#iddocumento_calidad").fcbkcomplete({
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
                    </tr><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Solicitud de elaboraci&oacute;n, modificaci&oacute;n, eliminaci&oacute;n de documentos">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_solicitud"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_solicitud" id="bqsaiaenlace_tipo_solicitud" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TIPO SOLICITUD</td><input type="hidden" name="bksaiacondicion_tipo_solicitud" id="bksaiacondicion_tipo_solicitud" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6332,'',1,'buscar');?></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_secretaria',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_secretaria',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_secretaria" id="bqsaiaenlace_secretaria" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">DEPENDENCIAS PARTICIPANTES</td><input type="hidden" name="bksaiacondicion_secretaria" id="bksaiacondicion_secretaria" value="like"><td bgcolor="#F5F5F5"><div id="esperando_secretaria"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,6333,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_secretaria" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_secretaria.findItem((document.getElementById('stext_secretaria').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_secretaria.findItem((document.getElementById('stext_secretaria').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_secretaria.findItem((document.getElementById('stext_secretaria').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_secretaria" height="90%"></div><input type="hidden" maxlength="255"  name="secretaria" id="secretaria"   value="" ><label style="display:none" class="error" for="secretaria">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_secretaria=new dhtmlXTreeObject("treeboxbox_secretaria","100%","100%",0);
                			tree_secretaria.setImagePath("../../imgs/");
                			tree_secretaria.enableIEImageFix(true);tree_secretaria.enableCheckBoxes(1);
                			tree_secretaria.enableThreeStateCheckboxes(1);tree_secretaria.setOnLoadingStart(cargando_secretaria);
                      tree_secretaria.setOnLoadingEnd(fin_cargando_secretaria);tree_secretaria.enableSmartXMLParsing(true);tree_secretaria.loadXML("../../test_serie.php?tabla=dependencia&estado=1");
                      tree_secretaria.setOnCheckHandler(onNodeSelect_secretaria);
                      function onNodeSelect_secretaria(nodeId)
                      {valor_destino=document.getElementById("secretaria");
                       destinos=tree_secretaria.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_secretaria.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_secretaria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_secretaria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_secretaria")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_secretaria"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_secretaria() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_secretaria")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_secretaria")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_secretaria"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_listado_procesos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_listado_procesos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_listado_procesos" id="bqsaiaenlace_listado_procesos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">PROCESO/SUBPROCESO</td><input type="hidden" name="bksaiacondicion_listado_procesos" id="bksaiacondicion_listado_procesos" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6334,'',1,'buscar');?></td></tr><tr id="tr_tipo_documento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_documento" id="bqsaiaenlace_tipo_documento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TIPO DOCUMENTO</td><input type="hidden" name="bksaiacondicion_tipo_documento" id="bksaiacondicion_tipo_documento" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6338,'',1,'buscar');?></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_doc_control',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_doc_control',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_doc_control" id="bqsaiaenlace_serie_doc_control" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_doc_control" id="bksaiacondicion_serie_doc_control" value="like"><td bgcolor="#F5F5F5"><div id="esperando_serie_doc_control"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,6339,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_serie_doc_control" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_serie_doc_control.findItem((document.getElementById('stext_serie_doc_control').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_serie_doc_control.findItem((document.getElementById('stext_serie_doc_control').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_serie_doc_control.findItem((document.getElementById('stext_serie_doc_control').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_serie_doc_control" height="90%"></div><input type="hidden" maxlength="255"  name="serie_doc_control" id="serie_doc_control"   value="" ><label style="display:none" class="error" for="serie_doc_control">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_serie_doc_control=new dhtmlXTreeObject("treeboxbox_serie_doc_control","100%","100%",0);
                			tree_serie_doc_control.setImagePath("../../imgs/");
                			tree_serie_doc_control.enableIEImageFix(true);tree_serie_doc_control.enableCheckBoxes(1);
                    tree_serie_doc_control.enableRadioButtons(true);tree_serie_doc_control.setOnLoadingStart(cargando_serie_doc_control);
                      tree_serie_doc_control.setOnLoadingEnd(fin_cargando_serie_doc_control);tree_serie_doc_control.enableSmartXMLParsing(true);tree_serie_doc_control.loadXML("../../test_serie_funcionario.php");
                      tree_serie_doc_control.setOnCheckHandler(onNodeSelect_serie_doc_control);
                      function onNodeSelect_serie_doc_control(nodeId)
                      {valor_destino=document.getElementById("serie_doc_control");
                       destinos=tree_serie_doc_control.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_serie_doc_control.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_serie_doc_control() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie_doc_control")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie_doc_control")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_serie_doc_control"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_serie_doc_control() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie_doc_control")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie_doc_control")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_serie_doc_control"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_otros_documentos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_otros_documentos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_otros_documentos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_otros_documentos" id="bqsaiaenlace_otros_documentos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">OTROS DOCUMENTOS</td><input type="hidden" name="bksaiacondicion_otros_documentos" id="bksaiacondicion_otros_documentos" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6340,'',1,'buscar');?></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_almacenamiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_almacenamiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_almacenamiento" id="bqsaiaenlace_almacenamiento" value="y" />
		</div>
                  <td class="encabezado" width="20%" title="">ALMACENAMIENTO</td><input type="hidden" name="bksaiacondicion_almacenamiento" id="bksaiacondicion_almacenamiento" value="like"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,6341,'',1,'buscar');?></td></tr><tr id="tr_nombre_documento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre_documento" id="bqsaiaenlace_nombre_documento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">NOMBRE DOCUMENTO</td><input type="hidden" name="bksaiacondicion_nombre_documento" id="bksaiacondicion_nombre_documento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_documento" name="nombre_documento"></select><script>
                     $(document).ready(function()
                      {
                      $("#nombre_documento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_documento_calidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_documento_calidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_documento_calidad" id="bqsaiaenlace_documento_calidad" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">DOCUMENTO DE CALIDAD VINCULADO</td><input type="hidden" name="bksaiacondicion_documento_calidad" id="bksaiacondicion_documento_calidad" value="like"><td bgcolor="#F5F5F5"><div id="esperando_documento_calidad"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,6343,'2',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_documento_calidad" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_documento_calidad.findItem((document.getElementById('stext_documento_calidad').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_documento_calidad" height="90%"></div><input type="hidden"  name="documento_calidad" id="documento_calidad"   value="" ><label style="display:none" class="error" for="documento_calidad">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_documento_calidad=new dhtmlXTreeObject("treeboxbox_documento_calidad","100%","100%",0);
                			tree_documento_calidad.setImagePath("../../imgs/");
                			tree_documento_calidad.enableIEImageFix(true);tree_documento_calidad.enableCheckBoxes(1);
                    tree_documento_calidad.enableRadioButtons(true);tree_documento_calidad.setOnLoadingStart(cargando_documento_calidad);
                      tree_documento_calidad.setOnLoadingEnd(fin_cargando_documento_calidad);tree_documento_calidad.enableSmartXMLParsing(true);tree_documento_calidad.loadXML("test_documentos_calidad.php");
                      tree_documento_calidad.setOnCheckHandler(onNodeSelect_documento_calidad);
                      function onNodeSelect_documento_calidad(nodeId)
                      {valor_destino=document.getElementById("documento_calidad");
                       destinos=tree_documento_calidad.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_documento_calidad.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_documento_calidad() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_documento_calidad")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_documento_calidad")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_documento_calidad"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_documento_calidad() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_documento_calidad")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_documento_calidad")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_documento_calidad"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_justificacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_justificacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_justificacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_justificacion" id="bqsaiaenlace_justificacion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">JUSTIFICACION</td><input type="hidden" name="bksaiacondicion_justificacion" id="bksaiacondicion_justificacion" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="justificacion" name="justificacion"></select><script>
                     $(document).ready(function()
                      {
                      $("#justificacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_propuesta"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_propuesta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_propuesta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_propuesta" id="bqsaiaenlace_propuesta" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">PROPUESTA</td><input type="hidden" name="bksaiacondicion_propuesta" id="bksaiacondicion_propuesta" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="propuesta" name="propuesta"></select><script>
                     $(document).ready(function()
                      {
                      $("#propuesta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexo_formato"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_anexo_formato',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_anexo_formato',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_anexo_formato" id="bqsaiaenlace_anexo_formato" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ANEXO FORMATO</td><input type="hidden" name="bksaiacondicion_anexo_formato" id="bksaiacondicion_anexo_formato" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexo_formato" name="anexo_formato"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexo_formato").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_revisado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_revisado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_revisado" id="bqsaiaenlace_revisado" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">REVISADO POR</td><input type="hidden" name="bksaiacondicion_revisado" id="bksaiacondicion_revisado" value="like"><td bgcolor="#F5F5F5"><div id="esperando_revisado"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,6347,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_revisado" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_revisado.findItem((document.getElementById('stext_revisado').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_revisado" height="90%"></div><input type="hidden" maxlength="255"  name="revisado" id="revisado"   value="" ><label style="display:none" class="error" for="revisado">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_revisado=new dhtmlXTreeObject("treeboxbox_revisado","100%","100%",0);
                			tree_revisado.setImagePath("../../imgs/");
                			tree_revisado.enableIEImageFix(true);tree_revisado.enableCheckBoxes(1);
                    tree_revisado.enableRadioButtons(true);tree_revisado.setOnLoadingStart(cargando_revisado);
                      tree_revisado.setOnLoadingEnd(fin_cargando_revisado);tree_revisado.enableSmartXMLParsing(true);tree_revisado.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_revisado.setOnCheckHandler(onNodeSelect_revisado);
                      function onNodeSelect_revisado(nodeId)
                      {valor_destino=document.getElementById("revisado");
                       destinos=tree_revisado.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_revisado.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_revisado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_revisado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_revisado")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_revisado"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_revisado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_revisado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_revisado")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_revisado"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_aprobado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_aprobado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_aprobado" id="bqsaiaenlace_aprobado" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">APROBADO POR</td><input type="hidden" name="bksaiacondicion_aprobado" id="bksaiacondicion_aprobado" value="like"><td bgcolor="#F5F5F5"><div id="esperando_aprobado"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,6348,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_aprobado" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_aprobado.findItem((document.getElementById('stext_aprobado').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_aprobado" height="90%"></div><input type="hidden" maxlength="255"  name="aprobado" id="aprobado"   value="" ><label style="display:none" class="error" for="aprobado">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_aprobado=new dhtmlXTreeObject("treeboxbox_aprobado","100%","100%",0);
                			tree_aprobado.setImagePath("../../imgs/");
                			tree_aprobado.enableIEImageFix(true);tree_aprobado.enableCheckBoxes(1);
                    tree_aprobado.enableRadioButtons(true);tree_aprobado.setOnLoadingStart(cargando_aprobado);
                      tree_aprobado.setOnLoadingEnd(fin_cargando_aprobado);tree_aprobado.enableSmartXMLParsing(true);tree_aprobado.loadXML("../../test.php?rol=1&sin_padre=1");
                      tree_aprobado.setOnCheckHandler(onNodeSelect_aprobado);
                      function onNodeSelect_aprobado(nodeId)
                      {valor_destino=document.getElementById("aprobado");
                       destinos=tree_aprobado.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_aprobado.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_aprobado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobado")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_aprobado"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_aprobado() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_aprobado")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_aprobado")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_aprobado"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_idft_control_documentos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_control_documentos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_control_documentos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_control_documentos" id="bqsaiaenlace_idft_control_documentos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CONTROL_DOCUMENTOS</td><input type="hidden" name="bksaiacondicion_idft_control_documentos" id="bksaiacondicion_idft_control_documentos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_control_documentos" name="idft_control_documentos"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_control_documentos").fcbkcomplete({
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
                    </tr><tr id="tr_fecha_confirmacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_confirmacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_confirmacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_confirmacion" id="bqsaiaenlace_fecha_confirmacion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FECHA CONFIRMACION</td><input type="hidden" name="bksaiacondicion_fecha_confirmacion" id="bksaiacondicion_fecha_confirmacion" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_confirmacion" name="fecha_confirmacion"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_confirmacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="6332"><?php submit_formato();?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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