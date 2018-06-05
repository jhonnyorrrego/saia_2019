<html><title>.: DESTINO_RADICACION:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA DESTINO_RADICACION</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="destino_radicacion">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_estado_recogida"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado_recogida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado_recogida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado_recogida" id="bqsaiaenlace_estado_recogida" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ESTADO_RECOGIDA</td><input type="hidden" name="bksaiacondicion_estado_recogida" id="bksaiacondicion_estado_recogida" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="estado_recogida" name="estado_recogida"></select><script>
                     $(document).ready(function()
                      {
                      $("#estado_recogida").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_mensajero"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_mensajero',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_mensajero',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_mensajero" id="bqsaiaenlace_tipo_mensajero" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TIPO_MENSAJERO</td><input type="hidden" name="bksaiacondicion_tipo_mensajero" id="bksaiacondicion_tipo_mensajero" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="tipo_mensajero" name="tipo_mensajero"></select><script>
                     $(document).ready(function()
                      {
                      $("#tipo_mensajero").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_ruta_origen"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ruta_origen',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ruta_origen',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ruta_origen" id="bqsaiaenlace_ruta_origen" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">RUTA_ORIGEN</td><input type="hidden" name="bksaiacondicion_ruta_origen" id="bksaiacondicion_ruta_origen" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="ruta_origen" name="ruta_origen"></select><script>
                     $(document).ready(function()
                      {
                      $("#ruta_origen").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_ruta_destino"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ruta_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ruta_destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ruta_destino" id="bqsaiaenlace_ruta_destino" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">RUTA_DESTINO</td><input type="hidden" name="bksaiacondicion_ruta_destino" id="bksaiacondicion_ruta_destino" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="ruta_destino" name="ruta_destino"></select><script>
                     $(document).ready(function()
                      {
                      $("#ruta_destino").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_finalizacion_observa"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_finalizacion_observa',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_finalizacion_observa',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_finalizacion_observa" id="bqsaiaenlace_finalizacion_observa" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FINALIZACION OBSERVACION</td><input type="hidden" name="bksaiacondicion_finalizacion_observa" id="bksaiacondicion_finalizacion_observa" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="finalizacion_observa" name="finalizacion_observa"></select><script>
                     $(document).ready(function()
                      {
                      $("#finalizacion_observa").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_idft_destino_radicacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_destino_radicacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_destino_radicacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_destino_radicacion" id="bqsaiaenlace_idft_destino_radicacion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESTINO_RADICACION</td><input type="hidden" name="bksaiacondicion_idft_destino_radicacion" id="bksaiacondicion_idft_destino_radicacion" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_destino_radicacion" name="idft_destino_radicacion"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_destino_radicacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_radicacion_entrada"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_radicacion_entrada"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_radicacion_entrada);} ?><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre_destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre_destino" id="bqsaiaenlace_nombre_destino" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">DESTINO*</td><input type="hidden" name="bksaiacondicion_nombre_destino" id="bksaiacondicion_nombre_destino" value="like"><td bgcolor="#F5F5F5"><div id="esperando_nombre_destino"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(,4972,'0',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_nombre_destino" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_nombre_destino.findItem((document.getElementById('stext_nombre_destino').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_nombre_destino.findItem((document.getElementById('stext_nombre_destino').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_nombre_destino.findItem((document.getElementById('stext_nombre_destino').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_nombre_destino" height="90%"></div><input type="hidden" maxlength="255"  name="nombre_destino" id="nombre_destino"   value="" ><label style="display:none" class="error" for="nombre_destino">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_nombre_destino=new dhtmlXTreeObject("treeboxbox_nombre_destino","100%","100%",0);
                			tree_nombre_destino.setImagePath("../../imgs/");
                			tree_nombre_destino.enableIEImageFix(true);tree_nombre_destino.enableCheckBoxes(1);
                    tree_nombre_destino.enableRadioButtons(true);tree_nombre_destino.setOnLoadingStart(cargando_nombre_destino);
                      tree_nombre_destino.setOnLoadingEnd(fin_cargando_nombre_destino);tree_nombre_destino.enableSmartXMLParsing(true);tree_nombre_destino.loadXML("../../test.php?sin_padre=1&rol=1");
                      tree_nombre_destino.setOnCheckHandler(onNodeSelect_nombre_destino);
                      function onNodeSelect_nombre_destino(nodeId)
                      {valor_destino=document.getElementById("nombre_destino");
                       destinos=tree_nombre_destino.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_nombre_destino.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_nombre_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_destino")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_nombre_destino"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_nombre_destino() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_nombre_destino")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_nombre_destino")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_nombre_destino"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_observacion_destino"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_observacion_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_observacion_destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_observacion_destino" id="bqsaiaenlace_observacion_destino" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">OBSERVACI&Oacute;N</td><input type="hidden" name="bksaiacondicion_observacion_destino" id="bksaiacondicion_observacion_destino" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="observacion_destino" name="observacion_destino"></select><script>
                     $(document).ready(function()
                      {
                      $("#observacion_destino").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_nombre_origen"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre_origen',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre_origen',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre_origen" id="bqsaiaenlace_nombre_origen" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ORIGEN*</td><input type="hidden" name="bksaiacondicion_nombre_origen" id="bksaiacondicion_nombre_origen" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_origen" name="nombre_origen"></select><script>
                     $(document).ready(function()
                      {
                      $("#nombre_origen").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_destino"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_destino" id="bqsaiaenlace_tipo_destino" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TIPO_DESTINO</td><input type="hidden" name="bksaiacondicion_tipo_destino" id="bksaiacondicion_tipo_destino" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="tipo_destino" name="tipo_destino"></select><script>
                     $(document).ready(function()
                      {
                      $("#tipo_destino").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_origen"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_origen',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_origen',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_origen" id="bqsaiaenlace_tipo_origen" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TIPO_ORIGEN</td><input type="hidden" name="bksaiacondicion_tipo_origen" id="bksaiacondicion_tipo_origen" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="tipo_origen" name="tipo_origen"></select><script>
                     $(document).ready(function()
                      {
                      $("#tipo_origen").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_destino_externo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_destino_externo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_destino_externo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_destino_externo" id="bqsaiaenlace_destino_externo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESTINO*</td><input type="hidden" name="bksaiacondicion_destino_externo" id="bksaiacondicion_destino_externo" value="like">
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="destino_externo" name="destino_externo"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() {
                      $("#destino_externo").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr id="tr_origen_externo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_origen_externo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_origen_externo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_origen_externo" id="bqsaiaenlace_origen_externo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ORIGEN*</td><input type="hidden" name="bksaiacondicion_origen_externo" id="bksaiacondicion_origen_externo" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="origen_externo" name="origen_externo"></select><script>
                     $(document).ready(function()
                      {
                      $("#origen_externo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_mensajero_encargado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_mensajero_encargado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_mensajero_encargado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_mensajero_encargado" id="bqsaiaenlace_mensajero_encargado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">MENSAJERO</td><input type="hidden" name="bksaiacondicion_mensajero_encargado" id="bksaiacondicion_mensajero_encargado" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="mensajero_encargado" name="mensajero_encargado"></select><script>
                     $(document).ready(function()
                      {
                      $("#mensajero_encargado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_numero_item"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_numero_item',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_numero_item',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_numero_item" id="bqsaiaenlace_numero_item" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">NO. ITEM</td><input type="hidden" name="bksaiacondicion_numero_item" id="bksaiacondicion_numero_item" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="numero_item" name="numero_item"></select><script>
                     $(document).ready(function()
                      {
                      $("#numero_item").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_recepcion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_recepcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_recepcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_recepcion" id="bqsaiaenlace_recepcion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FINALIZACION</td><input type="hidden" name="bksaiacondicion_recepcion" id="bksaiacondicion_recepcion" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="recepcion" name="recepcion"></select><script>
                     $(document).ready(function()
                      {
                      $("#recepcion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_recepcion_fecha"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_recepcion_fecha',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_recepcion_fecha',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_recepcion_fecha" id="bqsaiaenlace_recepcion_fecha" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FECHA DE RECEPCION</td><input type="hidden" name="bksaiacondicion_recepcion_fecha" id="bksaiacondicion_recepcion_fecha" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="recepcion_fecha" name="recepcion_fecha"></select><script>
                     $(document).ready(function()
                      {
                      $("#recepcion_fecha").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_estado_item"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado_item',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado_item',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado_item" id="bqsaiaenlace_estado_item" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ESTADO ITEM</td><input type="hidden" name="bksaiacondicion_estado_item" id="bksaiacondicion_estado_item" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="estado_item" name="estado_item"></select><script>
                     $(document).ready(function()
                      {
                      $("#estado_item").fcbkcomplete({
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
                     <td class="encabezado" width="20%" title="Indica si el item ya tiene un soporte de planilla de mensajero anexado.">ANEXOS</td><input type="hidden" name="bksaiacondicion_anexos" id="bksaiacondicion_anexos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexos" name="anexos"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="destino_radicacion"><?php submit_formato();?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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