<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Solicitud de repuesto</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_repuesto"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_repuesto_x" id="bksaiacondicion_g@fecha_repuesto_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_repuesto_x" id="fecha_repuesto_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_repuesto_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_repuesto_y" id="bksaiacondicion_g@fecha_repuesto_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_repuesto_y" id="fecha_repuesto_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_repuesto_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_repuesto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_repuesto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_repuesto" id="bqsaiaenlace_fecha_repuesto" value="y" />
		</div></div></div><div class="control-group"><b>repuesto<input type="hidden" name="bksaiacondicion_g@repuesto" id="bksaiacondicion_g@repuesto" value="like_total"></b><div class="controls"><input type="text" id="repuesto" name="bqsaia_g@repuesto"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@repuesto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@repuesto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@repuesto" id="bqsaiaenlace_g@repuesto" value="y" />
		</div></div></div><div class="control-group"><b>cantidad<input type="hidden" name="bksaiacondicion_g@cantidad" id="bksaiacondicion_g@cantidad" value="="></b><div class="controls"><input type="text" id="cantidad" name="bqsaia_g@cantidad"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicit_respeuesto g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_repuesto_x,g@fecha_repuesto_y">