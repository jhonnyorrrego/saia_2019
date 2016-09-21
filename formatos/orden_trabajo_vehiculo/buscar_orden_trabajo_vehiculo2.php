<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Orden de trabajo</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_servicio"><b>Tipo de servicio<input type="hidden" name="bksaiacondicion_g@tipo_servicio" id="bksaiacondicion_g@tipo_servicio" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(262,2988,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_servicio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_servicio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_servicio" id="bqsaiaenlace_g@tipo_servicio" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_orden_trabajo"><b>Fecha orden (F. OT)<input type="hidden" name="bksaiacondicion_g@fecha_orden_trabajo" id="bksaiacondicion_g@fecha_orden_trabajo" value="date"></b></label><div class="controls">
                   <input type="text" readonly="true"  name="bqsaia_g@fecha_orden_trabajo" id="fecha_orden_trabajo" tipo="fecha" value=""><?php selector_fecha("fecha_orden_trabajo","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></form><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha_orden_trabajo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha_orden_trabajo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha_orden_trabajo" id="bqsaiaenlace_g@fecha_orden_trabajo" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_solicitud_orden"><b>Fecha de Solicitud (F. SOL)</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_solicitud_orden_x" id="bksaiacondicion_g@fecha_solicitud_orden_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_solicitud_orden_x" id="fecha_solicitud_orden_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_solicitud_orden_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_solicitud_orden_y" id="bksaiacondicion_g@fecha_solicitud_orden_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_solicitud_orden_y" id="fecha_solicitud_orden_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_solicitud_orden_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_solicitud_orden',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_solicitud_orden',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_solicitud_orden" id="bqsaiaenlace_fecha_solicitud_orden" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_compromiso"><b>Fecha compromiso</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_compromiso_x" id="bksaiacondicion_g@fecha_compromiso_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_compromiso_x" id="fecha_compromiso_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_compromiso_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_compromiso_y" id="bksaiacondicion_g@fecha_compromiso_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_compromiso_y" id="fecha_compromiso_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_compromiso_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_compromiso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_compromiso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_compromiso" id="bqsaiaenlace_fecha_compromiso" value="y" />
		</div></div></div><div class="control-group"><b>Kilometros<input type="hidden" name="bksaiacondicion_g@kilometros_vehiculo" id="bksaiacondicion_g@kilometros_vehiculo" value="="></b><div class="controls"><input type="text" id="kilometros_vehiculo" name="bqsaia_g@kilometros_vehiculo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@kilometros_vehiculo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@kilometros_vehiculo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@kilometros_vehiculo" id="bqsaiaenlace_g@kilometros_vehiculo" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="prioridad_servicio"><b>Prioridad<input type="hidden" name="bksaiacondicion_g@prioridad_servicio" id="bksaiacondicion_g@prioridad_servicio" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(262,2979,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@prioridad_servicio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@prioridad_servicio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@prioridad_servicio" id="bqsaiaenlace_g@prioridad_servicio" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Solicitante</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__6" id="bksaiacondicion_f@nombre__6" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="nombre_solicitante-nombre" name="g@nombre_solicitante-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="nombre_solicitante-identificacion" name="g@nombre_solicitante-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="nombre_solicitante-empresa" name="g@nombre_solicitante-empresa" ></div></div></fieldset><br><div class="control-group"><b>Asegurador<input type="hidden" name="bksaiacondicion_g@nombre_asegurador" id="bksaiacondicion_g@nombre_asegurador" value="like_total"></b><div class="controls"><input type="text" id="nombre_asegurador" name="bqsaia_g@nombre_asegurador"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_asegurador',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_asegurador',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_asegurador" id="bqsaiaenlace_g@nombre_asegurador" value="y" />
		</div></div></div><div class="control-group"><b>Servicio<input type="hidden" name="bksaiacondicion_g@campo_servicio" id="bksaiacondicion_g@campo_servicio" value="like_total"></b><div class="controls"><input type="text" id="campo_servicio" name="bqsaia_g@campo_servicio"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@campo_servicio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@campo_servicio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@campo_servicio" id="bqsaiaenlace_g@campo_servicio" value="y" />
		</div></div></div><div class="control-group"><b>CTTO numero<input type="hidden" name="bksaiacondicion_g@ctto_numero" id="bksaiacondicion_g@ctto_numero" value="like_total"></b><div class="controls"><input type="text" id="ctto_numero" name="bqsaia_g@ctto_numero"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@ctto_numero',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@ctto_numero',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@ctto_numero" id="bqsaiaenlace_g@ctto_numero" value="y" />
		</div></div></div><div class="control-group"><b>Motivo del servicio<input type="hidden" name="bksaiacondicion_g@motivo_servicio" id="bksaiacondicion_g@motivo_servicio" value="like_total"></b><div class="controls"><textarea  maxlength="3999"   id="motivo_servicio" name="bqsaia_g@motivo_servicio"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@motivo_servicio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@motivo_servicio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@motivo_servicio" id="bqsaiaenlace_g@motivo_servicio" value="y" />
		</div></div></div><div class="control-group"><b>Llamadas requeridas<input type="hidden" name="bksaiacondicion_g@llamadas_requeridas" id="bksaiacondicion_g@llamadas_requeridas" value="like_total"></b><div class="controls"><textarea  maxlength="3999"   id="llamadas_requeridas" name="bqsaia_g@llamadas_requeridas"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@llamadas_requeridas',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@llamadas_requeridas',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@llamadas_requeridas" id="bqsaiaenlace_g@llamadas_requeridas" value="y" />
		</div></div></div><div class="control-group"><b>Recibo<input type="hidden" name="bksaiacondicion_g@funcionario_recibo" id="bksaiacondicion_g@funcionario_recibo" value="like_total"></b><div class="controls"><input type="text" id="funcionario_recibo" name="bqsaia_g@funcionario_recibo"></div></div><input type="hidden" name="campos_especiales" value="nombre_solicitante@ejecutor"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_orden_trabajo_vehiculo g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_solicitud_orden_x,g@fecha_solicitud_orden_y,g@fecha_compromiso_x,g@fecha_compromiso_y">