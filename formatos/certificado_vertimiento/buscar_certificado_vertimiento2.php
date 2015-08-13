<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><div class="container master-container"><legend>B&Uacute;SQUEDA CERTIFICADO DE VERTIMIENTOS</legend><div class="control-group"><label class="string control-label" for="nombre">nombre de la empresa<input type="hidden" name="bksaiacondicion_nombre" id="bksaiacondicion_nombre" value="like"></label><div class="controls"><input type="text" id="bqsaia_nombre" name="bqsaia_nombre"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_nombre" id="bqsaiaenlace_nombre" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="actividad">actividad de la empresa<input type="hidden" name="bksaiacondicion_actividad" id="bksaiacondicion_actividad" value="like"></label><div class="controls"><input type="text" id="bqsaia_actividad" name="bqsaia_actividad"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_actividad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_actividad',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_actividad" id="bqsaiaenlace_actividad" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="direccion">Direccion<input type="hidden" name="bksaiacondicion_direccion" id="bksaiacondicion_direccion" value="like"></label><div class="controls"><input type="text" id="bqsaia_direccion" name="bqsaia_direccion"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_direccion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_direccion',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_direccion" id="bqsaiaenlace_direccion" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="codigo_ciiu">Codigo CIIU<input type="hidden" name="bksaiacondicion_codigo_ciiu" id="bksaiacondicion_codigo_ciiu" value="like"></label><div class="controls"><input type="text" id="bqsaia_codigo_ciiu" name="bqsaia_codigo_ciiu"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_codigo_ciiu',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_codigo_ciiu',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_codigo_ciiu" id="bqsaiaenlace_codigo_ciiu" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="descripcion">Descripcion<input type="hidden" name="bksaiacondicion_descripcion" id="bksaiacondicion_descripcion" value="like"></label><div class="controls"><input type="text" id="bqsaia_descripcion" name="bqsaia_descripcion"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_descripcion',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_descripcion" id="bqsaiaenlace_descripcion" value="" />
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
             <?php  } ?><div class="form-actions"> <button type="button" class="btn btn-primary" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" id="ksubmit_saia" titulo="Resultado nombre de la empresa">Buscar</button>
    <input class="btn btn-danger" name="commit" type="reset" value="Cancelar"></div></body><input type="hidden" name="idbusqueda_componente" value="0">