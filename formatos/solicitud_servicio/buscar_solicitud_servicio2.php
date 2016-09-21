<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../librerias/dependientes.js"></script><legend id="label_formato" class="legend">B&uacute;squeda en formato Solicitud de Servicio</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Fecha y Hora de Solicitud<input type="hidden" name="bksaiacondicion_g@fecha_hora_solicitud" id="bksaiacondicion_g@fecha_hora_solicitud" value="like_total"></b><div class="controls"><input type="text" id="fecha_hora_solicitud" name="bqsaia_g@fecha_hora_solicitud"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha_hora_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha_hora_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha_hora_solicitud" id="bqsaiaenlace_g@fecha_hora_solicitud" value="y" />
		</div></div></div><div class="control-group"><b>Asunto<input type="hidden" name="bksaiacondicion_g@asunto_solicitud" id="bksaiacondicion_g@asunto_solicitud" value="like_total"></b><div class="controls"><input type="text" id="asunto_solicitud" name="bqsaia_g@asunto_solicitud"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@asunto_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@asunto_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@asunto_solicitud" id="bqsaiaenlace_g@asunto_solicitud" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ciudad_origen"><b>Ciudad de Origen<input type="hidden" name="bksaiacondicion_ciudad_origen" id="bksaiacondicion_ciudad_origen" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(267,3034,$_REQUEST['iddoc']);?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ciudad_origen',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ciudad_origen',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ciudad_origen" id="bqsaiaenlace_ciudad_origen" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fk_idsolicitud_afiliacion"><b>Seleccione el documento<input type="hidden" name="bksaiacondicion_fk_idsolicitud_afiliacion" id="bksaiacondicion_fk_idsolicitud_afiliacion" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(267,3116,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fk_idsolicitud_afiliacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fk_idsolicitud_afiliacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fk_idsolicitud_afiliacion" id="bqsaiaenlace_fk_idsolicitud_afiliacion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_solicitud_servi"><b>Tipo de Solicitud<input type="hidden" name="bksaiacondicion_g@tipo_solicitud_servi" id="bksaiacondicion_g@tipo_solicitud_servi" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(267,3035,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_solicitud_servi',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_solicitud_servi',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_solicitud_servi" id="bqsaiaenlace_g@tipo_solicitud_servi" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_mercancia"><b>Tipo de Mercancia<input type="hidden" name="bksaiacondicion_tipo_mercancia" id="bksaiacondicion_tipo_mercancia" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(267,3036,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_mercancia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_mercancia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_mercancia" id="bqsaiaenlace_tipo_mercancia" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="referencia_caja"><b>Referencia de Caja<input type="hidden" name="bksaiacondicion_g@referencia_caja" id="bksaiacondicion_g@referencia_caja" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(267,3105,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_referencia_caja',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_referencia_caja',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_referencia_caja" id="bqsaiaenlace_referencia_caja" value="y" />
		</div></div></div><div class="control-group"><b>Cantidad (unidades)<input type="hidden" name="bksaiacondicion_g@cantidad_mercancia" id="bksaiacondicion_g@cantidad_mercancia" value="="></b><div class="controls"><input type="text" id="cantidad_mercancia" name="bqsaia_g@cantidad_mercancia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cantidad_mercancia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cantidad_mercancia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cantidad_mercancia" id="bqsaiaenlace_g@cantidad_mercancia" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_privilegios"><b>Tipo de Privilegios<input type="hidden" name="bksaiacondicion_g@tipo_privilegios" id="bksaiacondicion_g@tipo_privilegios" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(267,3037,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_privilegios',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_privilegios',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_privilegios" id="bqsaiaenlace_g@tipo_privilegios" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_envio_solicitud"><b>Tipo de Env&iacute;o<input type="hidden" name="bksaiacondicion_g@tipo_envio_solicitud" id="bksaiacondicion_g@tipo_envio_solicitud" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(267,3038,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_envio_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_envio_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_envio_solicitud" id="bqsaiaenlace_g@tipo_envio_solicitud" value="y" />
		</div></div></div><div class="control-group"><b>Valor Declarado<input type="hidden" name="bksaiacondicion_g@valor_declarado" id="bksaiacondicion_g@valor_declarado" value="="></b><div class="controls"><input type="text" id="valor_declarado" name="bqsaia_g@valor_declarado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@valor_declarado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@valor_declarado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@valor_declarado" id="bqsaiaenlace_g@valor_declarado" value="y" />
		</div></div></div><div class="control-group"><b>Peso (Kilos)<input type="hidden" name="bksaiacondicion_g@peso_envio_solicitud" id="bksaiacondicion_g@peso_envio_solicitud" value="like_total"></b><div class="controls"><input type="text" id="peso_envio_solicitud" name="bqsaia_g@peso_envio_solicitud"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@peso_envio_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@peso_envio_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@peso_envio_solicitud" id="bqsaiaenlace_g@peso_envio_solicitud" value="y" />
		</div></div></div><div class="control-group"><b>Tama&ntilde;o Aproximado<input type="hidden" name="bksaiacondicion_g@tamanio_aproximado" id="bksaiacondicion_g@tamanio_aproximado" value="like_total"></b><div class="controls"><input type="text" id="tamanio_aproximado" name="bqsaia_g@tamanio_aproximado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tamanio_aproximado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tamanio_aproximado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tamanio_aproximado" id="bqsaiaenlace_g@tamanio_aproximado" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="requiere_recoleccion"><b>Requiere Recolecci&oacute;n<input type="hidden" name="bksaiacondicion_g@requiere_recoleccion" id="bksaiacondicion_g@requiere_recoleccion" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(267,3042,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@requiere_recoleccion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@requiere_recoleccion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@requiere_recoleccion" id="bqsaiaenlace_g@requiere_recoleccion" value="y" />
		</div></div></div><div class="control-group"><b>Direcci&oacute;n de Recolecci&oacute;n<input type="hidden" name="bksaiacondicion_g@direccion_recoleccion" id="bksaiacondicion_g@direccion_recoleccion" value="like_total"></b><div class="controls"><input type="text" id="direccion_recoleccion" name="bqsaia_g@direccion_recoleccion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@direccion_recoleccion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@direccion_recoleccion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@direccion_recoleccion" id="bqsaiaenlace_g@direccion_recoleccion" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_recoleccion"><b>Fecha de Recolecci&oacute;n</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_recoleccion_x" id="bksaiacondicion_g@fecha_recoleccion_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_recoleccion_x" id="fecha_recoleccion_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_recoleccion_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_recoleccion_y" id="bksaiacondicion_g@fecha_recoleccion_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_recoleccion_y" id="fecha_recoleccion_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_recoleccion_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_recoleccion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_recoleccion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_recoleccion" id="bqsaiaenlace_fecha_recoleccion" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observacion_solicitud" id="bksaiacondicion_g@observacion_solicitud" value="like_total"></b><div class="controls"><textarea    id="observacion_solicitud" name="bqsaia_g@observacion_solicitud"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicitud_servicio g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_recoleccion_x,g@fecha_recoleccion_y">