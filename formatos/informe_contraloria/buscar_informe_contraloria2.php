<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Informe Seguimiento</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_compromisos"><b>FECHA DE SEGUIMIENTO A COMPROMISOS</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_compromisos_x" id="bksaiacondicion_g@fecha_compromisos_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_compromisos_x" id="fecha_compromisos_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_compromisos_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_compromisos_y" id="bksaiacondicion_g@fecha_compromisos_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_compromisos_y" id="fecha_compromisos_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_compromisos_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_compromisos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_compromisos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_compromisos" id="bqsaiaenlace_fecha_compromisos" value="y" />
		</div></div></div><div class="control-group"><b>Proceso auditado<input type="hidden" name="bksaiacondicion_g@proceso_auditado" id="bksaiacondicion_g@proceso_auditado" value="like_total"></b><div class="controls"><textarea  maxlength="6000"   id="proceso_auditado" name="bqsaia_g@proceso_auditado"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@proceso_auditado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@proceso_auditado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@proceso_auditado" id="bqsaiaenlace_g@proceso_auditado" value="y" />
		</div></div></div><div class="control-group"><b>CUMPLIMIENTO DEL OBJETIVO GENERAL DEL PLAN<input type="hidden" name="bksaiacondicion_g@cumplimiento_general" id="bksaiacondicion_g@cumplimiento_general" value="like_total"></b><div class="controls"><textarea  maxlength="5000"   id="cumplimiento_general" name="bqsaia_g@cumplimiento_general"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cumplimiento_general',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cumplimiento_general',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cumplimiento_general" id="bqsaiaenlace_g@cumplimiento_general" value="y" />
		</div></div></div><div class="control-group"><b>CUMPLIMIENTO DE LOS OBJETIVOS ESPECIFICOS<input type="hidden" name="bksaiacondicion_g@cumplimiento_especificos" id="bksaiacondicion_g@cumplimiento_especificos" value="like_total"></b><div class="controls"><textarea  maxlength="5000"   id="cumplimiento_especificos" name="bqsaia_g@cumplimiento_especificos"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cumplimiento_especificos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cumplimiento_especificos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cumplimiento_especificos" id="bqsaiaenlace_g@cumplimiento_especificos" value="y" />
		</div></div></div><div class="control-group"><b>PORCENTAJE DE CUMPLIMIENTO DEL PLAN<input type="hidden" name="bksaiacondicion_g@cumplimiento_plan" id="bksaiacondicion_g@cumplimiento_plan" value="like_total"></b><div class="controls"><input type="text" id="cumplimiento_plan" name="bqsaia_g@cumplimiento_plan"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cumplimiento_plan',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cumplimiento_plan',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cumplimiento_plan" id="bqsaiaenlace_g@cumplimiento_plan" value="y" />
		</div></div></div><div class="control-group"><b>CONCLUSIONES<input type="hidden" name="bksaiacondicion_g@conclusiones" id="bksaiacondicion_g@conclusiones" value="like_total"></b><div class="controls"><textarea  maxlength="5000"   id="conclusiones" name="bqsaia_g@conclusiones"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@conclusiones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@conclusiones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@conclusiones" id="bqsaiaenlace_g@conclusiones" value="y" />
		</div></div></div><div class="control-group"><b>JEFE DE CONTROL INTERNO<input type="hidden" name="bksaiacondicion_g@jefe_control" id="bksaiacondicion_g@jefe_control" value="like_total"></b><div class="controls"><input type="text" id="jefe_control" name="bqsaia_g@jefe_control"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_informe_contraloria g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_compromisos_x,g@fecha_compromisos_y">