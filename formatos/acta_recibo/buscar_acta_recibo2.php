<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Acta de recibo</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_cta"><b>fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_cta_x" id="bksaiacondicion_g@fecha_cta_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_cta_x" id="fecha_cta_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_cta_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_cta_y" id="bksaiacondicion_g@fecha_cta_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_cta_y" id="fecha_cta_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_cta_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_cta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_cta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_cta" id="bqsaiaenlace_fecha_cta" value="y" />
		</div></div></div><div class="control-group"><b>Entrega<input type="hidden" name="bksaiacondicion_g@entrega" id="bksaiacondicion_g@entrega" value="like_total"></b><div class="controls"><textarea    id="entrega" name="bqsaia_g@entrega"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_acta_recibo g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_cta_x,g@fecha_cta_y">