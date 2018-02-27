<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Factores de competencia</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="factor_competencia"><b>FACTOR DE COMPETENCIA<input type="hidden" name="bksaiacondicion_g@factor_competencia" id="bksaiacondicion_g@factor_competencia" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(442,5489,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@factor_competencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@factor_competencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@factor_competencia" id="bqsaiaenlace_g@factor_competencia" value="y" />
		</div></div></div><div class="control-group"><b>REQUERIDO<input type="hidden" name="bksaiacondicion_g@requerido" id="bksaiacondicion_g@requerido" value="like_total"></b><div class="controls"><textarea    id="requerido" name="bqsaia_g@requerido"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@requerido',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@requerido',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@requerido" id="bqsaiaenlace_g@requerido" value="y" />
		</div></div></div><div class="control-group"><b>REAL<input type="hidden" name="bksaiacondicion_g@real_factor" id="bksaiacondicion_g@real_factor" value="like_total"></b><div class="controls"><textarea    id="real_factor" name="bqsaia_g@real_factor"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@real_factor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@real_factor',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@real_factor" id="bqsaiaenlace_g@real_factor" value="y" />
		</div></div></div><div class="control-group"><b>OBSERVACIONES/ACCIONES<input type="hidden" name="bksaiacondicion_g@observaciones_acciones" id="bksaiacondicion_g@observaciones_acciones" value="like_total"></b><div class="controls"><textarea    id="observaciones_acciones" name="bqsaia_g@observaciones_acciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_factores_competencia g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="factores_competencia"></body>