<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Datos del Cliente</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="fecha_ingreso_cliente"><b>Fecha Ingreso Cliente<input type="hidden" name="bksaiacondicion_g@fecha_ingreso_cliente" id="bksaiacondicion_g@fecha_ingreso_cliente" value="date"></b></label><div class="controls">
                   <input type="text" readonly="true"  name="bqsaia_g@fecha_ingreso_cliente" id="fecha_ingreso_cliente" tipo="fecha" value=""><?php selector_fecha("fecha_ingreso_cliente","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></form><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@fecha_ingreso_cliente',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@fecha_ingreso_cliente',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@fecha_ingreso_cliente" id="bqsaiaenlace_g@fecha_ingreso_cliente" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Datos del Cliente</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__1" id="bksaiacondicion_f@nombre__1" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="datos_cliente-nombre" name="g@datos_cliente-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="datos_cliente-identificacion" name="g@datos_cliente-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="datos_cliente-empresa" name="g@datos_cliente-empresa" ></div></div></fieldset><br><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones_cliente" id="bksaiacondicion_g@observaciones_cliente" value="like_total"></b><div class="controls"><textarea  maxlength="3999"   id="observaciones_cliente" name="bqsaia_g@observaciones_cliente"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="campos_especiales" value="datos_cliente@ejecutor"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_datos_cliente g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|">