<?php include_once("../librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Hallazgo Plan de Mejoramiento</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="clase_accion"><b>Clase accion<input type="hidden" name="bksaiacondicion_g@clase_accion" id="bksaiacondicion_g@clase_accion" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(481,6094,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_clase_accion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_clase_accion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_clase_accion" id="bqsaiaenlace_clase_accion" value="y" />
		</div></div></div><div class="control-group"><b>Radicado del plan vinculado<input type="hidden" name="bksaiacondicion_g@radicado_plan" id="bksaiacondicion_g@radicado_plan" value="like_total"></b><div class="controls"><input type="text" id="radicado_plan" name="bqsaia_g@radicado_plan"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@radicado_plan',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@radicado_plan',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@radicado_plan" id="bqsaiaenlace_g@radicado_plan" value="y" />
		</div></div></div><div class="control-group"><b>Consecutivo<input type="hidden" name="bksaiacondicion_g@consecutivo_hallazgo" id="bksaiacondicion_g@consecutivo_hallazgo" value="like_total"></b><div class="controls"><input type="text" id="consecutivo_hallazgo" name="bqsaia_g@consecutivo_hallazgo"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_hallazgo g @ AND  g.documento_iddocumento=iddocumento "></body>