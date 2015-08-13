<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_formacion"><b>Tipo de Formaci&oacute;n Acad&eacute;mica<input type="hidden" name="bksaiacondicion_g@tipo_formacion" id="bksaiacondicion_g@tipo_formacion" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(220,2373,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_formacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_formacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_formacion" id="bqsaiaenlace_g@tipo_formacion" value="y" />
		</div></div></div><div class="control-group"><b>Instituci&oacute;n<input type="hidden" name="bksaiacondicion_g@institucion_formacion" id="bksaiacondicion_g@institucion_formacion" value="like_total"></b><div class="controls"><input type="text" id="institucion_formacion" name="bqsaia_g@institucion_formacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@institucion_formacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@institucion_formacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@institucion_formacion" id="bqsaiaenlace_g@institucion_formacion" value="y" />
		</div></div></div><div class="control-group"><b>T&iacute;tulo Obtenido<input type="hidden" name="bksaiacondicion_g@titulo_formacion" id="bksaiacondicion_g@titulo_formacion" value="like_total"></b><div class="controls"><input type="text" id="titulo_formacion" name="bqsaia_g@titulo_formacion"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_formacion_academica g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="idbusqueda_componente" value="0">