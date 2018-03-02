<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato ADICIONAR SOLICITUD</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_solicitud"><b>Tipo solicitud<input type="hidden" name="bksaiacondicion_g@tipo_solicitud" id="bksaiacondicion_g@tipo_solicitud" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(469,5912,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_solicitud" id="bqsaiaenlace_tipo_solicitud" value="y" />
		</div></div></div><div class="control-group"><b>Tipo<input type="hidden" name="bksaiacondicion_g@tipo" id="bksaiacondicion_g@tipo" value="like_total"></b><div class="controls"><textarea    id="tipo" name="bqsaia_g@tipo"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo" id="bqsaiaenlace_g@tipo" value="y" />
		</div></div></div><div class="control-group"><b>Valor<input type="hidden" name="bksaiacondicion_g@valor" id="bksaiacondicion_g@valor" value="like_total"></b><div class="controls"><input type="text" id="valor" name="bqsaia_g@valor"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@valor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@valor',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@valor" id="bqsaiaenlace_g@valor" value="y" />
		</div></div></div><div class="control-group"><b>Amortizaci&oacute;n<input type="hidden" name="bksaiacondicion_g@amortizacion" id="bksaiacondicion_g@amortizacion" value="like_total"></b><div class="controls"><textarea    id="amortizacion" name="bqsaia_g@amortizacion"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_item_add_solicit g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="item_add_solicit"></body>