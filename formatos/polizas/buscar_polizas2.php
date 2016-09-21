<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato 3. P&oacute;lizas</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_expedicion"><b>Fecha de expedici&oacute;n</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_expedicion_x" id="bksaiacondicion_g@fecha_expedicion_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_expedicion_x" id="fecha_expedicion_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_expedicion_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_expedicion_y" id="bksaiacondicion_g@fecha_expedicion_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_expedicion_y" id="fecha_expedicion_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_expedicion_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_expedicion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_expedicion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_expedicion" id="bqsaiaenlace_fecha_expedicion" value="y" />
		</div></div></div><div class="control-group"><b>Aseguradora<input type="hidden" name="bksaiacondicion_g@aseguradora" id="bksaiacondicion_g@aseguradora" value="like_total"></b><div class="controls"><input type="text" id="aseguradora" name="bqsaia_g@aseguradora"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@aseguradora',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@aseguradora',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@aseguradora" id="bqsaiaenlace_g@aseguradora" value="y" />
		</div></div></div><div class="control-group"><b>N&uacute;mero de poliza<input type="hidden" name="bksaiacondicion_g@poliza" id="bksaiacondicion_g@poliza" value="="></b><div class="controls"><input type="text" id="poliza" name="bqsaia_g@poliza"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@poliza',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@poliza',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@poliza" id="bqsaiaenlace_g@poliza" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_inicio"><b>Vigencia desde</b></label>
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
                  <label class="string control-label" for="fecha_fin"><b>Vigencia hasta</b></label>
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
		</div></div></div><div class="control-group"><b>Valor de cobertura<input type="hidden" name="bksaiacondicion_g@valor" id="bksaiacondicion_g@valor" value="like_total"></b><div class="controls"><input type="text" id="valor" name="bqsaia_g@valor"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_polizas g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_expedicion_x,g@fecha_expedicion_y,g@fecha_inicio_x,g@fecha_inicio_y,g@fecha_fin_x,g@fecha_fin_y">