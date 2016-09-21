<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Volumen documental</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_soporte"><b>Tipo de soporte<input type="hidden" name="bksaiacondicion_g@tipo_soporte" id="bksaiacondicion_g@tipo_soporte" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(318,3733,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_soporte',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_soporte',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_soporte" id="bqsaiaenlace_g@tipo_soporte" value="y" />
		</div></div></div><div class="control-group"><b>Cantidad<input type="hidden" name="bksaiacondicion_g@cantidad" id="bksaiacondicion_g@cantidad" value="="></b><div class="controls"><input type="text" id="cantidad" name="bqsaia_g@cantidad"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cantidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cantidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cantidad" id="bqsaiaenlace_g@cantidad" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="riesgos"><b>Riesgos<input type="hidden" name="bksaiacondicion_riesgos" id="bksaiacondicion_riesgos" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(318,3735,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_riesgos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_riesgos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_riesgos" id="bqsaiaenlace_riesgos" value="y" />
		</div></div></div><div class="control-group"><b>Descripcion<input type="hidden" name="bksaiacondicion_g@descripcion_volumen" id="bksaiacondicion_g@descripcion_volumen" value="like_total"></b><div class="controls"><textarea    id="descripcion_volumen" name="bqsaia_g@descripcion_volumen"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_volumen',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_volumen',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_volumen" id="bqsaiaenlace_g@descripcion_volumen" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="nivel_pertinencia"><b>Nivel de pertinencia<input type="hidden" name="bksaiacondicion_g@nivel_pertinencia" id="bksaiacondicion_g@nivel_pertinencia" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(318,3737,'',1,'buscar');?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_volumen_documental g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="volumen_documental"></body>