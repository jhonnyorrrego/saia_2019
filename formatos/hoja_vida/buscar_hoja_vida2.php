<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><script type="text/javascript" src="../librerias/dependientes.js"></script><legend id="label_formato" class="legend">B&uacute;squeda en formato Historia laboral</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Nombre<input type="hidden" name="bksaiacondicion_g@nombre" id="bksaiacondicion_g@nombre" value="like_total"></b><div class="controls"><input type="text" id="nombre" name="bqsaia_g@nombre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre" id="bqsaiaenlace_g@nombre" value="y" />
		</div></div></div><div class="control-group"><b>Apellidos<input type="hidden" name="bksaiacondicion_g@apellidos" id="bksaiacondicion_g@apellidos" value="like_total"></b><div class="controls"><input type="text" id="apellidos" name="bqsaia_g@apellidos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@apellidos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@apellidos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@apellidos" id="bqsaiaenlace_g@apellidos" value="y" />
		</div></div></div><div class="control-group"><b>Documento de identidad<input type="hidden" name="bksaiacondicion_g@documento_identidad" id="bksaiacondicion_g@documento_identidad" value="like_total"></b><div class="controls"><input type="text" id="documento_identidad" name="bqsaia_g@documento_identidad"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@documento_identidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@documento_identidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@documento_identidad" id="bqsaiaenlace_g@documento_identidad" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="lugar_documento"><b>De (Municipio de Expedicion)<input type="hidden" name="bksaiacondicion_lugar_documento" id="bksaiacondicion_lugar_documento" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(219,2343,$_REQUEST['iddoc']);?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_lugar_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_lugar_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_lugar_documento" id="bqsaiaenlace_lugar_documento" value="y" />
		</div></div></div><div class="control-group"><b>Direccion<input type="hidden" name="bksaiacondicion_g@direccion" id="bksaiacondicion_g@direccion" value="like_total"></b><div class="controls"><input type="text" id="direccion" name="bqsaia_g@direccion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@direccion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@direccion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@direccion" id="bqsaiaenlace_g@direccion" value="y" />
		</div></div></div><div class="control-group"><b>Tel&eacute;fonos<input type="hidden" name="bksaiacondicion_g@telefonos" id="bksaiacondicion_g@telefonos" value="="></b><div class="controls"><input type="text" id="telefonos" name="bqsaia_g@telefonos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@telefonos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@telefonos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@telefonos" id="bqsaiaenlace_g@telefonos" value="y" />
		</div></div></div><div class="control-group"><b>Celular<input type="hidden" name="bksaiacondicion_g@celular" id="bksaiacondicion_g@celular" value="like_total"></b><div class="controls"><input type="text" id="celular" name="bqsaia_g@celular"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@celular',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@celular',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@celular" id="bqsaiaenlace_g@celular" value="y" />
		</div></div></div><div class="control-group"><b>E-mail<input type="hidden" name="bksaiacondicion_g@email" id="bksaiacondicion_g@email" value="like_total"></b><div class="controls"><input type="text" id="email" name="bqsaia_g@email"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@email',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@email',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@email" id="bqsaiaenlace_g@email" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="lugar_nacimiento"><b>Lugar de nacimiento<input type="hidden" name="bksaiacondicion_lugar_nacimiento" id="bksaiacondicion_lugar_nacimiento" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(219,2348,$_REQUEST['iddoc']);?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_lugar_nacimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_lugar_nacimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_lugar_nacimiento" id="bqsaiaenlace_lugar_nacimiento" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="fecha_nacimiento"><b>Fecha de nacimiento</b></label>
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
		</div></div></div><div class="control-group"><b>EPS en la que se encuentra afiliado<input type="hidden" name="bksaiacondicion_g@eps" id="bksaiacondicion_g@eps" value="like_total"></b><div class="controls"><input type="text" id="eps" name="bqsaia_g@eps"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@eps',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@eps',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@eps" id="bqsaiaenlace_g@eps" value="y" />
		</div></div></div><div class="control-group"><b>Cuenta de ahorro n&uacute;mero<input type="hidden" name="bksaiacondicion_g@cuenta_ahorro" id="bksaiacondicion_g@cuenta_ahorro" value="like_total"></b><div class="controls"><input type="text" id="cuenta_ahorro" name="bqsaia_g@cuenta_ahorro"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cuenta_ahorro',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cuenta_ahorro',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cuenta_ahorro" id="bqsaiaenlace_g@cuenta_ahorro" value="y" />
		</div></div></div><div class="control-group"><b>Fondo de Pensiones en las que se encuentra afiliado<input type="hidden" name="bksaiacondicion_g@pensiones" id="bksaiacondicion_g@pensiones" value="like_total"></b><div class="controls"><input type="text" id="pensiones" name="bqsaia_g@pensiones"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@pensiones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@pensiones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@pensiones" id="bqsaiaenlace_g@pensiones" value="y" />
		</div></div></div><div class="control-group"><b>Fondo de Cesant&iacute;as en la que se encuentra afiliado<input type="hidden" name="bksaiacondicion_g@cesantias" id="bksaiacondicion_g@cesantias" value="like_total"></b><div class="controls"><input type="text" id="cesantias" name="bqsaia_g@cesantias"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cesantias',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cesantias',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cesantias" id="bqsaiaenlace_g@cesantias" value="y" />
		</div></div></div><div class="control-group"><b>Banco de la cuenta<input type="hidden" name="bksaiacondicion_g@banco" id="bksaiacondicion_g@banco" value="like_total"></b><div class="controls"><input type="text" id="banco" name="bqsaia_g@banco"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@banco',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@banco',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@banco" id="bqsaiaenlace_g@banco" value="y" />
		</div></div></div><div class="control-group"><b>Talla blusa<input type="hidden" name="bksaiacondicion_g@blusa" id="bksaiacondicion_g@blusa" value="like_total"></b><div class="controls"><input type="text" id="blusa" name="bqsaia_g@blusa"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@blusa',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@blusa',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@blusa" id="bqsaiaenlace_g@blusa" value="y" />
		</div></div></div><div class="control-group"><b>Talla pantalon<input type="hidden" name="bksaiacondicion_g@pantalon" id="bksaiacondicion_g@pantalon" value="like_total"></b><div class="controls"><input type="text" id="pantalon" name="bqsaia_g@pantalon"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@pantalon',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@pantalon',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@pantalon" id="bqsaiaenlace_g@pantalon" value="y" />
		</div></div></div><div class="control-group"><b>Calzado<input type="hidden" name="bksaiacondicion_g@calzado" id="bksaiacondicion_g@calzado" value="like_total"></b><div class="controls"><input type="text" id="calzado" name="bqsaia_g@calzado"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_hoja_vida g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_nacimiento_x,g@fecha_nacimiento_y">