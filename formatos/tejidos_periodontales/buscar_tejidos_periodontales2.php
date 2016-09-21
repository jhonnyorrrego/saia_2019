<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Tejidos periodontales</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_periodontal"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_periodontal_x" id="bksaiacondicion_g@fecha_periodontal_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_periodontal_x" id="fecha_periodontal_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_periodontal_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_periodontal_y" id="bksaiacondicion_g@fecha_periodontal_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_periodontal_y" id="fecha_periodontal_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_periodontal_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_periodontal',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_periodontal',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_periodontal" id="bqsaiaenlace_fecha_periodontal" value="y" />
		</div></div></div><div class="control-group"><b>Caja1<input type="hidden" name="bksaiacondicion_g@caja_uno" id="bksaiacondicion_g@caja_uno" value="like_total"></b><div class="controls"><input type="text" id="caja_uno" name="bqsaia_g@caja_uno"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@caja_uno',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@caja_uno',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@caja_uno" id="bqsaiaenlace_g@caja_uno" value="y" />
		</div></div></div><div class="control-group"><b>caja2<input type="hidden" name="bksaiacondicion_g@caja_dos" id="bksaiacondicion_g@caja_dos" value="like_total"></b><div class="controls"><input type="text" id="caja_dos" name="bqsaia_g@caja_dos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@caja_dos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@caja_dos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@caja_dos" id="bqsaiaenlace_g@caja_dos" value="y" />
		</div></div></div><div class="control-group"><b>caja3<input type="hidden" name="bksaiacondicion_g@caja_tres" id="bksaiacondicion_g@caja_tres" value="like_total"></b><div class="controls"><input type="text" id="caja_tres" name="bqsaia_g@caja_tres"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@caja_tres',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@caja_tres',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@caja_tres" id="bqsaiaenlace_g@caja_tres" value="y" />
		</div></div></div><div class="control-group"><b>caja4<input type="hidden" name="bksaiacondicion_g@caja_cuatro" id="bksaiacondicion_g@caja_cuatro" value="like_total"></b><div class="controls"><input type="text" id="caja_cuatro" name="bqsaia_g@caja_cuatro"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_tejidos_periodontales g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_periodontal_x,g@fecha_periodontal_y">