<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend" style="font-size:9pt;">B&uacute;squeda en formato Evolucion de tratamiento</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_evolucion"><b>Fecha<input type="hidden" name="bksaiacondicion_fecha_evolucion" id="bksaiacondicion_fecha_evolucion" value="like_total"></b></label><div class="controls">
                    Entre &nbsp;<input type="text" readonly="true" name="fecha_evolucion_1"  id="fecha_evolucion_1" value=""><?php selector_fecha("fecha_evolucion_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y <input type="text" readonly="true" name="fecha_evolucion_2"  id="fecha_evolucion_2" value=""><?php selector_fecha("fecha_evolucion_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_evolucion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_evolucion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_evolucion" id="bqsaiaenlace_fecha_evolucion" value="y" />
		</div></div></div><div class="control-group"><b>Procedimiento<input type="hidden" name="bksaiacondicion_g@procedimiento_evolucion" id="bksaiacondicion_g@procedimiento_evolucion" value="like_total"></b><div class="controls"><textarea    id="procedimiento_evolucion" name="bqsaia_g@procedimiento_evolucion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@procedimiento_evolucion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@procedimiento_evolucion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@procedimiento_evolucion" id="bqsaiaenlace_g@procedimiento_evolucion" value="y" />
		</div></div></div><div class="control-group"><b>Firma Paciente<input type="hidden" name="bksaiacondicion_g@firma_paciente" id="bksaiacondicion_g@firma_paciente" value="like_total"></b><div class="controls"><input type="text" id="firma_paciente" name="bqsaia_g@firma_paciente"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@firma_paciente',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@firma_paciente',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@firma_paciente" id="bqsaiaenlace_g@firma_paciente" value="y" />
		</div></div></div><div class="control-group"><b>Firma Profesional<input type="hidden" name="bksaiacondicion_g@firma_profesional" id="bksaiacondicion_g@firma_profesional" value="like_total"></b><div class="controls"><input type="text" id="firma_profesional" name="bqsaia_g@firma_profesional"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@firma_profesional',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@firma_profesional',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@firma_profesional" id="bqsaiaenlace_g@firma_profesional" value="y" />
		</div></div></div><div class="control-group"><b>Abono<input type="hidden" name="bksaiacondicion_g@abono_evoluciones" id="bksaiacondicion_g@abono_evoluciones" value="="></b><div class="controls"><input type="text" id="abono_evoluciones" name="bqsaia_g@abono_evoluciones"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_evolucion_tratamiento g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="evolucion_tratamiento"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|"><input type="hidden" name="idbusqueda_componente" value="181">