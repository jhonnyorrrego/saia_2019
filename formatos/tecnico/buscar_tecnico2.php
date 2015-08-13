<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><div class="container master-container"><legend>B&Uacute;SQUEDA TECNICO</legend><div class="control-group"><label class="string control-label" for="aspectos_tecnicos">Aspectos tecnicos<input type="hidden" name="bksaiacondicion_aspectos_tecnicos" id="bksaiacondicion_aspectos_tecnicos" value="like"></label><div class="controls"><input type="text" id="bqsaia_aspectos_tecnicos" name="bqsaia_aspectos_tecnicos"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_aspectos_tecnicos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_aspectos_tecnicos',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_aspectos_tecnicos" id="bqsaiaenlace_aspectos_tecnicos" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="conclusion_tecnica">Conclusion tecnica<input type="hidden" name="bksaiacondicion_conclusion_tecnica" id="bksaiacondicion_conclusion_tecnica" value="like"></label><div class="controls"><input type="text" id="bqsaia_conclusion_tecnica" name="bqsaia_conclusion_tecnica"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_conclusion_tecnica',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_conclusion_tecnica',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_conclusion_tecnica" id="bqsaiaenlace_conclusion_tecnica" value="" />
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
             <?php  } ?><div class="form-actions"> <button type="button" class="btn btn-primary" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" id="ksubmit_saia" titulo="Resultado Aspectos tecnicos">Buscar</button>
    <input class="btn btn-danger" name="commit" type="reset" value="Cancelar"></div></body><input type="hidden" name="idbusqueda_componente" value="0">