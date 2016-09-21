<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato 2. Novedades</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_novedad"><b>Fecha de novedad</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_novedad_x" id="bksaiacondicion_g@fecha_novedad_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_novedad_x" id="fecha_novedad_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_novedad_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_novedad_y" id="bksaiacondicion_g@fecha_novedad_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_novedad_y" id="fecha_novedad_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_novedad_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_novedad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_novedad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_novedad" id="bqsaiaenlace_fecha_novedad" value="y" />
		</div></div></div><div class="control-group"><b>Novedad<input type="hidden" name="bksaiacondicion_g@novedad" id="bksaiacondicion_g@novedad" value="like_total"></b><div class="controls"><textarea    id="novedad" name="bqsaia_g@novedad"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_novedades g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_novedad_x,g@fecha_novedad_y">