<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="calificacion_tarea"><b>Calificaci&oacute; de la tarea<input type="hidden" name="bksaiacondicion_g@calificacion_tarea" id="bksaiacondicion_g@calificacion_tarea" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(241,2717,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@calificacion_tarea',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@calificacion_tarea',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@calificacion_tarea" id="bqsaiaenlace_g@calificacion_tarea" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_cierre_tarea g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="idbusqueda_componente" value="0">