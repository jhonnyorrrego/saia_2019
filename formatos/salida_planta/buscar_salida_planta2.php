<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato AUTORIZACION SALIDA DE PLANTA</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="turno_datos"><b>Turno<input type="hidden" name="bksaiacondicion_g@turno_datos" id="bksaiacondicion_g@turno_datos" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(331,3874,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_turno_datos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_turno_datos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_turno_datos" id="bqsaiaenlace_turno_datos" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_salida"><b>Fecha Salida</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_salida_x" id="bksaiacondicion_g@fecha_salida_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_salida_x" id="fecha_salida_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_salida_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_salida_y" id="bksaiacondicion_g@fecha_salida_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_salida_y" id="fecha_salida_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_salida_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_salida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_salida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_salida" id="bqsaiaenlace_fecha_salida" value="y" />
		</div></div></div><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_hora_salida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_hora_salida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_hora_salida" id="bqsaiaenlace_hora_salida" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_entrada"><b>Fecha Entrada</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_entrada_x" id="bksaiacondicion_g@fecha_entrada_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_entrada_x" id="fecha_entrada_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_entrada_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_entrada_y" id="bksaiacondicion_g@fecha_entrada_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_entrada_y" id="fecha_entrada_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_entrada_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_entrada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_entrada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_entrada" id="bqsaiaenlace_fecha_entrada" value="y" />
		</div></div></div><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_hora_entrada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_hora_entrada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_hora_entrada" id="bqsaiaenlace_hora_entrada" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="motivo_salida"><b>Motivo<input type="hidden" name="bksaiacondicion_g@motivo_salida" id="bksaiacondicion_g@motivo_salida" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(331,3879,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@motivo_salida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@motivo_salida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@motivo_salida" id="bqsaiaenlace_g@motivo_salida" value="y" />
		</div></div></div><div class="control-group"><b>Motivo Permiso<input type="hidden" name="bksaiacondicion_g@motivo_permiso" id="bksaiacondicion_g@motivo_permiso" value="like_total"></b><div class="controls"><input type="text" id="motivo_permiso" name="bqsaia_g@motivo_permiso"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@motivo_permiso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@motivo_permiso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@motivo_permiso" id="bqsaiaenlace_g@motivo_permiso" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_salida_planta g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_salida_x,g@fecha_salida_y,g@fecha_entrada_x,g@fecha_entrada_y">