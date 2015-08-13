<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><div class="container master-container"><legend>B&Uacute;SQUEDA RESPUESTA A QUEJA POR CALIDAD DEL AGUA</legend><div class="control-group"><label class="string control-label" for="asunto">asunto<input type="hidden" name="bksaiacondicion_asunto" id="bksaiacondicion_asunto" value="like"></label><div class="controls"><input type="text" id="bqsaia_asunto" name="bqsaia_asunto"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_asunto',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_asunto',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_asunto" id="bqsaiaenlace_asunto" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="consecutivo">consecutivo<input type="hidden" name="bksaiacondicion_consecutivo" id="bksaiacondicion_consecutivo" value="like"></label><div class="controls"><input type="text" id="bqsaia_consecutivo" name="bqsaia_consecutivo"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_consecutivo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_consecutivo',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_consecutivo" id="bqsaiaenlace_consecutivo" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="fecha_respuesta_calidad_aguas">fecha<input type="hidden" name="bksaiacondicion_fecha_respuesta_calidad_aguas" id="bksaiacondicion_fecha_respuesta_calidad_aguas" value="like"></label><div class="controls"><input type="text" id="bqsaia_fecha_respuesta_calidad_aguas" name="bqsaia_fecha_respuesta_calidad_aguas"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_respuesta_calidad_aguas',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_respuesta_calidad_aguas',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_fecha_respuesta_calidad_aguas" id="bqsaiaenlace_fecha_respuesta_calidad_aguas" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="lugar_muestra">lugar de toma de la muestra<input type="hidden" name="bksaiacondicion_lugar_muestra" id="bksaiacondicion_lugar_muestra" value="like"></label><div class="controls"><input type="text" id="bqsaia_lugar_muestra" name="bqsaia_lugar_muestra"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_lugar_muestra',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_lugar_muestra',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_lugar_muestra" id="bqsaiaenlace_lugar_muestra" value="" />
		</div></div></div><div class="control-group"><label class="string control-label" for="queja">queja<input type="hidden" name="bksaiacondicion_queja" id="bksaiacondicion_queja" value="like"></label><div class="controls"><input type="text" id="bqsaia_queja" name="bqsaia_queja"><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_queja',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_queja',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_queja" id="bqsaiaenlace_queja" value="" />
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