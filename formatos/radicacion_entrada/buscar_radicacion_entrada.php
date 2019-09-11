<html><title>.: REGISTRO DE CORRESPONDENCIA:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_formatos_generales.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA REGISTRO DE CORRESPONDENCIA</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_despachado"><div class="btn-group" data-toggle="buttons-radio" >
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
                    <td class="encabezado" width="20%" title="">FECHA DE REGISTRO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_radicacion_entrada_1"  id="fecha_radicacion_entrada_1" value=""><?php selector_fecha("fecha_radicacion_entrada_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_radicacion_entrada_2"  id="fecha_radicacion_entrada_2" value=""><?php selector_fecha("fecha_radicacion_entrada_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr id="tr_radicado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_radicado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_radicado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_radicado" id="bqsaiaenlace_radicado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">NO. REGISTRO</td><input type="hidden" name="bksaiacondicion_radicado" id="bksaiacondicion_radicado" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="radicado" name="radicado"></select><script>
                     $(document).ready(function()
                      {
                      $("#radicado").fcbkcomplete({
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
                     <td class="encabezado" width="20%" title="">ORIGEN DEL DOCUMENTO</td><input type="hidden" name="bksaiacondicion_tipo_origen" id="bksaiacondicion_tipo_origen" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,4966,'',1,'buscar');?></td></tr><tr id="tr_etiqueta_origen">
                   <td class="encabezado" width="20%" title="">ETIQUETA_ORIGEN</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="etiqueta_origen" value=""></td>
                  </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_oficio_entrada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_oficio_entrada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_oficio_entrada" id="bqsaiaenlace_fecha_oficio_entrada" value="y" />
		</div>
                       <td class="encabezado" width="20%" title="">FECHA DEL DOCUMENTO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_oficio_entrada_1" id="fecha_oficio_entrada_1" tipo="fecha" value=""><?php selector_fecha("fecha_oficio_entrada_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_oficio_entrada_2" id="fecha_oficio_entrada_2" tipo="fecha" value=""><?php selector_fecha("fecha_oficio_entrada_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr id="tr_persona_natural"><div class="btn-group" data-toggle="buttons-radio" >
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
                     </script><tr id="tr_area_responsable"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_area_responsable',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_area_responsable',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_area_responsable" id="bqsaiaenlace_area_responsable" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FUNCIONARIO RESPONSABLE</td><input type="hidden" name="bksaiacondicion_area_responsable" id="bksaiacondicion_area_responsable" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="area_responsable" name="area_responsable"></select><script>
                     $(document).ready(function()
                      {
                      $("#area_responsable").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_distribuid_entre_sedes"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_distribuid_entre_sedes',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_distribuid_entre_sedes',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_distribuid_entre_sedes" id="bqsaiaenlace_distribuid_entre_sedes" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DISTRIBUIDO ENTRE SEDES</td><input type="hidden" name="bksaiacondicion_distribuid_entre_sedes" id="bksaiacondicion_distribuid_entre_sedes" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,8318,'',1,'buscar');?></td></tr><tr id="tr_numero_oficio"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tiempo_respuesta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tiempo_respuesta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tiempo_respuesta" id="bqsaiaenlace_tiempo_respuesta" value="y" />
		</div>
                       <td class="encabezado" width="20%" title="">FECHA L&Iacute;MITE DE RESPUESTA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="tiempo_respuesta_1" id="tiempo_respuesta_1" tipo="fecha" value=""><?php selector_fecha("tiempo_respuesta_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="tiempo_respuesta_2" id="tiempo_respuesta_2" tipo="fecha" value=""><?php selector_fecha("tiempo_respuesta_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr id="tr_requiere_recogida"><div class="btn-group" data-toggle="buttons-radio" >
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
                     <td class="encabezado" width="20%" title="">EMPRESA TRANSPORTADORA</td><input type="hidden" name="bksaiacondicion_empresa_transportado" id="bksaiacondicion_empresa_transportado" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,5084,'',1,'buscar');?></td></tr><tr id="tr_etiqueta_destino">
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
                     <td class="encabezado" width="20%" title="">DESTINO</td><input type="hidden" name="bksaiacondicion_destino" id="bksaiacondicion_destino" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="destino" name="destino"></select><script>
                     $(document).ready(function()
                      {
                      $("#destino").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_copia_a"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_copia_a',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_copia_a',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_copia_a" id="bqsaiaenlace_copia_a" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">COPIA ELECTR&Oacute;NICA A</td><input type="hidden" name="bksaiacondicion_copia_a" id="bksaiacondicion_copia_a" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="copia_a" name="copia_a"></select><script>
                     $(document).ready(function()
                      {
                      $("#copia_a").fcbkcomplete({
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
                     <td class="encabezado" width="20%" title="Radicacion entrada">TIPO DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_persona_natural_dest"><div class="btn-group" data-toggle="buttons-radio" >
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
                     <td class="encabezado" width="20%" title="">ORIENTACI&Oacute;N DEL SELLO</td><input type="hidden" name="bksaiacondicion_colilla" id="bksaiacondicion_colilla" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(3,7009,'',1,'buscar');?></td></tr><tr id="tr_anexos_digitales"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><input type="hidden" name="campo_descripcion" value="39"><?php submit_formato(3);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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