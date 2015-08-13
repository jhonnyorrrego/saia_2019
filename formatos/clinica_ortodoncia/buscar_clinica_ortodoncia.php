<html><title>.:BUSCAR HISTORIA CLINICA:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA HISTORIA CLINICA</td></tr><tr>
                   <td class="encabezado" width="20%" title="">INFORMACI&Oacute;N DEL PACIENTE</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="datos_paciente" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_creacion_historia" id="condicion_creacion_historia"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA CREACION</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="creacion_historia_1" id="creacion_historia_1" tipo="fecha" value=""><?php selector_fecha("creacion_historia_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="creacion_historia_2" id="creacion_historia_2" tipo="fecha" value=""><?php selector_fecha("creacion_historia_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_usuario" id="condicion_nombre_usuario"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE</td><td class="encabezado">&nbsp;<select name="compara_nombre_usuario" id="compara_nombre_usuario"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_usuario" name="nombre_usuario"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_usuario").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_apellido_usuario" id="condicion_apellido_usuario"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">APELLIDO</td><td class="encabezado">&nbsp;<select name="compara_apellido_usuario" id="compara_apellido_usuario"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="apellido_usuario" name="apellido_usuario"></select><script>
                     $(document).ready(function() 
                      {
                      $("#apellido_usuario").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_cedula_ciudadania" id="condicion_cedula_ciudadania"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DOC. IDENTIDAD</td><td class="encabezado">&nbsp;<select name="compara_cedula_ciudadania" id="compara_cedula_ciudadania"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(282,3224,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_numero_doc" id="condicion_numero_doc"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">N&Uacute;MERO</td><td class="encabezado">&nbsp;<select name="compara_numero_doc" id="compara_numero_doc"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="numero_doc" name="numero_doc"></select><script>
                     $(document).ready(function() 
                      {
                      $("#numero_doc").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_nacimiento" id="condicion_fecha_nacimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE NACIMIENTO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_nacimiento_1" id="fecha_nacimiento_1" tipo="fecha" value=""><?php selector_fecha("fecha_nacimiento_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_nacimiento_2" id="fecha_nacimiento_2" tipo="fecha" value=""><?php selector_fecha("fecha_nacimiento_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_depto" id="condicion_depto"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DEPARTAMENTO</td><td class="encabezado">&nbsp;<select name="compara_depto" id="compara_depto"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(282,3176,$_REQUEST['iddoc']);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_edad" id="condicion_edad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">EDAD</td><td class="encabezado">&nbsp;<select name="compara_edad" id="compara_edad"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="edad" name="edad"></select><script>
                     $(document).ready(function() 
                      {
                      $("#edad").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_sexo" id="condicion_sexo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SEXO</td><td class="encabezado">&nbsp;<select name="compara_sexo" id="compara_sexo"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(282,3180,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ocupacion" id="condicion_ocupacion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OCUPACION</td><td class="encabezado">&nbsp;<select name="compara_ocupacion" id="compara_ocupacion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="ocupacion" name="ocupacion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#ocupacion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_donde_usuario" id="condicion_donde_usuario"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">&iquest;DONDE?</td><td class="encabezado">&nbsp;<select name="compara_donde_usuario" id="compara_donde_usuario"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="donde_usuario" name="donde_usuario"></select><script>
                     $(document).ready(function() 
                      {
                      $("#donde_usuario").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_direccion" id="condicion_direccion"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DIRECCION</td><td class="encabezado">&nbsp;<select name="compara_direccion" id="compara_direccion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="direccion" name="direccion"></select><script>
                     $(document).ready(function() 
                      {
                      $("#direccion").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tel_usuario" id="condicion_tel_usuario"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TEL&Eacute;FONOS</td><td class="encabezado">&nbsp;<select name="compara_tel_usuario" id="compara_tel_usuario"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="tel_usuario" name="tel_usuario"></select><script>
                     $(document).ready(function() 
                      {
                      $("#tel_usuario").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_cel" id="condicion_cel"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CELULAR</td><td class="encabezado">&nbsp;<select name="compara_cel" id="compara_cel"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cel" name="cel"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cel").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_estado_civil" id="condicion_estado_civil"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ESTADO CIVIL</td><td class="encabezado">&nbsp;<select name="compara_estado_civil" id="compara_estado_civil"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(282,3188,'',1);?></td></tr><tr>
                   <td class="encabezado" width="20%" title="">INFORMACI&Oacute;N CONYUGUE</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="info_conyugue" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_apellidos_conyugue" id="condicion_nombre_apellidos_conyugue"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE Y APELLIDOS DEL CONYUGUE</td><td class="encabezado">&nbsp;<select name="compara_nombre_apellidos_conyugue" id="compara_nombre_apellidos_conyugue"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_apellidos_conyugue" name="nombre_apellidos_conyugue"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_apellidos_conyugue").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tel_conyugue" id="condicion_tel_conyugue"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TELEFONO CONYUGUE</td><td class="encabezado">&nbsp;<select name="compara_tel_conyugue" id="compara_tel_conyugue"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="tel_conyugue" name="tel_conyugue"></select><script>
                     $(document).ready(function() 
                      {
                      $("#tel_conyugue").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_nucleo_familiar" id="condicion_nucleo_familiar"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">COMPOSICION DEL NUCLEO FAMILIAR</td><td class="encabezado">&nbsp;<select name="compara_nucleo_familiar" id="compara_nucleo_familiar"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nucleo_familiar" name="nucleo_familiar"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nucleo_familiar").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_grado_escolar" id="condicion_grado_escolar"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">GRADO ESCOLAR</td><td class="encabezado">&nbsp;<select name="compara_grado_escolar" id="compara_grado_escolar"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="grado_escolar" name="grado_escolar"></select><script>
                     $(document).ready(function() 
                      {
                      $("#grado_escolar").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_actividades_tiempo_libre" id="condicion_actividades_tiempo_libre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">&iquest;QUE ACTIVIDADES REALIZA EN SU TIEMPO LIBRE?</td><td class="encabezado">&nbsp;<select name="compara_actividades_tiempo_libre" id="compara_actividades_tiempo_libre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="actividades_tiempo_libre" name="actividades_tiempo_libre"></select><script>
                     $(document).ready(function() 
                      {
                      $("#actividades_tiempo_libre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">ETIQUETA INFO MADRE</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="info_madre_etiqueta" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_madre" id="condicion_nombre_madre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE MADRE</td><td class="encabezado">&nbsp;<select name="compara_nombre_madre" id="compara_nombre_madre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_madre" name="nombre_madre"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_madre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tel_madre" id="condicion_tel_madre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TEL&Eacute;FONO MADRE</td><td class="encabezado">&nbsp;<select name="compara_tel_madre" id="compara_tel_madre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="tel_madre" name="tel_madre"></select><script>
                     $(document).ready(function() 
                      {
                      $("#tel_madre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_ocupacion_madre" id="condicion_ocupacion_madre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OCUPACION MADRE</td><td class="encabezado">&nbsp;<select name="compara_ocupacion_madre" id="compara_ocupacion_madre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="ocupacion_madre" name="ocupacion_madre"></select><script>
                     $(document).ready(function() 
                      {
                      $("#ocupacion_madre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_donde_madre" id="condicion_donde_madre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">&iquest;DONDE?</td><td class="encabezado">&nbsp;<select name="compara_donde_madre" id="compara_donde_madre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="donde_madre" name="donde_madre"></select><script>
                     $(document).ready(function() 
                      {
                      $("#donde_madre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">INFORMACI&Oacute;N PADRE</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="info_padre_etiqueta" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre_padre" id="condicion_nombre_padre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE PADRE</td><td class="encabezado">&nbsp;<select name="compara_nombre_padre" id="compara_nombre_padre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre_padre" name="nombre_padre"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre_padre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tel_padre" id="condicion_tel_padre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TEL&Eacute;FONO PADRE</td><td class="encabezado">&nbsp;<select name="compara_tel_padre" id="compara_tel_padre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="tel_padre" name="tel_padre"></select><script>
                     $(document).ready(function() 
                      {
                      $("#tel_padre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_ocupacion_padre" id="condicion_ocupacion_padre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OCUPACI&Oacute;N PADRE</td><td class="encabezado">&nbsp;<select name="compara_ocupacion_padre" id="compara_ocupacion_padre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="ocupacion_padre" name="ocupacion_padre"></select><script>
                     $(document).ready(function() 
                      {
                      $("#ocupacion_padre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_donde_padre" id="condicion_donde_padre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">&iquest;DONDE?</td><td class="encabezado">&nbsp;<select name="compara_donde_padre" id="compara_donde_padre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="donde_padre" name="donde_padre"></select><script>
                     $(document).ready(function() 
                      {
                      $("#donde_padre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">TRATAMIENTOS_PREVIOS</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="tratamiento_previo" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tratamientos_previos" id="condicion_tratamientos_previos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">&iquest;HA TENIDO TRATAMIENTO PREVIO DE ORTODONCIA?</td><td class="encabezado">&nbsp;<select name="compara_tratamientos_previos" id="compara_tratamientos_previos"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(282,3203,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_cuanto_tiempo" id="condicion_cuanto_tiempo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">&iquest;CUANTO TIEMPO?</td><td class="encabezado">&nbsp;<select name="compara_cuanto_tiempo" id="compara_cuanto_tiempo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cuanto_tiempo" name="cuanto_tiempo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cuanto_tiempo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_como_se_entero" id="condicion_como_se_entero"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">&iquest;COMO SE ENTER&Oacute; DE NUESTRO SERVICIO?</td><td class="encabezado">&nbsp;<select name="compara_como_se_entero" id="compara_como_se_entero"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(282,3209,'',1);?></td></tr><input type="hidden" name="campo_descripcion" value="3165"><?php submit_formato(282);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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