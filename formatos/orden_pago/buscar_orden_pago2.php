<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Orden de pago</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Adicionales<input type="hidden" name="bksaiacondicion_g@adicionales_orden" id="bksaiacondicion_g@adicionales_orden" value="="></b><div class="controls"><input type="text" id="adicionales_orden" name="bqsaia_g@adicionales_orden"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@adicionales_orden',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@adicionales_orden',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@adicionales_orden" id="bqsaiaenlace_g@adicionales_orden" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="centro_costos"><b>Cc-Ot-pedidos<input type="hidden" name="bksaiacondicion_g@centro_costos" id="bksaiacondicion_g@centro_costos" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(238,2673,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_centro_costos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_centro_costos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_centro_costos" id="bqsaiaenlace_centro_costos" value="y" />
		</div></div></div><div class="control-group"><b>Descrpci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea    id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion" id="bqsaiaenlace_g@descripcion" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Paguese a</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__3" id="bksaiacondicion_f@nombre__3" value="like_total"></b><div class="controls"><input type="text"  maxlength="255"   id="page_a-nombre" name="g@page_a-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="255"   id="page_a-identificacion" name="g@page_a-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="255"   id="page_a-empresa" name="g@page_a-empresa" ></div></div></fieldset><br><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@observaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@observaciones" id="bqsaiaenlace_g@observaciones" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones de rete iva<input type="hidden" name="bksaiacondicion_g@observaciones_iva" id="bksaiacondicion_g@observaciones_iva" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="observaciones_iva" name="bqsaia_g@observaciones_iva"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@observaciones_iva',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@observaciones_iva',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@observaciones_iva" id="bqsaiaenlace_g@observaciones_iva" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="urgencia_pago"><b>Urgencia del pago<input type="hidden" name="bksaiacondicion_g@urgencia_pago" id="bksaiacondicion_g@urgencia_pago" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(238,2679,'',1,'buscar');?></div></div><input type="hidden" name="campos_especiales" value="page_a@ejecutor"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_orden_pago g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body>