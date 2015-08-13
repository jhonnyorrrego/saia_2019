<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_contrato"><b>Tipo de Contrato<input type="hidden" name="bksaiacondicion_g@tipo_contrato" id="bksaiacondicion_g@tipo_contrato" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(229,2529,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
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
		</div></div></div><div class="control-group"><b>Suledo inicial<input type="hidden" name="bksaiacondicion_g@sueldo_ini" id="bksaiacondicion_g@sueldo_ini" value="like_total"></b><div class="controls"><input type="text" id="sueldo_ini" name="bqsaia_g@sueldo_ini"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@sueldo_ini',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@sueldo_ini',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@sueldo_ini" id="bqsaiaenlace_g@sueldo_ini" value="y" />
		</div></div></div><div class="control-group"><b>Sueldo final<input type="hidden" name="bksaiacondicion_g@sueldo_final" id="bksaiacondicion_g@sueldo_final" value="like_total"></b><div class="controls"><input type="text" id="sueldo_final" name="bqsaia_g@sueldo_final"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_contrato_laboral g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="idbusqueda_componente" value="0">