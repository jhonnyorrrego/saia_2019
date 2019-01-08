<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Riesgos</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="identificacion_riesg"><b>IDENTIFICACION DEL RIESGO<input type="hidden" name="bksaiacondicion_identificacion_riesg" id="bksaiacondicion_identificacion_riesg" value="like_total"></b></label></div><div class="control-group">
                  <label class="string control-label" for="fecha_riesgo"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_riesgo_x" id="bksaiacondicion_g@fecha_riesgo_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_riesgo_x" id="fecha_riesgo_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_riesgo_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_riesgo_y" id="bksaiacondicion_g@fecha_riesgo_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_riesgo_y" id="fecha_riesgo_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_riesgo_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_riesgo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_riesgo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_riesgo" id="bqsaiaenlace_fecha_riesgo" value="y" />
		</div></div></div><div class="control-group"><b>Numero<input type="hidden" name="bksaiacondicion_g@consecutivo" id="bksaiacondicion_g@consecutivo" value="="></b><div class="controls"><input type="text" id="consecutivo" name="bqsaia_g@consecutivo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@consecutivo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@consecutivo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@consecutivo" id="bqsaiaenlace_g@consecutivo" value="y" />
		</div></div></div><div class="control-group"><b>Riesgo<input type="hidden" name="bksaiacondicion_g@riesgo" id="bksaiacondicion_g@riesgo" value="like_total"></b><div class="controls"><textarea    id="riesgo" name="bqsaia_g@riesgo"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@riesgo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@riesgo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@riesgo" id="bqsaiaenlace_g@riesgo" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_riesgo"><b>Tipo de riesgo<input type="hidden" name="bksaiacondicion_g@tipo_riesgo" id="bksaiacondicion_g@tipo_riesgo" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(499,6368,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_riesgo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_riesgo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_riesgo" id="bqsaiaenlace_g@tipo_riesgo" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="analisis_riego"><b>ANALISIS DE RIESGO<input type="hidden" name="bksaiacondicion_analisis_riego" id="bksaiacondicion_analisis_riego" value="like_total"></b></label></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_riesgos_proceso g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_riesgo_x,g@fecha_riesgo_y">