<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>nombre<input type="hidden" name="bksaiacondicion_g@nombre" id="bksaiacondicion_g@nombre" value="like_total"></b><div class="controls"><input type="text" id="nombre" name="bqsaia_g@nombre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre" id="bqsaiaenlace_g@nombre" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="cod_padre"><b>Padre del esquema actual<input type="hidden" name="bksaiacondicion_g@cod_padre" id="bksaiacondicion_g@cod_padre" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(225,2460,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_cod_padre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_cod_padre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_cod_padre" id="bqsaiaenlace_cod_padre" value="y" />
		</div></div></div><div class="control-group"><b>Caracter&iacute;sticas<input type="hidden" name="bksaiacondicion_g@caracteristicas" id="bksaiacondicion_g@caracteristicas" value="like_total"></b><div class="controls"><textarea    id="caracteristicas" name="bqsaia_g@caracteristicas"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@caracteristicas',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@caracteristicas',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@caracteristicas" id="bqsaiaenlace_g@caracteristicas" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="obligatoriedad"><b>Obligatoriedad<input type="hidden" name="bksaiacondicion_g@obligatoriedad" id="bksaiacondicion_g@obligatoriedad" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(225,2461,'',1,'buscar');?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_estructura_hoja_vida g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="idbusqueda_componente" value="0">