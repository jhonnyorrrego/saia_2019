<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="nombre"><b>Nombre<input type="hidden" name="bksaiacondicion_nombre" id="bksaiacondicion_nombre" value="like"></b></label><div class="controls"><input type="text" id="bqsaia_nombre" name="bqsaia_nombre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre" id="bqsaiaenlace_nombre" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="codigo"><b>C&oacute;digo<input type="hidden" name="bksaiacondicion_codigo" id="bksaiacondicion_codigo" value="like"></b></label><div class="controls"><input type="text" id="bqsaia_codigo" name="bqsaia_codigo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_codigo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_codigo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_codigo" id="bqsaiaenlace_codigo" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="version"><b>Versi&oacute;n<input type="hidden" name="bksaiacondicion_version" id="bksaiacondicion_version" value="="></b></label><div class="controls"><input type="text" id="bqsaia_version" name="bqsaia_version"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_version',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_version',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_version" id="bqsaiaenlace_version" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="descripcion"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_descripcion" id="bksaiacondicion_descripcion" value="like"></b></label><div class="controls"><textarea    id="descripcion" name="bqsaia_descripcion"  ></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_descripcion" id="bqsaiaenlace_descripcion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado"><b>Estado<input type="hidden" name="bksaiacondicion_Y@estado" id="bksaiacondicion_Y@estado" value="like"></b></label><div class="controls"><?php genera_campo_listados_editar(196,2036,'',1,'buscar');?></div></div><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="idbusqueda_componente" value="0">