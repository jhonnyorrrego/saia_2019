<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>direccion<input type="hidden" name="bksaiacondicion_g@direccion" id="bksaiacondicion_g@direccion" value="like_total"></b><div class="controls"><input type="text" id="direccion" name="bqsaia_g@direccion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@direccion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@direccion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@direccion" id="bqsaiaenlace_g@direccion" value="y" />
		</div></div></div><div class="control-group"><b>Tel&eacute;fonos<input type="hidden" name="bksaiacondicion_g@telefonos" id="bksaiacondicion_g@telefonos" value="like_total"></b><div class="controls"><input type="text" id="telefonos" name="bqsaia_g@telefonos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@telefonos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@telefonos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@telefonos" id="bqsaiaenlace_g@telefonos" value="y" />
		</div></div></div><div class="control-group"><b>Jefe imediato<input type="hidden" name="bksaiacondicion_g@jefe_inmediato" id="bksaiacondicion_g@jefe_inmediato" value="like_total"></b><div class="controls"><input type="text" id="jefe_inmediato" name="bqsaia_g@jefe_inmediato"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@jefe_inmediato',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@jefe_inmediato',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@jefe_inmediato" id="bqsaiaenlace_g@jefe_inmediato" value="y" />
		</div></div></div><div class="control-group"><b>Nombre de la empresa<input type="hidden" name="bksaiacondicion_g@nombre_empresa" id="bksaiacondicion_g@nombre_empresa" value="like_total"></b><div class="controls"><input type="text" id="nombre_empresa" name="bqsaia_g@nombre_empresa"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_empresa',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_empresa',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_empresa" id="bqsaiaenlace_g@nombre_empresa" value="y" />
		</div></div></div><div class="control-group"><b>Cargo(s) desempe&ntilde;ado(s)<input type="hidden" name="bksaiacondicion_g@cargo_realizado" id="bksaiacondicion_g@cargo_realizado" value="like_total"></b><div class="controls"><input type="text" id="cargo_realizado" name="bqsaia_g@cargo_realizado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cargo_realizado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cargo_realizado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cargo_realizado" id="bqsaiaenlace_g@cargo_realizado" value="y" />
		</div></div></div><div class="control-group"><b>Funciones realizadas<input type="hidden" name="bksaiacondicion_g@funciones_realizadas" id="bksaiacondicion_g@funciones_realizadas" value="like_total"></b><div class="controls"><textarea    id="funciones_realizadas" name="bqsaia_g@funciones_realizadas"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@funciones_realizadas',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@funciones_realizadas',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@funciones_realizadas" id="bqsaiaenlace_g@funciones_realizadas" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="verificado"><b>Verificado<input type="hidden" name="bksaiacondicion_verificado" id="bksaiacondicion_verificado" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(223,2538,'',1,'buscar');?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_experiencia_laboral g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="idbusqueda_componente" value="0">