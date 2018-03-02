<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Seguimiento Indicador</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_seguimiento"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_seguimiento_x" id="bksaiacondicion_g@fecha_seguimiento_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_seguimiento_x" id="fecha_seguimiento_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_seguimiento_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_seguimiento_y" id="bksaiacondicion_g@fecha_seguimiento_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_seguimiento_y" id="fecha_seguimiento_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_seguimiento_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_seguimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_seguimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_seguimiento" id="bqsaiaenlace_fecha_seguimiento" value="y" />
		</div></div></div><div class="control-group"><b>Limite superior<input type="hidden" name="bksaiacondicion_g@meta_indicador_actual" id="bksaiacondicion_g@meta_indicador_actual" value="like_total"></b><div class="controls"><input type="text" id="meta_indicador_actual" name="bqsaia_g@meta_indicador_actual"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@meta_indicador_actual',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@meta_indicador_actual',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@meta_indicador_actual" id="bqsaiaenlace_g@meta_indicador_actual" value="y" />
		</div></div></div><div class="control-group"><b>Resultados<input type="hidden" name="bksaiacondicion_g@resultado" id="bksaiacondicion_g@resultado" value="like_total"></b><div class="controls"><input type="text" id="resultado" name="bqsaia_g@resultado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@resultado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@resultado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@resultado" id="bqsaiaenlace_g@resultado" value="y" />
		</div></div></div><div class="control-group"><b>An&aacute;lisis de datos<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_seguimiento_indicador g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_seguimiento_x,g@fecha_seguimiento_y">