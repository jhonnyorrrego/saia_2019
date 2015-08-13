<?php include_once("../librerias/funciones_generales.php"); ?><div class="container master-container"><legend>B&Uacute;SQUEDA FORMATO DE CALIDAD DE AGUA</legend><div class="control-group"><label class="string control-label" for="asunto">asunto<input type="hidden" name="bksaiacondicion_asunto" id="bksaiacondicion_asunto" value="like"></label><div class="controls"><input type="text" id="bqsaia_asunto" name="bqsaia_asunto"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_asunto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_asunto',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_asunto" id="bqsaiaenlace_asunto" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="mes">Mes<input type="hidden" name="bksaiacondicion_mes" id="bksaiacondicion_mes" value="like"></label><div class="controls"><input type="text" id="bqsaia_mes" name="bqsaia_mes"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_mes',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_mes',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_mes" id="bqsaiaenlace_mes" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="nivel_riesgo">Nivel de riesgo<input type="hidden" name="bksaiacondicion_nivel_riesgo" id="bksaiacondicion_nivel_riesgo" value="like"></label><div class="controls"><input type="text" id="bqsaia_nivel_riesgo" name="bqsaia_nivel_riesgo"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nivel_riesgo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nivel_riesgo',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_nivel_riesgo" id="bqsaiaenlace_nivel_riesgo" value="" />
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
             <?php  } ?><div class="form-actions"> <button type="button" class="btn btn-primary" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" id="ksubmit_saia" titulo="Resultado asunto">Buscar</button>
    <input class="btn btn-danger" name="commit" type="reset" value="Cancelar"></div></body><input type="hidden" name="idbusqueda_componente" value="0">