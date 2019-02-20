<html><title>.: FACTURA ELECTR&OACUTE;NICA:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../funciones.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("../funciones.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA FACTURA ELECTR&Oacute;NICA</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_anexos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_anexos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_anexos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_anexos" id="bqsaiaenlace_anexos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ANEXOS</td><input type="hidden" name="bksaiacondicion_anexos" id="bksaiacondicion_anexos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexos" name="anexos"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_ciudad_proveedor"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_ciudad_proveedor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_ciudad_proveedor',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_ciudad_proveedor" id="bqsaiaenlace_ciudad_proveedor" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">CIUDAD PROVEEDOR</td><input type="hidden" name="bksaiacondicion_ciudad_proveedor" id="bksaiacondicion_ciudad_proveedor" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="ciudad_proveedor" name="ciudad_proveedor"></select><script>
                     $(document).ready(function()
                      {
                      $("#ciudad_proveedor").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_direccion_proveedor"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_direccion_proveedor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_direccion_proveedor',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_direccion_proveedor" id="bqsaiaenlace_direccion_proveedor" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DIRECCI&Oacute;N PROVEEDOR</td><input type="hidden" name="bksaiacondicion_direccion_proveedor" id="bksaiacondicion_direccion_proveedor" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="direccion_proveedor" name="direccion_proveedor"></select><script>
                     $(document).ready(function()
                      {
                      $("#direccion_proveedor").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_estado_documento"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr id="tr_estado_proveedor"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado_proveedor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado_proveedor',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado_proveedor" id="bqsaiaenlace_estado_proveedor" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DEPARTAMENTO PROVEEDOR</td><input type="hidden" name="bksaiacondicion_estado_proveedor" id="bksaiacondicion_estado_proveedor" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="estado_proveedor" name="estado_proveedor"></select><script>
                     $(document).ready(function()
                      {
                      $("#estado_proveedor").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_factura" id="bqsaiaenlace_fecha_factura" value="y" />
		</div>
                    <td class="encabezado" width="20%" title="">FECHA FACTURA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_factura_1"  id="fecha_factura_1" value=""><?php selector_fecha("fecha_factura_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" name="fecha_factura_2"  id="fecha_factura_2" value=""><?php selector_fecha("fecha_factura_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></td></tr><tr id="tr_fk_datos_factura"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fk_datos_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fk_datos_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fk_datos_factura" id="bqsaiaenlace_fk_datos_factura" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FK_DATOS_FACTURA</td><input type="hidden" name="bksaiacondicion_fk_datos_factura" id="bksaiacondicion_fk_datos_factura" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fk_datos_factura" name="fk_datos_factura"></select><script>
                     $(document).ready(function()
                      {
                      $("#fk_datos_factura").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_info_proveedor"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_info_proveedor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_info_proveedor',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_info_proveedor" id="bqsaiaenlace_info_proveedor" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">INFORMACI&Oacute;N ADICIONAL DEL PROVEEDOR</td><input type="hidden" name="bksaiacondicion_info_proveedor" id="bksaiacondicion_info_proveedor" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="info_proveedor" name="info_proveedor"></select><script>
                     $(document).ready(function()
                      {
                      $("#info_proveedor").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_nit_proveedor"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nit_proveedor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nit_proveedor',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nit_proveedor" id="bqsaiaenlace_nit_proveedor" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">NIT PROVEEDOR</td><input type="hidden" name="bksaiacondicion_nit_proveedor" id="bksaiacondicion_nit_proveedor" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="nit_proveedor" name="nit_proveedor"></select><script>
                     $(document).ready(function()
                      {
                      $("#nit_proveedor").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_nombre_proveedor"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre_proveedor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre_proveedor',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre_proveedor" id="bqsaiaenlace_nombre_proveedor" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">NOMBRE PROVEEDOR</td><input type="hidden" name="bksaiacondicion_nombre_proveedor" id="bksaiacondicion_nombre_proveedor" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_proveedor" name="nombre_proveedor"></select><script>
                     $(document).ready(function()
                      {
                      $("#nombre_proveedor").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_num_factura"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_num_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_num_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_num_factura" id="bqsaiaenlace_num_factura" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE FACTURA</td><input type="hidden" name="bksaiacondicion_num_factura" id="bksaiacondicion_num_factura" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="num_factura" name="num_factura"></select><script>
                     $(document).ready(function()
                      {
                      $("#num_factura").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_pais_proveedor"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_pais_proveedor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_pais_proveedor',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_pais_proveedor" id="bqsaiaenlace_pais_proveedor" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">PAIS PROVEEDOR</td><input type="hidden" name="bksaiacondicion_pais_proveedor" id="bksaiacondicion_pais_proveedor" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="pais_proveedor" name="pais_proveedor"></select><script>
                     $(document).ready(function()
                      {
                      $("#pais_proveedor").fcbkcomplete({
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
                     <td class="encabezado" width="20%" title="Factura electr&oacute;nica">SERIE DOCUMENTAL</td><input type="hidden" name="bksaiacondicion_serie_idserie" id="bksaiacondicion_serie_idserie" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="serie_idserie" name="serie_idserie"></select><script>
                     $(document).ready(function()
                      {
                      $("#serie_idserie").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_total_factura"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_total_factura',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_total_factura',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_total_factura" id="bqsaiaenlace_total_factura" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TOTAL FACTURA</td><input type="hidden" name="bksaiacondicion_total_factura" id="bksaiacondicion_total_factura" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="total_factura" name="total_factura"></select><script>
                     $(document).ready(function()
                      {
                      $("#total_factura").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_idft_factura_electronica"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idft_factura_electronica',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idft_factura_electronica',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_idft_factura_electronica" id="bqsaiaenlace_idft_factura_electronica" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FACTURA_ELECTRONICA</td><input type="hidden" name="bksaiacondicion_idft_factura_electronica" id="bksaiacondicion_idft_factura_electronica" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="idft_factura_electronica" name="idft_factura_electronica"></select><script>
                     $(document).ready(function()
                      {
                      $("#idft_factura_electronica").fcbkcomplete({
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
                    </tr><input type="hidden" name="campo_descripcion" value="7003,7005"><?php submit_formato(423);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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