<html><title>.: PETICIONES QUEJAS RECLAMOS SOLICITUDES FELICITACIONES:.</title><head><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_formatos_generales.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../distribucion/funciones_distribucion.php"); ?><?php include_once("../../formatos/librerias/header_formato.php"); ?><?php echo(librerias_jquery('1.8')); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA PETICIONES QUEJAS RECLAMOS SOLICITUDES FELICITACIONES</td></tr><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../formatos/librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../../formatos/librerias/funciones_formatos.js"></script><?php echo(librerias_jquery('1.7')); ?><tr id="tr_estado_documento"><div class="btn-group" data-toggle="buttons-radio" >
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
                    </tr><tr id="tr_remitente_origen"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_remitente_origen',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_remitente_origen',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_remitente_origen" id="bqsaiaenlace_remitente_origen" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">REMITENTE_ORIGEN</td><input type="hidden" name="bksaiacondicion_remitente_origen" id="bksaiacondicion_remitente_origen" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="remitente_origen" name="remitente_origen"></select><script>
                     $(document).ready(function()
                      {
                      $("#remitente_origen").fcbkcomplete({
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
                    </tr><tr id="tr_numero_radicado"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_numero_radicado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_numero_radicado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_numero_radicado" id="bqsaiaenlace_numero_radicado" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO DE RADICADO</td><input type="hidden" name="bksaiacondicion_numero_radicado" id="bksaiacondicion_numero_radicado" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="numero_radicado" name="numero_radicado"></select><script>
                     $(document).ready(function()
                      {
                      $("#numero_radicado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_nombre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_nombre" id="bqsaiaenlace_nombre" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">NOMBRE COMPLETOS</td><input type="hidden" name="bksaiacondicion_nombre" id="bksaiacondicion_nombre" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="nombre" name="nombre"></select><script>
                     $(document).ready(function()
                      {
                      $("#nombre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_documento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_documento" id="bqsaiaenlace_documento" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DOCUMENTO</td><input type="hidden" name="bksaiacondicion_documento" id="bksaiacondicion_documento" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="documento" name="documento"></select><script>
                     $(document).ready(function()
                      {
                      $("#documento").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_email"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_email',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_email',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_email" id="bqsaiaenlace_email" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">EMAIL</td><input type="hidden" name="bksaiacondicion_email" id="bksaiacondicion_email" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="email" name="email"></select><script>
                     $(document).ready(function()
                      {
                      $("#email").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_telefono"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_telefono',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_telefono',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_telefono" id="bqsaiaenlace_telefono" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TELEFONO O CELULAR</td><input type="hidden" name="bksaiacondicion_telefono" id="bksaiacondicion_telefono" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="telefono" name="telefono"></select><script>
                     $(document).ready(function()
                      {
                      $("#telefono").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_rol_institucion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_rol_institucion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_rol_institucion" id="bqsaiaenlace_rol_institucion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ROL EN LA INSTITUCION</td><input type="hidden" name="bksaiacondicion_rol_institucion" id="bksaiacondicion_rol_institucion" value="="><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,3573,'',1,'buscar');?></td></tr><tr id="tr_tipo"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_tipo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_tipo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_tipo" id="bqsaiaenlace_tipo" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">TIPO COMENTARIO</td><input type="hidden" name="bksaiacondicion_tipo" id="bksaiacondicion_tipo" value="like_total"><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(,3575,'',1,'buscar');?></td></tr><tr id="tr_comentarios"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_comentarios',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_comentarios',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_comentarios" id="bqsaiaenlace_comentarios" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">COMENTARIOS</td><input type="hidden" name="bksaiacondicion_comentarios" id="bksaiacondicion_comentarios" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="comentarios" name="comentarios"></select><script>
                     $(document).ready(function()
                      {
                      $("#comentarios").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_anexos"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_anexos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_anexos',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_anexos" id="bqsaiaenlace_anexos" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">DOCUMENTO SOPORTE COMENTARIO</td><input type="hidden" name="bksaiacondicion_anexos" id="bksaiacondicion_anexos" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="anexos" name="anexos"></select><script>
                     $(document).ready(function()
                      {
                      $("#anexos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_estado_reporte"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado_reporte',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado_reporte',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado_reporte" id="bqsaiaenlace_estado_reporte" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">ESTADO</td><input type="hidden" name="bksaiacondicion_estado_reporte" id="bksaiacondicion_estado_reporte" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="estado_reporte" name="estado_reporte"></select><script>
                     $(document).ready(function()
                      {
                      $("#estado_reporte").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_estado_verificacion"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado_verificacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado_verificacion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_estado_verificacion" id="bqsaiaenlace_estado_verificacion" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">VERIFICACION</td><input type="hidden" name="bksaiacondicion_estado_verificacion" id="bksaiacondicion_estado_verificacion" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="estado_verificacion" name="estado_verificacion"></select><script>
                     $(document).ready(function()
                      {
                      $("#estado_verificacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_fecha_reporte"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_reporte',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_reporte',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_reporte" id="bqsaiaenlace_fecha_reporte" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FECHA REPORTE</td><input type="hidden" name="bksaiacondicion_fecha_reporte" id="bksaiacondicion_fecha_reporte" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="fecha_reporte" name="fecha_reporte"></select><script>
                     $(document).ready(function()
                      {
                      $("#fecha_reporte").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr id="tr_funcionario_reporte"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_funcionario_reporte',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_funcionario_reporte',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_funcionario_reporte" id="bqsaiaenlace_funcionario_reporte" value="y" />
		</div>
                     <td class="encabezado" width="20%" title="">FUNCIONARIO REPORTE</td><input type="hidden" name="bksaiacondicion_funcionario_reporte" id="bksaiacondicion_funcionario_reporte" value="like">
                     <td bgcolor="#F5F5F5"><select multiple id="funcionario_reporte" name="funcionario_reporte"></select><script>
                     $(document).ready(function()
                      {
                      $("#funcionario_reporte").fcbkcomplete({
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
                    </tr><input type="hidden" name="campo_descripcion" value="3564,3567,3572,3573,3575"><?php submit_formato();?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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