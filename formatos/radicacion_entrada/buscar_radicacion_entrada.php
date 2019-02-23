<html><title>.: REGISTRO DE CORRESPONDENCIA:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_formatos_generales.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA REGISTRO DE CORRESPONDENCIA</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_despachado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_despachado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_despachado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_despachado" id="bqsaiaenlace_despachado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESPACHADO</td><input type="hidden" name="bksaiacondicion_despachado" id="bksaiacondicion_despachado" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="despachado" name="despachado"></select><script>
                     $(document).ready(function()
                      {
                      $("#despachado").fcbkcomplete({
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
                    </tr><tr id="tr_etiqueta_datos_gener">
                   <td class="encabezado" width="20%" title="">ETIQUETA_DATOS_GENER</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="etiqueta_datos_gener" value=""></td>
                  </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_radicacion_entrada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_radicacion_entrada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_radicacion_entrada" id="bqsaiaenlace_fecha_radicacion_entrada" value="y" />
		</div>
                    <td class="encabezado" width="20%" title="">FECHA DE RADICACI&Oacute;N</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_radicacion_entrada_1"  id="fecha_radicacion_entrada_1" value=""><?php selector_fecha("fecha_radicacion_entrada_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_radicacion_entrada_2"  id="fecha_radicacion_entrada_2" value=""><?php selector_fecha("fecha_radicacion_entrada_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr id="tr_numero_radicado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_numero_radicado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_numero_radicado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_numero_radicado" id="bqsaiaenlace_numero_radicado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE RADICADO</td><input type="hidden" name="bksaiacondicion_numero_radicado" id="bksaiacondicion_numero_radicado" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="numero_radicado" name="numero_radicado"></select><script>
                     $(document).ready(function()
                      {
                      $("#numero_radicado").fcbkcomplete({
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
                     <td class="encabezado" width="20%" title="">ORIGEN DEL DOCUMENTO</td><input type="hidden" name="bksaiacondicion_tipo_origen" id="bksaiacondicion_tipo_origen" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,4966,'',1,'buscar');?></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_documento" id="bqsaiaenlace_fecha_documento" value="y" />
		</div>
                       <td class="encabezado" width="20%" title="">FECHA DEL DOCUMENTO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_documento_1" id="fecha_documento_1" tipo="fecha" value=""><?php selector_fecha("fecha_documento_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_documento_2" id="fecha_documento_2" tipo="fecha" value=""><?php selector_fecha("fecha_documento_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr id="tr_numero_oficio"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_numero_oficio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_numero_oficio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_numero_oficio" id="bqsaiaenlace_numero_oficio" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE DOCUMENTO</td><input type="hidden" name="bksaiacondicion_numero_oficio" id="bksaiacondicion_numero_oficio" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="numero_oficio" name="numero_oficio"></select><script>
                     $(document).ready(function()
                      {
                      $("#numero_oficio").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_descripcion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_descripcion" id="bqsaiaenlace_descripcion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ASUNTO</td><input type="hidden" name="bksaiacondicion_descripcion" id="bksaiacondicion_descripcion" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion" name="descripcion"></select><script>
                     $(document).ready(function()
                      {
                      $("#descripcion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_descripcion_anexos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_descripcion_anexos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_descripcion_anexos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_descripcion_anexos" id="bqsaiaenlace_descripcion_anexos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ANEXOS FISICOS</td><input type="hidden" name="bksaiacondicion_descripcion_anexos" id="bksaiacondicion_descripcion_anexos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion_anexos" name="descripcion_anexos"></select><script>
                     $(document).ready(function()
                      {
                      $("#descripcion_anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexos_digitales"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_anexos_digitales',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_anexos_digitales',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_anexos_digitales" id="bqsaiaenlace_anexos_digitales" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ANEXOS DIGITALES</td><input type="hidden" name="bksaiacondicion_anexos_digitales" id="bksaiacondicion_anexos_digitales" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexos_digitales" name="anexos_digitales"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos_digitales").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_requiere_recogida"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_requiere_recogida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_requiere_recogida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_requiere_recogida" id="bqsaiaenlace_requiere_recogida" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">REQUIERE SERVICIO DE RECOGIDA?</td><input type="hidden" name="bksaiacondicion_requiere_recogida" id="bksaiacondicion_requiere_recogida" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,5199,'',1,'buscar');?></td></tr><tr id="tr_tipo_mensajeria"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_mensajeria',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_mensajeria',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_mensajeria" id="bqsaiaenlace_tipo_mensajeria" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">REQUIERE SERVICIO DE ENTREGA?</td><input type="hidden" name="bksaiacondicion_tipo_mensajeria" id="bksaiacondicion_tipo_mensajeria" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,4970,'',1,'buscar');?></td></tr><tr id="tr_numero_guia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_numero_guia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_numero_guia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_numero_guia" id="bqsaiaenlace_numero_guia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE GU&Iacute;A</td><input type="hidden" name="bksaiacondicion_numero_guia" id="bksaiacondicion_numero_guia" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="numero_guia" name="numero_guia"></select><script>
                     $(document).ready(function()
                      {
                      $("#numero_guia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_empresa_transportado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_empresa_transportado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_empresa_transportado" id="bqsaiaenlace_empresa_transportado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">EMPRESA TRANSPORTADORA</td><input type="hidden" name="bksaiacondicion_empresa_transportado" id="bksaiacondicion_empresa_transportado" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,5084,'',1,'buscar');?></td></tr><tr id="tr_etiqueta_origen">
                   <td class="encabezado" width="20%" title="">ETIQUETA_ORIGEN</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="etiqueta_origen" value=""></td>
                  </tr><tr id="tr_persona_natural"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_persona_natural',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_persona_natural',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_persona_natural" id="bqsaiaenlace_persona_natural" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">PERSONA NATURAL/JUR&Iacute;DICA*</td><input type="hidden" name="bksaiacondicion_persona_natural" id="bksaiacondicion_persona_natural" value="like">
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="persona_natural" name="persona_natural"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() {
                      $("#persona_natural").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_area_responsable',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_area_responsable',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_area_responsable" id="bqsaiaenlace_area_responsable" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">FUNCIONARIO RESPONSABLE*</td><input type="hidden" name="bksaiacondicion_area_responsable" id="bksaiacondicion_area_responsable" value="like"><td bgcolor="#F5F5F5"><div id="esperando_area_responsable"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(3,4967,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_area_responsable" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_area_responsable.findItem((document.getElementById('stext_area_responsable').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_area_responsable" height="90%"></div><input type="hidden" maxlength="255"  name="area_responsable" id="area_responsable"   value="" ><label style="display:none" class="error" for="area_responsable">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_area_responsable=new dhtmlXTreeObject("treeboxbox_area_responsable","100%","100%",0);
                			tree_area_responsable.setImagePath("../../imgs/");
                			tree_area_responsable.enableIEImageFix(true);tree_area_responsable.enableCheckBoxes(1);
                    tree_area_responsable.enableRadioButtons(true);tree_area_responsable.setOnLoadingStart(cargando_area_responsable);
                      tree_area_responsable.setOnLoadingEnd(fin_cargando_area_responsable);tree_area_responsable.enableSmartXMLParsing(true);tree_area_responsable.loadXML("../../test.php?sin_padre=1&rol=1");
                      tree_area_responsable.setOnCheckHandler(onNodeSelect_area_responsable);
                      function onNodeSelect_area_responsable(nodeId)
                      {valor_destino=document.getElementById("area_responsable");
                       destinos=tree_area_responsable.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_area_responsable.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_area_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsable")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_area_responsable"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_area_responsable() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_area_responsable")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_area_responsable")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_area_responsable"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_etiqueta_destino">
                   <td class="encabezado" width="20%" title="">ETIQUETA_DESTINO</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="etiqueta_destino" value=""></td>
                  </tr><tr id="tr_tipo_destino"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_destino" id="bqsaiaenlace_tipo_destino" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESTINO DEL DOCUMENTO</td><input type="hidden" name="bksaiacondicion_tipo_destino" id="bksaiacondicion_tipo_destino" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,4968,'',1,'buscar');?></td></tr><tr id="tr_destino"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_destino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_destino" id="bqsaiaenlace_destino" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESTINO*</td><input type="hidden" name="bksaiacondicion_destino" id="bksaiacondicion_destino" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="destino" name="destino"></select><script>
                     $(document).ready(function()
                      {
                      $("#destino").fcbkcomplete({
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
                   <td class="encabezado" width="20%" title="Radicacion entrada">TIPO DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like"><td bgcolor="#F5F5F5"><div id="esperando_serie_idserie"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(3,52,'1',$_REQUEST['iddoc']);?></div>
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
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_copia_a',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_copia_a',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_copia_a" id="bqsaiaenlace_copia_a" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">COPIA ELECTR&OACUTE;NICA A</td><input type="hidden" name="bksaiacondicion_copia_a" id="bksaiacondicion_copia_a" value="like"><td bgcolor="#F5F5F5"><div id="esperando_copia_a"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(3,44,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_copia_a" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia_a.findItem((document.getElementById('stext_copia_a').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_a.findItem((document.getElementById('stext_copia_a').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia_a.findItem((document.getElementById('stext_copia_a').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_copia_a" height="90%"></div><input type="hidden"  name="copia_a" id="copia_a"   value="" ><label style="display:none" class="error" for="copia_a">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_a=new dhtmlXTreeObject("treeboxbox_copia_a","100%","100%",0);
                			tree_copia_a.setImagePath("../../imgs/");
                			tree_copia_a.enableIEImageFix(true);tree_copia_a.enableCheckBoxes(1);
                			tree_copia_a.enableThreeStateCheckboxes(1);tree_copia_a.setOnLoadingStart(cargando_copia_a);
                      tree_copia_a.setOnLoadingEnd(fin_cargando_copia_a);tree_copia_a.enableSmartXMLParsing(true);tree_copia_a.loadXML("../../test.php?rol=1");
                      tree_copia_a.setOnCheckHandler(onNodeSelect_copia_a);
                      function onNodeSelect_copia_a(nodeId)
                      {valor_destino=document.getElementById("copia_a");
                       destinos=tree_copia_a.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_copia_a.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_copia_a() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_a")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_a")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_a"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia_a() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_a")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_a")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_a"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_persona_natural_dest"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_persona_natural_dest',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_persona_natural_dest',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_persona_natural_dest" id="bqsaiaenlace_persona_natural_dest" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">PERSONA NATURAL O JUR&Iacute;DICA*</td><input type="hidden" name="bksaiacondicion_persona_natural_dest" id="bksaiacondicion_persona_natural_dest" value="like">
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="persona_natural_dest" name="persona_natural_dest"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() {
                      $("#persona_natural_dest").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr id="tr_encabezado"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr id="tr_idft_radicacion_entrada"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_radicacion_entrada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_radicacion_entrada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_radicacion_entrada" id="bqsaiaenlace_idft_radicacion_entrada" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">RADICACION_ENTRADA</td><input type="hidden" name="bksaiacondicion_idft_radicacion_entrada" id="bksaiacondicion_idft_radicacion_entrada" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_radicacion_entrada" name="idft_radicacion_entrada"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_radicacion_entrada").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_estado_radicado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado_radicado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado_radicado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado_radicado" id="bqsaiaenlace_estado_radicado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="1:Aprobado
2:Iniciado">ESTADO DOCUMENTO</td><input type="hidden" name="bksaiacondicion_estado_radicado" id="bksaiacondicion_estado_radicado" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="estado_radicado" name="estado_radicado"></select><script>
                     $(document).ready(function()
                      {
                      $("#estado_radicado").fcbkcomplete({
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
                    </tr><tr id="tr_colilla"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_colilla',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_colilla',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_colilla" id="bqsaiaenlace_colilla" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">COLILLA</td><input type="hidden" name="bksaiacondicion_colilla" id="bksaiacondicion_colilla" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,7009,'',1,'buscar');?></td></tr><input type="hidden" name="campo_descripcion" value="39"><?php submit_formato(3);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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