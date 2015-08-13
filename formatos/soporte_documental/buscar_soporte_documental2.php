<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Soportes documentales</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="soportes_documental"><b>Soportes documentales<input type="hidden" name="bksaiacondicion_soportes_documental" id="bksaiacondicion_soportes_documental" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(323,3774,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_soportes_documental',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_soportes_documental',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_soportes_documental" id="bqsaiaenlace_soportes_documental" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_soporte"><b>Tipo de soporte<input type="hidden" name="bksaiacondicion_g@tipo_soporte" id="bksaiacondicion_g@tipo_soporte" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(323,3775,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_soporte',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_soporte',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_soporte" id="bqsaiaenlace_g@tipo_soporte" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones<input type="hidden" name="bksaiacondicion_g@observaciones" id="bksaiacondicion_g@observaciones" value="like_total"></b><div class="controls"><textarea    id="observaciones" name="bqsaia_g@observaciones"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_soporte_documental g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="soporte_documental"></body><input type="hidden" name="idbusqueda_componente" value="">