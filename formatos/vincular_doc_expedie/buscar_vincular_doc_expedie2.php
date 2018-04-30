<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Vincular Documentos a un Expediente</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_documento"><b>Fecha<input type="hidden" name="bksaiacondicion_g@fecha_documento" id="bksaiacondicion_g@fecha_documento" value="date"></b></label><div class="controls">
                   <input type="text" readonly="true"  name="bqsaia_g@fecha_documento" id="fecha_documento" tipo="fecha" value=""><?php selector_fecha("fecha_documento","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></form><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha_documento" id="bqsaiaenlace_g@fecha_documento" value="y" />
		</div></div></div><div class="control-group"><b>Nombre o asunto<input type="hidden" name="bksaiacondicion_g@asunto" id="bksaiacondicion_g@asunto" value="like_total"></b><div class="controls"><input type="text" id="asunto" name="bqsaia_g@asunto"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@asunto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@asunto" id="bqsaiaenlace_g@asunto" value="y" />
		</div></div></div><div class="control-group"><b>Expediente vinculado<input type="hidden" name="bksaiacondicion_g@fk_idexpediente" id="bksaiacondicion_g@fk_idexpediente" value="like_total"></b><div class="controls"><input type="text" id="fk_idexpediente" name="bqsaia_g@fk_idexpediente"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fk_idexpediente',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fk_idexpediente',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fk_idexpediente" id="bqsaiaenlace_g@fk_idexpediente" value="y" />
		</div></div></div><div class="control-group"><b>observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_vincular_doc_expedie g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|">