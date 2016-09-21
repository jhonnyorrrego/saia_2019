<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato 2. Contrato</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Objeto de contrato<input type="hidden" name="bksaiacondicion_g@objeto_contrato" id="bksaiacondicion_g@objeto_contrato" value="like_total"></b><div class="controls"><input type="text" id="objeto_contrato" name="bqsaia_g@objeto_contrato"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@objeto_contrato',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@objeto_contrato',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@objeto_contrato" id="bqsaiaenlace_g@objeto_contrato" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_inicio"><b>Fecha de inicio de contrato</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_inicio_x" id="bksaiacondicion_g@fecha_inicio_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_inicio_x" id="fecha_inicio_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_inicio_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_inicio_y" id="bksaiacondicion_g@fecha_inicio_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_inicio_y" id="fecha_inicio_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_inicio_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_inicio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_inicio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_inicio" id="bqsaiaenlace_fecha_inicio" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_fin"><b>Fecha de finalizacion de contrato</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_fin_x" id="bksaiacondicion_g@fecha_fin_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_fin_x" id="fecha_fin_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_fin_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_fin_y" id="bksaiacondicion_g@fecha_fin_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_fin_y" id="fecha_fin_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_fin_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_fin',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_fin',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_fin" id="bqsaiaenlace_fecha_fin" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_contrato_registro_cliente g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_inicio_x,g@fecha_inicio_y,g@fecha_fin_x,g@fecha_fin_y">