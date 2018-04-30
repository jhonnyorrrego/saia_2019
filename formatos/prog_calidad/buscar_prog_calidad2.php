<?php include_once("../librerias/funciones_generales.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Programas</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="origen_documento"><b>Origen Documento<input type="hidden" name="bksaiacondicion_g@origen_documento" id="bksaiacondicion_g@origen_documento" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(497,6582,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@origen_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@origen_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@origen_documento" id="bqsaiaenlace_g@origen_documento" value="y" />
		</div></div></div><div class="control-group"><b>nombre<input type="hidden" name="bksaiacondicion_g@nombre" id="bksaiacondicion_g@nombre" value="like_total"></b><div class="controls"><input type="text" id="nombre" name="bqsaia_g@nombre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre" id="bqsaiaenlace_g@nombre" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado"><b>estado<input type="hidden" name="bksaiacondicion_g@estado" id="bksaiacondicion_g@estado" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(497,6322,'',1,'buscar');?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_prog_calidad g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body>