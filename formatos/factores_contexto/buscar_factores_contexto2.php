<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Factores</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="factores_contexto"><b>Factor<input type="hidden" name="bksaiacondicion_g@factores_contexto" id="bksaiacondicion_g@factores_contexto" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(386,4576,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@factores_contexto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@factores_contexto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@factores_contexto" id="bqsaiaenlace_g@factores_contexto" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea    id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_factores_contexto g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="factores_contexto"></body>