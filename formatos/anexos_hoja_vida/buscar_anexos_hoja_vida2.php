<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Anexos hoja de vida</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estructura_hoja_vida"><b>Estructura<input type="hidden" name="bksaiacondicion_g@estructura_hoja_vida" id="bksaiacondicion_g@estructura_hoja_vida" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(224,2448,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estructura_hoja_vida',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estructura_hoja_vida',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estructura_hoja_vida" id="bqsaiaenlace_estructura_hoja_vida" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_vigencia"><b>Fecha de vigencia</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_vigencia_x" id="bksaiacondicion_g@fecha_vigencia_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_vigencia_x" id="fecha_vigencia_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_vigencia_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_vigencia_y" id="bksaiacondicion_g@fecha_vigencia_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_vigencia_y" id="fecha_vigencia_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_vigencia_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_vigencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_vigencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_vigencia" id="bqsaiaenlace_fecha_vigencia" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea    id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_anexos_hoja_vida g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_vigencia_x,g@fecha_vigencia_y">