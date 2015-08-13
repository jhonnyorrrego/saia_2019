<html><title>.:BUSCAR ACTA DE COMPROMISO:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/dhtmlXCommon.js"></script><script type="text/javascript" src="../../js/dhtmlXTree.js"></script><link rel="stylesheet" type="text/css" href="../../css/dhtmlXTree.css"/><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ACTA DE COMPROMISO</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_convenio" id="condicion_convenio"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CONVENIO</td><td class="encabezado">&nbsp;<select name="compara_convenio" id="compara_convenio"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select id="convenio" name="convenio"></select><script>
                     $(document).ready(function() 
                      {
                      $("#convenio").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_reunion" id="condicion_fecha_reunion"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA DE REUNION</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true" maxlenght="15"  name="fecha_reunion_1" id="fecha_reunion_1" tipo="fecha" value=""><?php selector_fecha("fecha_reunion_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true" maxlenght="15"  name="fecha_reunion_2" id="fecha_reunion_2" tipo="fecha" value=""><?php selector_fecha("fecha_reunion_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_dependencia_reunion" id="condicion_dependencia_reunion"><option value="AND">Y</option><option value="OR">O</option></td><td class="encabezado" width="20%" title="">DEPENDENCIA DE LA REUNION</td><td class="encabezado">&nbsp;<select name="compara_dependencia_reunion" id="compara_dependencia_reunion"> <option value="or">Alguno</option><option value="and">Todos</option></select></td><?php arbol_dependencias(81,977,'',1);?></tr><tr><td class="encabezado">&nbsp;<select name="condicion_serie_cpu" id="condicion_serie_cpu"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SERIE DE LA CPU</td><td class="encabezado">&nbsp;<select name="compara_serie_cpu" id="compara_serie_cpu"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select id="serie_cpu" name="serie_cpu"></select><script>
                     $(document).ready(function() 
                      {
                      $("#serie_cpu").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_num_stiker" id="condicion_num_stiker"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NO. DEL STIKER</td><td class="encabezado">&nbsp;<select name="compara_num_stiker" id="compara_num_stiker"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select id="num_stiker" name="num_stiker"></select><script>
                     $(document).ready(function() 
                      {
                      $("#num_stiker").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_sistema_operativo" id="condicion_sistema_operativo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">SISTEMA OPERATIVO</td><td class="encabezado">&nbsp;<select name="compara_sistema_operativo" id="compara_sistema_operativo"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,991,$_REQUEST['iddoc']);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ofimatico" id="condicion_ofimatico"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OFIMATICO</td><td class="encabezado">&nbsp;<select name="compara_ofimatico" id="compara_ofimatico"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,983,$_REQUEST['iddoc']);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_ms_project" id="condicion_ms_project"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">MS PROJECT</td><td class="encabezado">&nbsp;<select name="compara_ms_project" id="compara_ms_project"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,980,$_REQUEST['iddoc']);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_dise_grafico" id="condicion_dise_grafico"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">DISE. GRAFICO</td><td class="encabezado">&nbsp;<select name="compara_dise_grafico" id="compara_dise_grafico"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,978,$_REQUEST['iddoc']);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_antivirus" id="condicion_antivirus"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ANTIVIRUS</td><td class="encabezado">&nbsp;<select name="compara_antivirus" id="compara_antivirus"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,975,$_REQUEST['iddoc']);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_oracle" id="condicion_oracle"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ORACLE</td><td class="encabezado">&nbsp;<select name="compara_oracle" id="compara_oracle"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,984,$_REQUEST['iddoc']);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_base_datos" id="condicion_base_datos"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">BASE DE DATOS EN</td><td class="encabezado">&nbsp;<select name="compara_base_datos" id="compara_base_datos"> <option value="=|@|@">Igual</option><option value="-|@|@">Menor</option><option value="+|@|@">Mayor</option><option value="!|@|@">Diferente</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(81,976,$_REQUEST['iddoc']);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_otro1" id="condicion_otro1"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OTRO 1</td><td class="encabezado">&nbsp;<select name="compara_otro1" id="compara_otro1"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select id="otro1" name="otro1"></select><script>
                     $(document).ready(function() 
                      {
                      $("#otro1").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_otro2" id="condicion_otro2"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OTRO 2</td><td class="encabezado">&nbsp;<select name="compara_otro2" id="compara_otro2"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select id="otro2" name="otro2"></select><script>
                     $(document).ready(function() 
                      {
                      $("#otro2").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_otro3" id="condicion_otro3"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OTRO 3</td><td class="encabezado">&nbsp;<select name="compara_otro3" id="compara_otro3"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select id="otro3" name="otro3"></select><script>
                     $(document).ready(function() 
                      {
                      $("#otro3").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_otro4" id="condicion_otro4"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OTRO 4</td><td class="encabezado">&nbsp;<select name="compara_otro4" id="compara_otro4"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select id="otro4" name="otro4"></select><script>
                     $(document).ready(function() 
                      {
                      $("#otro4").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_otro5" id="condicion_otro5"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OTRO 5</td><td class="encabezado">&nbsp;<select name="compara_otro5" id="compara_otro5"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select id="otro5" name="otro5"></select><script>
                     $(document).ready(function() 
                      {
                      $("#otro5").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_observaciones" id="condicion_observaciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OBSERVACIONES</td><td class="encabezado">&nbsp;<select name="compara_observaciones" id="compara_observaciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select id="observaciones" name="observaciones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observaciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="975"><?php submit_formato(81);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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