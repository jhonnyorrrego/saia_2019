<?php include_once("../librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Planeacion - Analisis de Causas</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Analisis de Causas<input type="hidden" name="bksaiacondicion_g@analisis_causas" id="bksaiacondicion_g@analisis_causas" value="like_total"></b><div class="controls"><input type="text" id="analisis_causas" name="bqsaia_g@analisis_causas"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@analisis_causas',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@analisis_causas',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@analisis_causas" id="bqsaiaenlace_g@analisis_causas" value="y" />
		</div></div></div><div class="control-group"><b>Item Causas<input type="hidden" name="bksaiacondicion_g@item_causas" id="bksaiacondicion_g@item_causas" value="="></b><div class="controls"><input type="text" id="item_causas" name="bqsaia_g@item_causas"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_analisis_pqrsf g @ AND  g.documento_iddocumento=iddocumento "></body>