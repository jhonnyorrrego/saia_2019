<html><title>.: COMUNICACI&OACUTE;N INTERNA:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("funciones.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA COMUNICACI&Oacute;N INTERNA</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_expediente_serie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_expediente_serie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_expediente_serie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_expediente_serie" id="bqsaiaenlace_expediente_serie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">EXPEDIENTE_SERIE</td><input type="hidden" name="bksaiacondicion_expediente_serie" id="bksaiacondicion_expediente_serie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="expediente_serie" name="expediente_serie"></select><script>
                     $(document).ready(function()
                      {
                      $("#expediente_serie").fcbkcomplete({
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
                    </tr><tr id="tr_dependencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_dependencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_dependencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_dependencia" id="bqsaiaenlace_dependencia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA</td><input type="hidden" name="bksaiacondicion_dependencia" id="bksaiacondicion_dependencia" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="dependencia" name="dependencia"></select><script>
                     $(document).ready(function()
                      {
                      $("#dependencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_idft_memorando"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_memorando',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_memorando',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_memorando" id="bqsaiaenlace_idft_memorando" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">MEMORANDO</td><input type="hidden" name="bksaiacondicion_idft_memorando" id="bksaiacondicion_idft_memorando" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_memorando" name="idft_memorando"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_memorando").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_fecha_memorando"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_memorando',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_memorando',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_memorando" id="bqsaiaenlace_fecha_memorando" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FECHA</td><input type="hidden" name="bksaiacondicion_fecha_memorando" id="bksaiacondicion_fecha_memorando" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_memorando" name="fecha_memorando"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_memorando").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">CLASIFICAR EN EXPEDIENTE</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like"><td bgcolor="#F5F5F5"><div id="esperando_serie_idserie"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(2,28,'1',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_serie_idserie" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_serie_idserie.findItem((document.getElementById('stext_serie_idserie').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_serie_idserie" height="90%"></div><input type="hidden" maxlength="11"  name="serie_idserie" id="serie_idserie"   value="" ><label style="display:none" class="error" for="serie_idserie">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_serie_idserie=new dhtmlXTreeObject("treeboxbox_serie_idserie","100%","100%",0);
                			tree_serie_idserie.setImagePath("../../imgs/");
                			tree_serie_idserie.enableIEImageFix(true);tree_serie_idserie.enableCheckBoxes(1);
                    tree_serie_idserie.enableRadioButtons(true);tree_serie_idserie.setOnLoadingStart(cargando_serie_idserie);
                      tree_serie_idserie.setOnLoadingEnd(fin_cargando_serie_idserie);tree_serie_idserie.enableSmartXMLParsing(true);tree_serie_idserie.loadXML("../../test/test_expediente_funcionario.php");
                      tree_serie_idserie.setOnCheckHandler(onNodeSelect_serie_idserie);
                      function onNodeSelect_serie_idserie(nodeId)
                      {valor_destino=document.getElementById("serie_idserie");
                       destinos=tree_serie_idserie.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_serie_idserie.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_serie_idserie() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie_idserie")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie_idserie")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_serie_idserie"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_serie_idserie() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie_idserie")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie_idserie")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_serie_idserie"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_destino" id="bqsaiaenlace_destino" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">DESTINO</td><input type="hidden" name="bksaiacondicion_destino" id="bksaiacondicion_destino" value="like"><td bgcolor="#F5F5F5"><div id="esperando_destino"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(2,21,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_destino" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_destino.findItem((document.getElementById('stext_destino').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_destino" height="90%"></div><input type="hidden" maxlength="2000"  name="destino" id="destino"   value="" ><label style="display:none" class="error" for="destino">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_destino=new dhtmlXTreeObject("treeboxbox_destino","100%","100%",0);
                			tree_destino.setImagePath("../../imgs/");
                			tree_destino.enableIEImageFix(true);tree_destino.enableCheckBoxes(1);
                			tree_destino.enableThreeStateCheckboxes(1);tree_destino.setOnLoadingStart(cargando_destino);
                      tree_destino.setOnLoadingEnd(fin_cargando_destino);tree_destino.enableSmartXMLParsing(true);tree_destino.loadXML("../../test.php?rol=1");
                      tree_destino.setOnCheckHandler(onNodeSelect_destino);
                      function onNodeSelect_destino(nodeId)
                      {valor_destino=document.getElementById("destino");
                       destinos=tree_destino.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_destino.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_destino"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_destino")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_destino"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_documento_iddocumento"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_copia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_copia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_copia" id="bqsaiaenlace_copia" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">CON COPIA A</td><input type="hidden" name="bksaiacondicion_copia" id="bksaiacondicion_copia" value="like"><td bgcolor="#F5F5F5"><div id="esperando_copia"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(2,22,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_copia" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_copia" height="90%"></div><input type="hidden" maxlength="2000"  name="copia" id="copia"   value="" ><label style="display:none" class="error" for="copia">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia=new dhtmlXTreeObject("treeboxbox_copia","100%","100%",0);
                			tree_copia.setImagePath("../../imgs/");
                			tree_copia.enableIEImageFix(true);tree_copia.enableCheckBoxes(1);
                			tree_copia.enableThreeStateCheckboxes(1);tree_copia.setOnLoadingStart(cargando_copia);
                      tree_copia.setOnLoadingEnd(fin_cargando_copia);tree_copia.enableSmartXMLParsing(true);tree_copia.loadXML("../../test.php?rol=1");
                      tree_copia.setOnCheckHandler(onNodeSelect_copia);
                      function onNodeSelect_copia(nodeId)
                      {valor_destino=document.getElementById("copia");
                       destinos=tree_copia.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_copia.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_copia() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_asunto"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_asunto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_asunto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_asunto" id="bqsaiaenlace_asunto" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ASUNTO</td><input type="hidden" name="bksaiacondicion_asunto" id="bksaiacondicion_asunto" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="asunto" name="asunto"></select><script>
                     $(document).ready(function()
                      {
                      $("#asunto").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_contenido"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_contenido',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_contenido',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_contenido" id="bqsaiaenlace_contenido" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CONTENIDO</td><input type="hidden" name="bksaiacondicion_contenido" id="bksaiacondicion_contenido" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="contenido" name="contenido"></select><script>
                     $(document).ready(function()
                      {
                      $("#contenido").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_despedida"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_despedida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_despedida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_despedida" id="bqsaiaenlace_despedida" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESPEDIDA</td><input type="hidden" name="bksaiacondicion_despedida" id="bksaiacondicion_despedida" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="despedida" name="despedida"></select><script>
                     $(document).ready(function()
                      {
                      $("#despedida").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_iniciales"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_iniciales',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_iniciales',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_iniciales" id="bqsaiaenlace_iniciales" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">INICIALES DE QUIEN PREPARO EL MEMORANDO</td><input type="hidden" name="bksaiacondicion_iniciales" id="bksaiacondicion_iniciales" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="iniciales" name="iniciales"></select><script>
                     $(document).ready(function()
                      {
                      $("#iniciales").fcbkcomplete({
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
                     <td class="encabezado" width="20%" title="Anexos digitales">ANEXOS DIGITALES</td><input type="hidden" name="bksaiacondicion_anexos" id="bksaiacondicion_anexos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexos" name="anexos"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexos_fisicos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_anexos_fisicos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_anexos_fisicos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_anexos_fisicos" id="bqsaiaenlace_anexos_fisicos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ANEXOS FISICOS</td><input type="hidden" name="bksaiacondicion_anexos_fisicos" id="bksaiacondicion_anexos_fisicos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexos_fisicos" name="anexos_fisicos"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos_fisicos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_email_aprobar"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_email_aprobar',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_email_aprobar',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_email_aprobar" id="bqsaiaenlace_email_aprobar" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">APROBAR FUERA DE SAIA</td><input type="hidden" name="bksaiacondicion_email_aprobar" id="bksaiacondicion_email_aprobar" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(2,5176,'',1,'buscar');?></td></tr><input type="hidden" name="campo_descripcion" value="23,6921"><?php submit_formato(2);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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