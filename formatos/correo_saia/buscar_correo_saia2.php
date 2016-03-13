<?php include_once("../formatos/librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Correo SAIA</legend><br /><br /><?php include_once("../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Asunto<input type="hidden" name="bksaiacondicion_g@asunto" id="bksaiacondicion_g@asunto" value="like_total"></b><div class="controls"><input type="text" id="asunto" name="bqsaia_g@asunto"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@asunto" id="bqsaiaenlace_g@asunto" value="y" />
		</div></div></div><div class="control-group"><b>Fecha Oficio Entrada<input type="hidden" name="bksaiacondicion_g@fecha_oficio_entrada" id="bksaiacondicion_g@fecha_oficio_entrada" value="like_total"></b><div class="controls"><input type="text" id="fecha_oficio_entrada" name="bqsaia_g@fecha_oficio_entrada"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha_oficio_entrada',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha_oficio_entrada',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha_oficio_entrada" id="bqsaiaenlace_g@fecha_oficio_entrada" value="y" />
		</div></div></div><div class="control-group"><b>De<input type="hidden" name="bksaiacondicion_g@de" id="bksaiacondicion_g@de" value="like_total"></b><div class="controls"><input type="text" id="de" name="bqsaia_g@de"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@de',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@de',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@de" id="bqsaiaenlace_g@de" value="y" />
		</div></div></div><div class="control-group"><b>Para<input type="hidden" name="bksaiacondicion_g@para" id="bksaiacondicion_g@para" value="like_total"></b><div class="controls"><input type="text" id="para" name="bqsaia_g@para"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@para',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@para',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@para" id="bqsaiaenlace_g@para" value="y" />
		</div></div></div><div class="control-group"><b>Comentario<input type="hidden" name="bksaiacondicion_g@comentario" id="bksaiacondicion_g@comentario" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="comentario" name="bqsaia_g@comentario"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_correo_saia g @ AND  g.documento_iddocumento=iddocumento "></body>