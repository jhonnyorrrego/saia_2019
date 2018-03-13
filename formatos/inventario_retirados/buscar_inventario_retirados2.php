<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato INVENTARIO RETIRADOS</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Ubicación<input type="hidden" name="bksaiacondicion_g@ubicacion" id="bksaiacondicion_g@ubicacion" value="like_total"></b><div class="controls"><input type="text" id="ubicacion" name="bqsaia_g@ubicacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@ubicacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@ubicacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@ubicacion" id="bqsaiaenlace_g@ubicacion" value="y" />
		</div></div></div><div class="control-group"><b>No. de caja<input type="hidden" name="bksaiacondicion_g@numero_caja" id="bksaiacondicion_g@numero_caja" value="like_total"></b><div class="controls"><input type="text" id="numero_caja" name="bqsaia_g@numero_caja"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@numero_caja',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@numero_caja',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@numero_caja" id="bqsaiaenlace_g@numero_caja" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_retiro"><b>Fecha de retiro</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_retiro_x" id="bksaiacondicion_g@fecha_retiro_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_retiro_x" id="fecha_retiro_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_retiro_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_retiro_y" id="bksaiacondicion_g@fecha_retiro_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_retiro_y" id="fecha_retiro_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_retiro_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_retiro',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_retiro',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_retiro" id="bqsaiaenlace_fecha_retiro" value="y" />
		</div></div></div><div class="control-group"><b>1er. Apellido<input type="hidden" name="bksaiacondicion_g@primer_apellido" id="bksaiacondicion_g@primer_apellido" value="like_total"></b><div class="controls"><input type="text" id="primer_apellido" name="bqsaia_g@primer_apellido"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@primer_apellido',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@primer_apellido',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@primer_apellido" id="bqsaiaenlace_g@primer_apellido" value="y" />
		</div></div></div><div class="control-group"><b>2do. Apellido<input type="hidden" name="bksaiacondicion_g@segundo_apellido" id="bksaiacondicion_g@segundo_apellido" value="like_total"></b><div class="controls"><input type="text" id="segundo_apellido" name="bqsaia_g@segundo_apellido"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@segundo_apellido',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@segundo_apellido',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@segundo_apellido" id="bqsaiaenlace_g@segundo_apellido" value="y" />
		</div></div></div><div class="control-group"><b>Nombre Completo<input type="hidden" name="bksaiacondicion_g@nombre_completo" id="bksaiacondicion_g@nombre_completo" value="like_total"></b><div class="controls"><input type="text" id="nombre_completo" name="bqsaia_g@nombre_completo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_completo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_completo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_completo" id="bqsaiaenlace_g@nombre_completo" value="y" />
		</div></div></div><div class="control-group"><b>No. de Identificación<input type="hidden" name="bksaiacondicion_g@num_identificacion" id="bksaiacondicion_g@num_identificacion" value="like_total"></b><div class="controls"><input type="text" id="num_identificacion" name="bqsaia_g@num_identificacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@num_identificacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@num_identificacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@num_identificacion" id="bqsaiaenlace_g@num_identificacion" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_extrema_inicia"><b>Fecha Extrema Inicial</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_extrema_inicia_x" id="bksaiacondicion_g@fecha_extrema_inicia_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_extrema_inicia_x" id="fecha_extrema_inicia_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_extrema_inicia_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_extrema_inicia_y" id="bksaiacondicion_g@fecha_extrema_inicia_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_extrema_inicia_y" id="fecha_extrema_inicia_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_extrema_inicia_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_extrema_inicia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_extrema_inicia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_extrema_inicia" id="bqsaiaenlace_fecha_extrema_inicia" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_extrema_final"><b>Fecha Extrema Final</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_extrema_final_x" id="bksaiacondicion_g@fecha_extrema_final_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_extrema_final_x" id="fecha_extrema_final_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_extrema_final_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_extrema_final_y" id="bksaiacondicion_g@fecha_extrema_final_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_extrema_final_y" id="fecha_extrema_final_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_extrema_final_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_extrema_final',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_extrema_final',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_extrema_final" id="bqsaiaenlace_fecha_extrema_final" value="y" />
		</div></div></div><div class="control-group"><b>Folios<input type="hidden" name="bksaiacondicion_g@folios" id="bksaiacondicion_g@folios" value="="></b><div class="controls"><input type="text" id="folios" name="bqsaia_g@folios"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@folios',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@folios',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@folios" id="bqsaiaenlace_g@folios" value="y" />
		</div></div></div><div class="control-group"><b>Último Cargo<input type="hidden" name="bksaiacondicion_g@ultimo_cargo" id="bksaiacondicion_g@ultimo_cargo" value="like_total"></b><div class="controls"><input type="text" id="ultimo_cargo" name="bqsaia_g@ultimo_cargo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@ultimo_cargo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@ultimo_cargo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@ultimo_cargo" id="bqsaiaenlace_g@ultimo_cargo" value="y" />
		</div></div></div><div class="control-group"><b>Estamento<input type="hidden" name="bksaiacondicion_g@estamento" id="bksaiacondicion_g@estamento" value="like_total"></b><div class="controls"><input type="text" id="estamento" name="bqsaia_g@estamento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@estamento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@estamento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@estamento" id="bqsaiaenlace_g@estamento" value="y" />
		</div></div></div><div class="control-group"><b>Jubilado por otra institución<input type="hidden" name="bksaiacondicion_g@jubilado_otra_instit" id="bksaiacondicion_g@jubilado_otra_instit" value="like_total"></b><div class="controls"><input type="text" id="jubilado_otra_instit" name="bqsaia_g@jubilado_otra_instit"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@jubilado_otra_instit',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@jubilado_otra_instit',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@jubilado_otra_instit" id="bqsaiaenlace_g@jubilado_otra_instit" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_inventario_retirados g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_retiro_x,g@fecha_retiro_y,g@fecha_extrema_inicia_x,g@fecha_extrema_inicia_y,g@fecha_extrema_final_x,g@fecha_extrema_final_y">