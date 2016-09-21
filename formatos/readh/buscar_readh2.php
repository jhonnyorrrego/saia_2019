<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../librerias/dependientes.js"></script><legend id="label_formato" class="legend">B&uacute;squeda en formato Registro especial de archivo (READH)</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_entidad"><b>Tipo de entidad<input type="hidden" name="bksaiacondicion_g@tipo_entidad" id="bksaiacondicion_g@tipo_entidad" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(317,3715,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo_entidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo_entidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo_entidad" id="bqsaiaenlace_g@tipo_entidad" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="enfoque_diferencial"><b>Enfoque diferencial<input type="hidden" name="bksaiacondicion_g@enfoque_diferencial" id="bksaiacondicion_g@enfoque_diferencial" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(317,3716,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@enfoque_diferencial',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@enfoque_diferencial',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@enfoque_diferencial" id="bqsaiaenlace_g@enfoque_diferencial" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="ubicacion_geografica"><b>Ubicaci&oacute;n geogr&aacute;fica<input type="hidden" name="bksaiacondicion_ubicacion_geografica" id="bksaiacondicion_ubicacion_geografica" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(317,3717,$_REQUEST['iddoc']);?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ubicacion_geografica',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ubicacion_geografica',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ubicacion_geografica" id="bqsaiaenlace_ubicacion_geografica" value="y" />
		</div></div></div>
                <fieldset>
                <legend style="font-size:10pt;line-height:15px"><b>Nombre de la entidad</b></legend>
                <div class="control-group;" style="background-color:#F5F5F5">
                <b>Nombre<input type="hidden" name="bksaiacondicion_f@nombre__3" id="bksaiacondicion_f@nombre__3" value="="></b><div class="controls"><input type="text"  maxlength="11"   id="nombre_entidad-nombre" name="g@nombre_entidad-nombre" ></div><b>Identificacion</b><div class="controls"><input type="text"  maxlength="11"   id="nombre_entidad-identificacion" name="g@nombre_entidad-identificacion" ></div><b>Empresa</b><div class="controls"><input type="text"  maxlength="11"   id="nombre_entidad-empresa" name="g@nombre_entidad-empresa" ></div></div></fieldset><br><div class="control-group"><b>Nombre paralelo<input type="hidden" name="bksaiacondicion_g@nombre_paralelo" id="bksaiacondicion_g@nombre_paralelo" value="like_total"></b><div class="controls"><input type="text" id="nombre_paralelo" name="bqsaia_g@nombre_paralelo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre_paralelo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre_paralelo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre_paralelo" id="bqsaiaenlace_g@nombre_paralelo" value="y" />
		</div></div></div><div class="control-group"><b>Descripci&oacute;n<input type="hidden" name="bksaiacondicion_g@descripcion_readh" id="bksaiacondicion_g@descripcion_readh" value="like_total"></b><div class="controls"><textarea    id="descripcion_readh" name="bqsaia_g@descripcion_readh"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@descripcion_readh',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@descripcion_readh',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@descripcion_readh" id="bqsaiaenlace_g@descripcion_readh" value="y" />
		</div></div></div><div class="control-group"><b>Contexto geogr&aacute;fico y cultural<input type="hidden" name="bksaiacondicion_g@contexto_geografico" id="bksaiacondicion_g@contexto_geografico" value="like_total"></b><div class="controls"><textarea    id="contexto_geografico" name="bqsaia_g@contexto_geografico"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@contexto_geografico',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@contexto_geografico',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@contexto_geografico" id="bqsaiaenlace_g@contexto_geografico" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="registro_funciones"><b>Registro de funciones<input type="hidden" name="bksaiacondicion_g@registro_funciones" id="bksaiacondicion_g@registro_funciones" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(317,3722,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@registro_funciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@registro_funciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@registro_funciones" id="bqsaiaenlace_g@registro_funciones" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado_registro"><b>Estado del registro<input type="hidden" name="bksaiacondicion_g@estado_registro" id="bksaiacondicion_g@estado_registro" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(317,3723,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@estado_registro',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@estado_registro',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@estado_registro" id="bqsaiaenlace_g@estado_registro" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="palabras_clave"><b>Palabras clave<input type="hidden" name="bksaiacondicion_g@palabras_clave" id="bksaiacondicion_g@palabras_clave" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(317,3724,'',1,'buscar');?></div></div><input type="hidden" name="campos_especiales" value="nombre_entidad@ejecutor"><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_readh g @ AND  g.documento_iddocumento=iddocumento "></body>