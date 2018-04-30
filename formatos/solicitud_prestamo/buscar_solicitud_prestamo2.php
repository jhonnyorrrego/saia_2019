<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Solicitud de Prestamo</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha"><b>FECHA DE SOLICITUD</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_x" id="bksaiacondicion_g@fecha_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_x" id="fecha_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_y" id="bksaiacondicion_g@fecha_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_y" id="fecha_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha" id="bqsaiaenlace_fecha" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@observaciones" id="bqsaiaenlace_g@observaciones" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="documento_archivo"><b>Ubicaci&oacute;n del documento<input type="hidden" name="bksaiacondicion_g@documento_archivo" id="bksaiacondicion_g@documento_archivo" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(412,5114,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@documento_archivo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@documento_archivo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@documento_archivo" id="bqsaiaenlace_g@documento_archivo" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_prestamo_rep"><b>FECHA REQUERIDA PARA PRESTAMO</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_prestamo_rep_x" id="bksaiacondicion_g@fecha_prestamo_rep_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_prestamo_rep_x" id="fecha_prestamo_rep_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_prestamo_rep_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_prestamo_rep_y" id="bksaiacondicion_g@fecha_prestamo_rep_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_prestamo_rep_y" id="fecha_prestamo_rep_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_prestamo_rep_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_prestamo_rep',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_prestamo_rep',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_prestamo_rep" id="bqsaiaenlace_fecha_prestamo_rep" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_devolucion_rep"><b>Fecha de Devoluci&oacute;n Estimada</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_devolucion_rep_x" id="bksaiacondicion_g@fecha_devolucion_rep_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_devolucion_rep_x" id="fecha_devolucion_rep_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_devolucion_rep_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_devolucion_rep_y" id="bksaiacondicion_g@fecha_devolucion_rep_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_devolucion_rep_y" id="fecha_devolucion_rep_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_devolucion_rep_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicitud_prestamo g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_x,g@fecha_y,g@fecha_prestamo_rep_x,g@fecha_prestamo_rep_y,g@fecha_devolucion_rep_x,g@fecha_devolucion_rep_y">