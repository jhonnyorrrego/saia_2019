<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Fecha<input type="hidden" name="bksaiacondicion_g@fecha_pago" id="bksaiacondicion_g@fecha_pago" value="like_total"></b><div class="controls"><input type="text" id="fecha_pago" name="bqsaia_g@fecha_pago"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha_pago',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha_pago',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha_pago" id="bqsaiaenlace_g@fecha_pago" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="concepto_pago"><b>Concepto<input type="hidden" name="bksaiacondicion_g@concepto_pago" id="bksaiacondicion_g@concepto_pago" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(261,2971,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_concepto_pago',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_concepto_pago',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_concepto_pago" id="bqsaiaenlace_concepto_pago" value="y" />
		</div></div></div><div class="control-group"><b>Valor<input type="hidden" name="bksaiacondicion_g@valor_forma_pago" id="bksaiacondicion_g@valor_forma_pago" value="="></b><div class="controls"><input type="text" id="valor_forma_pago" name="bqsaia_g@valor_forma_pago"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@valor_forma_pago',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@valor_forma_pago',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@valor_forma_pago" id="bqsaiaenlace_g@valor_forma_pago" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones_pago" id="bksaiacondicion_g@observaciones_pago" value="like_total"></b><div class="controls"><input type="text" id="observaciones_pago" name="bqsaia_g@observaciones_pago"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_forma_pago_vehiculo g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="forma_pago_vehiculo"></body><input type="hidden" name="idbusqueda_componente" value="126">