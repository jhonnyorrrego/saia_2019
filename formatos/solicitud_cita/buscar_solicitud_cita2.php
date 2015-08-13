<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend" style="font-size:9pt;">B&uacute;squeda en formato 2. Solicitud de cita</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Nombre Del Paciente<input type="hidden" name="bksaiacondicion_g@nombre_paciente" id="bksaiacondicion_g@nombre_paciente" value="like_total"></b><div class="controls"><input type="text" id="nombre_paciente" name="bqsaia_g@nombre_paciente"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_paciente',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_paciente',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_paciente" id="bqsaiaenlace_g@nombre_paciente" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="motivo_consulta"><b>Motivo De Consulta<input type="hidden" name="bksaiacondicion_g@motivo_consulta" id="bksaiacondicion_g@motivo_consulta" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(291,3354,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@motivo_consulta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@motivo_consulta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@motivo_consulta" id="bqsaiaenlace_g@motivo_consulta" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion_cita" id="bksaiacondicion_g@descripcion_cita" value="like_total"></b><div class="controls"><textarea    id="descripcion_cita" name="bqsaia_g@descripcion_cita"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_cita',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_cita',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_cita" id="bqsaiaenlace_g@descripcion_cita" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_hora_cita"><b>Fecha Y Hora De Cita<input type="hidden" name="bksaiacondicion_fecha_hora_cita" id="bksaiacondicion_fecha_hora_cita" value="like_total"></b></label><div class="controls">
                    Entre &nbsp;<input type="text" readonly="true" name="fecha_hora_cita_1"  id="fecha_hora_cita_1" value=""><?php selector_fecha("fecha_hora_cita_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y <input type="text" readonly="true" name="fecha_hora_cita_2"  id="fecha_hora_cita_2" value=""><?php selector_fecha("fecha_hora_cita_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicitud_cita g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|"><input type="hidden" name="idbusqueda_componente" value="178">