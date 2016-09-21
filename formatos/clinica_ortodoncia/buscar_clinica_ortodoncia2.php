<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../librerias/dependientes.js"></script><legend id="label_formato" class="legend">B&uacute;squeda en formato Historia Clinica</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="datos_paciente"><b>Informaci&oacute;n Del Paciente<input type="hidden" name="bksaiacondicion_datos_paciente" id="bksaiacondicion_datos_paciente" value="like_total"></b></label></div><div class="control-group">
                  <label class="string control-label" for="creacion_historia"><b>fecha creacion</b></label>
                  <input type="hidden" name="bksaiacondicion_g@creacion_historia_x" id="bksaiacondicion_g@creacion_historia_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@creacion_historia_x" id="creacion_historia_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("creacion_historia_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@creacion_historia_y" id="bksaiacondicion_g@creacion_historia_y" value="<=">
                  <input type="text"  name="bqsaia_g@creacion_historia_y" id="creacion_historia_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("creacion_historia_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_creacion_historia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_creacion_historia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_creacion_historia" id="bqsaiaenlace_creacion_historia" value="y" />
		</div></div></div><div class="control-group"><b>Nombre<input type="hidden" name="bksaiacondicion_g@nombre_usuario" id="bksaiacondicion_g@nombre_usuario" value="like_total"></b><div class="controls"><input type="text" id="nombre_usuario" name="bqsaia_g@nombre_usuario"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_usuario',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_usuario',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_usuario" id="bqsaiaenlace_g@nombre_usuario" value="y" />
		</div></div></div><div class="control-group"><b>Apellido<input type="hidden" name="bksaiacondicion_g@apellido_usuario" id="bksaiacondicion_g@apellido_usuario" value="like_total"></b><div class="controls"><input type="text" id="apellido_usuario" name="bqsaia_g@apellido_usuario"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@apellido_usuario',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@apellido_usuario',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@apellido_usuario" id="bqsaiaenlace_g@apellido_usuario" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="cedula_ciudadania"><b>Doc. Identidad<input type="hidden" name="bksaiacondicion_g@cedula_ciudadania" id="bksaiacondicion_g@cedula_ciudadania" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(282,3224,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cedula_ciudadania',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cedula_ciudadania',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cedula_ciudadania" id="bqsaiaenlace_g@cedula_ciudadania" value="y" />
		</div></div></div><div class="control-group"><b>N&uacute;mero<input type="hidden" name="bksaiacondicion_g@numero_doc" id="bksaiacondicion_g@numero_doc" value="="></b><div class="controls"><input type="text" id="numero_doc" name="bqsaia_g@numero_doc"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@numero_doc',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@numero_doc',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@numero_doc" id="bqsaiaenlace_g@numero_doc" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_nacimiento"><b>Fecha De Nacimiento</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_nacimiento_x" id="bksaiacondicion_g@fecha_nacimiento_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_nacimiento_x" id="fecha_nacimiento_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_nacimiento_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_nacimiento_y" id="bksaiacondicion_g@fecha_nacimiento_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_nacimiento_y" id="fecha_nacimiento_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_nacimiento_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_nacimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_nacimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_nacimiento" id="bqsaiaenlace_fecha_nacimiento" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="depto"><b>Departamento<input type="hidden" name="bksaiacondicion_depto" id="bksaiacondicion_depto" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(282,3176,$_REQUEST['iddoc']);?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_depto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_depto',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_depto" id="bqsaiaenlace_depto" value="y" />
		</div></div></div><div class="control-group"><b>Edad<input type="hidden" name="bksaiacondicion_g@edad" id="bksaiacondicion_g@edad" value="="></b><div class="controls"><input type="text" id="edad" name="bqsaia_g@edad"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@edad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@edad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@edad" id="bqsaiaenlace_g@edad" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="sexo"><b>Sexo<input type="hidden" name="bksaiacondicion_g@sexo" id="bksaiacondicion_g@sexo" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(282,3180,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@sexo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@sexo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@sexo" id="bqsaiaenlace_g@sexo" value="y" />
		</div></div></div><div class="control-group"><b>Ocupacion<input type="hidden" name="bksaiacondicion_g@ocupacion" id="bksaiacondicion_g@ocupacion" value="like_total"></b><div class="controls"><input type="text" id="ocupacion" name="bqsaia_g@ocupacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@ocupacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@ocupacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@ocupacion" id="bqsaiaenlace_g@ocupacion" value="y" />
		</div></div></div><div class="control-group"><b>&iquest;Donde?<input type="hidden" name="bksaiacondicion_g@donde_usuario" id="bksaiacondicion_g@donde_usuario" value="like_total"></b><div class="controls"><input type="text" id="donde_usuario" name="bqsaia_g@donde_usuario"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@donde_usuario',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@donde_usuario',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@donde_usuario" id="bqsaiaenlace_g@donde_usuario" value="y" />
		</div></div></div><div class="control-group"><b>Direccion<input type="hidden" name="bksaiacondicion_g@direccion" id="bksaiacondicion_g@direccion" value="like_total"></b><div class="controls"><input type="text" id="direccion" name="bqsaia_g@direccion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@direccion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@direccion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@direccion" id="bqsaiaenlace_g@direccion" value="y" />
		</div></div></div><div class="control-group"><b>Tel&eacute;fonos<input type="hidden" name="bksaiacondicion_g@tel_usuario" id="bksaiacondicion_g@tel_usuario" value="like_total"></b><div class="controls"><input type="text" id="tel_usuario" name="bqsaia_g@tel_usuario"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tel_usuario',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tel_usuario',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tel_usuario" id="bqsaiaenlace_g@tel_usuario" value="y" />
		</div></div></div><div class="control-group"><b>Celular<input type="hidden" name="bksaiacondicion_g@cel" id="bksaiacondicion_g@cel" value="like_total"></b><div class="controls"><input type="text" id="cel" name="bqsaia_g@cel"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cel',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cel',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cel" id="bqsaiaenlace_g@cel" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado_civil"><b>Estado Civil<input type="hidden" name="bksaiacondicion_g@estado_civil" id="bksaiacondicion_g@estado_civil" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(282,3188,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@estado_civil',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@estado_civil',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@estado_civil" id="bqsaiaenlace_g@estado_civil" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="info_conyugue"><b>Informaci&oacute;n Conyugue<input type="hidden" name="bksaiacondicion_info_conyugue" id="bksaiacondicion_info_conyugue" value="like_total"></b></label></div><div class="control-group"><b>Nombre Y Apellidos Del Conyugue<input type="hidden" name="bksaiacondicion_g@nombre_apellidos_conyugue" id="bksaiacondicion_g@nombre_apellidos_conyugue" value="like_total"></b><div class="controls"><input type="text" id="nombre_apellidos_conyugue" name="bqsaia_g@nombre_apellidos_conyugue"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_apellidos_conyugue',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_apellidos_conyugue',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_apellidos_conyugue" id="bqsaiaenlace_g@nombre_apellidos_conyugue" value="y" />
		</div></div></div><div class="control-group"><b>Telefono Conyugue<input type="hidden" name="bksaiacondicion_g@tel_conyugue" id="bksaiacondicion_g@tel_conyugue" value="like_total"></b><div class="controls"><input type="text" id="tel_conyugue" name="bqsaia_g@tel_conyugue"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tel_conyugue',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tel_conyugue',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tel_conyugue" id="bqsaiaenlace_g@tel_conyugue" value="y" />
		</div></div></div><div class="control-group"><b>Composicion Del Nucleo Familiar<input type="hidden" name="bksaiacondicion_g@nucleo_familiar" id="bksaiacondicion_g@nucleo_familiar" value="like_total"></b><div class="controls"><input type="text" id="nucleo_familiar" name="bqsaia_g@nucleo_familiar"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nucleo_familiar',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nucleo_familiar',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nucleo_familiar" id="bqsaiaenlace_g@nucleo_familiar" value="y" />
		</div></div></div><div class="control-group"><b>Grado Escolar<input type="hidden" name="bksaiacondicion_g@grado_escolar" id="bksaiacondicion_g@grado_escolar" value="like_total"></b><div class="controls"><input type="text" id="grado_escolar" name="bqsaia_g@grado_escolar"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@grado_escolar',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@grado_escolar',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@grado_escolar" id="bqsaiaenlace_g@grado_escolar" value="y" />
		</div></div></div><div class="control-group"><b>&iquest;Que Actividades Realiza En Su Tiempo Libre?<input type="hidden" name="bksaiacondicion_g@actividades_tiempo_libre" id="bksaiacondicion_g@actividades_tiempo_libre" value="like_total"></b><div class="controls"><input type="text" id="actividades_tiempo_libre" name="bqsaia_g@actividades_tiempo_libre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@actividades_tiempo_libre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@actividades_tiempo_libre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@actividades_tiempo_libre" id="bqsaiaenlace_g@actividades_tiempo_libre" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="info_madre_etiqueta"><b>Etiqueta Info Madre<input type="hidden" name="bksaiacondicion_info_madre_etiqueta" id="bksaiacondicion_info_madre_etiqueta" value="like_total"></b></label></div><div class="control-group"><b>Nombre Madre<input type="hidden" name="bksaiacondicion_g@nombre_madre" id="bksaiacondicion_g@nombre_madre" value="like_total"></b><div class="controls"><input type="text" id="nombre_madre" name="bqsaia_g@nombre_madre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_madre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_madre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_madre" id="bqsaiaenlace_g@nombre_madre" value="y" />
		</div></div></div><div class="control-group"><b>Tel&eacute;fono Madre<input type="hidden" name="bksaiacondicion_g@tel_madre" id="bksaiacondicion_g@tel_madre" value="like_total"></b><div class="controls"><input type="text" id="tel_madre" name="bqsaia_g@tel_madre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tel_madre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tel_madre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tel_madre" id="bqsaiaenlace_g@tel_madre" value="y" />
		</div></div></div><div class="control-group"><b>Ocupacion Madre<input type="hidden" name="bksaiacondicion_g@ocupacion_madre" id="bksaiacondicion_g@ocupacion_madre" value="like_total"></b><div class="controls"><input type="text" id="ocupacion_madre" name="bqsaia_g@ocupacion_madre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@ocupacion_madre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@ocupacion_madre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@ocupacion_madre" id="bqsaiaenlace_g@ocupacion_madre" value="y" />
		</div></div></div><div class="control-group"><b>&iquest;Donde?<input type="hidden" name="bksaiacondicion_g@donde_madre" id="bksaiacondicion_g@donde_madre" value="like_total"></b><div class="controls"><input type="text" id="donde_madre" name="bqsaia_g@donde_madre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@donde_madre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@donde_madre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@donde_madre" id="bqsaiaenlace_g@donde_madre" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="info_padre_etiqueta"><b>Informaci&oacute;n Padre<input type="hidden" name="bksaiacondicion_info_padre_etiqueta" id="bksaiacondicion_info_padre_etiqueta" value="like_total"></b></label></div><div class="control-group"><b>Nombre Padre<input type="hidden" name="bksaiacondicion_g@nombre_padre" id="bksaiacondicion_g@nombre_padre" value="like_total"></b><div class="controls"><input type="text" id="nombre_padre" name="bqsaia_g@nombre_padre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_padre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_padre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_padre" id="bqsaiaenlace_g@nombre_padre" value="y" />
		</div></div></div><div class="control-group"><b>Tel&eacute;fono Padre<input type="hidden" name="bksaiacondicion_g@tel_padre" id="bksaiacondicion_g@tel_padre" value="like_total"></b><div class="controls"><input type="text" id="tel_padre" name="bqsaia_g@tel_padre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tel_padre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tel_padre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tel_padre" id="bqsaiaenlace_g@tel_padre" value="y" />
		</div></div></div><div class="control-group"><b>Ocupaci&oacute;n Padre<input type="hidden" name="bksaiacondicion_g@ocupacion_padre" id="bksaiacondicion_g@ocupacion_padre" value="like_total"></b><div class="controls"><input type="text" id="ocupacion_padre" name="bqsaia_g@ocupacion_padre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@ocupacion_padre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@ocupacion_padre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@ocupacion_padre" id="bqsaiaenlace_g@ocupacion_padre" value="y" />
		</div></div></div><div class="control-group"><b>&iquest;Donde?<input type="hidden" name="bksaiacondicion_g@donde_padre" id="bksaiacondicion_g@donde_padre" value="like_total"></b><div class="controls"><input type="text" id="donde_padre" name="bqsaia_g@donde_padre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@donde_padre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@donde_padre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@donde_padre" id="bqsaiaenlace_g@donde_padre" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tratamiento_previo"><b>tratamientos_previos<input type="hidden" name="bksaiacondicion_tratamiento_previo" id="bksaiacondicion_tratamiento_previo" value="like_total"></b></label></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tratamientos_previos"><b>&iquest;Ha Tenido Tratamiento Previo De Ortodoncia?<input type="hidden" name="bksaiacondicion_g@tratamientos_previos" id="bksaiacondicion_g@tratamientos_previos" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(282,3203,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tratamientos_previos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tratamientos_previos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tratamientos_previos" id="bqsaiaenlace_g@tratamientos_previos" value="y" />
		</div></div></div><div class="control-group"><b>&iquest;Cuanto Tiempo?<input type="hidden" name="bksaiacondicion_g@cuanto_tiempo" id="bksaiacondicion_g@cuanto_tiempo" value="like_total"></b><div class="controls"><input type="text" id="cuanto_tiempo" name="bqsaia_g@cuanto_tiempo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cuanto_tiempo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cuanto_tiempo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cuanto_tiempo" id="bqsaiaenlace_g@cuanto_tiempo" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="como_se_entero"><b>&iquest;Como Se Enter&oacute; De Nuestro Servicio?<input type="hidden" name="bksaiacondicion_g@como_se_entero" id="bksaiacondicion_g@como_se_entero" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(282,3209,'',1,'buscar');?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_clinica_ortodoncia g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@creacion_historia_x,g@creacion_historia_y,g@fecha_nacimiento_x,g@fecha_nacimiento_y">