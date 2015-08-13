<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion" id="bksaiacondicion_g@descripcion" value="like_total"></b><div class="controls"><textarea  maxlength="255"   id="descripcion" name="bqsaia_g@descripcion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion" id="bqsaiaenlace_g@descripcion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="categoria"><b>Categor&iacute;a<input type="hidden" name="bksaiacondicion_g@categoria" id="bksaiacondicion_g@categoria" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(232,2606,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@categoria',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@categoria',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@categoria" id="bqsaiaenlace_g@categoria" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="prioridad"><b>Prioridad<input type="hidden" name="bksaiacondicion_g@prioridad" id="bksaiacondicion_g@prioridad" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(232,2583,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@prioridad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@prioridad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@prioridad" id="bqsaiaenlace_g@prioridad" value="y" />
		</div></div></div><div class="control-group"><b>Solicitante<input type="hidden" name="bksaiacondicion_g@solicitante" id="bksaiacondicion_g@solicitante" value="like_total"></b><div class="controls"><input type="text" id="solicitante" name="bqsaia_g@solicitante"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@solicitante',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@solicitante',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@solicitante" id="bqsaiaenlace_g@solicitante" value="y" />
		</div></div></div><div class="control-group"><b>Responsable<input type="hidden" name="bksaiacondicion_g@responsable" id="bksaiacondicion_g@responsable" value="like_total"></b><div class="controls"><input type="text" id="responsable" name="bqsaia_g@responsable"></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solicid_matenimiento g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="idbusqueda_componente" value="0">