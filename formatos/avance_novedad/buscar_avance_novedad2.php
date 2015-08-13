<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Avance de novedad</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_avance"><b>Fecha de avance</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_avance_x" id="bksaiacondicion_g@fecha_avance_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_avance_x" id="fecha_avance_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_avance_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_avance_y" id="bksaiacondicion_g@fecha_avance_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_avance_y" id="fecha_avance_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_avance_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_avance',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_avance',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_avance" id="bqsaiaenlace_fecha_avance" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion_avance" id="bksaiacondicion_g@descripcion_avance" value="like_total"></b><div class="controls"><textarea    id="descripcion_avance" name="bqsaia_g@descripcion_avance"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_avance',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_avance',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_avance" id="bqsaiaenlace_g@descripcion_avance" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado_avance"><b>Estado<input type="hidden" name="bksaiacondicion_g@estado_avance" id="bksaiacondicion_g@estado_avance" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(321,3758,'',1,'buscar');?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_avance_novedad g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_avance_x,g@fecha_avance_y"><input type="hidden" name="idbusqueda_componente" value="">