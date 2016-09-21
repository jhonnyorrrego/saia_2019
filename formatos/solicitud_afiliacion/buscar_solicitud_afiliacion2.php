<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Solicitud de Afiliaci&oacute;n</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_solicitud"><b>Fecha de Solicitud</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_solicitud_x" id="bksaiacondicion_g@fecha_solicitud_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_solicitud_x" id="fecha_solicitud_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_solicitud_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_solicitud_y" id="bksaiacondicion_g@fecha_solicitud_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_solicitud_y" id="fecha_solicitud_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_solicitud_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_solicitud" id="bqsaiaenlace_fecha_solicitud" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Datos del Solicitante de Afiliaci&oacute;n</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__1" id="bksaiacondicion_f@nombre__1" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="datos_solicitante-nombre" name="g@datos_solicitante-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="datos_solicitante-identificacion" name="g@datos_solicitante-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="datos_solicitante-empresa" name="g@datos_solicitante-empresa" ></div></div></fieldset><br><div class="control-group"><b>N&uacute;mero de Folios<input type="hidden" name="bksaiacondicion_g@numero_folios_afilia" id="bksaiacondicion_g@numero_folios_afilia" value="="></b><div class="controls"><input type="text" id="numero_folios_afilia" name="bqsaia_g@numero_folios_afilia"></div></div><input type="hidden" name="campos_especiales" value="datos_solicitante@ejecutor"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicitud_afiliacion g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_solicitud_x,g@fecha_solicitud_y">