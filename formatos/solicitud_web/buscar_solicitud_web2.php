<?php include_once("../librerias/funciones_generales.php"); ?><div class="container master-container"><legend>B&Uacute;SQUEDA SOLICITUD WEB</legend><div class="control-group"><label class="string control-label" for="tipo_solicitud">Tipo de Solicitud<input type="hidden" name="bksaiacondicion_tipo_solicitud" id="bksaiacondicion_tipo_solicitud" value="="></label><div class="controls"><?php genera_campo_listados_editar(78,954,'',1);?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_solicitud',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_tipo_solicitud" id="bqsaiaenlace_tipo_solicitud" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="nombre_persona">Nombre<input type="hidden" name="bksaiacondicion_nombre_persona" id="bksaiacondicion_nombre_persona" value="like"></label><div class="controls"><input type="text" id="bqsaia_nombre_persona" name="bqsaia_nombre_persona"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre_persona',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre_persona',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_nombre_persona" id="bqsaiaenlace_nombre_persona" value="" />
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
             <?php  } ?><div class="form-actions"> <button type="button" class="btn btn-primary" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" id="ksubmit_saia" titulo="Resultado Tipo de Solicitud">Buscar</button>
    <input class="btn btn-danger" name="commit" type="reset" value="Cancelar"></div></body><input type="hidden" name="idbusqueda_componente" value="0">