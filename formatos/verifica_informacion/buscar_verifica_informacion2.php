<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="presenta_inconsisten"><b>Presenta Inconsistencias<input type="hidden" name="bksaiacondicion_g@presenta_inconsisten" id="bksaiacondicion_g@presenta_inconsisten" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(269,3120,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@presenta_inconsisten',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@presenta_inconsisten',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@presenta_inconsisten" id="bqsaiaenlace_g@presenta_inconsisten" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observacion_verifica" id="bksaiacondicion_g@observacion_verifica" value="like_total"></b><div class="controls"><textarea    id="observacion_verifica" name="bqsaia_g@observacion_verifica"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@observacion_verifica',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@observacion_verifica',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@observacion_verifica" id="bqsaiaenlace_g@observacion_verifica" value="y" />
		</div></div></div><div class="control-group"><b>Nombre Afiliado<input type="hidden" name="bksaiacondicion_g@nombre_afiliado" id="bksaiacondicion_g@nombre_afiliado" value="like_total"></b><div class="controls"><input type="text" id="nombre_afiliado" name="bqsaia_g@nombre_afiliado"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_verifica_informacion g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="idbusqueda_componente" value="144">