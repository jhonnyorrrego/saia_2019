<?php include_once("../librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Elementos de salida</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="item_salida"><b>Elemento de salida<input type="hidden" name="bksaiacondicion_g@item_salida" id="bksaiacondicion_g@item_salida" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(326,3814,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_item_salida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_item_salida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_item_salida" id="bqsaiaenlace_item_salida" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><input type="text" id="observaciones" name="bqsaia_g@observaciones"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_elemento_salida g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="elemento_salida"></body>