<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Novedad Despacho Mensajeros</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Fecha de Novedad<input type="hidden" name="bksaiacondicion_g@fecha_novedad" id="bksaiacondicion_g@fecha_novedad" value="like_total"></b><div class="controls"><input type="text" id="fecha_novedad" name="bqsaia_g@fecha_novedad"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha_novedad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha_novedad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha_novedad" id="bqsaiaenlace_g@fecha_novedad" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="item_radicacion"><b>Items de Planilla<input type="hidden" name="bksaiacondicion_item_radicacion" id="bksaiacondicion_item_radicacion" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(411,5097,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_item_radicacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_item_radicacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_item_radicacion" id="bqsaiaenlace_item_radicacion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="novedad"><b>novedad<input type="hidden" name="bksaiacondicion_g@novedad" id="bksaiacondicion_g@novedad" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(411,5098,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_novedad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_novedad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_novedad" id="bqsaiaenlace_novedad" value="y" />
		</div></div></div><div class="control-group"><b>observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_novedad_despacho g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body>