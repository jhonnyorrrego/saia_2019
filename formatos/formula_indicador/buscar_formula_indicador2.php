<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Formula del indicador</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="naturaleza"><b>Naturaleza<input type="hidden" name="bksaiacondicion_g@naturaleza" id="bksaiacondicion_g@naturaleza" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(488,6199,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@naturaleza',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@naturaleza',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@naturaleza" id="bqsaiaenlace_g@naturaleza" value="y" />
		</div></div></div><div class="control-group"><b>Formula<input type="hidden" name="bksaiacondicion_g@nombre" id="bksaiacondicion_g@nombre" value="like_total"></b><div class="controls"><input type="text" id="nombre" name="bqsaia_g@nombre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre" id="bqsaiaenlace_g@nombre" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n de Variables de la Formula<input type="hidden" name="bksaiacondicion_g@observacion" id="bksaiacondicion_g@observacion" value="like_total"></b><div class="controls"><textarea  maxlength="3000"   id="observacion" name="bqsaia_g@observacion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@observacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@observacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@observacion" id="bqsaiaenlace_g@observacion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="periocidad"><b>Periodicidad<input type="hidden" name="bksaiacondicion_g@periocidad" id="bksaiacondicion_g@periocidad" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(488,6202,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@periocidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@periocidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@periocidad" id="bqsaiaenlace_g@periocidad" value="y" />
		</div></div></div><div class="control-group"><b>Unidad<input type="hidden" name="bksaiacondicion_g@unidad" id="bksaiacondicion_g@unidad" value="like_total"></b><div class="controls"><input type="text" id="unidad" name="bqsaia_g@unidad"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@unidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@unidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@unidad" id="bqsaiaenlace_g@unidad" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_rango"><b>La mejora es creciente o decreciente?<input type="hidden" name="bksaiacondicion_g@tipo_rango" id="bksaiacondicion_g@tipo_rango" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(488,6205,'',1,'buscar');?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_formula_indicador g @ AND  g.documento_iddocumento=iddocumento "></body>