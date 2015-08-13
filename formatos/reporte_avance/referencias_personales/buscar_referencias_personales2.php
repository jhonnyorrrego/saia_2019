<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Ocupaci&oacute;n<input type="hidden" name="bksaiacondicion_g@ocupacion" id="bksaiacondicion_g@ocupacion" value="like_total"></b><div class="controls"><input type="text" id="ocupacion" name="bqsaia_g@ocupacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@ocupacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@ocupacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@ocupacion" id="bqsaiaenlace_g@ocupacion" value="y" />
		</div></div></div><div class="control-group"><b>Nombre<input type="hidden" name="bksaiacondicion_g@nombre" id="bksaiacondicion_g@nombre" value="like_total"></b><div class="controls"><input type="text" id="nombre" name="bqsaia_g@nombre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre" id="bqsaiaenlace_g@nombre" value="y" />
		</div></div></div><div class="control-group"><b>Tel&eacute;fono<input type="hidden" name="bksaiacondicion_g@telefono" id="bksaiacondicion_g@telefono" value="like_total"></b><div class="controls"><input type="text" id="telefono" name="bqsaia_g@telefono"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_referencias_personales g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="idbusqueda_componente" value="0">