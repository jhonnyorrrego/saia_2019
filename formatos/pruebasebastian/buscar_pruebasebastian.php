<html><title>.: PRUEBA_SEBASTIAN:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("../../formatos/librerias/funciones_cliente.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA PRUEBA_SEBASTIAN</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_estado_documento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado_documento" id="bqsaiaenlace_estado_documento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ESTADO DEL DOCUMENTO</td><input type="hidden" name="bksaiacondicion_estado_documento" id="bksaiacondicion_estado_documento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="estado_documento" name="estado_documento"></select><script>
                     $(document).ready(function()
                      {
                      $("#estado_documento").fcbkcomplete({
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
                     <td class="encabezado" width="20%" title="prueba_sebastian">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
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
                    </tr><tr id="tr_idft_pruebasebastian"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_pruebasebastian',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_pruebasebastian',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_pruebasebastian" id="bqsaiaenlace_idft_pruebasebastian" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">PRUEBASEBASTIAN</td><input type="hidden" name="bksaiacondicion_idft_pruebasebastian" id="bksaiacondicion_idft_pruebasebastian" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_pruebasebastian" name="idft_pruebasebastian"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_pruebasebastian").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_dependencia"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_dependencia',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_dependencia',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_dependencia" id="bqsaiaenlace_dependencia" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DEPENDENCIA DEL CREADOR DEL DOCUMENTO</td><input type="hidden" name="bksaiacondicion_dependencia" id="bksaiacondicion_dependencia" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="dependencia" name="dependencia"></select><script>
                     $(document).ready(function()
                      {
                      $("#dependencia").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_encabezado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_encabezado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_encabezado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_encabezado" id="bqsaiaenlace_encabezado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ENCABEZADO</td><input type="hidden" name="bksaiacondicion_encabezado" id="bksaiacondicion_encabezado" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="encabezado" name="encabezado"></select><script>
                     $(document).ready(function()
                      {
                      $("#encabezado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_firma"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_firma',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_firma',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_firma" id="bqsaiaenlace_firma" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FIRMAS DIGITALES</td><input type="hidden" name="bksaiacondicion_firma" id="bksaiacondicion_firma" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="firma" name="firma"></select><script>
                     $(document).ready(function()
                      {
                      $("#firma").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_etiqueta_titulo_1857734299"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_etiqueta_titulo_1857734299',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_etiqueta_titulo_1857734299',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_etiqueta_titulo_1857734299" id="bqsaiaenlace_etiqueta_titulo_1857734299" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">T&Iacute;TULO DE SECCI&Oacute;N</td><input type="hidden" name="bksaiacondicion_etiqueta_titulo_1857734299" id="bksaiacondicion_etiqueta_titulo_1857734299" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="etiqueta_titulo_1857734299" name="etiqueta_titulo_1857734299"></select><script>
                     $(document).ready(function()
                      {
                      $("#etiqueta_titulo_1857734299").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_etiqueta_titulo_915487093"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_etiqueta_titulo_915487093',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_etiqueta_titulo_915487093',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_etiqueta_titulo_915487093" id="bqsaiaenlace_etiqueta_titulo_915487093" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">T&Iacute;TULO DE SECCI&Oacute;N</td><input type="hidden" name="bksaiacondicion_etiqueta_titulo_915487093" id="bksaiacondicion_etiqueta_titulo_915487093" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="etiqueta_titulo_915487093" name="etiqueta_titulo_915487093"></select><script>
                     $(document).ready(function()
                      {
                      $("#etiqueta_titulo_915487093").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_etiqueta_parrafo_1504496047"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_etiqueta_parrafo_1504496047',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_etiqueta_parrafo_1504496047',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_etiqueta_parrafo_1504496047" id="bqsaiaenlace_etiqueta_parrafo_1504496047" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TEXTO DESCRIPTIVO</td><input type="hidden" name="bksaiacondicion_etiqueta_parrafo_1504496047" id="bksaiacondicion_etiqueta_parrafo_1504496047" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="etiqueta_parrafo_1504496047" name="etiqueta_parrafo_1504496047"></select><script>
                     $(document).ready(function()
                      {
                      $("#etiqueta_parrafo_1504496047").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_campo_texto_1220423661"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_campo_texto_1220423661',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_campo_texto_1220423661',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_campo_texto_1220423661" id="bqsaiaenlace_campo_texto_1220423661" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TEXTO EN UNA L&Iacute;NEA</td><input type="hidden" name="bksaiacondicion_campo_texto_1220423661" id="bksaiacondicion_campo_texto_1220423661" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="campo_texto_1220423661" name="campo_texto_1220423661"></select><script>
                     $(document).ready(function()
                      {
                      $("#campo_texto_1220423661").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><?php submit_formato(427);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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