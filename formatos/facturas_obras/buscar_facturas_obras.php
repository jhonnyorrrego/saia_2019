<html><title>.: RADICACI&OACUTE;N FACTURAS DE OBRA:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/><?php echo(librerias_jquery('1.7')); ?><script type="text/javascript" src="../../js/selectize.js"></script><link rel="stylesheet" type="text/css" href="../../css/selectize.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA RADICACI&Oacute;N FACTURAS DE OBRA</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_dependencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_dependencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_dependencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_dependencia" id="bqsaiaenlace_dependencia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">VENTANILLA DEL CREADOR DEL DOCUMENTO</td><input type="hidden" name="bksaiacondicion_dependencia" id="bksaiacondicion_dependencia" value="like">
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
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_radicacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_radicacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_radicacion" id="bqsaiaenlace_fecha_radicacion" value="y" />
		</div>
                    <td class="encabezado" width="20%" title="">FECHA DE RADICACI&Oacute;N</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_radicacion_1"  id="fecha_radicacion_1" value=""><?php selector_fecha("fecha_radicacion_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_radicacion_2"  id="fecha_radicacion_2" value=""><?php selector_fecha("fecha_radicacion_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr id="tr_numero_radicado"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_factura" id="bqsaiaenlace_fecha_factura" value="y" />
		</div>
                       <td class="encabezado" width="20%" title="">FECHA DE LA FACTURA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_factura_1" id="fecha_factura_1" tipo="fecha" value=""><?php selector_fecha("fecha_factura_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_factura_2" id="fecha_factura_2" tipo="fecha" value=""><?php selector_fecha("fecha_factura_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr id="tr_numero_factura"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_numero_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_numero_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_numero_factura" id="bqsaiaenlace_numero_factura" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FACTURA</td><input type="hidden" name="bksaiacondicion_numero_factura" id="bksaiacondicion_numero_factura" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="numero_factura" name="numero_factura"></select><script>
                     $(document).ready(function()
                      {
                      $("#numero_factura").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_concepto_factura"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_concepto_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_concepto_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_concepto_factura" id="bqsaiaenlace_concepto_factura" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CONCEPTO DE LA FACTURA</td><input type="hidden" name="bksaiacondicion_concepto_factura" id="bksaiacondicion_concepto_factura" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="concepto_factura" name="concepto_factura"></select><script>
                     $(document).ready(function()
                      {
                      $("#concepto_factura").fcbkcomplete({
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
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_vence_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_vence_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_vence_factura" id="bqsaiaenlace_vence_factura" value="y" />
		</div>
                       <td class="encabezado" width="20%" title="">VENCIMIENTO DE LA FACTURA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="vence_factura_1" id="vence_factura_1" tipo="fecha" value=""><?php selector_fecha("vence_factura_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="vence_factura_2" id="vence_factura_2" tipo="fecha" value=""><?php selector_fecha("vence_factura_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_pago',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_pago',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_pago" id="bqsaiaenlace_fecha_pago" value="y" />
		</div>
                       <td class="encabezado" width="20%" title="">FECHA DE PAGO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_pago_1" id="fecha_pago_1" tipo="fecha" value=""><?php selector_fecha("fecha_pago_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_pago_2" id="fecha_pago_2" tipo="fecha" value=""><?php selector_fecha("fecha_pago_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr id="tr_numero_guia"><div class="btn-group" data-toggle="buttons-radio" >
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
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_empresa_trans',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_empresa_trans',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_empresa_trans" id="bqsaiaenlace_empresa_trans" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">EMPRESA TRANSPORTADORA</td><input type="hidden" name="bksaiacondicion_empresa_trans" id="bksaiacondicion_empresa_trans" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(422,6984,'',1,'buscar');?></td></tr><tr id="tr_numero_folios"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_numero_folios',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_numero_folios',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_numero_folios" id="bqsaiaenlace_numero_folios" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FOLIOS</td><input type="hidden" name="bksaiacondicion_numero_folios" id="bksaiacondicion_numero_folios" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="numero_folios" name="numero_folios"></select><script>
                     $(document).ready(function()
                      {
                      $("#numero_folios").fcbkcomplete({
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
                     <td class="encabezado" width="20%" title="">ANEXOS F&Iacute;SICOS</td><input type="hidden" name="bksaiacondicion_anexos_fisicos" id="bksaiacondicion_anexos_fisicos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexos_fisicos" name="anexos_fisicos"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos_fisicos").fcbkcomplete({
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
                    </tr><tr id="tr_persona_natural"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_persona_natural',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_persona_natural',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_persona_natural" id="bqsaiaenlace_persona_natural" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">PERSONA NATURAL/JURIDICA</td><input type="hidden" name="bksaiacondicion_persona_natural" id="bksaiacondicion_persona_natural" value="like">
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="11"   id="persona_natural" name="persona_natural"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() {
                      $("#persona_natural").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr>
                   <td class="encabezado" width="20%" title="">DESTINO</td><input type="hidden" name="bksaiacondicion_destino" id="bksaiacondicion_destino" value="=">
                   <td bgcolor="#F5F5F5"><input type="text" size="30" maxlength="11"  value="" id="input6989" onkeyup="lookup(this.value,6989);" onblur="fill(this.value,6989);" />
                <div class="suggestionsBox" id="suggestions6989" style="display: none;">
				        <div class="suggestionList" id="list6989" >&nbsp;
        				</div>
        			  </div>
        			  <input  type="text" name="destino" id="destino">
                </td></tr><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Facturas de Obras">TIPO DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
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
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_copia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_copia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_copia" id="bqsaiaenlace_copia" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">COPIA ELECTR&OACUTE;NICA A</td><input type="hidden" name="bksaiacondicion_copia" id="bksaiacondicion_copia" value="like"><td bgcolor="#F5F5F5"><div id="esperando_copia"><img src="../../imagenes/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(422,6990,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_copia" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia.findItem((document.getElementById('stext_copia').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_copia" height="90%"></div><input type="hidden" maxlength="255"  name="copia" id="copia"   value="" ><label style="display:none" class="error" for="copia">Campo obligatorio.</label><script type="text/javascript">
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
                      tree_copia.setOnLoadingEnd(fin_cargando_copia);tree_copia.setXMLAutoLoading("../../test_funcionario.php?rol=1&sin_padre=1");tree_copia.loadXML("../../test_funcionario.php?rol=1&sin_padre=1");
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
                	--></script></td></tr><tr id="tr_func_fecha_pago"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_func_fecha_pago',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_func_fecha_pago',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_func_fecha_pago" id="bqsaiaenlace_func_fecha_pago" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FUNCIONARIO</td><input type="hidden" name="bksaiacondicion_func_fecha_pago" id="bksaiacondicion_func_fecha_pago" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="func_fecha_pago" name="func_fecha_pago"></select><script>
                     $(document).ready(function()
                      {
                      $("#func_fecha_pago").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_accion_pago',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_accion_pago',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_accion_pago" id="bqsaiaenlace_fecha_accion_pago" value="y" />
		</div>
                       <td class="encabezado" width="20%" title="">FECHA ACCION PAGO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_accion_pago_1" id="fecha_accion_pago_1" tipo="fecha" value=""><?php selector_fecha("fecha_accion_pago_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_accion_pago_2" id="fecha_accion_pago_2" tipo="fecha" value=""><?php selector_fecha("fecha_accion_pago_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr id="tr_encabezado"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr id="tr_idft_facturas_obras"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_facturas_obras',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_facturas_obras',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_facturas_obras" id="bqsaiaenlace_idft_facturas_obras" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FACTURAS_OBRAS</td><input type="hidden" name="bksaiacondicion_idft_facturas_obras" id="bksaiacondicion_idft_facturas_obras" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_facturas_obras" name="idft_facturas_obras"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_facturas_obras").fcbkcomplete({
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
                    </tr><input type="hidden" name="campo_descripcion" value="6979"><?php submit_formato(422);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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