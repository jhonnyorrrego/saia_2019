<html><title>.: CORREO SAIA:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/><?php echo(librerias_jquery('1.7')); ?><script type="text/javascript" src="../../js/selectize.js"></script><link rel="stylesheet" type="text/css" href="../../css/selectize.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA CORREO SAIA</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_ingresar_datos_factu"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ingresar_datos_factu',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ingresar_datos_factu',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ingresar_datos_factu" id="bqsaiaenlace_ingresar_datos_factu" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">INGRESAR_DATOS_FACTU</td><input type="hidden" name="bksaiacondicion_ingresar_datos_factu" id="bksaiacondicion_ingresar_datos_factu" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="ingresar_datos_factu" name="ingresar_datos_factu"></select><script>
                     $(document).ready(function()
                      {
                      $("#ingresar_datos_factu").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_fecha_datos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_datos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_datos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_datos" id="bqsaiaenlace_fecha_datos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FECHA_DATOS</td><input type="hidden" name="bksaiacondicion_fecha_datos" id="bksaiacondicion_fecha_datos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_datos" name="fecha_datos"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_datos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_responsable_datos_fa"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_responsable_datos_fa',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_responsable_datos_fa',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_responsable_datos_fa" id="bqsaiaenlace_responsable_datos_fa" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">RESPONSABLE_DATOS_FA</td><input type="hidden" name="bksaiacondicion_responsable_datos_fa" id="bksaiacondicion_responsable_datos_fa" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="responsable_datos_fa" name="responsable_datos_fa"></select><script>
                     $(document).ready(function()
                      {
                      $("#responsable_datos_fa").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_uid_correo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_uid_correo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_uid_correo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_uid_correo" id="bqsaiaenlace_uid_correo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">UID CORREO</td><input type="hidden" name="bksaiacondicion_uid_correo" id="bksaiacondicion_uid_correo" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="uid_correo" name="uid_correo"></select><script>
                     $(document).ready(function()
                      {
                      $("#uid_correo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_buzon_correo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_buzon_correo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_buzon_correo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_buzon_correo" id="bqsaiaenlace_buzon_correo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">BUZON ORIGEN</td><input type="hidden" name="bksaiacondicion_buzon_correo" id="bksaiacondicion_buzon_correo" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="buzon_correo" name="buzon_correo"></select><script>
                     $(document).ready(function()
                      {
                      $("#buzon_correo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_fecha_factura"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_factura" id="bqsaiaenlace_fecha_factura" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FECHA FACTURA</td><input type="hidden" name="bksaiacondicion_fecha_factura" id="bksaiacondicion_fecha_factura" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_factura" name="fecha_factura"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_factura").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_cant_dias"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_cant_dias',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_cant_dias',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_cant_dias" id="bqsaiaenlace_cant_dias" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CANTIDAD D&Iacute;AS DE PAGO</td><input type="hidden" name="bksaiacondicion_cant_dias" id="bksaiacondicion_cant_dias" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="cant_dias" name="cant_dias"></select><script>
                     $(document).ready(function()
                      {
                      $("#cant_dias").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_fecha_venc_fact"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_venc_fact',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_venc_fact',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_venc_fact" id="bqsaiaenlace_fecha_venc_fact" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FECHA VENCIMIENTO FACTURA</td><input type="hidden" name="bksaiacondicion_fecha_venc_fact" id="bksaiacondicion_fecha_venc_fact" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_venc_fact" name="fecha_venc_fact"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_venc_fact").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_concepto_fact"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_concepto_fact',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_concepto_fact',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_concepto_fact" id="bqsaiaenlace_concepto_fact" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CONCEPTO DE LA FACTURA</td><input type="hidden" name="bksaiacondicion_concepto_fact" id="bksaiacondicion_concepto_fact" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="concepto_fact" name="concepto_fact"></select><script>
                     $(document).ready(function()
                      {
                      $("#concepto_fact").fcbkcomplete({
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
                    </tr><tr id="tr_pago_desde"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_pago_desde',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_pago_desde',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_pago_desde" id="bqsaiaenlace_pago_desde" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FECHA DE PAGO DESDE</td><input type="hidden" name="bksaiacondicion_pago_desde" id="bksaiacondicion_pago_desde" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="pago_desde" name="pago_desde"></select><script>
                     $(document).ready(function()
                      {
                      $("#pago_desde").fcbkcomplete({
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
                    </tr><tr id="tr_idft_correo_saia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_correo_saia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_correo_saia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_correo_saia" id="bqsaiaenlace_idft_correo_saia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CORREO_SAIA</td><input type="hidden" name="bksaiacondicion_idft_correo_saia" id="bksaiacondicion_idft_correo_saia" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_correo_saia" name="idft_correo_saia"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_correo_saia").fcbkcomplete({
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
                    </tr><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Correo SAIA">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_asunto"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_asunto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_asunto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_asunto" id="bqsaiaenlace_asunto" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Asunto del correo">ASUNTO</td><input type="hidden" name="bksaiacondicion_asunto" id="bksaiacondicion_asunto" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="asunto" name="asunto"></select><script>
                     $(document).ready(function()
                      {
                      $("#asunto").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_oficio_entrada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_oficio_entrada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_oficio_entrada" id="bqsaiaenlace_fecha_oficio_entrada" value="y" />
		</div>
                    <td class="encabezado" width="20%" title="Fecha de entrada del oficio">FECHA OFICIO ENTRADA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_oficio_entrada_1"  id="fecha_oficio_entrada_1" value=""><?php selector_fecha("fecha_oficio_entrada_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_oficio_entrada_2"  id="fecha_oficio_entrada_2" value=""><?php selector_fecha("fecha_oficio_entrada_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr id="tr_de"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_de',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_de',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_de" id="bqsaiaenlace_de" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Remitente del correo">DE</td><input type="hidden" name="bksaiacondicion_de" id="bksaiacondicion_de" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="de" name="de"></select><script>
                     $(document).ready(function()
                      {
                      $("#de").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_para"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_para',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_para',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_para" id="bqsaiaenlace_para" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">PARA</td><input type="hidden" name="bksaiacondicion_para" id="bksaiacondicion_para" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="para" name="para"></select><script>
                     $(document).ready(function()
                      {
                      $("#para").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">TRANSFERIR</td><input type="hidden" name="bksaiacondicion_transferencia_correo" id="bksaiacondicion_transferencia_correo" value="like_total">
                   <td bgcolor="#F5F5F5"><input type="text" size="30"  value="" id="input4084" onkeyup="lookup(this.value,4084);" onblur="fill(this.value,4084);" />
                <div class="suggestionsBox" id="suggestions4084" style="display: none;">
				        <div class="suggestionList" id="list4084" >&nbsp;
        				</div>
        			  </div>
        			  <input  type="text" name="transferencia_correo" id="transferencia_correo">
                </td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_copia_correo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_copia_correo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_copia_correo" id="bqsaiaenlace_copia_correo" value="y" />
		</div>
                   <td class="encabezado" width="20%" title="">CON COPIA</td><input type="hidden" name="bksaiacondicion_copia_correo" id="bksaiacondicion_copia_correo" value="like"><td bgcolor="#F5F5F5"><div id="esperando_copia_correo"><img src="../../assets/images/cargando.gif"></div><div id="seleccionados"><?php mostrar_seleccionados(348,4085,'5',$_REQUEST['iddoc']);?></div>
                          <br />  Buscar: <input type="text" id="stext_copia_correo" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_copia_correo.findItem((document.getElementById('stext_copia_correo').value),1)"><img src="../../assets/images/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_copia_correo.findItem((document.getElementById('stext_copia_correo').value),0,1)"><img src="../../assets/images/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_copia_correo.findItem((document.getElementById('stext_copia_correo').value))"><img src="../../assets/images/siguiente.png"border="0px"></a>
                          <br /><br /><div id="treeboxbox_copia_correo" height="90%"></div><input type="hidden" maxlength="255"  name="copia_correo" id="copia_correo"   value="" ><label style="display:none" class="error" for="copia_correo">Campo obligatorio.</label><script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_copia_correo=new dhtmlXTreeObject("treeboxbox_copia_correo","100%","100%",0);
                			tree_copia_correo.setImagePath("../../imgs/");
                			tree_copia_correo.enableIEImageFix(true);tree_copia_correo.enableCheckBoxes(1);
                			tree_copia_correo.enableThreeStateCheckboxes(1);tree_copia_correo.setOnLoadingStart(cargando_copia_correo);
                      tree_copia_correo.setOnLoadingEnd(fin_cargando_copia_correo);tree_copia_correo.setXMLAutoLoading("../../test_funcionario.php?rol=1");tree_copia_correo.loadXML("../../test_funcionario.php?rol=1");
                      tree_copia_correo.setOnCheckHandler(onNodeSelect_copia_correo);
                      function onNodeSelect_copia_correo(nodeId)
                      {valor_destino=document.getElementById("copia_correo");
                       destinos=tree_copia_correo.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++) {
                           if(vector[i].indexOf("#")!=-1) {
                               hijos=tree_copia_correo.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
								}
						}
                       valor_destino.value=nuevo;
                      }
                      function fin_cargando_copia_correo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_correo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_correo")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_copia_correo"]');
                        document.poppedLayer.style.visibility = "hidden";
                      }
                      function cargando_copia_correo() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_copia_correo")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_copia_correo")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_copia_correo"]');
                        document.poppedLayer.style.visibility = "visible";
                      }
                	--></script></td></tr><tr id="tr_comentario"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_comentario',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_comentario',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_comentario" id="bqsaiaenlace_comentario" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Comentario del correo">COMENTARIO</td><input type="hidden" name="bksaiacondicion_comentario" id="bksaiacondicion_comentario" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="comentario" name="comentario"></select><script>
                     $(document).ready(function()
                      {
                      $("#comentario").fcbkcomplete({
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
                     <td class="encabezado" width="20%" title="Anexos del correo">ANEXOS</td><input type="hidden" name="bksaiacondicion_anexos" id="bksaiacondicion_anexos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexos" name="anexos"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_no_factura"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_no_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_no_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_no_factura" id="bqsaiaenlace_no_factura" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">NO. DE FACTURA</td><input type="hidden" name="bksaiacondicion_no_factura" id="bksaiacondicion_no_factura" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="no_factura" name="no_factura"></select><script>
                     $(document).ready(function()
                      {
                      $("#no_factura").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_nit_proveedor"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nit_proveedor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nit_proveedor',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nit_proveedor" id="bqsaiaenlace_nit_proveedor" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">NO. NIT PROVEEDOR</td><input type="hidden" name="bksaiacondicion_nit_proveedor" id="bksaiacondicion_nit_proveedor" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="nit_proveedor" name="nit_proveedor"></select><script>
                     $(document).ready(function()
                      {
                      $("#nit_proveedor").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_centro_costo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_centro_costo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_centro_costo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_centro_costo" id="bqsaiaenlace_centro_costo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CENTRO DE COSTOS</td><input type="hidden" name="bksaiacondicion_centro_costo" id="bksaiacondicion_centro_costo" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="centro_costo" name="centro_costo"></select><script>
                     $(document).ready(function()
                      {
                      $("#centro_costo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_adjunto_imagen"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_adjunto_imagen',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_adjunto_imagen',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_adjunto_imagen" id="bqsaiaenlace_adjunto_imagen" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ADJUNTO IMAGEN</td><input type="hidden" name="bksaiacondicion_adjunto_imagen" id="bksaiacondicion_adjunto_imagen" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="adjunto_imagen" name="adjunto_imagen"></select><script>
                     $(document).ready(function()
                      {
                      $("#adjunto_imagen").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="4031"><?php submit_formato(348);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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