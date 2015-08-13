<?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/><div class="container master-container"><legend>B&Uacute;SQUEDA EMPRESAS INVITADAS</legend><div class="control-group"><label class="string control-label" for="empresa_proveedor">Empresa y/o proveedor<input type="hidden" name="bksaiacondicion_empresa_proveedor" id="bksaiacondicion_empresa_proveedor" value="like"></label><div class="controls"><select multiple  maxlength="255"   id="empresa_proveedor" name="empresa_proveedor"  ></select><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_empresa_proveedor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_empresa_proveedor',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_empresa_proveedor" id="bqsaiaenlace_empresa_proveedor" value="" />
		</div></div></div>
                    <script>
                     $(document).ready(function() 
                      {
                      $("#empresa_proveedor").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><div class="control-group"><label class="string control-label" for="entrega_cotizacion">Entrega cotizaci&oacute;n<input type="hidden" name="bksaiacondicion_entrega_cotizacion" id="bksaiacondicion_entrega_cotizacion" value="="></label><div class="controls"><?php genera_campo_listados_editar(83,1021,'',1);?><div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_entrega_cotizacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_entrega_cotizacion',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_entrega_cotizacion" id="bqsaiaenlace_entrega_cotizacion" value="" />
		</div></div></div><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="empresas_invitadas"><input type="hidden" name="adicionar_consulta" value="1">
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
             <?php  } ?><div class="form-actions"> <button type="button" class="btn btn-primary" enlace="pantallas/busquedas/procesa_filtro_busqueda.php" id="ksubmit_saia" titulo="Resultado Empresa y/o proveedor">Buscar</button>
    <input class="btn btn-danger" name="commit" type="reset" value="Cancelar"></div></body><input type="hidden" name="idbusqueda_componente" value="0">