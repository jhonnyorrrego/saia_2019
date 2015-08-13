<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><div class="container master-container"><legend>B&Uacute;SQUEDA JUR&Iacute;DICO</legend><div class="control-group"><label class="string control-label" for="aspectos_juridicos">Aspectos Jur&iacute;dicos<input type="hidden" name="bksaiacondicion_aspectos_juridicos" id="bksaiacondicion_aspectos_juridicos" value="like"></label><div class="controls"><input type="text" id="bqsaia_aspectos_juridicos" name="bqsaia_aspectos_juridicos"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_aspectos_juridicos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_aspectos_juridicos',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_aspectos_juridicos" id="bqsaiaenlace_aspectos_juridicos" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="conclusion_juridica">Conclusi&oacute;n Jur&iacute;dica<input type="hidden" name="bksaiacondicion_conclusion_juridica" id="bksaiacondicion_conclusion_juridica" value="like"></label><div class="controls"><input type="text" id="bqsaia_conclusion_juridica" name="bqsaia_conclusion_juridica"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_conclusion_juridica',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_conclusion_juridica',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_conclusion_juridica" id="bqsaiaenlace_conclusion_juridica" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="recomendacion">Recomendaci&oacute;n<input type="hidden" name="bksaiacondicion_recomendacion" id="bksaiacondicion_recomendacion" value="like"></label><div class="controls"><input type="text" id="bqsaia_recomendacion" name="bqsaia_recomendacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_recomendacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_recomendacion',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_recomendacion" id="bqsaiaenlace_recomendacion" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="forma_pago">Forma de pago<input type="hidden" name="bksaiacondicion_forma_pago" id="bksaiacondicion_forma_pago" value="like"></label><div class="controls"><input type="text" id="bqsaia_forma_pago" name="bqsaia_forma_pago"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_forma_pago',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_forma_pago',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_forma_pago" id="bqsaiaenlace_forma_pago" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="plazo">Plazo<input type="hidden" name="bksaiacondicion_plazo" id="bksaiacondicion_plazo" value="like"></label><div class="controls"><input type="text" id="bqsaia_plazo" name="bqsaia_plazo"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_plazo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_plazo',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_plazo" id="bqsaiaenlace_plazo" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="valor">Valor<input type="hidden" name="bksaiacondicion_valor" id="bksaiacondicion_valor" value="like"></label><div class="controls"><input type="text" id="bqsaia_valor" name="bqsaia_valor"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_valor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_valor',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_valor" id="bqsaiaenlace_valor" value="" />
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
             <?php  } ?><div class="form-actions"> <button type="button" class="btn btn-primary" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" id="ksubmit_saia" titulo="Resultado Aspectos Jur&iacute;dicos">Buscar</button>
    <input class="btn btn-danger" name="commit" type="reset" value="Cancelar"></div></body><input type="hidden" name="idbusqueda_componente" value="0">