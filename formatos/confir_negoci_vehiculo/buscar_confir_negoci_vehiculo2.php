<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Confirmaci&oacute;n negociaci&oacute;n veh&iacute;culo</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_confirmacion"><b>Fecha<input type="hidden" name="bksaiacondicion_g@fecha_confirmacion" id="bksaiacondicion_g@fecha_confirmacion" value="date"></b></label><div class="controls">
                   <input type="text" readonly="true"  name="bqsaia_g@fecha_confirmacion" id="fecha_confirmacion" tipo="fecha" value=""><?php selector_fecha("fecha_confirmacion","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></form><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha_confirmacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha_confirmacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha_confirmacion" id="bqsaiaenlace_g@fecha_confirmacion" value="y" />
		</div></div></div><div class="control-group"><b>Placa Asignada<input type="hidden" name="bksaiacondicion_g@placa_asignada_vehiculo" id="bksaiacondicion_g@placa_asignada_vehiculo" value="like_total"></b><div class="controls"><input type="text" id="placa_asignada_vehiculo" name="bqsaia_g@placa_asignada_vehiculo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@placa_asignada_vehiculo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@placa_asignada_vehiculo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@placa_asignada_vehiculo" id="bqsaiaenlace_g@placa_asignada_vehiculo" value="y" />
		</div></div></div><div class="control-group"><b>Datos del veh&iacute;culo<input type="hidden" name="bksaiacondicion_g@datos_vehiculo" id="bksaiacondicion_g@datos_vehiculo" value="like_total"></b><div class="controls"><input type="text" id="datos_vehiculo" name="bqsaia_g@datos_vehiculo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@datos_vehiculo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@datos_vehiculo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@datos_vehiculo" id="bqsaiaenlace_g@datos_vehiculo" value="y" />
		</div></div></div><div class="control-group"><b>Ver informaci&oacute;n del veh&iacute;culo<input type="hidden" name="bksaiacondicion_g@ver_info_vehiculo" id="bksaiacondicion_g@ver_info_vehiculo" value="like_total"></b><div class="controls"><input type="text" id="ver_info_vehiculo" name="bqsaia_g@ver_info_vehiculo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@ver_info_vehiculo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@ver_info_vehiculo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@ver_info_vehiculo" id="bqsaiaenlace_g@ver_info_vehiculo" value="y" />
		</div></div></div><div class="control-group"><b>Accesorios<input type="hidden" name="bksaiacondicion_g@accesorios_vehiculo" id="bksaiacondicion_g@accesorios_vehiculo" value="like_total"></b><div class="controls"><input type="text" id="accesorios_vehiculo" name="bqsaia_g@accesorios_vehiculo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@accesorios_vehiculo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@accesorios_vehiculo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@accesorios_vehiculo" id="bqsaiaenlace_g@accesorios_vehiculo" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Datos del Cliente</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__5" id="bksaiacondicion_f@nombre__5" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="datos_cliente-nombre" name="g@datos_cliente-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="datos_cliente-identificacion" name="g@datos_cliente-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="datos_cliente-empresa" name="g@datos_cliente-empresa" ></div></div></fieldset><br><div class="control-group"><label class="string control-label" style="font-size:9pt" for="matricula_etiqueta"><b>Etiqueta matr&iacute;cula<input type="hidden" name="bksaiacondicion_matricula_etiqueta" id="bksaiacondicion_matricula_etiqueta" value="like_total"></b></label></div><div class="control-group"><b>Matr&iacute;cula<input type="hidden" name="bksaiacondicion_g@numero_matricula" id="bksaiacondicion_g@numero_matricula" value="like_total"></b><div class="controls"><input type="text" id="numero_matricula" name="bqsaia_g@numero_matricula"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@numero_matricula',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@numero_matricula',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@numero_matricula" id="bqsaiaenlace_g@numero_matricula" value="y" />
		</div></div></div><div class="control-group"><b>Valor matr&iacute;cula<input type="hidden" name="bksaiacondicion_g@valor_matricula" id="bksaiacondicion_g@valor_matricula" value="="></b><div class="controls"><input type="text" id="valor_matricula" name="bqsaia_g@valor_matricula"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@valor_matricula',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@valor_matricula',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@valor_matricula" id="bqsaiaenlace_g@valor_matricula" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="seguros_etiqueta"><b>Etiqueta seguros<input type="hidden" name="bksaiacondicion_seguros_etiqueta" id="bksaiacondicion_seguros_etiqueta" value="like_total"></b></label></div><div class="control-group"><b>Seguros<input type="hidden" name="bksaiacondicion_g@campo_seguros" id="bksaiacondicion_g@campo_seguros" value="like_total"></b><div class="controls"><input type="text" id="campo_seguros" name="bqsaia_g@campo_seguros"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@campo_seguros',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@campo_seguros',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@campo_seguros" id="bqsaiaenlace_g@campo_seguros" value="y" />
		</div></div></div><div class="control-group"><b>Valor seguros<input type="hidden" name="bksaiacondicion_g@valor_seguros" id="bksaiacondicion_g@valor_seguros" value="="></b><div class="controls"><input type="text" id="valor_seguros" name="bqsaia_g@valor_seguros"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@valor_seguros',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@valor_seguros',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@valor_seguros" id="bqsaiaenlace_g@valor_seguros" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones_negocia" id="bksaiacondicion_g@observaciones_negocia" value="like_total"></b><div class="controls"><textarea  maxlength="3999"   id="observaciones_negocia" name="bqsaia_g@observaciones_negocia"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="datos_cliente@ejecutor"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_confir_negoci_vehiculo g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|">