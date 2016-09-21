<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Mantenimiento</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_solicitud"><b>Fecha de la solicitud<input type="hidden" name="bksaiacondicion_fecha_solicitud" id="bksaiacondicion_fecha_solicitud" value="like_total"></b></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="fecha_solicitud_1"  id="fecha_solicitud_1" value=""><?php selector_fecha("fecha_solicitud_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_solicitud_2"  id="fecha_solicitud_2" value=""><?php selector_fecha("fecha_solicitud_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_solicitud" id="bqsaiaenlace_fecha_solicitud" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion" id="bqsaiaenlace_g@descripcion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="categoria"><b>Categor&iacute;a<input type="hidden" name="bksaiacondicion_g@categoria" id="bksaiacondicion_g@categoria" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(232,2606,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@categoria',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@categoria',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@categoria" id="bqsaiaenlace_g@categoria" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="prioridad"><b>Prioridad<input type="hidden" name="bksaiacondicion_g@prioridad" id="bksaiacondicion_g@prioridad" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(232,2583,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@prioridad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@prioridad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@prioridad" id="bqsaiaenlace_g@prioridad" value="y" />
		</div></div></div><div class="control-group"><b>Solicitante<input type="hidden" name="bksaiacondicion_g@solicitante" id="bksaiacondicion_g@solicitante" value="like_total"></b><div class="controls"><input type="text" id="solicitante" name="bqsaia_g@solicitante"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@solicitante',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@solicitante',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@solicitante" id="bqsaiaenlace_g@solicitante" value="y" />
		</div></div></div><div class="control-group"><b>Responsable<input type="hidden" name="bksaiacondicion_g@responsable" id="bksaiacondicion_g@responsable" value="like_total"></b><div class="controls"><input type="text" id="responsable" name="bqsaia_g@responsable"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicid_matenimiento g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|">