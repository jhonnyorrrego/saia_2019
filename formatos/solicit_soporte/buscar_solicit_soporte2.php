<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Solicitud de soporte</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_req"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_req_x" id="bksaiacondicion_g@fecha_req_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_req_x" id="fecha_req_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_req_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_req_y" id="bksaiacondicion_g@fecha_req_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_req_y" id="fecha_req_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_req_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_req',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_req',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_req" id="bqsaiaenlace_fecha_req" value="y" />
		</div></div></div><div class="control-group"><b>Solicitud de soporte<input type="hidden" name="bksaiacondicion_g@soli_sop" id="bksaiacondicion_g@soli_sop" value="like_total"></b><div class="controls"><textarea    id="soli_sop" name="bqsaia_g@soli_sop"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicit_soporte g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_req_x,g@fecha_req_y">