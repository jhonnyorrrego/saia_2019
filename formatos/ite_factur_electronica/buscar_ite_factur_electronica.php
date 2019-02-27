<html><title>.: ITEM FACTURA ELECTR&OACUTE;NICA:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ITEM FACTURA ELECTR&Oacute;NICA</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_cantidad"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_cantidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_cantidad',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_cantidad" id="bqsaiaenlace_cantidad" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CANTIDAD</td><input type="hidden" name="bksaiacondicion_cantidad" id="bksaiacondicion_cantidad" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="cantidad" name="cantidad"></select><script>
                     $(document).ready(function()
                      {
                      $("#cantidad").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_documento_iddocumento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_documento_iddocumento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_documento_iddocumento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_documento_iddocumento" id="bqsaiaenlace_documento_iddocumento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Documento asociado">DOCUMENTO ASOCIADO</td><input type="hidden" name="bksaiacondicion_documento_iddocumento" id="bksaiacondicion_documento_iddocumento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="documento_iddocumento" name="documento_iddocumento"></select><script>
                     $(document).ready(function()
                      {
                      $("#documento_iddocumento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_idft_ite_factur_electronica"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_ite_factur_electronica',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_ite_factur_electronica',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_ite_factur_electronica" id="bqsaiaenlace_idft_ite_factur_electronica" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Identificador unico del formato (llave primaria)">IDENTIFICADOR DE FORMATO</td><input type="hidden" name="bksaiacondicion_idft_ite_factur_electronica" id="bksaiacondicion_idft_ite_factur_electronica" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_ite_factur_electronica" name="idft_ite_factur_electronica"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_ite_factur_electronica").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_impuesto_1"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_impuesto_1',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_impuesto_1',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_impuesto_1" id="bqsaiaenlace_impuesto_1" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">IMP. 1</td><input type="hidden" name="bksaiacondicion_impuesto_1" id="bksaiacondicion_impuesto_1" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="impuesto_1" name="impuesto_1"></select><script>
                     $(document).ready(function()
                      {
                      $("#impuesto_1").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_impuesto_2"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_impuesto_2',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_impuesto_2',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_impuesto_2" id="bqsaiaenlace_impuesto_2" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">IMP. 2</td><input type="hidden" name="bksaiacondicion_impuesto_2" id="bksaiacondicion_impuesto_2" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="impuesto_2" name="impuesto_2"></select><script>
                     $(document).ready(function()
                      {
                      $("#impuesto_2").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_serie_idserie"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_serie_idserie',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_serie_idserie" id="bqsaiaenlace_serie_idserie" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Tipo de documento">TIPO DE DOCUMENTO</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_valor_iva"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_valor_iva',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_valor_iva',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_valor_iva" id="bqsaiaenlace_valor_iva" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">IVA</td><input type="hidden" name="bksaiacondicion_valor_iva" id="bksaiacondicion_valor_iva" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="valor_iva" name="valor_iva"></select><script>
                     $(document).ready(function()
                      {
                      $("#valor_iva").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_valor_total"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_valor_total',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_valor_total',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_valor_total" id="bqsaiaenlace_valor_total" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TOTAL</td><input type="hidden" name="bksaiacondicion_valor_total" id="bksaiacondicion_valor_total" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="valor_total" name="valor_total"></select><script>
                     $(document).ready(function()
                      {
                      $("#valor_total").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_valor_unitario"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_valor_unitario',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_valor_unitario',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_valor_unitario" id="bqsaiaenlace_valor_unitario" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">VALOR UNITARIO</td><input type="hidden" name="bksaiacondicion_valor_unitario" id="bksaiacondicion_valor_unitario" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="valor_unitario" name="valor_unitario"></select><script>
                     $(document).ready(function()
                      {
                      $("#valor_unitario").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_descripcion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_descripcion" id="bqsaiaenlace_descripcion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DESCRIPCI&Oacute;N</td><input type="hidden" name="bksaiacondicion_descripcion" id="bksaiacondicion_descripcion" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="descripcion" name="descripcion"></select><script>
                     $(document).ready(function()
                      {
                      $("#descripcion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="7193"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="ite_factur_electronica"><?php submit_formato(439);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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