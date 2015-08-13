<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend" style="font-size:9pt;">B&uacute;squeda en formato 1. Anamnesis</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Motivo De Consulta<input type="hidden" name="bksaiacondicion_g@motivo_consulta" id="bksaiacondicion_g@motivo_consulta" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="motivo_consulta" name="bqsaia_g@motivo_consulta"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@motivo_consulta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@motivo_consulta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@motivo_consulta" id="bqsaiaenlace_g@motivo_consulta" value="y" />
		</div></div></div><div class="control-group"><b>Enfermedad Actual<input type="hidden" name="bksaiacondicion_g@enfermedad_actual" id="bksaiacondicion_g@enfermedad_actual" value="like_total"></b><div class="controls"><textarea    id="enfermedad_actual" name="bqsaia_g@enfermedad_actual"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@enfermedad_actual',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@enfermedad_actual',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@enfermedad_actual" id="bqsaiaenlace_g@enfermedad_actual" value="y" />
		</div></div></div><div class="control-group"><b>Antecedentes M&eacute;dicos<input type="hidden" name="bksaiacondicion_g@antecedentes_medicos" id="bksaiacondicion_g@antecedentes_medicos" value="like_total"></b><div class="controls"><textarea    id="antecedentes_medicos" name="bqsaia_g@antecedentes_medicos"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@antecedentes_medicos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@antecedentes_medicos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@antecedentes_medicos" id="bqsaiaenlace_g@antecedentes_medicos" value="y" />
		</div></div></div><div class="control-group"><b>Antecedentes Familiares<input type="hidden" name="bksaiacondicion_g@antecedentes_familiares_a" id="bksaiacondicion_g@antecedentes_familiares_a" value="like_total"></b><div class="controls"><textarea    id="antecedentes_familiares_a" name="bqsaia_g@antecedentes_familiares_a"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_anamnesis_clinica g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="idbusqueda_componente" value="173">