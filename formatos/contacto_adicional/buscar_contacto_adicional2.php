<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Contactos adicionales</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Nombre<input type="hidden" name="bksaiacondicion_g@nombre" id="bksaiacondicion_g@nombre" value="like_total"></b><div class="controls"><input type="text" id="nombre" name="bqsaia_g@nombre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre" id="bqsaiaenlace_g@nombre" value="y" />
		</div></div></div><div class="control-group"><b>Identificacion<input type="hidden" name="bksaiacondicion_g@identificacion" id="bksaiacondicion_g@identificacion" value="="></b><div class="controls"><input type="text" id="identificacion" name="bqsaia_g@identificacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@identificacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@identificacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@identificacion" id="bqsaiaenlace_g@identificacion" value="y" />
		</div></div></div><div class="control-group"><b>Direcci&oacute;n<input type="hidden" name="bksaiacondicion_g@direccion" id="bksaiacondicion_g@direccion" value="like_total"></b><div class="controls"><input type="text" id="direccion" name="bqsaia_g@direccion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@direccion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@direccion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@direccion" id="bqsaiaenlace_g@direccion" value="y" />
		</div></div></div><div class="control-group"><b>Telefono<input type="hidden" name="bksaiacondicion_g@telefono" id="bksaiacondicion_g@telefono" value="like_total"></b><div class="controls"><input type="text" id="telefono" name="bqsaia_g@telefono"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_contacto_adicional g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="contacto_adicional"></body><input type="hidden" name="idbusqueda_componente" value="">