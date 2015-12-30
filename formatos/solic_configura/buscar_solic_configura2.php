<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Solicitud de configuracion</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_config"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_config_x" id="bksaiacondicion_g@fecha_config_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_config_x" id="fecha_config_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_config_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_config_y" id="bksaiacondicion_g@fecha_config_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_config_y" id="fecha_config_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_config_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_config',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_config',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_config" id="bqsaiaenlace_fecha_config" value="y" />
		</div></div></div><div class="control-group"><b>Configuracion<input type="hidden" name="bksaiacondicion_g@solicitud" id="bksaiacondicion_g@solicitud" value="like_total"></b><div class="controls"><textarea    id="solicitud" name="bqsaia_g@solicitud"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solic_configura g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_config_x,g@fecha_config_y">