<html><title>.:BUSCAR SEGUIMIENTO INDICADOR:.</title><head><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/estilo_formulario.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><script type="text/javascript" src="../../js/jquery.validate.js"></script><script type="text/javascript" src="../../js/title2note.js"></script><script type="text/javascript" src="../../js/jquery.fcbkcomplete.js"></script><link rel="stylesheet" type="text/css" href="../../css/style_fcbkcomplete.css"/></head><body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="../librerias/funciones_buscador.php" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA SEGUIMIENTO INDICADOR</td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_fecha_seguimiento" id="condicion_fecha_seguimiento"><option value="AND">Y</option><option value="OR">O</option></td>
                       <td class="encabezado" width="20%" title="Por favor Ingrese la fecha en que se realiza el seguimiento">FECHA</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true"  name="fecha_seguimiento_1" id="fecha_seguimiento_1" tipo="fecha" value=""><?php selector_fecha("fecha_seguimiento_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?>&nbsp;&nbsp; Y &nbsp;&nbsp;<input type="text" readonly="true"  name="fecha_seguimiento_2" id="fecha_seguimiento_2" tipo="fecha" value=""><?php selector_fecha("fecha_seguimiento_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></span></font></td></tr><tr><td class="encabezado">&nbsp;<select name="condicion_meta_indicador_actual" id="condicion_meta_indicador_actual"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="Meta actual del seguimiento">LIMITE SUPERIOR</td><td class="encabezado">&nbsp;<select name="compara_meta_indicador_actual" id="compara_meta_indicador_actual"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="meta_indicador_actual" name="meta_indicador_actual"></select><script>
                     $(document).ready(function() 
                      {
                      $("#meta_indicador_actual").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_resultado" id="condicion_resultado"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="valores asignados a las variables de la f&oacute;rmula a la cual se hace seguimiento">RESULTADOS</td><td class="encabezado">&nbsp;<select name="compara_resultado" id="compara_resultado"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="resultado" name="resultado"></select><script>
                     $(document).ready(function() 
                      {
                      $("#resultado").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><tr><td class="encabezado">&nbsp;<select name="condicion_observaciones" id="condicion_observaciones"><option value="AND">Y</option><option value="OR">O</option></td>
                     <td class="encabezado" width="20%" title="an&aacute;lisis de datos">AN&Aacute;LISIS DE DATOS</td><td class="encabezado">&nbsp;<select name="compara_observaciones" id="compara_observaciones"> <option value="or">Alguno</option><option value="and">Todos</option></select></td>
                     <td bgcolor="#F5F5F5"><select multiple id="observaciones" name="observaciones"></select><script>
                     $(document).ready(function() 
                      {
                      $("#observaciones").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr><input type="hidden" name="campo_descripcion" value="2942,2944"><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?>"><?php submit_formato(263);?></table><?php if(@$_REQUEST["campo__retorno"]){ ?>
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