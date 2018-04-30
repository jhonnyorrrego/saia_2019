<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Reservar</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_solicitud"><b>Fecha de solicitud</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_solicitud_x" id="bksaiacondicion_g@fecha_solicitud_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_solicitud_x" id="fecha_solicitud_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_solicitud_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_solicitud_y" id="bksaiacondicion_g@fecha_solicitud_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_solicitud_y" id="fecha_solicitud_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_solicitud_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_solicitud" id="bqsaiaenlace_fecha_solicitud" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="desde"><b>Desde<input type="hidden" name="bksaiacondicion_desde" id="bksaiacondicion_desde" value="like_total"></b></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="desde_1"  id="desde_1" value=""><?php selector_fecha("desde_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="desde_2"  id="desde_2" value=""><?php selector_fecha("desde_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_desde',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_desde',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_desde" id="bqsaiaenlace_desde" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="hasta"><b>Hasta<input type="hidden" name="bksaiacondicion_hasta" id="bksaiacondicion_hasta" value="like_total"></b></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="hasta_1"  id="hasta_1" value=""><?php selector_fecha("hasta_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="hasta_2"  id="hasta_2" value=""><?php selector_fecha("hasta_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_hasta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_hasta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_hasta" id="bqsaiaenlace_hasta" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="solicitar_a"><b>Solicitar a<input type="hidden" name="bksaiacondicion_g@solicitar_a" id="bksaiacondicion_g@solicitar_a" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(324,3787,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_solicitar_a',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_solicitar_a',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_solicitar_a" id="bqsaiaenlace_solicitar_a" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_reservar_documento g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_solicitud_x,g@fecha_solicitud_y">