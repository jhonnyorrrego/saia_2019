<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato 1. Valoracion Controles Riesgos</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Consecutivo<input type="hidden" name="bksaiacondicion_g@consecutivo_control" id="bksaiacondicion_g@consecutivo_control" value="like_total"></b><div class="controls"><input type="text" id="consecutivo_control" name="bqsaia_g@consecutivo_control"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@consecutivo_control',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@consecutivo_control',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@consecutivo_control" id="bqsaiaenlace_g@consecutivo_control" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_valoracion"><b>Fecha valoracion</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_valoracion_x" id="bksaiacondicion_g@fecha_valoracion_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_valoracion_x" id="fecha_valoracion_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_valoracion_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_valoracion_y" id="bksaiacondicion_g@fecha_valoracion_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_valoracion_y" id="fecha_valoracion_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_valoracion_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_valoracion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_valoracion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_valoracion" id="bqsaiaenlace_fecha_valoracion" value="y" />
		</div></div></div><div class="control-group"><b>DESCRIPCI&Oacute;N DEL CONTROL EXISTENTE<input type="hidden" name="bksaiacondicion_g@descripcion_control" id="bksaiacondicion_g@descripcion_control" value="like_total"></b><div class="controls"><textarea  maxlength="6000"   id="descripcion_control" name="bqsaia_g@descripcion_control"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_control',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_control',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_control" id="bqsaiaenlace_g@descripcion_control" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_control"><b>El control afecta?<input type="hidden" name="bksaiacondicion_g@tipo_control" id="bksaiacondicion_g@tipo_control" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(394,4711,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_control',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_control',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_control" id="bqsaiaenlace_g@tipo_control" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="herramientas_ejercer_control"><b>Herramientas para ejercer el control<input type="hidden" name="bksaiacondicion_herramientas_ejercer_control" id="bksaiacondicion_herramientas_ejercer_control" value="like_total"></b></label></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="herramienta_ejercer"><b>1. Posee una herramienta para ejercer el control?<input type="hidden" name="bksaiacondicion_g@herramienta_ejercer" id="bksaiacondicion_g@herramienta_ejercer" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(394,4716,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@herramienta_ejercer',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@herramienta_ejercer',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@herramienta_ejercer" id="bqsaiaenlace_g@herramienta_ejercer" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="procedimiento_herramienta"><b>2. Existen manuales, instructivos o procedimientos para el manejo de la herramienta?<input type="hidden" name="bksaiacondicion_g@procedimiento_herramienta" id="bksaiacondicion_g@procedimiento_herramienta" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(394,4717,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@procedimiento_herramienta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@procedimiento_herramienta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@procedimiento_herramienta" id="bqsaiaenlace_g@procedimiento_herramienta" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="herramienta_efectiva"><b>3. En el tiempo que lleva la herramienta, ha demostrado ser efectiva?<input type="hidden" name="bksaiacondicion_g@herramienta_efectiva" id="bksaiacondicion_g@herramienta_efectiva" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(394,4718,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@herramienta_efectiva',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@herramienta_efectiva',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@herramienta_efectiva" id="bqsaiaenlace_g@herramienta_efectiva" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="seguimiento_al_control"><b>SEGUIMIENTO AL CONTROL<input type="hidden" name="bksaiacondicion_seguimiento_al_control" id="bksaiacondicion_seguimiento_al_control" value="like_total"></b></label></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="responsables_ejecucion"><b>4. Estan definidos los responsables de la ejecuci&oacute;n del control y del seguimiento?<input type="hidden" name="bksaiacondicion_g@responsables_ejecucion" id="bksaiacondicion_g@responsables_ejecucion" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(394,4720,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@responsables_ejecucion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@responsables_ejecucion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@responsables_ejecucion" id="bqsaiaenlace_g@responsables_ejecucion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="frecuencia_ejecucion"><b>5. La frecuencia de la ejecuci&oacute;n del control y seguimiento es adecuado?<input type="hidden" name="bksaiacondicion_g@frecuencia_ejecucion" id="bksaiacondicion_g@frecuencia_ejecucion" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(394,4721,'',1,'buscar');?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_control_riesgos g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_valoracion_x,g@fecha_valoracion_y">