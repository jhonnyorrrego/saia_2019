<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Contrato laboral</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_contrato"><b>Tipo de Contrato<input type="hidden" name="bksaiacondicion_g@tipo_contrato" id="bksaiacondicion_g@tipo_contrato" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(229,2529,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_contrato',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_contrato',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_contrato" id="bqsaiaenlace_tipo_contrato" value="y" />
		</div></div></div><div class="control-group"><b>N&uacute;mero contrato<input type="hidden" name="bksaiacondicion_g@num_contarto" id="bksaiacondicion_g@num_contarto" value="like_total"></b><div class="controls"><input type="text" id="num_contarto" name="bqsaia_g@num_contarto"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@num_contarto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@num_contarto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@num_contarto" id="bqsaiaenlace_g@num_contarto" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_inicio"><b>Fecha inicio</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_inicio_x" id="bksaiacondicion_g@fecha_inicio_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_inicio_x" id="fecha_inicio_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_inicio_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_inicio_y" id="bksaiacondicion_g@fecha_inicio_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_inicio_y" id="fecha_inicio_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_inicio_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_inicio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_inicio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_inicio" id="bqsaiaenlace_fecha_inicio" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_final"><b>Fecha de finalizaci&oacute;n</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_final_x" id="bksaiacondicion_g@fecha_final_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_final_x" id="fecha_final_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_final_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_final_y" id="bksaiacondicion_g@fecha_final_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_final_y" id="fecha_final_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_final_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_final',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_final',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_final" id="bqsaiaenlace_fecha_final" value="y" />
		</div></div></div><div class="control-group"><b>Suledo inicial<input type="hidden" name="bksaiacondicion_g@sueldo_ini" id="bksaiacondicion_g@sueldo_ini" value="like_total"></b><div class="controls"><input type="text" id="sueldo_ini" name="bqsaia_g@sueldo_ini"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@sueldo_ini',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@sueldo_ini',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@sueldo_ini" id="bqsaiaenlace_g@sueldo_ini" value="y" />
		</div></div></div><div class="control-group"><b>Sueldo final<input type="hidden" name="bksaiacondicion_g@sueldo_final" id="bksaiacondicion_g@sueldo_final" value="like_total"></b><div class="controls"><input type="text" id="sueldo_final" name="bqsaia_g@sueldo_final"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_contrato_laboral g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_inicio_x,g@fecha_inicio_y,g@fecha_final_x,g@fecha_final_y">