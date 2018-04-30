<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Plan de Mejoramiento</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Observacion Termino<input type="hidden" name="bksaiacondicion_g@observ_termino" id="bksaiacondicion_g@observ_termino" value="like_total"></b><div class="controls"><input type="text" id="observ_termino" name="bqsaia_g@observ_termino"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@observ_termino',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@observ_termino',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@observ_termino" id="bqsaiaenlace_g@observ_termino" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_plan"><b>Tipo de Plan<input type="hidden" name="bksaiacondicion_g@tipo_plan" id="bksaiacondicion_g@tipo_plan" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(480,6067,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_plan',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_plan',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_plan" id="bqsaiaenlace_g@tipo_plan" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_suscripcion"><b>Fecha de suscripcion<input type="hidden" name="bksaiacondicion_g@fecha_suscripcion" id="bksaiacondicion_g@fecha_suscripcion" value="date"></b></label><div class="controls">
                   <input type="text" readonly="true"  name="bqsaia_g@fecha_suscripcion" id="fecha_suscripcion" tipo="fecha" value=""><?php selector_fecha("fecha_suscripcion","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></form><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha_suscripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha_suscripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha_suscripcion" id="bqsaiaenlace_g@fecha_suscripcion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_auditoria"><b>Tipo de Auditoria<input type="hidden" name="bksaiacondicion_g@tipo_auditoria" id="bksaiacondicion_g@tipo_auditoria" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(480,6073,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_auditoria',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_auditoria',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_auditoria" id="bqsaiaenlace_tipo_auditoria" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="auditor"><b>Auditor<input type="hidden" name="bksaiacondicion_g@auditor" id="bksaiacondicion_g@auditor" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(480,6074,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_auditor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_auditor',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_auditor" id="bqsaiaenlace_auditor" value="y" />
		</div></div></div><div class="control-group"><b>Descripcion<input type="hidden" name="bksaiacondicion_g@descripcion_plan" id="bksaiacondicion_g@descripcion_plan" value="like_total"></b><div class="controls"><textarea    id="descripcion_plan" name="bqsaia_g@descripcion_plan"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_plan',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_plan',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_plan" id="bqsaiaenlace_g@descripcion_plan" value="y" />
		</div></div></div><div class="control-group"><b>Periodo Evaluado<input type="hidden" name="bksaiacondicion_g@periodo_evaluado" id="bksaiacondicion_g@periodo_evaluado" value="like_total"></b><div class="controls"><input type="text" id="periodo_evaluado" name="bqsaia_g@periodo_evaluado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@periodo_evaluado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@periodo_evaluado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@periodo_evaluado" id="bqsaiaenlace_g@periodo_evaluado" value="y" />
		</div></div></div><div class="control-group"><b>Objetivo General<input type="hidden" name="bksaiacondicion_g@objetivo" id="bksaiacondicion_g@objetivo" value="like_total"></b><div class="controls"><textarea  maxlength="4000"   id="objetivo" name="bqsaia_g@objetivo"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@objetivo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@objetivo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@objetivo" id="bqsaiaenlace_g@objetivo" value="y" />
		</div></div></div><div class="control-group"><b>Objetivos Especificos<input type="hidden" name="bksaiacondicion_g@objetivos_especificos" id="bksaiacondicion_g@objetivos_especificos" value="like_total"></b><div class="controls"><textarea  maxlength="4000"   id="objetivos_especificos" name="bqsaia_g@objetivos_especificos"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_plan_mejoramiento g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|">