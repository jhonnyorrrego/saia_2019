<html><title>.:BUSCAR HISTORIA LABORAL:.</title><head><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA HISTORIA LABORAL</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_nombre" id="condicion_nombre"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NOMBRE</td><td class="encabezado">&nbsp;<select name="compara_nombre" id="compara_nombre"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="nombre" name="nombre"></select><script>
                     $(document).ready(function() 
                      {
                      $("#nombre").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_apellidos" id="condicion_apellidos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">APELLIDOS</td><td class="encabezado">&nbsp;<select name="compara_apellidos" id="compara_apellidos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="apellidos" name="apellidos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#apellidos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_documento_identidad" id="condicion_documento_identidad"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DOCUMENTO DE IDENTIDAD</td><td class="encabezado">&nbsp;<select name="compara_documento_identidad" id="compara_documento_identidad"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="documento_identidad" name="documento_identidad"></select><script>
                     $(document).ready(function() 
                      {
                      $("#documento_identidad").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_lugar_documento" id="condicion_lugar_documento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DE (MUNICIPIO DE EXPEDICION)</td><td class="encabezado">&nbsp;<select name="compara_lugar_documento" id="compara_lugar_documento"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(219,2343,$_REQUEST['iddoc']);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_direccion" id="condicion_direccion"><option value="AND">Y</option><option value="OR">O</option></td>
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
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_telefonos" id="condicion_telefonos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TEL&Eacute;FONOS</td><td class="encabezado">&nbsp;<select name="compara_telefonos" id="compara_telefonos"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="telefonos" name="telefonos"></select><script>
                     $(document).ready(function() 
                      {
                      $("#telefonos").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_celular" id="condicion_celular"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CELULAR</td><td class="encabezado">&nbsp;<select name="compara_celular" id="compara_celular"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="celular" name="celular"></select><script>
                     $(document).ready(function() 
                      {
                      $("#celular").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_email" id="condicion_email"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">E-MAIL</td><td class="encabezado">&nbsp;<select name="compara_email" id="compara_email"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="email" name="email"></select><script>
                     $(document).ready(function() 
                      {
                      $("#email").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_lugar_nacimiento" id="condicion_lugar_nacimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">LUGAR DE NACIMIENTO</td><td class="encabezado">&nbsp;<select name="compara_lugar_nacimiento" id="compara_lugar_nacimiento"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(219,2348,$_REQUEST['iddoc']);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_nacimiento" id="condicion_fecha_nacimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE NACIMIENTO</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_nacimiento_1" id="fecha_nacimiento_1" tipo="fecha" value=""><?php selector_fecha("fecha_nacimiento_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_nacimiento_2" id="fecha_nacimiento_2" tipo="fecha" value=""><?php selector_fecha("fecha_nacimiento_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_eps" id="condicion_eps"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">EPS EN LA QUE SE ENCUENTRA AFILIADO</td><td class="encabezado">&nbsp;<select name="compara_eps" id="compara_eps"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="eps" name="eps"></select><script>
                     $(document).ready(function() 
                      {
                      $("#eps").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_cuenta_ahorro" id="condicion_cuenta_ahorro"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CUENTA DE AHORRO N&Uacute;MERO</td><td class="encabezado">&nbsp;<select name="compara_cuenta_ahorro" id="compara_cuenta_ahorro"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cuenta_ahorro" name="cuenta_ahorro"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cuenta_ahorro").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_pensiones" id="condicion_pensiones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FONDO DE PENSIONES EN LAS QUE SE ENCUENTRA AFILIADO</td><td class="encabezado">&nbsp;<select name="compara_pensiones" id="compara_pensiones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="pensiones" name="pensiones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#pensiones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_cesantias" id="condicion_cesantias"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">FONDO DE CESANT&Iacute;AS EN LA QUE SE ENCUENTRA AFILIADO</td><td class="encabezado">&nbsp;<select name="compara_cesantias" id="compara_cesantias"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cesantias" name="cesantias"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cesantias").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_banco" id="condicion_banco"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">BANCO DE LA CUENTA</td><td class="encabezado">&nbsp;<select name="compara_banco" id="compara_banco"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="banco" name="banco"></select><script>
                     $(document).ready(function() 
                      {
                      $("#banco").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_blusa" id="condicion_blusa"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TALLA BLUSA</td><td class="encabezado">&nbsp;<select name="compara_blusa" id="compara_blusa"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="blusa" name="blusa"></select><script>
                     $(document).ready(function() 
                      {
                      $("#blusa").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_pantalon" id="condicion_pantalon"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">TALLA PANTALON</td><td class="encabezado">&nbsp;<select name="compara_pantalon" id="compara_pantalon"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="pantalon" name="pantalon"></select><script>
                     $(document).ready(function() 
                      {
                      $("#pantalon").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_calzado" id="condicion_calzado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CALZADO</td><td class="encabezado">&nbsp;<select name="compara_calzado" id="compara_calzado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="calzado" name="calzado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#calzado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="2340"><?php submit_formato(219);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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