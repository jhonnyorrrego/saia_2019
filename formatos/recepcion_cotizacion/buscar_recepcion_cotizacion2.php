<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato 2. Recepci&oacute;n de Cotizaci&oacute;n</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_recepcion_cotiza"><b>Fecha de recepci&oacute;n</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_recepcion_cotiza_x" id="bksaiacondicion_g@fecha_recepcion_cotiza_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_recepcion_cotiza_x" id="fecha_recepcion_cotiza_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_recepcion_cotiza_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_recepcion_cotiza_y" id="bksaiacondicion_g@fecha_recepcion_cotiza_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_recepcion_cotiza_y" id="fecha_recepcion_cotiza_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_recepcion_cotiza_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_recepcion_cotiza',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_recepcion_cotiza',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_recepcion_cotiza" id="bqsaiaenlace_fecha_recepcion_cotiza" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Proveedor</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__1" id="bksaiacondicion_f@nombre__1" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="proveedor-nombre" name="g@proveedor-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="proveedor-identificacion" name="g@proveedor-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="proveedor-empresa" name="g@proveedor-empresa" ></div></div></fieldset><br><div class="control-group"><label class="string control-label" style="font-size:9pt" for="regimen"><b>Regimen<input type="hidden" name="bksaiacondicion_g@regimen" id="bksaiacondicion_g@regimen" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(298,3478,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@regimen',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@regimen',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@regimen" id="bqsaiaenlace_g@regimen" value="y" />
		</div></div></div><div class="control-group"><b>VALOR IVA (%)<input type="hidden" name="bksaiacondicion_g@valor_iva" id="bksaiacondicion_g@valor_iva" value="like_total"></b><div class="controls"><input type="text" id="valor_iva" name="bqsaia_g@valor_iva"></div></div><input type="hidden" name="campos_especiales" value="proveedor@ejecutor"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_recepcion_cotizacion g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_recepcion_cotiza_x,g@fecha_recepcion_cotiza_y">