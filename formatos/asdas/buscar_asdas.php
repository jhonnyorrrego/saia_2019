<html><title>.: ASDASD:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ASDASD</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_estado_documento"><div class="btn-group" data-toggle="buttons-radio" >
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
                     <td class="encabezado" width="20%" title="asdasd">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_idft_asdas"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_asdas',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_asdas',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_asdas" id="bqsaiaenlace_idft_asdas" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ASDAS</td><input type="hidden" name="bksaiacondicion_idft_asdas" id="bksaiacondicion_idft_asdas" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_asdas" name="idft_asdas"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_asdas").fcbkcomplete({
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
                     <td class="encabezado" width="20%" title="">DOCUMENTO ASOCIADO</td><input type="hidden" name="bksaiacondicion_documento_iddocumento" id="bksaiacondicion_documento_iddocumento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="documento_iddocumento" name="documento_iddocumento"></select><script>
                     $(document).ready(function()
                      {
                      $("#documento_iddocumento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr></td></tr><tr id="tr_textarea_cke_1430966504"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_textarea_cke_1430966504',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_textarea_cke_1430966504',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_textarea_cke_1430966504" id="bqsaiaenlace_textarea_cke_1430966504" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TEXTO CON FORMATO</td><input type="hidden" name="bksaiacondicion_textarea_cke_1430966504" id="bksaiacondicion_textarea_cke_1430966504" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="textarea_cke_1430966504" name="textarea_cke_1430966504"></select><script>
                     $(document).ready(function()
                      {
                      $("#textarea_cke_1430966504").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_moneda_1953843243"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_moneda_1953843243',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_moneda_1953843243',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_moneda_1953843243" id="bqsaiaenlace_moneda_1953843243" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">MONEDA</td><input type="hidden" name="bksaiacondicion_moneda_1953843243" id="bksaiacondicion_moneda_1953843243" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="moneda_1953843243" name="moneda_1953843243"></select><script>
                     $(document).ready(function()
                      {
                      $("#moneda_1953843243").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_etiqueta_parrafo_1185182134"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_etiqueta_parrafo_1185182134',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_etiqueta_parrafo_1185182134',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_etiqueta_parrafo_1185182134" id="bqsaiaenlace_etiqueta_parrafo_1185182134" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TEXTO DESCRIPTIVO</td><input type="hidden" name="bksaiacondicion_etiqueta_parrafo_1185182134" id="bksaiacondicion_etiqueta_parrafo_1185182134" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="etiqueta_parrafo_1185182134" name="etiqueta_parrafo_1185182134"></select><script>
                     $(document).ready(function()
                      {
                      $("#etiqueta_parrafo_1185182134").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_textarea_cke_649574615"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_textarea_cke_649574615',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_textarea_cke_649574615',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_textarea_cke_649574615" id="bqsaiaenlace_textarea_cke_649574615" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TEXTO CON FORMATO</td><input type="hidden" name="bksaiacondicion_textarea_cke_649574615" id="bksaiacondicion_textarea_cke_649574615" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="textarea_cke_649574615" name="textarea_cke_649574615"></select><script>
                     $(document).ready(function()
                      {
                      $("#textarea_cke_649574615").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_select_923812534',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_select_923812534',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_select_923812534" id="bqsaiaenlace_select_923812534" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">LISTA DESPLEGABLE</td><input type="hidden" name="bksaiacondicion_select_923812534" id="bksaiacondicion_select_923812534" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(417,7025,'',1,'buscar');?></td></tr><tr id="tr_dependencia"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr id="tr_contador_1203113038"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_contador_1203113038',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_contador_1203113038',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_contador_1203113038" id="bqsaiaenlace_contador_1203113038" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CAMPO NUM&Eacute;RICO</td><input type="hidden" name="bksaiacondicion_contador_1203113038" id="bksaiacondicion_contador_1203113038" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="contador_1203113038" name="contador_1203113038"></select><script>
                     $(document).ready(function()
                      {
                      $("#contador_1203113038").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_campo_texto_1922978464"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_campo_texto_1922978464',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_campo_texto_1922978464',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_campo_texto_1922978464" id="bqsaiaenlace_campo_texto_1922978464" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CAMPO DE TEXTO</td><input type="hidden" name="bksaiacondicion_campo_texto_1922978464" id="bksaiacondicion_campo_texto_1922978464" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="campo_texto_1922978464" name="campo_texto_1922978464"></select><script>
                     $(document).ready(function()
                      {
                      $("#campo_texto_1922978464").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_ejecutor_310418348"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ejecutor_310418348',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ejecutor_310418348',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ejecutor_310418348" id="bqsaiaenlace_ejecutor_310418348" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TERCEROS</td><input type="hidden" name="bksaiacondicion_ejecutor_310418348" id="bksaiacondicion_ejecutor_310418348" value="like">
                     <td bgcolor="#F5F5F5"><select multiple  maxlength="255"   id="ejecutor_310418348" name="ejecutor_310418348"  ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function() {
                      $("#ejecutor_310418348").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_checkbox_1657477002',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_checkbox_1657477002',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_checkbox_1657477002" id="bqsaiaenlace_checkbox_1657477002" value="y" />
		</div>
                  <td class="encabezado" width="20%" title="">SELECCI&Oacute;N M&Uacute;LTIPLE</td><input type="hidden" name="bksaiacondicion_checkbox_1657477002" id="bksaiacondicion_checkbox_1657477002" value="like"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(417,6915,'',1,'buscar');?></td></tr><tr id="tr_archivo_568795365"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_archivo_568795365',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_archivo_568795365',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_archivo_568795365" id="bqsaiaenlace_archivo_568795365" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ADJUNTOS</td><input type="hidden" name="bksaiacondicion_archivo_568795365" id="bksaiacondicion_archivo_568795365" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="archivo_568795365" name="archivo_568795365"></select><script>
                     $(document).ready(function()
                      {
                      $("#archivo_568795365").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="6925"><?php submit_formato(417);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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