<html><title>.: COMUNICACI&OACUTE;N EXTERNA:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("funciones.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("../../formatos/librerias/funciones_cliente.php"); ?><?php include_once("../../formatos/librerias/funciones_cliente.php"); ?><?php include_once("../../formatos/librerias/funciones_cliente.php"); ?><?php include_once("../../formatos/librerias/funciones_cliente.php"); ?><?php include_once("../../formatos/librerias/encabezado_pie_pagina.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA COMUNICACI&Oacute;N EXTERNA</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_estado_documento"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr id="tr_expediente_serie"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr id="tr_tipo_copia_interna"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_copia_interna',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_copia_interna',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_copia_interna" id="bqsaiaenlace_tipo_copia_interna" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TIPO COPIA INTERNA</td><input type="hidden" name="bksaiacondicion_tipo_copia_interna" id="bksaiacondicion_tipo_copia_interna" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="tipo_copia_interna" name="tipo_copia_interna"></select><script>
                     $(document).ready(function()
                      {
                      $("#tipo_copia_interna").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_fecha_carta"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_carta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_carta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_carta" id="bqsaiaenlace_fecha_carta" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Fecha en la que fue Creada la Carta.">FECHA DE CREACION</td><input type="hidden" name="bksaiacondicion_fecha_carta" id="bksaiacondicion_fecha_carta" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_carta" name="fecha_carta"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_carta").fcbkcomplete({
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
                    </tr><tr id="tr_destinos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_destinos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_destinos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_destinos" id="bqsaiaenlace_destinos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESTINOS</td><input type="hidden" name="bksaiacondicion_destinos" id="bksaiacondicion_destinos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="2000"   id="destinos" name="destinos"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() {
                      $("#destinos").fcbkcomplete({
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
                    </tr><tr id="tr_idft_carta"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_carta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_carta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_carta" id="bqsaiaenlace_idft_carta" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CARTA</td><input type="hidden" name="bksaiacondicion_idft_carta" id="bksaiacondicion_idft_carta" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_carta" name="idft_carta"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_carta").fcbkcomplete({
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
                    </tr><tr id="tr_requiere_recogida"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_requiere_recogida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_requiere_recogida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_requiere_recogida" id="bqsaiaenlace_requiere_recogida" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">REQUIERE RECOGIDA?</td><input type="hidden" name="bksaiacondicion_requiere_recogida" id="bksaiacondicion_requiere_recogida" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(1,5201,'',1,'buscar');?></td></tr><tr id="tr_copia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_copia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_copia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_copia" id="bqsaiaenlace_copia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Personas a quienes se les Envia Copia de la Carta">CON COPIA A</td><input type="hidden" name="bksaiacondicion_copia" id="bksaiacondicion_copia" value="like">
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="2000"   id="copia" name="copia"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() {
                      $("#copia").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CLASIFICAR EN EXPEDIENTE</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_tipo_mensajeria"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_mensajeria',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_mensajeria',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_mensajeria" id="bqsaiaenlace_tipo_mensajeria" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TIPO DE MENSAJER&Iacute;A</td><input type="hidden" name="bksaiacondicion_tipo_mensajeria" id="bksaiacondicion_tipo_mensajeria" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(1,5200,'',1,'buscar');?></td></tr><tr id="tr_asunto"><div class="btn-group" data-toggle="buttons-radio" >
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
                     <td class="encabezado" width="20%" title="Despedida de la Carta, Atentamente, Cordialmente, ...">DESPEDIDA</td><input type="hidden" name="bksaiacondicion_despedida" id="bksaiacondicion_despedida" value="like">
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
                     <td class="encabezado" width="20%" title="Persona que Genera la Carta ">PERSONA QUE GENERA LA CARTA</td><input type="hidden" name="bksaiacondicion_iniciales" id="bksaiacondicion_iniciales" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="iniciales" name="iniciales"></select><script>
                     $(document).ready(function()
                      {
                      $("#iniciales").fcbkcomplete({
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
                    </tr><tr id="tr_anexos_fisicos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_anexos_fisicos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_anexos_fisicos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_anexos_fisicos" id="bqsaiaenlace_anexos_fisicos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Listado con Los Anexos de la Carta">ANEXOS FISICOS</td><input type="hidden" name="bksaiacondicion_anexos_fisicos" id="bksaiacondicion_anexos_fisicos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexos_fisicos" name="anexos_fisicos"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos_fisicos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_varios_radicados"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_varios_radicados',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_varios_radicados',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_varios_radicados" id="bqsaiaenlace_varios_radicados" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Asignar un n&uacute;mero de radicado diferente para cada destino?">ASIGNAR UN N&Uacute;MERO DE RADICADO DIFERENTE PARA CADA DESTINO?</td><input type="hidden" name="bksaiacondicion_varios_radicados" id="bksaiacondicion_varios_radicados" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="varios_radicados" name="varios_radicados"></select><script>
                     $(document).ready(function()
                      {
                      $("#varios_radicados").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_vercopiainterna"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_vercopiainterna',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_vercopiainterna',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_vercopiainterna" id="bqsaiaenlace_vercopiainterna" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="...">VISIBLE LA COPIA INTERNA</td><input type="hidden" name="bksaiacondicion_vercopiainterna" id="bksaiacondicion_vercopiainterna" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(1,12,'',1,'buscar');?></td></tr><tr id="tr_copiainterna"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_copiainterna',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_copiainterna',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_copiainterna" id="bqsaiaenlace_copiainterna" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CON COPIA INTERNA A</td><input type="hidden" name="bksaiacondicion_copiainterna" id="bksaiacondicion_copiainterna" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="copiainterna" name="copiainterna"></select><script>
                     $(document).ready(function()
                      {
                      $("#copiainterna").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="10,7104"><?php submit_formato(1);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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