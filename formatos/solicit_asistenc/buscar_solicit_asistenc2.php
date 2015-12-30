<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Solicitud de asistencia tecnica</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_asis"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_asis_x" id="bksaiacondicion_g@fecha_asis_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_asis_x" id="fecha_asis_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_asis_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_asis_y" id="bksaiacondicion_g@fecha_asis_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_asis_y" id="fecha_asis_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_asis_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_asis',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_asis',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_asis" id="bqsaiaenlace_fecha_asis" value="y" />
		</div></div></div><div class="control-group"><b>Descripcion<input type="hidden" name="bksaiacondicion_g@descrip" id="bksaiacondicion_g@descrip" value="like_total"></b><div class="controls"><textarea    id="descrip" name="bqsaia_g@descrip"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicit_asistenc g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_asis_x,g@fecha_asis_y">