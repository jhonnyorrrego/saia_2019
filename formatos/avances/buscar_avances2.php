<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Avances tarea</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado"><b>Estado<input type="hidden" name="bksaiacondicion_g@estado" id="bksaiacondicion_g@estado" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(240,2725,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado" id="bqsaiaenlace_estado" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion_formato" id="bksaiacondicion_g@descripcion_formato" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="descripcion_formato" name="bqsaia_g@descripcion_formato"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_formato',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_formato',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_formato" id="bqsaiaenlace_g@descripcion_formato" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_formato"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_formato_x" id="bksaiacondicion_g@fecha_formato_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_formato_x" id="fecha_formato_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_formato_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_formato_y" id="bksaiacondicion_g@fecha_formato_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_formato_y" id="fecha_formato_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_formato_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_avances g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_formato_x,g@fecha_formato_y">