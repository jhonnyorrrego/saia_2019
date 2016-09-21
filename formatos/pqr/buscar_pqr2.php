<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato PQR</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_pqr"><b>Fecha<input type="hidden" name="bksaiacondicion_fecha_pqr" id="bksaiacondicion_fecha_pqr" value="like_total"></b></label><div class="controls">
                    ENTRE &nbsp;<input type="text" readonly="true" name="fecha_pqr_1" maxlength="255"  id="fecha_pqr_1" value=""><?php selector_fecha("fecha_pqr_1","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_pqr_2" maxlength="255"  id="fecha_pqr_2" value=""><?php selector_fecha("fecha_pqr_2","kformulario_saia","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_pqr',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_pqr',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_pqr" id="bqsaiaenlace_fecha_pqr" value="y" />
		</div></div></div><div class="control-group"><b>Nombres y apellidos<input type="hidden" name="bksaiacondicion_g@nombres_apellidos" id="bksaiacondicion_g@nombres_apellidos" value="like_total"></b><div class="controls"><input type="text" id="nombres_apellidos" name="bqsaia_g@nombres_apellidos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombres_apellidos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombres_apellidos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombres_apellidos" id="bqsaiaenlace_g@nombres_apellidos" value="y" />
		</div></div></div><div class="control-group"><b>CC<input type="hidden" name="bksaiacondicion_g@identificacion" id="bksaiacondicion_g@identificacion" value="="></b><div class="controls"><input type="text" id="identificacion" name="bqsaia_g@identificacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@identificacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@identificacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@identificacion" id="bqsaiaenlace_g@identificacion" value="y" />
		</div></div></div><div class="control-group"><b>Direccion<input type="hidden" name="bksaiacondicion_g@direccion" id="bksaiacondicion_g@direccion" value="like_total"></b><div class="controls"><input type="text" id="direccion" name="bqsaia_g@direccion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@direccion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@direccion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@direccion" id="bqsaiaenlace_g@direccion" value="y" />
		</div></div></div><div class="control-group"><b>Telefono<input type="hidden" name="bksaiacondicion_g@telefono" id="bksaiacondicion_g@telefono" value="="></b><div class="controls"><input type="text" id="telefono" name="bqsaia_g@telefono"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@telefono',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@telefono',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@telefono" id="bqsaiaenlace_g@telefono" value="y" />
		</div></div></div><div class="control-group"><b>Email<input type="hidden" name="bksaiacondicion_g@email" id="bksaiacondicion_g@email" value="like_total"></b><div class="controls"><input type="text" id="email" name="bqsaia_g@email"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@email',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@email',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@email" id="bqsaiaenlace_g@email" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="idflujo"><b>idflujo<input type="hidden" name="bksaiacondicion_g@idflujo" id="bksaiacondicion_g@idflujo" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(210,2228,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idflujo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idflujo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idflujo" id="bqsaiaenlace_idflujo" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="solicitud"><b>Solicitud<input type="hidden" name="bksaiacondicion_g@solicitud" id="bksaiacondicion_g@solicitud" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(210,2220,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_solicitud" id="bqsaiaenlace_solicitud" value="y" />
		</div></div></div><div class="control-group"><b>Otro tipo<input type="hidden" name="bksaiacondicion_g@otro" id="bksaiacondicion_g@otro" value="like_total"></b><div class="controls"><input type="text" id="otro" name="bqsaia_g@otro"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@otro',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@otro',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@otro" id="bqsaiaenlace_g@otro" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo"><b>Tipo solicitud<input type="hidden" name="bksaiacondicion_g@tipo" id="bksaiacondicion_g@tipo" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(210,2237,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo" id="bqsaiaenlace_g@tipo" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="forma_envio"><b>Forma de env&iacute;o<input type="hidden" name="bksaiacondicion_g@forma_envio" id="bksaiacondicion_g@forma_envio" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(210,2236,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@forma_envio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@forma_envio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@forma_envio" id="bqsaiaenlace_g@forma_envio" value="y" />
		</div></div></div><div class="control-group"><b>Describa su solicitud<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea  maxlength="1000"   id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_pqr g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|">