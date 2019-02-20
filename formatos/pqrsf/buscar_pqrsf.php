<html><title>.: PQRSF:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("../../formatos/librerias/funciones_cliente.php"); ?><?php include_once("../../formatos/librerias/funciones_cliente.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA PQRSF</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_estado_documento"><div class="btn-group" data-toggle="buttons-radio" >
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
                     <td class="encabezado" width="20%" title="PQRSF">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
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
                    </tr><tr id="tr_idft_pqrsf"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_pqrsf',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_pqrsf',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_pqrsf" id="bqsaiaenlace_idft_pqrsf" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">PQRSF</td><input type="hidden" name="bksaiacondicion_idft_pqrsf" id="bksaiacondicion_idft_pqrsf" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_pqrsf" name="idft_pqrsf"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_pqrsf").fcbkcomplete({
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
                    </tr><tr id="tr_etiqueta_titulo_657648566"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_etiqueta_titulo_657648566',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_etiqueta_titulo_657648566',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_etiqueta_titulo_657648566" id="bqsaiaenlace_etiqueta_titulo_657648566" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">T&Iacute;TULO DE SECCI&Oacute;N</td><input type="hidden" name="bksaiacondicion_etiqueta_titulo_657648566" id="bksaiacondicion_etiqueta_titulo_657648566" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="etiqueta_titulo_657648566" name="etiqueta_titulo_657648566"></select><script>
                     $(document).ready(function()
                      {
                      $("#etiqueta_titulo_657648566").fcbkcomplete({
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
                    </tr><tr id="tr_etiqueta_linea_1840635814"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_etiqueta_linea_1840635814',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_etiqueta_linea_1840635814',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_etiqueta_linea_1840635814" id="bqsaiaenlace_etiqueta_linea_1840635814" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">L&Iacute;NEA DE SEPARACI&Oacute;N</td><input type="hidden" name="bksaiacondicion_etiqueta_linea_1840635814" id="bksaiacondicion_etiqueta_linea_1840635814" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="etiqueta_linea_1840635814" name="etiqueta_linea_1840635814"></select><script>
                     $(document).ready(function()
                      {
                      $("#etiqueta_linea_1840635814").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr></td></tr><tr id="tr_nocedula"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nocedula',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nocedula',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nocedula" id="bqsaiaenlace_nocedula" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">NO.CEDULA</td><input type="hidden" name="bksaiacondicion_nocedula" id="bksaiacondicion_nocedula" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="nocedula" name="nocedula"></select><script>
                     $(document).ready(function()
                      {
                      $("#nocedula").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_nombre_completo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre_completo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre_completo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre_completo" id="bqsaiaenlace_nombre_completo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Ingrese su nombre completo">NOMBRE COMPLETO</td><input type="hidden" name="bksaiacondicion_nombre_completo" id="bksaiacondicion_nombre_completo" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_completo" name="nombre_completo"></select><script>
                     $(document).ready(function()
                      {
                      $("#nombre_completo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo_solicitud" id="bqsaiaenlace_tipo_solicitud" value="y" />
		</div>
                  <td class="encabezado" width="20%" title="">TIPO DE SOLICITUD</td><input type="hidden" name="bksaiacondicion_tipo_solicitud" id="bksaiacondicion_tipo_solicitud" value="like"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(459,7597,'',1,'buscar');?></td></tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_medio_la_solicitud',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_medio_la_solicitud',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_medio_la_solicitud" id="bqsaiaenlace_medio_la_solicitud" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">MEDIO DE LA SOLICITUD</td><input type="hidden" name="bksaiacondicion_medio_la_solicitud" id="bksaiacondicion_medio_la_solicitud" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(459,7599,'',1,'buscar');?></td></tr><tr id="tr_adjuntos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_adjuntos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_adjuntos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_adjuntos" id="bqsaiaenlace_adjuntos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ADJUNTOS</td><input type="hidden" name="bksaiacondicion_adjuntos" id="bksaiacondicion_adjuntos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="adjuntos" name="adjuntos"></select><script>
                     $(document).ready(function()
                      {
                      $("#adjuntos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_comentario_descripcion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_comentario_descripcion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_comentario_descripcion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_comentario_descripcion" id="bqsaiaenlace_comentario_descripcion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">COMENTARIO O DESCRIPCI&Oacute;N</td><input type="hidden" name="bksaiacondicion_comentario_descripcion" id="bksaiacondicion_comentario_descripcion" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="comentario_descripcion" name="comentario_descripcion"></select><script>
                     $(document).ready(function()
                      {
                      $("#comentario_descripcion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="7596"><?php submit_formato(459);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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