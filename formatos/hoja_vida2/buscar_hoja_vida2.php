<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><div class="container master-container"><legend>B&Uacute;SQUEDA HOJA DE VIDA</legend><div class="control-group"><label class="string control-label" for="foto">Foto<input type="hidden" name="bksaiacondicion_foto" id="bksaiacondicion_foto" value="="></label><div class="controls"><input type="text" id="bqsaia_foto" name="bqsaia_foto"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_foto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_foto',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_foto" id="bqsaiaenlace_foto" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="documento_identidad">Documento Identidad<input type="hidden" name="bksaiacondicion_documento_identidad" id="bksaiacondicion_documento_identidad" value="like"></label><div class="controls"><input type="text" id="bqsaia_documento_identidad" name="bqsaia_documento_identidad"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_documento_identidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_documento_identidad',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_documento_identidad" id="bqsaiaenlace_documento_identidad" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="nombres">nombres<input type="hidden" name="bksaiacondicion_nombres" id="bksaiacondicion_nombres" value="like"></label><div class="controls"><input type="text" id="bqsaia_nombres" name="bqsaia_nombres"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombres',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombres',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_nombres" id="bqsaiaenlace_nombres" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="apellidos">Apellidos<input type="hidden" name="bksaiacondicion_apellidos" id="bksaiacondicion_apellidos" value="like"></label><div class="controls"><input type="text" id="bqsaia_apellidos" name="bqsaia_apellidos"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_apellidos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_apellidos',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_apellidos" id="bqsaiaenlace_apellidos" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="fecha_nacimiento">Fecha Nacimiento<input type="hidden" name="bksaiacondicion_fecha_nacimiento" id="bksaiacondicion_fecha_nacimiento" value="like"></label><div class="controls">
                       ENTRE &nbsp;<input type="text" readonly="true"  name="fecha_nacimiento_1" id="fecha_nacimiento_1" tipo="fecha" value=""><?php selector_fecha("fecha_nacimiento_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_nacimiento_2" id="fecha_nacimiento_2" tipo="fecha" value=""><?php selector_fecha("fecha_nacimiento_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_nacimiento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_nacimiento',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_fecha_nacimiento" id="bqsaiaenlace_fecha_nacimiento" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="tipo_sanguineo">Tipo Sanguineo<input type="hidden" name="bksaiacondicion_tipo_sanguineo" id="bksaiacondicion_tipo_sanguineo" value="like"></label><div class="controls"><?php genera_campo_listados_editar(71,854,'',1);?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_sanguineo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_sanguineo',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_tipo_sanguineo" id="bqsaiaenlace_tipo_sanguineo" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="direccion_residencia">Direcci&oacute;n Residencia<input type="hidden" name="bksaiacondicion_direccion_residencia" id="bksaiacondicion_direccion_residencia" value="like"></label><div class="controls"><input type="text" id="bqsaia_direccion_residencia" name="bqsaia_direccion_residencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_direccion_residencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_direccion_residencia',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_direccion_residencia" id="bqsaiaenlace_direccion_residencia" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="telefono">telefono<input type="hidden" name="bksaiacondicion_telefono" id="bksaiacondicion_telefono" value="="></label><div class="controls"><input type="text" id="bqsaia_telefono" name="bqsaia_telefono"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_telefono',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_telefono',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_telefono" id="bqsaiaenlace_telefono" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="celular">Celular<input type="hidden" name="bksaiacondicion_celular" id="bksaiacondicion_celular" value="like"></label><div class="controls"><input type="text" id="bqsaia_celular" name="bqsaia_celular"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_celular',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_celular',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_celular" id="bqsaiaenlace_celular" value="" />
		</div></div></div><input type="hidden" name="adicionar_consulta" value="1">
     <?php if(@$_REQUEST["campo__retorno"]){ ?>
                <input type="hidden" name="campo__retorno" value="<?php echo($_REQUEST["campo__retorno"]); ?>">
              <?php }
               if(@$_REQUEST["formulario__retorno"]){ ?>
                <input type="hidden" name="formulario__retorno" value="<?php echo($_REQUEST["formulario__retorno"]); ?>">
              <?php }
                if(@$_REQUEST["pagina__retorno"]){ ?>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_REQUEST["pagina__retorno"]); ?>">
             <?php  }
              else{ ?>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_SERVER["PHP_SELF"]); ?>">
             <?php  } ?><div class="form-actions"> <button type="button" class="btn btn-primary" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" id="ksubmit_saia" titulo="Resultado Foto">Buscar</button>
    <input class="btn btn-danger" name="commit" type="reset" value="Cancelar"></div></body><input type="hidden" name="idbusqueda_componente" value="61">