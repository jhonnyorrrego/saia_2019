<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Devolucion de factura al proveedor</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Observaciones (razones de devolucion)<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@observaciones" id="bqsaiaenlace_g@observaciones" value="y" />
		</div></div></div><div class="control-group"><b>iniciales<input type="hidden" name="bksaiacondicion_g@iniciales" id="bksaiacondicion_g@iniciales" value="="></b><div class="controls"><input type="text" id="iniciales" name="bqsaia_g@iniciales"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@iniciales',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@iniciales',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@iniciales" id="bqsaiaenlace_g@iniciales" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Proveedor</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__2" id="bksaiacondicion_f@nombre__2" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="proveedor-nombre" name="g@proveedor-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="proveedor-identificacion" name="g@proveedor-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="proveedor-empresa" name="g@proveedor-empresa" ></div></div></fieldset><br><div class="control-group"><label class="string control-label" style="font-size:9pt" for="forma_envio"><b>Forma de envio<input type="hidden" name="bksaiacondicion_g@forma_envio" id="bksaiacondicion_g@forma_envio" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(243,2757,'',1,'buscar');?></div></div><input type="hidden" name="campos_especiales" value="proveedor@ejecutor"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_devolucion_factura g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body>