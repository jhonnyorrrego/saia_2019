<html><title>.: SOLICITUD DE PERMISOS:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA SOLICITUD DE PERMISOS</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_estado_documento"><div class="btn-group" data-toggle="buttons-radio" >
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
                     <td class="encabezado" width="20%" title="SOLICITUD DE PERMISOS">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
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
                    </tr><tr id="tr_etiqueta_titulo_1100262650"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_etiqueta_titulo_1100262650',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_etiqueta_titulo_1100262650',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_etiqueta_titulo_1100262650" id="bqsaiaenlace_etiqueta_titulo_1100262650" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="Info general del titulo">T&Iacute;TULO DE SECCI&Oacute;N</td><input type="hidden" name="bksaiacondicion_etiqueta_titulo_1100262650" id="bksaiacondicion_etiqueta_titulo_1100262650" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="etiqueta_titulo_1100262650" name="etiqueta_titulo_1100262650"></select><script>
                     $(document).ready(function()
                      {
                      $("#etiqueta_titulo_1100262650").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_idft_solicitud_permisos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_solicitud_permisos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_solicitud_permisos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_solicitud_permisos" id="bqsaiaenlace_idft_solicitud_permisos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">SOLICITUD_PERMISOS</td><input type="hidden" name="bksaiacondicion_idft_solicitud_permisos" id="bksaiacondicion_idft_solicitud_permisos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_solicitud_permisos" name="idft_solicitud_permisos"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_solicitud_permisos").fcbkcomplete({
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
                    </tr><tr id="tr_etiqueta_linea_1872295254"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_etiqueta_linea_1872295254',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_etiqueta_linea_1872295254',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_etiqueta_linea_1872295254" id="bqsaiaenlace_etiqueta_linea_1872295254" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">L&Iacute;NEA DE SEPARACI&Oacute;N</td><input type="hidden" name="bksaiacondicion_etiqueta_linea_1872295254" id="bksaiacondicion_etiqueta_linea_1872295254" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="etiqueta_linea_1872295254" name="etiqueta_linea_1872295254"></select><script>
                     $(document).ready(function()
                      {
                      $("#etiqueta_linea_1872295254").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_etiqueta_titulo_625604532"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_etiqueta_titulo_625604532',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_etiqueta_titulo_625604532',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_etiqueta_titulo_625604532" id="bqsaiaenlace_etiqueta_titulo_625604532" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">T&Iacute;TULO DE SECCI&Oacute;N</td><input type="hidden" name="bksaiacondicion_etiqueta_titulo_625604532" id="bksaiacondicion_etiqueta_titulo_625604532" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="etiqueta_titulo_625604532" name="etiqueta_titulo_625604532"></select><script>
                     $(document).ready(function()
                      {
                      $("#etiqueta_titulo_625604532").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr></td></tr><tr id="tr_elija_el_tipo_permiso"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_elija_el_tipo_permiso',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_elija_el_tipo_permiso',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_elija_el_tipo_permiso" id="bqsaiaenlace_elija_el_tipo_permiso" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="por favor seleccione UN permiso">ELIJA EL TIPO DE PERMISO</td><input type="hidden" name="bksaiacondicion_elija_el_tipo_permiso" id="bksaiacondicion_elija_el_tipo_permiso" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(419,6936,'',1,'buscar');?></td></tr><tr id="tr_adjunte_la_prueba"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_adjunte_la_prueba',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_adjunte_la_prueba',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_adjunte_la_prueba" id="bqsaiaenlace_adjunte_la_prueba" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ADJUNTE LA PRUEBA</td><input type="hidden" name="bksaiacondicion_adjunte_la_prueba" id="bksaiacondicion_adjunte_la_prueba" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="adjunte_la_prueba" name="adjunte_la_prueba"></select><script>
                     $(document).ready(function()
                      {
                      $("#adjunte_la_prueba").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_observaciones"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_observaciones',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_observaciones',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_observaciones" id="bqsaiaenlace_observaciones" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td><input type="hidden" name="bksaiacondicion_observaciones" id="bksaiacondicion_observaciones" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones" name="observaciones"></select><script>
                     $(document).ready(function()
                      {
                      $("#observaciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="6936,6937,6938"><?php submit_formato(419);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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