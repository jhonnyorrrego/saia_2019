<?php include_once("../librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato 3. Evaluaci&oacute;n de proveedores</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ft_recepcion_cotizacion"><b>Proveedor<input type="hidden" name="bksaiacondicion_g@ft_recepcion_cotizacion" id="bksaiacondicion_g@ft_recepcion_cotizacion" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(299,3499,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ft_recepcion_cotizacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ft_recepcion_cotizacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ft_recepcion_cotizacion" id="bqsaiaenlace_ft_recepcion_cotizacion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="precio_cotizaciones"><b>Precio de las cotizaciones<input type="hidden" name="bksaiacondicion_g@precio_cotizaciones" id="bksaiacondicion_g@precio_cotizaciones" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(299,3493,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@precio_cotizaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@precio_cotizaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@precio_cotizaciones" id="bqsaiaenlace_g@precio_cotizaciones" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="matriculado_camara"><b>Matriculado<input type="hidden" name="bksaiacondicion_g@matriculado_camara" id="bksaiacondicion_g@matriculado_camara" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(299,3492,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@matriculado_camara',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@matriculado_camara',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@matriculado_camara" id="bqsaiaenlace_g@matriculado_camara" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="atencion"><b>La atenci&oacute;n a la solicitud fue<input type="hidden" name="bksaiacondicion_g@atencion" id="bksaiacondicion_g@atencion" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(299,3489,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@atencion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@atencion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@atencion" id="bqsaiaenlace_g@atencion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="cumplimiento"><b>Cumplimiento con las Especificaciones del producto requerido<input type="hidden" name="bksaiacondicion_g@cumplimiento" id="bksaiacondicion_g@cumplimiento" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(299,3490,'',1,'buscar');?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_evaluacion_proveedores g @ AND  g.documento_iddocumento=iddocumento "></body>