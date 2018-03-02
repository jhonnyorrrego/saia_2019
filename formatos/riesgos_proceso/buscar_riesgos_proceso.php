<html><title>.:BUSCAR RIESGOS:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA RIESGOS</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_riesgo_antiguo" id="condicion_riesgo_antiguo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="1: Riesgo o documento antiguo
2: Riesgo o documento nuevo">RIESGO ANTIGUO</td><td class="encabezado">&nbsp;<select name="compara_riesgo_antiguo" id="compara_riesgo_antiguo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="riesgo_antiguo" name="riesgo_antiguo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#riesgo_antiguo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">IDENTIFICACION DEL RIESGO</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="identificacion_riesg" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_riesgo" id="condicion_fecha_riesgo"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_riesgo_1" id="fecha_riesgo_1" tipo="fecha" value=""><?php selector_fecha("fecha_riesgo_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_riesgo_2" id="fecha_riesgo_2" tipo="fecha" value=""><?php selector_fecha("fecha_riesgo_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_consecutivo" id="condicion_consecutivo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">NUMERO</td><td class="encabezado">&nbsp;<select name="compara_consecutivo" id="compara_consecutivo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="consecutivo" name="consecutivo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#consecutivo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_riesgo" id="condicion_riesgo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Definici&oacute;n: Representa la posibilidad de ocurrencia de un evento que pueda entorpecer el normal desarrollo de las funciones de la entidad y afectar el logro de sus objetivos.">RIESGO</td><td class="encabezado">&nbsp;<select name="compara_riesgo" id="compara_riesgo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="riesgo" name="riesgo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#riesgo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_controles" id="condicion_controles"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="controles existentes">CONTROLES EXISTENTES</td><td class="encabezado">&nbsp;<select name="compara_controles" id="compara_controles"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="controles" name="controles"></select><script>
                     $(document).ready(function() 
                      {
                      $("#controles").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_tipo_riesgo" id="condicion_tipo_riesgo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="RIESGO ESTRAT&Eacute;GICO: Se asocia con la forma en la que se administra la Entidad. El manejo del riesgo estrat&eacute;gico se enfoca a asuntos globales relacionados con la misi&oacute;n y el cumplimiento de los objetivos estrat&eacute;gicos, la clara definici&oacute;n de pol&iacute;ticas, dise&ntilde;o y conceptualizaci&oacute;n de la entidad por parte de la alta gerencia.


RIESGO DE IMAGEN: Est&aacute;n relacionados con la percepci&oacute;n y la confianza por parte de la ciudadan&iacute;a hacia la instituci&oacute;n.


RIESGOS OPERATIVOS: Comprenden riesgos provenientes del funcionamiento y operatividad de los sistemas de informaci&oacute;n institucional, de la definici&oacute;n de los procesos, de la estructura de la entidad, de la articulaci&oacute;n entre dependencias.


RIESGOS FINACIEROS: Se relacionan con el manejo de los recursos de la entidad que incluyen: la ejecuci&oacute;n presupuestal, la elaboraci&oacute;n de los estados financieros, los pagos, manejo de excedentes de tesorer&iacute;a y el manejo sobre los bienes.


RIESGOS DE CUMPLIMIENTO: Se asocian con la capacidad de la entidad para cumplir con los requisitos legales, contractuales, de &eacute;tica p&uacute;blica y en general con su compromiso con la comunidad.


RIESGOS DE TECNOLOGIA: Est&aacute;n relacionados con la capacidad tecnol&oacute;gica de la entidad para satisfacer sus necesidades actuales y futuras y el cumplimiento de la misi&oacute;n.


CORRUPCI&Oacute;N: Se entiende por Riesgo de Corrupci&oacute;n la posibilidad de que por acci&oacute;n u omisi&oacute;n, mediante el uso indebido del poder, de los recursos o de la informaci&oacute;n, se lesionen los intereses de una entidad y en consecuencia del Estado, para la obtenci&oacute;n de un beneficio particular.">TIPO DE RIESGO</td><td class="encabezado">&nbsp;<select name="compara_tipo_riesgo" id="compara_tipo_riesgo"> <option value="LIKE|%|%">Similar</option><option value="LIKE|%|@">Inicia Con</option><option value="LIKE|@|%">Finaliza Con</option></select></td><td bgcolor="#F5F5F5"><?php genera_campo_listados_editar(273,3095,'',1);?></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_opciones_manejo" id="condicion_opciones_manejo"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">OPCIONES DE MANEJO</td><td class="encabezado">&nbsp;<select name="compara_opciones_manejo" id="compara_opciones_manejo"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="opciones_manejo" name="opciones_manejo"></select><script>
                     $(document).ready(function() 
                      {
                      $("#opciones_manejo").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_acciones" id="condicion_acciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">ACCIONES</td><td class="encabezado">&nbsp;<select name="compara_acciones" id="compara_acciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="acciones" name="acciones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#acciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr>
                   <td class="encabezado" width="20%" title="">ANALISIS DE RIESGO</td>
                   <td bgcolor="#F5F5F5"><label></label><input type="hidden" name="analisis_riego" value=""></td>
                  </tr><tr><td class="encabezado">&nbsp;<select name="condicion_responsables" id="condicion_responsables"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">RESPONSABLES</td><td class="encabezado">&nbsp;<select name="compara_responsables" id="compara_responsables"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="responsables" name="responsables"></select><script>
                     $(document).ready(function() 
                      {
                      $("#responsables").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_indicador" id="condicion_indicador"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">INDICADOR</td><td class="encabezado">&nbsp;<select name="compara_indicador" id="compara_indicador"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="indicador" name="indicador"></select><script>
                     $(document).ready(function() 
                      {
                      $("#indicador").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_cronograma" id="condicion_cronograma"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="">CRONOGRAMA</td><td class="encabezado">&nbsp;<select name="compara_cronograma" id="compara_cronograma"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="cronograma" name="cronograma"></select><script>
                     $(document).ready(function() 
                      {
                      $("#cronograma").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="3092,3094"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(273);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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