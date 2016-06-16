<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Contexto estrategico</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Proceso<input type="hidden" name="bksaiacondicion_g@proceso" id="bksaiacondicion_g@proceso" value="like_total"></b><div class="controls"><input type="text" id="proceso" name="bqsaia_g@proceso"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@proceso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@proceso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@proceso" id="bqsaiaenlace_g@proceso" value="y" />
		</div></div></div><div class="control-group"><b>Objetivo<input type="hidden" name="bksaiacondicion_g@objetivo" id="bksaiacondicion_g@objetivo" value="like_total"></b><div class="controls"><textarea    id="objetivo" name="bqsaia_g@objetivo"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_contexto_extrategico g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body>