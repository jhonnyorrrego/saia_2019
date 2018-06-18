<html><title>.: FUNCIONARIOS DE LA RUTA:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA FUNCIONARIOS DE LA RUTA</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Funcionarios de la ruta">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_fecha_mensajero"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_mensajero',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_mensajero',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_mensajero" id="bqsaiaenlace_fecha_mensajero" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FECHA</td><input type="hidden" name="bksaiacondicion_fecha_mensajero" id="bksaiacondicion_fecha_mensajero" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_mensajero" name="fecha_mensajero"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_mensajero").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_mensajero_ruta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_mensajero_ruta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_mensajero_ruta" id="bqsaiaenlace_mensajero_ruta" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">MENSAJERO</td><input type="hidden" name="bksaiacondicion_mensajero_ruta" id="bksaiacondicion_mensajero_ruta" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,5005,'',1,'buscar');?></td></tr><tr id="tr_estado_mensajero"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado_mensajero',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado_mensajero',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado_mensajero" id="bqsaiaenlace_estado_mensajero" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ESTADO</td><input type="hidden" name="bksaiacondicion_estado_mensajero" id="bksaiacondicion_estado_mensajero" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="estado_mensajero" name="estado_mensajero"></select><script>
                     $(document).ready(function()
                      {
                      $("#estado_mensajero").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_idft_funcionarios_ruta"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_funcionarios_ruta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_funcionarios_ruta',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_funcionarios_ruta" id="bqsaiaenlace_idft_funcionarios_ruta" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FUNCIONARIOS_RUTA</td><input type="hidden" name="bksaiacondicion_idft_funcionarios_ruta" id="bksaiacondicion_idft_funcionarios_ruta" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_funcionarios_ruta" name="idft_funcionarios_ruta"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_funcionarios_ruta").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><?php if($_REQUEST["padre"]) {?><input type="hidden"  name="ft_ruta_distribucion"  value="<?php echo $_REQUEST["padre"]; ?>"><?php } ?><?php if($_REQUEST["anterior"]) {?><input type="hidden"  name="ft_ruta_distribucion"  value="<?php echo $_REQUEST["anterior"]; ?>"><?php }  else {listar_select_padres(ft_ruta_distribucion);} ?><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="funcionarios_ruta"><?php submit_formato();?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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
             <?php  } ?></form></body></html>