<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato 3. Monitoreo y Revision</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ayuda"><b>Ayuda<input type="hidden" name="bksaiacondicion_ayuda" id="bksaiacondicion_ayuda" value="="></b></label></div><div class="control-group">
                  <label class="string control-label" for="fecha_monitoreo"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_monitoreo_x" id="bksaiacondicion_g@fecha_monitoreo_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_monitoreo_x" id="fecha_monitoreo_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_monitoreo_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_monitoreo_y" id="bksaiacondicion_g@fecha_monitoreo_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_monitoreo_y" id="fecha_monitoreo_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_monitoreo_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_monitoreo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_monitoreo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_monitoreo" id="bqsaiaenlace_fecha_monitoreo" value="y" />
		</div></div></div><div class="control-group"><b>Riesgo Nro<input type="hidden" name="bksaiacondicion_g@numero_riesgo" id="bksaiacondicion_g@numero_riesgo" value="="></b><div class="controls"><input type="text" id="numero_riesgo" name="bqsaia_g@numero_riesgo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@numero_riesgo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@numero_riesgo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@numero_riesgo" id="bqsaiaenlace_g@numero_riesgo" value="y" />
		</div></div></div><div class="control-group"><b>Nombre del riesgo<input type="hidden" name="bksaiacondicion_g@nombre_riesgo" id="bksaiacondicion_g@nombre_riesgo" value="like_total"></b><div class="controls"><input type="text" id="nombre_riesgo" name="bqsaia_g@nombre_riesgo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_riesgo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_riesgo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_riesgo" id="bqsaiaenlace_g@nombre_riesgo" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="cambio_identificacion"><b>Se realizaron cambios en la identificacion del riesgo?<input type="hidden" name="bksaiacondicion_g@cambio_identificacion" id="bksaiacondicion_g@cambio_identificacion" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(396,4745,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cambio_identificacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cambio_identificacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cambio_identificacion" id="bqsaiaenlace_g@cambio_identificacion" value="y" />
		</div></div></div><div class="control-group"><b>Descripcion de los cambios<input type="hidden" name="bksaiacondicion_g@descripcion_cambio" id="bksaiacondicion_g@descripcion_cambio" value="like_total"></b><div class="controls"><textarea  maxlength="6000"   id="descripcion_cambio" name="bqsaia_g@descripcion_cambio"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_cambio',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_cambio',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_cambio" id="bqsaiaenlace_g@descripcion_cambio" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="cambios_analisis"><b>Se realizaron cambios en el an&aacute;lisis del riesgo?<input type="hidden" name="bksaiacondicion_g@cambios_analisis" id="bksaiacondicion_g@cambios_analisis" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(396,4747,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@cambios_analisis',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@cambios_analisis',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@cambios_analisis" id="bqsaiaenlace_g@cambios_analisis" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n de los cambios<input type="hidden" name="bksaiacondicion_g@descripcion_analisis" id="bksaiacondicion_g@descripcion_analisis" value="like_total"></b><div class="controls"><textarea  maxlength="6000"   id="descripcion_analisis" name="bqsaia_g@descripcion_analisis"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_analisis',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_analisis',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_analisis" id="bqsaiaenlace_g@descripcion_analisis" value="y" />
		</div></div></div><div class="control-group"><b>Se evaluaron los controles existentes?<input type="hidden" name="bksaiacondicion_g@controles_existentes" id="bksaiacondicion_g@controles_existentes" value="like_total"></b><div class="controls"><input type="text" id="controles_existentes" name="bqsaia_g@controles_existentes"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@controles_existentes',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@controles_existentes',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@controles_existentes" id="bqsaiaenlace_g@controles_existentes" value="y" />
		</div></div></div><div class="control-group"><b>Resultados de la evaluaci&oacute;n<input type="hidden" name="bksaiacondicion_g@resultado_evaluacion" id="bksaiacondicion_g@resultado_evaluacion" value="like_total"></b><div class="controls"><textarea  maxlength="6000"   id="resultado_evaluacion" name="bqsaia_g@resultado_evaluacion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@resultado_evaluacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@resultado_evaluacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@resultado_evaluacion" id="bqsaiaenlace_g@resultado_evaluacion" value="y" />
		</div></div></div><div class="control-group"><b>Se cumplieron las acciones propuestas?<input type="hidden" name="bksaiacondicion_g@acciones_propuestas" id="bksaiacondicion_g@acciones_propuestas" value="like_total"></b><div class="controls"><input type="text" id="acciones_propuestas" name="bqsaia_g@acciones_propuestas"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@acciones_propuestas',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@acciones_propuestas',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@acciones_propuestas" id="bqsaiaenlace_g@acciones_propuestas" value="y" />
		</div></div></div><div class="control-group"><b>Logros alcanzados y/o observaciones<input type="hidden" name="bksaiacondicion_g@logros_alcanzados" id="bksaiacondicion_g@logros_alcanzados" value="like_total"></b><div class="controls"><textarea  maxlength="6000"   id="logros_alcanzados" name="bqsaia_g@logros_alcanzados"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@logros_alcanzados',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@logros_alcanzados',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@logros_alcanzados" id="bqsaiaenlace_g@logros_alcanzados" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="controles_nuevos"><b>Se implementaron nuevos controles?<input type="hidden" name="bksaiacondicion_g@controles_nuevos" id="bksaiacondicion_g@controles_nuevos" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(396,4753,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@controles_nuevos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@controles_nuevos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@controles_nuevos" id="bqsaiaenlace_g@controles_nuevos" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n del nuevo(s) control(es)<input type="hidden" name="bksaiacondicion_g@descripcion_ncontrol" id="bksaiacondicion_g@descripcion_ncontrol" value="like_total"></b><div class="controls"><textarea  maxlength="6000"   id="descripcion_ncontrol" name="bqsaia_g@descripcion_ncontrol"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_ncontrol',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_ncontrol',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_ncontrol" id="bqsaiaenlace_g@descripcion_ncontrol" value="y" />
		</div></div></div><div class="control-group"><b>Observaciones generales<input type="hidden" name="bksaiacondicion_g@observaciones_generales" id="bksaiacondicion_g@observaciones_generales" value="like_total"></b><div class="controls"><textarea  maxlength="6000"   id="observaciones_generales" name="bqsaia_g@observaciones_generales"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_monitoreo_revision g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_monitoreo_x,g@fecha_monitoreo_y">