<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Control de cita</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Nombre del paciente<input type="hidden" name="bksaiacondicion_g@nombre_paciente_control" id="bksaiacondicion_g@nombre_paciente_control" value="like_total"></b><div class="controls"><input type="text" id="nombre_paciente_control" name="bqsaia_g@nombre_paciente_control"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_paciente_control',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_paciente_control',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_paciente_control" id="bqsaiaenlace_g@nombre_paciente_control" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado_control_cita"><b>Estado de la cita<input type="hidden" name="bksaiacondicion_g@estado_control_cita" id="bksaiacondicion_g@estado_control_cita" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(292,3365,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@estado_control_cita',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@estado_control_cita',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@estado_control_cita" id="bqsaiaenlace_g@estado_control_cita" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion_control_cita" id="bksaiacondicion_g@descripcion_control_cita" value="like_total"></b><div class="controls"><textarea    id="descripcion_control_cita" name="bqsaia_g@descripcion_control_cita"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_control_cita g @ AND  g.documento_iddocumento=iddocumento "></body>