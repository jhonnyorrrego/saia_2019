<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato 2. Acciones</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Accion<input type="hidden" name="bksaiacondicion_g@acciones_accion" id="bksaiacondicion_g@acciones_accion" value="like_total"></b><div class="controls"><textarea    id="acciones_accion" name="bqsaia_g@acciones_accion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@acciones_accion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@acciones_accion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@acciones_accion" id="bqsaiaenlace_g@acciones_accion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="acciones_control"><b>Control<input type="hidden" name="bksaiacondicion_g@acciones_control" id="bksaiacondicion_g@acciones_control" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(501,6415,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_acciones_control',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_acciones_control',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_acciones_control" id="bqsaiaenlace_acciones_control" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_accion"><b>Fecha de Suscripcion de la Accion</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_accion_x" id="bksaiacondicion_g@fecha_accion_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_accion_x" id="fecha_accion_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_accion_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_accion_y" id="bksaiacondicion_g@fecha_accion_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_accion_y" id="fecha_accion_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_accion_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_accion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_accion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_accion" id="bqsaiaenlace_fecha_accion" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_cumplimiento"><b>Fecha de Cumplimiento</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_cumplimiento_x" id="bksaiacondicion_g@fecha_cumplimiento_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_cumplimiento_x" id="fecha_cumplimiento_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_cumplimiento_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_cumplimiento_y" id="bksaiacondicion_g@fecha_cumplimiento_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_cumplimiento_y" id="fecha_cumplimiento_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_cumplimiento_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_cumplimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_cumplimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_cumplimiento" id="bqsaiaenlace_fecha_cumplimiento" value="y" />
		</div></div></div><div class="control-group"><b>Indicador<input type="hidden" name="bksaiacondicion_g@indicador" id="bksaiacondicion_g@indicador" value="like_total"></b><div class="controls"><textarea    id="indicador" name="bqsaia_g@indicador"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@indicador',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@indicador',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@indicador" id="bqsaiaenlace_g@indicador" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="opcio_admin_riesgo"><b>Opciones Administracion del Riesgo<input type="hidden" name="bksaiacondicion_g@opcio_admin_riesgo" id="bksaiacondicion_g@opcio_admin_riesgo" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(501,6419,'',1,'buscar');?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_acciones_riesgo g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_accion_x,g@fecha_accion_y,g@fecha_cumplimiento_x,g@fecha_cumplimiento_y">