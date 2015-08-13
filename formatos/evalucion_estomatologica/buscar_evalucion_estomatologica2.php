<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend" style="font-size:9pt;">B&uacute;squeda en formato Evaluacion estomatologica</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="proceso_odontologico"><b>&iquest;le Han Realizado Alg&uacute;n Procedimiento Odontol&oacute;gico Anteriormente?<input type="hidden" name="bksaiacondicion_g@proceso_odontologico" id="bksaiacondicion_g@proceso_odontologico" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(284,3254,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@proceso_odontologico',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@proceso_odontologico',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@proceso_odontologico" id="bqsaiaenlace_g@proceso_odontologico" value="y" />
		</div></div></div><div class="control-group"><b>&iquest;cu&aacute;l Procedimiento?<input type="hidden" name="bksaiacondicion_g@cual_procedimiento" id="bksaiacondicion_g@cual_procedimiento" value="like_total"></b><div class="controls"><input type="text" id="cual_procedimiento" name="bqsaia_g@cual_procedimiento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cual_procedimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cual_procedimiento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cual_procedimiento" id="bqsaiaenlace_g@cual_procedimiento" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ultima_visita"><b>Ultima Visita<input type="hidden" name="bksaiacondicion_g@ultima_visita" id="bksaiacondicion_g@ultima_visita" value="date"></b></label><div class="controls">
                   <input type="text" readonly="true"  name="bqsaia_g@ultima_visita" id="ultima_visita" tipo="fecha" value=""><?php selector_fecha("ultima_visita","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></form><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@ultima_visita',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@ultima_visita',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@ultima_visita" id="bqsaiaenlace_g@ultima_visita" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipos_de_limpieza"><b>Tipos De Limpieza<input type="hidden" name="bksaiacondicion_tipos_de_limpieza" id="bksaiacondicion_tipos_de_limpieza" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(284,3261,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipos_de_limpieza',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipos_de_limpieza',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipos_de_limpieza" id="bqsaiaenlace_tipos_de_limpieza" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="labios"><b>Labios<input type="hidden" name="bksaiacondicion_g@labios" id="bksaiacondicion_g@labios" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(284,3262,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@labios',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@labios',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@labios" id="bqsaiaenlace_g@labios" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="lengua"><b>Lengua<input type="hidden" name="bksaiacondicion_g@lengua" id="bksaiacondicion_g@lengua" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(284,3263,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@lengua',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@lengua',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@lengua" id="bqsaiaenlace_g@lengua" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="paladar"><b>Paladar<input type="hidden" name="bksaiacondicion_g@paladar" id="bksaiacondicion_g@paladar" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(284,3264,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@paladar',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@paladar',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@paladar" id="bqsaiaenlace_g@paladar" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="carrillos"><b>Carrillos<input type="hidden" name="bksaiacondicion_g@carrillos" id="bksaiacondicion_g@carrillos" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(284,3265,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@carrillos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@carrillos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@carrillos" id="bqsaiaenlace_g@carrillos" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="piso_de_boca"><b>Piso De Boca<input type="hidden" name="bksaiacondicion_g@piso_de_boca" id="bksaiacondicion_g@piso_de_boca" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(284,3266,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@piso_de_boca',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@piso_de_boca',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@piso_de_boca" id="bqsaiaenlace_g@piso_de_boca" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="frenillos"><b>Frenillos<input type="hidden" name="bksaiacondicion_g@frenillos" id="bksaiacondicion_g@frenillos" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(284,3267,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@frenillos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@frenillos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@frenillos" id="bqsaiaenlace_g@frenillos" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="maxilares"><b>Maxilares<input type="hidden" name="bksaiacondicion_g@maxilares" id="bksaiacondicion_g@maxilares" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(284,3268,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@maxilares',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@maxilares',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@maxilares" id="bqsaiaenlace_g@maxilares" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="funcion_oclusion"><b>Funcion Oclusion<input type="hidden" name="bksaiacondicion_g@funcion_oclusion" id="bksaiacondicion_g@funcion_oclusion" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(284,3269,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@funcion_oclusion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@funcion_oclusion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@funcion_oclusion" id="bqsaiaenlace_g@funcion_oclusion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="atm"><b>Atm<input type="hidden" name="bksaiacondicion_g@atm" id="bksaiacondicion_g@atm" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(284,3270,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@atm',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@atm',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@atm" id="bqsaiaenlace_g@atm" value="y" />
		</div></div></div><div class="control-group"><b>Apertura Maxima<input type="hidden" name="bksaiacondicion_g@apertura_maxima" id="bksaiacondicion_g@apertura_maxima" value="="></b><div class="controls"><input type="text" id="apertura_maxima" name="bqsaia_g@apertura_maxima"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@apertura_maxima',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@apertura_maxima',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@apertura_maxima" id="bqsaiaenlace_g@apertura_maxima" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones Tejido Blando<input type="hidden" name="bksaiacondicion_g@observaciones_tejidob" id="bksaiacondicion_g@observaciones_tejidob" value="like_total"></b><div class="controls"><textarea    id="observaciones_tejidob" name="bqsaia_g@observaciones_tejidob"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_evalucion_estomatologica g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|"><input type="hidden" name="idbusqueda_componente" value="172">