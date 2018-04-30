<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Bases de Calidad</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_base_calidad"><b>Tipo<input type="hidden" name="bksaiacondicion_g@tipo_base_calidad" id="bksaiacondicion_g@tipo_base_calidad" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(479,6050,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_base_calidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_base_calidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_base_calidad" id="bqsaiaenlace_g@tipo_base_calidad" value="y" />
		</div></div></div><div class="control-group"><b>Versi&oacute;n<input type="hidden" name="bksaiacondicion_g@version_base_calidad" id="bksaiacondicion_g@version_base_calidad" value="like_total"></b><div class="controls"><input type="text" id="version_base_calidad" name="bqsaia_g@version_base_calidad"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@version_base_calidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@version_base_calidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@version_base_calidad" id="bqsaiaenlace_g@version_base_calidad" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion_base" id="bksaiacondicion_g@descripcion_base" value="like_total"></b><div class="controls"><textarea    id="descripcion_base" name="bqsaia_g@descripcion_base"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_bases_calidad g @ AND  g.documento_iddocumento=iddocumento "></body>