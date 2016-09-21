<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Salida de Elementos</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Adicionar Elemento<input type="hidden" name="bksaiacondicion_g@adicionar_item" id="bksaiacondicion_g@adicionar_item" value="="></b><div class="controls"><input type="text" id="adicionar_item" name="bqsaia_g@adicionar_item"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@adicionar_item',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@adicionar_item',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@adicionar_item" id="bqsaiaenlace_g@adicionar_item" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_solicitud"><b>Fecha de Solicitud</b></label>
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
		</div></div></div><div class="control-group"><b>Nombre de solicitante<input type="hidden" name="bksaiacondicion_g@solicitante" id="bksaiacondicion_g@solicitante" value="like_total"></b><div class="controls"><input type="text" id="solicitante" name="bqsaia_g@solicitante"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@solicitante',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@solicitante',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@solicitante" id="bqsaiaenlace_g@solicitante" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n de la salida<input type="hidden" name="bksaiacondicion_g@descripcion_salida" id="bksaiacondicion_g@descripcion_salida" value="="></b><div class="controls"><textarea  maxlength="11"   id="descripcion_salida" name="bqsaia_g@descripcion_salida"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_salida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_salida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_salida" id="bqsaiaenlace_g@descripcion_salida" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_salida"><b>Fecha de Salida</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_salida_x" id="bksaiacondicion_g@fecha_salida_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_salida_x" id="fecha_salida_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_salida_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_salida_y" id="bksaiacondicion_g@fecha_salida_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_salida_y" id="fecha_salida_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_salida_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_salida_elementos g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_solicitud_x,g@fecha_solicitud_y,g@fecha_salida_x,g@fecha_salida_y">